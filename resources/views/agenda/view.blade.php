@extends('layouts.main')
@section('content')

    <!--Start-Body-->
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                 <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert" >
				    <div class="inner">
                       <h1 class="app-page-title">View Agenda Details</h1>
				
			  	    <div class="inner">
					    <div class="app-card-body p-3 p-lg-4">

                        <form class="form" action="#" method="POST" novalidate>
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
                                    <input type="text" name="agenda_name" class="form-control mb-1" required data-validation-required-message="• This field is required" value="{{$agendas['agenda_name']}}" readonly>
                                </div>
                         </div>
                         
                         <div class="form-group">
                             <h5>Deadline<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="date" name="deadline" class="form-control mb-1" required data-validation-required-message="• This field is required" value="{{$agendas['deadline']}}" readonly>

                                </div>
                         </div>

                         <div class="form-group">
                             <h5>Total Fund<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="text" name="total_fund" class="form-control mb-1" required data-validation-required-message="• This field is required" value="{{$agendas['total_fund']}}" readonly>

                                </div>
                         </div>

                         
                         <div class="form-group">
                             <h5>Students Paid<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="number" name="students_paid" class="form-control mb-1" required data-validation-required-message="• This field is required"  value="{{$agendas['students_paid']}}" readonly>

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





    <div class="app-wrapper" style="position:relative; right: 250px;">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert" style="width: 1030px;">
                <div class="inner">
                    <h1 class="app-page-title">Activities for {{$agendas['agenda_name']}}</h1>
                    <div class="app-card-body p-3 p-lg-4">
                        <div class="col-auto">
                            <div class="page-utilities">
                                <div class="row align-items-center">
                                    <div class="col-md-auto">
                                        <div class="form-group mb-0">
                                            <div class="input-group">
                                                <input type="text" style="width:400px;" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn app-btn-secondary">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-auto">
                                        <select class="form-select w-auto" id="elements-select">
                                            <option value="10">10</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                        </select>
                                    </div>
                                    <div class="col-md-auto">
                                        <a class="btn app-btn-secondary" href="#" data-toggle="modal" data-target="#loginModal">    
                                            <i width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-add me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                            </i>
                                            Add Activity
                                        </a>
                                        <a class="btn app-btn-secondary" href="#">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z" />
                                                <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z" />
                                            </svg>
                                            Download CSV
                                        </a>
                                    </div>
                                </div><!--//row-->
                            </div><!--//table-utilities-->
                        </div><!--//col-auto-->
                    </div><!--//row-->

                    <!--Tab Selections -->
                    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                        <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true" onclick="filterRows('orders-all')">All</a>
                        <a class="flex-sm-fill text-sm-center nav-link" id="orders-admin-tab" data-bs-toggle="tab" href="#orders-admin" role="tab" aria-controls="orders-admin" aria-selected="false" onclick="filterRows('orders-admin')">Fully Paid</a>
                        <a class="flex-sm-fill text-sm-center nav-link" id="orders-user-tab" data-bs-toggle="tab" href="#orders-user" role="tab" aria-controls="orders-user" aria-selected="false" onclick="filterRows('orders-user')">Pending Payment</a>
                    </nav>

                    <!--END Tab Selections -->

                    <div class="tab-content" id="orders-table-tab-content">
                        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                            <div class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        <!-- Table View -->
                                        <table class="table app-table-hover mb-0 text-left" id="userTable">
                                            <thead>
                                                <tr>
                                                    <th>Activity</th>
                                                    <th>Fund Required</th>
                                                    <th class="col-actions">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($activities as $activity)
                                                <tr>
                                                    <td>{{ $activities->activity_name }}</td>
                                                    <td>{{ $activities->fund }}</td>
                                                    <td>
                                                        <a class="btn-sm app-btn-secondary" href="{{ route('agenda.edit', ['id' => $agenda->id]) }}">Edit</a>
                                                        <a class="btn-sm app-btn-secondary" href="{{ route('agenda.view', ['id' => $agenda->id]) }}">View</a>
                                                        <a id="{{ $agenda->id }}" class="btn-sm app-btn-secondary app-btn-secondary-delete">Delete Course Info</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="orders-admin" role="tabpanel" aria-labelledby="orders-admin-tab">
                            <div class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        <table class="table app-table-hover mb-0 text-left" id="adminTable">
                                            <thead>
                                                <tr>
                                                    <th>Activity</th>
                                                    <th>Fund Required</th>
                                                    <th class="col-actions">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Content for "Fully Paid" tab goes here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="orders-user" role="tabpanel" aria-labelledby="orders-user-tab">
                            <div class="app-card app-card-orders-table shadow-sm mb-5">
                                <div class="app-card-body">
                                    <div class="table-responsive">
                                        <table class="table app-table-hover mb-0 text-left" id="userTable">
                                            <thead>
                                                <tr>
                                                    <th>Activity</th>
                                                    <th>Fund Required</th>
                                                    <th class="col-actions">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Content for "Pending Payment" tab goes here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--//app-card-body-->
            </div><!--//app-card-->
        </div><!--//container-xl-->
    </div><!--//app-content-->
</div><!--//app-wrapper-->

<!-- Modal Register Activity -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalTitle">Add Activity</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="app-auth-branding mb-4 d-flex justify-content-center align-items-center">
     
                        </div>
                        <div class="auth-form-container text-start">
                         <form id="registerForm" class="form" action="{{ route('activity.add') }}" method="POST" novalidate>
                           @csrf
                               <input type="hidden" name="agenda_id" value="{{ $agendas->id }}">
                      
                        <div>
                            @if(Session::has('success'))
                                    <div class="alert alert-success">
                                        {{Session::get('success')}} 
                                    </div>
                            @endif
                        </div>
                
                        <div class="form-body"> 
                            <div class="form-group">
                             <h5>Activity Name<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="text" name="activity_name" class="form-control mb-1" required data-validation-required-message="• This field is required">
                                </div>
                         </div>
                         
                         <div class="form-group">
                             <h5>Fund Required<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="number" name="fund" class="form-control mb-1" required data-validation-required-message="• This field is required">

                                </div>
                         </div>

                         
                         <div class="form-group">
                             <h5>Date<span class="required"></span></h5>
                                <div class="controls">
                                    <input type="date" name="date" class="form-control mb-1" required data-validation-required-message="• This field is required" value = "{{ $agendas-> deadline}}">

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

                            <div class="auth-option text-center pt-5"> <a class="text-link" href="signup.html"></a>.</div>
                        </div>
                        <!--//auth-form-container-->
                    </div>
                    <!--//col-md-6-->
                    <div class="col-md-6">
                        <!-- Add any additional content for the modal body's right side -->
                    </div>
                    <!--//col-md-6-->
                </div>
                <!--//row-->
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function filterRows(tabId) {
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');

        $('#' + tabId + '-tab').addClass('active');
        $('#' + tabId).addClass('show active');
    }
</script>




 <!-- BEGIN: Page JS-->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
 <script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"></script>
<!-- END: Page JS-->


@endsection
</html> 

