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

    .card-header {
        padding: 0.75rem 1.875rem;
        margin-bottom: 0;
        color: #252525;
        background-color: transparent;
        border-bottom: 1px solid transparent;
    }

    .card:hover {
        box-shadow: 0px 0 5px 1px rgb(0 0 0 / 10%) !important;
    }

    .form-control-simple {
        background-color: transparent !important;
        border-color: #d5d5d5;
        border-top: 0;
        border-left: 0;
        border-right: 0;
        padding-left: 0;
        padding-right: 0;
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        border-radius: 0;
    }

    .panel {
    border:1px solid #fff;
    border-radius:10px;
    background-color:#fff;
    box-shadow:0px 1px 3px #ccc;
    }

    /*
    Template Name: Monster Admin
    Author: Themedesigner
    Email: niravjoshi87@gmail.com
    File: css
    */

    .wizard-content .wizard>.steps>ul>li:after,
    .wizard-content .wizard>.steps>ul>li:before {
        content: '';
        z-index: 9;
        display: block;
        position: absolute
    }

    .wizard-content .wizard {
        width: 100%;
        overflow: hidden
    }

    .wizard-content .wizard .content {
        margin-left: 0!important
    }

    .wizard-content .wizard>.steps {
        position: relative;
        display: block;
        width: 100%
    }

    .wizard-content .wizard>.steps .current-info {
        position: absolute;
        left: -99999px
    }

    .wizard-content .wizard>.steps>ul {
        display: table;
        width: 100%;
        table-layout: fixed;
        margin: 0;
        padding: 0;
        list-style: none
    }

    .wizard-content .wizard>.steps>ul>li {
        display: table-cell;
        width: auto;
        vertical-align: top;
        text-align: center;
        position: relative
    }

    .wizard-content .wizard>.steps>ul>li a {
        position: relative;
        padding-top: 52px;
        margin-top: 20px;
        margin-bottom: 20px;
        display: block
    }

    .wizard-content .wizard>.steps>ul>li:before {
        left: 0
    }

    .wizard-content .wizard>.steps>ul>li:after {
        right: 0
    }

    .wizard-content .wizard>.steps>ul>li:first-child:before,
    .wizard-content .wizard>.steps>ul>li:last-child:after {
        content: none
    }

    .wizard-content .wizard>.steps>ul>li.current>a {
        color: #2f3d4a;
        cursor: default
    }

    .wizard-content .wizard>.steps>ul>li.current .step {
        border-color: #009efb ;
        background-color: #fff;
        color: #009efb 
    }

    .wizard-content .wizard>.steps>ul>li.disabled a,
    .wizard-content .wizard>.steps>ul>li.disabled a:focus,
    .wizard-content .wizard>.steps>ul>li.disabled a:hover {
        color: #999;
        cursor: default
    }

    .wizard-content .wizard>.steps>ul>li.done a,
    .wizard-content .wizard>.steps>ul>li.done a:focus,
    .wizard-content .wizard>.steps>ul>li.done a:hover {
        color: #999
    }

    .wizard-content .wizard>.steps>ul>li.done .step {
        background-color: #009efb ;
        border-color: #009efb ;
        color: #fff
    }

    .wizard-content .wizard>.steps>ul>li.error .step {
        border-color: #f62d51;
        color: #f62d51
    }

    .wizard-content .wizard>.steps .step {
        background-color: #fff;
        display: inline-block;
        position: absolute;
        top: 0;
        left: 50%;
        margin-left: -24px;
        z-index: 10;
        text-align: center
    }

    .wizard-content .wizard>.content {
        overflow: hidden;
        position: relative;
        width: auto;
        padding: 0;
        margin: 0
    }

    .wizard-content .wizard>.content>.title {
        position: absolute;
        left: -99999px
    }

    .wizard-content .wizard>.content>.body {
        padding: 0 20px
    }

    .wizard-content .wizard>.content>iframe {
        border: 0;
        width: 100%;
        height: 100%
    }

    .wizard-content .wizard>.actions {
        position: relative;
        display: block;
        text-align: right;
        padding: 0 20px 20px
    }

    .wizard-content .wizard>.actions>ul {
        float: right;
        list-style: none;
        padding: 0;
        margin: 0
    }

    .wizard-content .wizard>.actions>ul:after {
        content: '';
        display: table;
        clear: both
    }

    .wizard-content .wizard>.actions>ul>li {
        float: left
    }

    .wizard-content .wizard>.actions>ul>li+li {
        margin-left: 10px
    }

    .wizard-content .wizard>.actions>ul>li>a {
        background: #009efb ;
        color: #fff;
        display: block;
        padding: 7px 12px;
        border-radius: 4px;
        border: 1px solid transparent
    }

    .wizard-content .wizard>.actions>ul>li>a:focus,
    .wizard-content .wizard>.actions>ul>li>a:hover {
        -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, .05) inset;
        box-shadow: 0 0 0 100px rgba(0, 0, 0, .05) inset
    }

    .wizard-content .wizard>.actions>ul>li>a:active {
        -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, .1) inset;
        box-shadow: 0 0 0 100px rgba(0, 0, 0, .1) inset
    }

    .wizard-content .wizard>.actions>ul>li>a[href="#previous"] {
        background-color: #fff;
        color: #54667a;
        border: 1px solid #d9d9d9
    }

    .wizard-content .wizard>.actions>ul>li>a[href="#previous"]:focus,
    .wizard-content .wizard>.actions>ul>li>a[href="#previous"]:hover {
        -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, .02) inset;
        box-shadow: 0 0 0 100px rgba(0, 0, 0, .02) inset
    }

    .wizard-content .wizard>.actions>ul>li>a[href="#previous"]:active {
        -webkit-box-shadow: 0 0 0 100px rgba(0, 0, 0, .04) inset;
        box-shadow: 0 0 0 100px rgba(0, 0, 0, .04) inset
    }

    .wizard-content .wizard>.actions>ul>li.disabled>a,
    .wizard-content .wizard>.actions>ul>li.disabled>a:focus,
    .wizard-content .wizard>.actions>ul>li.disabled>a:hover {
        color: #999
    }

    .wizard-content .wizard>.actions>ul>li.disabled>a[href="#previous"],
    .wizard-content .wizard>.actions>ul>li.disabled>a[href="#previous"]:focus,
    .wizard-content .wizard>.actions>ul>li.disabled>a[href="#previous"]:hover {
        -webkit-box-shadow: none;
        box-shadow: none
    }

    .wizard-content .wizard.wizard-circle>.steps>ul>li:after,
    .wizard-content .wizard.wizard-circle>.steps>ul>li:before {
        top: 45px;
        width: 50%;
        height: 3px;
        background-color: #009efb 
    }

    .wizard-content .wizard.wizard-circle>.steps>ul>li.current:after,
    .wizard-content .wizard.wizard-circle>.steps>ul>li.current~li:after,
    .wizard-content .wizard.wizard-circle>.steps>ul>li.current~li:before {
        background-color: #F3F3F3
    }

    .wizard-content .wizard.wizard-circle>.steps .step {
        width: 50px;
        height: 50px;
        line-height: 45px;
        border: 3px solid #F3F3F3;
        font-size: 1.3rem;
        border-radius: 50%
    }

    .wizard-content .wizard.wizard-notification>.steps>ul>li:after,
    .wizard-content .wizard.wizard-notification>.steps>ul>li:before {
        top: 39px;
        width: 50%;
        height: 2px;
        background-color: #009efb 
    }

    .wizard-content .wizard.wizard-notification>.steps>ul>li.current .step {
        border: 2px solid #009efb ;
        color: #009efb ;
        line-height: 36px
    }

    .wizard-content .wizard.wizard-notification>.steps>ul>li.current .step:after,
    .wizard-content .wizard.wizard-notification>.steps>ul>li.done .step:after {
        border-top-color: #009efb 
    }

    .wizard-content .wizard.wizard-notification>.steps>ul>li.current:after,
    .wizard-content .wizard.wizard-notification>.steps>ul>li.current~li:after,
    .wizard-content .wizard.wizard-notification>.steps>ul>li.current~li:before {
        background-color: #F3F3F3
    }

    .wizard-content .wizard.wizard-notification>.steps>ul>li.done .step {
        color: #FFF
    }

    .wizard-content .wizard.wizard-notification>.steps .step {
        width: 40px;
        height: 40px;
        line-height: 40px;
        font-size: 1.3rem;
        border-radius: 15%;
        background-color: #F3F3F3
    }

    .wizard-content .wizard.wizard-notification>.steps .step:after {
        content: "";
        width: 0;
        height: 0;
        position: absolute;
        bottom: 0;
        left: 50%;
        margin-left: -8px;
        margin-bottom: -8px;
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-top: 8px solid #F3F3F3
    }

    .wizard-content .wizard.vertical>.steps {
        display: inline;
        float: left;
        width: 20%
    }

    .wizard-content .wizard.vertical>.steps>ul>li {
        display: block;
        width: 100%
    }

    .wizard-content .wizard.vertical>.steps>ul>li.current:after,
    .wizard-content .wizard.vertical>.steps>ul>li.current:before,
    .wizard-content .wizard.vertical>.steps>ul>li.current~li:after,
    .wizard-content .wizard.vertical>.steps>ul>li.current~li:before,
    .wizard-content .wizard.vertical>.steps>ul>li:after,
    .wizard-content .wizard.vertical>.steps>ul>li:before {
        background-color: transparent
    }

    @media (max-width:768px) {
        .wizard-content .wizard>.steps>ul {
            margin-bottom: 20px
        }
        .wizard-content .wizard>.steps>ul>li {
            display: block;
            float: left;
            width: 50%
        }
        .wizard-content .wizard>.steps>ul>li>a {
            margin-bottom: 0
        }
        .wizard-content .wizard>.steps>ul>li:first-child:before {
            content: ''
        }
        .wizard-content .wizard>.steps>ul>li:last-child:after {
            content: '';
            background-color: #009efb 
        }
        .wizard-content .wizard.vertical>.steps {
            width: 15%
        }
    }

    @media (max-width:480px) {
        .wizard-content .wizard>.steps>ul>li {
            width: 100%
        }
        .wizard-content .wizard>.steps>ul>li.current:after {
            background-color: #009efb 
        }
        .wizard-content .wizard.vertical>.steps>ul>li {
            display: block;
            float: left;
            width: 50%
        }
        .wizard-content .wizard.vertical>.steps {
            width: 100%;
            float:none;
        }
    }
</style>

@endsection

@section('content')
        
        <!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap pb-0">
				
                <div class="container px-lg-6 clearfix" dir="{{ $dir }}">


                    
                    <!-- Checkout steps -->

                    <div class="container">
                        <div class="panel">
                          <div class="panel-body wizard-content">

                                <form id="example-form" class="tab-wizard wizard-circle wizard clearfix placeOrder">
                                    @csrf

                                    <input type="hidden" name="shippingFee" id="shippingFee" value="0.00">
                                    <input type="hidden" name="subtotal" id="subtotal" value="{{Cart::subtotal()}}">
                                    <input type="hidden" name="total" id="total" value="0.00">
                                     <input type="hidden" name="totalTax" id="totalTax" value="{{$totalTax}}">
                                    

                                    <input type="hidden" name="orderlat" id="orderlat" value="">
                                    <input type="hidden" name="orderlong" id="orderlong" value="">
                                    <input type="hidden" name="sales_tax" id="sales_tax" value="{{$sales_perc}}">
                                    <input type="hidden" name="delivery_address" id="delivery_address" value="">
                                    <input type="hidden" name="couponDiscount" id="couponDiscount" value="{{$couponDiscount}}">

                                    <h6>Checkout</h6>
                                    <section class="my-4">
                                        
                                        <div class="row justify-content-center">
                                            <div class="col-lg-8">
                                
                                                <h3 class="pre-label font-size-base">Cart Items</h3>

                        
                                                @if(Cart::count() > 0) 
                                                  @foreach(Cart::content() as $item)

                                                    <?php 
                                                        if($item->qty > 1){
                                                            $minCls = 'fa-minus stepper_down';
                                                        }else{
                                                            $minCls = 'fa-trash-alt text-danger remove_item';
                                                        }
                                                    ?>



                                                <div class="bg-white shadow-sm rounded mb-3 p-3 alert alert-dismissible" role="alert" id="item_checkout_{{$item->model->id}}">
                                                    <div class="row align-items-center no-gutters p-md-2">
                                                        <div class="col-lg-2">
                                                            <img src="{{ asset('front_assets/demos/shop/images/items/1.png')}}" alt="" class="img-fluid" />
                                                        </div>
                                                        <div class="col-lg-5 pl-lg-3 mb-2 mb-lg-0">
                                                            <h5 class="mb-0">{{$item->model->name_en}}</h5>
                                                        </div>
                                                        <div class="col-6 col-lg-2">
                                                            <div class=" d-flex justify-content-between align-items-center actions-section-cart" style="width: unset">
                                                               <i class="fa main-color pointer  {{$minCls}}" id="min_card_{{$item->model->id}}" data-rowId="{{$item->rowId}}" data-id="{{$item->model->id}}" data-name="{{$item->model->name_en}}" data-price="{{$item->model->price}}" data-photo="{{$item->model->photo}}"></i>
                                                               <p class="quantity m-0" id="card_{{$item->model->id}}"> {{$item->qty}}</p><i class="fa fa-plus main-color pointer stepper_up"  data-rowId="{{$item->rowId}}" data-id="{{$item->model->id}}"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-lg-3 text-right">
                                                            <div class="h5 mb-0">{{$item->model->price}} {{__('core.SAR')}}</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                  @endforeach
                                                @endif



                            
                                                
                                                <!-- Discount and promocode -->
                                
                                                <div class="bg-white shadow-sm rounded mb-3 p-3">
                                                    <div class="row align-items-center no-gutters p-md-2">
                                
                                                        <div class="col-lg-7">
                                                            <div class="py-2">
                                                                <label>Promo code:</label>
                                                                <input type="text" value="" class="form-control form-control-sm w-auto" name="couponcode" id="couponcode" placeholder="Coupon code" />
                                                            </div>
                                                        </div>
                                
                                                        <div class="col-lg-5 text-right pt-4">
                                                            <a href="#" class="btn btn-primary btn-sm btn-rounded px-lg-5 applycode">APPLY</a>
                                                        </div>
                                
                                                    </div>
                                                </div>
                                
                                            </div>
                                
                                        </div>
                                            
                                    </section>
                        
                                    <h6>Location & Date</h6>
                                    <section class="my-4">

                                        <div class="row justify-content-center">
                                            <div class="col-lg-10 col-xl-8">
                

                                                <!-- Locations -->
                                                <h3>Choose Delivery Address</h3>
                                                <div class="accordion br-sm" id="accordionLocationExample">
                                
                                @foreach($locations as $location)
                                                    <div class="card card-fill mb-3 shadow-sm rounded">
                                                        <div class="card-header p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-9">
                                                                    <div class="custom-control custom-radio d-flex align-items-center">
                                                                        <input type="radio" id="{{$location->id}}" name="loationRadio" data-lat="{{$location->lat}}" data-lng="{{$location->lng}}" data-delivery_address="{{$location->delivery_address}}" class="custom-control-input locationRdbtn" data-toggle="collapse" data-target="#collapseOne1" aria-controls="collapseOne1">
                                                                        <label class="custom-control-label pl-2 pl-lg-4" for="{{$location->id}}">
                                                                            <span class="h6 m-0">{{$location->delivery_address}}</span><br />
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="collapseOne1" class="collapse pt-0" aria-labelledby="{{$location->id}}" data-parent="#accordionLocationExample">
                                                            <hr class="m-0">
                                                            <div class="card-body">
                                                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                            </div>
                                                        </div>
                                                    </div>
                                
                                @endforeach                            
                                
                                                    
                                                </div>


                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#LocationModal"> Add New Location</a>

                                                

                                                <div class="form-group">

                                                </div>
                                                   
                                                <hr>

                                                <!-- Date -->
                                                <h3>Choose Delivery Date</h3>
                                                
                                                <input type="date" class="form-control" name="delivery_date">


                                            </div>
                                        </div>
                                        
                                    </section>

                                    <h6>Payment</h6>
                                    <section class="my-4">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-10 col-xl-8">
                                
                                                <h3 class="pre-label font-size-base">Choose Payment Method</h3>
                                
                                                <!-- Checkout credit card -->
                                
                                                <div class="accordion br-sm" id="accordionPaymentExample">
                               <!-- 
                                                    <div class="card card-fill mb-3 shadow-sm rounded">
                                                        <div class="card-header p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-9">
                                                                    <div class="custom-control custom-radio d-flex align-items-center">
                                                                        <input type="radio" id="customRadio1" name="payment_method" class="custom-control-input form-radio" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
                                                                        <label class="custom-control-label pl-2 pl-lg-4" for="customRadio1">
                                                                            <span class="h6 m-0">Credit cart</span> <br />
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3 text-right">
                                                                    <div class="h1 m-0">
                                                                        <i class="fa fa-credit-card"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="collapseOne" class="collapse pt-0" aria-labelledby="customRadio1" data-parent="#accordionPaymentExample">
                                                            <hr class="m-0">
                                                            <div class="card-body">
                                                                
                                                                    <div class="form-row mb-1">
                                                                        <div class="col">
                                                                            <input type="text" class="form-control form-control-simple" placeholder="Name on card">
                                                                        </div>
                                                                    </div>
                                
                                                                    <div class="form-row mb-1">
                                                                        <div class="col">
                                                                            <input type="tel" class="form-control form-control-simple" placeholder="0000-0000-0000-0000" inputmode="numeric" maxlength="19" pattern="[0-9\s]{13,19}">
                                                                        </div>
                                                                    </div>
                                
                                                                    <div class="form-row mb-1">
                                                                        <div class="col">
                                                                            <input type="text" class="form-control form-control-simple" placeholder="MM/YY">
                                                                        </div>
                                                                        <div class="col">
                                                                            <input type="text" class="form-control form-control-simple" placeholder="CVV">
                                                                        </div>
                                                                    </div>
                                
                                                                    <div class="form-row mt-3">
                                                                        <div class="col">
                                                                            <button class="btn btn-rounded btn-primary btn-sm px-3">
                                                                                Proceed payment
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                
                                                            </div>
                                                        </div>
                                                    </div>  -->
                                
                                                    <!-- Checkout Wallet -->
                                
                                        <!--            <div class="card card-fill mb-3 shadow-sm rounded">
                                                        <div class="card-header p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-9">
                                                                    <div class="custom-control custom-radio d-flex align-items-center">
                                                                        <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input" data-toggle="collapse" data-target="#collapseTwo" aria-controls="collapseTwo">
                                                                        <label class="custom-control-label pl-2 pl-lg-4" for="customRadio2">
                                                                            <span class="h6 m-0">Wallet</span><br />
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3 text-right">
                                                                    <div class="h1 m-0">
                                                                        <i class="fa fa-wallet"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="collapseTwo" class="collapse pt-0" aria-labelledby="customRadio2" data-parent="#accordionPaymentExample">
                                                            <hr class="m-0">
                                                            <div class="card-body">
                                                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                            </div>
                                                        </div>
                                                    </div>-->
                                
                                                    <!-- Checkout Cash on deliver -->
                                
                                                    <div class="card card-fill mb-3 shadow-sm rounded">
                                                        <div class="card-header p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-9">
                                                                    <div class="custom-control custom-radio d-flex align-items-center">
                                                                        <input type="radio" id="customRadio3" name="paymentmethod" value="cash" class="custom-control-input" data-toggle="collapse" data-target="#collapseThree" aria-controls="collapseThree" checked>
                                                                        <label class="custom-control-label pl-2 pl-lg-4" for="customRadio3">
                                                                            <span class="h6 m-0">Cash on Deliver </span><br />
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-3 text-right">
                                                                    <div class="h1 m-0">
                                                                        <i class="fas fa-truck"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="collapseThree" class="collapse pt-0" aria-labelledby="customRadio3" data-parent="#accordionPaymentExample">
                                                            <hr class="m-0">
                                                            <div class="card-body">
                                                                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <h3>Payment Summary</h3>
                                                <!-- Total subtable -->
                                                <div class="col-md-9 mx-auto">
                                                    <table class="table table-sm sub-table text-right my-4">
                                                        <tbody><tr>
                                                            <td><span class="subtotal">Subtotal</span></td>
                                                            <td class="text-right"><span class="subtotal-value">{{Cart::subtotal()}} SAR</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="vat">VAT</span></td>
                                                            <td class="text-right"><span class="vat-value">{{$sales_perc}}%</span></td>
                                                        </tr>

                                                        <tr>
                                                            <td><span class="vat">Shipping</span></td>
                                                            <td class="text-right"><span class="Shipping-value">0.00 SAR</span></td>
                                                        </tr>                                                           
                                                        <tr>
                                                            <td><span class="total">Total</span></td>

                                                             <?php $totalWithcoupon = $totalTax - $couponDiscount;  ?>
                                                            <td class="text-right"><span class="total-value">{{$totalWithcoupon}} SAR</span></td>
                                                        </tr>
                                                    </tbody></table>
                                                </div>
                                
                                            </div>
                                        </div>
                                    </section>
                                    
                                    <h6>Finish</h6>
                                    <section class="my-4">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-10 col-xl-8">
                                        
                                                <div class="alert alert-success shadow-sm rounded alert-dismissible fade show p-3 p-lg-4 mb-5 p-md-5" role="alert">
                                                    <h3 class="h6 mb-0">Your order is completed!</h3>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>

                                                <h3>Order Details</h3>

                                                <div class="bg-white shadow-sm rounded mb-3 p-3 p-md-5">
    
                                                    <div class="row">
                                
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <small class="pre-label">Order no.</small>
                                                                <p>52522-63259226</p>
                                                            </div>
                                                        </div>
                                
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <small class="pre-label">Transaction ID</small>
                                                                <p>2265996</p>
                                                            </div>
                                                        </div>
                                
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <small class="pre-label">Order date</small>
                                                                <p>20/04/2020</p>
                                                            </div>
                                                        </div>
                                
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <small class="pre-label">Shipping arrival</small>
                                                                <p>25/04/2020</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                
                                                </div>
                                        
                                            </div>
                                        </div>

                                    </section>

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



        <!-- Location Modal -->
        <div class="modal fade" id="LocationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form class="add-location">

                    @csrf

                    <input type="hidden" name="orderlat-modal" id="orderlat-modal" value="">
                    <input type="hidden" name="orderlong-modal" id="orderlong-modal" value="">
                    <input type="hidden" name="delivery_address-modal" id="delivery_address-modal" value="">


                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="street">Street</label>
                            <input type="text" class="form-control" id="street" name="street">
                          </div>

                          <div class="form-group col-md-6">
                            <label for="building">Building</label>
                            <input type="text" class="form-control" id="building" name="building">
                          </div>

                          <div class="form-group col-md-6">
                            <label for="floor">Floor</label>
                            <input type="text" class="form-control" id="floor" name="floor">
                          </div>

                          <div class="form-group col-md-6">
                            <label for="apartment">Apartment</label>
                            <input type="text" class="form-control" id="apartment" name="apartment">
                          </div>
                        </div>



                        <div class="form-group">
                          <label for="inputAddress">Address Notes</label>
                          <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="inputAddress">
                        </div>

                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" class="form-control" name="places" id="search_input" placeholder="Type address..." required>
                        </div>                        

                    </form>
               
               

               
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary lct-btn">Add</button>
                </div>
            </div>
            </div>
        </div>


@endsection


@section('script')
<script src="{{ asset('front_assets/js/jquery.steps.min.js')}}"></script>

<script>
    var form = $("#example-form");

    form.steps({
        headerTag: "h6",
        bodyTag: "section",
        transitionEffect: "fade",
    titleTemplate: '<span class="step">#index#</span> #title#',
            onFinished: function (event, currentIndex)
        {
            var form = $(this);

            // Submit form input

            form.submit();
        }
    });
</script>




<script>

            $("#example-form").submit(function(e)
            {
                e.preventDefault();


                var head1   = 'Thank You';
                var title1  = 'Your Message Has Been Sent Successfully, We will contact you ASAP. ';
                var head2   = 'Oops...';
                var title2  = 'Something went wrong, please try again later.';

                $.ajax({
                    url:        "{{route('placeOrder')}}",
                    method:     'POST',
                    dataType:   'json',
                    data:       $(this).serialize() ,
                    success:function(data)
                    {

                    if(data.status == 'false')
                    {
                        setTimeout(function () 
                        {
                            window.location.replace("{{route('welcome')}}");
                        }, 3000);

                    } else if (data.status == 'true')
                    {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                                                   });
                        Toast.fire({
                          type: 'success',
                          title: data.msg
                        }) 

                        
                    } 
                       

                    },error:function(data)
                    {
                           const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                                                   });
                            toastr.error('Woops something went');
                    }
                    
                    
                });

            });




    $(".lct-btn").click(function(){        
        $(".add-location").submit();
    });

    $('.add-location').submit(function(e){
            e.preventDefault();
            $.ajax({
                url:"{{route('addlocation')}}",
                method:'POST',
                data:new FormData(this),
                contentType: false,
                cache: false,
                processData : false,
                dataType:'json',
                success:function(data)
                {


                    if(data.status == 'false')
                    {


                        setTimeout(function () 
                        {
                            window.location.replace("{{route('welcome')}}");
                        }, 3000);
                        
                    } else if (data.status == 'true')
                    {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000
                                                   });
                        Toast.fire({
                          type: 'success',
                          title: data.msg
                        }) 

                        $('#LocationModal').modal('hide');
                    }

                   

                },error:function(data)
                {
                  if(data['status'] == 422)
                  {

                   $.each( data['responseJSON']['errors'], function( key, value ) {
                       const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                                               });
                        toastr.error(value[0])



                     });

                  }
                }
            })


    });




    $(".locationRdbtn").click(function(){ 

            var lat = $(this).attr("data-lat");
            var lng = $(this).attr("data-lng");
            var delivery_address = $(this).attr("data-delivery_address");
            $('#orderlat').val(lat);
            $('#orderlong').val(lng);
            $('#delivery_address').val(delivery_address);

            $('#orderlat-modal').val(lat);
            $('#orderlong-modal').val(lng);
            $('#delivery_address-modal').val(delivery_address);
            


            $.ajax({
                url:        "{{route('distanceCalculator')}}",
                method:     'GET',
                dataType:'json',
                data: {lat:lat,
                       lng:lng },
                success:function(data)
                {
                    
                    console.log(data);
                    $('.Shipping-value').html(data+' SAR');
                    $('#shippingFee').val(data);

                    var dstotal = parseFloat($('#totalTax').val())+parseFloat(data) - parseFloat($('#couponDiscount').val());
                    $('.total-value').html(parseFloat(dstotal).toFixed(2)+' SAR');
                    $('#total').val(parseFloat(dstotal).toFixed(2)); 
                    

                },error:function(data)
                {
                       const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                                               });
                        toastr.error('Woops something went');
                }
            })
    });     
</script>    

@endsection