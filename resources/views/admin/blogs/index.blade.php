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
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Posts</li>
                </ol>
              </nav>
            </div>

            <div class="col-lg-6 col-5 text-right">
              <a href="{{ route('blogs.create')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> New Post</a>
            </div>

            @if(session()->has('success'))	
                <div class="alert alert-success alert-dismissible fade show m-auto" role="alert">
                    {{ session()->get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
            @endif

          </div>
        </div>
      </div>
    </div>
    <!-- End: Header -->


    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">All Posts  <span class="badge badge-primary p-2">{{$blog_count}}</span></h3>
                </div>
              </div>
            </div>

            @if ($blogs->count() > 0)

            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush display nowrap" id="example">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Author</th>
                    <th scope="col">Publish Date</th>
                    <th scope="col">Views</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($blogs as $blog)

                  <tr class="parent">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                     <b> {{  $blog->title }} </b>
                    </td>
                    <td> <span class="badge badge-default category-badge">{{$blog->category->name}}</span> </td>
                    <td> <b>{{  $blog->user->name }}</b> </td>
                    <td>
                      {{ $blog->created_at->format('d-m-Y') }}
                    </td>
                    <td>
                      <span >{{ number_format($blog->visits->sum('views')) }}</span>
                    </td>
                    <td >
                      <div class="dropdown">
                        <a class="btn btn-sm btn-icon-only text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                          <a href="{{ route('blogs.edit', $blog->id)}}" class="dropdown-item"><i class="fa fa-edit text-success"></i> Edit</a>
                          <button class="dropdown-item remove_item" data-id="{{$blog->id}}" data-url="{{route('remove-blog')}}"><i class="fa fa-trash-alt text-danger"></i> Remove</button>
                          <button data-token="{{$blog->token}}" class="dropdown-item get_seo"><i class="fas fa-share-alt text-purple"></i> SEO</button>
                        </div>
                      </div>
                    </td>
                  </tr>

                  @endforeach
                 
                </tbody>
                <tfoot>
                    <tr>
                        <th class="p-2">No.</th>
                        <th class="p-2">Title</th>
                        <th class="p-2">Category</th>
                        <th class="p-2">Author</th>
                        <th class="p-2">Publish Date</th>
                        <th class="p-2">Views</th>
                        <th class="p-2"></th>
                    </tr>
                </tfoot>
              </table>
            </div>


            @else 
                <p class="text-center"> No Posts Yet.</p>
            @endif

            <!-- Card footer -->
            <div class="card-footer py-2">
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

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>


<script>

  $(document).ready(function() {
      // Setup - add a text input to each footer cell
      $('#example tfoot th').each( function () {
          var title = $(this).text();
          $(this).html( '<input type="text" placeholder=" '+title+'" />' );
      } );
  
      // DataTable
      var table = $('#example').DataTable({
          initComplete: function () {
              // Apply the search
              this.api().columns().every( function () {
                  var that = this;
  
                  $( 'input', this.footer() ).on( 'keyup change clear', function () {
                      if ( that.search() !== this.value ) {
                          that
                              .search( this.value )
                              .draw();
                      }
                  } );
              } );
          },
          "pagingType": "numbers",
      });
  
  } );

</script>
    
@endsection