@extends('layouts.master')
@section('content')
    @include('courses.course_modals.course-modal')
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="card-title">Courses</h2>
            {{-- <div class="card-toolbar">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">
                <i class="fa-solid fa-plus"></i>
                Add Student
            </button>
        </div> --}}
        </div>
        <div class="card-body text-center">
            <table id="studentTable" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Name</th>
                        <th>Assignment File</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>Assignment</td>
                            <td>{{ $course->created_at }}</td>
                            <td>
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
                                <button class="btn btn-primary">Edit</button>
                                <button class="btn btn-danger">delete</button>
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
                    error: function(data) {
                        console.log(data);
                        $('#saveButton').removeClass('spinner spinner-white spinner-right')
                            .prop('disabled', false);
                    }
                });
            });
        });

        function uploadFile(course_id) {
            $('#courseId').val(course_id);
        }
    </script>
@endsection
