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
    
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

@endsection

@section('content')

    <!-- Header -->
    <div class="header bg-gradient-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">

            <div class="col-lg-6 col-7">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('admin.HOME-DASHBOARD')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{__('admin.NAV-SLIDESHOW')}}  </li>
                </ol>
              </nav>
            </div>

            <div class="col-lg-6 col-5 text-right">

              <form class="upload_photo_form upload_form" action="{{route('admin-update-slider')}}" method="POST" enctype="multipart/form-data">

                <label for="upload_photo" class="btn btn-sm btn-neutral" ><i class="fa fa-plus"></i> Upload Photo</label>
      
                <input class="hidden-input change_photo" id="upload_photo" type="file" name="photo[]" multiple>
                <input type="hidden" name="lang" value="{{$lang2}}">
              </form>
              
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

          <div class="row" id="slider_photos">


              @foreach ($photos as $photo)
          
                  <div class="col-md-4 edit-section parent">
                      <button class="btn btn-danger btn-sm edit2 remove_item" data-id="{{$photo->id}}" data-url="{{route('remove-slider')}}">
                        <i class="fas fa-trash-alt text-white"></i>
                      </button>
                        <a data-fancybox="gallery" href="{{asset('storage/'.$photo->image)}}">
                          <img  class="img-fluid rounded" src="{{asset('storage/'.$photo->image)}}">
                        </a> 
                    </div>
                  
              @endforeach
            
        </div>

        </div>
      </div>
      <!-- Footer -->
      <footer class="footer pt-0">
      </footer>
    </div>
  

@endsection



@section('script')
   

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>


<script>
  $('#example').DataTable( {
      "pagingType": "numbers"
    } );


    // CHANGE PHOTOS 
    
    $(document).on('change', '.change_photo', function(){
      
      $(this).parent('.upload_form').submit();
      
      });	


    $(function() {
         $(document).ready(function()
         {
            var bar     = $('.bar');
            var percent = $('.percent');
	          var status  = $('.status');

              $('.upload_photo_form').ajaxForm({
                beforeSend: function() 
                {
                    var percentVal = '0%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                    $('#upload_modal').modal('show');
                },
                uploadProgress: function(event, position, total, percentComplete) 
                {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal)
                    percent.html(percentVal);
                },
                success : function(response)
                {
                    $('#upload_modal').modal('hide');
                    $('#slider_photos').html(response);
                }
            });
          }); 
        });

</script>
    
@endsection
