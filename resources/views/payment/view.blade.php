@extends('layouts.main')
@section('content')

    <!--Start-Body-->
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">View Payment Info</h1>
			    
			    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">

                        <form class="form" action="#" method="POST" novalidate>
                        @csrf
                        <input type="hidden" name="id" value="{{$payments['id']}}">
                    <div>

	                   @if(Session::has('success'))
                             <div class="alert alert-success">
                                {{Session::get('success')}} 
                             </div>
                      @endif
                   </div>
                        <div class="form-body">
                        <div class="form-group">
                            <h5> Agenda <span class="required"></span></h5>
                                <div class="controls">
                                    <select name="agenda_id" id="lang" class="form-control" required class="form-control mb-1" readonly>
                                    @foreach($agendas as $agenda)
                                    <option value="agenda_id" >{{$agenda->agenda_name}}</option>
                                    @endforeach
                                    </select> 
                                </div>
                    </div>

                    <div class="form-group">
                            <h5> Course <span class="required"></span></h5>
                                <div class="controls">
                                    <select name="course_id" id="lang" class="form-control" required class="form-control mb-1" readonly>
                                    @foreach($courses as $course)
                                    <option value="course_id">{{$course->course_name}}</option>
                                    @endforeach
                                    </select> 
                                </div>
                        </div>
                    
                        <div class="form-group">
                            <h5> Course <span class="required"></span></h5>
                                <div class="controls">
                                    <select name="student_id" id="lang" class="form-control" required class="form-control mb-1" readonly>
                                    @foreach($students as $student)
                                    <option value="course_id">{{$student->name}}</option>
                                    @endforeach
                                    </select> 
                                </div>
                        </div>
                         
                         <div class="form-group">
                             <h5>Amount<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="number" name="amount" class="form-control mb-1" required data-validation-required-message="• This field is required"  value="{{$payments['amount']}}" readonly>

                                </div>
                         </div>

                         <div class="form-group">
                            <h5> Payment Type  <span class="required"></span></h5>
                                <div class="controls">
                                    <select name="type" id="lang" class="form-control" required class="form-control mb-1" readonly>
                                    <option value="Online Payment">Online Payment</option>
                                    <option value="Cash">Cash</option>
                                    </select> 
                                </div>
                    </div>

                         
                    <div class="form-group">
                            <h5> Payment Method  <span class="required"></span></h5>
                                <div class="controls">
                                    <select name="method" id="lang" class="form-control" required class="form-control mb-1" readonly>
                                    <option value="Full Payment">Full Payment</option>
                                    <option value="Partial Payment">Partial Payment</option>
                                    </select> 
                                </div>
                    </div>

                        <div class="form-actions center">
                            <a class="btn btn-warning mr-1" href="{{route('student.index')}}">
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

