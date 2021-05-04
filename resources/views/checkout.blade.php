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
    
<link rel="stylesheet" href="{{ asset('front_assets/checkout.css')}}" type="text/css" />

@if (LaravelLocalization::getCurrentLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('front_assets/checkout-ar.css')}}" type="text/css" />
@endif


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
                                
                                                <h3 class="pre-label font-size-base {{$text}}">Cart Items</h3>

                        
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
                                                            <h5 class="mb-0 {{$text}}">{{$item->model->name_en}}</h5>
                                                        </div>
                                                        <div class="col-6 col-lg-2">
                                                            <div class=" d-flex justify-content-between align-items-center actions-section-cart" style="width: unset">
                                                               <i class="fa main-color pointer  {{$minCls}}" id="min_card_{{$item->model->id}}" data-rowId="{{$item->rowId}}" data-id="{{$item->model->id}}" data-name="{{$item->model->name_en}}" data-price="{{$item->model->price}}" data-photo="{{$item->model->photo}}"></i>
                                                               <p class="quantity m-0" id="card_{{$item->model->id}}"> {{$item->qty}}</p><i class="fa fa-plus main-color pointer stepper_up"  data-rowId="{{$item->rowId}}" data-id="{{$item->model->id}}"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-lg-3 text-right">
                                                            <div class="h5 mb-0 mx-2">{{$item->model->price}} {{__('core.SAR')}}</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                  @endforeach
                                                @endif



                            
                                                
                                                <!-- Discount and promocode -->
                                
                                                <div class="bg-white shadow-sm rounded mb-3 p-3" dir="ltr">
                                                    <div class="row align-items-center no-gutters p-md-2">
                                
                                                        <div class="col-lg-7">
                                                            <div class="py-2">
                                                                <label>Promo code:</label>
                                                                <input type="text" value="" class="form-control form-control-sm w-auto" name="couponcode" id="couponcode" placeholder="Coupon code" />
                                                            </div>
                                                        </div>
                                
                                                        <div class="col-lg-5 text-right pt-4">
                                                            <a  class="btn btn-primary btn-sm btn-rounded px-lg-5 applycode">APPLY</a>
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
                                                <h3 class="{{$text}}">Choose Delivery Address</h3>
                                                <div class="accordion br-sm" id="accordionLocationExample">
                                
                                @foreach($locations as $location)
                                                    <div class="card card-fill mb-3 shadow-sm rounded">
                                                        <div class="card-header p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-9">
                                                                    <div class="custom-control custom-radio d-flex align-items-center">
                                                                        <input type="radio" id="{{$location->id}}" name="loationRadio" data-lat="{{$location->lat}}" data-lng="{{$location->lng}}" data-delivery_address="{{$location->delivery_address}}" class="custom-control-input locationRdbtn" data-toggle="collapse" data-target="#collapseOne1" aria-controls="collapseOne1" @if($loop->index == 0) checked @endif>
                                                                        <label class="custom-control-label pl-2 pl-lg-4" for="{{$location->id}}">
                                                                            <span class="h6 m-0">{{$location->delivery_address}}</span><br />
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="collapseOne1" class="collapse pt-0" aria-labelledby="{{$location->id}}" data-parent="#accordionLocationExample">
                                                            <hr class="m-0">
                                                        </div>
                                                    </div>
                                
                                @endforeach                            
                                
                                                    
                                                </div>


                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#LocationModal"> Add New Location</a>

                                                

                                                <div class="form-group">

                                                </div>
                                                   
                                                <hr>

                                                <!-- Date -->
                                                <h3 class="{{$text}}">Choose Delivery Date</h3>
                                                
                                                <input type="date" class="form-control" name="delivery_date">


                                            </div>
                                        </div>
                                        
                                    </section>

                                    <h6>Payment</h6>
                                    <section class="my-4">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-10 col-xl-8">
                                
                                                <h3 class="pre-label font-size-base {{$text}}">Choose Payment Method</h3>
                                
                                                <!-- Checkout credit card -->
                                
                                                <div class="accordion br-sm" id="accordionPaymentExample">
                               <!-- 
                                                    <div class="card card-fill mb-3 shadow-sm rounded">
                                                        <div class="card-header p-3">
                                                            <div class="row align-items-center">
                                                                <div class="col-9">
                                                                    <div class="custom-control custom-radio d-flex align-items-center">
                                                                        <input type="radio" id="customRadio1" name="payment_method" class="custom-control-input form-radio" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
                                                                        <label class="custom-control-label px-2 px-lg-4" for="customRadio1">
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
                                                                        <label class="custom-control-label px-2 px-lg-4" for="customRadio2">
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
                                                                        <label class="custom-control-label px-2 px-lg-4" for="customRadio3">
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
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>

                                                <h3 class="{{$text}}">Payment Summary</h3>
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


                                                <div class="bg-white shadow-sm rounded mb-3 p-3 p-md-5">
    
                                                    <div class="row">
                                
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                              
                                                                <p>Press Finish to Place Your Order To Be Delivered To you As Soon As Possible</p>
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
                        toastr.success(data.msg);
                        
                        setTimeout(function () 
                        {
                            window.location.replace("{{route('profile')}}");
                        }, 3000);
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
                        toastr.success(data.msg);

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