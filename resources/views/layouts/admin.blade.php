<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="ARMA Software">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Dashboard</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('admin_assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <!-- Page plugins --> 
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ asset('admin_assets/css/argon.css?v=1.2.0') }}" type="text/css">
  <!-- Bootstrap switch toggle button -->
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <!-- JQUERY UI -->
  <link rel="stylesheet" href="{{ asset('admin_assets/css/jquery-ui.css') }}" type="text/css">
  <!-- RTL CSS -->
  <link rel="stylesheet" href="{{ asset('admin_assets/css/rtl.css') }}" type="text/css">


  @yield('style')
</head>
<body>

    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left navbar-expand-xs navbar-dark bg-dark" id="sidenav-main">
        <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                @isset($logo)
                 <img src="{{ asset('storage/'.$logo->logo) }}" class="navbar-brand-img" alt="Logo" style="width: 180px;">
                 @else
                    <h3 class="text-white">Admin Panel</h3>
                 @endisset
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse --><div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Nav items -->
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link {{request()->routeIs('home') ? 'active' : '' }}" href="{{route('home')}}">
                    <i class="fas fa-th-large"></i>
                    <span class="nav-link-text">الرئيسية</span>
                </a>
                </li>

                @if (auth()->user()->isAdmin())

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#navbar-components" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-components">
                          <i class="fa fa-users text-primary"></i>
                          <span class="nav-link-text">المستخدمين</span>
                        </a>
                        <div class="collapse" id="navbar-components" style="">
                          <ul class="nav nav-sm flex-column">
    
                            <li class="nav-item">
                              <a href="{{route('admin-members')}}" class="nav-link nav-link-sub {{request()->routeIs('admin-members') ? 'active' : '' }}">
                                <i class="fas fa-user-secret"></i>
                                <span class="sidenav-normal"> الاعضاء </span>
                              </a>
                            </li>
    
                            <li class="nav-item">
                              <a href="{{route('customers.index')}}" class="nav-link nav-link-sub {{request()->routeIs('customers.index') ? 'active' : '' }}">
                                <i class="fas fa-user-tie"></i>
                                <span class="sidenav-normal"> العملاء </span>
                              </a>
                            </li>
    
                            <li class="nav-item">
                              <a href="{{route('drivers.index')}}" class="nav-link nav-link-sub {{request()->routeIs('drivers.index') ? 'active' : '' }}">
                                <i class="fas fa-user-astronaut"></i>
                                <span class="sidenav-normal"> السائقين </span>
                              </a>
                            </li>
                            
                          </ul>
                        </div>
                    </li>

                @endif
                

                {{-- <li class="nav-item">
                    <a class="nav-link collapsed" href="#navbar-components" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-components">
                      <i class="fa fa-book text-green"></i>
                      <span class="nav-link-text">Blogs</span>
                    </a>
                    <div class="collapse" id="navbar-components" style="">
                      <ul class="nav nav-sm flex-column">

                        <li class="nav-item">
                          <a href="{{route('categories.index')}}" class="nav-link nav-link-sub {{request()->routeIs('categories.index') ? 'active' : '' }}">
                            <i class="ni ni-chart-pie-35"></i>
                            <span class="sidenav-normal"> Categories </span>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{route('tags.index')}}" class="nav-link nav-link-sub {{request()->routeIs('tags.index') ? 'active' : '' }}">
                            <i class="fa fa-tags"></i>
                            <span class="sidenav-normal"> Tags </span>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{route('blogs.index')}}" class="nav-link nav-link-sub {{request()->routeIs('blogs.index') ? 'active' : '' }}">
                            <i class="fa fa-book"></i>
                            <span class="sidenav-normal"> Posts </span>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{route('admin-draft')}}" class="nav-link nav-link-sub {{request()->routeIs('admin-draft') ? 'active' : '' }}">
                            <i class="fa fa-paste"></i>
                            <span class="sidenav-normal"> Drafts </span>
                          </a>
                        </li>
                        
                      </ul>
                    </div>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('products.index') ? 'active' : '' }}" href="{{route('products.index')}}">
                        <i class="fa fa-cubes text-info"></i>
                        <span class="nav-link-text">المنتجات</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('offers.index') ? 'active' : '' }}" href="{{route('offers.index')}}">
                        <i class="fas fa-bullhorn text-warning"></i>
                        <span class="nav-link-text">العروض</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('coupons.index') ? 'active' : '' }}" href="{{route('coupons.index')}}">
                        <i class="fa fa-tags text-yellow"></i>
                        <span class="nav-link-text">الكوبونات</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#navbar-orders" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-components">
                      <i class="ni ni-cart text-purple"></i>
                      <span class="nav-link-text">الطلبات</span>
                    </a>
                    <div class="collapse" id="navbar-orders" style="">
                      <ul class="nav nav-sm flex-column">

                        <li class="nav-item">
                          <a href="{{route('admin-orders-pending')}}" class="nav-link nav-link-sub {{request()->routeIs('admin-orders-pending') ? 'active' : '' }}">
                            <i class="fas fa-cube text-yellow"></i>
                            <span class="sidenav-normal"> متعلق </span>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{route('admin-orders-accepted')}}" class="nav-link nav-link-sub {{request()->routeIs('admin-orders-accepted') ? 'active' : '' }}">
                            <i class="fas fa-cube text-info"></i>
                            <span class="sidenav-normal"> مقبول </span>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{route('admin-orders-ontheway')}}" class="nav-link nav-link-sub {{request()->routeIs('admin-orders-ontheway') ? 'active' : '' }}">
                            <i class="fas fa-cube text-primary"></i>
                            <span class="sidenav-normal"> في الطريق </span>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{route('admin-orders-delivered')}}" class="nav-link nav-link-sub {{request()->routeIs('admin-orders-delivered') ? 'active' : '' }}">
                            <i class="fas fa-cube text-success"></i>
                            <span class="sidenav-normal"> تم الاستلام </span>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{route('admin-orders-cancelled')}}" class="nav-link nav-link-sub {{request()->routeIs('admin-orders-cancelled') ? 'active' : '' }}">
                            <i class="fas fa-cube text-red"></i>
                            <span class="sidenav-normal"> الغاء </span>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{route('admin-orders')}}" class="nav-link nav-link-sub {{request()->routeIs('admin-orders') ? 'active' : '' }}">
                            <i class="fas fa-cubes"></i>
                            <span class="sidenav-normal"> جميع الطلبات </span>
                          </a>
                        </li>
                        
                      </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <i class="fas fa-exchange-alt"></i>
                        <span class="nav-link-text">عمليات الدفع الالكتروني</span>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link " href="#">
                        <i class="fas fa-coins text-success"></i>
                        <span class="nav-link-text">Expenses</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <i class="ni ni-basket text-danger"></i>
                        <span class="nav-link-text">Stock</span>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('city.index') ? 'active' : '' }}" href="{{route('city.index')}}">
                        <i class="ni ni-delivery-fast text-cyan"></i>
                        <span class="nav-link-text">قيمة التوصيل</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('admin-configuration') ? 'active' : '' }}" href="{{route('admin-configuration')}}">
                        <i class="ni ni-ui-04 text-info"></i>
                        <span class="nav-link-text">الاعدادات</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('admin-messages') ? 'active' : '' }}" href="{{route('admin-messages')}}">
                        <i class="ni ni-email-83 text-pink"></i>
                        <span class="nav-link-text">الرسائل</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{request()->routeIs('admin-pages') ? 'active' : '' }}" href="{{route('admin-pages')}}">
                        <i class="ni ni-single-copy-04 text-orange"></i>
                        <span class="nav-link-text">الصفحات</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <i class="far fa-chart-bar"></i>
                        <span class="nav-link-text">التقارير</span>
                    </a>
                </li>
                
            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading p-0 text-muted">
            </h6>
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#navbar-setting" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="navbar-components">
                      <i class="ni ni-settings"></i>
                      <span class="nav-link-text">ضبط البيانات</span>
                    </a>
                    <div class="collapse" id="navbar-setting" style="">
                      <ul class="nav nav-sm flex-column">

                        <li class="nav-item">
                          <a href="{{route('admin-socialmedia')}}" class="nav-link nav-link-sub {{request()->routeIs('admin-socialmedia') ? 'active' : '' }}">
                            <i class="fa fa-share"></i>
                            <span class="sidenav-normal"> وسائل التواصل الاجتماعي </span>
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="{{route('admin-logo')}}" class="nav-link nav-link-sub {{request()->routeIs('admin-logo') ? 'active' : '' }}">
                            <i class="ni ni-planet"></i>
                            <span class="sidenav-normal"> اللوجو </span>
                          </a>
                        </li>
                        
                      </ul>
                    </div>
                </li>

                <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    <i class="ni ni-user-run"></i>
                    <span class="nav-link-text">تسجيل الخروج</span>
                </a>
                </li>
            </ul>
            </div>
        </div>
        </div>
    </nav>

    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-gradient-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navbar links -->
                
                <ul class="navbar-nav align-items-center mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                        <i class="fa fa-globe"></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ni ni-ungroup"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark bg-default  dropdown-menu-right ">
                        <div class="row shortcuts px-4">
                            <a href="{{route('calendar')}}" class="col-4 shortcut-item">
                            <span class="shortcut-media avatar rounded-circle bg-gradient-red">
                                <i class="ni ni-calendar-grid-58"></i>
                            </span>
                            <small>Calendar</small>
                            </a>
                            <a href="#!" class="col-4 shortcut-item show-todo">
                            <span class="shortcut-media avatar rounded-circle bg-gradient-purple">
                                <i class="ni ni-bullet-list-67"></i>
                            </span>
                            <small>To-Do</small>
                            </a>
                            <a href="#!" class="col-4 shortcut-item show-notes">
                            <span class="shortcut-media avatar rounded-circle bg-gradient-orange">
                                <i class="fa fa-sticky-note"></i>
                            </span>
                            <small>Notes</small>
                            </a>
        
                        </div>
                        </div>
                    </li>

                    <li class="nav-item d-xl-none">
                        <!-- Sidenav toggler -->
                        <div class="px-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="{{ asset(Auth::user()->avatar) }}">
                            </span>
                            <div class="media-body  ml-2  d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold">{{ Auth::user()->name }}</span>
                            </div>
                            </div>
                        </a>
                    <div class="dropdown-menu  dropdown-menu-right ">
                        <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">مرحبا</h6>
                        </div>
                        <a href="{{route('admin-profile')}}" class="dropdown-item">
                        <i class="ni ni-circle-08"></i>
                        <span>الصفحة الشخصية</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>تسجيل الخروج</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

        <!-- Page content -->
            @yield('content')
        <!-- end: Page content -->

    </div>
    <!-- end: Main content -->



    <!-- Popup Modal -->
    <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-wrapper">
          <div class="modal-dialog modal-lg" id="modal_body">
            
          </div>
        </div>
    </div>


    <div class="row justify-content-center">

                <!--============== Start To-Do List App ==============-->
                <div class="col-lg-4 col-sm-6 features draggable">
                    <div class="todo">
                        <div class="close1"><i class="fa fa-times-circle"></i></div>
                        <div class="move"><i class="fas fa-arrows-alt"></i></div>
                        <div class="todo-header">
                            <div class="text-center"><span id="date1"></span></div>
                            
                            <div class="counts">
                                <div class="left float-left">
                                    <p id="total"></p>
                                    <p>Total</p>
                                </div>
                                
                                <div class="middle">
                                    <p id="remain"></p>
                                    <p>Remain</p>
                                </div>
                                
                                <div class="right float-right">
                                    <p id="done"></p>
                                    <p>Done</p>
                                </div>
                            </div>

                        </div>

                        <div class="todo-body">
                            <p class="todo-title">To-Do List</p>
                            <ul id="todo_list" data-url="{{route('get-todo')}}" data-id="{{ Auth::user()->id }}">
                            
                            
                            </ul>
                        </div>

                        <div class="todo-footer mt-3">
                            <form id="todo-form" data-url="{{route('add-todo')}}">
                                <input id="todo-task"  class="form-control" type="text" name="task" placeholder="Write New Task"  required>
                                <input  type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                                <button class="btn btn-primary" type="submit">Add</button>	
                            </form>
                        </div>	


                    </div>
                </div>


                <!--============== Start Notes App ==============-->	
                <div class="col-lg-4 col-sm-6 features draggable">
                    <div id="notes" class="resizable">
                    <div class="close1"><i class="fa fa-times-circle"></i></div>
                    <div class="move"><i class="fas fa-arrows-alt"></i></div>
                    <h3 class="text-center"><strong>Notes</strong></h3> 
                        
                    <div class="notes-header">
                        <h6>Take a note... </h6>
                        <button type="submit" class="btn btn-warning btn-sm float-right create-note" data-url="{{route('create-note')}}"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="notes-body">
                        <div id="get-notes" data-url="{{route('get-note')}}" data-id="{{ Auth::user()->id }}">
                            
                        </div>
                    </div>
                    
                    </div>
                </div>
        
    </div>


    <div id="loader" data-load='<div class="divload"><img src="{{asset("images/load.gif")}}" width="50" class="m-auto"></div>'></div>


    <script src="{{ asset('admin_assets/vendor/jquery/dist/jquery.min.js') }}" ></script>

    {{-- <script type="application/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <script type="application/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- Optional JS -->
    <script src="{{ asset('admin_assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
    <!-- Argon JS -->
    <script src="{{ asset('admin_assets/js/argon.js?v=1.2.0') }}"></script>
    
    <!--Bootstrap switch files-->
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

    <script src="https://cdn.tiny.cloud/1/mq6umcdg6y938v1c32lokocdpgrgp5g2yl794h4y1braa6j6/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script src="{{ asset('admin_assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.ui.touch-punch.min.js') }}"></script>

{{-- 
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script> --}}

    <script>
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        // =============  Get SEO Data =============
        $('.get_seo').click(function()
        {
            var token 	= $(this).attr('data-token');
            var loader 	= $('#loader').attr('data-load');
            $(this).parents('.parent').removeClass('read');

            $('#popup').modal('show');
            $('#modal_body').html(loader);

            $.ajax({
                url:"{{route('getseo')}}",
                type:"POST",
                dataType: 'text',
                data:    {"_token": "{{ csrf_token() }}",
                            page_token: token},
                success : function(response)
                    {
                    $('#modal_body').html(response);
                    }  
                })

        });

        // =============  Edit SEO Data =============
        $(document).on('submit', '.seo_form', function(e)
            {
                e.preventDefault();
                let formData = new FormData(this);
                $('.submit').prop('disabled', true);

                var head1 	= 'Done';
                var title1 	= 'Data Changed Successfully. ';
                var head2 	= 'Oops...';
                var title2 	= 'Something went wrong, please try again later.';


                $.ajax({
                    url: 		"{{route('seo')}}",
                    method: 	'POST',
                    data: formData,
                    dataType: 	'json',
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
                                $('.modal').modal('hide');
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

        // =============  Remove Item =============
        $(document).on('click', '.remove_item', function() {
            
            var item 	= $(this).attr('data-id');
            var url 	= $(this).attr('data-url');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Item has been deleted.',
                    'success'
                )

                $.ajax({
                            url: 		url,
                            method: 	'POST',
                            dataType: 	'json',
                            data:		{id: item}	
                    });

                    $(this).parents('.parent').remove();
                }
            })
            
        });

    </script>

    @yield('script')
</body>