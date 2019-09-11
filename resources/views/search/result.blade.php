@extends('layout')

@section('style')
    <style>
        .customBox {
          
            outline: 1;
            color: #000;
            border: none;
            border-radius: 30px;
            padding: 0 !important;
            margin: 0 0 0px 0;
            
            font-weight: 200;
            width: 800px;
            height: 80px;
            position:relative;
            margin-top: 80px !important;
            text-align: center;
            font-size: 70px;
            font-family: Aktiv Grotesk W01 Hairline;
           
        }
        
        
        #selectType {
            position: relative;
            margin-top: 30px;
        }
        
        .form-check-inline+.form-check-inline {
            margin-left: 100px;
        }
        
        .form-check-label {
            font-size: 20px;
        }
        
        ::-webkit-input-placeholder { /* WebKit, Blink, Edge */
            color:    #D3D3D3;
        }
        :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
           color:    #D3D3D3;
           opacity:  1;
        }
        ::-moz-placeholder { /* Mozilla Firefox 19+ */
           color:    #D3D3D3;
           opacity:  1;
        }
        :-ms-input-placeholder { /* Internet Explorer 10-11 */
           color:    #D3D3D3;
        }
        ::-ms-input-placeholder { /* Microsoft Edge */
           color:    #D3D3D3;
        }

        ::placeholder { /* Most modern browsers support this now. */
           color:    #D3D3D3;
        }
        
    </style>

@endsection

@section('content')
    <div id="searchPage" style="width: 100%; height: 100%; position: absolute; z-index:99; ">
        <div class="closeScreen"><img width="30px" src="/../assets/images/x_close.png"></div>

        <div class="tableWrapper">
            <div class="tableContainer">
                <div class="content">
                    
                    <div style="width: 100%; height: 100%; align-items: center; justify-content: center;  text-align: center; font-family: 'Aktiv Grotesk W01 Hairline';">
                    <h1 id="content"></h1>
                    <!-- <input type="text" id="searchCompany" class="searchBox" autofocus="autofocus" placeholder="Name">

                        
                      
              
                    <input class="searchBtn form-control-lg" type="button" name="Next" value="Next"> -->
                    
                    
                   
                                 


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $('#searchPage').focus();
        if(sessionStorage.getItem('redirect_msg')){
            $('#content').text(sessionStorage.getItem('redirect_msg'));
        }
        
        
        
        var sector = $("#select").val();
        $('#searchSelect .dropdown-toggle').html("Pin"); 
    
         
        $(".dropdown-menu .dropdown-item").click(function(){
          $(this).parents(".dropdown").find('.btn').html($(this).text() + ' <span class="selection"></span>');
          $(this).parents(".dropdown").find('.btn').val($(this).data('value'));
        });

            $('.dropdown-menu button').click(function(){
                $('#select').val($(this).html()); 
            });
    
        
        
        
        $('.closeScreen').on('click', function (e) {
            window.location.href = '/search';
            e.preventDefault(e); 
        });
            
        });
    </script>
@endsection