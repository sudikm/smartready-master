@extends('layout')

@section('style')
    <style>
        .customBox {
            border: 0;
            outline: 0;
            color: #000;
            border-bottom: 1px solid #9e9e9e;
            border-radius: 0;
            padding: 0 !important;
            margin: 0 0 0px 0;
            box-shadow: none;
            font-weight: 200;
            width: 500px;
            height: 80px;
            position:absolute;
            top: 10% !important;
            text-align: center;
            font-size: 70px;
            font-family: Aktiv Grotesk W01 Hairline;
            border-bottom: none;
        }
        .menuTitle {
            position: absolute;
            width: 500px;
            text-align: center;
            top: 50px;
            font-family: 'Aktiv Grotesk W01 Hairline';
            font-size: 30px;
            top:20%;
            cursor: pointer;
        }

        a {
            color: #000;
        }
        


    </style>

@endsection

@section('content')

    <div id="loader" style="width: 100%; height: 100%; position: absolute; background: #fff; z-index: 999; display: none;">
        <div class="tableWrapper">
            <div class="tableContainer">
                <div class="content">
                    
                    <video width="100px" height="100px" autoplay="" loop="">
                        <source src="../assets/video/loading_circle.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                
                </div>
            </div>
        </div>

    </div>


    <div id="swapPage" style="width: 100%; height: 100%; position: absolute; z-index:99; ">
        <div class="closeScreen"><img width="30px" src="../assets/images/x_close.png"></div>

        <div style="width: 100%; height: 100%;   align-items: center; justify-content: center; text-align: center; font-family: 'Aktiv Grotesk W01 Hairline';">

            <div style="position: absolute; top: 50%; margin-top: -50px; text-align: center; width: 100%;">
                <div style="font-size: 50px; width: 100%; text-align: center;">
                    {{--<span style="cursor: pointer; font-weight: 800;" id="gotobusiness">--}}
                    {{--<span style="cursor: pointer;" id="gotoconsumer">--}}
                    
                    
                    <a href="" {{--style="cursor: pointer; font-weight: 800;"--}} id="gotoconsumer">Consumer</a>{{--</span>--}} or 
                    
                    <a href="" {{--style="cursor: pointer; font-weight: 800;"--}} id="gotobusiness">Business</a>{{--</span>--}} 
                </div>
     
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        
        
       
        
        $('#gotobusiness').on('click', function (e) {
            console.log($(this).attr('id'));
            var current_id = $(this).attr('id');
            var stored_id = sessionStorage.getItem('page');
            if(current_id != stored_id){    
                $("#swapPage").fadeOut(300, function () {
                    $("#loader").fadeIn(300, function () {
                         $("#loader").delay(500).fadeOut(300, function () {
                             window.location.href = '/business';
                         });
                    });
                });
                
                e.preventDefault(e); 
            }else{
                window.location.href = '/business';
                return false;
            }
        });
        
        $('#gotoconsumer').on('click', function (e) {
            var current_id = $(this).attr('id');
            var stored_id = sessionStorage.getItem('page');
            if(current_id != stored_id){
                $("#swapPage").fadeOut(300, function () {
                    $("#loader").fadeIn(300, function () {
                         $("#loader").delay(500).fadeOut(300, function () {
                             window.location.href = '/';
                         });
                    });
                });
                
                e.preventDefault(e); 
            }else{
                window.location.href = '/';
                return false;
            }
        });
        
         
        
        $('.closeScreen').on('click', function (e) {
            var page = sessionStorage.getItem('page');
            if(page == 'gotoconsumer'){
                window.location.href = '/';
            }
            if(page == 'gotobusiness'){
                window.location.href = '/business';
            }
            e.preventDefault(e); 
        });
        
        
        $(function () {
            var id = sessionStorage.getItem('page');
            if(id == null){
                $('#gotoconsumer').css({ "cursor": "pointer", "font-weight": "800" });
            }else{
                $('#'+id).css({ "cursor": "pointer", "font-weight": "800" });
            }
            // $('#helpText').focus();
            // $('#helpPage').on('click', function (e) {
            //     if(e.target.id != 'helpText' && e.target.id != 'emergencyLogin' && e.target.id != 'questionText' && e.target.id != 'gotobusiness' && e.target.id != 'gotoconsumer'){
            //         window.location.href = '/';
            //     }
            // });
            // $('#gotoconsumer').hover(function () {
            //     $(this).css({ "cursor": "pointer", "font-weight": "800" });
            // });
            //
            // $('#gotobusiness').hover(function () {
            //     $(this).css({ "cursor": "pointer", "font-weight": "800" });
            // });
        });
        
        
         $(document).ready(function() {
            $('video').prop('muted',true).play()
         });

    </script>
@endsection
