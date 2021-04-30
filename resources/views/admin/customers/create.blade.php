@extends('layouts.admin')

@section('style')

@endsection

@section('content')


    <!-- Header -->
    <div class="header bg-gradient-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('admin.HOME-DASHBOARD')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{route('customers.index')}}">{{__('admin.NAV-CUSTOMERS')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ isset($customer) ?  __('admin.CUTOMERSCREATE-EDITDATA') : __('admin.CUTOMERSCREATE-ADDNEW') }}</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-left">
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
                <div class="card-header">{{ isset($customer) ? __('admin.CUTOMERSCREATE-EDITDATA') : __('admin.CUTOMERSCREATE-ADDNEW') }} </div>
        
                <div class="card-body">
                    <form action="{{ isset($customer) ? route('customers.update', $customer->id) : route('customers.store')  }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @if (isset($customer))
                           @method('PUT')
                        @endif
                        
                        <div class="row">
                            <!--=================  Name  =================-->
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">{{__('admin.CUTOMERSCREATE-NAME')}}</label>
                                <input type="text" name="name" class="@error('name') is-invalid @enderror form-control" placeholder="{{__('admin.CUTOMERSCREATE-NAMEPLC')}}" value="{{ isset($customer) ? $customer->name : old('name') }}" >
                            
                                @error('name')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>
        
                            <!--=================  Phone  =================-->
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">{{__('admin.CUTOMERSCREATE-PHONE')}}</label>
                                <input type="text" name="phone" class="@error('phone') is-invalid @enderror form-control" placeholder="{{__('admin.CUTOMERSCREATE-PHONEPLC')}} " value="{{ isset($customer) ? $customer->phone : old('phone') }}" required>
                            
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
                                <label class="font-weight-bold text-uppercase">{{__('admin.CUTOMERSCREATE-EMAIL')}}</label>
                                <input type="text" name="email" class="@error('email') is-invalid @enderror form-control" placeholder="{{__('admin.CUTOMERSCREATE-EMAILPLC')}}" value="{{ isset($customer) ? $customer->email : old('email') }}" >
                            
                                @error('email')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>

                            <!--=================  Gender  =================-->
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">{{__('admin.CUTOMERSCREATE-GENDER')}}</label>

                                <select class="form-control" name="gender" id="input-gender" required>
                                    <option value="Female" @isset($customer) @if ($customer->gender == 'Femail') selected  @endif @endisset >انثى</option>
                                    <option value="Male" @isset($customer) @if ($customer->gender == 'Male') selected  @endif @endisset>ذكر</option>
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
                        <button type="submit" class="btn btn-success">{{ isset($customer) ?   __('admin.CUTOMERSCREATE-EDIT'):__('admin.CUTOMERSCREATE-ADD')}}</button>
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
