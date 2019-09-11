$(function () {
    var circle = $('#circle'),
        message = $('#message'),
        success = $('#successMsg'),
        form = $('#form'),
        startup = $('#startup'),
        nextClick = $('.nextClick'),
        licenseClick = false,
        countryData = [],
        load,
        pages,
        win = $(window),
        number,
        value,
        language = "English",
        rank = "3",
        searchEnable = false,
        modelClick = false,
        base_url = '{{ URL::to('/')}}';

    $('input').attr('autocomplete', 'false');

    if (localStorage.getItem('register') == 'true') {
        messageFade();
        localStorage.removeItem('register');
    } else {
        circle.delay(500).fadeIn(800);
        circle.delay(500).fadeOut(800, function () {
            messageFade();
        });
    }



    $('input[name=model_no]').on('click', function () {
        if (!licenseClick) {
            modelClick = true;
            licenseClick = true;
            var elem = jQuery('<br /><br /><input type="text" class="form-control-lg" name="windows_no" placeholder="No of windows"> <br /><br />' +
                '<input type="text" class="form-control-lg" name="doors_no" placeholder="No of doors"> <br /><br />' +
                '<input type="text" class="form-control-lg" name="license" placeholder="Installer License">');
            $('input[name=model_no], #submitForm').fadeOut(500, function () {
                $('input[name=model_no]').fadeIn(700);
                $('input[name=model_no]').after(elem).delay(800);
                $('#submitForm').fadeIn(800);
            });
            $('html, body').animate({
                scrollTop: $('#sampleForm').offset().top
            }, 1000);
        }
    });

    $('input[name=password]').on('click', function () {
        var elem = jQuery('<br /><br /><input type="text" class="form-control-lg" name="confirmPassword" placeholder="Confirm Password">');
        $('input[name=password], #submitForm').fadeOut(500, function () {
            $('input[name=password]').fadeIn(700);
            $('input[name=password]').after(elem).delay(800);
            $('#submitForm').fadeIn(800);
        });
    });

  

    var validator = $('#sampleForm').validate({
       /* rules: {
            name: {
                required: true,
            },
            mobile: {
                required: true,
                number: true
            },
            email: {
                required: true,
                email: true
            },
            postcode: {
                required: true,
            },
            model_no: {
                required: true,
            },
            windows_no: {
                required: true,
            },
            doors_no: {
                required: true,
            },
            license: {
                required: true,
            },
            password : {
                required : true,
            },
            confirmPassword : {
                required : true,
                equalTo: "#password"
            },
        },*/
        /*errorElement: "p",
        highlight: function (element, errorClass, validClass) {
            $('.alertCustom p').show();
        },
        unhighlight: function (element, errorClass, validClass) {
        },*/
        unhighlight: function(element, errorClass, validClass) {
            $('.alertContainer').hide();
        },
        errorPlacement: function (error, element) {
            $('.alertCustom').children('p').html(error.text());
            $('.alertContainer').show();
            return;
        },
        submitHandler: function (form) {
            var url = "/registerUser";
            $.ajax({
                type: "POST",
                url: url,
                data: $("#sampleForm").serialize(),
                success: function (response) {
                    if(response.success) {
                        $("#formInner, #help").fadeOut(500, function () {
                            success.delay(500).fadeIn(500, function () {
                                success.delay(100).fadeOut(500, function () {
                                    success.html("You're ready").fadeIn(500, function () {
                                        success.delay(100).fadeOut(500, function () {
                                            success.html("Check your inbox").fadeIn(500, function () {
                                                success.delay(100).fadeOut(500, function () {
                                                    success.html("Thanks").fadeIn(500);
                                                });
                                            });
                                        });
                                    });
                                });
                            });
                        });
                    }else{
                        $.each(response.message, function(k, v){
                            $('.alertCustom').children('p').html(v);
                            console.log(v);
                        });
                        $('.alertContainer').show();
                    }
                    return false;
                },
                error: function (response) {
                    console.log(response);
                }
            });
        }
    });

    $.getJSON("../assets/jsonFiles/countryLanguage.json", function (data) {
        var total;
        $.each(data, function (key, val) {
            total = key;
            countryData[key] = val;
        });
        pages = total / 20;
        load = 1;
        loadCountries(1, 20);
    });

    win.scroll(function () {
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
                $('#loadMoreCodes').before('<li><p>' + countryData[i].language + '</p><div>' + countryData[i].rank + '</div></li>');
            }
        }
    };

    $('#codeCountry').on('click', function (e) {
        e.stopPropagation();
    });

    // search language ranks
    $('#searchCountry').keyup(function () {
        var matchResult = [];
        value = $(this).val();
        var exp = new RegExp('^' + value, 'i');
        if (!$(this).val()) {
            $('#searchCountry').attr('disabled', true);
            $("#trendLoader").show();
            $('.trending').fadeIn();
            $('#trendLoader').fadeOut(1000, function () {
                $('#trendingCountries').fadeIn();
                $('.trending').fadeOut(200, function () {
                    $('.trending').fadeIn();
                    $('#searchCountry').attr('disabled', false);
                    $("#searchCountry").focus();
                });
            });
        }
        /*else {
         $('#trendLoader, #loadMoreCodes, #trendingCountries').hide();
         $('.trending').fadeOut();
         }*/

        $('li').each(function () {
            var isMatch = exp.test($('p', this).text());
            $(this).toggle(isMatch);
            matchResult.push(isMatch);
        });
        if ($.inArray(true, matchResult) == -1) {
            $('#noMatchResult').show();
        } else {
            $('#noMatchResult').hide();
        }
    });

    $('#message, #codeCountry').on('click', function (e) {
        message.fadeOut();
        nextClick.fadeOut(500);
        e.stopPropagation();
        $('#countryCodes').fadeIn(500);
        $("#searchCountry").focus();
        $('.trending').show();
        $("#trendingCountries").hide();
        $("#trendLoader").show();
        if (value == undefined) {
            $('#searchCountry').attr('disabled', true);
            $('#trendLoader').fadeOut(1000, function () {
                $('#trendingCountries').fadeIn();
                $('.trending').fadeOut(200, function () {
                    $('.trending').fadeIn();
                    $('#searchCountry').attr('disabled', false);
                    $("#searchCountry").focus();
                });
            });
        } else {
            $('#searchCountry').trigger('keyup');
        }
    });

    $('#closeCountryCodes, .closeModal').on('click', function (e) {
        e.stopPropagation();
        message.fadeIn();
        nextClick.fadeIn(500);
        $('#countryCodes').fadeOut();
    });

    $('#countryCodes ul ').on('click', 'li', function(){
        var value = $(this).children('div').html();
        var elem = $(this);
        $('#codeCountry').html('Prefix ' +$(this).children('p').html());
        $('li').each(function() {
            if($(this).children('p').html() == language && $(this).children('div').html() == rank){
                $(this).removeAttr('style');
                $(this).children('span').remove();
                $(this).css('display', 'list-item');
            }
        });
        $('#countryCode').attr('value',value);
        elem.css('color','#4a9fef');
        elem.append('<span class="tick" style="color: #4a9fef"> &#10003;</span>');
        language = elem.children('p').html();
        message.html(elem.children('p').html()).fadeIn(500);
        nextClick.fadeIn();
        $('#countryCodes').fadeOut();
    });

    function messageFade() {
        message.fadeIn(500, function () {
            message.delay(100).fadeOut(500, function () {
                message.html("Arrival 2019").fadeIn(500, function () {
                    message.delay(100).fadeOut(500, function () {
                        message.html("English").fadeIn(500);
                        nextClick.fadeIn(500);
                    });
                });
            });
        });
    }






    /* page navigation */

     $(".gotoSwap").click(function () {
        window.location.href = 'swap';
    });


    /* fade out / in page */

    fadeInPage();

    function fadeOutPage() {
        $("body").fadeOut(500);

    }

    function fadeInPage() {
        $("body").fadeIn(500);
    }













});


     var fadeTime = 500;
