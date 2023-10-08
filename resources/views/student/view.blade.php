@extends('layouts.main')
@section('content')

    <!--Start-Body-->
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">View Student Info</h1>
			    
			    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
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

 <!-- BEGIN: Page JS-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
 <script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"></script>
<!-- END: Page JS-->


@endsection
</html> 

