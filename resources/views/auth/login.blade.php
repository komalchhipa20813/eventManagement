@extends('admin.layout.master2')
@section('title',"Login")
@section('content')
<div class="container login-container">
    <div class="d-flex flex-column min-vh-100 px-3 pt-4">
        <div class="row justify-content-center my-auto">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="mb-4 pb-2 logo">
                    <a href="index.html" class="d-block auth-logo">
                        <img src="{{ asset('assets/images/logo.jpg') }}" alt="" class="auth-logo-dark me-start">
                    </a>
                </div>
                <div class="card">
                <div class="card-body p-4">
                <div class="text-center mt-2 mb-2">
                    <h5 class="mb-3">Welcome Back !</h5>
                    <p class="text-muted">Sign In To Continue To Event Management.</p>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
             @endif
                <div class="p-2 mt-4">
                    <form class="login_from" method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="code">Email</label>
                            <div class="position-relative input-custom-icon">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter User Email">
                                <span class="bx bx-user"></span>
                            </div>
                        </div>

                        <div class="mb-3">

                            <label class="form-label" for="password-input">Password</label>
                            <div class="position-relative auth-pass-inputgroup input-custom-icon">
                                <span class="bx bx-lock-alt"></span>
                                <input type="password" class="form-control" name="password" id="password-input" placeholder="Enter password" autocomplete="current-password">
                                <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0" id="password-addon">
                                    <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-check py-1">
                            <input type="checkbox" class="form-check-input" id="auth-remember-check">
                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                        </div>

                        <div class="mt-3">
                            <input type="submit" class="btn btn-primary w-100 waves-effect waves-light" value="Log In">
                        </div>

                       <div class="mt-4 text-center">
                        <div class="float-end">
                            <a href="{{route('password.request')}}" class="text-muted text-decoration-underline">Forgot password?</a>
                        </div>
                       </div>                    
                        </form>
                </div>
            </div>
        </div>
        
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection

