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
                  <li class="breadcrumb-item"><a href="{{route('home')}}">لوحة التحكم</a></li>
                  <li class="breadcrumb-item active" aria-current="page">الصفحة الشخصية</li>
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
                  <h3 class="mb-0">تعديل الصفحة الشخصية </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form class="user_info_form">
                @csrf
                <h6 class="heading-small text-muted mb-4 text-right">البيانات</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group text-right">
                        <label class="form-control-label" for="input-username">الاسم</label>
                        <input type="text" id="input-username" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group text-right">
                        <label class="form-control-label" for="input-email">البريد الالكتروني</label>
                        <input type="email" name="email" id="input-email" class="form-control" value="{{ Auth::user()->email }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group text-right">
                        <label class="form-control-label" for="input-gender">النوع</label>
                        <select class="form-control" name="gender" id="input-gender" required>
                          <option value="Female" @if(Auth::user()->gender == 'Female') selected @endif>انثى</option>
                          <option value="Male" @if(Auth::user()->gender == 'Male') selected @endif>ذكر</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group text-right">
                        <label class="form-control-label" for="input-phone">رقم الهاتف</label>
                        <input type="number" name="phone" id="input-phone" class="form-control" placeholder="رقم الهاتف" value="{{ Auth::user()->phone }}" required>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Save -->
                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                <div class="col-12 text-right">
                  <button type="submit" class="btn btn-sm btn-success submit">حفظ</button>
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
                  <h3 class="mb-0">كلمة المرور</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form class="change_password_form">
                @csrf
                <!-- password -->
                <h6 class="heading-small text-muted mb-4 text-right">تغيير كلمة المرور</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group text-right">
                        <label class="form-control-label" for="input-password">كلمة المرور الحالية</label>
                        <input id="input-password" class="form-control" name="oldpassword" type="password" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group text-right">
                        <label class="form-control-label" for="input-password2">كلمة المرور الجديدة</label>
                        <input id="input-password2" class="form-control" name="newpassword" type="password" required>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                <!-- Save -->
                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                <div class="col-12 text-right">
                  <button type="submit" class="btn btn-sm btn-danger submit">حفظ التغيير</button>
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

  // ==========================  Edit User Info ==========================

  $(document).on('submit', '.user_info_form', function(e)
	{
        e.preventDefault();
        let formData = new FormData(this);
        $('.submit').prop('disabled', true);

        var head1 	= 'Done';
        var title1 	= 'Data Changed Successfully. ';
        var head2 	= 'Oops...';
        var title2 	= 'Something went wrong, please try again later.';

        $.ajax({
            url: 		"{{route('edit-info')}}",
            method: 	'POST',
            data: formData,
            contentType: false,
            processData: false,
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

  // ==========================  Change Passowrd ==========================

  $(document).on('submit', '.change_password_form', function(e)
	{
        e.preventDefault();
        let formData = new FormData(this);
        $('.submit').prop('disabled', true);

        var head1 	= 'Done';
        var title1 	= 'Data Changed Successfully. ';
        var head2 	= 'Oops...';
        var title2 	= 'Something went wrong, please try again later.';

        $.ajax({
            url: 		"{{route('change-password')}}",
            method: 	'POST',
            data: formData,
            contentType: false,
            processData: false,
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
                    else if (data['status'] == 'error')
                    {
                        Swal.fire(
                                head2,
                                data['msg'],
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

</script>
@endsection
