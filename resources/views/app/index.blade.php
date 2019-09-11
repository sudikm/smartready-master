@extends('layout')

@section('style')
@endsection

@section('content')




    <div class="alertContainer">
      <div class="tableWrapper">
          <div class="tableContainer">
            <div class="alertBG"></div>
            <div class="alertCustom">
                <p>Coming Soon</p>
                <button>OK</button>
            </div>
          </div>
      </div>
    </div>




    <div class="tableWrapper">
      <div class="tableContainer">
        <div class="closeScreen"><img width="30px" src="../assets/images/x_close.png"/></div>


          <div id="openAppSend" class="pointer">Send link to your phone. Click here.</div>
          <div id="btnAppStore">
              <img id="appleStore" class="pointer" src="../assets/images/appleapp.png">
          </div>


      </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">

        $('#appleStore').on('click', function (e) {
            $('.alertContainer').show();
        });

        $('.alertContainer button').on('click', function (e) {
            $('.alertContainer').hide();
        });

        $('#openAppSend').on('click', function (e) {
            window.location.href = '/app/send';
            e.preventDefault(e);
        });

        $('.closeScreen').on('click', function (e) {
            window.location.href = '/';
            e.preventDefault(e);
        });

    </script>
@endsection
