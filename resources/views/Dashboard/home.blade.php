@php
    $title = "Home";
@endphp
@extends('layouts.master')
@section('content')


<div class="card card-flush shadow-sm">
    <div class="card-header">
        <h2 class="card-title">Title</h2>
        <div class="card-toolbar">
            <button type="button" class="btn btn-sm btn-light">
                Action
            </button>
        </div>
    </div>
    <div class="card-body py-5">
        Lorem Ipsum is simply dummy text...
    </div>
    <div class="card-footer">
        Footer
    </div>
</div>


@endsection
@section('script')

@endsection
