@extends('layouts.main')
@section('content')

    <!--Start-Body-->
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <h1 class="app-page-title">Add Agenda</h1>
			    
			    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">

                        <form class="form" action="{{ route ('agenda.post') }}" method="POST" novalidate>
                        @csrf
                        
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
                                    <input type="text" name="agenda_name" class="form-control mb-1" required data-validation-required-message="This field is required">
                                </div>
                         </div>
                         
                         <div class="form-group">
                             <h5>Deadline<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="date" name="deadline" class="form-control mb-1" required data-validation-required-message="This field is required">

                                </div>
                         </div>

                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Individual Contribution<span class="required"></span></h5>
                                    <div class="controls">
                                        <input type="number" name="individualContribution" id="individualContributionInput" class="form-control mb-1 small-width" required data-validation-required-message="This field is required">
                                        <span id="individualContributionDisplay"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5>Number of Students<span class="required"></span></h5>
                                <div class="form-group">
                                    <div class="controls">
                                        <input type="number" name="numberOfStudents" id="numberOfStudentsInput" class="form-control mb-1" required data-validation-required-message="This field is required" value="{{ $totalStudents }}" readonly>
                                        <span id="numberOfStudentsDisplay"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <h5>Total Fund<span class="required"></span></h5>
                            <div class="controls">
                                <input type="text" name="total_fund" id="totalFundInput" class="form-control mb-1" required data-validation-required-message="This field is required" readonly>
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

<script>
    document.getElementById('individualContributionInput').addEventListener('input', function() {
        calculateTotalFund();
    });

    document.getElementById('numberOfStudentsInput').addEventListener('input', function() {
        calculateTotalFund();
    });

    function calculateTotalFund() {
        var individualContribution = parseFloat(document.getElementById('individualContributionInput').value);
        var numberOfStudents = parseFloat(document.getElementById('numberOfStudentsInput').value);
        var totalFund = individualContribution * numberOfStudents;

        document.getElementById('totalFundInput').value = totalFund.toFixed(2); 
    }

    calculateTotalFund();
</script>

@endsection
</html> 

