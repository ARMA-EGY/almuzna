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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
    .select2-container .select2-search--inline {display: unset;}
    </style>

    @if (isset($coupon)) 
      @if ($coupon->type == 'private')
        <style>
          .box2
          {
              display: unset;
          }
        </style>

      @elseif ($coupon->type == 'public')
      
        <style>
          .box2
          {
              display: none;
          }
        </style>
      @endif 

    @else
      <style>
        .box2
        {
            display: none;
        }
      </style>
    @endif 

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
                  <li class="breadcrumb-item"><a href="{{route('home')}}">لوحة التحكم</a></li>
                  <li class="breadcrumb-item"><a href="{{route('coupons.index')}}">الكوبونات</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ isset($coupon) ? 'تعديل الكوبون' : 'اضافة كوبون' }}</li>
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
                <div class="card-header">{{ isset($coupon) ? 'تعديل الكوبون' : 'اضافة كوبون جديد' }} </div>
        
                <div class="card-body">
                    <form action="{{ isset($coupon) ? route('coupons.update', $coupon->id) : route('coupons.store')  }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @if (isset($coupon))
                           @method('PUT')
                        @endif
                        
                        <div class="row">
                            <!--=================  Code  =================-->
                            <div class="form-group col-md-4 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">الكود</label>
                                <input type="text" name="code" class="@error('code') is-invalid @enderror form-control" placeholder="كود الكوبون" value="{{ isset($coupon) ? $coupon->code : old('code') }}" >
                            
                                @error('code')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>
        
                            <!--=================  Type  =================-->
                            <div class="form-group col-md-4 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">نوع الخصم</label>

                                <select class="form-control" name="type" required>
                                  <option value="percentage" @isset($coupon) @if ($coupon->type == 'percentage') selected  @endif @endisset >نسبة مئوية</option>
                                  <option value="cash" @isset($coupon) @if ($coupon->type == 'cash') selected  @endif @endisset>كاش</option>
                                </select>
  
                                @error('type')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>
        
                            <!--=================  Discount  =================-->
                            <div class="form-group col-md-4 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">قيمة الخصم</label>
                            
                                <input type="number" name="discount" class="@error('discount') is-invalid @enderror form-control" placeholder="قيمة الخصم" value="{{ isset($coupon) ? $coupon->discount : old('discount') }}" >

                                @error('discount')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>
            
                            
                        </div>
                        <hr class="my-3">

                        
                        <div class="row">

                          <!--=================  Number of use per customer  =================-->
                          <div class="form-group col-md-4 mb-2 text-right">
                            <label class="font-weight-bold text-uppercase">عدد الاستخدامات لكل عميل</label>
                        
                            <select class="form-control" name="use_num" id="input-gender" required>
                              <option value="1" @isset($coupon) @if ($coupon->use_num == '1') selected  @endif @endisset >1</option>
                              <option value="2" @isset($coupon) @if ($coupon->use_num == '2') selected  @endif @endisset>2</option>
                              <option value="3" @isset($coupon) @if ($coupon->use_num == '3') selected  @endif @endisset>3</option>
                              <option value="4" @isset($coupon) @if ($coupon->use_num == '4') selected  @endif @endisset>4</option>
                              <option value="5" @isset($coupon) @if ($coupon->use_num == '5') selected  @endif @endisset>5</option>
                              <option value="6" @isset($coupon) @if ($coupon->use_num == '6') selected  @endif @endisset>6</option>
                              <option value="7" @isset($coupon) @if ($coupon->use_num == '7') selected  @endif @endisset>7</option>
                              <option value="8" @isset($coupon) @if ($coupon->use_num == '8') selected  @endif @endisset>8</option>
                              <option value="9" @isset($coupon) @if ($coupon->use_num == '9') selected  @endif @endisset>9</option>
                              <option value="10" @isset($coupon) @if ($coupon->use_num == '10') selected  @endif @endisset>10</option>
                              <option value="0" @isset($coupon) @if ($coupon->use_num == '0') selected  @endif @endisset>غير محدد</option>
                            </select>

                            @error('use_num')
                                <div>
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
        
                          </div>

                            <!--================= Start Date  =================-->
                            <div class="form-group col-md-4 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">تاريخ الابتداء</label>
                                <input type="date" name="start_date" class="@error('start_date') is-invalid @enderror form-control" placeholder="Start Date" value="{{ isset($coupon) ? $coupon->start_date : old('start_date') }}" required>
                            
                                @error('start_date')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>

                            <!--================= End Date  =================-->
                            <div class="form-group col-md-4 mb-2 text-right">
                              <label class="font-weight-bold text-uppercase">تاريخ الانتهاء</label>
                              <input type="date" name="end_date" class="@error('end_date') is-invalid @enderror form-control" placeholder="End Date" value="{{ isset($coupon) ? $coupon->end_date : old('end_date') }}" required>
                          
                              @error('end_date')
                                  <div>
                                      <span class="text-danger">{{ $message }}</span>
                                  </div>
                              @enderror
          
                          </div>

                        </div>

                        <hr class="my-3">

                        
                        <div class="row">
        
                          <!--=================  Private  =================-->
                          <div class="form-group col-md-4 mb-2 text-right">
                              <label class="font-weight-bold text-uppercase">نوع الكوبون</label>
                          
                              <select class="form-control" name="private" id="private" required>
                                <option value="0" @isset($coupon) @if ($coupon->type == 0) selected  @endif @endisset >عام</option>
                                <option value="1" @isset($coupon) @if ($coupon->type == 1) selected  @endif @endisset>خاص</option>
                              </select>

                              @error('private')
                                  <div>
                                      <span class="text-danger">{{ $message }}</span>
                                  </div>
                              @enderror
          
                          </div>

                        </div>


                        <!--=================  Customers  =================-->
                        <div class="form-group box2 mt-4 text-right">
                          <label for="customers">تحديد العملاء</label>
                          <select id="customers" class="customers form-control" name="customers[]" multiple="multiple">
                              @foreach ($customers as $customer)
                                  <option value="{{$customer->id}}" @if (isset($coupon))  @if ($coupon->hasCustomer($customer->id)) selected @endif  @endif>{{$customer->phone}}</option>
                              @endforeach
                          </select>
  
                        </div>
                        <hr class="my-3">

                          
                          
        
                        <div class="form-group">
                          <button type="submit" class="btn btn-success">{{ isset($coupon) ? 'حفظ' : 'اضافة' }}</button>
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
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  
  <script>
        $(document).ready(function() {
            $(".customers").select2({
                multiple: true,
            });

            $("#private").on("change",function() 
            {
                if ($(this).val() === '1') 
                    {
                        $('.box2').slideDown();
                    }

                else if ($(this).val() === '0')  
                    {
                        $('.box2').slideUp();
                    }
            });

        });
    </script>
@endsection
