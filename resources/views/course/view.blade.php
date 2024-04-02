@extends('layouts.main')
@section('content')

    <!--Start-Body-->
    <div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <h1 class="app-page-title">View Course Details</h1>
                </div>
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">

                        <form class="form" action="#" method="POST" novalidate>
                        @csrf
                        <input type="hidden" name="id" value="{{$courses['id']}}">
                    <div>

	                   @if(Session::has('success'))
                             <div class="alert alert-success">
                                {{Session::get('success')}} 
                             </div>
                      @endif
                   </div>
                        <div class="form-body">
                            <div class="form-group">
                             <h5>Course Name<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="text" name="course_name" class="form-control mb-1" value="{{$courses['course_name']}}" readonly>
                                </div>
                         </div>
                         
                         <div class="form-group">
                             <h5>Year Level<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="number" name="year_level" class="form-control mb-1" value="{{$courses['year_level']}}" readonly>

                                </div>
                         </div>

                         <div class="form-group">
                             <h5>Section<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="text" name="section" class="form-control mb-1" value="{{$courses['section']}}" readonly>

                                </div>
                         </div>

                        <div class="form-actions center">
                            <a class="btn btn-warning mr-1" href="{{route('course.index')}}">
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


    <div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert" style="bottom:50px;">
                <div class="inner">
                    <h1 class="app-page-title">Students of {{$courses['course_name']}}</h1>
                </div>
                <div class="inner">
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
                                    <th class="cell">Name</th>
                                    <th class="cell">Course</th>
                                    <th class="cell">School ID Number</th>
                                    <th class="cell">Facebook Account</th>
                                    <th class="cell">G cash/Contact Number</th>
                   
                                </tr>
                                    </thead>
                                    <tbody id="userTable">
                                    @foreach($students as $student)                 
                                                <tr>    
                                                        <td>{{ $student->name }}</td>
                                                        <td>
                                                            @if($student->courses->course_name  == 'BSCS')   
                                                                <span class="badge badge-pill badge-bscs">{{$student->courses->course_name}} {{$student->courses->year_level}}</span>
                                                            @elseif ($student->courses->course_name == 'BSIT') 
                                                                <span class="badge badge-pill badge-bsit">{{$student->courses->course_name}} {{$student->courses->year_level}}</span>
                                                            @else 
                                                                <span class="badge badge-pill badge-blis">{{$student->courses->course_name}} {{$student->courses->year_level}}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $student->id_num }}</td>
                                                        <td>{{ $student->social_acc }}</td>
                                                        <td>{{ $student->payment_acc }}</td>
                                                        <td class="cell">
                                                            <a class="btn-sm app-btn-secondary" href="{{route('student.edit', array('id' => $student->id))}}">Edit</a>
                                                            <a class="btn-sm app-btn-secondary" href="{{route('student.view', array('id' => $student->id))}}">View</a>
                                                            <a id="{{$student ['id']}}" class="btn-sm app-btn-secondary app-btn-secondary-delete" >Delete Student Info</a>
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
                                     <th class="cell">Name</th>
                                    <th class="cell">Course</th>
                                    <th class="cell">School ID Number</th>
                                    <th class="cell">Facebook Account</th>
                                    <th class="cell">G cash/Contact Number</th>
                                    
                                </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)                 
                                                <tr>    
                                                        <td>{{ $student->name }}</td>
                                                        <td>
                                                            @if($student->courses->course_name  == 'BSCS')   
                                                                <span class="badge badge-pill badge-bscs">{{$student->courses->course_name}} {{$student->courses->year_level}}</span>
                                                            @elseif ($student->courses->course_name == 'BSIT') 
                                                                <span class="badge badge-pill badge-bsit">{{$student->courses->course_name}} {{$student->courses->year_level}}</span>
                                                            @else 
                                                                <span class="badge badge-pill badge-blis">{{$student->courses->course_name}} {{$student->courses->year_level}}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $student->id_num }}</td>
                                                        <td>{{ $student->social_acc }}</td>
                                                        <td>{{ $student->payment_acc }}</td>
                                                        <td class="cell">
                                                            <a class="btn-sm app-btn-secondary" href="{{route('student.edit', array('id' => $student->id))}}">Edit</a>
                                                            <a class="btn-sm app-btn-secondary" href="{{route('student.view', array('id' => $student->id))}}">View</a>
                                                            <a id="{{$student ['id']}}" class="btn-sm app-btn-secondary app-btn-secondary-delete" >Delete Student Info</a>
                                                        </td>            
                                                    </tr>
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
                                   <th class="cell">Name</th>
                                    <th class="cell">Course</th>
                                    <th class="cell">School ID Number</th>
                                    <th class="cell">Facebook Account</th>
                                    <th class="cell">G cash/Contact Number</th>
                                </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)                 
                                                <tr>    
                                                        <td>{{ $student->name }}</td>
                                                        <td>
                                                            @if($student->courses->course_name  == 'BSCS')   
                                                                <span class="badge badge-pill badge-bscs">{{$student->courses->course_name}} {{$student->courses->year_level}}</span>
                                                            @elseif ($student->courses->course_name == 'BSIT') 
                                                                <span class="badge badge-pill badge-bsit">{{$student->courses->course_name}} {{$student->courses->year_level}}</span>
                                                            @else 
                                                                <span class="badge badge-pill badge-blis">{{$student->courses->course_name}} {{$student->courses->year_level}}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $student->id_num }}</td>
                                                        <td>{{ $student->social_acc }}</td>
                                                        <td>{{ $student->payment_acc }}</td>
                                                        <td class="cell">
                                                            <a class="btn-sm app-btn-secondary" href="{{route('student.edit', array('id' => $student->id))}}">Edit</a>
                                                            <a class="btn-sm app-btn-secondary" href="{{route('student.view', array('id' => $student->id))}}">View</a>
                                                            <a id="{{$student ['id']}}" class="btn-sm app-btn-secondary app-btn-secondary-delete" >Delete Student Info</a>
                                                        </td>            
                                                    </tr>
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


@endsection
</html> 





