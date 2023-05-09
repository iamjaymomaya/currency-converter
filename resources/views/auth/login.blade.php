@extends('layouts.common.partials.app')
@section('content')
    <div class="container">
        <form method="post" action="{{ route('login.store') }}">
            <div class="row justify-content-md-center">
                <div class="col-md-4 col-lg-4 col-sm-12 text-center">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <h1 class="h3 mb-3 fw-bol">Login</h1>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="form-group form-floating mb-3">
                        <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="email" required="required" autofocus>
                        <label for="floatingName">Email</label>
                        @if ($errors->has('email'))
                            <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                        @endif
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
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-4 col-lg-4 col-sm-12">
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                </div>
            </div>
        </form>
    </div>
@endsection