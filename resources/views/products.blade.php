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


                        @if ($products['total'] > 0)

                            @foreach ($products['data'] as $product)
                               
                                <div class="col-md-3 col-6 px-product">
                                    <div class="product">
                                        <div class="product-image">
                                            <img src="{{ asset('storage/'.$product['photo'])}}">
                                        </div>

                                        <div class="product-desc">
                                            <div class="product-title mb-1"><h3> {{$product['name_en']}}</h3></div>
                                            <div class="product-price font-primary">
 
                                                    <ins>{{$product['price']}} {{__('core.SAR')}}</ins></div>
                                           <?php

                                           $found = Cart::search(function ($cartItem, $rowId) use($product){
                                                return $cartItem->id === (string)$product['id'];
                                            });

                                           ?>
                                            <div class="mt-3 order-section {{$inverse_text}}" id="prd_{{$product['id']}}">
                                                @if($found->isNotEmpty())
                                                <?php foreach ($found as $its) {
                                                $qty = $its->qty;
                                                $rowId = $its->rowId;

                                                if($qty > 1){
                                                    $minCls = 'fa-minus stepper_down';
                                                }else{
                                                    $minCls = 'fa-trash-alt text-danger remove_item';
                                                }
                                                  

                                                } ?>
<div class="text-center d-flex justify-content-between align-items-center actions-section"><i class="fa main-color pointer  {{$minCls}}" id="min_card_{{$product['id']}}" data-rowId="{{$rowId}}" data-id="{{$product['id']}}" data-name="{{$product['name_en']}}" data-price="{{$product['price']}}" data-photo="{{$product['photo']}}"></i><p class="quantity m-0" id="card_{{$product['id']}}"> {{$qty}}</p><i class="fa fa-plus main-color pointer stepper_up"  data-rowId="{{$rowId}}" data-id="{{$product['id']}}"></i></div>
                                                @else
                                      <a class="btn btn-cart add-order mx-2 crtbtn" data-id="{{$product['id']}}" data-name="{{$product['name_en']}}" data-price="{{$product['price']}}" data-photo="/storage/{{$product['photo']}}"><i class="icon-shopping-basket"></i></a>
                                                @endif
          
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                                
                               
                               <?php unset($found); ?>
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