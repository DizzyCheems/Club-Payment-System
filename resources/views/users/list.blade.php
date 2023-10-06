@extends('layouts.main')
@section('content')


<style>
    .badge-primary {
        background-color: #007bff;
    }

    .badge-danger {
        background-color: #dc3545;
    }

    .badge-pill {
        border-radius: 10px;
    }
</style>

    <!--Start-Body-->
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">Users</h1>

 
                <div class="app-card-footer p-4 mt-auto">
                    <a class="btn app-btn-secondary" href="{{ route('user.create') }}">Add User</a>
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
                                                    <th>E-mail</th>
                                                    <th>Role</th>
                                                    <th class="col-actions">Actions</th>                            
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)                 
                                                    <tr>    
                                                        <td>{{ $user->name}}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td> 
                                                            @if($user->role == 'USER')   
                                                                <span class="badge badge-pill badge-primary">USER</span>
                                                            @else 
                                                                <span class="badge badge-pill badge-danger">ADMIN</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="dropdown">
                                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                                                                <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">                                            
                                                                    <a href="{{route('user.edit', array('id' => $user->id))}}" class="dropdown-item"><i class="la la-pencil"></i> Edit User</a>                                                                                        
                                                                    <a href="{{route('user.view', array('id' => $user->id))}}" class="dropdown-item"><i class="la la-eye"></i> View User</a>                                                                                                                                  
                                                                    <a href="#" id="{{$user ['id']}}" class="dropdown-item dropdown-user-delete" id="confirm-color"><i class="la la-trash"></i> Delete User</a>
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
                    url: '{{route('user/destroy')}}',
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
                        location.replace('{{route('user.index')}}');
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
