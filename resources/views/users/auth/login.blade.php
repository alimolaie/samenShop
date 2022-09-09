@extends('layouts.app')

@section('content')
 <!-- wrapper -->
 <div class="wrapper without_header_sidebar">
    <!-- contnet wrapper -->
    <div class="content_wrapper">
            <!-- page content -->
            <div class="login_page center_container">
                <div class="center_content">
                    <div class="logo">
                        <img src="{{asset('panel/assets/images/logo.png')}}" alt="" class="img-fluid">
                    </div>
                    <form action="{{ route('userLogin') }}" class="d-block" method="post">
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

                        <div class="form-group icon_parent">
                             <label for="password">user name</label>
                             <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Enter your username Adress">
                             @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
      <span class="icon_soon_bottom_right"><i class="fas fa-envelope"></i></span>

                        </div>
                        <div class="form-group icon_parent">
                            <label for="password">Password</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <span class="icon_soon_bottom_right"><i class="fas fa-unlock"></i></span>
                        </div>
                        <div class="form-group">
                            <label class="chech_container">Remember me
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="form-group">
                            <a class="registration" href="{{route('register')}}">Create new account</a><br>
                            <a href="{{route('password.request')}}" class="text-white">I forgot my password</a>
                            <button type="submit" class="btn btn-blue">Login</button>
                        </div>
                    </form>
                    <div class="footer">
                       <p>Copyright &copy; 2020 <a href="https://easylearningbd.com/">easy Learning</a>. All rights reserved.</p>
                    </div>

                </div>
            </div>
    </div><!--/ content wrapper -->
</div><!--/ wrapper -->

@endsection
