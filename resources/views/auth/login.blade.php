@extends('layouts.auth')

@section('content')


    <img src="{{ asset('assets/img/logo-landing.png') }}" class="img-fluid mt-5 pt-5 landing-logo">
    <img src="{{ asset('assets/img/logo-landing-mobile.png') }}" class="img-fluid mt-2 pt-2 landing-logo-mobile">

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        @include('layouts/alerts')

        <div class="card mt-5">
            <div class="card-header">
                <h4 class="card-title">Login</h4>
            </div>
            <div class="card-body">
                <div class="card-content container">
                                                    
                        <div class="form-group">
                            <label for="input-email">Email Address</label>                    
                            <input id="input-email" type="email" name="email" class="form-control" value="{{ old('email') }}" required>                    
                        </div>

                        <div class="form-group">
                            <label for="input-password">Password</label>                    
                            <input id="input-password" type="password" name="password" class="form-control" value="" required>                    
                        </div>                                                        

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                                                    
                            </div>
                        </div>                                    
                </div>                        
            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary">LOGIN</button>    
            </div>
        </div>

    </form>
@endsection
