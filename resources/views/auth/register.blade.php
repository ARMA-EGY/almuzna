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
                    <li class="breadcrumb-item"><a href="{{route('admin-members')}}">{{__('admin.NAV-MEMEBERS')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('admin.REGISTER-ADDNEW')}}</li>
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

<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col-xl-12 order-xl-1">
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">{{__('admin.REGISTER-ADDNEW')}}  </h3>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                  <div class="pl-lg-4">
                    <div class="row">

                      <div class="col-lg-6">
                        <div class="form-group text-right">
                          <label class="form-control-label" for="input-username">{{__('admin.REGISTER-NAME')}}</label>
                          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group text-right">
                          <label class="form-control-label" for="input-email">{{__('admin.REGISTER-EMAIL')}} </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>

                    </div>

                    <div class="row">
  
                        <div class="col-lg-6">
                          <div class="form-group text-right">
                            <label class="form-control-label" for="input-phone">{{__('admin.REGISTER-PHONE')}}</label>
                            <input type="number" name="phone" id="input-phone" class="form-control" placeholder="{{__('admin.REGISTER-PHONEPLC')}}"  >
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group text-right">
                              <label class="form-control-label" for="input-gender">{{__('admin.REGISTER-GENDER')}}</label>
                              <select class="form-control" name="gender" id="input-gender" required>
                                  <option value="Female">{{__('admin.FEMALE')}}</option>
                                  <option value="Male">{{__('admin.MALE')}}</option>
                              </select>
                          </div>
                        </div>

                  </div>

                    <div class="row">

                      <div class="col-lg-6">
                        <div class="form-group text-right">
                          <label class="form-control-label" for="input-phone">{{__('admin.REGISTER-PASSWORD')}}</label>
                          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                          @error('password')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="form-group text-right">
                            <label for="password-confirm" class="form-control-label">{{__('admin.REGISTER-CONFIRMPASSWORD')}} </label>
                             <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                      </div>

                    </div>

                    <div class="row">
  
                          <div class="col-lg-6">
                            <div class="form-group text-right">
                              <label class="form-control-label" for="input-role">{{__('admin.REGISTER-JOB')}}</label>
                              <select class="form-control" name="role" id="input-role" required>
                                <option>Admin</option>
                                <option>Moderator</option>
                              </select>
                            </div>
                          </div>
  
                    </div>

                  </div>
                  <hr class="my-4" />
                  <!-- Save -->
                  <div class="col-12 text-right">
                    <button type="submit" class="btn btn-success submit">{{__('admin.REGISTER-ADD')}}</button>
                  </div>
                </form>
              </div>
        </div>


    </div>
</div>
@endsection
