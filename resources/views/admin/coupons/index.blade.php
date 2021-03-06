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

            <div class="col-lg-6 col-7 {{$text}}">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('admin.HOME-DASHBOARD')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{__('admin.NAV-COUPONS')}}</li>
                </ol>
              </nav>
            </div>

            <div class="col-lg-6 col-5 {{$inverse_text}}">
              <a href="{{ route('coupons.create')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i>{{__('admin.COUPONS-ADDNEW')}}</a>
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
                  <h3 class="mb-0">{{__('admin.COUPONS-TOTALCOUPONS')}}<span class="badge badge-primary p-2">{{$coupons_count}}</span></h3>
                </div>
              </div>
            </div>

            @if ($coupons->count() > 0)

            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush display nowrap" id="example">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col" class="sort" >{{__('admin.COUPONS-TABLE-CODE')}}</th>
                    <th scope="col" class="sort" >{{__('admin.COUPONS-TABLE-START')}}</th>
                    <th scope="col" class="sort" >{{__('admin.COUPONS-TABLE-EXPIRE')}}</th>
                    <th scope="col" class="sort" >{{__('admin.COUPONS-TABLE-DISCOUNT')}}</th>
                    <th scope="col" class="sort" >{{__('admin.COUPONS-TABLE-CLIENTUSAGE')}} </th>
                    <th scope="col" class="sort" >{{__('admin.COUPONS-TABLE-USAGE')}}  </th>
                    <th scope="col" class="sort" >{{__('admin.COUPONS-TABLE-TYPE')}} </th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>

                  @foreach ($coupons as $coupon)

                  <tr class="parent">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                     <b> {{  $coupon->code }} </b>
                    </td>
                    <td>{{ $coupon->start_date }}</td>
                    <td>{{ $coupon->end_date }}</td>
                    <td>{{ $coupon->discount }} @if ($coupon->type == 'percentage') % @elseif ($coupon->type == 'cash') ???? @endif</td>
                    <td>{{ $coupon->use_num }}</td>
                    <td>{{ $coupon->used }}</td>
                    <td>@if ($coupon->private == 0) ?????? @elseif ($coupon->private == 1) ?????? @endif</td>
                    <td>
                      <a href="{{ route('coupons.edit', $coupon->id)}}" class="btn btn-primary btn-sm mx-1"><i class="fa fa-edit"></i>{{__('admin.COUPONS-TABLE-EDIT')}} </a>
                    </td>
                  </tr>

                  @endforeach
                 
                </tbody>
              </table>
            </div>


            @else 
                <p class="text-center"> No Coupons Yet.</p>
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
$('#example').DataTable( {
    "pagingType": "numbers"
  } );
</script>
    
@endsection