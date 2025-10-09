@extends('layouts.main')

@section('content')
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            <h1 class="app-page-title">Account</h1>

            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">
                        <h3 class="mb-3">My Account</h3>
                        <div class="row gx-5 gy-3">
                            <div class="col-12 col-lg-8">
                                <div class="mb-3">
                                    <strong>Name:</strong>
                                    <div>{{ $user->name }}</div>
                                </div>

                                <div class="mb-3">
                                    <strong>Email:</strong>
                                    <div>{{ $user->email }}</div>
                                </div>

                                <div class="mb-3">
                                    <strong>Role:</strong>
                                    <div>{{ $user->role }}</div>
                                </div>

                                @if(isset($user->created_at))
                                <div class="mb-3">
                                    <strong>Member since:</strong>
                                    <div>{{ $user->created_at->format('j M Y') }}</div>
                                </div>
                                @endif

                                <div class="mt-4">
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn app-btn-primary">Edit Account</a>
                                    <a href="{{ route('dashboard') }}" class="btn app-btn-secondary ms-2">Back to Dashboard</a>
                                </div>
                            </div><!--//col-->

                            <div class="col-12 col-lg-4">
                                <div class="text-center">
                                    <img src="{{ asset('assets/images/no_profile.jpg') }}" alt="Profile" class="img-fluid rounded" style="max-width:160px;">
                                    <p class="mt-2">Profile Picture</p>
                                </div>
                            </div><!--//col-->
                        </div><!--//row-->
                    </div><!--//app-card-body-->
                </div><!--//inner-->
            </div><!--//app-card-->

        </div><!--//container-xl-->
    </div><!--//app-content-->
</div><!--//app-wrapper-->
@endsection
