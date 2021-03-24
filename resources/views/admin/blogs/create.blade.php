@extends('layouts.admin')


@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <style>
    .select2-container .select2-search--inline {display: unset;}
    </style>

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
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item"><a href="{{route('blogs.index')}}">Posts</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{ isset($blog) ? 'Edit Post' : 'Create Post' }}</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 text-right">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End: Header -->


    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row justify-content-center">

        <div class="col-xl-10">
        
        <form action="{{ isset($blog) ? route('blogs.update', $blog->id) : route('blogs.store')  }}" method="post" enctype="multipart/form-data">
            @csrf
            
            @if (isset($blog))
                @method('PUT')
            @endif

            <!--=================  Post Details  =================-->
            <div class="card card-defualt">
                <div class="card-header"> {{ isset($blog) ? 'Edit Post Details' : 'Add Post Details' }}</div>
        
                <div class="card-body">
        
                        <!--=================  Title  =================-->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" type="text" name="title" class="@error('title') is-invalid @enderror form-control" placeholder="Add New Title" value="{{ isset($blog) ? $blog->title : old('title') }}">
                        
                            @error('title')
                                <div>
                                     <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
        
                        </div>
        
                        <!--=================  Description  =================-->
                        <div class="form-group">
                            <label for="description">Summary & Description (Meta Tag)</label>
                            <textarea id="description" type="text" name="description" class="@error('description') is-invalid @enderror form-control" rows="2" placeholder="Add Summary & Description">{{ isset($blog) ? $blog->description : old('description') }}</textarea>
                        
                            @error('description')
                                <div>
                                     <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
        
                        </div>
        
                        <!--=================  Keywords  =================-->
                        <div class="form-group">
                            <label for="keywords">Keywords (Meta Tag)</label>
                            <textarea id="keywords" type="text" name="keywords" class="@error('keywords') is-invalid @enderror form-control" rows="2" placeholder="Add Keywords">{{ isset($blog) ? $blog->keywords : old('keywords') }}</textarea>
                        
                            @error('keywords')
                                <div>
                                     <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
        
                        </div>

                        <!--=================  Category  =================-->
                        <div class="form-group">
                            <label for="categoryid">Category</label>
                            <select id="categoryid" name="category_id" class="@error('categoryID') is-invalid @enderror form-control" required>
                                @if (!isset($blog))
                                    <option value="" selected>Choose...</option>
                                @endif
                                
                                @foreach ($categories as $category)
                                    
                                    <option value="{{$category->id}}" @if (isset($blog)) @if ($category->id == $blog->category_id) selected @endif @endif> {{$category->name}} </option>
        
                                @endforeach
                            </select>
        
                            @error('categoryID')
                                <div>
                                    <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
        
                        </div>
        
                        <!--=================  Tags  =================-->
                        @if ($tags->count() > 0)
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <select id="tags" class="tags form-control" name="tags[]" multiple="multiple">
                                    @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}" @if (isset($blog))  @if ($blog->hasTag($tag->id)) selected @endif @endif>{{$tag->name}}</option>
                                    @endforeach
                                </select>
        
                            </div>
                        @endif
        
                        <!--=================  Page URL  =================-->
                        <div class="form-group">
                            <label for="url">URL<small> (If you leave it blank, it will be generated automatically.)</small></label>
                            <input id="url" type="text" name="url" class="@error('url') is-invalid @enderror form-control" rows="2" placeholder="Add URL" value="{{ isset($blog) ? $blog->url : old('url') }}">
                        
                            @error('url')
                                <div>
                                     <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
        
                        </div>
                        
                </div>
        
            </div>

            <!--=================  Image  =================-->
            <div class="card card-defualt">
                <div class="card-header"> Image</div>
        
                <div class="card-body">
        
                        <!--=================  Image  =================-->
        
                        @if (isset($blog))
                            <div class="form-group">
                                <img src="{{ asset('storage/'.$blog->image) }}" alt="" width="100%">
                            </div>
                        @endif
        
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input id="image" type="file" name="image" accept="image/*" class="@error('image') is-invalid @enderror form-control" >
                        
                            @error('image')
                                <div>
                                     <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
        
                        </div>
        
                        <!--=================  Alt Image  =================-->
        
                        <div class="form-group">
                            <label for="alt_image">Alt <small> (Image Description)</small></label>
                            <input id="alt_image" type="text" name="alt_image" class="@error('alt_image') is-invalid @enderror form-control" rows="2" placeholder="Add Alt Image" value="{{ isset($blog) ? $blog->alt_image : old('alt_image') }}">
                        
                            @error('alt_image')
                                <div>
                                     <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
        
                        </div>
                </div>
            </div>

            <!--=================  Content  =================-->
            <div class="card card-defualt">
                <div class="card-header"> Content</div>
                <div class="card-body">
                        <div class="form-group">
                            <textarea id="content" class="content" name="content" rows="20">{{ isset($blog) ? $blog->content : old('content') }}</textarea>
                            @error('content')
                                <div>
                                     <span class="text-danger">{{ $message }}</span>
                                </div>
                            @enderror
        
                        </div>
                </div>
            </div>

            <!--=================  Save Post  =================-->
            <div class="card card-defualt">
                <div class="card-body">
                    <input type="hidden" name="userID" value="{{Auth::user()->id}}">
                    <div class="form-group mb-0">
                        <button type="submit" name="status" value="0" class="btn btn-warning">Save as Draft</button>
                        <button type="submit" name="status" value="1" class="btn btn-success">{{ isset($blog) ? 'Save as Post' : 'Add Post' }}</button>
                    </div>
                </div>
            </div>

        </form>
        </div>

      </div>
      <!-- Footer -->
      <footer class="footer pt-0">
      </footer>
    </div>

@endsection


@section('script')
  <script src="https://cdn.tiny.cloud/1/mq6umcdg6y938v1c32lokocdpgrgp5g2yl794h4y1braa6j6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
  
  <script>
        $(document).ready(function() {
            $(".tags").select2({
                multiple: true,
            });
        });

    

        tinymce.init({
                selector:'textarea.content',
                plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            });
    </script>
@endsection
