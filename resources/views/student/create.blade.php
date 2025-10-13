@extends('layouts.main')
@section('content')

<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">  
            <h1 class="app-page-title">Add Student</h1>
            <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration" role="alert">
                <div class="inner">
                    <div class="app-card-body p-3 p-lg-4">

                        <form class="form" id="addStudentForm" action="{{ route('student.post') }}" method="POST" novalidate>
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
                                        <option value="" selected disabled>Select Course</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}"
                                                    data-course-name="{{ $course->course_name }}"
                                                    data-year-level="{{ $course->year_level ?? '' }}"
                                                    data-color="{{ $course->color ?? '' }}">
                                                {{ $course->course_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- User Account (typable with suggestions) -->
                            <div class="form-group">
                                <h5> User Account <span class="required"></span></h5>
                                <div class="controls position-relative">
                                    <input id="user_input" class="form-control" placeholder="Type to search user..." autocomplete="off" />
                                    <datalist id="usersList">
                                        {{-- Only include users that do NOT already have a student record.
                                           Assumes User hasOne Student relation named `student`. If your relation
                                           differs, adjust the condition. --}}
                                        @foreach($users as $user)
                                            @unless($user->student)
                                                {{-- embed useful attrs on the option for the JS --}}
                                                <option data-id="{{ $user->id }}"
                                                        data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email ?? '' }}"
                                                        data-id-num="{{ $user->id_num ?? '' }}"
                                                        value="{{ $user->name }}">
                                                </option>
                                            @endunless
                                        @endforeach
                                    </datalist>

                                    {{-- suggestion dropdown (JS-managed) --}}
                                    <div id="userSuggestions" class="user-suggestions d-none"></div>

                                    {{-- hidden input that actually submits the selected user id --}}
                                    <input type="hidden" id="user_hidden" name="user_id" value="">
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
                                        <input type="text" name="id_num" id="student_id_num" class="form-control mb-1" required>
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
                                        <input type="text" name="payment_acc" id="student_payment_acc" class="form-control mb-1" required>
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

<!-- suggestion CSS -->
<style>
.user-suggestions {
    position: absolute;
    left: 0;
    right: 0;
    top: calc(100% + 4px);
    z-index: 2100;
    background: #fff;
    border: 1px solid rgba(0,0,0,0.12);
    box-shadow: 0 3px 8px rgba(0,0,0,0.08);
    max-height: 260px;
    overflow-y: auto;
    border-radius: 4px;
}
.user-suggestions .suggestion-item {
    padding: 8px 12px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.user-suggestions .suggestion-item:hover {
    background: #f6f6f6;
}
.user-suggestions .small-muted {
    font-size: 0.82rem;
    color: #666;
    margin-left: 8px;
}
</style>

<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>

<script>
(function ($) {
    'use strict';

    // Build users array from datalist <option> elements
    const userOptions = Array.from(document.querySelectorAll('#usersList option')).map(o => ({
        id: o.getAttribute('data-id'),
        name: o.value || o.getAttribute('data-name') || '',
        email: o.getAttribute('data-email') || '',
        id_num: o.getAttribute('data-id-num') || ''
    }));

    const $userInput = $('#user_input');
    const $userSuggestions = $('#userSuggestions');
    const $userHidden = $('#user_hidden');
    const $studentName = $('#student_name');
    const $studentIdNum = $('#student_id_num');
    const $userForm = $('#addStudentForm');

    function escapeHtml(unsafe) {
        return String(unsafe)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    function showUserSuggestions(filter) {
        const q = (filter || '').toLowerCase().trim();
        const matches = q === '' ? userOptions.slice(0, 25) : userOptions.filter(u => u.name.toLowerCase().includes(q) || (u.email && u.email.toLowerCase().includes(q)) || (u.id_num && u.id_num.toLowerCase().includes(q)));
        if (!matches.length) {
            $userSuggestions.addClass('d-none').empty();
            return;
        }
        let html = '';
        matches.forEach(u => {
            html += `<div class="suggestion-item" data-id="${escapeHtml(u.id)}" data-name="${escapeHtml(u.name)}" data-idnum="${escapeHtml(u.id_num)}">
                        <div>${escapeHtml(u.name)}</div>
                        <div class="small-muted">${escapeHtml(u.email || u.id_num || '')}</div>
                    </div>`;
        });
        $userSuggestions.html(html).removeClass('d-none');
    }

    function hideUserSuggestions() {
        $userSuggestions.addClass('d-none').empty();
    }

    // show suggestions on input / focus
    $userInput.on('input focus', function () {
        const v = $(this).val();
        showUserSuggestions(v);
        // clear hidden id while typing so the form won't submit an old id accidentally
        $userHidden.val('');
    });

    // suggestion click
    $userSuggestions.on('click', '.suggestion-item', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const idnum = $(this).data('idnum');

        $userInput.val(name);
        $userHidden.val(id);
        $studentName.val(name);
        if (idnum) $studentIdNum.val(idnum);
        hideUserSuggestions();
    });

    // hide on outside click
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#user_input').length && !$(e.target).closest('#userSuggestions').length) {
            hideUserSuggestions();
        }
    });

    // escape key hides suggestions
    $userInput.on('keydown', function (e) {
        if (e.key === 'Escape') hideUserSuggestions();
    });

    // on blur, if user typed a name that exactly matches an option, fill hidden fields
    $userInput.on('change blur', function () {
        const val = $(this).val().trim();
        if (!val) {
            $userHidden.val('');
            // don't clear name/id_num since they are form fields; only clear if you want
            return;
        }
        const match = userOptions.find(u => u.name === val);
        if (match) {
            $userHidden.val(match.id || '');
            if (match.id_num) $studentIdNum.val(match.id_num);
        } else {
            // typed free text -> keep hidden empty so saving requires choosing a user
            $userHidden.val('');
        }
    });

    // Reset form when page loads or when needed (optional)
    $userForm.on('reset', function () {
        $userHidden.val('');
        $userInput.val('');
        $studentName.val('');
        $studentIdNum.val('');
        hideUserSuggestions();
    });

    // Optional: prevent submit without selecting a user from the list
    $userForm.on('submit', function (e) {
        // Only require user if the route expects it; if not required, remove this block
        const userId = $userHidden.val();
        if (!userId) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Please select a User Account from the list',
                text: 'Type and choose a user from the suggestions (users already assigned to a course are omitted).'
            });
            return false;
        }
        return true;
    });

})(jQuery);
</script>

@endsection
