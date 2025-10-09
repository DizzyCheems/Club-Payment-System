@extends('layouts.user_main')

@section('content')
    <!--Start-Body-->
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">

			 @if(session('warning'))
				<div id="flash-alert" class="alert alert-warning text-center" role="alert">
					{{ session('warning') }}
				</div>
				@endif

				@if(session('success'))
				<div id="flash-alert" class="alert alert-success text-center" role="alert">
					{{ session('success') }}
				</div>
				@endif

				<script>
					// Auto-hide the alert after 3 seconds
					setTimeout(() => {
						const alert = document.getElementById('flash-alert');
						if (alert) {
							alert.style.transition = "opacity 0.5s ease";
							alert.style.opacity = "0";
							setTimeout(() => alert.remove(), 500);
						}
					}, 3000);
				</script>

			    <h1 class="app-page-title">Dashboard</h1>

			    <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
				    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">
						<h3 class="mb-3">Welcome {{ $user->name }}</h3>
						    <div class="row gx-5 gy-3">
						        <div class="col-12 col-lg-9">							        
									<div>
										@if($user->isAdmin())
											You are now Logged in as Administrator
										@elseif($user->student)
											You are now Logged in as Student
										@elseif($user->isUser())
											You are now Logged in as User
										@else
											You are now Logged in as {{ $user->role }}
										@endif
									</div>
							    </div><!--//col-->
							    <div class="col-12 col-lg-3">
							    </div><!--//col-->
						    </div><!--//row-->
						    <!--<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>-->
					    </div><!--//app-card-body-->
					    
				    </div><!--//inner-->
			    </div><!--//app-card-->
				    
				<div class="row g-4 mb-4">
    <div class="col-12 col-lg-6">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Net Paid</h4>
                <div class="stats-figure">₱{{ $totalAmount }}</div>
                <div class="stats-meta text-success">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                    </svg> 0%
                </div>
            </div><!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div><!--//app-card-->
    </div><!--//col-->

    <div class="col-12 col-lg-6">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Events/Agendas</h4>
                <div class="stats-figure">{{ $agendaCount }}</div>
                <div class="stats-meta">
                    Open
                </div>
            </div><!--//app-card-body-->
            <a class="app-card-link-mask" href="#"></a>
        </div><!--//app-card-->
    </div><!--//col-->
</div><!--//row-->

			        
		
			    <div class="row g-4 mb-4">
				    <div class="col-12 col-lg-6">
				        <div class="app-card app-card-progress-list h-100 shadow-sm">
					        <div class="app-card-header p-3">
						        <div class="row justify-content-between align-items-center">
							        <div class="col-auto">
						                <h4 class="app-card-title">Payments</h4>
							        </div><!--//col-->
							        <div class="col-auto">
								      	<div class="card-header-action">
											<a href="{{ route('payment.index.user') }}">View Payments</a>
										</div><!--//card-header-actions-->
							        </div><!--//col-->
						        </div><!--//row-->
								</div><!--//app-card-header-->
									<div class="app-card-body">
									@if($payments->isEmpty())
								    <div class="item p-3 d-flex justify-content-center align-items-center">
										<div class="title mb-1">NO PAYMENTS</div>
									</div>
									@else
										@foreach($payments as $payment)
											<div class="item p-3">
												<div class="row align-items-center">
													<div class="col">
														<div class="title mb-1">{{ $payment->agendas->agenda_name }}</div>
														<div class="progress">
															@php
																$progressPercentage = $payment->agendas->indiv_contrib / $payment->amount * 100;
															@endphp
															<div class="progress-bar bg-success" role="progressbar" style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
													</div><!--//col-->
													<div class="col-auto">
														<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
															<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
														</svg>
													</div><!--//col-->
												</div><!--//row-->
												<a class="item-link-mask" href="#"></a>
											</div><!--//item-->
										@endforeach
									@endif

									</div><!--//app-card-body-->
				        </div><!--//app-card-->
			        </div><!--//col-->
			        <div class="col-12 col-lg-6">
				        <div class="app-card app-card-stats-table h-100 shadow-sm">
					        <div class="app-card-header p-3">
						        <div class="row justify-content-between align-items-center">
							        <div class="col-auto">
						                <h4 class="app-card-title">History</h4>
							        </div><!--//col-->
							        <div class="col-auto">
								        <div class="card-header-action">
									        <a href="#">View report</a>
								        </div><!--//card-header-actions-->
							        </div><!--//col-->
						        </div><!--//row-->
					        </div><!--//app-card-header-->
					        <div class="app-card-body p-3 p-lg-4">
						        <div class="table-responsive">
							        <table class="table table-borderless mb-0">
										<thead>
											<tr>
												<th class="meta">Agenda</th>
												<th class="meta">Payment</th>
												<th class="meta">Date</th>
											</tr>
										</thead>
										<tbody>
											@if($payments->isEmpty())
												<tr>
													<td colspan="3" class="text-center">No Payment</td>
												</tr>
											@else
												@foreach($payments as $payment)
													<tr>    
														<td>{{ $payment->agendas->agenda_name }}</td>
														<td>{{ $payment->amount }}</td>
														<td>{{ date('j M', strtotime($payment->created_at)) }}</td>
													</tr>
												@endforeach
											@endif
										</tbody>
									</table>
						        </div><!--//table-responsive-->
					        </div><!--//app-card-body-->
				        </div><!--//app-card-->
			        </div><!--//col-->
			    </div><!--//row-->

			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
	    

	    
    </div><!--//app-wrapper-->    					

 
    <!-- Javascript -->          
    <script src="assets/plugins/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

    <!-- Charts JS -->
    <script src="assets/plugins/chart.js/chart.min.js"></script> 
    <script src="assets/js/index-charts.js"></script> 
    
    <!-- Page Specific JS -->
    <script src="assets/js/app.js"></script> 

</body>
@endsection
</html> 

