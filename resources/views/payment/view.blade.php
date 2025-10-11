@extends('layouts.main')
@section('content')

<!--Start-Body-->
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            {{-- Payment Details Card (display-only) --}}
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <h1 class="app-page-title">View Payment Details</h1>
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
                            {{-- Agenda --}}
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">Agenda</label>
                                <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                    {{ $payments->agendas->agenda_name ?? 'N/A' }}
                                </div>
                            </div>

                            {{-- Student --}}
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">Student</label>
                                <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                    {{ $payments->students->name ?? 'N/A' }}
                                </div>
                            </div>

                            {{-- Amount --}}
                            <div class="col-12 col-md-3">
                                <label class="form-label fw-bold">Amount</label>
                                <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                    ₱{{ number_format($payments->amount, 2) }}
                                </div>
                            </div>

                            {{-- Payment Type --}}
                            <div class="col-12 col-md-3">
                                <label class="form-label fw-bold">Payment Type</label>
                                <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                    @if(Str::upper($payments->type ?? '') === 'ONLINE' || Str::contains(Str::lower($payments->type ?? ''), 'online'))
                                        <span class="badge badge-pill" style="background-color:#3085d6; color:#fff;">Online</span>
                                    @else
                                        <span class="badge badge-pill" style="background-color:#6c757d; color:#fff;">Cash</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Payment Method --}}
                            <div class="col-12 col-md-3">
                                <label class="form-label fw-bold">Payment Method</label>
                                <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                    @if(Str::upper($payments->method ?? '') === 'PARTIAL')
                                        <span class="badge badge-pill" style="background-color:#f0ad4e; color:#fff;">Partial</span>
                                    @else
                                        <span class="badge badge-pill" style="background-color:#28a745; color:#fff;">Full</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Date Issued --}}
                            @if(isset($payments->created_at))
                                <div class="col-12 col-md-3">
                                    <label class="form-label fw-bold">Date Issued</label>
                                    <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                        <span>{{ $payments->created_at->format('j M Y') }}</span>
                                        <span class="note"> &middot; {{ $payments->created_at->format('g:i A') }}</span>
                                    </div>
                                </div>
                            @endif
                        </div><!--//row-->

                        {{-- Action buttons --}}
                        <div class="mt-4">
                            <a href="{{ route('payment.index') }}" class="btn app-btn-secondary">Back</a>

                            {{-- Edit Payment button --}}
                            @if(Route::has('payment.edit'))
                                <a href="{{ route('payment.edit', ['id' => $payments->id]) }}" class="btn app-btn-primary">
                                    Edit Payment
                                </a>
                            @endif
                        </div>

                    </div><!--//app-card-body-->
                </div><!--//inner-->
            </div><!--//app-card-->

            {{-- Invoices / Related Records --}}
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert" style="bottom:50px;">
                <div class="inner">
                    <h1 class="app-page-title">Invoices</h1>
                </div>

                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">

                        <div class="col-auto">
                            <div class="page-utilities">
                                <div class="row align-items-center mb-4">
                                    <div class="col-md-auto">
                                        <div class="form-group mb-0">
                                            <div class="input-group">
                                                <input type="text" style="width:400px;" id="myInput" name="searchorders" onkeyup="myFunction()" class="form-control search-orders" placeholder="Search">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn app-btn-secondary">Search</button>
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
                                        {{-- reserved for future actions --}}
                                    </div>
                                </div><!--//row-->
                            </div><!--//table-utilities-->
                        </div><!--//col-auto-->

                        <div class="tab-content" id="orders-table-tab-content">
                            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body">
                                        <div class="table-responsive">
                                            <table class="table app-table-hover mb-0 text-left table table-striped table-bordered" id="userTable">
                                                <thead>
                                                    <tr>
                                                        <th class="cell">Description</th>
                                                        <th class="cell">Amount</th>
                                                        <th class="cell">Date Issued</th>
                                                        <th class="cell">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="cell">{{ $payments->agendas->agenda_name ?? 'N/A' }}</td>
                                                        <td class="cell">₱{{ number_format($payments->amount, 2) }}</td>
                                                        <td class="cell">
                                                            <span>{{ $payments->created_at->format('j M') }}</span>
                                                            <span class="note">{{ $payments->created_at->format('g:i A') }}</span>
                                                        </td>
                                                        <td class="cell">
                                                            @if(Route::has('payment.invoice'))
                                                                <a class="btn-sm app-btn-secondary" href="{{ route('payment.invoice', ['id' => $payments->id]) }}">View Receipt</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div><!--//table-responsive-->
                                    </div><!--//app-card-body-->
                                </div><!--//app-card-->
                            </div><!--//tab-pane-->
                        </div><!--//tab-content-->
                    </div><!--//app-card-body-->
                </div><!--//inner-->
            </div><!--//app-card-->

        </div><!--//container-xl-->
    </div><!--//app-content-->
</div><!--//app-wrapper-->

{{-- JS: search & page-size handlers --}}
<script>
    function myFunction() {
        var input = document.getElementById("myInput");
        if (!input) return;
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
                        found = true;
                        break;
                    }
                }
            }
            tr[i].style.display = found ? "" : "none";
        }
    }

    const elementsSelect = document.getElementById('elements-select');
    if (elementsSelect) {
        const table = document.getElementById('userTable');
        elementsSelect.addEventListener('change', function () {
            const selectedValue = parseInt(elementsSelect.value, 10);
            const rows = (table) ? table.querySelectorAll('tbody tr') : [];
            rows.forEach((row, index) => {
                row.style.display = index < selectedValue ? '' : 'none';
            });
        });
    }
</script>

<!-- BEGIN: Page JS-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="{{ asset('app-assets/js/scripts/tables/datatables/datatable-basic.js') }}"></script>
<!-- END: Page JS-->

@endsection
