@extends('layouts.admin')

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
                  <li class="breadcrumb-item active" aria-current="page">الاعدادات</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End: Header -->

    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
        
        
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">الاعدادات </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form class="configuration_form">
                @csrf

                <h6 class="heading-small text-muted text-right mb-4"> قيمة الحد الادنى للطلب </h6>
                <div class="pr-lg-4">
                  <div class="row">

                      <div class="input-group col-9 mb-3 px-0">
                        <div class="input-group-prepend">
                          <label for="minimum" class="input-group-text" id="basic-addon1"><i class="fas fa-shopping-basket"></i></label>
                        </div>
                        <input type="hidden" name="name[]" value="{{$order_min_price->name}}">
                        <input type="hidden" name="type[]" value="{{$order_min_price->type}}">
                        <input id="minimum" class="form-control" type="number" name="value[]" placeholder="50.00" autocomplete="off" aria-describedby="basic-addon1" value="{{$order_min_price->value}}">
                      </div>
                      
                  </div>
                  
                </div>
                <hr class="my-4" />

                <h6 class="heading-small text-muted text-right mb-4"> أقصى قيمة للطلب للتوصيل في نفس اليوم </h6>
                <div class="pr-lg-4">
                  <div class="row">

                      <div class="input-group col-9 mb-3 px-0">
                        <div class="input-group-prepend">
                          <label for="maximum" class="input-group-text" id="basic-addon1"><i class="fas fa-truck"></i></label>
                        </div>
                        <input type="hidden" name="name[]" value="{{$today_max_price->name}}">
                        <input type="hidden" name="type[]" value="{{$today_max_price->type}}">
                        <input id="maximum" class="form-control" type="number" name="value[]" placeholder="500.00" autocomplete="off" aria-describedby="basic-addon1" value="{{$today_max_price->value}}">
                      </div>
                      
                  </div>
                  
                </div>
                <hr class="my-4" />

                <h6 class="heading-small text-muted text-right mb-4"> ضريبة المبيعات</h6>
                <div class="pr-lg-4">
                  <div class="row">

                      <div class="input-group col-9 mb-3 px-0">
                        <div class="input-group-prepend">
                          <label for="tax" class="input-group-text" id="basic-addon1"><i class="fas fa-percent"></i></label>
                        </div>
                        <input type="hidden" name="name[]" value="{{$sales_tax->name}}">
                        <input type="hidden" name="type[]" value="{{$sales_tax->type}}">
                        <input id="tax" class="form-control" type="number" name="value[]" placeholder="12.5" autocomplete="off" aria-describedby="basic-addon1" value="{{$sales_tax->value}}">
                      </div>
                      
                  </div>
                  
                </div>
                <hr class="my-4" />

                <h6 class="heading-small text-muted text-right mb-4"> قيمة التوصيل الافتراضية</h6>
                <div class="pr-lg-4">
                  <div class="row">

                      <div class="input-group col-9 mb-3 px-0">
                        <div class="input-group-prepend">
                          <label for="tax" class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill-alt"></i></label>
                        </div>
                        <input type="hidden" name="name[]" value="{{$delivery_fees->name}}">
                        <input type="hidden" name="type[]" value="{{$delivery_fees->type}}">
                        <input id="tax" class="form-control" type="number" name="value[]" placeholder="12.5" autocomplete="off" aria-describedby="basic-addon1" value="{{$delivery_fees->value}}">
                      </div>
                      
                  </div>
                  
                </div>
                <hr class="my-4" />

                <h6 class="heading-small text-muted text-right mb-4"> الحد الاقصى لتوصيل الطلبات للسائقين في اليوم</h6>
                <div class="pr-lg-4">
                  <div class="row">

                      <div class="input-group col-9 mb-3 px-0">
                        <div class="input-group-prepend">
                          <label for="tax" class="input-group-text" id="basic-addon1"><i class="fas fa-user-astronaut"></i></label>
                        </div>
                        <input type="hidden" name="name[]" value="{{$driver_order_limit->name}}">
                        <input type="hidden" name="type[]" value="{{$driver_order_limit->type}}">
                        <input id="tax" class="form-control" type="number" name="value[]" placeholder="12.5" autocomplete="off" aria-describedby="basic-addon1" value="{{$driver_order_limit->value}}">
                      </div>
                      
                  </div>
                  
                </div>
                <hr class="my-4" />


                <!-- Save -->
                <div class="col-12 text-right">
                  <button type="submit" class="btn btn-sm btn-primary submit">حفظ التغيرات</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        
        <div class="col-xl-12 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">تخفيض على اول طلب </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form class="first_order_form">
                @csrf

                <div class="pr-lg-4">
                  <div class="row">

                    <div class="form-group col-md-4 mb-2 text-right">
                        <h6 class="heading-small text-muted text-right">نوع الخصم</h6>

                        <select class="form-control" name="type" required>
                          <option value="percentage"  @if ($first_order_discount->type == 'percentage') selected  @endif  >نسبة مئوية</option>
                          <option value="cash"  @if ($first_order_discount->type == 'cash') selected  @endif >كاش</option>
                        </select>

                        @error('type')
                            <div>
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
    
                    </div>

                    <!--=================  Discount  =================-->
                    <div class="form-group col-md-4 mb-2 text-right">
                        <h6 class="heading-small text-muted text-right">قيمة الخصم</h6>
                    
                        <input type="number" name="value" class="@error('discount') is-invalid @enderror form-control" placeholder="قيمة الخصم" value="{{$first_order_discount->value}}" >

                        @error('value')
                            <div>
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-3">
                      <input type="checkbox" class="check_off" name="off2" value="0" data-toggle="toggle" data-size="sm" @if ($first_order_discount->off == '0') checked @endif>
                      <input type="hidden" class="off" name="off" @if ($first_order_discount->off == '1') value="1" @else value="0" @endif>
                    </div>
                      
                  </div>
                  
                </div>
                <hr class="my-4" />


                <!-- Save -->
                <div class="col-12 text-right">
                  <button type="submit" class="btn btn-sm btn-primary submit">حفظ التغيرات</button>
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
    

<script>

  $('.configuration_form').submit(function(e)
    {
        e.preventDefault();
        $('.submit').prop('disabled', true);
        $('.error').text('');

        var head1 	= 'Done';
        var title1 	= 'Data Saved Successfully. ';
        var head2 	= 'Oops...';
        var title2 	= 'Something went wrong, please try again later.';


        $.ajax({
            url: 		"{{route('configurationEdit')}}",
            method: 	'POST',
            dataType: 	'json',
            data:		$(this).serialize()	,
            success : function(data)
                {
                    $('.submit').prop('disabled', false);
                    
                    if (data['status'] == 'true')
                    {
                        Swal.fire(
                                head1,
                                title1,
                                'success'
                                )
                    }
                    else if (data['status'] == 'false')
                    {
                        Swal.fire(
                                head2,
                                title2,
                                'error'
                                )
                    }
                },
            error : function(reject)
                {
                    $('.submit').prop('disabled', false);

                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val)
                    {
                        Swal.fire(
                                head2,
                                val[0],
                                'error'
                                )
                    });
                }
            
            
        });

  });


  $('.first_order_form').submit(function(e)
    {
        e.preventDefault();
        $('.submit').prop('disabled', true);
        $('.error').text('');

        var head1 	= 'Done';
        var title1 	= 'Data Saved Successfully. ';
        var head2 	= 'Oops...';
        var title2 	= 'Something went wrong, please try again later.';


        $.ajax({
            url: 		"{{route('firstorderdiscount')}}",
            method: 	'POST',
            dataType: 	'json',
            data:		$(this).serialize()	,
            success : function(data)
                {
                    $('.submit').prop('disabled', false);
                    
                    if (data['status'] == 'true')
                    {
                        Swal.fire(
                                head1,
                                title1,
                                'success'
                                )
                    }
                    else if (data['status'] == 'false')
                    {
                        Swal.fire(
                                head2,
                                title2,
                                'error'
                                )
                    }
                },
            error : function(reject)
                {
                    $('.submit').prop('disabled', false);

                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function(key, val)
                    {
                        Swal.fire(
                                head2,
                                val[0],
                                'error'
                                )
                    });
                }
            
            
        });

  });

  $(document).on("change",".check_off", function()
            {
              if ($(this).is(':checked')) 
              {
                $(this).parent().next('.off').val(0);
              }
              else
              {
                $(this).parent().next('.off').val(1);
              }

            });

</script>

@endsection
