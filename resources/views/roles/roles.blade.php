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
        <table id="usersTable" class="table table-row-bordered gy-5">
            <thead>
                <tr class="fw-semibold fs-6 text-muted">
                    <th>Name</th>
                    <th>Permission</th>
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
                    $('#roleModal').modal('hide');
                    toastr.success(response);
                }

            });

        });





    });
</script>
@endsection
