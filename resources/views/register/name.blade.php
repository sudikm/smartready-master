@extends('layout')

@section('style')


@endsection

@section('content')

<div class="alertContainer" style="z-index: 999;">
  <div class="tableWrapper">
      <div class="tableContainer">
        <div class="alertBG"></div>
        <div class="alertCustom">
            <p>Please enter your name</p>
            <button>OK</button>
        </div>
      </div>
  </div>
</div>


    <div id="register" class="tableWrapper">


        <div class="closeScreen"><img width="30px" src="../assets/images/x_close.png"></div>

        <div class="tableContainer">
            <div class="content">
                <form id="registerForm" method="POST">
                    <input id="inputName" class="form-control-lg" type="text" name="name" autocomplete="off" placeholder="Your name" onfocus="this.placeholder=''" onblur="this.placeholder='Your name'">
                    <input id="btnSubmit" onclick="register('{{ route('register_email') }}');" class="form-control-lg" type="button" name="Submit" value="Send">
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

        $('#inputName').bind('keydown', function(e) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                e.preventDefault(e);
            }
        });


    // $('#btnSubmit').on('click', function (e) {
        function register(url){
            var sector = sessionStorage.getItem('sector');
            var email = sessionStorage.getItem('email');
            var name = $('#inputName').val();
            if(name == ''){
                $('.alertContainer').show();
            }else{
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    data: {
                        "email" : email,
                        "name" : name,
                        "sector" : sector
                    },
                    url: url,
                    success: function (res) {
                        if(res == 1){
                            window.location.href = '/register/thanks';
                            e.preventDefault(e);
                        }
                    }
                });
            }
        }
        $('.alertContainer button').on('click', function (e) {
          $('.alertContainer').fadeOut(300);
          e.preventDefault(e);
          return false;

        });


</script>

@endsection
