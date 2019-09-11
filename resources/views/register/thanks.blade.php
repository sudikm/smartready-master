@extends('layout')

@section('style')


@endsection

@section('content')






    <div id="register" class="tableWrapper">
        <div class="tableWrapper">

        <div class="closeScreen"><img width="30px" src="../assets/images/x_close.png"></div>
        <div class="tableContainer">
            <div class="content">
                <div id="messageSuccess">We'll be in touch</div>
                <div id="messageReset" style="display: none;">Hello</div>
            </div>
        </div>
        </div>
    </div>





@endsection

@section('script')

<script type="text/javascript">




    $('.closeScreen').on('click', function (e) {
            window.location.href = '/business';
            e.preventDefault(e);
        });



</script>

@endsection
