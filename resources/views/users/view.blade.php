@extends('layouts.main')
@section('content')

    <!--Start-Body-->
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
                 <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert" >
				    <div class="inner">
                       <h1 class="app-page-title">View User Details</h1>
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">

                        <form class="form" action="#" method="POST" novalidate>
                        @csrf
                        <input type="hidden" name="id" value ="{{$user['id']}}">
                    <div>
	                   @if(Session::has('success'))
                             <div class="alert alert-success">
                                {{Session::get('success')}} 
                             </div>
                      @endif
                   </div>
                   <input type="hidden" name="id" value="{{$user['id']}}">
                        <div class="form-body">
                            <div class="form-group">
                             <h5>FullName<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control mb-1" required data-validation-required-message="• This field is required" value="{{$user['fullname']}}" readonly>
                                </div>
                         </div>
                         
                         <div class="form-group">
                             <h5>Email<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="text" name="email" class="form-control mb-1" required data-validation-required-message="• This field is required" value="{{$user['email']}}" readonly>
                                </div>
                         </div>

                         <div class="form-group">
                          <h5> Role <span class="required"></span></h5>
                                <div class="controls">
                                <select name="role" id="lang" class="form-control" required class="form-control mb-1" value="{{$user['role']}}" readonly>
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                            </select> </div>
                         </div>

                         <div class="form-group">
                             <h5>Password<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="password" name="password" class="form-control mb-1" required data-validation-required-message="• This field is required" readonly >
                                </div>
                         </div>
                    
                            </div>
                        <div class="form-actions center">
                            <a class="btn btn-warning mr-1" href="{{route('user.index')}}">
                                <i class="ft-x"></i> Cancel
                            </a>
                        </div>
                    </form>
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


@endsection
</html> 

