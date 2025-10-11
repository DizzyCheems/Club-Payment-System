@extends('layouts.main')
@section('content')

<!--Start-Body-->
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            {{-- Student Details Card --}}
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <h1 class="app-page-title">View Student Details</h1>
                </div>
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">

                        {{-- Success Message --}}
                        @if(Session::has('success'))
                            <div class="alert alert-success text-center">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        <div class="row g-3">
                            {{-- Student Name --}}
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">Student Name</label>
                                <div class="p-2 rounded" style="background:#fafafa; border:1px solid #e9ecef;">
                                    {{ $students->name ?? 'N/A' }}
                                </div>
                            </div>

                            {{-- Student ID Number --}}
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">ID Number</label>
                                <div class="p-2 rounded" style="background:#fafafa; border:1px solid #e9ecef;">
                                    {{ $students->id_num ?? 'N/A' }}
                                </div>
                            </div>

                            {{-- Facebook Account --}}
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">Facebook Account</label>
                                <div class="p-2 rounded" style="background:#fafafa; border:1px solid #e9ecef;">
                                    {{ $students->social_acc ?? 'N/A' }}
                                </div>
                            </div>

                            {{-- GCash Account --}}
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">Gcash / Payment Account</label>
                                <div class="p-2 rounded" style="background:#fafafa; border:1px solid #e9ecef;">
                                    {{ $students->payment_acc ?? 'N/A' }}
                                </div>
                            </div>

                            {{-- Course --}}
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">Course</label>
                                <div class="p-2 rounded" style="background:#fafafa; border:1px solid #e9ecef;">
                                    @if($students->courses && $students->courses->color)
                                        <span class="badge badge-pill" style="background-color: {{ $students->courses->color }}; color: #fff;">
                                            {{ $students->courses->course_name }} {{ $students->courses->year_level }}
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-blis">
                                            {{ $students->courses->course_name ?? 'N/A' }} {{ $students->courses->year_level ?? '' }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Created / Updated Dates --}}
                            @if(isset($students->created_at))
                                <div class="col-12 col-md-3">
                                    <label class="form-label fw-bold">Created</label>
                                    <div class="p-2 rounded" style="background:#fafafa; border:1px solid #e9ecef;">
                                        {{ $students->created_at->format('j M Y, g:i A') }}
                                    </div>
                                </div>
                            @endif
                            @if(isset($students->updated_at))
                                <div class="col-12 col-md-3">
                                    <label class="form-label fw-bold">Last Updated</label>
                                    <div class="p-2 rounded" style="background:#fafafa; border:1px solid #e9ecef;">
                                        {{ $students->updated_at->format('j M Y, g:i A') }}
                                    </div>
                                </div>
                            @endif
                        </div><!--//row-->

                        <div class="mt-4">
                            <a href="{{ route('student.index') }}" class="btn app-btn-secondary">Back</a>
                            <a href="{{ route('student.edit', $students->id) }}" class="btn app-btn-primary">Edit Student</a>
                        </div>

                    </div><!--//app-card-body-->
                </div><!--//inner-->
            </div><!--//app-card-->

            {{-- Payments Section --}}
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert" style="bottom:50px;">
                <div class="inner">
                    <h1 class="app-page-title">Payments of {{ $students->name }}</h1>
                </div>
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">

                        {{-- Search and Filters --}}
                        <div class="col-auto">
                            <div class="page-utilities">
                                <div class="row align-items-center mb-4">
                                    <div class="col-md-auto">
                                        <div class="input-group">
                                            <input type="text" style="width:400px;" id="myInput" onkeyup="myFunction()" class="form-control search-orders" placeholder="Search payments...">
                                            <div class="input-group-append">
                                                <button class="btn app-btn-secondary" type="button">Search</button>
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
                                        <a class="btn app-btn-secondary" href="#">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                                <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                            </svg>
                                            Download CSV
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Payments Table --}}
                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                            <div class="app-card-body">
                                <div class="table-responsive">
                                    <table class="table app-table-hover mb-0 text-left table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Agenda</th>
                                                <th>Amount</th>
                                                <th>Type</th>
                                                <th>Method</th>
                                                <th>Date Paid</th>
                                            </tr>
                                        </thead>
                                        <tbody id="userTable">
                                            @forelse($payments as $payment)
                                                <tr>
                                                    <td>{{ $payment->agendas->agenda_name ?? 'N/A' }}</td>
                                                    <td>₱{{ number_format($payment->amount, 2) }}</td>
                                                    <td>
                                                        @if($payment->type == 'ONLINE')
                                                            <span class="badge badge-pill badge-online">ONLINE</span>
                                                        @else
                                                            <span class="badge badge-pill badge-full">CASH</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($payment->method == 'PARTIAL')
                                                            <span class="badge badge-pill badge-partial">PARTIAL</span>
                                                        @else
                                                            <span class="badge badge-pill badge-full">FULL</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span>{{ date('j M', strtotime($payment->created_at)) }}</span>
                                                        <span class="note">{{ date('g:i A', strtotime($payment->created_at)) }}</span>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="5" class="text-center">No payments found.</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div><!--//app-card-body-->
                </div><!--//inner-->
            </div><!--//app-card-->

        </div><!--//container-xl-->
    </div><!--//app-content-->
</div><!--//app-wrapper-->

<script>
    // Function to filter rows based on the selected filter
    function filterRows(filter) {
        const rows = document.querySelectorAll('tr[data-method]');
        rows.forEach((row) => {
            const method = row.getAttribute('data-method');
            if (filter === 'all' || method === filter || filter === 'partial' || method === filter || filter === 'full' || method === filter) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Event listener for the filter select
    const filterSelect = document.getElementById('filter-select');
    filterSelect.addEventListener('change', (event) => {
        filterRows(event.target.value);
    });

    function myFunction() {
  var input, filter, table, tr, td, i, j, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("userTable");
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    var found = false;
    for (j = 0; j < tr[i].cells.length - 1; j++) {
      td = tr[i].getElementsByTagName("td")[j];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          found = true;
          break;
        }
      }
    }

    if (found) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}
</script>


<script>
    const elementsSelect = document.getElementById('elements-select');
    const table = document.getElementById('userTable'); // Replace 'userTable' with the actual table ID

    elementsSelect.addEventListener('change', function () {
        const selectedValue = elementsSelect.value;
        const rows = table.querySelectorAll('tbody tr');

        // Show or hide rows based on the selected value
        rows.forEach((row, index) => {
            if (index < selectedValue) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

<!-- BEGIN: Page JS-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"></script>
<!-- END: Page JS-->

<script>    
    // delete Branch ajax request
    $(document).on('click', '.app-btn-secondary-delete', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to undo this.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{route('payment.destroy')}}',
                    method: 'get',
                    data: {
                        id: id,
                        _token: csrf
                    },
                    success: function(response) {
                        console.log(response);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        location.replace('{{route('payment.index')}}');
                    }
                });
            }
        })
    });
</script>



<!-- Javascript -->          
<script src="assets/plugins/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

<!-- Charts JS -->
<script src="assets/plugins/chart.js/chart.min.js"></script> 
<script src="assets/js/index-charts.js"></script> 

<!-- Page Specific JS -->
<script src="assets/js/app.js"></script> 

@endsection
</html>

