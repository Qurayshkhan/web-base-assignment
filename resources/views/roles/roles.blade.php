@extends('layouts.master')
@section('content')
    @include('roles.roleModals.role-modals')
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Roles</h3>
            <div class="card-toolbar">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#roleModal">
                    <i class="fa-solid fa-plus"></i>
                    Add Role
                </button>
            </div>
        </div>
        <div class="card-body">
            <table id="rolesTabel" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Name</th>
                        <th>Permission</th>
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
                let formData = $('#roleForm').serialize();
                button.setAttribute("data-kt-indicator", "on");
                $.ajax({

                    url: "/add-user-role",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        button.removeAttribute("data-kt-indicator");
                        $('#roleForm')[0].reset();
                        $('#error_role_name').html('');
                        $('#error_permissions').html('');
                        $('#roleModal').modal('hide');
                        $('#rolesTabel').DataTable().ajax.reload();

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


            $('#rolesTabel').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('roles.list') }}",
                columns: [

                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'permissions',
                        name: 'permissions',
                        orderable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });



            $(document).on('click', '.edit', function() {
                var roleId = $(this).data('role-id');

                $.get('/roles/' + roleId + '/edit', function(data) {
                    // Set the role name in the input field
                    $('#roleModal input[name="role_name"]').val(data.role.name);

                    // Pre-select the checkboxes for the corresponding permissions
                    $.each(data.rolePermissions, function(i, permission) {

                        $('#' + permission).prop('checked', true);
                    });

                    // Set the role ID as a data attribute on the Save button
                    $('#roleModal #id').val(data.role.id);

                    // Show the modal
                    $('#roleModal').modal('show');
                });
            });


            $('#closeButton').click(function() {

                $('#roleForm')[0].reset();
                $('#error_permissions').html('');
                $('#error_role_name').html('');

            });


            $(document).on('click', '.delete', function() {
                var roleId = $(this).data('id');

                swal.fire({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this role!",
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
                                url: "/delete-role/" + roleId,
                                data: {
                                    _token: "{{ csrf_token() }}",
                                },
                                success: function(data) {
                                    swal.fire("Role has been deleted!", {
                                        icon: "success",
                                    });
                                    // reload the data table
                                    $('#rolesTabel').DataTable().ajax.reload();

                                },
                                error: function(data) {
                                    swal.fire("Oops", "Something went wrong!", "error");
                                }
                            });
                        } else {
                            swal.fire("Role deletion cancelled!", {
                                icon: "info",
                            });
                        }
                    });
            });






        });
    </script>
@endsection
