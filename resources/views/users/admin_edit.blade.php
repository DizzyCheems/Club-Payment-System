@extends('layouts.main')

@section('content')
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 class="app-page-title">Edit Admin Account</h1>

            <div class="app-card alert shadow-sm mb-4 border-left-decoration">
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">

                        {{-- Success Message --}}
                        @if(Session::has('success'))
                            <div class="alert alert-success text-center">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.account.update') }}" method="POST" novalidate>
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name" class="fw-bold">Name</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    class="form-control" 
                                    value="{{ old('name', $user->name) }}" 
                                    required
                                >
                            </div>

                            <div class="form-group mb-3">
                                <label for="email" class="fw-bold">Email</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    class="form-control" 
                                    value="{{ old('email', $user->email) }}" 
                                    required
                                >
                            </div>

                            <div class="form-group mb-3">
                                <label for="password" class="fw-bold">New Password</label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    class="form-control" 
                                    placeholder="Leave blank to keep current password"
                                >
                            </div>

                            <div class="form-group mb-3">
                                <label for="password_confirmation" class="fw-bold">Confirm Password</label>
                                <input 
                                    type="password" 
                                    name="password_confirmation" 
                                    id="password_confirmation" 
                                    class="form-control" 
                                    placeholder="Confirm new password"
                                >
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Save Changes
                                </button>
                            </div>
                        </form>

                    </div><!--//app-card-body-->
                </div><!--//inner-->
            </div><!--//app-card-->

        </div><!--//container-xl-->
    </div><!--//app-content-->
</div><!--//app-wrapper-->
@endsection
