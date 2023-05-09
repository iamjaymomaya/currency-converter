@extends('layouts.common.partials.app')
@section('content')
    <div class="container">
        <form method="post" action="{{ route('register.store') }}">
            <div class="row justify-content-md-center">
                <div class="col-md-8 col-lg-8 col-sm-12 text-center">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <h1 class="h3 mb-3 fw-bold">Register</h1>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required="required" autofocus>
                        <label for="floatingName">Name</label>
                        @if ($errors->has('name'))
                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="form-group form-floating mb-3">
                        <div class="form-group form-floating mb-3">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="name@example.com" required="required" autofocus>
                            <label for="floatingEmail">Email address</label>
                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="form-group form-floating mb-3">
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                        <label for="floatingPassword">Password</label>
                        @if ($errors->has('password'))
                            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="form-group form-floating mb-3">
                        <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
                        <label for="floatingConfirmPassword">Confirm Password</label>
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
                </div>
            </div>
            <div class="row justify-content-md-center mb-2">
                <div class="col-md-4 text-center">
                    Or
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <a href="{{route('login.show')}}">
                        <button class="w-100 btn btn-lg btn-warning" type="button">Login</button>
                    </a>
                </div>
            </div>
        </form>
    </div>
@endsection