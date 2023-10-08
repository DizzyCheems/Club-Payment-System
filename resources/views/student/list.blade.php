@extends('layouts.main')
@section('content')

    <!--Start-Body-->
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">Students</h1>

 
                <div class="app-card-footer p-4 mt-auto">
                    <a class="btn app-btn-secondary" href="{{ route('student.create') }}">Add Student</a>
                </div><!--//app-card-footer-->
			    
			    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">

                            @if (Session::has('success'))
                                <div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show">
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                </div>
                            @endif
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">            
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Course</th>
                                                    <th>School ID Number</th>
                                                    <th>Facebook Account</th>
                                                    <th>G cash/Contact Number</th>
                                                    <th class="col-actions">Actions</th>                            
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($students as $student)                 
                                                <tr>    
                                                        <td>{{ $student->name }}</td>
                                                        <td>
                                                            @if($student->courses->course_name  == 'BSCS')   
                                                                <span class="badge badge-pill badge-bscs">BSCS</span>
                                                            @elseif ($student->courses->course_name == 'BSIT') 
                                                                <span class="badge badge-pill badge-bsit">BSIT</span>
                                                            @else 
                                                                <span class="badge badge-pill badge-blis">BLIS</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $student->id_num }}</td>
                                                        <td>{{ $student->social_acc }}</td>
                                                        <td>{{ $student->payment_acc }}</td>
                                                        <td>
                                                            <span class="dropdown">
                                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                                                                <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">                                            
                                                                    <a href="{{route('student.edit', array('id' => $student->id))}}" class="dropdown-item"><i class="la la-pencil"></i> Edit Student Info</a>                                                                                        
                                                                    <a href="{{route('student.view', array('id' => $student->id))}}" class="dropdown-item"><i class="la la-eye"></i> View Student Info</a>                                                                                                                                  
                                                                    <a href="#" id="{{$student ['id']}}" class="dropdown-item dropdown-user-delete" id="confirm-color"><i class="la la-trash"></i> Delete Student Info</a>
                                                                </span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>                    
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div><!--//app-card-footer-->
                </div><!--//app-card-->
            </div><!--//col-->
        </div><!--//row-->

    </div><!--//container-fluid-->
</div><!--//app-content-->

</div><!--//app-wrapper-->    

<!-- BEGIN: Page JS-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"></script>
<!-- END: Page JS-->

<script>    
    // delete Branch ajax request
    $(document).on('click', '.dropdown-user-delete', function(e) {
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

@endsection
</html>
