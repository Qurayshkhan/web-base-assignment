@extends('layouts.master')
@section('content')
    @include('teachers.teacherModals.teacher-modal')
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="card-title">Teacher</h2>
            <div class="card-toolbar">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teacherModal">
                    <i class="fa-solid fa-plus"></i>
                    Add Teacher
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="teacherTable" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
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
                let formData = $('#collageForm').serialize();
                button.setAttribute("data-kt-indicator", "on");
                $.ajax({

                    url: "{{route('teacher.store')}}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        button.removeAttribute("data-kt-indicator");
                        $('#teacherForm')[0].reset();
                        $('#teacherModal').modal('hide');
                        $('#teacherTable').DataTable().ajax.reload();
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


            var table = $('#teacherTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('get.teacher.list') }}",
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




        });

        let editTeacher = (name, email, user_id, collage_id, conatact, address) => {


            $('#modalTitle').html("Edit a collage");
            $('#userId').val(user_id);
            $('#name').val(name);
            $('#email').val(email);
            $('#collageId').val(collage_id);
            $('#contact').val(conatact);
            $('#address').val(address);


        }
    </script>
@endsection
