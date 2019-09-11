@extends('layout')

@section('style')


@endsection

@section('content')



    <div id="register" class="tableWrapper">

        <div class="closeScreen"><img width="30px" src="../assets/images/x_close.png"></div>

        <div class="tableContainer">

                <form id="registerForm" method="POST">


                    <label id="formLabel" class="form-control-lg">Wanna be smart?</label>
                    <input id="btnLabel" class="form-control-lg" type="button" name="Next" value="Next">

                </form>

        </div>
    </div>







@endsection

@section('script')

<script type="text/javascript">
    $('.closeScreen').on('click', function (e) {
            window.location.href = '/business';
            e.preventDefault(e);
        });

    $('#btnLabel').on('click', function (e) {
            window.location.href = '/register/sector';
            e.preventDefault(e);
        });




</script>

@endsection
