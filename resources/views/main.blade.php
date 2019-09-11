@extends('layout')

@section('style')
@endsection

@section('content')

<div id="loadingScreen" style="width: 100%; height: 100%; position: fixed; z-index: 99; background: #fff; display: none;">
  <div class="tableWrapper">
    <div class="tableContainer">
      <video width="100px" height="100px" autoplay="" loop="">
          <source src="../assets/video/loading_circle.mp4" type="video/mp4">
      </video>
    </div>
  </div>
</div>


<div id="pageContainer">
<div id="topBarClose"></div>

  <div id="topBarSelect">
      <div id="closeTopBar" class="closeScreen"><img width="30px" src="../assets/images/x_close.png"></div>
      <div id="topBarSwap" class="gotoBusiness">Swap to Business</div>
      <div id="topBarOpenMenu" class="openMenu">MORE</div>
  </div>



    <div id="menuFade">
        <div class="tableWrapper">
            <div class="tableContainer">

                    <div id="menuCloseFade" style="position: fixed; width: 100%; height: 100%;  display: none;  top: 0; background: #fff; opacity: 1;">
                        <div id="closeMenu" class="closeScreen"><img width="30px" src="../assets/images/x_close.png"></div>
                    </div>

                    <ul>
                        <li class="gotoConsumer" style="font-weight: bold; ">Consumer</li>
                        <li class="gotoBusiness">Business</li>
                        <li class="gotoApp">App</li>
                        <li class="gotoSearch">Search</li>

                        <li>Downloads</li>
                        <li>Help </li>
                    </ul>
                </div>
        </div>
    </div>






<!--<div id="fullPage">-->

  <div id="alertDownloadApp" class="alertContainer">
    <div class="tableWrapper">
        <div class="tableContainer">
          <div class="alertBG"></div>
          <div class="alertCustom">
              <p>Download app to scan <br>Smart Ready &reg; QR label.</p>
              <button>OK</button>
          </div>
        </div>
    </div>
  </div>






    <div id="containerAnimate">

        <div id="navigation">
            <div id="openMenu"><img src="../assets/images/dot_menu.png"></div>

            <ul id="rightnavigation">

                <li class="gotoApp">APP</li>
                <li class="gotoSearch">SEARCH</li>
              <!--  <li class="gotoSwap">CONSUMER</li>-->
            </ul>
        </div><!--end navigation -->


        <div id="homePage" class="tableWrapper">
            <div class="tableContainer">

                    <img src="assets/images/smartready_logo_text.png"/>


            </div>
        </div>



        <div class="subPage tableWrapper">
            <div class="tableContainer">

                    <p>
                        Why? <br/>
                        Confused?<br/>
                        Advantages<br/>
                        Activate<br/>
                        Activate Smart<br/>
                        You ready?<br/>
                        Why Ready?<br/>
                        Switch<br/>
                        QR Code<br/>
                        Smart is Coming

                    </p>
            </div>
        </div>




        <div class="subPage tableWrapper">
            <div class="tableContainer">
                    <p><a href="register">Switch</a></p>
            </div>
        </div>



        <div class="subPage tableWrapper">
            <div class="tableContainer">
                <p>Who can get Smart?</p>
            </div>
        </div>




        <div class="subPage tableWrapper">
            <div class="tableContainer">
                <p>Get Ready</p>
            </div>
        </div>



        <div class="subPage tableWrapper">
            <div class="tableContainer">
                <p>Smart is Coming</p>
            </div>
        </div>





        <div id="footer">
            <div class="pointer" id="socialIcons"><img src="assets/images/social_icons.png" /></div>
            <ul>
                <li class="gotoApp pointer">App</li>
                <li class="gotoSearch pointer">Search</li>
                <li class="gotoBusiness pointer">Business</li>
                <li class="pointer">Downloads</li>
                <li class="pointer">Help</li>


            </ul>
        </div>


    </div><!-- container animate -->
</div> <!-- container page -->
<!--</div>-->
@endsection

@section('script')
<script type="text/javascript">

/*
    $(document).ready(function() {
        $('#fullPage').fullpage();
    });

*/


    $(function () {

      sessionStorage.setItem('page', 'gotoconsumer');


      $(".gotoApp").click(function () {
          $('#alertDownloadApp').fadeIn(fadeTime);
      });

      $(".gotoSearch").click(function () {
        window.location.href = '/search';
      });

      $(".gotoBusiness").click(function () {
          $("#loadingScreen").fadeIn(500, function(){
            setTimeout(function(){
                window.location.href = '/business';
            }, 1000);
        });
      });

      $(".gotoConsumer").click(function () {
          window.location.href = '/';
      });

      $(".alertBG").click(function () {
          $('.alertContainer').fadeOut(fadeTime);
      });



      $('#alertDownloadApp button').on('click', function (e) {
          window.location.href = 'app';
          e.preventDefault(e);
          return false;
      });




      $('#openMenu').click(function() {
        $("#menuFade, #menuCloseFade").delay(100).fadeIn(300);
        //$("#topBarClose").show();

      });

      $('#closeTopBar, #topBarClose').click(function() {
        $("#topBarClose").hide();
        $("#topBarSelect").delay(100).fadeOut(300);
      });


      $('#topBarOpenMenu').click(function() {
        $("#topBarClose").hide();
          $("#menuCloseFade, #menuFade").delay(100).fadeIn(300, function(){
            $("#topBarSelect").hide();
          });
      });

      $('#menuCloseFade').click(function() {
          $("#menuCloseFade, #menuFade").fadeOut(300);

      });

    });

    $(document).ready(function() {
       $('video').prop('muted',true).play()
    });

</script>
@endsection
