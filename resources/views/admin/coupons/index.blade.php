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

            <div class="col-lg-6 col-7 text-right">
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{route('home')}}">لوحة التحكم</a></li>
                  <li class="breadcrumb-item active" aria-current="page">الكوبونات</li>
                </ol>
              </nav>
            </div>

            <div class="col-lg-6 col-5 text-left">
              <a href="{{ route('coupons.create')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> اضافة كوبون</a>
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
                  <h3 class="mb-0">اجمالي الكوبونات  <span class="badge badge-primary p-2">{{$coupons_count}}</span></h3>
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
                    <th scope="col" class="sort" >كود الكوبون</th>
                    <th scope="col" class="sort" >تاريخ الابتداء</th>
                    <th scope="col" class="sort" >تاريخ الانتهاء</th>
                    <th scope="col" class="sort" >الخصم</th>
                    <th scope="col" class="sort" >عدد الاستخدامات للعميل</th>
                    <th scope="col" class="sort" >عدد استخدامات الكوبون</th>
                    <th scope="col" class="sort" >نوع الكوبون</th>
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
                    <td>{{ $coupon->discount }} @if ($coupon->type == 'percentage') % @elseif ($coupon->type == 'cash') رس @endif</td>
                    <td>{{ $coupon->use_num }}</td>
                    <td>{{ $coupon->used }}</td>
                    <td>@if ($coupon->private == 0) عام @elseif ($coupon->private == 1) خاص @endif</td>
                    <td>
                      <a href="{{ route('coupons.edit', $coupon->id)}}" class="btn btn-primary btn-sm mx-1"><i class="fa fa-edit"></i> تعديل</a>
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