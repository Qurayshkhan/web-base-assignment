@php
    $title = 'Home';
@endphp
@extends('layouts.master')
@section('content')
    @if (auth()->user()->user_type == \App\Helpers\Constants::STUDENT)
        @include('students.student_modals.student-courses')
    @endif

    @if (auth()->user()->user_type == \App\Helpers\Constants::TEACHER)

    @endif

    @if (auth()->user()->user_type == \App\Helpers\Constants::COLLAGE)

    @endif

@endsection
@section('script')
@endsection
