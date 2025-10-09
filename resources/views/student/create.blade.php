@extends('layouts.main')
@section('content')

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">  
            <h1 class="app-page-title">Add Student</h1>
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">

                        <form class="form" action="{{ route('student.post') }}" method="POST" novalidate>
                            @csrf

                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif

                            <!-- Course -->
                            <div class="form-group">
                                <h5> Course <span class="required"></span></h5>
                                <div class="controls">
                                    <select name="course_id" id="course_id" class="form-control" required>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- User Account -->
                            <div class="form-group">
                                <h5> User Account <span class="required"></span></h5>
                                <div class="controls">
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        <option value="">-- Select User --</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Student Info -->
                            <div class="form-body">
                                <div class="form-group">
                                    <h5>Student Name<span class="required"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" id="student_name" class="form-control mb-1" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>School ID Number<span class="required"></span></h5>
                                    <div class="controls">
                                        <input type="number" name="id_num" id="student_id_num" class="form-control mb-1" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Facebook Account<span class="required"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="social_acc" id="student_social_acc" class="form-control mb-1" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>GCash / Contact Number<span class="required"></span></h5>
                                    <div class="controls">
                                        <input type="number" name="payment_acc" id="student_payment_acc" class="form-control mb-1" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions center">
                                <a class="btn btn-warning mr-1" href="{{ route('student.index') }}">
                                    <i class="ft-x"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> Save
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JQuery AJAX for auto-fill -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#user_id').change(function() {
            var userId = $(this).val();
            if(userId) {
                $.ajax({
                    url: '/get-user-info/' + userId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#student_name').val(data.name);
                        $('#student_id_num').val(data.id_num);
                    },
                    error: function() {
                        $('#student_name').val('');
                        $('#student_id_num').val('');
                    }
                });
            } else {
                $('#student_name').val('');
                $('#student_id_num').val('');
            }
        });
    });
</script>

@endsection
