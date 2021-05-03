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
    <style>
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link 
        {
            color: #fff;
            background-color: #fdb713;
        }

        .nav-pills .nav-link 
        {
            border-radius: .25rem;
            background: #034ea2;
            color: #fff;
            border-radius: 10px;
        }

    </style>
@endsection

@section('content')

        <!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap pb-0">
				
                <div class="container clearfix" dir="{{ $dir }}">


					<div class="fancy-title title-border title-center mb-4">
						<h2>{{__('core.OUR-PRODUCTS')}}</h2>
					</div>

                    <ul class="nav nav-pills mt-5 text-center justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation" style="width: 120px;">
                          <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">New</a>
                        </li>
                        <li class="nav-item" role="presentation" style="width: 120px; margin-left: -1rem;">
                          <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Refill</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">

                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            
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

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            

                            <div class="row grid-6 content-103 justify-content-center">


                                @if ($offers['total'] > 0)

                                    @foreach ($offers['data'] as $offer)
                                    
                                        <div class="col-md-3 col-6 px-product">
                                            <div class="product">
                                                <div class="product-image">
                                                    <img src="{{ asset('storage/'.$offer['photo'])}}">
                                                </div>

                                                <div class="product-desc">
                                                    <div class="product-title mb-1"><h3> {{$offer['name_en']}}</h3></div>
                                                    <div class="product-price font-primary">
        
                                                            <ins>{{$offer['price']}} {{__('core.SAR')}}</ins></div>
                                                <?php

                                                $found = Cart::search(function ($cartItem, $rowId) use($offer){
                                                        return $cartItem->id === (string)$offer['id'];
                                                    });

                                                ?>
                                                    <div class="mt-3 order-section {{$inverse_text}}" id="prd_{{$offer['id']}}">
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
                                                <div class="text-center d-flex justify-content-between align-items-center actions-section"><i class="fa main-color pointer  {{$minCls}}" id="min_card_{{$offer['id']}}" data-rowId="{{$rowId}}" data-id="{{$offer['id']}}" data-name="{{$offer['name_en']}}" data-price="{{$offer['price']}}" data-photo="{{$offer['photo']}}"></i><p class="quantity m-0" id="card_{{$offer['id']}}"> {{$qty}}</p><i class="fa fa-plus main-color pointer stepper_up"  data-rowId="{{$rowId}}" data-id="{{$offer['id']}}"></i></div>
                                                        @else
                                                <a class="btn btn-cart add-order mx-2 crtbtn" data-id="{{$offer['id']}}" data-name="{{$offer['name_en']}}" data-price="{{$offer['price']}}" data-photo="/storage/{{$offer['photo']}}"><i class="icon-shopping-basket"></i></a>
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