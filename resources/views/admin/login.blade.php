<!DOCTYPE html>
<head>
    <meta charset="utf-8"/>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart Ready</title>
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,100italic,200italic,300italic,400italic,500italic,600italic,700italic"
          rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/site.css') }}/">

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>
<body class="login">
<div>
    <div class="pageContainer  homepage">
        <div id="help">Help</div>
        <div class="container-fix page_container">
            <div class="container-inner">
                <div class="form-content">
                    <div class="">
                        <div id="formInner" style="width: 100%; height: 100%;">
                            <div class="col-sm-6" style="display:inline-block">
                                <form id="login" method="POST" action="{{ URL::to('/verifyLogin') }}">
                                    {{ csrf_field() }}
                                    <h1>Register your home</h1>

                                    <input type="text" class="form-control-lg" name="email" placeholder="Email"
                                           autocomplete="false">
                                    <br/><br/>
                                    <input type="password" class="form-control-lg" name="password" placeholder="Password"
                                           autocomplete="false">
                                    <br/><br/>
                                    <input type="submit" id="submitForm" class="form-control-lg" id="submit"
                                           name="Submit">
                                </form>
                            </div>
                        </div><!--end FormInner-->
                        <div class="content-inner" style="vertical-align: middle;text-align: -webkit-center;">
                            <div id="successMsg">Successful</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        /*$.validator.addMethod(
                "emailRegex",
                function (value, element) {
                    return this.optional(element) || /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/.test(value);
                },
                "Please enter a valid email address"
        );*/
        var validator = $('#login').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                }
            },
            messages: {},
            errorElement: 'p',
            highlight: function (element, errorClass) {
                $('p.error').hide();
                $('p.error').fadeIn(1000);
            },
            unhighlight: function (element, errorClass, validClass) {
                $(this).children('span.error').hide();
            },
        });
    });
</script>
</body>
</html>