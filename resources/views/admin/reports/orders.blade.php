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
                  <li class="breadcrumb-item active" aria-current="page">{{__('admin.ALLORDERS-ALLORDERS')}}</li>
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
                  <h3 class="mb-0">{{__('admin.ALLORDERS-TOTALORDERS')}}  <span class="badge badge-primary p-2">{{$orders_count}}</span></h3>
                </div>
              </div>
            </div>

            @if ($orders->count() > 0)

            <table cellspacing="5" cellpadding="5">
              <tbody>
                <tr>
                    <td>Date From:</td>
                    <td><input type="text" id="min" name="min"></td>
                </tr>
                <tr>
                    <td>Date To:</td>
                    <td><input type="text" id="max" name="max"></td>
                </tr>
              </tbody>
            </table>

            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush display nowrap" id="example">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="sort" >{{__('admin.ALLORDERS-TABLE-CODE')}}</th>
                    <th scope="col" class="sort" > {{__('admin.DATE')}}</th>
                    <th scope="col" class="sort" >{{__('admin.ALLORDERS-TABLE-TOTAL')}}</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($orders as $order)

                  <tr class="parent">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                     <b> # {{  $order->id }} </b>
                    </td>
                    <td>{{ $order->created_at->format('Y/m/d') }}</td>
                    <td>{{ $order->total }}</td>
                    <td>
                      <a href="#" class="btn btn-warning btn-sm mx-1 get_order_details" data-id="{{  $order->id }}"><i class="fa fa-eye"></i>{{__('admin.ALLORDERS-TABLE-VIEW')}}</a>
                    </td>
                  </tr>

                  @endforeach
                 
                </tbody>
              </table>
            </div>

            

            @else 
                <p class="text-center"> لا يوجد طلبات</p>
            @endif

            <!-- Card footer -->
            <div class="card-footer py-2">
            </div>

          </div>
        </div>

        <div class="col-12">
          <div class="row">

            <div class="col-md-4">
              <button class="btn btn-primary btn-sm total">Show Total</button>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
              <h3 id="totals"></h3>
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
        var date = new Date( data[2] );
 
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
 
    // DataTables initialisation
    var table = $('#example').DataTable( {
                    "pagingType": "numbers"
                  } );
 
    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
    });

    $('.total').on('click', function () {
      console.log(table.rows( { search: 'applied' }).data().pluck(3).sum());
      $('#totals').text(table.rows( { search: 'applied' }).data().pluck(3).sum());
    })

});




  $('.get_order_details').click(function()
        {
            var orderid 	= $(this).attr('data-id');
            var loader 	= $('#loader').attr('data-load');

            $('#popup').modal('show');
            $('#modal_body').html(loader);

            $.ajax({
                url:"{{route('get-order-details')}}",
                type:"POST",
                dataType: 'text',
                data:    {"_token": "{{ csrf_token() }}",
                            orderid: orderid},
                success : function(response)
                    {
                    $('#modal_body').html(response);
                    }  
                })

        });

</script>
    
@endsection