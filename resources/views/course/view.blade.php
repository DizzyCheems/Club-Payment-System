@extends('layouts.main')
@section('content')

<!--Start-Body-->
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">

            {{-- Course Details Card (display-only) --}}
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <h1 class="app-page-title">View Course Details</h1>
                </div>

                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">

                        {{-- Success message --}}
                        @if(Session::has('success'))
                            <div class="alert alert-success text-center">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold">Course</label>
                                <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                    @php
                                        $badgeColor = $courses->color ?? null;
                                    @endphp

                                    @if($badgeColor)
                                        <span class="badge badge-pill" style="background-color: {{ $badgeColor }}; color: #fff; font-size: 1rem; padding: .45rem .7rem;">
                                            {{ $courses->course_name }}
                                        </span>
                                    @else
                                        <span class="badge badge-pill badge-blis" style="font-size: 1rem; padding: .45rem .7rem;">
                                            {{ $courses->course_name }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <label class="form-label fw-bold">Year Level</label>
                                <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                    {{ $courses->year_level }}
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <label class="form-label fw-bold">Section</label>
                                <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                    {{ $courses->section }}
                                </div>
                            </div>

                            @if(isset($courses->created_at))
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold">Created</label>
                                <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                    {{ $courses->created_at->format('j M Y, g:i A') }}
                                </div>
                            </div>
                            @endif

                            @if(isset($courses->updated_at))
                            <div class="col-12 col-md-4">
                                <label class="form-label fw-bold">Last Updated</label>
                                <div class="p-2 rounded" style="background: #fafafa; border: 1px solid #e9ecef;">
                                    {{ $courses->updated_at->format('j M Y, g:i A') }}
                                </div>
                            </div>
                            @endif
                        </div><!--//row-->

                    </div><!--//app-card-body-->
                </div><!--//inner-->
            </div><!--//app-card-->

            {{-- Students list for this course (keeps original style + actions) --}}
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert" style="bottom:50px;">
                <div class="inner">
                    <h1 class="app-page-title">Students of {{ $courses->course_name }}</h1>
                </div>
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">

                        <div class="col-auto">
                            <div class="page-utilities">
                                <div class="row align-items-center mb-4">
                                    <div class="col-md-auto">
                                        <div class="form-group mb-0">
                                            <div class="input-group">
                                                <input type="text" style="width:400px;" id="myInput" name="searchorders" onkeyup="myFunction()" class="form-control search-orders" placeholder="Search">
                                                <div class="input-group-append">
                                                    <button type="submit"  class="btn app-btn-secondary">Search</button>
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

                        <div class="tab-content" id="orders-table-tab-content">
                            <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                                <div class="app-card app-card-orders-table shadow-sm mb-5">
                                    <div class="app-card-body">
                                        <div class="table-responsive">
                                            <table class="table app-table-hover mb-0 text-left table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="cell">Name</th>
                                                        <th class="cell">Course</th>
                                                        <th class="cell">School ID Number</th>
                                                        <th class="cell">Facebook Account</th>
                                                        <th class="cell">G cash/Contact Number</th>
                                                        <th class="cell">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="userTable">
                                                    @foreach($students as $student)
                                                        <tr>
                                                            <td>{{ $student->name }}</td>
                                                            <td>
                                                                {{-- Use course color if available --}}
                                                                @php
                                                                    $c = $student->courses ?? null;
                                                                    $col = $c && $c->color ? $c->color : null;
                                                                @endphp

                                                                @if($col)
                                                                    <span class="badge badge-pill" style="background-color: {{ $col }}; color: #fff;">
                                                                        {{ $student->courses->course_name }} {{ $student->courses->year_level }}
                                                                    </span>
                                                                @else
                                                                    <span class="badge badge-pill badge-blis">
                                                                        {{ $student->courses->course_name }} {{ $student->courses->year_level }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $student->id_num }}</td>
                                                            <td>{{ $student->social_acc }}</td>
                                                            <td>{{ $student->payment_acc }}</td>
                                                            <td class="cell">
                                                                <a class="btn-sm app-btn-secondary" href="{{ route('student.edit', $student->id) }}">Edit</a>
                                                                <a class="btn-sm app-btn-secondary" href="{{ route('student.view', $student->id) }}">View</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div><!--//table-responsive-->
                                    </div><!--//app-card-body-->
                                </div><!--//app-card-->
                            </div><!--//tab-pane-->
                        </div><!--//tab-content-->

                    </div><!--//app-card-body-->
                </div><!--//inner-->
            </div><!--//app-card-->

        </div><!--//container-xl-->
    </div><!--//app-content-->
</div><!--//app-wrapper-->

{{-- JS: keep your existing search / pagination / delete handlers --}}

<script>
    // simple search
    function myFunction() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("myInput");
        if (!input) return;
        filter = input.value.toUpperCase();
        table = document.getElementById("userTable");
        if (!table) return;
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

    // pagination selector
    const elementsSelect = document.getElementById('elements-select');
    if (elementsSelect) {
        const table = document.getElementById('userTable');
        elementsSelect.addEventListener('change', function () {
            const selectedValue = parseInt(elementsSelect.value, 10);
            const rows = (table) ? table.querySelectorAll('tbody tr') : [];
            rows.forEach((row, index) => {
                row.style.display = index < selectedValue ? '' : 'none';
            });
        });
    }

</script>

@endsection
