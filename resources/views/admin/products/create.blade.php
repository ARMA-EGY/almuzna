@extends('layouts.admin')

@section('style')

<style>
  .image-card
  {
      border-radius: 10px;
      border: 1px solid rgb(41 52 144 / 50%);
      box-shadow: 0px 3px 16px rgba(0, 0, 0, 0.05);
  }

  .box2
  {
      display: none;
  }
</style>

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
                  <li class="breadcrumb-item"><a href="{{route('products.index')}}">المنتجات</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ isset($product) ? 'تعديل منتج' : 'اضافة منتج' }}</li>
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
                <div class="card-header">{{ isset($product) ? 'تعديل منتج' : 'اضافة منتج جديد' }} </div>
        
                <div class="card-body">
                    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store')  }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @if (isset($product))
                           @method('PUT')
                        @endif
                        
                        <div class="row">
                        <!--=================  Name  =================-->
        
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">الاسم بالانجليزية</label>
                                <input type="text" name="name_en" class="@error('name_en') is-invalid @enderror form-control" placeholder="Product Name" value="{{ isset($product) ? $product->name_en : old('name_en') }}" required>
                            
                                @error('name_en')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>
        
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">الاسم بالعربية</label>
                                <input type="text" name="name_ar" class="@error('name_ar') is-invalid @enderror form-control text-right" placeholder="اسم المنتج" value="{{ isset($product) ? $product->name_ar : old('name_ar') }}" required>
                            
                                @error('name_ar')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>

                            <!--=================  Category  =================-->
                            <input type="hidden" name="category_id" value="0">
            
                            
                        </div>
                        <hr class="my-3">

                        
                        
                        <div class="row">

                            <!--=================  Price  =================-->
                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">السعر</label>
                                <input type="number" name="price" class="@error('price') is-invalid @enderror form-control" placeholder="سعر المنتج" value="{{ isset($product) ? $product->price : old('price') }}" required>
                            
                                @error('price')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>

                        </div>
                          <hr class="my-3">

                          <div class="row">

                            <div class="form-group col-md-6 mb-2 text-right">
                                <label class="font-weight-bold text-uppercase">يوجد اعادة تعبئة؟</label>

                                <select class="form-control" id="on_sale" name="refill" id="input-gender" required>
                                    <option value="0" @isset($product) @if ($product->refill == '0') selected  @endif @endisset >لا</option>
                                    <option value="1" @isset($product) @if ($product->refill == '1') selected  @endif @endisset>نعم</option>
                                  </select>

                                @error('refill')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group col-md-6 mb-2 box2 text-right">
                                <label class="font-weight-bold text-uppercase">سعر اعادة التعبئه</label>
                                <input type="number" id="sale_price" name="refill_price" class="@error('refill_price') is-invalid @enderror form-control" placeholder="سعر اعادة التعبئه" value="{{ isset($product) ? $product->refill_price : old('refill_price') }}" >
                            
                                @error('refill_price')
                                    <div>
                                        <span class="text-danger">{{ $message }}</span>
                                    </div>
                                @enderror
            
                            </div>

                        </div>
                          <hr class="my-3">
        
                        <!--=================  IMAGES  =================-->
        
                        @if (isset($product))
                            <div class="form-group text-right">
                                <label for="image">الصورة</label>
                                <img src="{{ asset('storage/'.$product->photo) }}" alt="" width="100%">
                            </div>
                        @endif
        
                        <div class="form-group text-right">
                            <label for="image">الصورة</label>
                            <input id="image" type="file" name="photo" accept="image/*" class="@error('photo') is-invalid @enderror form-control" >
                        
                            @error('photo')
                                <div>
                                     <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
        
                        </div>
                        <hr class="my-3">
        
                        <div class="form-group">
                        <button type="submit" class="btn btn-success">{{ isset($product) ? 'حفظ' : 'اضافة' }}</button>
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

            $("#on_sale").on("change",function() 
            {
                if ($(this).val() === '1') 
                    {
                        $('.box2').slideDown();
                        $("#sale_price").prop('required',true);
                    }

                else if ($(this).val() === '0')  
                    {
                        $('.box2').slideUp();
                        $("#sale_price").prop('required',false);
                    }
                    
            });
      
    </script>
@endsection
