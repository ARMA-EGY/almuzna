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

        <!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap pb-0">
				
                <div class="container clearfix" dir="{{ $dir }}">


					<div class="fancy-title title-border title-center mb-4">
						<h2>{{__('core.OFFERS')}}</h2>
					</div>

					<div class="row grid-6 content-103 justify-content-center">

                        @if ($products['total'] > 0)

                            @foreach ($products['data'] as $product)
                                
                                <div class="col-md-4 col-6">
                                    <div class="product rounded-10">
                                        <div class="product-image">
                                            <a href="#"><img src="{{ asset('storage/')}}"></a>
                                        </div>
                                        <div class="sale-flash badge badge-warning p-2">{{__('core.OFFER')}}</div>
                                        <div class="product-desc">
                                            <div class="product-title mb-1"><h3>{{$product['name_en']}}</h3></div>
                                            <div class="product-price font-primary">

                                                    <ins>{{$product['price']}} {{__('core.SAR')}}</ins></div>
                                            
                                            <div class="mt-3 order-section">
                                                <a class="btn btn-cart add-order mx-2"><i class="icon-shopping-basket"></i> Add to cart</a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach




                        @else 
                            <img src="{{ asset('front_assets/images/no-offers.svg')}}"  class="mb-0" width="500">
                            <h4 class="col-12 text-center mt-4">{{__('core.NO-OFFERS')}}</h4>
                        @endif


						


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