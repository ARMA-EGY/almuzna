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

<style>
  .image-card
  {
      border-radius: 10px;
      border: 1px solid rgb(41 52 144 / 50%);
      box-shadow: 0px 3px 16px rgba(0, 0, 0, 0.05);
  }
</style>

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
                  <li class="breadcrumb-item"><a href="{{route('offers.index')}}">{{__('admin.NAV-OFFERS')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ isset($offer) ? __('admin.OFFERSCREATE-EDITDATA') : __('admin.OFFERSCREATE-ADDNEW') }}</li>
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
                <div class="card-header">{{ isset($offer) ? __('admin.OFFERSCREATE-EDITDATA') : __('admin.OFFERSCREATE-ADDNEW') }} </div>
        
                <div class="card-body">
                    <form action="{{ isset($offer) ? route('offers.update', $offer->id) : route('offers.store')  }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @if (isset($offer))
                           @method('PUT')
                        @endif
                        
                        <div class="row">
                        <!--=================  Name  =================-->
        
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">{{__('admin.OFFERSCREATE-NAMEEN')}}</label>
                                <input type="text" name="name_en" class="@error('name_en') is-invalid @enderror form-control" placeholder="{{__('admin.OFFERSCREATE-NAMEPLCEN')}}" value="{{ isset($offer) ? $offer->name_en : old('name_en') }}" required>
                            
                                @error('name_en')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>
        
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">{{__('admin.OFFERSCREATE-NAMEAR')}}</label>
                                <input type="text" name="name_ar" class="@error('name_ar') is-invalid @enderror form-control text-right" placeholder="{{__('admin.OFFERSCREATE-NAMEPLCAR')}}" value="{{ isset($offer) ? $offer->name_ar : old('name_ar') }}" required>
                            
                                @error('name_ar')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>

                        <!--=================  Description  =================-->
        
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">{{__('admin.OFFERSCREATE-DESRIPTIONEN')}}</label>
                                <input type="text" name="description_en" class="@error('description_en') is-invalid @enderror form-control" placeholder="{{__('admin.OFFERSCREATE-DESRIPTIONPLCEN')}}" value="{{ isset($offer) ? $offer->description_en : old('description_en') }}" >
                            
                                @error('description_en')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>
        
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">{{__('admin.OFFERSCREATE-DESRIPTIONAR')}}</label>
                                <input type="text" name="description_ar" class="@error('description_ar') is-invalid @enderror form-control text-right" placeholder="{{__('admin.OFFERSCREATE-DESRIPTIONPLCAR')}}" value="{{ isset($offer) ? $offer->description_ar : old('description_ar') }}" >
                            
                                @error('description_ar')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>
            
                            
                        </div>
                        <hr class="my-3">

                        
                        <div class="row">
                            
                            <!--=================  Price  =================-->
                                    
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">{{__('admin.OFFERSCREATE-PRICE')}}</label>
                                <input type="text" name="price" class="@error('price') is-invalid @enderror form-control" placeholder="{{__('admin.OFFERSCREATE-PRICEPLC')}}" value="{{ isset($offer) ? $offer->price : old('price') }}" required>

                                @error('price')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror

                            </div>

                            <!--================= Old Price  =================-->
            
                              {{-- <div class="form-group col-md-6 mb-2">
                                  <label class="font-weight-bold text-uppercase">Old Price</label>
                                  <input type="text" name="old_price" class="@error('old_price') is-invalid @enderror form-control" placeholder="Offer Old Price" value="{{ isset($offer) ? $offer->old_price : old('old_price') }}" >
                              
                                  @error('old_price')
                                      <div>
                                          <span class="text-danger">{{ $message }}</span>
                                      </div>
                                  @enderror
              
                              </div> --}}

                        </div>
                          <hr class="my-3">
        
                        <!--=================  IMAGES  =================-->
        
                        @if (isset($offer))
                            <div class="form-group text-right">
                                <label for="image">{{__('admin.OFFERSCREATE-IMAGE')}}????????????</label>
                                <img src="{{ asset('storage/'.$offer->image) }}" alt="" width="100%">
                            </div>
                        @endif
        
                        <div class="form-group text-right">
                            <label for="image">{{__('admin.OFFERSCREATE-IMAGE')}}</label>
                            <input id="image" type="file" name="image" accept="image/*" class="@error('image') is-invalid @enderror form-control form-control-sm" >
                        
                            @error('image')
                                <div>
                                     <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
        
                        </div>
                        <hr class="my-3">
        
                        <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ isset($offer) ?  __('admin.OFFERSCREATE-EDIT'):__('admin.OFFERSCREATE-ADD') }}</button>
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
    <script src="https://cdn.tiny.cloud/1/mq6umcdg6y938v1c32lokocdpgrgp5g2yl794h4y1braa6j6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
            tinymce.init({
                    selector:'textarea.content',
                    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                    toolbar: 'undo redo | bold italic underline strikethrough | fontselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                });

            $('.add_image').click(function(){

                $("#append_images").append('<div class="form-row parent"><div class="form-group col-md-4 mb-1"><label class="text-sm"> Image</label class="text-sm"><input type="file" accept="image/*" class="form-control form-control-sm" name="image[]" required></div><div class="form-group col-md-4 mb-1"><label class="text-sm">Alt</label><input type="text" class="form-control form-control-sm" name="alt[]" ></div><div class="form-group col-md-2 mb-1 text-center"><label class="text-sm">Primary</label><div class="form-check"> <input class="form-check-input choose_selected" type="radio" name="select" value="1" ><input type="hidden" class="selected" name="selected[]" value="0"></div></div><div class="form-group col-md-2 m-auto"><a class="btn btn-sm btn-danger remove text-white"><i class="fa fa-trash "></i> Remove </a></div></div>');

            });

            $(document).on("click",".choose_selected", function()
            {
                $('.selected').val(0);
                $(this).next('.selected').val(1);
            });
            
            $(document).on("click",".remove", function()
            {
                $(this).parents('.parent').remove();
            });
      
    </script>
@endsection
