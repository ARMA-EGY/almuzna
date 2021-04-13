@if (LaravelLocalization::getCurrentLocale() == 'ar')
    @php
    $dir   = 'rtl';
    $text  = 'text-right';
    $inverse_text  = 'text-left';
    $lang  = 'ar';
    @endphp
@elseif (LaravelLocalization::getCurrentLocale() == 'en')  
    @php
    $dir    = 'ltr';
    $text   = '';
    $inverse_text  = 'text-right';
    $lang   = 'en';
    @endphp
@endif

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- Required meta tags -->

    <meta content='' name='current_path' />

    <meta property="og:site_name"     content="ALMUZNA"/>

    <meta property="og:type"          content="website" />
    <meta property="og:url"           content="{{request()->getHost()}}/{{request()->path()}}" />
    <meta property="og:title"         content="ALMUZNA WATER" />
    <meta property="og:description"   content="" />
    <meta property="og:image"         content="{{asset('storage/images/logo.png')}}" />
    <meta property="og:image:width" content="512" />
    <meta property="og:image:height" content="512" />

    

    <!--===============================================================================================-->	
    <link rel="icon" type="image/png" href="{{ asset('/images/favicon.png') }}"/>
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">

    <!-- Author Meta -->
    <meta name="author" content="ARMA SOFTWARE">


    <!-- meta character set -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@isset($seo) @if($seo->title != '') {{$seo->title}} @else ALMUZNA @endif @else ALMUZNA @endisset</title>

    
    <!-- Template CSS -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Montserrat:300,400,500,600,700|Merriweather:300,400,300i,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('front_assets/css/bootstrap.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('front_assets/css/dark.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('front_assets/css/swiper.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('front_assets/style.css')}}" type="text/css" />

	<!-- shop Demo Specific Stylesheet -->
	<link rel="stylesheet" href="{{ asset('front_assets/demos/shop/shop.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('front_assets/demos/shop/css/fonts.css')}}" type="text/css" />
	<!-- / -->

	<link rel="stylesheet" href="{{ asset('front_assets/css/font-icons.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('front_assets/css/animate.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('front_assets/css/magnific-popup.css')}}" type="text/css" />

    <!-- Fonts -->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    @if (LaravelLocalization::getCurrentLocale() == 'ar')
	    <link rel="stylesheet" href="{{ asset('front_assets/style-ar.css')}}" type="text/css" />
    @endif

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    @yield('style')

</head>
<body class="stretched">

<form class="visits_form mb-0">
    @csrf
    <input type="hidden" name="ip" value="{{Request::ip()}}">
    <input type="hidden" name="page_token" value="@isset($page_token){{$page_token}}@endisset">
</form>

        <div id="wrapper" class="clearfix">

                <!-- Login Modal -->
                <div class="modal1 mfp-hide {{$text}}" id="modal-register" dir="{{ $dir }}">
                    <div class="card mx-auto" style="max-width: 540px;">
                        <div class="card-header py-3 bg-transparent center">
                            <h3 class="mb-0 font-weight-normal">{{__('core.LOGIN')}}</h3>
                        </div>
                        <div class="card-body mx-auto py-5" style="max-width: 70%;">

                            <h4 class="mb-3 text-center">{{__('core.LOGIN-WITH-PHONE')}}</h4>
                            

                    
                                <div class="col-12">
                                    <input type="number" id="get-code-form-number" name="get-code-form-number" value="" class="form-control phn not-dark" placeholder="05x-xxx-xxxx" pattern="[0-9]{11}"  maxlength="11">
                                </div>

                                <div class="col-12">
                                    <a href="#" class="text-dark font-weight-light mt-2"><small>{{__('core.ACCEPTS-SAUDI-ONLY')}}</small></a>
                                </div>

                                <div class="col-12 mt-4">
                                    <button class="button btn-block m-0" id="get-code-form-submit">Get Code</button>
                                </div>
                            
                 


                                <div class="col-12">
                                    <input type="text" id="vcode-form-vcode" name="vcode-form-vcode" value="" class="form-control not-dark" placeholder="verfication code">
                                </div>

                                <div class="col-12">
                                    <a href="#" class="text-dark font-weight-light mt-2"><small>A code was sent to your phone</small></a>
                                </div>

                                <div class="col-12 mt-4">
                                    <button class="button btn-block m-0" id="vcode-form-submit">Verify</button>
                                </div> 

                        </div>
                        <div class="card-footer py-4 center">
                            
                        </div>
                    </div>
                </div>

                <!-- Header
                ============================================= -->
                <header id="header" class="full-header header-size-md" dir="{{ $dir }}">
                    <div id="header-wrap">
                        <div class="container">
                            <div class="header-row justify-content-lg-between">

                                <!-- Logo
                                ============================================= -->
                                <div id="logo" class="mr-lg-4">
                                    <a href="{{route('welcome')}}" class="standard-logo"><h3 class="mb-0" style="color: #034fa2;">ALMUZNA</h3></a>
                                    <a href="{{route('welcome')}}" class="retina-logo"><img src="{{ asset('storage/'.$logo->logo) }}"></a>
                                </div><!-- #logo end -->

                                <div class="header-misc">

                                    <div class="top-links" dir="ltr">
                                        <ul class="top-links-container">
                                            @if (LaravelLocalization::getCurrentLocale() == 'ar')
                                                    <li class="top-links-item"><a href="#"><img class="icon" src="{{ asset('front_assets/images/icons/flags/ar.png')}}" alt="Arabic"> AR</a>
                                                        <ul class="top-links-sub-menu">
                                                            <li class="top-links-item"><a href="#"><img src="{{ asset('front_assets/images/icons/flags/ar.png')}}" alt="Arabic"> Arabic</a></li>
                                                            <li class="top-links-item"><a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}"><img src="{{ asset('front_assets/images/icons/flags/en.png')}}" alt="English"> English</a></li>
                                                        </ul>
                                                    </li>
                                            @elseif (LaravelLocalization::getCurrentLocale() == 'en')  
                                                    <li class="top-links-item"><a href="#"><img class="icon" src="{{ asset('front_assets/images/icons/flags/en.png')}}" alt="English"> EN</a>
                                                        <ul class="top-links-sub-menu">
                                                            <li class="top-links-item"><a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}"><img src="{{ asset('front_assets/images/icons/flags/ar.png')}}" alt="Arabic"> Arabic</a></li>
                                                            <li class="top-links-item"><a href="#"><img src="{{ asset('front_assets/images/icons/flags/en.png')}}" alt="English"> English</a></li>
                                                        </ul>
                                                    </li>
                                            @endif

                                            
                                        </ul>
                                    </div>

                                    <!-- Top Search
                                    ============================================= -->
                                    <div id="top-account">
                                        @if(isset($user))
                                        <a href="{{route('profile')}}" data-lightbox="inline" ><i class="icon-line2-user mx-1 position-relative" style="top: 1px;"></i><span class="d-none d-sm-inline-block font-primary font-weight-medium">
                                            {{$user['name']}}
                                        </span></a>    
                                        @else
                                        <a href="#modal-register" data-lightbox="inline" ><i class="icon-line2-user mx-1 position-relative" style="top: 1px;"></i><span class="d-none d-sm-inline-block font-primary font-weight-medium">
                                            {{__('core.LOGIN')}}
                                        </span></a>
                                        @endif
 
                                    </div>
                                    <!-- #top-search end -->

                                    <!-- Top Cart
                                    ============================================= -->
                                    <div id="top-cart" class="header-misc-icon ">
                                        <a href="#" id="top-cart-trigger"><img src="{{ asset('front_assets/images/cart.svg')}}" class="nav-icon"></a>
                                        <div class="top-cart-content {{$text}}" dir="{{$dir}}">
                                            <div class="top-cart-title">
                                                <h4> {{__('core.MY-CART')}}</h4>
                                            </div>
                                            <div class="top-cart-items">

                                                {{-- <div class="top-cart-item">
                                                    <div class="top-cart-item-image mx-2">
                                                        <a href="#"><img src="{{ asset('front_assets/demos/shop/images/items/4.png')}}"  /></a>
                                                    </div>
                                                    <div class="top-cart-item-desc">
                                                        <div class="top-cart-item-desc-title">
                                                            <a href="#">Water Bottle 1 Liter</a>
                                                            <div class=" d-flex justify-content-between align-items-center actions-section-cart">
                                                                <i class="fa main-color pointer stepper_down fa-trash-alt text-danger remove_item"></i>
                                                                <p class="quantity m-0">1</p>
                                                                <i class="fa fa-plus main-color pointer stepper_up"></i>
                                                            </div>
                                                            <span class="top-cart-item-price d-block">35.00 {{__('core.SAR')}}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="top-cart-item">
                                                    <div class="top-cart-item-image mx-2">
                                                        <a href="#"><img src="{{ asset('front_assets/demos/shop/images/items/1.png')}}"  /></a>
                                                    </div>
                                                    <div class="top-cart-item-desc">
                                                        <div class="top-cart-item-desc-title">
                                                            <a href="#">Water Bottle 500ml</a>
                                                            <div class=" d-flex justify-content-between align-items-center actions-section-cart">
                                                                <i class="fa main-color pointer stepper_down fa-minus"></i>
                                                                <p class="quantity m-0">2</p>
                                                                <i class="fa fa-plus main-color pointer stepper_up"></i>
                                                            </div>
                                                            <span class="top-cart-item-price d-block">30.00 {{__('core.SAR')}}</span>
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                <img src="{{ asset('front_assets/images/empty-cart.svg')}}" alt="Image" class="mb-0">
                                                <h4 class="text-center mt-4">{{__('core.EMPTY-CART')}}</h4>

                                            </div>
                                            <div class="top-cart-action justify-content-center">
                                                <a href="{{route('products')}}" class="button button-3d button-small m-0">{{__('core.GO-SHOPPING')}}</a>
                                            </div>
                                        </div>
                                    </div><!-- #top-cart end -->

                                </div>

                                <div id="primary-menu-trigger">
                                    <svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
                                </div>

                                <!-- Primary Navigation
                                ============================================= -->
                                <nav class="primary-menu with-arrows mx-lg-auto">

                                    <ul class="menu-container">
                                        <li class="menu-item {{request()->routeIs('welcome') ? 'current' : '' }}"><a class="menu-link" href="{{route('welcome')}}"><div><img src="{{ asset('front_assets/images/home.svg')}}" class="nav-icon"> {{__('core.HOME')}} </div></a></li>
                                        <li class="menu-item {{request()->routeIs('products') ? 'current' : '' }}"><a class="menu-link" href="{{route('products')}}"><div><img src="{{ asset('front_assets/images/products.svg')}}" class="nav-icon"> {{__('core.PRODUCTS')}} </div></a></li>
                                        <li class="menu-item {{request()->routeIs('coupons') ? 'current' : '' }}"><a class="menu-link" href="{{route('coupons')}}"><div><img src="{{ asset('front_assets/images/coupon.svg')}}" class="nav-icon"> {{__('core.COUPONS')}} </div></a></li>
                                        <li class="menu-item {{request()->routeIs('offers') ? 'current' : '' }}"><a class="menu-link" href="{{route('offers')}}"><div><img src="{{ asset('front_assets/images/offer.svg')}}" class="nav-icon"> {{__('core.OFFERS')}} </div></a></li>
                                        <li class="menu-item {{request()->routeIs('contact') ? 'current' : '' }}"><a class="menu-link" href="{{route('contact')}}"><div><img src="{{ asset('front_assets/images/contact.svg')}}" class="nav-icon"> {{__('core.CONTACT-US')}} </div></a></li>
                                    </ul>

                                </nav>
                                <!-- #primary-menu end -->


                            </div>
                        </div>
                    </div>
                    <div class="header-wrap-clone"></div>
                </header>
                <!-- #header end -->

                <!-- Main content -->
                <div class="">
                    @yield('content')
                </div>
                <!-- end: Main content -->

                <!-- Footer
                ============================================= -->
                <footer id="footer" class="bg-white border-0">

                    <div class="container clearfix {{$text}}" dir="{{ $dir }}">

                        <!-- Footer Widgets
                        ============================================= -->
                        <div class="footer-widgets-wrap pb-3 border-bottom clearfix">

                            <div class="row">

                                <div class="col-lg-3 col-md-4">
                                    <div class="widget clearfix">
                                        
                                        <div class="footer_logo">
                                           <a href="{{route('welcome')}}"> <img src="{{ asset('storage/'.$logo->logo) }}" style="width: 200px;"></a>
                                        </div>
                                        <p>{{__('core.slug')}}</p>
                                        
                                    
                                    </div>
                                </div>
                                
                                <div class="col-lg-2 col-md-4 col-6 ">
                                    <div class="widget clearfix">

                                        <h4 class="ls0 mb-3 nott">{{__('core.LINKS')}}</h4>

                                        <ul class="list-unstyled iconlist ml-0">
                                            <li><a href="{{route('welcome')}}">{{__('core.HOME')}}</a></li>
                                            <li><a href="{{route('products')}}">{{__('core.PRODUCTS')}}</a></li>
                                            <li><a href="{{route('offers')}}">{{__('core.OFFERS')}}</a></li>
                                            <li><a href="{{route('coupons')}}">{{__('core.COUPONS')}}</a></li>
                                            <li><a href="{{route('contact')}}">{{__('core.CONTACT-US')}}</a></li>
                                        </ul>

                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="widget clearfix">

                                            <h4 class="ls0 mb-3 nott">{{__('core.CONTACT-INFO')}}</h4>
                                            
                                            <ul class="contact_info">
                                                <li>
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <p>{{__('core.address')}}</p>
                                                </li>
                                                <li>
                                                    <i class="fas fa-envelope"></i>
                                                    <a href="mailto:{{__('core.email')}}">{{__('core.email')}}</a>
                                                </li>
                                                <li>
                                                    <i class="fas fa-mobile-alt"></i>
                                                    <p dir="ltr">{{__('core.phone')}}</p>
                                                </li>
                                            </ul>

                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 m-auto">
                                    <div class="widget clearfix">

                                        <h4 class="ls0 mb-3 nott">{{__('core.app-three')}}</h4>
                                        <div class="d-flex justify-content-between">
                                            <a href="#" >
                                                <img src="{{ asset('front_assets/images/app_store.svg')}}" class="appleStore" alt="apple store logo">
                                            </a>
                                            <a href="#" target="blank">
                                                <img src="{{ asset('front_assets/images/play_store.svg')}}" alt="google play logo">
                                            </a>
                                        </div>
                                        <h4 class="text-center mt-3">{{__('core.FOLLOW-US')}}</h4>
                                        <div class="bottommargin-sm clearfix d-flex justify-content-center">

                                            @foreach ($socials as $social)
                                                @if ($social->platform == 'Facebook' && $social->off == 1)
                                                    <a href="{{$social->link}}" target="_blank" class="social-icon si-dark si-mini si-rounded si-facebook mx-3" title="Facebook">
                                                        <i class="icon-facebook"></i>
                                                        <i class="icon-facebook"></i>
                                                    </a>
                                                @endif
                                                @if ($social->platform == 'Twitter' && $social->off == 1)
                                                    <a href="{{$social->link}}" target="_blank" class="social-icon si-dark si-mini si-rounded si-twitter mx-3" title="Twitter">
                                                        <i class="icon-twitter"></i>
                                                        <i class="icon-twitter"></i>
                                                    </a>
                                                @endif
                                                @if ($social->platform == 'Instagram' && $social->off == 1)
                                                    <a href="{{$social->link}}" target="_blank" class="social-icon si-dark si-mini si-rounded si-instagram mx-3" title="Instagram">
                                                        <i class="icon-instagram"></i>
                                                        <i class="icon-instagram"></i>
                                                    </a>
                                                @endif
                                                @if ($social->platform == 'Linkedin' && $social->off == 1)
                                                    <a href="{{$social->link}}" target="_blank" class="social-icon si-dark si-mini si-rounded si-linkedin mx-3" title="Instagram">
                                                        <i class="icon-linkedin"></i>
                                                        <i class="icon-linkedin"></i>
                                                    </a>
                                                @endif
                                                @if ($social->platform == 'Youtube' && $social->off == 1)
                                                    <a href="{{$social->link}}" target="_blank" class="social-icon si-dark si-mini si-rounded si-youtube mx-3" title="Instagram">
                                                        <i class="icon-youtube"></i>
                                                        <i class="icon-youtube"></i>
                                                    </a>
                                                @endif
                                                @if ($social->platform == 'Pinterest' && $social->off == 1)
                                                    <a href="{{$social->link}}" target="_blank" class="social-icon si-dark si-mini si-rounded si-pinterest mx-3" title="Instagram">
                                                        <i class="icon-pinterest"></i>
                                                        <i class="icon-pinterest"></i>
                                                    </a>
                                                @endif
                                                @if ($social->platform == 'Telegram' && $social->off == 1)
                                                    <a href="{{$social->link}}" target="_blank" class="social-icon si-dark si-mini si-rounded si-instagram mx-3" title="Instagram">
                                                        <i class="icon-telegram"></i>
                                                        <i class="icon-telegram"></i>
                                                    </a>
                                                @endif
                                            @endforeach

                                            

                                            

                                            
                                            
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div><!-- .footer-widgets-wrap end -->

                    </div>

                    <!-- Copyrights
                    ============================================= -->
                    <div class="bg-dark py-2">
                        <div class="container">
                        <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="text-center">
                                <p class="text-center mb-0 pb-0" style="font-weight: bold;font-size: 12pt;color: #fff;font-family: Raleway, sans-serif;padding: 10px 0;">Powered By 
                                    <a href="https://armasoftware.com/">
                                        <img width="70" class="lazy img-loaded" src="https://armasoftware.com/arma_logo.png" data-src="https://armasoftware.com/arma_logo.png"> 
                                    </a>
                                </p>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                    <!-- #copyrights end -->

                </footer>
                <!-- #footer end -->

        </div>

        <!-- Go To Top
        ============================================= -->
        <div id="gotoTop" class="icon-line-arrow-up"></div>


        <!--Plugins-->
        <script src="{{ asset('front_assets/js/jquery.js')}}"></script>
        <script src="{{ asset('front_assets/js/plugins.min.js')}}"></script>
        <script type="application/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

        <!--Template functions-->
        <script src="{{ asset('front_assets/js/functions.js')}}"></script>

        <!-- The core Firebase JS SDK is always required and must be listed first -->
        <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>

        <!-- TODO: Add SDKs for Firebase products that you want to use
             https://firebase.google.com/docs/web/setup#available-libraries -->
        <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-analytics.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-auth.js"></script>

        <script>
          // Your web app's Firebase configuration
          // For Firebase JS SDK v7.20.0 and later, measurementId is optional
          var firebaseConfig = {
            apiKey: "AIzaSyCOg5dbhy1uQN2p0XUQaVfCISkrafwZI84",
            authDomain: "almuzna-water.firebaseapp.com",
            projectId: "almuzna-water",
            storageBucket: "almuzna-water.appspot.com",
            messagingSenderId: "301918006971",
            appId: "1:301918006971:web:07bda0880c7c8eff25439e",
            measurementId: "G-JC8937W2MN"
          };
          // Initialize Firebase
          firebase.initializeApp(firebaseConfig);
          firebase.analytics();
        </script>


        <script>
        window.onload = function() {     


        firebase.auth().languageCode = 'it';
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('get-code-form-submit', {
          'size': 'invisible',
          'callback': (response) => {
            // reCAPTCHA solved, allow signInWithPhoneNumber.

            console.log('aaaafff');
            onSignInSubmit();
          }
        });

  };



        $( "#get-code-form-submit" ).click(function()
        //function onSignInSubmit()
        {
            const phoneNumber = '+20-'+$('#get-code-form-number').val().substring(1).replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
            
            console.log(phoneNumber);
            const appVerifier = window.recaptchaVerifier;
            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                .then((confirmationResult) => {
                  // SMS sent. Prompt user to type the code from the message, then sign the
                  // user in with confirmationResult.confirm(code).
                  window.confirmationResult = confirmationResult;
                  alert("check your phone");
                  // ...
                }).catch((error) => {
                    console.log(error);
                  console.log("SMS not sent");
                });
        });





        $( "#vcode-form-submit" ).click(function()
        //function onSignInSubmit()
        {
            const code = $('#vcode-form-vcode').val();
            confirmationResult.confirm(code).then((result) => {
              // User signed in successfully.
              const user = result.user;
              console.log("phone number verfied");

                $.ajax({
                url:        "{{route('loginuser')}}",
                method:     'GET',
                dataType:   'text',
                data: {countryCode:'+996',
                    phone:$('#get-code-form-number').val()}   ,
                success : function(response)
                         {
                            if(response == 'failure')
                            {
                                alert('Oops Something went wrong');
                            }else if (response == 'success'){
                                console.log('redirect to home');
                                window.location.replace("{{route('welcome')}}");
                            }
                         }
            });
              // ...
            }).catch((error) => {
              console.log(error);
              console.log("bad verification code?");
            });
        });


        </script>



        <script>
            $.ajax({
				url: 		"{{route('visits')}}",
				method: 	'POST',
				dataType: 	'text',
				data:		$('.visits_form').serialize()	,
				success : function(response)
						 {}
			});

            $('.contact_form').submit(function(e)
            {
                e.preventDefault();
                $('.submit').prop('disabled', true);
                $('.error').text('');

                var head1 	= 'Thank You';
                var title1 	= 'Your Message Has Been Sent Successfully, We will contact you ASAP. ';
                var head2 	= 'Oops...';
                var title2 	= 'Something went wrong, please try again later.';

                $.ajax({
                    url: 		"{{route('message')}}",
                    method: 	'POST',
                    dataType: 	'json',
                    data:		$(this).serialize()	,
                    success : function(data)
                        {
                            $('.submit').prop('disabled', false);
                            
                            if (data['status'] == 'true')
                            {
                                Swal.fire(
                                        head1,
                                        title1,
                                        'success'
                                        )
                                $('.field').text('');
                                $('.field').val('');
                            }
                            else if (data['status'] == 'false')
                            {
                                Swal.fire(
                                        head2,
                                        title2,
                                        'error'
                                        )
                            }
                        },
                        error : function(reject)
                        {
                            $('.submit').prop('disabled', false);

                            var response = $.parseJSON(reject.responseText);
                            $.each(response.errors, function(key, val)
                            {
                                Swal.fire(
                                        head2,
                                        val[0],
                                        'error'
                                        )
                            });
                        }
                    
                    
                });

            });


        </script>

        @yield('script')

</body>
</html>
