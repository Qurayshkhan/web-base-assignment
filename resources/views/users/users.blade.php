@php
    $title = "Users";
@endphp
@extends('layouts.master')
@section('content')
    @include('users.userModals.user-modals')
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="card-title">Users</h2>
            <div class="card-toolbar">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">
                    <i class="fa-solid fa-plus"></i>
                    Add User
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="usersTable" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
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
                let formData = $('#userForm').serialize();
                button.setAttribute("data-kt-indicator", "on");
                $.ajax({

                    url: "/add-user",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        button.removeAttribute("data-kt-indicator");
                        $('#userForm')[0].reset();
                        $('#userModal').modal('hide');
                        $('#usersTable').DataTable().ajax.reload();

                        $('#error_name').html('');
                        $('#error_email').html('');

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



            var table = $('#usersTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('get.users') }}",
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
                        data: 'role',
                        name: 'role'
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

        let editUser = (name, email, user_id, role_id) => {

            $('#userTypeFeild').attr('hidden', true);
            $('#modalTitle').html("Edit a User");
            $('#userId').val(user_id);
            $('#name').val(name);
            $('#email').val(email);
            $('#roleSelectId').val(role_id).trigger('change');


        }


        $(document).on('click', '.delete', function() {
            var userId = $(this).data('id');

            swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this user!",
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
                            url: "/delete-user/" + userId,
                            data: {
                                _token: "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                swal.fire("User has been deleted!", {
                                    icon: "success",
                                });
                                // reload the data table
                                $('#usersTable').DataTable().ajax.reload();
                            },
                            error: function(data) {
                                swal.fire("Oops", "Something went wrong!", "error");
                            }
                        });
                    } else {
                        swal.fire("User deletion cancelled!", {
                            icon: "info",
                        });
                    }
                });
        });
    </script>
@endsection
