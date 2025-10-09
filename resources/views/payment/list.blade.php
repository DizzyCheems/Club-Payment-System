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
                                 <a class="btn app-btn-secondary" href="#" data-toggle="modal" data-target="#add">  
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
                                                            @else ($payment->type == 'CASH') 
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
                                                                <a class="btn-sm app-btn-secondary" href="{{route('payment.edit', array('id' => $payment->id))}}">Edit</a>
                                                                <a class="btn-sm app-btn-secondary" href="{{route('payment.view', array('id' => $payment->id))}}">View</a>
                                                                <a id="{{$payment ['id']}}" class="btn-sm app-btn-secondary app-btn-secondary-delete" >Delete Payment Info</a>
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
                                            <tr data-method="{{ $payment->method }}">     
                                               @if($payment->method  == 'FULL')   
                                                        <td>{{ $payment->agendas->agenda_name }}</td>
                                                        <td>{{ $payment->students->name }}</td>
                                                        <td>{{ $payment->amount }}</td>
                                                        <td>
                                                            @if($payment->type  == 'ONLINE')   
                                                                <span class="badge badge-pill badge-online">ONLINE</span>
                                                            @else ($payment->type == 'CASH') 
                                                                <span class="badge badge-pill badge-full">CASH</span>
                                                        </td>
                                                        @endif
                                                        <td><span class="badge badge-pill badge-full">{{ $payment->method }}</span></td>
                            
                                                        <td class="cell">
                                                            <span>{{ date('j M', strtotime($payment->created_at)) }}</span>
                                                            <span class="note">{{ date('g:i A', strtotime($payment->created_at)) }}</span>
                                                        </td>


                                <td>              
                                    <a class="btn-sm app-btn-secondary" href="{{route('payment.edit', array('id' => $payment->id))}}">Edit</a>
                                    <a class="btn-sm app-btn-secondary" href="{{route('payment.view', array('id' => $payment->id))}}">View</a>
                                    <a id="{{$payment ['id']}}" class="btn-sm app-btn-secondary app-btn-secondary-delete" >Delete Payment Info</a>
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
                            <table class="table app-table-hover mb-0 text-left table table-striped table-bordered" id="userTable">
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
                                    <tr data-method="{{ $payment->method }}">     
                                            @if($payment->method  == 'PARTIAL')   
                                                        <td>{{ $payment->agendas->agenda_name }}</td>
                                                        <td>{{ $payment->students->name }}</td>
                                                        <td>{{ $payment->amount }}</td>
                                                        <td>
                                                            @if($payment->type  == 'ONLINE')   
                                                                <span class="badge badge-pill badge-online">ONLINE</span>
                                                            @else ($payment->type == 'CASH') 
                                                                <span class="badge badge-pill badge-full">CASH</span>
                                                        </td>
                                                        @endif
                                                        <td><span class="badge badge-pill badge-partial">{{ $payment->method }}</span></td>
                                     
                                                        <td class="cell">
                                                            <span>{{ date('j M', strtotime($payment->created_at)) }}</span>
                                                            <span class="note">{{ date('g:i A', strtotime($payment->created_at)) }}</span>
                                                        </td>


                                        <td>
                                             <a class="btn-sm app-btn-secondary" href="{{route('payment.edit', array('id' => $payment->id))}}">Edit</a>
                                             <a class="btn-sm app-btn-secondary" href="{{route('payment.view', array('id' => $payment->id))}}">View</a>
                                             <a id="{{$payment ['id']}}" class="btn-sm app-btn-secondary app-btn-secondary-delete" >Delete Payment Info</a>
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
                <button class="btn app-btn-secondary"   id="approvePaymentsButton">
                                    Approve Selected
                </button>      

            </div>
            
        </div>
    </div>
    
</div>

<!-- Modal Register Payment -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalTitle">Register Payment</h5>
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
                <div class="form-group px-5">
                    <h5>Agenda <span class="required"></span></h5>
                    <div class="controls">
                        <select name="agenda_id" id="agenda_id" class="form-control mb-1">
                            <option value="" selected disabled>Select Agenda</option> <!-- Added empty option -->
                            @foreach($agendas as $agenda)
                                <option value="{{ $agenda->id }}" data-indiv-contrib="{{ $agenda->indiv_contrib }}">{{ $agenda->agenda_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group px-5">
                    <h5>Course <span class="required"></span></h5>
                    <div class="controls">
                        <select name="course_id" id="course_id" class="form-control mb-1">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                                
                <div class="form-group px-5">
                    <h5>Student <span class="required"></span></h5>
                    <div class="controls">
                        <select name="student_id" id="student_id" class="form-control mb-1">
                            <option value="" disabled selected>-- Select Student --</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" data-course="{{ $student->course_id }}">
                                    {{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row px-5">
                    <div class="col-md-6">
                        <h5>Payment <span class="required"></span></h5>
                        <div class="controls">
                            <input id="paymentInput" type="number" name="amount" class="form-control mb-1" placeholder="0.00" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5>Amount Required <span class="required"></span></h5>
                        <div class="controls">
                            <input id="amountRequired" type="number" name="amount2" class="form-control mb-1" required readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group px-5">
                    <h5>Payment Type <span class="required"></span></h5>
                    <div class="controls">
                        <select name="type" id="lang" class="form-control mb-1">
                            <option value="Online">Online Payment</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>
                </div>

                <div class="form-group px-5">
                    <h5>Payment Method <span class="required"></span></h5>
                    <div class="controls">
                        <select name="method" id="paymentMethod" class="form-control mb-1">
                            <option value="Full">Full Payment</option>
                            <option value="Partial">Partial Payment</option>
                        </select>
                    </div>
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




<!-- Modal Register Payment -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalTitle">Approve Payments</h5>
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



<script>
$(document).ready(function() {

    // When the student is selected
    $('#student_id').on('change', function() {
        // Get the selected student's course ID from data attribute
        var courseId = $(this).find(':selected').data('course');

        // Set the course select field to the selected student's course
        if(courseId) {
            $('#course_id').val(courseId);
        } else {
            // If no course, reset the select
            $('#course_id').val('');
        }
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
                    url: '{{route('payment/destroy')}}',
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
    // Get references to the select element and the amount input field
    const agendaSelect = document.getElementById('agenda_id');
    const amountInput = document.getElementById('amountRequired');

    // Add event listener to the select element
    agendaSelect.addEventListener('change', function() {
        // Get the selected option
        const selectedOption = agendaSelect.options[agendaSelect.selectedIndex];
        
        // Get the indiv_contrib value from the selected option's data attribute
        const indivContrib = selectedOption.getAttribute('data-indiv-contrib');

        // Set the value of the amount input field to the indiv_contrib value
        amountInput.value = indivContrib;
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const approvePaymentsButton = document.getElementById('approvePaymentsButton');

        approvePaymentsButton.addEventListener('click', function() {
            Swal.fire({
                title: 'Are you sure you want to approve payment?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');
                    const paymentIds = Array.from(checkedCheckboxes).map(checkbox => checkbox.dataset.paymentId);

                    // Send an AJAX request
                    fetch('/update-payments', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Add CSRF token
                        },
                        body: JSON.stringify({ paymentIds: paymentIds })
                    })
                    .then(response => {
                        if (response.ok) {
                            // Show success message
                            Swal.fire(
                                'Approved!',
                                'The payments have been approved.',
                                'success'
                            ).then(() => {
                                // Reload the page or update UI as needed
                                location.reload(); // For example, reload the page
                            });
                        } else {
                            throw new Error('Failed to update payments');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire(
                            'Error!',
                            'There was an error approving the payments.',
                            'error'
                        );
                    });
                }
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const updateButton = document.getElementById('update');
        const updateModal = document.getElementById('updateModal');

        updateButton.addEventListener('click', function() {
            // Show the modal
            updateModal.style.display = 'block';
        });
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
