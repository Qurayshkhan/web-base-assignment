@extends('layouts.master')
@section('content')
    @include('students.student_modals.student-modal')
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="card-title">Students</h2>
            <div class="card-toolbar">
                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#studentModal">
                    <i class="fa-solid fa-plus"></i>
                    Add Student
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="studentTable" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Courses</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });



            var button = document.querySelector("#saveButton");
            $('#saveButton').on('click', function(event) {

                event.preventDefault();
                let formData = $('#studentForm').serialize();
                button.setAttribute("data-kt-indicator", "on");
                $.ajax({

                    url: "{{ route('store.student') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        button.removeAttribute("data-kt-indicator");
                        $('#studentForm')[0].reset();
                        $('#studentModal').modal('hide');
                        $('#studentTable').DataTable().ajax.reload();

                        $('#error_name').html('');
                        $('#error_email').html('');
                        $('#error_address').html('');
                        $('#error_contact').html('');
                        $('#error_collage_id').html('');
                        $('#error_course_name').html('');

                        toastr.success(response);
                    },
                    error: function(error) {
                        button.removeAttribute("data-kt-indicator");
                        $.each(error.responseJSON.errors, function(key, value) {
                            $('#error_' + key).html(value);
                        });
                    }

                });

            });


            var table = $('#studentTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('get.student') }}",
                columns: [

                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'contact',
                        name: 'contact'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'courses',
                        name: 'courses'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });





            $(document).on('click', '.delete', function() {
                var userId = $(this).data('id');

                swal.fire({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this student!",
                        icon: "warning",
                        showCancelButton: true,
                        cancelButtonText: 'Cancel',
                        confirmButtonText: 'Delete',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((isConfirm) => {
                        if (isConfirm.value) {
                            $.ajax({
                                type: "DELETE",
                                url: "/delete-student/" + userId,
                                data: {
                                    _token: "{{ csrf_token() }}",
                                },
                                success: function(data) {
                                    swal.fire("Student has been deleted!", {
                                        icon: "success",
                                    });
                                    // reload the data table
                                    $('#studentTable').DataTable().ajax.reload();
                                },
                                error: function(data) {
                                    swal.fire("Oops", "Something went wrong!", "error");
                                }
                            });
                        } else {
                            swal.fire("Student deletion cancelled!", {
                                icon: "info",
                            });
                        }
                    });
            });






            $('.close').on('click', function() {

                $('#studentForm')[0].reset();

            });


        });

        let editStudent = (name, email, user_id, student_id, conatact, address, collage_id, courses, degree_title,
            roll_number) => {


            $('#modalTitle').html("Edit a Student");
            $('#userId').val(user_id);
            $('#name').val(name);
            $('#email').val(email);
            $('#id').val(student_id);
            $('#collageSelectId').val(collage_id).trigger('change');
            $('#contact').val(conatact);
            $('#address').val(address);
            $('#degreeTitle').val(degree_title);
            $('#rollNumber').val(roll_number);


            let courseArray = [courses];

            let newArr = courseArray[0].split(',').map(Number);

            console.log(newArr);

            $('#courseSelectId option').each(function() {
                if (newArr.includes(parseInt($(this).val()))) {
                    $(this).prop('selected', true);
                }
            });

            // Trigger the change event to update the select2 control
            $('#courseSelectId').trigger('change');

        }
    </script>
@endsection
