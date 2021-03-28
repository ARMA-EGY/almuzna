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
                  <li class="breadcrumb-item"><a href="{{route('home')}}">لوحة التحكم</a></li>
                  <li class="breadcrumb-item"><a href="{{route('city.index')}}">قيمة التوصيل</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ isset($city) ? 'تعديل بيانات المنطقة' : 'اضافة منطقة جديدة' }}</li>
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
                <div class="card-header">{{ isset($city) ? 'تعديل بيانات المنطقة' : 'اضافة منطقة جديدة' }} </div>
        
                <div class="card-body">
                    <form action="{{ isset($city) ? route('city.update', $city->id) : route('city.store')  }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @if (isset($city))
                           @method('PUT')
                        @endif
                        
                        <div class="row">
                            <!--=================  Name Ar =================-->
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">اسم المدينة</label>
                                <input type="text" name="name_ar" class="@error('name_ar') is-invalid @enderror form-control" placeholder="اسم المدينة" value="{{ isset($city) ? $city->name_ar : old('name_ar') }}" >
                            
                                @error('name_ar')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>
        
                            <!--=================  Name En  =================-->
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">اسم المدينة بالانجليزية</label>
                                <input type="text" name="name_en" class="@error('name_en') is-invalid @enderror form-control" placeholder="اسم المدينة بالانجليزية" value="{{ isset($city) ? $city->name_en : old('name_en') }}" required>
                            
                                @error('name_en')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>
            
                            
                        </div>
                        <hr class="my-3">

                        
                        <div class="row">

                            <!--================= AREA Ar  =================-->
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">اسم المنطقة</label>
                                <input type="text" name="area_ar" class="@error('area_ar') is-invalid @enderror form-control" placeholder="اسم المنطقة" value="{{ isset($city) ? $city->area_ar : old('area_ar') }}" >
                            
                                @error('area_ar')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>

                            <!--================= AREA En  =================-->
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">اسم المنطقة بالانجليزية</label>
                                <input type="text" name="area_en" class="@error('area_en') is-invalid @enderror form-control" placeholder="اسم المنطقة بالانجليزية" value="{{ isset($city) ? $city->area_en : old('area_en') }}" >
                            
                                @error('area_en')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>

                        </div>
                          <hr class="my-3">

                        
                          <div class="row">
  
                              <!--================= Delivery Fees  =================-->
                              <div class="form-group col-md-6 mb-2 text-right">
                                  <label class="font-weight-bold text-uppercase">قيمة التوصيل</label>
                                  <input type="number" name="delivery_fees" class="@error('delivery_fees') is-invalid @enderror form-control" placeholder="قيمة التوصيل" value="{{ isset($city) ? $city->delivery_fees : old('delivery_fees') }}" >
                              
                                  @error('delivery_fees')
                                      <div>
                                          <span class="text-danger">{{ $message }}</span>
                                      </div>
                                  @enderror
              
                              </div>
  
                              <!--=================  Available  =================-->
                              <div class="form-group col-md-6 mb-2 text-right">
                                  <label class="font-weight-bold text-uppercase">متاح التوصيل الان</label>
  
                                  <select class="form-control" name="available" id="input-gender" required>
                                      <option value="0" @isset($city) @if ($city->available == '0') selected  @endif @endisset >غير متاح</option>
                                      <option value="1" @isset($city) @if ($city->available == '1') selected  @endif @endisset>متاح</option>
                                  </select>
                              
                                  @error('available')
                                      <div>
                                          <span class="text-danger">{{ $message }}</span>
                                      </div>
                                  @enderror
              
                              </div>
  
                          </div>
                            <hr class="my-3">
                          
        
                        <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ isset($city) ? 'حفظ' : 'اضافة' }}</button>
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
