@extends('layouts.user_main')
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
                                        </tr>
                                    </thead>
                                    <tbody id="userTable">
                                        @if($payments->isEmpty())
                                            <tr>
                                                <td colspan="7" class="text-center">NO DATA</td>
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
                        <form action="{{ route('payment.post') }}" method="POST">
                            @csrf

                            {{-- Agenda --}}
                            <div class="form-group px-5">
                                <h5>Agenda</h5>
                                <select name="agenda_id" id="agenda_id" class="form-control mb-1">
                                    <option value="" selected disabled>Select Agenda</option>
                                    @foreach($agendas as $agenda)
                                        <option value="{{ $agenda->id }}" data-indiv-contrib="{{ $agenda->indiv_contrib }}">{{ $agenda->agenda_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Student ID --}}
                            <div class="form-group px-5">
                                <h5>Student ID</h5>
                                <input id="student_id" type="number" name="student_id" class="form-control mb-1" value="{{ Auth::user()->id }}" readonly>
                            </div>

                            {{-- Payment / Amount Required --}}
                            <div class="form-group row px-5">
                                <div class="col-md-6">
                                    <h5>Payment</h5>
                                    <input id="paymentInput" type="number" name="amount" class="form-control mb-1" placeholder="0.00" required>
                                </div>
                                <div class="col-md-6">
                                    <h5>Amount Required</h5>
                                    <input id="amountRequired" type="number" class="form-control mb-1" readonly>
                                </div>
                            </div>

                            {{-- Payment Type --}}
                            <div class="form-group px-5">
                                <h5>Payment Type</h5>
                                <select name="type" class="form-control mb-1">
                                    <option value="Online">Online Payment</option>
                                    <option value="Cash">Cash</option>
                                </select>
                            </div>

                            {{-- Payment Method --}}
                            <div class="form-group px-5">
                                <h5>Payment Method</h5>
                                <select name="method" id="paymentMethod" class="form-control mb-1">
                                    <option value="Full">Full Payment</option>
                                    <option value="Partial">Partial Payment</option>
                                </select>
                            </div>

                <div class="modal-footer" style= "margin-top:35px;">
                    <button type="button" class="btn btn-warning mr-1" data-dismiss="modal">
                        <i class="ft-x"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-check-square-o"></i> Save
                    </button>
                </div>
            </form>
        </div>
        <!--//modal-content-->
    </div>
    <!--//modal-dialog-->
</div>
<!--//modal-->


<table style="display:none">
    <thead>
        <tr>
            <th>Agenda</th>
            <th>Indiv Contrib</th>
        </tr>
    </thead>
    <tbody id="agendaInfo">
        <tr>
            <td id="agendaNameCell"></td>
            <td id="indivContribCell"></td>
        </tr>
    </tbody>
</table>

<div id="studentsData" data-students="{{ $studentsJson }}" style="display: none;"></div>

<table style="display:none">
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody id="studentsTableBody">
        <!-- Table body will be populated dynamically -->
    </tbody>
</table>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const addModal = document.getElementById('add');

    // Reset modal when opened
    addModal.addEventListener('show.bs.modal', function () {
        $('#agenda_id').val('');
        $('#student_id').val('');
        $('#course_id').val('');
        $('#paymentInput').val('0.00');
        $('#paymentMethod').val('Full');
        $('#amountRequired').val('');
        $('#amountRequired').data('original', 0);
    });

    // Auto-fill course when student selected
    $('#student_id').on('change', function () {
        const courseName = $(this).find(':selected').data('course') || '';
        $('#course_id').val(courseName);
    });

    // Update amount required when agenda changes
    $('#agenda_id').on('change', function () {
        const indivContrib = parseFloat($(this).find(':selected').data('indiv-contrib')) || 0;
        $('#amountRequired').data('original', indivContrib);

        if ($('#paymentMethod').val() === 'Partial') {
            $('#amountRequired').val((indivContrib * 0.5).toFixed(2));
        } else {
            $('#amountRequired').val(indivContrib.toFixed(2));
        }

        $('#paymentInput').val('0.00');
    });

    // Payment method change
    $('#paymentMethod').on('change', function () {
        const original = parseFloat($('#amountRequired').data('original')) || 0;
        if ($(this).val() === 'Partial') {
            $('#amountRequired').val((original * 0.5).toFixed(2));
        } else {
            $('#amountRequired').val(original.toFixed(2));
        }
        $('#paymentInput').val('0.00');
    });

    // Payment input cannot exceed amount required
    $('#paymentInput').on('input', function () {
        const payment = parseFloat($(this).val()) || 0;
        const required = parseFloat($('#amountRequired').val()) || 0;
        if (payment > required) $(this).val(required.toFixed(2));
    });

});
</script>


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


<script>
    var originalAmount = parseFloat($('#amountRequired').val());

$('#paymentMethod').on('change', function() {
    var amountRequired = parseFloat($('#amountRequired').val());
    var paymentMethod = $(this).val();
    var paymentValue = parseFloat($('#paymentInput').val());

    if (paymentMethod === 'Partial') {
        var partialAmount = (amountRequired * 0.5).toFixed(2);
        $('#amountRequired').val(partialAmount);

        // Set Payment field to 0.00 when switching to Partial Payment
        $('#paymentInput').val('0.00');
    } else {
        $('#amountRequired').val(originalAmount.toFixed(2));
    }
});
</script>

@if(session('sweetAlert'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Payment Registered.',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        });
    </script>
@endif

<script>
    $('#paymentInput').on('input', function() {
        var paymentAmount = parseFloat($(this).val());
        var amountRequired = parseFloat($('#amountRequired').val());

        if (paymentAmount > amountRequired) {
            $(this).val(amountRequired); 
        }
    });
</script>


<script>
    $('#agenda_id').on('change', function() {
        var selectedOption = $(this).find(':selected');
        var agendaName = selectedOption.text();
        var indivContrib = selectedOption.data('indiv-contrib');
        
        $('#agendaNameCell').text(agendaName);
        $('#indivContribCell').text(indivContrib);
        $('#amountRequired').val(indivContrib);
    });
</script>

<script>
    const agendaSelect = document.getElementById('agenda_id');
    const amountInput = document.getElementById('amountRequired');

    agendaSelect.addEventListener('change', function() {
        const selectedOption = agendaSelect.options[agendaSelect.selectedIndex];
        
        const indivContrib = selectedOption.getAttribute('data-indiv-contrib');

        amountInput.value = indivContrib;
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const studentsDataDiv = document.getElementById('studentsData');
        const students = JSON.parse(studentsDataDiv.dataset.students);
        const studentsTableBody = document.getElementById('studentsTableBody');
        const studentIdInput = document.getElementById('student_id');

        // Loop through the fetched data and populate the table body
        students.forEach(student => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${student.id}</td>
                <td>${student.name}</td>
            `;
            row.addEventListener('click', function() {
                // Get the value of the "Student ID" column when a row is clicked
                const studentId = this.querySelector('td:first-child').textContent;
                // Set the value of the "Student" form field
                studentIdInput.value = studentId;
            });
            studentsTableBody.appendChild(row);
        });

        // Set the value of the "Student" form field to the first row's student ID initially
        if (students.length > 0) {
            studentIdInput.value = students[0].id;
        }
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
