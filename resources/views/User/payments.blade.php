@extends('layouts.user_main')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                                 <a class="btn app-btn-secondary" href="#" data-toggle="modal" data-target="#add">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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
                                            <th class="cell">Approval</th>
                                            <th class="cell">Receipt</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userTable">
                                        @if($payments->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center">NO DATA</td>
                                            </tr>
                                        @else
                                            @foreach($payments as $payment)
                                                <tr data-method="{{ $payment->method }}">
                                                    <td>{{ $payment->agendas->agenda_name ?? 'N/A' }}</td>
                                                    <td>{{ $payment->students->name ?? 'N/A' }}</td>
                                                    <td>{{ number_format($payment->amount, 2) }}</td>
                                                    <td>
                                                        @if(strtoupper($payment->type) === 'ONLINE')
                                                            <span class="badge badge-pill badge-online">ONLINE</span>
                                                        @else
                                                            <span class="badge badge-pill badge-full">CASH</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(strtoupper($payment->method) === 'PARTIAL')
                                                            <span class="badge badge-pill badge-partial">PARTIAL</span>
                                                        @else
                                                            <span class="badge badge-pill badge-full">FULL</span>
                                                        @endif
                                                    </td>
                                                    <td class="cell">
                                                        <span>{{ date('j M', strtotime($payment->created_at)) }}</span>
                                                        <span class="note">{{ date('g:i A', strtotime($payment->created_at)) }}</span>
                                                    </td>
                                                    <td class="cell">
                                                        @if($payment->approved == 1)
                                                            <span class="badge badge-pill bg-success">Approved</span>
                                                        @else
                                                            <span class="badge badge-pill bg-danger">Not Approved</span>
                                                        @endif
                                                    </td>
                                                   <td class="cell">
                                                        @if(Route::has('payment.invoice.user'))
                                                            <a class="btn-sm app-btn-secondary" href="{{ route('payment.invoice.user', $payment->id) }}">View Receipt</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Add Payment Modal --}}
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="loginModalTitle">Register Payment</h5>
                            <button type="button" class="btn-close" data-dismiss="modal"></button>
                        </div>

                        {{-- NOTE: form id + save button id added so JS can hook into them --}}
                        <form id="addPaymentFormUser" action="{{ route('payment.post') }}" method="POST" novalidate>
                            @csrf

                            {{-- Agenda --}}
                            <div class="form-group px-5">
                                <h5>Agenda</h5>
                                <select name="agenda_id" id="agenda_id" class="form-control mb-1" required>
                                    <option value="" selected disabled>Select Agenda</option>
                                    @foreach($agendas as $agenda)
                                        <option value="{{ $agenda->id }}" data-indiv-contrib="{{ $agenda->indiv_contrib }}">{{ $agenda->agenda_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Student ID (readonly) --}}
                            <div class="form-group px-5">
                                <h5>Student ID</h5>
                                <input id="student_id" type="number" name="student_id" class="form-control mb-1"
                                    value="{{ Auth::user()->student->id ?? '' }}" readonly required>       
                            </div>

                            {{-- Payment / Amount Required --}}
                            <div class="form-group row px-5">
                                <div class="col-md-6">
                                    <h5>Payment</h5>
                                    <input id="paymentInput" type="number" name="amount" class="form-control mb-1" placeholder="0.00" min="0" step="0.01" required>
                                </div>
                                <div class="col-md-6">
                                    <h5>Amount Required</h5>
                                    <input id="amountRequired" type="number" class="form-control mb-1" readonly>
                                    {{-- remaining note inserted dynamically --}}
                                </div>
                            </div>

                            {{-- Payment Type --}}
                            <div class="form-group px-5">
                                <h5>Payment Type</h5>
                                <select name="type" class="form-control mb-1" required>
                                    <option value="Online">Online Payment</option>
                                    <option value="Cash">Cash</option>
                                </select>
                            </div>

                            {{-- Payment Method --}}
                            <div class="form-group px-5">
                                <h5>Payment Method</h5>
                                {{-- visible select (can be disabled for UX) --}}
                                <select id="paymentMethod" class="form-control mb-1">
                                    <option value="Full">Full Payment</option>
                                    <option value="Partial">Partial Payment</option>
                                </select>

                                {{-- hidden input that is actually submitted to the server --}}
                                <input type="hidden" id="method_hidden" name="method" value="Full">
                            </div>

                            <div class="modal-footer" style= "margin-top:35px;">
                                <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                                    <i class="ft-x"></i> Cancel
                                </button>
                                <button type="submit" id="savePaymentBtnUser" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!--//modal-->

<!-- hidden students data (existing) -->
<div id="studentsData" data-students="{{ $studentsJson ?? '[]' }}" style="display: none;"></div>

<!-- jQuery (latest stable) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Bootstrap 5 Bundle (includes Popper) -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- jqBootstrapValidation -->
<script src="assets/plugins/jqBootstrapValidation.js"></script>

<!-- Chart plugin (optional) -->
<script src="assets/plugins/chart.js/chart.min.js"></script>

<!-- Your custom JS -->
<script src="assets/js/user.js"></script>
<script src="assets/js/index-charts.js"></script>
<script src="assets/js/app.js"></script>
<script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"></script>

<script>
(function($){
    'use strict';

    const $agenda = $('#agenda_id');
    const $paymentInput = $('#paymentInput');
    const $amountRequired = $('#amountRequired');
    const $paymentMethod = $('#paymentMethod');
    const $methodHidden = $('#method_hidden');
    const $saveBtn = $('#savePaymentBtnUser');
    const $form = $('#addPaymentFormUser');

    function parseFloatSafe(v){ const n = parseFloat(v); return Number.isFinite(n) ? n : 0; }

    // Modal open/reset
    $('#add').on('show.bs.modal', function(){
        $agenda.val('');
        $paymentInput.val('0.00');
        $paymentMethod.val('Full').prop('disabled', false);
        $methodHidden.val('Full');
        $amountRequired.val('');
        $amountRequired.data('original', 0);
        $saveBtn.prop('disabled', false).text('Save');
        $('#remainingNote').remove();
    });

    $paymentMethod.on('change', function(){
        const val = $(this).val();
        $methodHidden.val(val);
        const original = parseFloatSafe($amountRequired.data('original')) || parseFloatSafe($agenda.find(':selected').data('indiv-contrib'));
        if (val === 'Partial') {
            const partial = +(original * 0.5).toFixed(2);
            $amountRequired.val(partial.toFixed(2));
            $paymentInput.val(partial.toFixed(2));
        } else {
            $amountRequired.val(original.toFixed(2));
            $paymentInput.val(original.toFixed(2));
        }
    });

    $agenda.on('change', function(){
        const agendaId = $(this).val();
        const studentId = $('#student_id').val();
        $('#remainingNote').remove();
        const indiv = parseFloatSafe($(this).find(':selected').data('indiv-contrib'));
        $amountRequired.data('original', indiv);

        const methodVal = $paymentMethod.val() || 'Full';
        if (methodVal === 'Partial') {
            const half = +(indiv * 0.5).toFixed(2);
            $amountRequired.val(half.toFixed(2));
            $paymentInput.val(half.toFixed(2));
        } else {
            $amountRequired.val(indiv.toFixed(2));
            $paymentInput.val(indiv.toFixed(2));
        }

        $methodHidden.val($paymentMethod.val() || 'Full');

        if (agendaId && studentId) {
            $.ajax({
                url: `/check-payment-status/${studentId}/${agendaId}`,
                method: 'GET'
            })
            .done(function(resRaw) {
                let res = resRaw;
                if (typeof resRaw === 'string') {
                    try { res = JSON.parse(resRaw); } catch(e) { res = {}; }
                }

                if (res.status === 'full') {
                    Swal.fire({ toast:true, position:'top-end', icon:'info', title: res.message || 'Already fully paid', timer:3000, showConfirmButton:false });
                    $saveBtn.prop('disabled', true).text('Already Paid');
                    $methodHidden.val($paymentMethod.val() || 'Full');
                } else if (res.status === 'partial') {
                    const remaining = parseFloatSafe(res.remaining);
                    Swal.fire({ toast:true, position:'top-end', icon:'warning', title: (res.message || 'Partial payment exists') + ` (₱${remaining.toFixed(2)} remaining)`, timer:3500, showConfirmButton:false });

                    $paymentInput.val(remaining.toFixed(2));
                    $amountRequired.val(remaining.toFixed(2));

                    if ($('#remainingNote').length === 0) {
                        $('<small id="remainingNote" class="text-warning d-block mt-1">Remaining balance: ₱' + remaining.toFixed(2) + '</small>')
                            .insertAfter('#amountRequired');
                    } else {
                        $('#remainingNote').text('Remaining balance: ₱' + remaining.toFixed(2));
                    }

                    $paymentMethod.val('Full').prop('disabled', true);
                    $methodHidden.val('Full');
                    $saveBtn.prop('disabled', false).text('Save');
                } else {
                    $saveBtn.prop('disabled', false).text('Save');
                    $paymentMethod.prop('disabled', false);
                    $methodHidden.val($paymentMethod.val() || 'Full');
                }
            })
            .fail(function() {
                $saveBtn.prop('disabled', false).text('Save');
                $paymentMethod.prop('disabled', false);
            });
        }
    });

    $paymentInput.on('input', function(){
        const payment = parseFloatSafe($(this).val());
        const required = parseFloatSafe($amountRequired.val());
        if (payment > required) $(this).val(required.toFixed(2));
    });

    // AJAX submit (improved)
    $form.on('submit', function(e){
        e.preventDefault();

        if (!$agenda.val()) {
            Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: 'Please select an agenda', timer: 2500, showConfirmButton: false });
            return;
        }

        $methodHidden.val($paymentMethod.val() || 'Full');
        $saveBtn.prop('disabled', true).text('Saving...');

        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json',              // force JSON parsing
            cache: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            timeout: 15000, // 15s timeout for safety
            beforeSend: function() {
                console.log('[PAYMENTS] AJAX starting...');
            }
        })
        .done(function(res, textStatus, jqXHR) {
            console.log('[PAYMENTS] AJAX done. status:', jqXHR.status, 'textStatus:', textStatus, 'response:', res);

            // defensive try/catch so a JS error in handling doesn't prevent always/complete triggers
            try {
                // ensure we have an object (in case server sent a string)
                if (typeof res === 'string') {
                    try { res = JSON.parse(res); } catch (e) { console.warn('[PAYMENTS] response is string and not valid JSON'); }
                }

                if (res && res.success && res.payment) {
                    // hide modal safely
                    try {
                        const modalEl = document.getElementById('add');
                        const modalInstance = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                        modalInstance.hide();
                    } catch (hideErr) {
                        console.warn('[PAYMENTS] bootstrap modal hide failed, trying jQuery fallback', hideErr);
                        try { $('#add').modal('hide'); } catch(e){ /* ignore */ }
                    }

                    const p = res.payment;
                    $('#userTable').prepend(buildPaymentRowHtml(p));
                    Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Payment saved successfully!', timer: 2000, showConfirmButton: false });
                   // ✅ Reset the form and fields
                    $form[0].reset();
                    $agenda.val('');
                    $paymentInput.val('0.00');
                    $paymentMethod.val('Full').prop('disabled', false);
                    $methodHidden.val('Full');
                    $amountRequired.val('').data('original', 0);
                    $('#remainingNote').remove();
                    $saveBtn.prop('disabled', false).text('Save');
                } else {
                    const msg = (res && (res.message || res.error)) ? (res.message || res.error) : 'Unexpected response from server';
                    Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: msg, timer: 3500, showConfirmButton: false });
                }
            } catch (handlerErr) {
                // show more helpful user message and keep going — complete will re-enable button
                Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: 'Client error processing response (see console)', timer: 4000, showConfirmButton: false });
            }
        })
        .fail(function(xhr, textStatus, errorThrown) {

            if (xhr.responseJSON) {
                const serverMsg = xhr.responseJSON.message || xhr.responseJSON.error || JSON.stringify(xhr.responseJSON);
                Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: serverMsg, timer: 5000, showConfirmButton: false });
            } else if (xhr.status === 0 && textStatus === 'timeout') {
                Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: 'Request timeout — try again', timer: 4500, showConfirmButton: false });
            } else if (xhr.status === 419) {
                Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: 'Session expired (CSRF). Refresh the page and try again.', timer: 6000, showConfirmButton: false });
            } else {
                // fallback: show raw status message (useful when debug=true returns HTML)
                const fallback = `Server error ${xhr.status}: ${errorThrown || textStatus}`;
                Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: fallback, timer: 5000, showConfirmButton: false });
            }
        })
        .always(function(jqOrData, textStatusOrError) {
            // ALWAYS run this to restore button
            $saveBtn.prop('disabled', false).text('Save');
        });
    });

    function buildPaymentRowHtml(p){
        const typeBadge = (p.type && p.type.toUpperCase() === 'ONLINE') ? '<span class="badge badge-pill badge-online">ONLINE</span>' : '<span class="badge badge-pill badge-full">CASH</span>';
        const methodBadge = (p.method && p.method.toUpperCase() === 'PARTIAL') ? '<span class="badge badge-pill badge-partial">PARTIAL</span>' : '<span class="badge badge-pill badge-full">FULL</span>';
        const createdDate = p.created_at_formatted || '';
        const createdTime = p.created_at_time || '';
        const invoiceUrl = '{{ route("payment.invoice.user", ":id") }}'.replace(':id', encodeURIComponent(p.id || ''));

        return `
            <tr data-method="${escapeHtml(p.method || '')}">
                <td>${escapeHtml(p.agenda_name || '')}</td>
                <td>${escapeHtml(p.student_name || '')}</td>
                <td>${escapeHtml(p.amount || '')}</td>
                <td>${typeBadge}</td>
                <td>${methodBadge}</td>
                <td class="cell"><span>${createdDate}</span><span class="note">${createdTime}</span></td>
                <td class="cell"><span class="badge badge-pill bg-danger">Not Approved</span></td>
                <td class="cell"><a class="btn-sm app-btn-secondary" href="${invoiceUrl}">View Receipt</a></td>
            </tr>
        `;
    }

    function escapeHtml(unsafe) {
        return ('' + unsafe)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

})(jQuery);
</script>

@endsection
