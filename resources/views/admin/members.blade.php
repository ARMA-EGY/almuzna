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
                  <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('admin.HOME-DASHBOARD')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{__('admin.NAV-MEMEBERS')}}</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-6 col-5 {{$inverse_text}}">
              <a href="{{route('register2')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i>{{__('admin.MEMBERS-ADDNEW')}}</a>
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
          <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
              <h3 class="text-white mb-0">{{__('admin.MEMBERS-TOTALMEMEBERS')}}<span class="badge badge-primary p-2 mx-2">{{$users->total()}}</span></h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-dark table-flush">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('admin.MEMBERS-TABLE-MEMBERS')}}</th>
                    <th scope="col">{{__('admin.MEMBERS-TABLE-ROLE')}}</th>
                    <th scope="col">{{__('admin.MEMBERS-TABLE-EMAIL')}}</th>
                    <th scope="col">{{__('admin.MEMBERS-TABLE-PHONE')}}</th>
                    <th scope="col">{{__('admin.MEMBERS-TABLE-STATUS')}}</th>
                  </tr>
                </thead>
                <tbody class="list">
                  @foreach ($users as $user)
                      
                  <tr>
                    <td>{{ ($users->currentPage()-1) * $users->perPage() + $loop->index + 1 }}</td>
                    <td scope="row">
                      <div class="media align-items-center">
                        <a href="#" class="avatar rounded-circle mx-3">
                          <img alt="Image placeholder" src="{{ asset($user->avatar) }}">
                        </a>
                        <div class="media-body">
                          <span class="name mb-0 text-sm">{{ $user->name }}</span>
                        </div>
                      </div>
                    </td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                      @if ($user->role != 'Admin')
                        <input class="enable_user" data-id="{{ $user->id }}" type="checkbox" name="enable" value="1" data-toggle="toggle" data-size="sm" @if ($user->enable == '1') checked @endif>
                      @endif
                    </td>
                  </tr>

                  @endforeach
                 

                </tbody>
              </table>
            </div>

             <!-- Card footer -->
             <div class="card-footer bg-dark py-4">
              {{$users->links()}}
              <div class="col-12">
                Showing {{($users->currentPage()-1)* $users->perPage()+($users->total() ? 1:0)}} to {{($users->currentPage()-1)*$users->perPage()+count($users)}}  of  {{$users->total()}}  Results
              </div>
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

  $('.enable_user').change(function()
  {
		var id 	= $(this).attr('data-id');

    $.ajax({
         url:"{{route('enable-user')}}",
         type:"POST",
         dataType: 'text',
         data:    {"_token": "{{ csrf_token() }}",
                    id: id},
          success : function(response)
            {
            }  
        })

  });
  </script>
@endsection