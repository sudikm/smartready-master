@extends('layout')

@section('style')


@endsection

@section('content')


<div class="alertContainer" style="z-index: 999;">
  <div class="tableWrapper">
      <div class="tableContainer">
        <div class="alertBG"></div>
        <div class="alertCustom">
            <p>Please select a Sector</p>
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


                    <div id="formSector" class="dropdown dropright">


                        <button class="btn btn-secondary  btn-lg dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sector
                          <span class="selection"></span>
                      </button>


                      <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                        <button class="dropdown-item" type="button">Property Developer</button>
                        <button class="dropdown-item" type="button">Architect</button>
                        <button class="dropdown-item" type="button">Manufacturer</button>
                        <button class="dropdown-item" type="button">Installer</button>
                        <button class="dropdown-item" type="button">Hardware</button>
                      </div>
                    </div>

                    <input type="hidden" name="sector" id="sector">

                    <input id="btnSector" class="form-control-lg" type="button" name="Next" value="Next">



                </form>
            </div>
        </div>
    </div>








@endsection

@section('script')


 <script type="text/javascript">
    var sector = $("#sector").val();
    $('#formSector .dropdown-toggle').html("Sector");


$(".dropdown-menu .dropdown-item").click(function(){
  $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="selection"></span>');
  $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
});

    $('.dropdown-menu button').click(function(){
        console.log("sector item clicked");
        $('#sector').val($(this).html());
    });


    $('.closeScreen').on('click', function (e) {
            window.location.href = '/business';
            e.preventDefault(e);
        });

    $('#btnSector').on('click', function (e) {
            if($('#sector').val() == ''){
                $('.alertContainer').show();
            }else{
                sessionStorage.setItem('sector', $('#sector').val());
                window.location.href = '/register/email';
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
