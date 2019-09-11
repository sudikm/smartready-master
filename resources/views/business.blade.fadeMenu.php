@extends('layout')

@section('style')
@endsection

@section('content')
    <div id="pageContainer">



        <div id="menuFade">
            <div class="tableWrapper">
                <div class="tableContainer">
                        <div id="menuCloseFade" style="position: fixed; width: 100%; height: 100%;  display: none;  top: 0; background: #fff; opacity: 1;">
                            <div id="closeMenu" class="closeScreen"><img width="30px" src="../assets/images/x_close.png"></div>
                        </div>

                        <ul>
                            <li class="gotoRegister">Register</li>
                            <li class="gotoConsumer">Consumer</li>
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
                    <li class="gotoSwap">BUSINESS</li>
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
            window.location.href = '/';
        });


        $('#openMenu').click(function() {
          $("#menuCloseFade, #menuFade").delay(100).fadeIn(300);
        });

        $('#menuCloseFade').click(function() {
            $("#menuCloseFade, #menuFade").fadeOut(300);
        });



        $('#navigationButton').on('click', function(){
            localStorage.setItem('register', 'true');
        });


        sessionStorage.setItem('page', 'gotobusiness');

        })










    </script>
@endsection
