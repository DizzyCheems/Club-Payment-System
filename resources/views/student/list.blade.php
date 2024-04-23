@extends('layouts.main')
@section('content')

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
        <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert" >
				<div class="inner">
                    <h1 class="app-page-title">Students</h1>
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
                                
                            
                            <a class="btn app-btn-secondary" href="#" data-toggle="modal" data-target="#loginModal">
    <i width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-add me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
        <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
    </i>
    Add Student
</a>


                            
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
                                    <th class="cell">Name</th>
                                    <th class="cell">Course</th>
                                    <th class="cell">School ID Number</th>
                                    <th class="cell">Facebook Account</th>
                                    <th class="cell">G cash/Contact Number</th>
                                    <th class="col-actions cell">Actions</th>    
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
                                            <th class="col-actions cell">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userTable">
                                        @foreach($students as $student)                 
                                                <tr>    
                                                  @if($student->courses->course_name  == 'BSCS')   
                                                        <td>{{ $student->name }}</td>
                                                        <td>   
                                                                <span class="badge badge-pill badge-bscs">{{ $student->courses->course_name}} {{$student->courses->year_level}}</span>
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
                                            <th class="cell">Name</th>
                                            <th class="cell">Course</th>
                                            <th class="cell">School ID Number</th>
                                            <th class="cell">Facebook Account</th>
                                            <th class="cell">G cash/Contact Number</th>
                                            <th class="col-actions cell">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userTable">
                                        @foreach($students as $student)                 
                                                <tr>    
                                                  @if($student->courses->course_name  == 'BLIS')   
                                                        <td>{{ $student->name }}</td>
                                                        <td>
                                                                <span class="badge badge-pill badge-blis">{{ $student->courses->course_name}} {{$student->courses->year_level}}</span>
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
                                            <th class="cell">Name</th>
                                            <th class="cell">Course</th>
                                            <th class="cell">School ID Number</th>
                                            <th class="cell">Facebook Account</th>
                                            <th class="cell">G cash/Contact Number</th>
                                            <th class="col-actions cell">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userTable">
                                        @foreach($students as $student)                 
                                                <tr>    
                                                  @if($student->courses->course_name  == 'BSIT')   
                                                        <td>{{ $student->name }}</td>
                                                        <td>   
                                                                <span class="badge badge-pill badge-bsit">{{ $student->courses->course_name}} {{$student->courses->year_level}}</span>
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
<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalTitle">Administrator Approval Required</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="app-auth-branding mb-4 d-flex justify-content-center align-items-center">
                            <a class="app-logo" href="index.html">
                                <img class="logo-icon me-2" src="assets/images/logo.jpg" alt="logo" style="max-width: 100px;">
                            </a>
                        </div>
                        <div class="auth-form-container text-start">
                        <form id="loginForm" method="POST" action="{{ route('add.auth') }}" class="login-form"> 
                            @csrf
                            @include('layouts/alerts')
                            <div class="email mb-3">
                                <label class="sr-only" for="signin-email">Email</label>
                                <input id="input-email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email" >
                            </div>
                            <!--//form-group-->
                            <div class="password mb-3">
                                <label class="sr-only" for="signin-password">Password</label>
                                <input id="input-password" type="password" name="password" class="form-control" placeholder="Password" value="" >
                            </div>
                            <!--//form-group-->
                            <!--//extra-->
                            <div class="text-center">
                                <button type="submit" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
                            </div>
                        </form>
                            <div class="auth-option text-center pt-5"> <a class="text-link" href="signup.html"></a>.</div>
                        </div>
                        <!--//auth-form-container-->
                    </div>
                    <!--//col-md-6-->
                    <div class="col-md-6">
                        <!-- Add any additional content for the modal body's right side -->
                    </div>
                    <!--//col-md-6-->
                </div>
                <!--//row-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                    url: '{{route('student/destroy')}}',
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
                        location.replace('{{route('student.index')}}');
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

<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(event) {
            event.preventDefault(); 

            // Submit the form via AJAX
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Approval Verified.',
                            text: response.message,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('student.create') }}";
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Authorization Denied.',
                            text: response.message,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Authorization Denied.',
                        text: 'Invalid Credentials. This User is NOT an Admin.',
                    });
                }
            });
        });
    });
</script>


@endsection
</html>
















