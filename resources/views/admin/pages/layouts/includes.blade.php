<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="ARMA Software" />
    <meta name="description" content="EBE Website Template One">
    <link rel="icon" type="image/png" href="{{asset('images/favicon.png')}}">   
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Document title -->
    <title>Admin - Dashboard</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Stylesheets & Fonts -->
    <link href="{{asset('css/plugins.css')}}" rel="stylesheet">
    @yield('style')
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/timeline.min.css')}}" rel="stylesheet">

    <!-- Font Style -->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>


<body>
    <!-- Body Inner -->
    <div class="body-inner">
        <!-- Header -->
        
        <header class="switcher-bar clearfix">

            <div class="container">
                <div class="product-switcher d-inline-block">
                    
                    @foreach ($pages as $page)
                        @if (request()->is('pages/'.$page->link))
                            <a href="#" class="main" title="Current Page"> {{$page->name}} </a>
                        @endif
                    @endforeach

                    <div class="switcher">
                        <div class="switcher-body">
                            @foreach ($pages as $page)
                                <a href="/pages/{{$page->link}}" class="page-route {{request()->is('pages/'.$page->link) ? 'current' : '' }}" title="Select Page"> {{$page->name}} </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            
                <div class="remove-btn header-btn float-right">
                <a href="#" title="Close this bar" class="fa fa-times"></a>
                </div>
            </div>
            
        </header>

        <style>

            .page-frame {
                display: block!important;
                height: 100%;
                margin: 0 auto;
                max-width: 100%;
                width: 100%;
                -webkit-transform: translateZ(0);
                transition: all 0.3s linear;
                }
            
            .toggle .switcher-body {
                border-bottom: 1px solid #333333;
                border-top: 1px solid #333333;
                min-height: 215px;
                padding: 10px 25px;
                overflow: auto;
            }

            .switcher-body {
                background: #3A3A3A;
                height: 0;
                overflow: hidden;
                padding: 0;
                position: relative;
                -webkit-transition: all .3s linear;
                -moz-transition: all .3s linear;
                -o-transition: all .3s linear;
                -ms-transition: all .3s linear;
                transition: all .3s linear;
                z-index: 20;
            }

            .switcher-bar {
                background: #333;
                border-bottom: 1px solid #444;
                max-height: 50px;
                position: fixed;
                z-index: 22;
                width: 100%;
            }
            
            .product-switcher {
                position: relative;
                background: #222;
            }
            
            .product-switcher .main:before {
            content: '+';
            left: 20px;
            position: absolute;
            top: 4px;
            }

            .product-switcher .main {
                color: #9b9b9b;
                display: block;
                font-size: 16px;
                font-weight: 400;
                line-height: 40px;
                max-height: 50px;
                padding: 5px 40px;
                text-decoration: none;
                text-transform: uppercase;
                position: relative;
                width: 300px;
                text-align: center;
            }

            .product-switcher .page-route {
                color: #9b9b9b;
                display: block;
                font-size: 13px;
                font-weight: 500;
                line-height: 32px;
                max-height: 50px;
                padding: 2px 10px;
                text-decoration: none;
                text-transform: uppercase;
                position: relative;
                width: 200px;
                text-align: left;
            }

            .page-route.current
            {
                background: #38c;
                color: #fff;
                border-radius: 10px;
            }

            .page-route:hover
            {
                background: #fff;
                color: #000;
                border-radius: 10px;
            }
            
            .header-btn {
                position: relative;
            }
            
            .header-btn a {
                border-left: 1px solid #444;
                display: block;
                font-size: 18px;
                height: 50px;
                padding: 0;
                width: 50px;
                text-decoration: none;
            }
            
            .header-btn a:before {
            color: #9b9b9b;
            left: 18px;
            position: absolute;
            top: 18px;
            }

            .header-btn a:hover, .header-btn.current a {
                background: #222;
                text-decoration: none;
            }

            .header-btn a:hover:before, .header-btn.current a:before {
                color: #fff;
            }
        </style>


  <!-- Content Wrapper. Contains page content -->


                         @yield('content')
 

  <!-- /.content-wrapper -->


 
        <section class="background-colored text-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="widget widget-newsletter mb-0">
                            <form class="widget-subscribe-form" action="include/subscribe-form.php" role="form" method="post" novalidate="novalidate">
                                <h3 class="text-light">Subscribe to our Newsletter</h3>

                                <div class="input-group mb-0">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-paper-plane"></i></span>
                                    </div>
                                    <input type="email" required name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email">

                                    <div class="input-group-append">
                                        <button type="submit" id="widget-subscribe-submit-button" class="btn btn-inverse">Subscribe</button>
                                    </div>

                                </div>

                                <small class="text-light">Stay informed on our latest news!</small>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end: Subscribe form -->

        <!-- Footer -->
        <footer id="footer" class="inverted">
            <div class="footer-content">
                <div class="container">
                    <div class="row">
                        
                        <div class="col-lg-4">
                            <div class="widget">
                                <h4 ><i class="fa fa-envelope"></i> GET IN TOUCH</h4>
                                <form class="contact_form" novalidate action="" role="form" method="post">
                                    @csrf
                                    <small id="name_error" class="form-text text-danger error"></small>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                        </div>
                                        <input type="text" aria-required="true" name="name" class="form-control required name field" placeholder="Enter your Name" required>
                                    </div>
                                    <small id="email_error" class="form-text text-danger error"></small>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                                        </div>
                                        <input type="email" aria-required="true" name="email" class="form-control required email field" placeholder="Enter your Email" required>
                                    </div>
                                    <small id="message_error" class="form-text text-danger error"></small>
                                    <div class="form-group mb-2">
                                        <textarea type="text" name="message" rows="5" class="form-control required field" placeholder="Enter your Message" required></textarea>
                                    </div>
                                    <input type="hidden" name="subject" value="GET IN TOUCH">
                                    <div class="form-group">
                                        <button class="btn submit" type="submit" id="form-submit"><i class="fa fa-paper-plane"></i>&nbsp;Send message</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                        <div class="col-xl-2 col-lg-2 col-md-4 justify-content-center d-flex">
                            <!-- Footer widget area 1 -->
                            <div class="widget">
                                <h4>Main Menu</h4>
                                <ul class="list">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Services</a></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                            <!-- end: Footer widget area 1 -->
                        </div>

                        <div class="col-xl-3 col-lg-2 col-md-4 justify-content-center d-flex">
                            <!-- Footer widget area 2 -->
                            <div class="widget">
                                <h4>Solutions</h4>
                                <ul class="list">
                                <li><a href="#">POS E-Payment</a></li>
                                <li><a href="#">ATM</a></li>
                                <li><a href="#">Banking Personalization</a></li>
                                <li><a href="#">Security</a></li>
                                <li><a href="#">Cybersecurity</a></li>
                                </ul>
                            </div>
                            <!-- end: Footer widget area 2 -->
                        </div>
                        
                        <div class="col-lg-3  col-lg-2 col-md-4">
                            <!-- Footer widget area 1 -->
                            <div class="widget widget-contact-us text-center" style="background-image: url('{{ asset('images/world-map.png') }}'); background-position: 50% 20px; background-repeat: no-repeat">
                                <h4>About EBE</h4>
                                <ul class="list-icon text-light">
                                    <li><i class="fa fa-map-marker-alt"></i> 12 Lotfy Hassona St., Off Tahrir Street, Dokki, Giza, Egypt <br>
                                        </li>
                                    <li><i class="fa fa-phone"></i> (+20) 33383949 </li>
                                    <li><i class="far fa-envelope"></i> <a href="mailto:info@ebetech.com.eg">info@ebetech.com.eg</a> </li>
                                   
                                </ul>
                                <div class="widget">
                                    <h4>Follow Us</h4>
                                    <div class="social-icons social-icons d-flex">
                                        <ul class="m-auto">
                                        <li class="social-facebook"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li class="social-twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li class="social-instagram"><a href="#"><i class="fab fa-instagram"></i></a></li>
                                        <li class="social-linkedin"><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                    </div>
                            </div>
                            <!-- end: Footer widget area 1 -->
                        </div>

                    </div>
                </div>
            </div>
            
            <div class="copyright-content py-2">
                <div class="container">
                <div class="row">
               <div class="col-md-12 text-center">
                    <div class="copyright-footer text-center">
                        <p class="text-center mb-0 pb-0" style="font-weight: bold;font-size: 12pt;color: #fff;font-family: Raleway, sans-serif;padding: 10px 0;">Powered By 
                            <a href="https://armasoftware.com/">
                                <img width="70" class="lazy" src="{{asset('images/src-load.png')}}" data-src="https://armasoftware.com/arma_logo.png"> 
                            </a>
                        </p>
                    </div>
                </div>
                </div>
                </div>
            </div>
        </footer>
        <!-- end: Footer -->

        <!--========= Edit Component Modal =========-->
        <div id="edit_component_modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Edit</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <form class="update_component_form" data-target="">
                  @csrf           
                      <div class="modal-body" id="edit_component_body">
                          
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary submit_edit_form">Save </button>
                      </div>
          
                  </form>        
              </div>
            </div>
        </div>
          
        <!--========= Edit Card Modal =========-->
        <div id="edit_card_modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="update_card_form" data-target="">
                    @csrf           
                        <div class="modal-body" id="edit_card_body">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary submit_edit_form">Save </button>
                        </div>
            
                    </form>        
                </div>
            </div>
        </div>
        
        <!--========= Add Card Modal =========-->
        <div id="add_card_modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ADD Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="add_card_form" data-target="">
                    @csrf           
                        <div class="modal-body" id="add_card_body">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary submit_edit_form">Save </button>
                        </div>
            
                    </form>        
                </div>
            </div>
        </div>

        <!--========= Upload Photos Modal =========-->
        <div id="upload_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title">Upload</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    
                    <div class="modal-body" id="upload_body">
                        
                        <div class="form-row">
        
                            <div class="form-group col-md-12">
                            <label for="" class="font-weight-bold"><i class="fa fa-image"></i> Upload : </label>
                            </div>
        
                            <div class="bararea m-2">
                                <div class="bar"></div>
                            </div>
        
                            <div class="percent"></div>
                            <div class="status"></div> 
        
                        </div>
                        
                    </div>
                
            </div>
            </div>
        </div>



        
    </div>
    <!-- end: Body Inner -->
    <!-- Scroll top -->
    <a id="scrollTop"><i class="icon-chevron-up"></i><i class="icon-chevron-up"></i></a>
    <!--Plugins-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script type="application/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script src="{{asset('js/addons.js')}}"></script>

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/plugins.js')}}"></script>

    <script src="{{asset('js/functions.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="https://cdn.tiny.cloud/1/mq6umcdg6y938v1c32lokocdpgrgp5g2yl794h4y1braa6j6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });



        $('.remove-btn').click(function(){
            $(".switcher-bar").css({"display": "none"});
            $(".switcher").css({"display": "none"});
            $(".page-frame").css({"width": "100%"});
        });


        $('.product-switcher').click(function(){
            $('.switcher').toggleClass('toggle');
        });
        $('.mobile-btn').click(function(){
            $(".page-frame").css({"width": "480px"});
        });


        $('.tablet-btn').click(function(){
            $(".page-frame").css({"width": "768px"});
        });


        $('.desktop-btn').click(function(){
            $(".page-frame").css({"width": "100%"});
        });
        
        tinymce.init({
                selector:'textarea.content',
                plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            });
    </script>

    @yield('script')
    
</body>

</html>