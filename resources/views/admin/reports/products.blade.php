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
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css">

<style>
  .search_number input
  {
    width: 40px;
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
                  <li class="breadcrumb-item"><a href="#">{{__('admin.NAV-REPORTS')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{__('admin.NAV-PRODUCTS')}}</li>
                </ol>
              </nav>
            </div>

            <div class="col-lg-6 col-5 {{$inverse_text}}">
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
                  <h3 class="mb-0">{{__('admin.PRODUCT-TOTALPRODUCTs')}}  <span class="badge badge-primary p-2">{{$products_count}}</span></h3>
                </div>
              </div>
            </div>

            @if ($products->count() > 0)


            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush display nowrap" id="example">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="sort" >{{__('admin.PRODUCT-TABLE-NAME')}}</th>
                    <th scope="col" class="sort" >{{__('admin.PRODUCT-TABLE-DESCRIPTION')}}</th>
                    <th scope="col" class="sort" >{{__('admin.PRODUCT-TABLE-PRICE')}}</th>
                    <th scope="col" class="sort" >{{__('admin.PRODUCT-TABLE-TYPE')}} </th>
                    <th scope="col" class="sort" >{{__('admin.PRODUCT-TABLE-SOLD')}} </th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($products as $product)

                  <tr class="parent">
                    <td>{{ $loop->iteration }}</td>
                    <td> <b>  {{  $product->name_ar }} </b> </td>
                    <td>{{ $product->description_ar }}</td>
                    <td>{{ $product->price }}</td>
                    <td> @if ($product->refill == 0) جديد @elseif ($product->refill == 1) اعادة تعبئة @endif </td>
                    <td>{{ number_format($product->report->sum('quantity')) }}</td>
                  </tr>

                  @endforeach
                 
                </tbody>
                <tfoot>
                    <tr>
                        <th class="p-2 search_number"></th>
                        <th scope="col" class="sort p-2" >{{__('admin.PRODUCT-TABLE-NAME')}}</th>
                        <th scope="col" class="sort p-2" >{{__('admin.PRODUCT-TABLE-DESCRIPTION')}}</th>
                        <th scope="col" class="sort p-2" >{{__('admin.PRODUCT-TABLE-PRICE')}}</th>
                        <th scope="col" class="sort p-2" >{{__('admin.PRODUCT-TABLE-TYPE')}} </th>
                        <th scope="col" class="sort p-2" >{{__('admin.PRODUCT-TABLE-SOLD')}} </th>
                    </tr>
                </tfoot>
              </table>
            </div>

            

            @else 
                <p class="text-center"> لا يوجد منتجات</p>
            @endif

            <!-- Card footer -->
            <div class="card-footer py-2">
            </div>

          </div>
        </div>

        <div class="col-12">
          <div class="row">

            <div class="col-md-4">
              <button class="btn btn-primary btn-sm total">Show Total Sold</button>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
              <h3 class="btn btn-success btn-sm" id="totals"></h3>
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
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.20/api/sum().js"></script>


<script>

var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[6] );
 
        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'MMMM Do YYYY'
    });


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
 
 
    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
    });

    $('.total').on('click', function () {
      console.log(table.rows( { search: 'applied' }).data().pluck(5).sum());
      $('#totals').text(table.rows( { search: 'applied' }).data().pluck(5).sum());
    })

});



</script>
    
@endsection