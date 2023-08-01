@extends('layout.master2')
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
                           <x-auth-session-status class="mb-4" :status="session('status')" />
                <div class="p-2 mt-4">
                    <form class="login_from" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="code">Email</label>
                            <div class="position-relative input-custom-icon">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter User Email">
                                <span class="bx bx-user"></span>
                            </div>
                        </div>

                        <div class="mt-3">
                            <input type="submit" class="btn btn-primary w-100 waves-effect waves-light" value="Email Password Reset Link">
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

