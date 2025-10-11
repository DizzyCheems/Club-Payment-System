@extends('layouts.main')
@section('content')

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration">
                <div class="inner">
                    <h1 class="app-page-title">Edit Activity</h1>
                </div>

                <div class="app-card-body p-3 p-lg-4">
                    <form action="{{ route('activity.update', $activity->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Activity Name</label>
                            <input type="text" name="activity_name" class="form-control" value="{{ old('activity_name', $activity->activity_name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Fund Required</label>
                            <input type="number" step="0.01" name="fund" class="form-control" value="{{ old('fund', $activity->fund) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Time</label>
                            <input 
                                type="time" 
                                name="date" 
                                class="form-control" 
                                value="{{ old('date', \Carbon\Carbon::parse($activity->date)->format('H:i')) }}" 
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Agenda</label>
                            <select name="agenda_id" class="form-control" required>
                                @foreach($agendas as $agenda)
                                    <option value="{{ $agenda->id }}" {{ $activity->agenda_id == $agenda->id ? 'selected' : '' }}>
                                        {{ $agenda->agenda_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('agenda.view', $activity->agenda_id) }}" class="btn btn-warning">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
