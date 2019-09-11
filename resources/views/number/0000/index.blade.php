@extends('layout')

@section('style')
<style>

    </style>

@endsection

@section('content')



    <div class="tableWrapper">
      <div class="closeScreen"><img width="30px" src="../assets/images/x_close.png"></div>


        <div class="tableContainer">


          <video id="fitshowVideo" style="margin-top: -50px;" width="400px" src="https://smartready.com/assets/productVideo/SmartWindowRotation.mp4" loop controlsList="nodownload" autoplay="autoplay" muted disablepictureinpicture></video>
          <!-- <video id="fitshowVideo" src="{{URL::asset('assets/video/number/0000/SmartWindowRotation.mp4')}}" controls controlsList="nodownload" disablepictureinpicture></video> -->
          <div style="margin-top: 40px; font-size: 2em;"> Demo </div>
          <div style="font-size: 2em;"> 0000 </div>
          <div style="margin-top: 40px; font-size: 1.4em;">(Service Provider features and benefits go here)</div>
          <div id="btnBuy" style="margin-top: 40px; color: blue; font-size: 2em; cursor: pointer;"> Switch </div>

        </div>




    </div>

@endsection

@section('script')
<script type="text/javascript">
$('document').ready(function(){
  $('#btnBuy').on('click', function (e) {
      window.location.href = '0000/buy';
  });

  $('.closeScreen').on('click', function (e) {
      window.location.href = '/';

  });
  //

});

    </script>
@endsection
