@extends('layout')

@section('style')
@endsection

@section('content')

<div id="countryCodes">


    <div id="closeCountryCodes">
      <div class="closeModal"><img width="30px" src="../assets/images/x_close.png"></div>
    </div>


    <div id="countryCodesPopup">
        <input id="searchCountry"/>
        <p id="trendingCountries">Trending top 6</p>
        <p id="noMatchResult" style="display:none;text-align: center;">Result Not Found</p>
        <ul>
            <div id="trendingList">
              <li class="trending" style="color:#4a9fef;"><p>United Kingdom</p>
                  <div>+44</div>
                  <span class="tick" style="color: #4a9fef"> &#10003;</span></li>
              <li class="trending"><p>United States</p>
                  <div>+1</div>
              </li>
              <li class="trending"><p>Brazil</p>
                  <div>+55</div>
              </li>
              <li class="trending"><p>Germany</p>
                  <div>+49</div>
              </li>
              <li class="trending"><p>Italy</p>
                  <div>+37</div>
              </li>
              <li class="trending"><p>Russia</p>
                  <div>+7</div>
              </li>
          </div>


            <p id="loadMoreCodes" style="font-weight: 400; margin-top: 100px; text-align: center; color: #8c8c8c;"><img width="100px" height="100px" src="../assets/images/custom_loader.gif"></p>
        </ul>

    </div>
</div>





<div class="tableWrapper">
  <div class="tableContainer">

    <div class="closeScreen"><img width="30px" src="../assets/images/x_close.png"></div>

      <div id="sendAppThanks" style="display: none;">
          Thanks
      </div>

      <div id="sendAppCheckPhone" style="display: none;">
          Please check your phone
      </div>


      <form method="POST" action="{{ route('sendApp') }}" accept-charset="UTF-8" id="sendApp">
          {{--@csrf--}}
          {{ csrf_field() }}



        <input id="countryCode" readonly="readonly" class="pointer" name="countryCode" type="text" value="+44" >

        <input id="mobileNumber"  autofocus="autofocus" onfocus="this.value = this.value" name="mobileNumber" type="text" value=" ">


        <div>
            <input type="image" id="submit" value="" src="../assets/images/appleapp_send.png" alt="Submit">
            {{--<button type="button" id="submit" src="../assets/images/appleapp_send.png"></button>--}}
            <div id="changePrefix" class="pointer">Change Prefix from United Kingdom</div>
        </div>


      </form>


  </div>
</div>



@endsection

@section('script')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> -->
    <script type="text/javascript">


        $('.closeScreen').on('click', function (e) {
            window.location.href = '/';
            e.preventDefault(e);
        });

        $("#countryCode, #changePrefix").on('click', function () {
            
            $('#sendApp').fadeOut();

            $('#countryCodes').fadeIn(500);

            $("#searchCountry").focus();




        });


        $('#closeCountryCodes, .closeModal').on('click', function (e) {
            e.stopPropagation();
            $('#openSendApp').fadeOut();
            $('#sendApp').fadeIn();
            $('#countryCodes').fadeOut();
            $("#mobileNumber").focus();
        });



//trim mobile numbr input as being entered
        $(function(){
          $('#mobileNumber').bind('input', function(){
            $(this).val(function(_, v){
              return v.replace(/\s+/g, '');
            });
          });


          var countryData = [], load, pages, number, value, country = "United Kingdom", code = "+44", searchEnable = false;

          $.getJSON("{{ URL::asset('assets/jsonFiles/country.json') }}", function (data) {
            var total;
            
            $.each(data, function (key, val) {
                total = key;
                countryData[key] = val;
            });
            // var height = 40*countryData.length;
            // console.log(height);
            // $('#countryCodes').css('height', height+'px');
            pages = total / 20;
            load = 1;
            loadCountries(1, 20);
          });
          
          var win = $(window);
          
          $('#countryCodes').scroll(function () {
                var fixedHeight = $(document).height() - win.height();
                var scrollHeight = win.scrollTop() + 120;
                if (fixedHeight <= scrollHeight) {
                    $('#loadMoreCodes').fadeOut(1000, function () {
                        if (load < pages) {
                            load++;
                            loadCountries(load, 20)
                            $('#loadMoreCodes').fadeIn();
                        }
                    });
                }
            });

            function loadCountries(page, countryRecords) {
                var offset = (page - 1) * countryRecords;
                var records = offset + countryRecords;
                for (var i = offset; i < records; i++) {
                    if (countryData[i] != undefined) {
                        $('#loadMoreCodes').before('<li class="'+ countryData[i].name.toLowerCase() +'"><p>' + countryData[i].name + '</p><div>' + countryData[i].dial_code + '</div></li>');
                    }
                }
                ;
            };



// search country codes
            $('#searchCountry').keyup(function () {
              $("#trendingCountries, #loadMoreCodes").hide();
                var matchResult = [];
                value = $(this).val();
                // if(value.length == 0){
                //     $("#trendingList").show();
                // }else{
                //     $("#trendingList").hide();
                // }
                var exp = new RegExp('^' + value, 'i');

                if (!$(this).val()) {
                    $('#searchCountry').attr('disabled', false);
                    $("#trendingCountries, #loadMoreCodes").show();
                    $("#searchCountry").focus();

                }


                $('li').each(function () {
                    var isMatch = exp.test($('p', this).text());
                    $(this).toggle(isMatch);
                    matchResult.push(isMatch);
                });


                if ($.inArray(true, matchResult) == -1) {
                    $('#noMatchResult').show();
                  } else {
                    console.log(matchResult);
                      $('#noMatchResult').hide();
                    }
                });




            $('#countryCodes ul ').on('click', 'li', function () {
                var value = $(this).children('div').html();
                var elem = $(this);
                $('#changePrefix').html('Change Prefix from ' + $(this).children('p').html());
                $('li').each(function () {
                    if ($(this).children('p').html() == country && $(this).children('div').html() == code) {
                        $(this).removeAttr('style');
                        $(this).children('span').remove();
                        $(this).css('display', 'list-item');
                    }
                });
                $('#countryCode input').attr('value', value);
                elem.css('color', '#4a9fef');
                elem.append('<span class="tick" style="color: #4a9fef"> &#10003;</span>');
                code = elem.children('div').html();
                country = elem.children('p').html();
                $('#sendApp').fadeIn();
                $('#countryCodes').fadeOut();
                $('#mobileNumber').focus();
            });

            $('.alertContainer button').on('click', function (e) {
                $('.alertContainer').fadeOut(300);
                e.preventDefault(e);
                return false;
            });

            $.validator.addMethod(
                    "digitSpace",
                    function (value, element) {
                        return this.optional(element) || /^[0-9 ]+$/.test(value);
                    },
                    "Please enter digits"
            );

            var validator = $('#sendApp').validate({
                onclick: false,
                rules: {
                    mobileNumber: {
                        required: true,
                        digitSpace: true,
                        minlength: 5
                    }
                },
                messages: {},
                unhighlight: function (element, errorClass, validClass) {
                    $('.alertContainer').hide();
                },
                errorPlacement: function (error, element) {
                    $('.alertCustom').children('p').html(error.text());
                    $('.alertContainer').show();
                    return;
                },
                submitHandler: function (form) {
                    number = $('#mobileNumber').val();
                    var url = '/sendApp';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $("#sendApp").serialize(),
                        success: function (response) {
                            var data = response;
                            $('#sendApp').fadeOut(500, function () {
                                $('#sendAppThanks').fadeIn(function () {
                                    $('#sendAppThanks').delay(1000).fadeOut(function () {
                                        $('#sendAppCheckPhone').fadeIn(function () {
                                    setTimeout(function(){
                                        window.location.href = '/';
                                        e.preventDefault(e);
                                    }, 1000);

                                        });
                                    });
                                });
                            });
                        },
                        error: function (response) {
                            console.log(response);
                        }
                    });
                }
            });


        });
    </script>
@endsection
