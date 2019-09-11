@extends('layout')

@section('style')
    <style>
        .customBox {

            outline: 1;
            color: #000;
            border: none;
            border-radius: 30px;
            padding: 0 !important;
            margin: 0 0 0px 0;

            font-weight: 200;
            width: 800px;
            height: 80px;
            position:relative;
            margin-top: 80px !important;
            text-align: center;
            font-size: 70px;
            font-family: Aktiv Grotesk W01 Hairline;

        }


        #selectType {
            position: relative;
            margin-top: 30px;
        }

        .form-check-inline+.form-check-inline {
            margin-left: 100px;
        }

        .form-check-label {
            font-size: 20px;
        }

        ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
            color:    #D3D3D3;
        }
        :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
           color:    #D3D3D3;
           opacity:  1;
        }
        ::-moz-placeholder { /* Mozilla Firefox 19+ */
           color:    #D3D3D3;
           opacity:  1;
        }
        :-ms-input-placeholder { /* Internet Explorer 10-11 */
           color:    #D3D3D3;
        }
        ::-ms-input-placeholder { /* Microsoft Edge */
           color:    #D3D3D3;
        }

        ::placeholder { /* Most modern browsers support this now. */
           color:    #D3D3D3;
        }

        #placeholder_text{
          font-size: -webkit-xxx-large;
          text-align: center;
          border: 0;
          outline: 0;
          width: 400px;
          font-size: 80px;
          line-height: 0;
          height: 120px;

        }

    </style>

@endsection

@section('content')

<div class="alertContainer" style="z-index: 999;">
  <div class="tableWrapper">
      <div class="tableContainer">
        <div class="alertBG"></div>
        <div class="alertCustom">
            <p id="validation_error_msg">Sorry, could not find any results.</p>
            <button>OK</button>
        </div>
      </div>
  </div>
</div> 


    <div id="searchPage" style="width: 100%; height: 100%; position: absolute; z-index:99; ">
        <div id="closeMenu" class="closeScreen"><img width="30px" src="../assets/images/x_close.png"></div>

        <div class="tableWrapper">
            <div class="tableContainer">
                <div class="content">

                    <div style="width: 100%; height: 100%; align-items: center; justify-content: center;  text-align: center; font-family: 'Aktiv Grotesk W01 Hairline';">
                       <!-- <div id="helpPageBG" style="position: absolute;  height: 100%; text-align: center; width: 100%;"></div>-->
                       <!-- <input type="text" id="findText"  class="customBox" autofocus="autofocus" placeholder="Enter">-->






                      <div id="searchSelect" class="dropdown dropright">

                          <input type="text" id="placeholder_text" autofocus="autofocus" placeholder="Enter PIN">
                          <button class="btn btn-secondary  btn-lg dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <!-- PIN -->

                            <span class="selection"></span>
                        </button>


                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                          <button class="dropdown-item number" type="button">Number</button>
                          <button class="dropdown-item company" type="button">Company</button>
                          <button class="dropdown-item location" type="button">Location</button>
                          <button class="dropdown-item category" type="button">Category</button>
                        </div>
                      </div>
                      <!-- <input type="hidden" name="select" id="select"> -->

                      <input id="btnSearch" class="form-control-lg" type="button" name="Next" value="Next">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        // /* custom dropdown */
        // function myFunction() {
        //   document.getElementById("myDropdown").classList.toggle("show");
        // }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
          if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
              var openDropdown = dropdowns[i];
              if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
              }
            }
          }
        }
        $(function () {
            $('#searchPage').focus();
            $('#placeholder_text').click(function(){
              //$(this).attr('style', 'border: 0');
            });




            var sector = $("#select").val();
            // $('#searchSelect .dropdown-toggle').html("PIN");
            $('#searchSelect .dropdown-toggle').html('');
            $('.number').hide();
            $(".dropdown-menu .dropdown-item").click(function(){
                var option = $(this).context.textContent;
                if( option  == "Number" ) {
                    $('.company').show();
                    $('.location').show();
                    $('.number').hide();
                    $('.category').show();

                    $('#placeholder_text').fadeOut(150, function(){
                        $(this).val('');
                        $('#placeholder_text').attr( {'placeholder': 'Enter PIN', 'autofocus': 'autofocus'} );
                        $('#placeholder_text').fadeIn(300);
                        $("#placeholder_text").focus();
                    });

                    $("#placeholder_text").animate({width:"400px"}, {duration: 450, queue: false})
                }
                if ( option  == "Company" ) {
                    $('.number').show();
                    $('.location').show();
                    $('.company').hide();
                    $('.category').show();

                    $('#placeholder_text').fadeOut(150, function(){
                        $(this).val('');
                        $('#placeholder_text').attr( {'placeholder': 'Enter Name', 'autofocus': 'autofocus'} );
                        $('#placeholder_text').fadeIn(300);
                        $("#placeholder_text").focus();
                    });
                    $("#placeholder_text").animate({width:"500px"}, {duration: 450, queue: false})
                }
                if ( option  == "Location" ) {
                    $('.number').show();
                    $('.company').show();
                    $('.location').hide();
                    $('.category').show();

                    $('#placeholder_text').fadeOut(150, function(){
                        $(this).val('');
                        $('#placeholder_text').attr( {'placeholder': 'Enter Postcode', 'autofocus': 'autofocus'} );
                        $('#placeholder_text').fadeIn(300);
                        $("#placeholder_text").focus();
                    });

                    $("#placeholder_text").animate({width:"600px"}, {duration: 450, queue: false})
                }

                if ( option  == "Category" ) {
                    $('.number').show();
                    $('.company').show();
                    $('.location').show();
                    $('.category').hide();


                    $('#placeholder_text').fadeOut(150, function(){
                        $(this).val('');
                        $('#placeholder_text').attr( {'placeholder': 'Enter Category', 'autofocus': 'autofocus'} );
                        $('#placeholder_text').fadeIn(300);
                        $("#placeholder_text").focus();
                    });


                    $("#placeholder_text").animate({width:"600px"}, {duration: 450, queue: false})
                }
              // $(this).parents(".dropdown").find('.btn').html($(this).text() + '<span class="selection"></span>');
              // $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
            });

            $('.dropdown-menu button').click(function(){
                $('#select').val($(this).html());
            });

            $('#dropdownMenu2').click(function(){
              $('#placeholder_text').attr('autofocus', 'autofocus');
            });

            $('#btnSearch').click(function(){
                console.log($('#placeholder_text').attr('placeholder'));
                // if( $( '#dropdownMenu2' ).text()  == "Number" ) {
                //     // $('#placeholder_text').attr('placeholder', 'Enter PIN');
                //     // window.location.href = '/search/pin';
                //     // e.preventDefault(e);
                // } else if ( $( '#dropdownMenu2' ).text()  == "Company" ) {
                //     // $('#placeholder_text').attr('placeholder', 'Enter Name');
                //     // window.location.href = '/search/company';
                //     // e.preventDefault(e);
                // } else if ( $( '#dropdownMenu2' ).text()  == "Location" ) {
                //     // $('#placeholder_text').attr('placeholder', 'Enter Postcode');
                //     // window.location.href = '/search/location';
                //     //  e.preventDefault(e);
                // } else {
                //     alert("Please select from the dropdown.")
                // }
                var placeholder = $('#placeholder_text').attr('placeholder');
                var text = $('#placeholder_text').val();
                if(placeholder == 'Enter PIN'){
                    if(text == ''){
                        $('#validation_error_msg').html('<p id="validation_error_msg">Please enter PIN.</p>');
                        $('.alertContainer').show();
                    }else if(isNaN(text)){
                        $('#validation_error_msg').html('<p id="validation_error_msg">Please enter a number.</p>');
                        $('.alertContainer').show();
                    }else{
                        var url = "{{ route('verify') }}";
                        search_data(text, url);
                    }
                }else if(placeholder == 'Enter Name'){
                    if(text == 'sac'){
                        sessionStorage.setItem('redirect_msg', text);
                        window.location.href = "/search/company/result";
                    }else{
                        $('#validation_error_msg').html('<p id="validation_error_msg">Please enter valid company name.</p>');
                        $('.alertContainer').show();
                    }
                }else if(placeholder == 'Enter Postcode'){
                    if(text == 'luton'){
                        sessionStorage.setItem('redirect_msg', text);
                        window.location.href = "/search/location/result";
                    }else{
                        $('#validation_error_msg').html('<p id="validation_error_msg">Please enter valid location.</p>');
                        $('.alertContainer').show();
                    }
                }else if(placeholder == 'Enter Category'){
                    if(text.search("window") >= 0 || text.search("windows") >= 0 || text.search("handle") >= 0 || text.search("handles") >= 0){
                        sessionStorage.setItem('redirect_msg', text);
                        window.location.href = "/search/category/result";
                    }else{
                        $('#validation_error_msg').html('<p id="validation_error_msg">Please enter valid category.</p>');
                        $('.alertContainer').show();
                    }
                }

            });


            function search_data(search, url){
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        "search" : search
                    },
                    url: url,
                    success: function (res) {
                        if(res.is_valid == 1){
                            window.location.href = '/number/'+res.number;
                            e.preventDefault(e);
                        }else{
                            $('#validation_error_msg').html(res.msg);
                            $('.alertContainer').show();
                            e.preventDefault(e);
                        }
                    }
                });
            }



            $('.alertContainer button').on('click', function (e) {
                $('.alertContainer').fadeOut(300);
                e.preventDefault(e);
                return false;

            });

            $('.closeScreen').on('click', function (e) {
                window.location.href = '/';
                e.preventDefault(e);
            });

        });
    </script>
@endsection
