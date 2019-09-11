@extends('layout')

@section('title', ' | Business')


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
            <div id="topBarSwap" class="gotoConsumer">Swap to Consumer</div>
            <div id="topBarOpenMenu" class="openMenu">MORE</div>
        </div>




        <div id="menuFade">
            <div class="tableWrapper">
                <div class="tableContainer">
                        <div id="menuCloseFade" style="position: fixed; width: 100%; height: 100%;  display: none;  top: 0; background: #fff; opacity: 1;">
                            <div id="closeMenu" class="closeScreen"><img width="30px" src="../assets/images/x_close.png"></div>
                        </div>

                        <ul>
                            <li class="gotoBusiness" style="font-weight: bold;">Business</li>
                            <li class="gotoConsumer">Consumer</li>
                            <li class="gotoRegister">Register</li>

                            <li>Downloads</li>
                            <li>Help    </li>
                        </ul>

                    </div>
            </div>
        </div>


<div id="containerAnimate">

            <div id="navigation">
                <div id="openMenu"><img src="../assets/images/dot_menu.png"></div>
                <ul>
                    <li class="gotoRegister">REGISTER</li>
                    <!--<li class="gotoSwap">BUSINESS</li>-->
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
                            Why<br/>
                            Download<br/>
                            Submit Declaration<br/>
                            Who can get Smart?<br/>
                            Get to know us<br/>
                            App<br/>
                            Fitt Show<br/>
                            Get Ready<br/>
                            Standards<br/>
                            Minimum Requirements<br/>
                            Point of Sale<br/>
                            Sell more

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
                    <li class="gotoRegister pointer">Register</li>
                    <li class="gotoConsumer pointer">Consumer</li>
                    <li class="pointer">Downloads</li>
                    <li class="pointer">Help</li>
                </ul>
            </div>

</div><!--containerAnimate-->
    </div> <!-- page container -->
@endsection

@section('script')
    <script type="text/javascript">

      $(function () {


        $(".gotoRegister").click(function () {
            window.location.href = 'register';
        });




        $(".gotoConsumer").click(function () {
            $("#loadingScreen").fadeIn(500, function(){
              setTimeout(function(){
                  window.location.href = '/';
              }, 1000);
          });
        });

        $(".gotoBusiness").click(function () {
            window.location.href = '/business';
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



        $('#navigationButton').on('click', function(){
            localStorage.setItem('register', 'true');
        });


        sessionStorage.setItem('page', 'gotobusiness');

        })


        $(document).ready(function() {
           $('video').prop('muted',true).play()
        });








    </script>
@endsection
