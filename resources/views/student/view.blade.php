@extends('layouts.main')
@section('content')

    <!--Start-Body-->
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			
			    
			    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <h1 class="app-page-title">View Student Info</h1>
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">

                        <form class="form" action="#" method="POST" novalidate>
                        @csrf
                        <input type="hidden" name="id" value="{{$students['id']}}">
                    <div>

	                   @if(Session::has('success'))
                             <div class="alert alert-success">
                                {{Session::get('success')}} 
                             </div>
                      @endif
                   </div>
                        <div class="form-body">
                            <div class="form-group">
                             <h5>Student Name<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control mb-1" value="{{$students['name']}}" required data-validation-required-message="• This field is required" readonly>
                                </div>
                         </div>
                         
                         <div class="form-group">
                             <h5>ID Number<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="number" name="year_level" class="form-control mb-1" value="{{$students['id_num']}}" required data-validation-required-message="• This field is required" readonly>

                                </div>
                         </div>

                         <div class="form-group">
                             <h5>FB Account<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="text" name="social_acc" class="form-control mb-1" value="{{$students['social_acc']}}" required data-validation-required-message="• This field is required" readonly>

                                </div>
                         </div>

                         
                         <div class="form-group">
                             <h5>G Cash Account<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="text" name="payment_acc" class="form-control mb-1" value="{{$students['payment_acc']}}" required data-validation-required-message="• This field is required" readonly>

                                </div>
                         </div>

                        <div class="form-actions center">
                            <a class="btn btn-warning mr-1" href="{{route('student.index')}}">
                                <i class="ft-x"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="la la-check-square-o"></i> Save
                            </button>
                        </div>
                    </form>
						    </div><!--//app-card-footer-->
						</div><!--//app-card-->
				    </div><!--//col-->
			    </div><!--//row-->
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    
    </div><!--//app-wrapper-->    	

    

    <!--Start-Body-->
    <div class="app-wrapper" >
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4" >
		    <div class="container-xl">
			    
			 
			    
			    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert" style="bottom:50px;">
				    <div class="inner">
                    <h1 class="app-page-title">Payments of {{$students['name']}}</h1>
					    <div class="app-card-body p-3 p-lg-4">
                 
                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row align-items-center">
                            <div class="col-md-auto">
                                <div class="form-group mb-0">
                                    <div class="input-group">
                                    <input type="text" style="width:400px;" id="myInput" name="searchorders" onkeyup="myFunction()" class="form-control search-orders" placeholder="Search">
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
                                <a class="btn app-btn-secondary" href="#">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                        <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                    </svg>
                                    Download CSV
                                </a>
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->

            <!--Tab Selections --
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
                                                                <span class="badge badge-pill badge-cash">CASH</span>
                                                        </td>
                                                        @endif
                                                        <td><span class="badge badge-pill badge-full">{{ $payment->method }}</span></td>
                            
                                                        <td class="cell">
                                                            <span>{{ date('j M', strtotime($payment->created_at)) }}</span>
                                                            <span class="note">{{ date('g:i A', strtotime($payment->created_at)) }}</span>
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
                                                                <span class="badge badge-pill badge-cash">CASH</span>
                                                        </td>
                                                        @endif
                                                        <td><span class="badge badge-pill badge-partial">{{ $payment->method }}</span></td>
                                     
                                                        <td class="cell">
                                                            <span>{{ date('j M', strtotime($payment->created_at)) }}</span>
                                                            <span class="note">{{ date('g:i A', strtotime($payment->created_at)) }}</span>
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
            </div>
        </div>
    </div>
</div>
</div>
            </div>
        </div>
    </div>
</div>


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

