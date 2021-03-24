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
						<h2>{{__('core.CONTACT-US')}}</h2>
					</div>

					<div class="content-103">
						<div class="container">
							<div class="row justify-content-center">
								
								<div class="col-lg-4">
									<div class="service-post px-2" style="height: 250px;">
										<div class="service-content">
											<div class="service-icon">
													<i class="fas fa-map-marker-alt"></i>
											</div> <!-- service-icon -->
											<h3 class="service-title"><strong>{{__('core.ADDRESS')}}</strong></h3>
											<p class="service-description">{{__('core.address')}}</p>
										</div> <!-- service-content -->
										<div class="service-hover"></div>
									</div>
								</div>
								
								<div class="col-lg-4">
									<div class="service-post px-2" style="height: 250px;">
										<div class="service-content">
											<div class="service-icon">
												<i class="fas fa-envelope"></i>
											</div> <!-- .s-icon -->
											<h3 class="service-title"><strong>{{__('core.EMAIL')}}</strong></h3>
											<p class="service-description">{{__('core.email')}}</p>
										</div> <!-- service-content -->
										<div class="service-hover"></div>
									</div>
								</div>
								
								<div class="col-lg-4">
									<div class="service-post px-2" style="height: 250px;">
										<div class="service-content">
											<div class="service-icon">
												<i class="fas fa-mobile-alt"></i>
											</div> <!-- .s-icon -->
											<h3 class="service-title"><strong>{{__('core.PHONE')}}</strong></h3>
											<p class="service-description" dir="ltr">{{__('core.phone')}}</p>
										</div> <!-- service-content -->
										<div class="service-hover"></div>
									</div>
								</div>
								
							</div>
						</div>
					</div>

					<div class="content-103">
						<div class="container">
							<div class="row">
								<div class="col-lg-6 {{$text}}">
									<div class="heading_s1">
										<h2>{{__('core.GET-IN-TOUCH')}}</h2>
									</div>
									<p class="leads"></p>
									<div class="field_form">
										<form class="contact_form">
											@csrf
											<div class="row">
												<div class="form-group col-md-6">
													<input required="" placeholder="{{__('core.NAME')}}" id="first-name" class="form-control field" name="name" type="text">
												 </div>
												<div class="form-group col-md-6">
													<input required="" placeholder="{{__('core.EMAIL')}}" id="email" class="form-control field" name="email" type="email">
												</div>
												<div class="form-group col-md-6">
													<input required="" placeholder="{{__('core.PHONE')}}" id="phone" class="form-control field" name="phone">
												</div>
												<div class="form-group col-md-6">
													<input placeholder="{{__('core.SUBJECT')}}" id="subject" class="form-control field" name="subject">
												</div>
												<div class="form-group col-md-12">
													<textarea required="" placeholder="{{__('core.MESSAGE')}}" id="description" class="form-control field" name="message" rows="4"></textarea>
												</div>
												<div class="col-md-12">
													<button type="submit" title="Submit Your Message!" class="button button-small bg-white button-light btn-line-fill submit" id="submitButton" name="submit" style="border: 1px solid #000;">{{__('core.SEND-MESSAGE')}}</button>
												</div>
												<div class="col-md-12">
													<div id="alert-msg" class="alert-msg text-center"></div>
												</div>
											</div>
										</form>		
									</div>
								</div>
								<div class="col-lg-6 pt-2 pt-lg-0 mt-4 mt-lg-0">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3628.532629947883!2d46.7502197146951!3d24.570807984191354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2f0f3825ac42a3%3A0xe5a29eeb9f76389!2s509%2C%20Riyadh%2014714%2C%20Saudi%20Arabia!5e0!3m2!1sen!2seg!4v1614627161087!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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