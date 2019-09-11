@extends('layout')

@section('style')


@endsection

@section('content')

<div class="alertContainer" style="z-index: 999;">
  <div class="tableWrapper">
      <div class="tableContainer">
        <div class="alertBG"></div>
        <div class="alertCustom">
            <p id="validation_error_msg">Please enter a valid email</p>
            <button>OK</button>
        </div>
      </div>
  </div>
</div>


    <div id="register" class="tableWrapper">

                <div class="closeScreen"><img width="30px" src="../assets/images/x_close.png"></div>


        <div class="tableContainer">
            <div class="content">
                <form id="registerForm" method="POST" autocomplete="off">
                    <input id="inputEmail" class="form-control-lg" type="text" name="email" autocomplete="off" placeholder="Your email" onfocus="this.placeholder=''" onblur="this.placeholder='Your email'">
                    <input id="btnNext" class="form-control-lg" type="button" name="Next" value="Next">

                </form>
            </div>
        </div>
    </div>







@endsection

@section('script')

<script type="text/javascript">

   $(document).ready(function(){
    $("input").attr("autocomplete", "off");
});

    $('.closeScreen').on('click', function (e) {
            window.location.href = '/business';
            e.preventDefault(e);
        });

    $('#btnNext').on('click', function (e) {
            var email = $('#inputEmail').val();
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if($('#inputEmail').val() == ''){
                $('#validation_error_msg').html('<p id="validation_error_msg">Please enter an email id</p>');
                $('.alertContainer').show();
            }else if(email.match(mailformat)){
                sessionStorage.setItem('email', $('#inputEmail').val());
                window.location.href = '/register/name';
                e.preventDefault(e);
            }else{
                $('.alertContainer').show();
            }

        });

        $('#inputEmail').bind('keydown', function(e) {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if(keycode == '13'){
                    e.preventDefault(e);
                }
            });


            $('.alertContainer button').on('click', function (e) {
              $('.alertContainer').fadeOut(300);
              e.preventDefault(e);
              return false;

            });
</script>

@endsection
