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

@extends('layouts.admin')

@section('style')

@endsection

@section('content')


    <!-- Header -->
    <div class="header bg-gradient-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7 {{$text}}">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('admin.HOME-DASHBOARD')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('city.index')}}">{{__('admin.NAV-DELIVERYFEE')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ isset($shipping) ? __('admin.SHIPPINGFEECREATE-EDITDATA') : __('admin.SHIPPINGFEECREATE-ADDNEW')}}</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 {{$inverse_text}}">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End: Header -->


    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
            <div class="card card-defualt">
                <div class="card-header">{{ isset($shipping) ?  __('admin.SHIPPINGFEECREATE-EDITDATA') : __('admin.SHIPPINGFEECREATE-ADDNEW') }} </div>
        
                <div class="card-body">
                    <form action="{{ isset($shipping) ? route('shipping.update', $shipping->id) : route('shipping.store')  }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @if (isset($shipping))
                           @method('PUT')
                        @endif
                        
                        <div class="row">
                            <!--=================  Distance =================-->
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">{{ __('admin.SHIPPINGFEECREATE-DISTANCEINKILO')}}</label>
                                <input type="text" name="distance" class="@error('distance') is-invalid @enderror form-control" placeholder="??????????????" value="{{ isset($shipping) ? $shipping->distance  : old('distance') }}" disabled>
                            
                                @error('distance')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>
        
                            <!--=================  Price  =================-->
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">{{ __('admin.SHIPPINGFEECREATE-DILIVERYFEE')}}</label>
                                <input type="text" name="price" class="@error('price') is-invalid @enderror form-control" placeholder="???????? ??????????????" value="{{ isset($shipping) ? $shipping->price : old('price') }}" required>
                            
                                @error('price')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>
            
                            
                        </div>
                        <hr class="my-3">

                          
        
                        <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ isset($shipping) ?  __('admin.SHIPPINGFEECREATE-EDIT'):__('admin.SHIPPINGFEECREATE-ADD') }}</button>
                        </div>
        
                    </form>
                </div>
        
            </div>
        </div>
      </div>
      <!-- Footer -->
      <footer class="footer pt-0">
      </footer>
    </div>

@endsection


@section('script')
 
@endsection
