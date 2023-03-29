@php
    $title = 'Collages';
@endphp
@extends('layouts.master')
@section('content')
    @include('collage.collage-modal')
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="card-title">Collages</h2>

            @can(\App\Helpers\Permissions::CREATE_COLLAGE)
                <div class="card-toolbar">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#collageModal">
                        <i class="fa-solid fa-plus"></i>
                        Add Collage
                    </button>
                </div>
            @endcan
        </div>
        <div class="card-body">
            <table id="collageTabel" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Created At</th>
                        @canany([\App\Helpers\Permissions::EDIT_COLLAGE, \App\Helpers\Permissions::DELETE_COLLAGE])
                            <th>Action</th>
                        @endcanany
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

                    url: "{{ route('update.collage') }}",
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        button.removeAttribute("data-kt-indicator");
                        $('#collageForm')[0].reset();
                        $('#collageModal').modal('hide');
                        $('#collageTabel').DataTable().ajax.reload();

                        $('#error_name').html('');
                        $('#error_email').html('');
                        $('#error_contact').html('');
                        $('#error_address').html('');

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



            var table = $('#collageTabel').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('collage.list') }}",
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
                    @canany([\App\Helpers\Permissions::EDIT_COLLAGE, \App\Helpers\Permissions::DELETE_COLLAGE])
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    @endcan
                ]
            });



        });

        let editCollage = (name, email, user_id, collage_id, conatact, address) => {


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
