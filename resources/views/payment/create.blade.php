@extends('layouts.main')
@section('content')

    <!--Start-Body-->
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">Add Payment</h1>
			    
			    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">

                        <form class="form" action="{{ route ('payment.post') }}" method="POST" novalidate>
                        @csrf
                        
                    <div>
	                   @if(Session::has('success'))
                             <div class="alert alert-success">
                                {{Session::get('success')}} 
                             </div>
                      @endif
                   </div>
                               
                    <div class="form-group">
                            <h5> Agenda <span class="required"></span></h5>
                                <div class="controls">
                                    <select name="agenda_id" id="lang" class="form-control" required class="form-control mb-1">
                                    @foreach($agendas as $agenda)
                                    <option value="{{ $agenda->id }}">{{$agenda->agenda_name}}</option>
                                    @endforeach
                                    </select> 
                                </div>
                    </div>

                    <div class="form-group">
                            <h5> Course <span class="required"></span></h5>
                                <div class="controls">
                                    <select name="course_id" id="lang" class="form-control" required class="form-control mb-1">
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}">{{$course->course_name}}</option>
                                    @endforeach
                                    </select> 
                                </div>
                        </div>
                    
                        <div class="form-group">
                            <h5> Student <span class="required"></span></h5>
                                <div class="controls">
                                    <select name="student_id" id="lang" class="form-control" required class="form-control mb-1">
                                    @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{$student->name}}</option>
                                    @endforeach
                                    </select> 
                                </div>
                        </div>
                         
                         <div class="form-group">
                             <h5>Amount<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="number" name="amount" class="form-control mb-1" required data-validation-required-message="• This field is required">

                                </div>
                         </div>

                         <div class="form-group">
                            <h5> Payment Type  <span class="required"></span></h5>
                                <div class="controls">
                                    <select name="type" id="lang" class="form-control" required class="form-control mb-1">
                                    <option value="Online">Online Payment</option>
                                    <option value="Cash">Cash</option>
                                    </select> 
                                </div>
                    </div>

                         
                    <div class="form-group">
                            <h5> Payment Method  <span class="required"></span></h5>
                                <div class="controls">
                                    <select name="method" id="lang" class="form-control" required class="form-control mb-1">
                                    <option value="Full">Full Payment</option>
                                    <option value="Partial">Partial Payment</option>
                                    </select> 
                                </div>
                    </div>

                        <div class="form-actions center">
                            <a class="btn btn-warning mr-1" href="{{route('payment.index')}}">
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

