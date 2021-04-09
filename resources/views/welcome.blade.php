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

@extends('layouts.app')



@section('content')

		<!-- Slider
		============================================= -->
		<section id="slider" class="slider-element swiper_wrapper" data-autoplay="6000" data-speed="800" data-loop="true" data-grab="true" data-effect="fade" data-arrow="false">

			<div class="swiper-container swiper-parent">
				<div class="swiper-wrapper">

					<div class="swiper-slide dark">
						<div class="overlay" style="position: absolute;width: 100%;height: 100%;background: rgb(0 0 0 / 30%);z-index: 9;"></div>
						<div class="container">
							<div class="slider-caption slider-caption-center">
								<div>
									<h3 class="bottommargin-sm text-white">{{__('core.home-header-title')}}</h3>
									<div class="mb-4" style="font-size: 18px; font-family: sans-serif;">{{__('core.home-header-desc')}}</div>
									<a href="#products" class="button button-small bg-white button-light btn-line-fill">{{__('core.home-header-btn')}}</a>
								</div>
							</div>
						</div>
						<div class="swiper-slide-bg" style="background-image: url('{{ asset('front_assets/demos/shop/images/slider/1.jpg')}}');"></div>
					</div>

					<div class="swiper-slide dark">
						<div class="overlay" style="position: absolute;width: 100%;height: 100%;background: rgb(0 0 0 / 30%);z-index: 9;"></div>
						<div class="container">
							<div class="slider-caption slider-caption-center">
								<div>
									<h3 class="bottommargin-sm text-white">{{__('core.home-header-title')}}</h3>
									<div class="mb-4" style="font-size: 18px; font-family: sans-serif;">{{__('core.home-header-desc')}}</div>
									<a href="#products" class="button button-small bg-white button-light btn-line-fill">{{__('core.home-header-btn')}}</a>
								</div>
							</div>
						</div>
						<div class="swiper-slide-bg" style="background-image: url('{{ asset('front_assets/demos/shop/images/slider/2.jpg')}}');"></div>
					</div>

				</div>
				<div class="swiper-pagination"></div>
			</div>

			<div class="svg-separator">
				<div>
					<svg preserveAspectRatio="xMidYMax meet" viewBox="0 0 1600 100" data-height="100">
						<path style="opacity: 1;fill: rgba(255,255,255,0.75);" d="M1040,56c0.5,0,1,0,1.6,0c-16.6-8.9-36.4-15.7-66.4-15.7c-56,0-76.8,23.7-106.9,41C881.1,89.3,895.6,96,920,96
						C979.5,96,980,56,1040,56z"></path> <path style="opacity: 1;fill: rgba(255,255,255,0.75);" d="M1699.8,96l0,10H1946l-0.3-6.9c0,0,0,0-88,0s-88.6-58.8-176.5-58.8c-51.4,0-73,20.1-99.6,36.8 c14.5,9.6,29.6,18.9,58.4,18.9C1699.8,96,1699.8,96,1699.8,96z"></path> <path style="opacity: 1;fill: rgba(255,255,255,0.75);" d="M1400,96c19.5,0,32.7-4.3,43.7-10c-35.2-17.3-54.1-45.7-115.5-45.7c-32.3,0-52.8,7.9-70.2,17.8 c6.4-1.3,13.6-2.1,22-2.1C1340.1,56,1340.3,96,1400,96z"></path> <path style="opacity: 1;fill: rgba(255,255,255,0.75);" d="M320,56c6.6,0,12.4,0.5,17.7,1.3c-17-9.6-37.3-17-68.5-17c-60.4,0-79.5,27.8-114,45.2 c11.2,6,24.6,10.5,44.8,10.5C260,96,259.9,56,320,56z"></path> <path style="opacity: 1;fill: rgba(255,255,255,0.75);" d="M680,96c23.7,0,38.1-6.3,50.5-13.9C699.6,64.8,679,40.3,622.2,40.3c-30,0-49.8,6.8-66.3,15.8 c1.3,0,2.7-0.1,4.1-0.1C619.7,56,620.2,96,680,96z"></path> <path style="opacity: 1;fill: rgba(255,255,255,0.75);" d="M-40,95.6c28.3,0,43.3-8.7,57.4-18C-9.6,60.8-31,40.2-83.2,40.2c-14.3,0-26.3,1.6-36.8,4.2V106h60V96L-40,95.6
						z"></path>
						<path style="opacity: 1;fill: rgba(255,255,255,0.3);;" d="M504,73.4c-2.6-0.8-5.7-1.4-9.6-1.4c-19.4,0-19.6,13-39,13c-19.4,0-19.5-13-39-13c-14,0-18,6.7-26.3,10.4 C402.4,89.9,416.7,96,440,96C472.5,96,487.5,84.2,504,73.4z"></path> <path style="opacity: 1;fill: rgba(255,255,255,0.3);;" d="M1205.4,85c-0.2,0-0.4,0-0.6,0c-19.5,0-19.5-13-39-13s-19.4,12.9-39,12.9c0,0-5.9,0-12.3,0.1 c11.4,6.3,24.9,11,45.5,11C1180.6,96,1194.1,91.2,1205.4,85z"></path> <path style="opacity: 1;fill: rgba(255,255,255,0.3);;" d="M1447.4,83.9c-2.4,0.7-5.2,1.1-8.6,1.1c-19.3,0-19.6-13-39-13s-19.6,13-39,13c-3,0-5.5-0.3-7.7-0.8 c11.6,6.6,25.4,11.8,46.9,11.8C1421.8,96,1435.7,90.7,1447.4,83.9z"></path> <path style="opacity: 1;fill: rgba(255,255,255,0.3);;" d="M985.8,72c-17.6,0.8-18.3,13-37,13c-19.4,0-19.5-13-39-13c-18.2,0-19.6,11.4-35.5,12.8 c11.4,6.3,25,11.2,45.7,11.2C953.7,96,968.5,83.2,985.8,72z"></path> <path style="opacity: 1;fill: rgba(255,255,255,0.3);;" d="M743.8,73.5c-10.3,3.4-13.6,11.5-29,11.5c-19.4,0-19.5-13-39-13s-19.5,13-39,13c-0.9,0-1.7,0-2.5-0.1 c11.4,6.3,25,11.1,45.7,11.1C712.4,96,727.3,84.2,743.8,73.5z"></path> <path style="opacity: 1;fill: rgba(255,255,255,0.3);;" d="M265.5,72.3c-1.5-0.2-3.2-0.3-5.1-0.3c-19.4,0-19.6,13-39,13c-19.4,0-19.6-13-39-13 c-15.9,0-18.9,8.7-30.1,11.9C164.1,90.6,178,96,200,96C233.7,96,248.4,83.4,265.5,72.3z"></path> <path style="opacity: 1;fill: rgba(255,255,255,0.3);;" d="M1692.3,96V85c0,0,0,0-19.5,0s-19.6-13-39-13s-19.6,13-39,13c-0.1,0-0.2,0-0.4,0c11.4,6.2,24.9,11,45.6,11 C1669.9,96,1684.8,96,1692.3,96z"></path> <path style="opacity: 1;fill: rgba(255,255,255,0.3);;" d="M25.5,72C6,72,6.1,84.9-13.5,84.9L-20,85v8.9C0.7,90.1,12.6,80.6,25.9,72C25.8,72,25.7,72,25.5,72z"></path>
						<path style="fill: rgb(255, 255, 255);" d="M-40,95.6C20.3,95.6,20.1,56,80,56s60,40,120,40s59.9-40,120-40s60.3,40,120,40s60.3-40,120-40s60.2,40,120,40s60.1-40,120-40s60.5,40,120,40s60-40,120-40s60.4,40,120,40s59.9-40,120-40s60.3,40,120,40s60.2-40,120-40s60.2,40,120,40s59.8,0,59.8,0l0.2,143H-60V96L-40,95.6z"></path>
					</svg>
				</div>
			</div>
		</section>
        <!-- #Slider End -->
     

        <!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap pb-0">
				<div class="container clearfix">

					<!-- WHY CHOOSE US
					============================================= -->
					<div class="fancy-title title-border title-center mb-4">
						<h2>{{__('core.why-us')}}</h2>
					</div>

					<div class="content-103" dir="{{ $dir }}">
						<div class="container">
							<div class="row justify-content-center">
								
								<div class="col-lg-3">
									<div class="service-post">
										<div class="service-content">
											<div class="service-icon">
													<i class="fas fa-shipping-fast"></i>
											</div> <!-- service-icon -->
											<h3 class="service-title"><strong>{{__('core.why-one-title')}}</strong></h3>
											<p class="service-description">{{__('core.why-one-desc')}}</p>
										</div> <!-- service-content -->
										<div class="service-hover"></div>
									</div>
								</div>
								
								<div class="col-lg-3">
									<div class="service-post">
										<div class="service-content">
											<div class="service-icon">
												<i class="fas fa-certificate"></i>
											</div> <!-- .s-icon -->
											<h3 class="service-title"><strong>{{__('core.why-two-title')}}</strong></h3>
											<p class="service-description">{{__('core.why-two-desc')}}</p>
										</div> <!-- service-content -->
										<div class="service-hover"></div>
									</div>
								</div>
								
								<div class="col-lg-3">
									<div class="service-post">
										<div class="service-content">
											<div class="service-icon">
												<i class="fas fa-wallet"></i>
											</div> <!-- .s-icon -->
											<h3 class="service-title"><strong>{{__('core.why-three-title')}}</strong></h3>
											<p class="service-description">{{__('core.why-three-desc')}}</p>
										</div> <!-- service-content -->
										<div class="service-hover"></div>
									</div>
								</div>
								
							</div>
						</div>
					</div>


				</div>

				<!-- Delivery Service
				============================================= -->
				<div class="section my-4 pb-0" dir="{{ $dir }}" style="background: url({{ asset('front_assets/images/bg-t.png')}}) no-repeat center bottom / 100%;background-color: #0F66DD !important;overflow: visible;">
					<div class="container">

						<div class="row align-items-stretch">

							<div class="col-md-7">

								<div class="fancy-title title-border title-center mb-4">
									<h2 class="text-white">{{__('core.delivery-service-title')}}</h2>
								</div>

								<div class="row">
									<div class="col-md-12 center pt-3 px-5">
										<div class="heading-block mb-1 border-bottom-0 mx-auto">
											<div class="text-white mb-1">{{__('core.delivery-service-desc')}}</div>
											
											<div class="wpb_wrapper">
												<ul class="check my-5 {{$text}}">
													<li><i class="fa fa-check-circle text-success mx-3"></i> <strong class="text-white">{{__('core.delivery-service-one')}}</strong></li>
													<li><i class="fa fa-check-circle text-success mx-3"></i> <strong class="text-white">{{__('core.delivery-service-two')}}</strong></li>
													<li><i class="fa fa-check-circle text-success mx-3"></i> <strong class="text-white">{{__('core.delivery-service-three')}}</strong></li>
												</ul>
											</div>

											<a href="#products" class="button bg-white button-light btn-line-fill button-dark button-small ml-0">{{__('core.delivery-service-btn')}}</a>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-md-5 min-vh-50">
								<img src="{{ asset('front_assets/images/8.png')}}" alt="">
							</div>

						</div>
					</div>

					<svg class="svg-curve service-curve" viewBox="0 0 1463 188.03">
						<path style="fill:#FFF;" d="M-.5,288.5s297-175,792-97,599,52,671,25v143H-.5Z" transform="translate(0 -171.47)"></path>
					</svg>

					<div class="bg-white white-block"></div>
				</div>

				<div class="clear"></div>

				<!-- Products
				============================================= -->
				<div class="container clearfix" id="products" dir="{{ $dir }}">


					<div class="fancy-title title-border title-center mb-4">
						<h2>{{__('core.OUR-PRODUCTS')}}</h2>
					</div>

					<div class="row grid-6 content-103 justify-content-center">

						@if ($products['total'] > 0)
<?php 
$i =1;
?>
                            @foreach ($products['data'] as $product)
                            	@if($i < 5)
                                <div class="col-md-3 col-6 px-product">
                                    <div class="product">
                                        <div class="product-image">
                                            <img src="{{ asset('storage/'.$product['photo'])}}">
                                        </div>

                                        <div class="product-desc">
                                            <div class="product-title mb-1"><h3> {{$product['name_en']}}</h3></div>
                                            <div class="product-price font-primary">
 
                                                    <ins>{{$product['price']}} {{__('core.SAR')}}</ins></div>
                                           
                                            <div class="mt-3 order-section {{$inverse_text}}">
                                                <a class="btn btn-cart add-order mx-2"><i class="icon-shopping-basket"></i></a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++ ?>
                                @endif
                            @endforeach

                        @else 
                            <img src="{{ asset('front_assets/images/no-products.svg')}}" alt="Image" class="mb-0" width="400">
                            <h4 class="col-12 text-center mt-4">{{__('core.NO-PRODUCTS')}}</h4>
                        @endif

						<a href="{{route('products')}}">{{__('core.VIEW-MORE')}}</a>

					</div>

				</div>


				<div class="section" dir="{{ $dir }}" style="background: rgba(233,245,255,.39);">

					<div class="shape-divider" data-shape="wave" data-position="top" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" class="op-ts op-1"><path class="shape-divider-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path></svg></div>
					<div class="shape-divider" data-shape="wave" data-position="bottom" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" class="op-ts op-1"><path class="shape-divider-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path></svg></div>
					
					<div class="container">
						<div class="fancy-title title-border title-center mb-4">
							<h2>{{__('core.ORDER-IN-EASY-WAY')}}</h2>
						</div>
					</div>

					<div class="row justify-content-center align-items-end">
						<div class="col-md-3 d-flex justify-content-center mb-5">
							<div>
								<img src="{{ asset('front_assets/images/order4.png')}}" alt="track_order" class="mb-5 trackOrderImg">
								<h4 class="text-center trackDescription">{{__('core.PLACE-ORDER')}}</h4>
							</div>
						</div>
						<div class="col-md-3 d-flex justify-content-center mb-5">
							<div>
								<img src="{{ asset('front_assets/images/order2.png')}}" alt="track_order" class="mb-5 trackOrderImg">
								<h4 class="text-center trackDescription">{{__('core.TRACK-IT')}}</h4>
							</div>
						</div>
						<div class="col-md-3 d-flex justify-content-center mb-5">
							<div>
								<img src="{{ asset('front_assets/images/order3.png')}}" alt="track_order" class="mb-5 trackOrderImg">
								<h4 class="text-center trackDescription">{{__('core.RECIEVE-WATER')}}</h4>
							</div>
						</div>
					</div>
				</div>

				<!-- Offer
				============================================= -->
				<div class="section my-4 py-5 bg-white">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-10">
								<div class="row align-items-stretch align-items-center">
									<div class="col-md-5 bg-white px-0 m-auto">
										<img src="{{ asset('front_assets/images/services-2.jpg')}}" alt="">
									</div>
									<div class="col-md-6 bg-light">
										<div class="card border-0 py-2 bg-light {{ $text }}" dir="{{ $dir }}">
											<div class="card-body">
												<h2 class="card-title mb-4 ls0">{{__('core.SPECIAL-OFFER')}}</h2>
												<p class="mb-3">{{__('core.offer-desc')}}</p>
												<div class="row">
													<div class="col-md-12">
														<div class="product-price font-primary" style="text-align: center;">
															<del class="mr-1" style="font-size: 15px;">20.00 {{__('core.SAR')}}</del> 
															<ins style="font-size: 35px;">15.00 {{__('core.SAR')}}</ins>
														</div>
													</div>
													<div class="col-md-12">
														<ul class="iconlist ml-3">
															<li class="bg-white p-2"><i class="icon-circle-blank text-black-50"></i>{{__('core.offer-title')}}</li>
														</ul>
													</div>
												</div>
												<div class="text-center my-3">
													<a href="#" class="button button-rounded button-small"><i class="icon-shopping-basket"></i>  {{__('core.ADD-TO-CART')}}</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


				<div class="clear"></div>


				<!-- Contact Us
				============================================= -->
				<div class="section my-4 py-5 bg-white">
					<div class="container">

						<div class="fancy-title title-border title-center mb-4">
							<h2>{{__('core.GET-IN-TOUCH')}}</h2>
						</div>

						<div class="row pt-5 justify-content-center">
							<div class="col-lg-7 mb-4">
					
							<form class="p-4 bg-white shadow contact_form {{$text}}" data-lang="en" dir="{{ $dir }}">
								@csrf
								<div class="row form-group">
								<div class="col-md-6 mb-3 mb-md-0 ">
									<label class="text-black" for="fname">
										{{__('core.NAME')}}
									</label>
									<input type="text" name="name" id="fname" class="form-control rounded-0 field" required="">
								</div>
								<div class="col-md-6 ">
									<label class="text-black" for="phone">
										{{__('core.MOBILE')}}
									</label>
									<input type="number" name="phone" id="phone" class="form-control rounded-0 field" required="">
								</div>
								</div>
					
								<div class="row form-group">
								
								<div class="col-md-6 ">
									<label class="text-black" for="email">
										{{__('core.EMAIL')}}
									</label> 
									<input type="email" name="email" id="email" class="form-control rounded-0 field" required="">
								</div>
					
								<div class="col-md-6 ">
									<label class="text-black" for="subject">
										{{__('core.SUBJECT')}}
									</label> 
									<input type="subject" name="subject" id="subject" class="form-control rounded-0 field" required="">
								</div>
					
								</div>
					
								<div class="row form-group">
								<div class="col-md-12 ">
									<label class="text-black" for="message">
										{{__('core.MESSAGE')}}
									</label> 
									<textarea name="message" id="message" cols="30" rows="5" class="form-control rounded-0 field" placeholder="{{__('core.LEAVE-YOUR-MESSAGE')}}" required=""></textarea>
								</div>
								</div>
					
								<div class="row form-group">
								<div class="col-md-12 ">
									<button type="submit" class="button button-rounded button-small submit" style="font-family: 'Poppins', sans-serif;">
										{{__('core.SEND-MESSAGE')}}
									</button>
								</div>
								</div>
					
					
							</form>
							</div>
						
						</div>
					</div>
				</div>

                <!-- App Buttons
                ============================================= -->
				@include('includes.app_store')
				
			</div>
		</section>
        <!-- #content end -->

@endsection


@section('script')

@endsection