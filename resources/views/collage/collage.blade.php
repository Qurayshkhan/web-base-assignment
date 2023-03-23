@extends('layouts.master')
@section('content')
@include('collage.collage-modal')
<div class="card shadow-sm">
    <div class="card-header">
        <h2 class="card-title">Collages</h2>
        <div class="card-toolbar">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#collageModal">
                <i class="fa-solid fa-plus"></i>
                    Edit Information
            </button>
        </div>
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


@endsection
