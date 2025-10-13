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
                                        <tr data-method="{{ $payment->method }}" data-payment-id-row="{{ $payment->id }}">
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
                                                <a id="{{ $payment->id }}" class="btn-sm app-btn-secondary app-btn-secondary-delete">Delete Payment Info</a>
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

                <!-- orders-admin & orders-user are unchanged visually; rows include data-payment-id-row as above -->
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
                                            <tr data-method="{{ $payment->method }}" data-payment-id-row="{{ $payment->id }}">
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
                                                    <a id="{{ $payment->id }}" class="btn-sm app-btn-secondary app-btn-secondary-delete">Delete Payment Info</a>
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
                                            <tr data-method="{{ $payment->method }}" data-payment-id-row="{{ $payment->id }}">
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
                                                    <a id="{{ $payment->id }}" class="btn-sm app-btn-secondary app-btn-secondary-delete">Delete Payment Info</a>
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

            <!-- NOTE: student input is now typable (datalist) + hidden input student_id will be submitted -->
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

                    <!-- Typable student field (datalist) + custom suggestions -->
                    <div class="mb-2 position-relative">
                        <label for="student_input" class="form-label">Student *</label>
                        <input id="student_input" class="form-control" list="studentsList" placeholder="Type to search student..." autocomplete="off">
                        <datalist id="studentsList">
                            @foreach($students as $student)
                                <!-- data-course included so JS can auto-fill course -->
                                <option data-id="{{ $student->id }}" data-course="{{ $student->course ? $student->course->course_name : '' }}" value="{{ $student->name }}"></option>
                            @endforeach
                        </datalist>
                        <!-- custom suggestion box (JS will populate) -->
                        <div id="studentSuggestions" class="student-suggestions d-none"></div>

                        <!-- hidden input that will be submitted -->
                        <input type="hidden" id="student_hidden" name="student_id" value="">
                    </div>

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

<!-- keep updateModal unchanged -->
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

<!-- light CSS for suggestions -->
<style>
.student-suggestions {
    position: absolute;
    left: 0;
    right: 0;
    top: calc(100% + 4px);
    z-index: 2100;
    background: #fff;
    border: 1px solid rgba(0,0,0,0.15);
    box-shadow: 0 3px 8px rgba(0,0,0,0.12);
    max-height: 220px;
    overflow-y: auto;
    border-radius: 4px;
}
.student-suggestions .suggestion-item {
    padding: 8px 12px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.student-suggestions .suggestion-item:hover {
    background: #f6f6f6;
}
.student-suggestions .small-muted {
    font-size: 0.82rem;
    color: #666;
    margin-left: 8px;
}
</style>

<!-- Consolidated, refactored JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script>
(function ($) {
    'use strict';

    const selectors = {
        agenda: '#agenda_id',
        studentInput: '#student_input',
        studentHidden: '#student_hidden',
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
        adminTable: '#adminTable',
        elementsSelect: '#elements-select',
        searchInput: '#myInput',
        addPaymentForm: '#addPaymentForm',
        studentSuggestions: '#studentSuggestions'
    };

    function parseFloatSafe(v) {
        const n = parseFloat(v);
        return Number.isFinite(n) ? n : 0;
    }

    // caches
    const $agenda = $(selectors.agenda);
    const $studentInput = $(selectors.studentInput);
    const $studentHidden = $(selectors.studentHidden);
    const $course = $(selectors.course);
    const $amountRequired = $(selectors.amountRequired);
    const $paymentInput = $(selectors.paymentInput);
    const $paymentMethod = $(selectors.paymentMethod);
    const $methodHidden = $(selectors.methodHidden);
    const $saveBtn = $(selectors.saveBtn);
    const $elementsSelect = $(selectors.elementsSelect);
    const $addPaymentForm = $(selectors.addPaymentForm);
    const $studentSuggestions = $(selectors.studentSuggestions);

    // build student array from datalist options
    const studentOptions = Array.from(document.querySelectorAll('#studentsList option')).map(o => ({
        id: o.getAttribute('data-id'),
        name: o.value,
        course: o.getAttribute('data-course') || ''
    }));

    // init
    $methodHidden.val($paymentMethod.val() || 'Full');

    // function to render suggestion list
    function showStudentSuggestions(filter) {
        const q = (filter || '').toLowerCase().trim();
        const matches = q === '' ? studentOptions.slice(0, 25) : studentOptions.filter(s => s.name.toLowerCase().includes(q));
        if (!matches.length) {
            $studentSuggestions.addClass('d-none').empty();
            return;
        }
        let html = '';
        matches.forEach(s => {
            html += `<div class="suggestion-item" data-id="${s.id}" data-name="${escapeHtml(s.name)}" data-course="${escapeHtml(s.course)}">
                        <div>${escapeHtml(s.name)}</div>
                        <div class="small-muted">${escapeHtml(s.course)}</div>
                    </div>`;
        });
        $studentSuggestions.html(html).removeClass('d-none');
    }

    function hideStudentSuggestions() {
        $studentSuggestions.addClass('d-none');
    }

    // when typing focus: show suggestions filtered
    $studentInput.on('input focus', function () {
        const v = $(this).val();
        showStudentSuggestions(v);
    });

    // click suggestion
    $studentSuggestions.on('click', '.suggestion-item', function () {
        const id = $(this).attr('data-id');
        const name = $(this).attr('data-name');
        const course = $(this).attr('data-course');

        $studentInput.val(name);
        $studentHidden.val(id);
        $course.val(course);
        hideStudentSuggestions();

        // After choosing a student, check payment status if agenda chosen
        if ($agenda.val()) checkPaymentStatus();
    });

    // hide suggestions on outside click
    $(document).on('click', function (e) {
        if (!$(e.target).closest(selectors.studentInput).length &&
            !$(e.target).closest(selectors.studentSuggestions).length) {
            hideStudentSuggestions();
        }
    });

    // also hide suggestions on escape key
    $studentInput.on('keydown', function (e) {
        if (e.key === 'Escape') hideStudentSuggestions();
    });

    // modal reset
    $(selectors.addModal).on('show.bs.modal', function () {
        $agenda.val('');
        $studentInput.val('');
        $studentHidden.val('');
        $course.val('');
        $paymentInput.val('0.00');
        $paymentMethod.val('Full').prop('disabled', false);
        $methodHidden.val('Full');
        $amountRequired.val('');
        $amountRequired.data('original', 0);
        $saveBtn.prop('disabled', false).text('Save');
        hideStudentSuggestions();
    });

    // agenda change
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
    });

    // method change
    $paymentMethod.on('change', function () {
        const method = $(this).val();
        $methodHidden.val(method);

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

    // prevent payment > required
    $paymentInput.on('input', function () {
        const payment = parseFloatSafe($(this).val());
        const required = parseFloatSafe($amountRequired.val());
        if (payment > required) $(this).val(required.toFixed(2));
    });

    // check payment status
    function checkPaymentStatus() {
        const studentId = $studentHidden.val();
        const agendaId = $agenda.val();

        $saveBtn.prop('disabled', false);
        $paymentMethod.prop('disabled', false);

        if (!studentId || !agendaId) return;

        $.ajax({
            url: `/check-payment-status/${studentId}/${agendaId}`,
            method: 'GET',
            dataType: 'json'
        })
        .done(function (response) {
            if (response.status === 'full') {
                // use small toast + disable save
                Swal.fire({ toast: true, position: 'top-end', icon: 'info', title: 'Fully Paid', text: response.message, timer: 2000, showConfirmButton: false });
                $saveBtn.prop('disabled', true);
                $paymentInput.val('0.00');
                $amountRequired.val('0.00');
                $methodHidden.val($paymentMethod.val() || 'Full');
            } else if (response.status === 'partial') {
                Swal.fire({ toast: true, position: 'top-end', icon: 'warning', title: 'Partial Payment', text: response.message, timer: 3000, showConfirmButton: false });
                $paymentMethod.val('Full').prop('disabled', true);
                $methodHidden.val('Full');
                const remaining = parseFloatSafe(response.remaining);
                $amountRequired.val(remaining.toFixed(2));
                $paymentInput.val(remaining.toFixed(2));
                $saveBtn.prop('disabled', false);
            } else {
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
        })
        .fail(function () {
            console.error('Error checking payment status');
        });
    }

    // bind status checks
    $studentInput.on('change blur', function () {
        // ensure hidden id and course are set if they typed or selected
        const val = $(this).val();
        const match = studentOptions.find(s => s.name === val);
        if (match) {
            $studentHidden.val(match.id || '');
            $course.val(match.course || '');
        } else {
            // keep hidden blank until they pick
            $studentHidden.val('');
            $course.val('');
        }
        checkPaymentStatus();
    });
    $agenda.on('change', checkPaymentStatus);

    // AJAX create payment (explicitly expects JSON)
    $addPaymentForm.on('submit', function (e) {
        e.preventDefault();

        const studentId = $studentHidden.val();
        if (!studentId) {
            Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: 'Please select a student from the list', timer: 2500, showConfirmButton: false });
            return;
        }

        const $form = $(this);
        const url = $form.attr('action');
        const payload = $form.serialize();

        $saveBtn.prop('disabled', true).text('Saving...');

        $.ajax({
            url: url,
            method: 'POST',
            data: payload,
            dataType: 'json',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .done(function (res) {
            try {
                if (res && res.success && res.payment) {
                    $('#add').modal('hide');

                    const p = res.payment;
                    const rowHtml = buildPaymentRowHtml(p);

                    // Insert into the lists – prepend so newest is on top
                    $('#userTable').prepend(rowHtml.fullRow);
                    if (p.method && p.method.toUpperCase() === 'FULL') {
                        if ($('#adminTable tbody').length) $('#adminTable tbody').prepend(rowHtml.fullRow);
                    } else {
                        if ($('#userTablePartial tbody').length) $('#userTablePartial tbody').prepend(rowHtml.fullRow);
                    }

                    // Swal toast
                    Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Payment Registered', timer: 2000, showConfirmButton: false });

                    // ALSO add a Bootstrap alert at the top of the page (more visible)
                    const $alert = $(`<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                        Payment Registered successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>`);
                    $('.container-xl').first().prepend($alert);
                    setTimeout(() => { $alert.alert('close'); }, 3000);

                    $form[0].reset();
                    $methodHidden.val('Full');
                } else {
                    console.warn('Unexpected AJAX response, reloading.');
                    window.location.reload();
                }
            } catch (err) {
                console.error(err);
                window.location.reload();
            }
        })
        .fail(function (xhr) {
            let msg = 'Server error';
            if (xhr && xhr.responseJSON && xhr.responseJSON.errors) {
                const errs = xhr.responseJSON.errors;
                msg = Object.values(errs).map(a => a.join(' ')).join('. ');
            } else if (xhr && xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.message;
            }
            Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: msg, timer: 4000, showConfirmButton: false });
        })
        .always(function () {
            $saveBtn.prop('disabled', false).text('Save');
        });
    });

    // helper for building the new table row
    function buildPaymentRowHtml(p) {
        const typeBadge = (p.type && p.type.toUpperCase() === 'ONLINE') ? '<span class="badge badge-pill badge-online">ONLINE</span>' : '<span class="badge badge-pill badge-full">CASH</span>';
        const methodBadge = (p.method && p.method.toUpperCase() === 'PARTIAL') ? '<span class="badge badge-pill badge-partial">PARTIAL</span>' : '<span class="badge badge-pill badge-full">FULL</span>';
        const createdDate = p.created_at_formatted || p.created_at || '';
        const createdTime = p.created_at_time || '';
        const fullRow = `
            <tr data-method="${escapeHtml(p.method || '')}" data-payment-id-row="${escapeHtml(p.id || '')}">
                <td>${escapeHtml(p.agenda_name || '')}</td>
                <td>${escapeHtml(p.student_name || '')}</td>
                <td>${escapeHtml(p.amount || '')}</td>
                <td>${typeBadge}</td>
                <td>${methodBadge}</td>
                <td class="cell"><span>${createdDate}</span><span class="note">${createdTime}</span></td>
                <td>
                    <a class="btn-sm app-btn-secondary" href="/payments/edit/${p.id}">Edit</a>
                    <a class="btn-sm app-btn-secondary" href="/payments/view/${p.id}">View</a>
                    <a id="${p.id}" class="btn-sm app-btn-secondary app-btn-secondary-delete">Delete Payment Info</a>
                </td>
                <td>
                    <input type="checkbox" name="approval_checkbox" data-payment-id="${p.id}">
                </td>
            </tr>
        `;
        return { fullRow };
    }

    function escapeHtml(unsafe) {
        return ('' + unsafe)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    // delete (AJAX) — note: no dataType to avoid parse errors if server returns empty body
    $(document).on('click', selectors.deleteBtnClass, function (e) {
        e.preventDefault();
        const $btn = $(this);
        const id = $btn.attr('id');
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
                data: { id: id, _token: '{{ csrf_token() }}' }
            })
            .done(function () {
                $(`[data-payment-id-row="${id}"]`).fadeOut(240, function () { $(this).remove(); });
                Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Deleted!', text: 'Payment deleted', timer: 1800, showConfirmButton: false });
            })
            .fail(function () {
                Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: 'Unable to delete', timer: 2000, showConfirmButton: false });
            });
        });
    });

    // Approve (AJAX)
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

            if (!paymentIds.length) {
                Swal.fire({ toast: true, position: 'top-end', icon: 'info', title: 'No payments selected', timer: 1500, showConfirmButton: false });
                return;
            }

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
                paymentIds.forEach(id => {
                    $(`input[name="approval_checkbox"][data-payment-id="${id}"]`).each(function () {
                        $(this).closest('td').html('<span style="color: green;">Approved</span><input type="checkbox" data-payment-id="' + id + '" checked style="display:none;">');
                    });
                });
                Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Approved!', timer: 1500, showConfirmButton: false });
            })
            .catch(() => {
                Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: 'There was an error approving the payments.', timer: 2000, showConfirmButton: false });
            });
        });
    });

    // elements-select behaviour
    $elementsSelect.on('change', function () {
        const selectedValue = parseInt($(this).val(), 10);
        [selectors.userTable, selectors.userTablePartial, selectors.adminTable].forEach(tid => {
            const $tbl = $(tid);
            if (!$tbl.length) return;
            const rows = $tbl.find('tbody tr');
            rows.each((idx, row) => { $(row).toggle(idx < selectedValue); });
        });
    });

    // search function used on keyup
    window.myFunction = function () {
        var input = document.getElementById("myInput");
        var filter = input.value.toUpperCase();
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
                        found = true; break;
                    }
                }
            }
            tr[i].style.display = found ? "" : "none";
        }
    };

    window.filterRows = function (filter) {
        const rows = document.querySelectorAll('tr[data-method]');
        rows.forEach((row) => {
            const method = row.getAttribute('data-method') || '';
            if (filter === 'all' || method.toLowerCase() === filter.toLowerCase()) row.style.display = 'table-row';
            else row.style.display = 'none';
        });
    };

    // fallback: if server left session sweetAlert for non-AJAX fallback, show toast and reload lightly
    @if(session('sweetAlert'))
        $(function () {
            Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Payment Registered', timer: 1800, showConfirmButton: false }).then(() => { window.location.reload(); });
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
