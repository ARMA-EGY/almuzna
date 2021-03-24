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
						<h2>{{__('core.OUR-PRODUCTS')}}</h2>
					</div>

					<div class="row grid-6 content-103 justify-content-center">

                        @if ($products->count() > 0)

                            @foreach ($products as $product)
                                <div class="col-md-3 col-6 px-product">
                                    <div class="product">
                                        <div class="product-image">
                                            <img src="{{ asset('storage/'.$product->photo)}}">
                                        </div>
                                       @if ($product->on_sale == 1) <div class="sale-flash badge badge-danger p-2">{{__('core.SALE')}}</div> @endif
                                        <div class="product-desc">
                                            <div class="product-title mb-1"><h3> {{$product->name}}</h3></div>
                                            <div class="product-price font-primary">
                                                @if ($product->on_sale == 1) 
                                                    <del class="mr-1">{{$product->price}} {{__('core.SAR')}}</del>
                                                    <ins>{{$product->sale_price}} {{__('core.SAR')}}</ins></div>
                                                @else
                                                    <ins>{{$product->price}} {{__('core.SAR')}}</ins></div>
                                                @endif
                                            <div class="mt-3 order-section {{$inverse_text}}">
                                                <a class="btn btn-cart add-order mx-2"><i class="icon-shopping-basket"></i></a>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @else 
                            <img src="{{ asset('front_assets/images/no-products.svg')}}" alt="Image" class="mb-0" width="400">
                            <h4 class="col-12 text-center mt-4">{{__('core.NO-PRODUCTS')}}</h4>
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