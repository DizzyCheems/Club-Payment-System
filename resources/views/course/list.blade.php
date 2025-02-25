@extends('layouts.main')
@section('content')


<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
        <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert" >
				<div class="inner">
                    <h1 class="app-page-title">Courses</h1>
					    <div class="app-card-body p-3 p-lg-4">

                <div class="col-auto">
                    <div class="page-utilities">
                        <div class="row align-items-center">
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
                                
                            
                            <a class="btn app-btn-secondary" href="{{route('course.create')}}">
                                    <i width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-add me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                        <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                    </i>
                                    Add Courses
                                </a>

                            
                      
                            </div>
                        </div><!--//row-->
                    </div><!--//table-utilities-->
                </div><!--//col-auto-->
            </div><!--//row-->

            <!--Tab Selections -->
            <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true" onclick="filterRows('all')">All</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-admin-tab" data-bs-toggle="tab" href="#orders-admin" role="tab" aria-controls="orders-admin" aria-selected="false" onclick="filterRows('admin')">BSCS</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-user-tab" data-bs-toggle="tab" href="#orders-user" role="tab" aria-controls="orders-user" aria-selected="false" onclick="filterRows('user')">BLIS</a>
                <a class="flex-sm-fill text-sm-center nav-link" id="orders-other-tab" data-bs-toggle="tab" href="#orders-other" role="tab" aria-controls="orders-other" aria-selected="false" onclick="filterRows('other')">BSIT</a>
            </nav>
            <!--END Tab Selections -->

    <div class="tab-content" id="orders-table-tab-content">
        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class= "cell">Course</th>
                                    <th class= "cell">Year</th>
                                    <th class= "cell">Section</th>
                                    <th class="col-actions cell">Actions</th>    
                                </tr>
                                    </thead>
                                    <tbody id="userTable">
                                    @foreach($courses as $course)                 
                                                    <tr>    
                                                        <td>
                                                            @if($course->course_name == 'BSCS')   
                                                                <span class="badge badge-pill badge-bscs">BSCS</span>
                                                            @elseif ($course->course_name == 'BSIT') 
                                                                <span class="badge badge-pill badge-bsit">BSIT</span>
                                                            @else 
                                                                <span class="badge badge-pill badge-blis">BLIS</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $course->year_level }}</td>
                                                        <td>{{ $course->section }}</td>
                                                        <td>
                                                            <a class="btn-sm app-btn-secondary" href="{{route('course.edit', array('id' => $course->id))}}">Edit</a>
                                                            <a class="btn-sm app-btn-secondary" href="{{route('course.view', array('id' => $course->id))}}">View</a>                                 
                                                            <a id="{{$course ['id']}}" class="btn-sm app-btn-secondary app-btn-secondary-delete" >Delete Course Info</a>        
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
                                            <th class= "cell">Course</th>
                                            <th class= "cell">Year</th>
                                            <th class= "cell">Section</th>
                                            <th class="col-actions cell">Actions</th>   
                                        </tr>
                                    </thead>
                                    <tbody id="userTable">
                                    @foreach($courses as $course)                 
                                                    <tr>    
                                                    @if($course->course_name == 'BSCS')   
                                                        <td>
                                                                <span class="badge badge-pill badge-bscs">{{$course->course_name}}</span>
                                                        </td>
                                                        <td>{{ $course->year_level }}</td>
                                                        <td>{{ $course->section }}</td>
                                                        <td>
                                                            <a class="btn-sm app-btn-secondary" href="{{route('course.edit', array('id' => $course->id))}}">Edit</a>
                                                            <a class="btn-sm app-btn-secondary" href="{{route('course.view', array('id' => $course->id))}}">View</a>
                                                            <a id="{{$course ['id']}}" class="btn-sm app-btn-secondary app-btn-secondary-delete" >Delete Course Info</a>        
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
                                            <th class= "cell">Course</th>
                                            <th class= "cell">Year</th>
                                            <th class= "cell">Section</th>
                                            <th class="col-actions cell">Actions</th>   
                                        </tr>
                                    </thead>
                                    <tbody id="userTable">
                                    @foreach($courses as $course)                 
                                                    <tr>    
                                                      @if($course->course_name == 'BLIS')   
                                                        <td>
                                                                <span class="badge badge-pill badge-blis">{{$course->course_name}}</span>
                                                        </td>
                                                        <td>{{ $course->year_level }}</td>
                                                        <td>{{ $course->section }}</td>
                                                        <td>
                                                            <a class="btn-sm app-btn-secondary" href="{{route('course.edit', array('id' => $course->id))}}">Edit</a>
                                                            <a class="btn-sm app-btn-secondary" href="{{route('course.view', array('id' => $course->id))}}">View</a>
                                                            <a id="{{$course ['id']}}" class="btn-sm app-btn-secondary app-btn-secondary-delete" >Delete Course Info</a>        
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

                <div class="tab-pane fade" id="orders-other" role="tabpanel" aria-labelledby="orders-other-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left table table-striped table-bordered" id="adminTable">
                                    <thead>
                                        <tr>
                                            <th class= "cell">Course</th>
                                            <th class= "cell">Year</th>
                                            <th class= "cell">Section</th>
                                            <th class="col-actions cell">Actions</th>  
                                        </tr>
                                    </thead>
                                    <tbody id="userTable">
                                        @foreach($courses as $course)                 
                                                <tr>    
                                                  @if($course->course_name  == 'BSIT')   
                                                        <td>
                                                            <span class="badge badge-pill badge-bsit">{{$course->course_name}}</span>
                                                        </td>
                                                        <td>{{ $course->year_level }}</td>
                                                        <td>{{ $course->section }}</td>
                                                        <td class="cell">
                                                            <a class="btn-sm app-btn-secondary" href="{{route('course.edit', array('id' => $course->id))}}">Edit</a>
                                                            <a class="btn-sm app-btn-secondary" href="{{route('course.view', array('id' => $course->id))}}">View</a>
                                                            <a id="{{$course ['id']}}" class="btn-sm app-btn-secondary app-btn-secondary-delete" >Delete Student Info</a>
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

<script>
    // Function to filter rows based on the selected filter
    function filterRows(filter) {
        const rows = document.querySelectorAll('tr[data-role]');
        rows.forEach((row) => {
            const role = row.getAttribute('data-role');
            if (filter === 'all' || role === filter || filter === 'admin' || role === filter || filter === 'user' || role === filter || filter === 'other' || role === filter) {
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
                    url: '{{route('course/destroy')}}',
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
                        location.replace('{{route('course.index')}}');
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





