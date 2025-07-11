@extends('layouts.app')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <div class="login-logo">
                <a href="{{ route('admin.home') }}">
                   <span>{{trans('global.welcome')}}  </span> {{ trans('global.site_title') }}
                </a>
            </div>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">
                    {{ trans('global.login') }}
                </p>

                @if(session()->has('message'))
                    <p class="alert alert-info">
                        {{ session()->get('message') }}
                    </p>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}">

                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ trans('global.login_password') }}">

                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>


                    <div class="row">
                        <div class="col-4">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">{{ trans('global.remember_me') }}</label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-8">
                            <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                                <i class="fas fa-sign-in-alt" style="margin-right: 1rem;"></i>
                                <span>{{ trans('global.login') }}</span>
                            </button>
                        </div>





                    </div>
                        <!-- /.col -->
                    </div>
                </form>



                <p class="mb-1">

                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
