@extends('layouts.main')
@section('content')

<style>
    body{margin-top:20px;background:#87CEFA;}
    .card-footer-btn {
        display: flex;
        align-items: center;
        border-top-left-radius: 0!important;
        border-top-right-radius: 0!important;
    }
    .text-uppercase-bold-sm {
        text-transform: uppercase!important;
        font-weight: 500!important;
        letter-spacing: 2px!important;
        font-size: .85rem!important;
    }
    .hover-lift-light {
        transition: box-shadow .25s ease,transform .25s ease,color .25s ease,background-color .15s ease-in;
    }
    .justify-content-center { justify-content: center!important; }
    .btn-group-lg>.btn, .btn-lg { padding: 0.8rem 1.85rem; font-size: 1.1rem; border-radius: 0.3rem; }
    .btn-dark { color: #fff; background-color: #1e2e50; border-color: #1e2e50; }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(30,46,80,.09);
        border-radius: 0.25rem;
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }

    .p-5 { padding: 3rem!important; }
    .card-body { flex: 1 1 auto; padding: 1.5rem 1.5rem; }

    tbody, td, tfoot, th, thead, tr { border-color: inherit; border-style: solid; border-width: 0; }

    .table td, .table th { border-bottom: 0; border-top: 1px solid #edf2f9; }
    .table>:not(caption)>*>* { padding: 1rem 1rem; background-color: var(--bs-table-bg); border-bottom-width: 1px; box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg); }
    .px-0 { padding-right: 0!important; padding-left: 0!important; }
    .table thead th, tbody td, tbody th { vertical-align: middle; }

    .mt-5 { margin-top: 3rem!important; }
    .svg-icon>svg { width: 1.45rem; height: 1.45rem; }

    /* Print styles: show only the invoice container */
    @media print {
        /* hide everything first */
        body * { visibility: hidden !important; }
        /* then make invoice visible */
        #invoice-to-print, #invoice-to-print * { visibility: visible !important; }
        #invoice-to-print { position: absolute; left: 0; top: 0; width: 100%; }
        /* hide print button if still visible */
        .no-print { display: none !important; }
        #invoice-to-print {
            padding-top: 0 !important; 
            margin-top: 3rem !important;
        }
    }

    @media print {
    /* Avoid page breaks that cause blank second pages */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden;
    }

    #invoice-to-print {
        page-break-after: avoid;
        page-break-before: avoid;
        page-break-inside: avoid;
        width: 100%;
    }

    /* Prevent auto page-breaks */
    * {
        page-break-inside: avoid !important;
    }

    .btn.disabled, .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
}

</style>

<div class="container mt-6 mb-7">
    <div class="row justify-content-center">
      <div class="col-lg-12 col-xl-7">
            {{-- Header / action row --}}
            <div class="card-body p-3 d-flex align-items-start justify-content-between" style="gap:1rem;">
                <div>
                    <h2 class="mb-0">Receipt Details</h2>
                    <p class="fs-sm mb-0">
                        Payment made by <strong>{{ $students->name }}</strong> amounting to <strong>₱{{ $payments['amount'] }}</strong>.
                    </p>
                </div>
                <div class="d-flex align-items-start" style="gap:.5rem;">
                    {{-- Back button --}}
                    <a href="{{ route('payment.view', ['id' => $payments->id]) }}" class="btn app-btn-secondary no-print">Back</a>

                    {{-- Print button --}}
                    @if($payments->approved == 1)
                        <!-- Approved: normal print button -->
                        <button type="button" class="btn btn-primary no-print" onclick="printInvoice()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer me-1" viewBox="0 0 16 16">
                                <path d="M2 7a1 1 0 0 0-1 1v3h2V8h10v3h2V8a1 1 0 0 0-1-1H2z"/>
                                <path fill-rule="evenodd" d="M11 2H5a1 1 0 0 0-1 1v2h8V3a1 1 0 0 0-1-1zM5 1a2 2 0 0 0-2 2v2h10V3a2 2 0 0 0-2-2H5z"/>
                            </svg>
                            Print
                        </button>
                    @else
                        <!-- Not approved: disabled button -->
                        <button type="button" class="btn btn-secondary no-print disabled" disabled title="Receipt not approved yet">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer me-1" viewBox="0 0 16 16">
                                <path d="M2 7a1 1 0 0 0-1 1v3h2V8h10v3h2V8a1 1 0 0 0-1-1H2z"/>
                                <path fill-rule="evenodd" d="M11 2H5a1 1 0 0 0-1 1v2h8V3a1 1 0 0 0-1-1zM5 1a2 2 0 0 0-2 2v2h10V3a2 2 0 0 0-2-2H5z"/>
                            </svg>
                            Print
                        </button>
                    @endif
                </div>
            </div>
        <div class="card">

          {{-- Printable invoice container --}}
          <div id="invoice-to-print" class="card-body p-5">
            <div class="text-center mb-4">
                <h2>Payment Receipt</h2>
                <h4>{{ $students->name }}</h4>
            </div>

          <div id="invoice-to-print" class="card-body p-5">
            <div class="border-top border-gray-200 pt-4 mt-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="text-muted mb-2">Payment No.</div>
                  @foreach($pays as $pay)
                        <strong>#{{ $pay->ref_num }}</strong>
                  @endforeach
                </div>

                <div class="col-md-6 text-md-end">
                    <div class="text-muted mb-2">Payment Date</div>
                    <strong>{{ $payments->created_at->format('d/m/y g:i A') }}</strong>
                </div>
              </div>
            </div>

            <div class="border-top border-gray-200 mt-4 py-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="text-muted mb-2">Agenda</div>
                  <strong>{{ $agendas->agenda_name }}</strong>
                  <p class="fs-sm"><br><a href="#!" class="text-purple">john@email.com</a></p>
                </div>
                <div class="col-md-6 text-md-end">
                  <div class="text-muted mb-2">Payment To</div>
                  <strong>CSD Club</strong>
                  <p class="fs-sm">Notre Dame Of Marbel University<br><a href="#!" class="text-purple">CSD@email.com</a></p>
                </div>
              </div>
            </div>

            <table class="table border-bottom border-gray-200 mt-3">
              <thead>
                  <tr>
                      <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm px-0">Description</th>
                      <th scope="col" class="fs-sm text-dark text-uppercase-bold-sm text-end px-0">Amount</th>
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td class="px-0">{{ $payments->agendas->agenda_name }}</td>
                      <td class="text-end px-0">₱{{ $payments->amount }}</td>
                  </tr>
              </tbody>
            </table>

            <div class="mt-5">
                <div class="d-flex justify-content-end">
                    <p class="text-muted me-3">Subtotal:</p>
                    <span>₱ {{ $subtotal }}</span>
                </div>
                <div class="d-flex justify-content-end">
                    <p class="text-muted me-3">Discount:</p>
                    <span>-₱ 0</span>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <h5 class="me-3">Total:</h5>
                    <h5 class="text-success">₱ {{ $total }}</h5>
                </div>
            </div>

            <div class="mt-4">
                @if($payments->approved == 0)
                    <a href="#!" class="btn btn-dark btn-lg card-footer-btn justify-content-center text-uppercase-bold-sm hover-lift-light no-print">
                        <span class="svg-icon text-white me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 512 512"><path d="M336,208V113a80,80,0,0,0-160,0v95" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><rect x="96" y="208" width="320" height="272" rx="48" ry="48" style="fill:none;stroke:#000;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></rect></svg>
                        </span>
                        Pending Approval
                    </a>
                @elseif($payments->approved == 1)
                    <a href="#!" class="btn btn-success btn-lg card-footer-btn justify-content-center text-uppercase-bold-sm hover-lift-light no-print">
                        <span class="svg-icon text-white me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0z"/></svg>
                        </span>
                        Approved
                    </a>
                @endif
            </div>

          </div><!--//invoice-to-print-->

        </div>
      </div>
    </div>
  </div>

<!-- Print script -->
<script>
    function printInvoice() {
        // Use window.print() with the print CSS defined above so only #invoice-to-print prints.
        window.print();
    }
</script>

 <!-- BEGIN: Page JS-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
 <script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"></script>
<!-- END: Page JS-->

@endsection
</html>
