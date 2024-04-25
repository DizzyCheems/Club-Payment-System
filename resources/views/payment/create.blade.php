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
    var originalAmount = parseFloat($('#amountRequired').val());

$('#paymentMethod').on('change', function() {
    var amountRequired = parseFloat($('#amountRequired').val());
    var paymentMethod = $(this).val();
    var paymentValue = parseFloat($('#paymentInput').val());

    if (paymentMethod === 'Partial') {
        var partialAmount = (amountRequired * 0.5).toFixed(2);
        $('#amountRequired').val(partialAmount);

        // Set Payment field to 0.00 when switching to Partial Payment
        $('#paymentInput').val('0.00');
    } else {
        $('#amountRequired').val(originalAmount.toFixed(2));
    }
});
</script>

@if(session('sweetAlert'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        });
    </script>
@endif

<script>
    $('#paymentInput').on('input', function() {
        var paymentAmount = parseFloat($(this).val());
        var amountRequired = parseFloat($('#amountRequired').val());

        if (paymentAmount > amountRequired) {
            $(this).val(amountRequired); 
        }
    });
</script>



@endsection
</html> 

