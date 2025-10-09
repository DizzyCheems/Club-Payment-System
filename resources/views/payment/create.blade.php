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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Payment<span class="required"></span></h5>
                                    <div class="controls">
                                        <input id="paymentInput" type="number" name="amount" class="form-control mb-1" placeholder = "0.00" required data-validation-required-message="• This field is required">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Amount Required<span class="required"></span></h5>
                                    <div class="controls">
                                        <input id="amountRequired" type="number" name="amount2" class="form-control mb-1" required data-validation-required-message="• This field is required" value="{{ $indivContrib }}" readonly>
                                    </div>
                                </div>
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
                            <h5>Payment Method<span class="required"></span></h5>
                            <div class="controls">
                                <select name="method" id="paymentMethod" class="form-control" required class="form-control mb-1">
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


<script>
   $(document).ready(function() {
    // Store the original state
    function resetModal() {
        $('#agenda_id').val('');
        $('#course_id').val('');
        $('#student_id').val('');
        $('#paymentInput').val('0.00');
        $('#paymentMethod').val('Full');
        $('#amountRequired').val('');
    }

    // Reset modal on open
    $('#add').on('show.bs.modal', function() {
        resetModal();
    });

    // Reset modal on close
    $('#add').on('hidden.bs.modal', function() {
        resetModal();
    });

    // When agenda changes, update Amount Required
    $('#agenda_id').on('change', function() {
        var indivContrib = parseFloat($('#agenda_id option:selected').data('indiv-contrib')) || 0;
        $('#amountRequired').data('original', indivContrib); // Store original value
        var method = $('#paymentMethod').val();

        if (method === 'Partial') {
            $('#amountRequired').val((indivContrib * 0.5).toFixed(2));
        } else {
            $('#amountRequired').val(indivContrib.toFixed(2));
        }

        // Reset payment input
        $('#paymentInput').val('0.00');
        });

        // When payment method changes
        $('#paymentMethod').on('change', function() {
            var original = parseFloat($('#amountRequired').data('original')) || 0;
            var method = $(this).val();

            if (method === 'Partial') {
                $('#amountRequired').val((original * 0.5).toFixed(2));
            } else {
                $('#amountRequired').val(original.toFixed(2));
            }

            // Reset payment input
            $('#paymentInput').val('0.00');
        });

        // Payment input should not exceed Amount Required
        $('#paymentInput').on('input', function() {
            var paymentAmount = parseFloat($(this).val()) || 0;
            var amountRequired = parseFloat($('#amountRequired').val()) || 0;

            if (paymentAmount > amountRequired) {
                $(this).val(amountRequired.toFixed(2));
            }
        });
    });

</script>
@endif

@endsection
</html> 

