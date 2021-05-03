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
        .coupon_box{
        background: -webkit-linear-gradient(to right, #125dab, #01acf1);
        background: linear-gradient(to right, #125dab, #01acf1);
        width: 100%;
        border-radius: 7px;
        padding: 1rem;
        text-align: center;
        color: #fff;
        font-family: 'Tahoma', sans-serif;
        position: relative;
        margin: 1rem auto;
        }

        .title{
        color: rgba(255,255,255,0.75);
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 45px
        }

        .how_much{font-size: 55px;}
        h3{font-size: 35px}

        .how_much {text-shadow: 0 0 10px rgba(0,0,0,0.3); text-align: center}

        .btn{
        padding: 0.5rem 3rem;
        background: #fff;
        border: none;
        border-radius: 30px;
        color: rgba(0,0,0,0.5);
        font-size: 18px;
        font-weight: 600;
        margin-top: 2rem;
        cursor: pointer;
        outline: none;
        transition: 250ms
        }
        .btn:hover{box-shadow: 0 2px 10px rgba(0,0,0,0.25)}
        .body{
        padding-bottom: 2rem;
        border-bottom: 2px dashed rgb(255 255 255 / 50%);
        position: relative;
        }

        .disc-bg{
        position: absolute;
        color: rgba(255,255,255,0.15);
        top: 0%;
        left: 15%;
        font-size: 150px;
        font-weight: bold;
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
						<h2>{{__('core.COUPONS')}}</h2>
					</div>

					<div class="row grid-6 content-103 justify-content-center">



                        @forelse  ($coupons['data'] as $coupon)
                            <div class="col-md-4">
                                <div class='coupon_box'>
                                    <div class='body'>
                                        <span class="disc-bg">{{$coupon['discount']}}</span>
                                        
                                        
                                        <h3 class='how_much text-center'> <b class="text-white"> {{$coupon['discount']}}% </b> </h3>
                                        <h3 class="text-white text-center"> {{__('core.OFF')}} </h3>
                                    </div>
                                    
                                    <h4 class='title mt-3'> {{$coupon['code']}} </h4>
                                </div>
                            </div>
                        @empty
                        <img src="{{ asset('front_assets/images/no-coupons.svg')}}" alt="Image" class="mb-0" width="500">
                            <h4 class="col-12 text-center mt-4">{{__('core.NO-COUPONS')}}</h4>
                        @endforelse 

                    

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