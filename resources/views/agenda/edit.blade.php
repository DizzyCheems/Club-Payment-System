@extends('layouts.main')
@section('content')

    <!--Start-Body-->
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
                 <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert" >
				    <div class="inner">
                       <h1 class="app-page-title">Edit Agenda Details</h1>
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">

                        <form class="form" action="{{ route ('agenda.update', array('id' => $agendas->id))}}" method="POST" novalidate>
                        @csrf
                        <input type="hidden" name="id" value="{{$agendas['id']}}">
                    <div>

	                   @if(Session::has('success'))
                             <div class="alert alert-success">
                                {{Session::get('success')}} 
                             </div>
                      @endif
                   </div>
                        <div class="form-body">
                        <div class="form-group">
                             <h5>Agenda<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="text" name="agenda_name" class="form-control mb-1" required data-validation-required-message="• This field is required" value="{{$agendas['agenda_name']}}">
                                </div>
                         </div>
                         
                         <div class="form-group">
                             <h5>Deadline<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="date" name="deadline" class="form-control mb-1" required data-validation-required-message="• This field is required" value="{{$agendas['deadline']}}">

                                </div>
                         </div>

                         <div class="form-group">
                             <h5>Total Fund<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="text" name="total_fund" class="form-control mb-1" required data-validation-required-message="• This field is required" value="{{$agendas['total_fund']}}">

                                </div>
                         </div>

                        <div class="form-actions center">
                            <a class="btn btn-warning mr-1" href="{{route('agenda.index')}}">
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

