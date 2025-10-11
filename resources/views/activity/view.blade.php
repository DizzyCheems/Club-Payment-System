@extends('layouts.main')
@section('content')

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration">
                <div class="inner">
                    <h1 class="app-page-title">View Activity Details</h1>
                </div>

                <div class="app-card-body p-3 p-lg-4">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label fw-bold">Activity Name</label>
                        <div class="form-control bg-light">{{ $activity->activity_name }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Fund Required</label>
                        <div class="form-control bg-light">₱{{ number_format($activity->fund, 2) }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Date</label>
                        <div class="form-control bg-light">{{ $activity->date }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Agenda</label>
                        <div class="form-control bg-light">{{ $activity->agenda->agenda_name ?? 'N/A' }}</div>
                    </div>

                    <a href="{{ route('activity.edit', $activity->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('agenda.view', $activity->agenda_id) }}" class="btn btn-warning">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
