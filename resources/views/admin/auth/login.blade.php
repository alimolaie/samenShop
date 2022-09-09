@extends('admin.admin_layout')

@section('admin_content')
<div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
      <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Samen <span class="tx-info tx-normal">Ecommerce</span></div>
      <div class="tx-center mg-b-60">Login to Admin panel</div>
        <form action="{{route('adminLogin')}}" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            @if($errors->has('invalidLogin'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('invalidLogin') }}
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-success" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                {{ session('info') }}
            </div>
        @endif
      <div class="form-group">
        <input type="text" class="form-control  @error('username') is-invalid @enderror" placeholder="Enter your username" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
        @error('username')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div><!-- form-group -->
      <div class="form-group">
        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" name="password" required autocomplete="current-password">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
        <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
      </div><!-- form-group -->
      <button type="submit" class="btn btn-info btn-block">Sign In</button>

      <div class="mg-t-60 tx-center">Not yet a member? <a href="page-signup.html" class="tx-info">Sign Up</a></div>
    </form>
    </div><!-- login-wrapper -->
  </div><!-- d-flex -->
<!--/ wrapper -->

@endsection
