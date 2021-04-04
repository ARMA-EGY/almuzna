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


@section('style')
    
@endsection

@section('content')

        <!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap pb-0">
				
                <div class="container px-lg-6 clearfix" dir="{{ $dir }}">


                    
                    <!-- Checkout steps -->
                    
                    <div class="pt-3 pt-lg-4 pb-5 pb-lg-6 mb-2 mb-lg-3">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <div class="steps steps-sm">
                                        <ul class="row">
                                            <li class="col  current">
                                                <a href="#">
                                                    <span class="step-item" data-text="Checkout">
                                                        <span>1</span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="col">
                                                <a href="#">
                                                    <span class="step-item" data-text="Location & Date">
                                                        <span>2</span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="col ">
                                                <a href="#">
                                                    <span class="step-item" data-text="Payment">
                                                        <span>3</span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="col">
                                                <a href="#">
                                                    <span class="step-item" data-text="Receipt">
                                                        <span>4</span>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <!-- Cart items -->
                
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                
                                <h2 class="pre-label font-size-base">Cart items</h2>

                
                                <div class="bg-white shadow-sm rounded mb-3 p-3 alert alert-dismissible" role="alert">
                                    <div class="row align-items-center no-gutters p-md-2">
                                        <div class="col-lg-2">
                                            <img src="{{ asset('front_assets/demos/shop/images/items/1.png')}}" alt="" class="img-fluid" />
                                        </div>
                                        <div class="col-lg-5 pl-lg-3 mb-2 mb-lg-0">
                                            <h5 class="mb-0">Water Bottle 500ml</h5>
                                        </div>
                                        <div class="col-6 col-lg-2">
                                            <div class=" d-flex justify-content-between align-items-center actions-section-cart" style="width: unset">
                                                <i class="fa main-color pointer stepper_down fa-minus"></i>
                                                <p class="quantity m-0">2</p>
                                                <i class="fa fa-plus main-color pointer stepper_up"></i>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-3 text-right">
                                            <div class="h5 mb-0">30.00 {{__('core.SAR')}}</div>
                                            <small class="text-muted"><s>45.00 {{__('core.SAR')}}</s></small>
                                        </div>
                                    </div>
                                </div>
                
                                <div class="bg-white shadow-sm rounded mb-3 p-3 alert alert-dismissible" role="alert">
                                    <div class="row align-items-center no-gutters p-md-2">
                                        <div class="col-lg-2">
                                            <img src="{{ asset('front_assets/demos/shop/images/items/4.png')}}" alt="" class="img-fluid" />
                                        </div>
                                        <div class="col-lg-5 pl-lg-3 mb-2 mb-lg-0">
                                            <h5 class="mb-0">Water Bottle 1 Liter</h5>
                                        </div>
                                        <div class="col-6 col-lg-2">
                                            <div class=" d-flex justify-content-between align-items-center actions-section-cart" style="width: unset">
                                                <i class="fa main-color pointer stepper_down fa-trash-alt text-danger remove_item"></i>
                                                <p class="quantity m-0">1</p>
                                                <i class="fa fa-plus main-color pointer stepper_up"></i>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-3 text-right">
                                            <div class="h5 mb-0">35.00 {{__('core.SAR')}}</div>
                                        </div>
                                    </div>
                                </div>
                                
                
                
                                <!-- Discount and promocode -->
                
                                <div class="bg-white shadow-sm rounded mb-3 p-3">
                                    <div class="row align-items-center no-gutters p-md-2">
                
                                        <div class="col-lg-7">
                                            <div class="py-2">
                                                <label>Promo code:</label>
                                                <input type="text" value="" class="form-control form-control-sm w-auto" name="couponcode" id="couponcode" placeholder="Coupon code" />
                                            </div>
                                        </div>
                
                                        <div class="col-lg-5 text-right">
                                            <a href="#" class="btn btn-primary btn-sm btn-rounded px-lg-5">APPLY</a>
                                        </div>
                
                                    </div>
                                </div>
                
                
                                <!-- Buttons -->
                
                                <div class="py-3">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col-6">
                                            <a href="#" class="btn btn-dark btn-primary btn-rounded px-lg-5">Shop more</a>
                                        </div>
                                        <div class="col-6 text-right">
                                            <a href="#" class="btn btn-primary btn-rounded px-lg-5">Next step</a>
                                        </div>
                                    </div>
                                </div>
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