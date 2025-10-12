@extends('layouts.main')
@section('content')

@if (Session::has('success'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show">
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    </div>
@endif

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
           <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert" >
                <div class="inner">
                    <h1 class="app-page-title">Payments</h1>
                        <div class="app-card-body p-3 p-lg-4">

                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row align-items-center">
                            <div class="col-md-auto">
                                <div class="form-group mb-0">
                                    <div class="input-group">
                                        <input type="text" style="width:300px;" id="myInput" name="searchorders" onkeyup="myFunction()" class="form-control search-orders" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit"  class="btn app-btn-secondary">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="col-md-auto">
                                    <select class="form-select w-auto" id="elements-select">
                                        <option value="10">10</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                    </select>
                                </div>

                            <div class="col-md-auto">
                                 <a class="btn app-btn-secondary" href="#" data-bs-toggle="modal" data-bs-target="#add">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                        <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                    </svg>
                                    Add Payment
                                </a>
                            </div>

                            <div class="col-md-auto" >
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->

            <!--Tab Selections -->
            <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true" onclick="filterRows('all')">All</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-admin-tab" data-bs-toggle="tab" href="#orders-admin" role="tab" aria-controls="orders-admin" aria-selected="false" onclick="filterRows('full')">Full</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-user-tab" data-bs-toggle="tab" href="#orders-user" role="tab" aria-controls="orders-user" aria-selected="false" onclick="filterRows('partial')">Partial</a>
            </nav>
            <!--END Tab Selections -->

            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left table table-striped table-bordered" >
                                    <thead>
                                        <tr>
                                            <th class="cell">Agenda</th>
                                            <th class="cell">Student</th>
                                            <th class="cell">Amount</th>
                                            <th class="cell">Type</th>
                                            <th class="cell">Method</th>
                                            <th class="cell">Date Paid</th>
                                            <th class="col-actions cell">Actions</th>
                                            <th class="col-actions cell">Approval</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userTable">
                                    @foreach($payments as $payment)
                                        <tr data-method="{{ $payment->method }}">
                                            <td>{{ $payment->agendas->agenda_name }}</td>
                                            <td>{{ $payment->students->name }}</td>
                                            <td>{{ $payment->amount }}</td>
                                            <td>
                                                @if($payment->type  == 'ONLINE')
                                                    <span class="badge badge-pill badge-online">ONLINE</span>
                                                @else
                                                    <span class="badge badge-pill badge-full">CASH</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($payment->method  == 'PARTIAL')
                                                    <span class="badge badge-pill badge-partial">PARTIAL</span>
                                                @else
                                                    <span class="badge badge-pill badge-full">FULL</span>
                                                @endif
                                            </td>
                                            <td class="cell">
                                                <span>{{ date('j M', strtotime($payment->created_at)) }}</span>
                                                <span class="note">{{ date('g:i A', strtotime($payment->created_at)) }}</span>
                                            </td>
                                            <td>
                                                <a class="btn-sm app-btn-secondary" href="{{route('payment.edit', ['id' => $payment->id])}}">Edit</a>
                                                <a class="btn-sm app-btn-secondary" href="{{route('payment.view', ['id' => $payment->id])}}">View</a>
                                                <a id="{{$payment['id']}}" class="btn-sm app-btn-secondary app-btn-secondary-delete">Delete Payment Info</a>
                                            </td>
                                            <td>
                                                @if($payment->approved === 0 || $payment->approved === null)
                                                    <input type="checkbox" name="approval_checkbox" data-payment-id="{{ $payment->id }}">
                                                @else
                                                    <span style="color: green;">Approved</span>
                                                    <input type="checkbox" name="approval_checkbox" data-payment-id="{{ $payment->id }}" checked style="display: none;">
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- orders-admin tab -->
                <div class="tab-pane fade" id="orders-admin" role="tabpanel" aria-labelledby="orders-admin-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left table table-striped table-bordered" id="adminTable">
                                    <thead>
                                        <tr>
                                            <th class="cell">Agenda</th>
                                            <th class="cell">Student</th>
                                            <th class="cell">Amount</th>
                                            <th class="cell">Type</th>
                                            <th class="cell">Method</th>
                                            <th class="cell">Date Paid</th>
                                            <th class="col-actions cell">Actions</th>
                                            <th class="col-actions cell">Approval</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($payments as $payment)
                                        @if($payment->method == 'FULL')
                                            <tr data-method="{{ $payment->method }}">
                                                <td>{{ $payment->agendas->agenda_name }}</td>
                                                <td>{{ $payment->students->name }}</td>
                                                <td>{{ $payment->amount }}</td>
                                                <td>
                                                    @if($payment->type  == 'ONLINE')
                                                        <span class="badge badge-pill badge-online">ONLINE</span>
                                                    @else
                                                        <span class="badge badge-pill badge-full">CASH</span>
                                                    @endif
                                                </td>
                                                <td><span class="badge badge-pill badge-full">{{ $payment->method }}</span></td>
                                                <td class="cell">
                                                    <span>{{ date('j M', strtotime($payment->created_at)) }}</span>
                                                    <span class="note">{{ date('g:i A', strtotime($payment->created_at)) }}</span>
                                                </td>
                                                <td>
                                                    <a class="btn-sm app-btn-secondary" href="{{route('payment.edit', ['id' => $payment->id])}}">Edit</a>
                                                    <a class="btn-sm app-btn-secondary" href="{{route('payment.view', ['id' => $payment->id])}}">View</a>
                                                    <a id="{{$payment['id']}}" class="btn-sm app-btn-secondary app-btn-secondary-delete">Delete Payment Info</a>
                                                </td>
                                                <td>
                                                    @if($payment->approved === 0 || $payment->approved === null)
                                                        <input type="checkbox" name="approval_checkbox" data-payment-id="{{ $payment->id }}">
                                                    @else
                                                        <span style="color: green;">Approved</span>
                                                        <input type="checkbox" name="approval_checkbox" data-payment-id="{{ $payment->id }}" checked style="display: none;">
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- orders-user tab -->
                <div class="tab-pane fade" id="orders-user" role="tabpanel" aria-labelledby="orders-user-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left table table-striped table-bordered" id="userTablePartial">
                                    <thead>
                                        <tr>
                                            <th class="cell">Agenda</th>
                                            <th class="cell">Student</th>
                                            <th class="cell">Amount</th>
                                            <th class="cell">Type</th>
                                            <th class="cell">Method</th>
                                            <th class="cell">Date Paid</th>
                                            <th class="col-actions cell">Actions</th>
                                            <th class="col-actions cell">Approval</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($payments as $payment)
                                        @if($payment->method == 'PARTIAL')
                                            <tr data-method="{{ $payment->method }}">
                                                <td>{{ $payment->agendas->agenda_name }}</td>
                                                <td>{{ $payment->students->name }}</td>
                                                <td>{{ $payment->amount }}</td>
                                                <td>
                                                    @if($payment->type  == 'ONLINE')
                                                        <span class="badge badge-pill badge-online">ONLINE</span>
                                                    @else
                                                        <span class="badge badge-pill badge-full">CASH</span>
                                                    @endif
                                                </td>
                                                <td><span class="badge badge-pill badge-partial">{{ $payment->method }}</span></td>
                                                <td class="cell">
                                                    <span>{{ date('j M', strtotime($payment->created_at)) }}</span>
                                                    <span class="note">{{ date('g:i A', strtotime($payment->created_at)) }}</span>
                                                </td>
                                                <td>
                                                    <a class="btn-sm app-btn-secondary" href="{{route('payment.edit', ['id' => $payment->id])}}">Edit</a>
                                                    <a class="btn-sm app-btn-secondary" href="{{route('payment.view', ['id' => $payment->id])}}">View</a>
                                                    <a id="{{$payment['id']}}" class="btn-sm app-btn-secondary app-btn-secondary-delete">Delete Payment Info</a>
                                                </td>
                                                <td>
                                                    @if($payment->approved === 0 || $payment->approved === null)
                                                        <input type="checkbox" name="approval_checkbox" data-payment-id="{{ $payment->id }}">
                                                    @else
                                                        <span style="color: green;">Approved</span>
                                                        <input type="checkbox" name="approval_checkbox" data-payment-id="{{ $payment->id }}" checked style="display: none;">
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn app-btn-secondary" id="approvePaymentsButton">Approve Selected</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Payment Modal -->
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="addPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addPaymentForm" action="{{ route('payment.post') }}" method="POST" novalidate>
                @csrf
                <div class="modal-body">
                    <!-- Agenda -->
                    <div class="mb-3">
                        <label for="agenda_id" class="form-label">Agenda *</label>
                        <select name="agenda_id" id="agenda_id" class="form-select">
                            <option value="" selected disabled>Select Agenda</option>
                            @foreach($agendas as $agenda)
                                <option value="{{ $agenda->id }}" data-indiv-contrib="{{ $agenda->indiv_contrib }}">
                                    {{ $agenda->agenda_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <select name="student_id" id="student_id" class="form-select mb-3">
                        <option value="" selected disabled>Select Student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" data-course="{{ $student->course ? $student->course->course_name : '' }}">
                                {{ $student->name }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Course -->
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Course</label>
                        <input type="text" id="course_id" class="form-control" readonly placeholder="Auto-filled from Student">
                    </div>

                    <!-- Payment & Amount Required -->
                    <div class="row mb-3">
                        <div class="col">
                            <label for="paymentInput" class="form-label">Payment</label>
                            <input type="number" id="paymentInput" name="amount" class="form-control" value="0.00" min="0" step="0.01">
                        </div>
                        <div class="col">
                            <label for="amountRequired" class="form-label">Amount Required</label>
                            <input type="number" id="amountRequired" name="amount2" class="form-control" readonly step="0.01">
                        </div>
                    </div>

                    <!-- Payment Type -->
                    <div class="mb-3">
                        <label for="paymentType" class="form-label">Payment Type</label>
                        <select name="type" id="paymentType" class="form-select">
                            <option value="Online">Online Payment</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Payment Method</label>
                        <select name="method_display" id="paymentMethod" class="form-select">
                            <option value="Full">Full Payment</option>
                            <option value="Partial">Partial Payment</option>
                        </select>
                        <!-- Hidden real input submitted to server (name must be 'method') -->
                        <input type="hidden" id="method_hidden" name="method" value="Full">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="savePaymentBtn" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Approve Payments Modal (unused by JS but kept as in original) -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve Payments</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="form" action="{{ route ('payment.post') }}" method="POST" novalidate>
                @csrf
                <div class="p-3">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                    @endif
                </div>

                <div class="modal-footer" style="margin-top:35px;">
                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Consolidated, refactored JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script>
(function ($) {
    'use strict';

    const selectors = {
        agenda: '#agenda_id',
        student: '#student_id',
        course: '#course_id',
        amountRequired: '#amountRequired',
        paymentInput: '#paymentInput',
        paymentMethod: '#paymentMethod',
        methodHidden: '#method_hidden',
        saveBtn: '#savePaymentBtn',
        addModal: '#add',
        deleteBtnClass: '.app-btn-secondary-delete',
        approveBtn: '#approvePaymentsButton',
        userTable: '#userTable',
        userTablePartial: '#userTablePartial',
        elementsSelect: '#elements-select',
        searchInput: '#myInput'
    };

    // Safely parse float
    function parseFloatSafe(v) {
        const n = parseFloat(v);
        return Number.isFinite(n) ? n : 0;
    }

    // DOM cached jQuery objects
    const $agenda = $(selectors.agenda);
    const $student = $(selectors.student);
    const $course = $(selectors.course);
    const $amountRequired = $(selectors.amountRequired);
    const $paymentInput = $(selectors.paymentInput);
    const $paymentMethod = $(selectors.paymentMethod);
    const $methodHidden = $(selectors.methodHidden);
    const $saveBtn = $(selectors.saveBtn);
    const $elementsSelect = $(selectors.elementsSelect);
    const $searchInput = $(selectors.searchInput);

    // INITIAL: sync hidden method with select
    $methodHidden.val($paymentMethod.val() || 'Full');

    // Show course name when student selected
    $student.on('change', function () {
        const courseName = $(this).find(':selected').data('course') || '';
        $course.val(courseName);
    });

    // Modal reset when opened
    $(selectors.addModal).on('show.bs.modal', function () {
        $agenda.val('');
        $student.val('');
        $course.val('');
        $paymentInput.val('0.00');
        $paymentMethod.val('Full').prop('disabled', false);
        $methodHidden.val('Full');
        $amountRequired.val('');
        $amountRequired.data('original', 0);
        $saveBtn.prop('disabled', false);
    });

    // When agenda changes: set original contribution + auto-fill according to current method
    $agenda.on('change', function () {
        const indivContrib = parseFloatSafe($(this).find(':selected').data('indiv-contrib'));
        $amountRequired.data('original', indivContrib);

        const method = $paymentMethod.val();
        if (method === 'Partial') {
            const half = +(indivContrib * 0.5).toFixed(2);
            $amountRequired.val(half.toFixed(2));
            $paymentInput.val(half.toFixed(2));
        } else {
            $amountRequired.val(indivContrib.toFixed(2));
            $paymentInput.val(indivContrib.toFixed(2));
        }

        // If student already selected, re-check payment status (partial/full)
        if ($student.val()) {
            checkPaymentStatus();
        }
    });

    // When payment method changes: update hidden input + auto-fill payment
    $paymentMethod.on('change', function () {
        const method = $(this).val();
        $methodHidden.val(method);

        // compute original if available, fallback from selected agenda option
        let original = parseFloatSafe($amountRequired.data('original'));
        if (!original) {
            original = parseFloatSafe($agenda.find(':selected').data('indiv-contrib'));
            $amountRequired.data('original', original);
        }

        if (method === 'Partial') {
            const partial = +(original * 0.5).toFixed(2);
            $amountRequired.val(partial.toFixed(2));
            $paymentInput.val(partial.toFixed(2));
        } else {
            $amountRequired.val(original.toFixed(2));
            $paymentInput.val(original.toFixed(2));
        }
    });

    // Keep hidden method synced if select is changed elsewhere
    $paymentMethod.on('change', function () {
        $methodHidden.val($(this).val());
    });

    // Prevent payment input exceeding required
    $paymentInput.on('input', function () {
        const payment = parseFloatSafe($(this).val());
        const required = parseFloatSafe($amountRequired.val());
        if (payment > required) $(this).val(required.toFixed(2));
    });

    // Check payment status endpoint and react accordingly
    function checkPaymentStatus() {
        const studentId = $student.val();
        const agendaId = $agenda.val();

        // reset defaults
        $saveBtn.prop('disabled', false);
        $paymentMethod.prop('disabled', false);

        if (!studentId || !agendaId) return;

        $.ajax({
            url: `/check-payment-status/${studentId}/${agendaId}`,
            method: 'GET',
            success: function (response) {
                if (response.status === 'full') {
                    Swal.fire({ icon: 'info', title: 'Fully Paid', text: response.message });
                    $saveBtn.prop('disabled', true);
                    $paymentInput.val('0.00');
                    $amountRequired.val('0.00');
                    $methodHidden.val($paymentMethod.val() || 'Full');
                } else if (response.status === 'partial') {
                    Swal.fire({ icon: 'warning', title: 'Partial Payment', text: response.message });
                    // Force next payment to Full (business rule) — UI shows it and disables the select
                    $paymentMethod.val('Full').prop('disabled', true);
                    $methodHidden.val('Full');

                    const remaining = parseFloatSafe(response.remaining);
                    $amountRequired.val(remaining.toFixed(2));
                    $paymentInput.val(remaining.toFixed(2));
                    $saveBtn.prop('disabled', false);
                } else {
                    // none: new payment
                    $saveBtn.prop('disabled', false);
                    $paymentMethod.prop('disabled', false);
                    const indiv = parseFloatSafe($agenda.find(':selected').data('indiv-contrib')) || 0;
                    $amountRequired.data('original', indiv);

                    if ($paymentMethod.val() === 'Partial') {
                        const half = +(indiv * 0.5).toFixed(2);
                        $amountRequired.val(half.toFixed(2));
                        $paymentInput.val(half.toFixed(2));
                    } else {
                        $amountRequired.val(indiv.toFixed(2));
                        $paymentInput.val(indiv.toFixed(2));
                    }

                    $methodHidden.val($paymentMethod.val() || 'Full');
                }
            },
            error: function () {
                console.error('Error checking payment status');
            }
        });
    }

    // Bind handlers for checkPaymentStatus
    $student.on('change', checkPaymentStatus);
    $agenda.on('change', checkPaymentStatus);

    // DELETE payment via AJAX (uses Swal confirm)
    $(document).on('click', selectors.deleteBtnClass, function (e) {
        e.preventDefault();
        const id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to undo this.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (!result.isConfirmed) return;
            $.ajax({
                url: '{{ route('payment.destroy') }}',
                method: 'get',
                data: { id: id, _token: '{{ csrf_token() }}' },
                success: function () {
                    Swal.fire('Deleted!', 'Your file has been deleted.', 'success').then(() => {
                        window.location.href = '{{ route('payment.index') }}';
                    });
                },
                error: function () {
                    Swal.fire('Error!', 'Unable to delete.', 'error');
                }
            });
        });
    });

    // Approve selected payments
    $(selectors.approveBtn).on('click', function () {
        Swal.fire({
            title: 'Are you sure you want to approve payment?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, approve it!'
        }).then((result) => {
            if (!result.isConfirmed) return;

            const checkedCheckboxes = document.querySelectorAll('input[name="approval_checkbox"]:checked');
            const paymentIds = Array.from(checkedCheckboxes).map(cb => cb.dataset.paymentId);

            fetch('{{ url('/update-payments') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ paymentIds: paymentIds })
            })
            .then(response => {
                if (!response.ok) throw new Error('Failed to update payments');
                return response.json();
            })
            .then(() => {
                Swal.fire('Approved!', 'The payments have been approved.', 'success').then(() => {
                    location.reload();
                });
            })
            .catch(() => {
                Swal.fire('Error!', 'There was an error approving the payments.', 'error');
            });
        });
    });

    // Table rows show/hide based on elements-select
    $elementsSelect.on('change', function () {
        const selectedValue = parseInt($(this).val(), 10);
        // apply to both tables for consistency
        [selectors.userTable, selectors.userTablePartial, '#adminTable'].forEach(tid => {
            const $tbl = $(tid);
            if (!$tbl.length) return;
            const rows = $tbl.find('tbody tr');
            rows.each((idx, row) => {
                $(row).toggle(idx < selectedValue);
            });
        });
    });

    // small search function already used on input with onkeyup; keep it global
    window.myFunction = function () {
        var input = document.getElementById("myInput");
        var filter = input.value.toUpperCase();
        // search in main all-table
        var table = document.getElementById("userTable");
        if (!table) return;
        var tr = table.getElementsByTagName("tr");
        for (var i = 0; i < tr.length; i++) {
            var found = false;
            for (var j = 0; j < tr[i].cells.length - 1; j++) {
                var td = tr[i].getElementsByTagName("td")[j];
                if (td) {
                    var txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            tr[i].style.display = found ? "" : "none";
        }
    };

    // small helper for filterRows (tabs)
    window.filterRows = function (filter) {
        const rows = document.querySelectorAll('tr[data-method]');
        rows.forEach((row) => {
            const method = row.getAttribute('data-method');
            if (filter === 'all' || method.toLowerCase() === filter.toLowerCase()) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    };

    // SweetAlert on register success (keeps existing behavior)
    @if(session('sweetAlert'))
        $(function () {
            Swal.fire({
                title: 'Payment Registered.',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.reload();
            });
        });
    @endif

})(jQuery);
</script>

<!-- keep other required scripts at bottom (unchanged) -->
<script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"></script>
<script src="assets/plugins/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/chart.js/chart.min.js"></script>
<script src="assets/js/index-charts.js"></script>
<script src="assets/js/app.js"></script>

@endsection
