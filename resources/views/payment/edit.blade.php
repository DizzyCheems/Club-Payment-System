@extends('layouts.main')
@section('content')

<!--Start-Body-->
<div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <h1 class="app-page-title">Edit Payment Details</h1>
                    <div class="inner">
                        <div class="app-card-body p-3 p-lg-4">

                            <form class="form" action="{{ route('payment.update', ['id' => $payments->id]) }}" method="POST" novalidate>
                                @csrf
                                <input type="hidden" name="id" value="{{ $payments->id }}">

                                @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif

                                <div class="form-body">

                                    <!-- Agenda -->
                                    <div class="form-group mb-3">
                                        <h5>Agenda <span class="required"></span></h5>
                                        <select name="agenda_id" id="agenda_id" class="form-control" required>
                                            <option value="" disabled>Select Agenda</option>
                                            @foreach($agendas as $agenda)
                                                <option value="{{ $agenda->id }}" data-indiv-contrib="{{ $agenda->indiv_contrib }}"
                                                    {{ $payments->agenda_id == $agenda->id ? 'selected' : '' }}>
                                                    {{ $agenda->agenda_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Student -->
                                    <div class="form-group mb-3">
                                        <h5>Student <span class="required"></span></h5>
                                        <select name="student_id" id="student_id" class="form-control" required>
                                            <option value="" disabled>Select Student</option>
                                            @foreach($students as $student)
                                                <option value="{{ $student->id }}" {{ $payments->student_id == $student->id ? 'selected' : '' }}>
                                                    {{ $student->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Course -->
                                    <div class="form-group mb-3">
                                        <h5>Course <span class="required"></span></h5>
                                        <select name="course_id" id="course_id" class="form-control" required>
                                            <option value="" disabled>Select Course</option>
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}" {{ $payments->course_id == $course->id ? 'selected' : '' }}>
                                                    {{ $course->course_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Amount -->
                                    <div class="form-group mb-3">
                                        <h5>Amount <span class="required"></span></h5>
                                        <input type="number" name="amount" id="amountInput" class="form-control" value="{{ $payments->amount }}" min="0" required>
                                    </div>

                                    <!-- Payment Type -->
                                    <div class="form-group mb-3">
                                        <h5>Payment Type <span class="required"></span></h5>
                                        <select name="type" id="paymentType" class="form-control" required>
                                            <option value="Online Payment" {{ $payments->type == 'Online Payment' ? 'selected' : '' }}>Online Payment</option>
                                            <option value="Cash" {{ $payments->type == 'Cash' ? 'selected' : '' }}>Cash</option>
                                        </select>
                                    </div>

                                    <!-- Payment Method -->
                                    <div class="form-group mb-3">
                                        <h5>Payment Method <span class="required"></span></h5>
                                        <select name="method" id="paymentMethod" class="form-control" required>
                                            <option value="Full" {{ $payments->method == 'Full' ? 'selected' : '' }}>Full Payment</option>
                                            <option value="Partial" {{ $payments->method == 'Partial' ? 'selected' : '' }}>Partial Payment</option>
                                        </select>
                                    </div>

                                    <div class="form-actions center mt-4">
                                        <a class="btn btn-warning mr-1" href="{{ route('student.index') }}">
                                            <i class="ft-x"></i> Cancel
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Save
                                        </button>
                                    </div>

                                </div>
                            </form>

                        </div><!--//app-card-body-->
                    </div><!--//inner-->
                </div><!--//app-card-->
            </div><!--//container-xl-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->

<!-- BEGIN: Page JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

<script>
$(document).ready(function () {

    function updateAmount() {
        const selectedAgenda = $('#agenda_id').find(':selected');
        const indivContrib = parseFloat(selectedAgenda.data('indiv-contrib')) || 0;

        if ($('#paymentMethod').val() === 'Partial') {
            $('#amountInput').val((indivContrib * 0.5).toFixed(2));
        } else {
            $('#amountInput').val(indivContrib.toFixed(2));
        }
    }

    // Set initial amount on page load
    updateAmount();

    // Update amount when agenda changes
    $('#agenda_id').on('change', function () {
        updateAmount();
    });

    // Update amount when payment method changes
    $('#paymentMethod').on('change', function () {
        updateAmount();
    });

});
</script>
<!-- END: Page JS -->

@endsection
