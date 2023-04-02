@php

    $title = 'Courses';
@endphp
@extends('layouts.master')
@section('content')
    @include('courses.course_modals.preview-modal')
    @include('courses.course_modals.assignment-modal')
    @include('courses.course_modals.course-modal')
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="card-title">Courses</h2>
            @can(\App\Helpers\Permissions::CREATE_COURSE)
                <div class="card-toolbar">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#courseModal">
                        <i class="fa-solid fa-plus"></i>
                        Add Course
                    </button>
                </div>
            @endcan

        </div>
        <div class="card-body text-center">
            <table class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Name</th>
                        <th>Collage</th>
                        <th>Assignment File</th>
                        @canany([\App\Helpers\Permissions::DELETE_COURSE, \App\Helpers\Permissions::EDIT_COURSE,
                            \App\Helpers\Permissions::UPLOAD_COURSE_ASSIGNMENT])
                            <th>Action</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->name ?? '' }}</td>
                            <td>{{ $course->collage->user->name ?? '' }}</td>

                            <td>
                                @if ($course->assignments->isNotEmpty())
                                    <ul style="list-style-type: none; max-height: 100px; overflow-y: auto;">
                                        @foreach ($course->assignments as $assignment)
                                            <li class="assignment-name" data-assignment-id="{{ $assignment->id }}">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#preview-assignment">
                                                    {{ $assignment->name ?? '-' }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    No assignments found
                                @endif
                            </td>

                            <td>
                                @can(\App\Helpers\Permissions::UPLOAD_COURSE_ASSIGNMENT)
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_upload" onclick="uploadFile('{{ $course->id }}')">
                                        <!--begin::Svg Icon | path: icons/duotune/files/fil018.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z"
                                                    fill="currentColor" />
                                                <path
                                                    d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM16 11.6L12.7 8.29999C12.3 7.89999 11.7 7.89999 11.3 8.29999L8 11.6H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H16Z"
                                                    fill="currentColor" />
                                                <path opacity="0.3"
                                                    d="M11 11.6V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H11Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->Upload Files
                                    </button>
                                @endcan

                                @can(\App\Helpers\Permissions::EDIT_COURSE)
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#courseModal"
                                        onclick="editCourse('{{ $course->id }}', '{{ $course->name }}')">Edit</button>
                                @endcan

                                @canany(\App\Helpers\Permissions::DELETE_COURSE)
                                    <button class="delete btn btn-danger"
                                        data-url="{{ route('course.delete', $course->id) }}">delete</button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#kt_modal_upload_form').submit(function(event) {

                event.preventDefault();
                var formData = new FormData(this);
                var button = document.querySelector("#saveButton");
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#saveButton').addClass('spinner spinner-white spinner-right').prop(
                            'disabled', true);
                        button.setAttribute("data-kt-indicator", "on");
                    },
                    success: function(data) {
                        toastr.success(data);
                        button.removeAttribute("data-kt-indicator");
                        $('#saveButton').removeClass('spinner spinner-white spinner-right')
                            .prop('disabled', false);
                        $('#kt_modal_upload_form')[0].reset();
                        $('#kt_modal_upload').modal('hide');
                    },
                    error: function(error) {

                        button.removeAttribute("data-kt-indicator");
                        $('#saveButton').removeClass('spinner spinner-white spinner-right')
                            .prop('disabled', false);
                        $.each(error.responseJSON.errors, function(key, value) {
                            $('#error_' + key).html(value);
                        });
                    }
                });
            });



            $(document).ready(function() {
                $('.delete').on('click', function(e) {
                    e.preventDefault();
                    var url = $(this).attr('data-url');

                    Swal.fire({
                        title: 'Are you sure you want to delete this course?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    Swal.fire(
                                        'Deleted!',
                                        'The course has been deleted.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                },
                                error: function(xhr) {
                                    Swal.fire(
                                        'Error!',
                                        'An error occurred while deleting the course.',
                                        'error'
                                    );
                                }
                            });
                        }
                    })
                });
            });





        });

        function uploadFile(course_id) {
            $('#courseId').val(course_id);
        }

        function editCourse(id, name) {

            $('#CourseId').val(name);
        }

        function saveCourse(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Get the form data
            var formData = $('#courseForm').serialize();

            // Send the AJAX request
            $.ajax({
                url: "{{ route('store.update.course') }}",
                type: "POST",
                data: formData,
                dataType: "json",
                beforeSend: function() {
                    // Disable the submit button and show a loading spinner
                    $('#saveButtonCourse').attr('disabled', true);
                    $('#saveButtonCourse .indicator-label').hide();
                    $('#saveButtonCourse .indicator-progress').show();
                },
                success: function(response) {
                    // Handle the response from the server
                    toastr.success(response.message); // Replace this with your own code to update the UI
                    $('#error_name').html('');
                    // Hide modal after 2 seconds
                    setTimeout(function() {
                        $('#courseModal').modal('hide');
                    }, 2000);

                    window.location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $('#error_' + key).html(value[0]);
                    });
                },
                complete: function() {
                    // Re-enable the submit button and hide the loading spinner
                    $('#saveButtonCourse').attr('disabled', false);
                    $('#saveButtonCourse .indicator-label').show();
                    $('#saveButtonCourse .indicator-progress').hide();
                }
            });
        }

        // assuming each assignment name element has a class of "assignment-name"
        const assignmentNames = document.querySelectorAll('.assignment-name');
        // Initialize Quill editor
        // Initialize Quill editor
        const quill = new Quill('#editor', {
            modules: {
                toolbar: [
                    [{
                        'header': [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    ['image', 'code-block']
                ]
            },
            theme: 'snow'
        });

        // Make the editor editable
        quill.enable();

        assignmentNames.forEach(assignmentName => {
            assignmentName.addEventListener('click', function() {
                const assignmentId = this.getAttribute('data-assignment-id');
                fetch(`/assignments/${assignmentId}/content`)
                    .then(response => response.text())
                    .then(content => {
                        const modalTitle = document.querySelector('#preview-assignment .modal-title');
                        const modalBody = document.querySelector('#preview-assignment .modal-body');

                        // set the modal title to the assignment name
                        modalTitle.textContent = this.textContent;


                        // set the Quill editor content to the file content
                        quill.setText(content);

                    })
                    .catch(error => console.error(error));
            });
        });
    </script>
@endsection
