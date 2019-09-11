@extends('layout')

@section('style')
<style>
    @font-face {
      font-family: 'HelveticaNeue-Medium';
      src: url('/fonts/HelveticaNeue-Medium.eot?#iefix') format('embedded-opentype'),  url('font/HelveticaNeue-Medium.woff') format('woff'), url('/fonts/HelveticaNeue-Medium.ttf')  format('truetype'), url('/fonts/HelveticaNeue-Medium.svg#HelveticaNeue-Medium') format('svg');
      font-weight: normal;
      font-style: normal;
      }
      * {font-family: 'HelveticaNeue-Medium' !important;}
    </style>

@endsection

@section('content')

<div id="splash" style="width: 100%; height: 100%; position: absolute; z-index:99; display: none;">
    <div style="width: 100%; height: 100%;  display: flex; position: fixed; align-items: center; justify-content: center; text-align: center;">

        <h1 style="font-size: 70pt;">Hello</h1>
    </div>
</div>

<div id="activate" style="width: 100%; height: 100%; position: absolute; z-index:99; display: none;  ">
    <div style="width: 100%; height: 100%;  display: flex; position: fixed; align-items: center; justify-content: center; text-align: center;">

        <h1 style="margin-top: 0px;">

          <span style="font-size: 34pt;">Switch Easy</span><br>&nbsp;<br>
          <span id="goToLink" style="font-size: 24pt; cursor: pointer;">at Hug</span></h1>
    </div>
</div>

<div id="link" style="width: 100%; height: 100%; position: absolute; z-index:999; background: #fff; display: none; ">
    <div style="width: 100%; height: 100%;  display: flex; position: fixed; align-items: center; justify-content: center; text-align: center; ">
        <div id="bgClick" style="position: absolute; width: 100%; height: 100%;"></div>

        <h1 style="margin-top: 0px; z-index: 9999;"><span style="font-size: 34pt;">Simple</span></h1>
        <!-- <h1 style="margin-top: -70px;"><span style="font-size: 24pt;">Available from</span><br>&nbsp;<br><span style="font-size: 34pt;"><a href="http://www.hug.space/#/"><img  src="{{ URL::to('/assets/images/hug_logo.png') }}" width="100px"></a>&nbsp;	&nbsp;	&nbsp;<a href="http://www.eraeverywhere.com/"><img  src="{{ URL::to('/assets/images/era_logo.png') }}" width="132px"></a></span></h1>-->
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $('document').ready(function(){

        $('#splash').fadeIn(200, function(){
            $('#splash').delay(600).fadeOut(200, function(){
                $('#activate').fadeIn(200);
            });
        });
    });


    $("#goToLink").click(function(){
        $("#activate").fadeOut(500, function() {
            $("#link").fadeIn(500);
        });
    });

    $("#bgClick").click(function(){
        $("#link").fadeOut(500, function() {
            $("#activate").fadeIn(500);
        });
    });



    </script>
@endsection
