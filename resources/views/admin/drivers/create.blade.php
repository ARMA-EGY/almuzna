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
                  <li class="breadcrumb-item"><a href="{{route('drivers.index')}}">{{__('admin.NAV-DRIVERS')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ isset($driver) ?    __('admin.DRIVERSCREATE-EDITDATA') : __('admin.DRIVERSCREATE-ADDNEW') }}</li>
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
                <div class="card-header">{{ isset($driver) ? __('admin.DRIVERSCREATE-EDITDATA') : __('admin.DRIVERSCREATE-ADDNEW') }} </div>
        
                <div class="card-body">
                    <form action="{{ isset($driver) ? route('drivers.update', $driver->id) : route('drivers.store')  }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @if (isset($driver))
                           @method('PUT')
                        @endif
                        
                        <div class="row">
                            <!--=================  Name  =================-->
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">{{__('admin.DRIVERSCREATE-NAME')}}</label>
                                <input type="text" name="name" class="@error('name') is-invalid @enderror form-control" placeholder="{{__('admin.DRIVERSCREATE-NAMEPLC')}}" value="{{ isset($driver) ? $driver->name : old('name') }}" >
                            
                                @error('name')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>
        
                            <!--=================  Phone  =================-->
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">{{__('admin.DRIVERSCREATE-PHONE')}}</label>
                                <input type="text" name="phone" class="@error('phone') is-invalid @enderror form-control" placeholder="{{__('admin.DRIVERSCREATE-PHONEPLC')}}" value="{{ isset($driver) ? $driver->phone : old('phone') }}" required>
                              
                                @error('phone')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>
            
                            
                        </div>
                        <hr class="my-3">

                        
                        <div class="row">

                            <!--================= Email  =================-->
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">{{__('admin.DRIVERSCREATE-EMAIL')}}</label>
                                <input type="text" name="email" class="@error('email') is-invalid @enderror form-control" placeholder="{{__('admin.DRIVERSCREATE-EMAILPLC')}}" value="{{ isset($driver) ? $driver->email : old('email') }}" >
                            
                                @error('email')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>

                            <!--=================  Gender  =================-->
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">{{__('admin.DRIVERSCREATE-GENDER')}}</label>

                                <select class="form-control" name="gender" id="input-gender" required>
                                    <option value="Female" @isset($driver) @if ($driver->gender == 'Femail') selected  @endif @endisset >????????</option>
                                    <option value="Male" @isset($driver) @if ($driver->gender == 'Male') selected  @endif @endisset>??????</option>
                                </select>
                            
                                @error('gender')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>

                        </div>
                          <hr class="my-3">
                          
        
                        <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ isset($driver) ? __('admin.DRIVERSCREATE-EDIT'):__('admin.DRIVERSCREATE-ADD') }}</button>
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
