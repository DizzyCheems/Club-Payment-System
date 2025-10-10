@extends('layouts.main')
@section('content')

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">

                <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                    <div class="inner">
                        <h1 class="app-page-title">Courses</h1>
                        <div class="app-card-body p-3 p-lg-4">

                            {{-- Search Bar --}}
                            <div class="col-auto">
                                <div class="page-utilities">
                                    <div class="row align-items-center">
                                        <div class="col-md-auto">
                                            <div class="form-group mb-0">
                                                <div class="input-group">
                                                    <input type="text" style="width:400px;" id="myInput" name="searchorders" onkeyup="myFunction()" class="form-control search-orders" placeholder="Search">
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
                                            <a class="btn app-btn-secondary" href="{{ route('course.create') }}">
                                                <i class="bi bi-add me-1"></i> Add Courses
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Tabs --}}
                            <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
                                <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true" onclick="filterRows('all')">All</a>

                                {{-- Dynamic Tabs --}}
                                @foreach($courses->pluck('course_name')->unique() as $courseName)
                                    <a class="flex-sm-fill text-sm-center nav-link" id="tab-{{ $courseName }}" data-bs-toggle="tab" href="#tab-{{ $courseName }}-content" role="tab" aria-controls="tab-{{ $courseName }}-content" aria-selected="false" onclick="filterRows('{{ $courseName }}')">{{ $courseName }}</a>
                                @endforeach
                            </nav>

                            {{-- Tab Contents --}}
                            <div class="tab-content" id="orders-table-tab-content">

                                {{-- All Courses --}}
                                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                                        <div class="app-card-body">
                                            <div class="table-responsive">
                                                <table class="table app-table-hover mb-0 text-left table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th class="cell">Course</th>
                                                            <th class="cell">Year</th>
                                                            <th class="cell">Section</th>
                                                            <th class="col-actions cell">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="courseTable">
                                                        @foreach($courses as $course)
                                                        <tr data-course="{{ $course->course_name }}">
                                                            <td>
                                                                <span class="badge badge-pill" style="background-color: {{ $course->color }}; color: #fff;">
                                                                    {{ $course->course_name }}
                                                                </span>
                                                            </td>
                                                            <td>{{ $course->year_level }}</td>
                                                            <td>{{ $course->section }}</td>
                                                            <td>
                                                                <a class="btn-sm app-btn-secondary" href="{{ route('course.edit', $course->id) }}">Edit</a>
                                                                <a class="btn-sm app-btn-secondary" href="{{ route('course.view', $course->id) }}">View</a>
                                                                <a id="{{ $course->id }}" class="btn-sm app-btn-secondary app-btn-secondary-delete">Delete</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Individual Course Tabs --}}
                                @foreach($courses->pluck('course_name')->unique() as $courseName)
                                    <div class="tab-pane fade" id="tab-{{ $courseName }}-content" role="tabpanel" aria-labelledby="tab-{{ $courseName }}">
                                        <div class="app-card app-card-orders-table shadow-sm mb-5">
                                            <div class="app-card-body">
                                                <div class="table-responsive">
                                                    <table class="table app-table-hover mb-0 text-left table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th class="cell">Course</th>
                                                                <th class="cell">Year</th>
                                                                <th class="cell">Section</th>
                                                                <th class="col-actions cell">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($courses->where('course_name', $courseName) as $course)
                                                                <tr>
                                                                    <td>
                                                                        <span class="badge badge-pill" style="background-color: {{ $course->color }}; color: #fff;">
                                                                            {{ $course->course_name }}
                                                                        </span>
                                                                    </td>
                                                                    <td>{{ $course->year_level }}</td>
                                                                    <td>{{ $course->section }}</td>
                                                                    <td>
                                                                        <a class="btn-sm app-btn-secondary" href="{{ route('course.edit', $course->id) }}">Edit</a>
                                                                        <a class="btn-sm app-btn-secondary" href="{{ route('course.view', $course->id) }}">View</a>
                                                                        <a id="{{ $course->id }}" class="btn-sm app-btn-secondary app-btn-secondary-delete">Delete</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- End Tab Contents --}}

                        </div><!--//app-card-body-->
                    </div><!--//inner-->
                </div><!--//app-card-->

            </div><!--//container-xl-->
        </div><!--//app-content-->
    </div><!--//app-wrapper-->

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- JS --}}
    <script>
        // Search filter
        function myFunction() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("courseTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                var found = false;
                for (j = 0; j < tr[i].cells.length - 1; j++) {
                    td = tr[i].getElementsByTagName("td")[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }
                tr[i].style.display = found ? "" : "none";
            }
        }

        // Pagination selector
        const elementsSelect = document.getElementById('elements-select');
        const table = document.getElementById('courseTable');
        elementsSelect.addEventListener('change', function () {
            const selectedValue = elementsSelect.value;
            const rows = table.querySelectorAll('tbody tr');
            rows.forEach((row, index) => {
                row.style.display = index < selectedValue ? '' : 'none';
            });
        });

       // Delete confirmation
        $(document).on('click', '.app-btn-secondary-delete', function(e) {
            e.preventDefault();
            let id = $(this).attr('id');
            let csrf = '{{ csrf_token() }}';    

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to undo this.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/courses/' + id,
                        method: 'POST',        // POST with _method DELETE
                        data: { _token: csrf, _method: 'DELETE' },
                        success: function(response) {
                            // Show success alert and wait before reload
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Course has been deleted.',
                                timer: 2000,          // 2 seconds
                                timerProgressBar: true,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();    // Reload after alert disappears
                            });
                        },
                        error: function(err) {
                            Swal.fire('Error!', 'Failed to delete course.', 'error');
                        }
                    });
                }
            });
        });
    </script>

<!-- Javascript -->          
<script src="assets/plugins/popper.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>  

<!-- Charts JS -->
<script src="assets/plugins/chart.js/chart.min.js"></script> 
<script src="assets/js/index-charts.js"></script> 

<!-- Page Specific JS -->
<script src="assets/js/app.js"></script> 

@endsection





