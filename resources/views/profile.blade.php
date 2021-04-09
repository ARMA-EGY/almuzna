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


					
                    <nav>
                        <div class="nav nav-tabs mb-5" id="nav-tab" role="tablist">
                          <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">{{__('core.ACCOUNT')}}</a>
                          <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">{{__('core.LOCATIONS')}}</a>
                          <a class="nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">{{__('core.ORDERS')}}</a>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">

                        <!-- ACCOUNT -->
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row">
        
                                <div class="col-md-5">
                                    <!-- User card -->
                                    <div class="card mb-4 profile-card is-auto">
                                        <div class="card-body">
                                            <div class="profile-image">
                                                <img src="{{ asset('front_assets/images/avatar1.png')}}" alt="">
                                            </div>
                                            <div class="username text-center">
                                                <span>{{$user['name']}}</span>
                                            <?php     
                                                $time = strtotime($user['created_at']);
                                                $newformat = date('M d Y',$time);
                                            ?>

                                                <small>Member since {{$newformat}}</small>
                                            </div>
                                        </div>
                                        <div class="profile-footer text-center">
                                            <span class="achievement-title">{{__('core.WALLET')}}</span>
                                            <div class="count">
                                                {{$user['wallet']}} {{__('core.SAR')}}
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
        
                                
                                <div class="col-md-7">
                                    <div class="card profile-info-card is-auto animated preFadeInUp fadeInUp">
                                        <!-- Title -->
                                        <div class="card-title">
                                            <h3>{{__('core.ACCOUNT-DETAILS')}}</h3>
        
                                            <div class="edit-account has-simple-popover popover-hidden-mobile" data-content="Edit Account" data-placement="top">
                                                <a href="#" data-toggle="modal" data-target="#AccountDetailsModal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings feather-icons"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></a>
                                            </div>
                                        </div>
                                        <!-- Contact Info -->
                                        <div class="card-body {{$text}}" dir="{{ $dir }}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="info-block">
                                                        <span class="label-text">{{__('core.NAME')}}</span>
                                                        <span class="label-value">{{$user['name']}}</span>
                                                    </div>
        
                                                    <div class="info-block">
                                                        <span class="label-text">{{__('core.EMAIL')}}</span>
                                                        <span class="label-value">{{$user['email']}}</span>
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="info-block">
                                                        <span class="label-text">{{__('core.PHONE')}}</span>
                                                        <span class="label-value">+966 {{$user['phone']}}</span>
                                                    </div>

                                                    <div class="info-block">
                                                        <span class="label-text">{{__('core.BIRTHDATE')}}</span>
                                                        <span class="label-value">{{$user['dateofbirth']}}</span>
                                                    </div>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="info-block">
                                                        <span class="label-text">{{__('core.GENDER')}}</span>
                                                        <span class="label-value">{{$user['gender']}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                   
                                </div>

                            </div>
                        </div>

                        <!-- LOCATIONS -->
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                            <div class="row">
        
                                <div class="col-md-4">
                                    <!-- List of Locations -->
                                    <div class="card is-auto menu-card">
                                        <div class="card-title">
                                            <h3>{{__('core.ADD-LOCATION')}}</h3>
        
                                            <div class="edit-account">
                                                <a href="javascript:void(0);" class="modal-trigger has-simple-popover" data-toggle="modal" data-target="#LocationModal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus feather-icons"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>
                                            </div>
                                        </div>

                                        <div class="nav flex-column nav-pills nav-locations {{$text}}" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active" id="v-pills-location1-tab" data-toggle="pill" href="#v-pills-location1" role="tab" aria-controls="v-pills-location1" aria-selected="true">{{__('core.LOCATION')}} #1</a>
                                            <a class="nav-link" id="v-pills-location2-tab" data-toggle="pill" href="#v-pills-location2" role="tab" aria-controls="v-pills-location2" aria-selected="false">{{__('core.LOCATION')}} #2</a>
                                        </div>

                                    </div>
                                </div>
                                
        
                                <div class="col-md-8">
                                    <div class="tab-content {{$text}}" id="v-pills-tabContent" dir="{{ $dir }}">

                                        <div class="tab-pane fade show active" id="v-pills-location1" role="tabpanel" aria-labelledby="v-pills-location1-tab">
                                            <!-- Address Info -->
                                            <div class="card profile-info-card is-auto animated preFadeInUp fadeInUp">
                                                <!-- Title -->
                                                <div class="card-title">
                                                    <h3>{{__('core.LOCATION-DETAILS')}}</h3>
                                                    <!-- Cog Button -->
                                                    <div class="edit-account is-vhidden">
                                                        <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings feather-icons"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></a>
                                                    </div>
                
                                                </div>
                                                <!-- Billing Address -->
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="info-block">
                                                                <span class="label-text">Number</span>
                                                                <span class="label-value">23, Block C2</span>
                                                            </div>
                
                                                            <div class="info-block">
                                                                <span class="label-text">City</span>
                                                                <span class="label-value">Los Angeles</span>
                                                            </div>
                
                                                            <div class="info-block">
                                                                <span class="label-text">State</span>
                                                                <span class="label-value">CA</span>
                                                            </div>
                                                        </div>
                
                                                        <div class="col-md-6">
                                                            <div class="info-block">
                                                                <span class="label-text">Street</span>
                                                                <span class="label-value">Church Street</span>
                                                            </div>
                
                                                            <div class="info-block">
                                                                <span class="label-text">Postal Code</span>
                                                                <span class="label-value">100065</span>
                                                            </div>
                
                                                            <div class="info-block">
                                                                <span class="label-text">Country</span>
                                                                <span class="label-value">United States</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /Address Form -->
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-location2" role="tabpanel" aria-labelledby="v-pills-location2-tab">
                                            <!-- Address Info -->
                                            <div class="card profile-info-card is-auto animated preFadeInUp fadeInUp">
                                                <!-- Title -->
                                                <div class="card-title">
                                                    <h3>{{__('core.LOCATION-DETAILS')}}</h3>
                                                    <!-- Cog Button -->
                                                    <div class="edit-account is-vhidden">
                                                        <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings feather-icons"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></a>
                                                    </div>
                
                                                </div>
                                                <!-- Billing Address -->
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="info-block">
                                                                <span class="label-text">Number</span>
                                                                <span class="label-value">23, Block C2</span>
                                                            </div>
                
                                                            <div class="info-block">
                                                                <span class="label-text">City</span>
                                                                <span class="label-value">Los Angeles</span>
                                                            </div>
                
                                                            <div class="info-block">
                                                                <span class="label-text">State</span>
                                                                <span class="label-value">CA</span>
                                                            </div>
                                                        </div>
                
                                                        <div class="col-md-6">
                                                            <div class="info-block">
                                                                <span class="label-text">Street</span>
                                                                <span class="label-value">Church Street</span>
                                                            </div>
                
                                                            <div class="info-block">
                                                                <span class="label-text">Postal Code</span>
                                                                <span class="label-value">100065</span>
                                                            </div>
                
                                                            <div class="info-block">
                                                                <span class="label-text">Country</span>
                                                                <span class="label-value">United States</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /Address Form -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                        </div>

                        <!-- ORDERS -->
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                            <div class="row">
                                <!-- Orders panel -->
                                <div class="col-md-4">
                                    <div class="card mb-4 profile-card is-auto list-card {{$text}}" dir="{{ $dir }}">
                                        <div class="list-card-header">
                                            {{__('core.ORDERS-LIST')}}
                                        </div>
                                        <!-- List -->
                                        <div class="nav flex-column nav-pills nav-locations" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link active" id="v-pills-order1-tab" data-toggle="pill" href="#v-pills-order1" role="tab" aria-controls="v-pills-order1" aria-selected="true">{{__('core.ORDER')}} #70</a>
                                            <a class="nav-link" id="v-pills-order2-tab" data-toggle="pill" href="#v-pills-order2" role="tab" aria-controls="v-pills-order2" aria-selected="false">{{__('core.ORDER')}} #72</a>
                                        </div>
                                        
                                    </div>
                                </div>
        
                                <div class="col-md-8">


                                    <div class="tab-content {{$text}}" dir="{{ $dir }}" id="v-pills-tabContent2">

                                        <div class="tab-pane fade show active" id="v-pills-order1" role="tabpanel" aria-labelledby="v-pills-order1-tab">
                                            <div class="card profile-card is-auto order-list-card animated preFadeInUp fadeInUp">
                                                <div class="progress-block">
                                                    <!-- Title -->
                                                    <h3>ORDER 46895</h3>
                                                </div>
        
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <!-- Order status -->
                                                        <div class="order-block">
                                                            <div class="order-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg>
                                                            </div>
                                                            <div class="status">
                                                                <div>Status</div>
                                                                <div><span class="tag primary-tag">Shipping</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="col-md-6">
                                                        <!-- Order date -->
                                                        <div class="order-block">
                                                            <div class="order-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                                            </div>
                                                            <div class="date">
                                                                <div>Date</div>
                                                                <div class="is-date">mar 23 2018</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        
                                                </div>
                                                
                                                <!-- Order details -->
                                                <div class="table-block">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Product</th>
                                                                <th scope="col">SKU</th>
                                                                <th scope="col">Quantity</th>
                                                                <th scope="col">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td data-label="Product">Shipping A1</td>
                                                                <td data-label="SKU">-</td>
                                                                <td data-label="Quantity">1</td>
                                                                <td data-label="Total">$39,00</td>
                                                            </tr>
                                                            <tr>
                                                                <td data-label="Product">Conqueror</td>
                                                                <td data-label="SKU">587</td>
                                                                <td data-label="Quantity">1</td>
                                                                <td data-label="Total">$295,00</td>
                                                            </tr>
                                                            <tr>
                                                                <td data-label="Product">Gentleman</td>
                                                                <td data-label="SKU">029</td>
                                                                <td data-label="Quantity">1</td>
                                                                <td data-label="Total">$349,99</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-7">
                                                    </div>
                                                    <!-- Total subtable -->
                                                    <div class="col-md-5">
                                                        <table class="table table-sm sub-table text-right my-4">
                                                            <tbody><tr>
                                                                <td><span class="subtotal">Subtotal</span></td>
                                                                <td class="text-right"><span class="subtotal-value">481,90</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="vat">VAT (20%)</span></td>
                                                                <td class="text-right"><span class="vat-value">96,38</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="total">Total</span></td>
                                                                <td class="text-right"><span class="total-value">578,28</span></td>
                                                            </tr>
                                                        </tbody></table>
                                                    </div>
                                                </div>
        
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="v-pills-order2" role="tabpanel" aria-labelledby="v-pills-order2-tab">
                                            <div class="card profile-card is-auto order-list-card animated preFadeInUp fadeInUp">
                                                <div class="progress-block">
                                                    <!-- Title -->
                                                    <h3>ORDER 46895</h3>
                                                </div>
        
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <!-- Order status -->
                                                        <div class="order-block">
                                                            <div class="order-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line></svg>
                                                            </div>
                                                            <div class="status">
                                                                <div>Status</div>
                                                                <div><span class="tag primary-tag">Shipping</span></div>
                                                            </div>
                                                        </div>
                                                    </div>
        
                                                    <div class="col-md-6">
                                                        <!-- Order date -->
                                                        <div class="order-block">
                                                            <div class="order-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                                            </div>
                                                            <div class="date">
                                                                <div>Date</div>
                                                                <div class="is-date">mar 23 2018</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        
                                                </div>
                                                
                                                <!-- Order details -->
                                                <div class="table-block">
                                                    <table>
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Product</th>
                                                                <th scope="col">SKU</th>
                                                                <th scope="col">Quantity</th>
                                                                <th scope="col">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td data-label="Product">Shipping A1</td>
                                                                <td data-label="SKU">-</td>
                                                                <td data-label="Quantity">1</td>
                                                                <td data-label="Total">$39,00</td>
                                                            </tr>
                                                            <tr>
                                                                <td data-label="Product">Conqueror</td>
                                                                <td data-label="SKU">587</td>
                                                                <td data-label="Quantity">1</td>
                                                                <td data-label="Total">$295,00</td>
                                                            </tr>
                                                            <tr>
                                                                <td data-label="Product">Gentleman</td>
                                                                <td data-label="SKU">029</td>
                                                                <td data-label="Quantity">1</td>
                                                                <td data-label="Total">$349,99</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-7">
                                                    </div>
                                                    <!-- Total subtable -->
                                                    <div class="col-md-5">
                                                        <table class="table table-sm sub-table text-right my-4">
                                                            <tbody><tr>
                                                                <td><span class="subtotal">Subtotal</span></td>
                                                                <td class="text-right"><span class="subtotal-value">481,90</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="vat">VAT (20%)</span></td>
                                                                <td class="text-right"><span class="vat-value">96,38</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><span class="total">Total</span></td>
                                                                <td class="text-right"><span class="total-value">578,28</span></td>
                                                            </tr>
                                                        </tbody></table>
                                                    </div>
                                                </div>
        
                                            </div>
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
                    <form>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="street">Street</label>
                            <input type="text" class="form-control" id="street">
                          </div>

                          <div class="form-group col-md-6">
                            <label for="building">Building</label>
                            <input type="text" class="form-control" id="building">
                          </div>

                          <div class="form-group col-md-6">
                            <label for="floor">Floor</label>
                            <input type="text" class="form-control" id="floor">
                          </div>

                          <div class="form-group col-md-6">
                            <label for="apartment">Apartment</label>
                            <input type="text" class="form-control" id="apartment">
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="inputCity">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="inputState">State</label>
                            <select id="inputState" class="form-control">
                              <option selected>Choose...</option>
                              <option>...</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputAddress">Address</label>
                          <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>
                        
                      </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
            </div>
        </div>



        <!-- Edit Account Details Modal -->
        <div class="modal fade" id="AccountDetailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Account Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form class="update-profile">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-12">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" disabled value="+966 {{$user['phone']}}">
                          </div>

                          <div class="form-group col-12">
                            <label for="username">Name</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{$user['name']}}">
                          </div>

                          <div class="form-group col-12">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$user['email']}}">
                          </div>

                          <div class="form-group col-12">
                            <label for="birthdate">Birthdate</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate">
                          </div>
                        </div>

                        <div class="form-row">
                          <div class="form-group col-12">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender" class="form-control">
                              <option <?php if($user['gender']=="male" ) { echo 'selected';} ?> >Male</option>
                              <option <?php if($user['gender']=="female" ) { echo 'selected';} ?> >Female</option>
                            </select>
                          </div>
                        </div>
                        
                      </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary sub-prf-frm">Add</button>
                </div>
            </div>
            </div>
        </div>

@endsection


@section('script')

<script type="text/javascript">
    $(document).ready(function(){
    $(".sub-prf-frm").click(function(){        
        $(".update-profile").submit();
    });

    $('.update-profile').submit(function(e){
            e.preventDefault();
            $.ajax({
                url:"{{route('profileUpdate')}}",
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
                    window.location.replace("{{route('welcome')}}");
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
                    if(data.msg == 'Profile is updated successfully')
                    {
                        $('#AccountDetailsModal').modal('hide'); 
                    }
                    
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
            })


    });    
});
</script>
@endsection