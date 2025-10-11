@extends('layouts.main')
@section('content')

<!--Start-Body-->
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            {{-- User Details Card (display-only) --}}
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <h1 class="app-page-title">View User Details</h1>
                </div>

                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">

                        {{-- Success message --}}
                        @if(Session::has('success'))
                            <div class="alert alert-success text-center">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        <div class="row g-3">
                            {{-- Full name --}}
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">Full Name</label>
                                <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                    {{ $user->name }}
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">Email</label>
                                <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                    {{ $user->email }}
                                </div>
                            </div>

                            {{-- Role --}}
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold">Role</label>
                                <div class="p-2 rounded d-flex align-items-center" style="background: #fafafa; border: 1px solid #e9ecef;">
                                    @php
                                        $role = $user->role ?? 'USER';
                                        // choose a badge style consistent with your app
                                        $roleClass = Str::contains($role, 'ADMIN') ? 'badge-blis' : 'badge-online';
                                    @endphp
                                    <span class="badge badge-pill {{ $roleClass }}" style="font-size: 1rem; padding: .45rem .7rem;">
                                        {{ $role }}
                                    </span>
                                </div>
                            </div>

                            {{-- Created --}}
                            @if(isset($user->created_at))
                                <div class="col-12 col-md-4">
                                    <label class="form-label fw-bold">Created</label>
                                    <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                        {{ $user->created_at->format('j M Y, g:i A') }}
                                    </div>
                                </div>
                            @endif

                            {{-- Last updated --}}
                            @if(isset($user->updated_at))
                                <div class="col-12 col-md-4">
                                    <label class="form-label fw-bold">Last Updated</label>
                                    <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                        {{ $user->updated_at->format('j M Y, g:i A') }}
                                    </div>
                                </div>
                            @endif
                        </div><!--//row-->

                        {{-- Buttons --}}
                        <div class="mt-4">
                            <a href="{{ route('user.index') }}" class="btn app-btn-secondary">
                                Back
                            </a>
                            <a href="{{ route('user.edit', $user->id) }}" class="btn app-btn-primary">
                                Edit User
                            </a>
                        </div>

                    </div><!--//app-card-body-->
                </div><!--//inner-->
            </div><!--//app-card-->

        </div><!--//container-xl-->
    </div><!--//app-content-->
</div><!--//app-wrapper-->


<!-- BEGIN: Page JS-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="{{ asset('app-assets/js/scripts/tables/datatables/datatable-basic.js') }}"></script>
<!-- END: Page JS-->

@endsection
</html>
