@php

    $title = 'Student Assignments';

@endphp
@extends('layouts.master')
@section('content')
    @include('students.submit_assignment_modal.assignment-submit-modal')
    <div class="card bg-light shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Assignment</h3>

        </div>
        <div class="card-body card-scroll h-200px">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th>Assignment</th>
                            <th>Due Date</th>
                            <th>Totals Marks</th>
                            <th>Submit</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $assignment)
                            <tr>
                                <td><a href="{{ asset('storage/assignments/' . $assignment->name) }}"
                                        download="{{ $assignment->name }}">{{ $assignment->name }}</a>
                                </td>
                                <td>{{ $assignment->due_date ?? '-' }}</td>
                                <td>{{ $assignment->total_marks ?? '-' }}</td>
                                <td>
                                    @if (isset(auth()->user()->student->id) == isset($assignment->submitAssignment->student_id))
                                        @if ($assignment->submitAssignment)
                                            <a href="{{ \Storage::url('assignments/' . $assignment->submitAssignment->name) }}"
                                                download>{{ $assignment->submitAssignment->name }}</a>
                                        @else
                                            {{ $assignment->submitAssignment->status ?? 'Not Submitted' }}
                                        @endif
                                    @endif

                                    <i class="fas fa-location-arrow fs-1 text-primary" data-bs-toggle="modal"
                                        data-bs-target="#submit_assignment_modal" style="cursor: pointer"
                                        onclick="submitAssignment('{{ $assignment->id }}', '{{ auth()->user()->student->id }}')"></i>
                                </td>
                                <td>{{ $assignment->submitAssignment->results ?? '-' }}</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        function submitAssignment(assignment_id, student_id) {

            $('#assignmentId').val(assignment_id);
            $('#studentId').val(student_id);

        }

        $(document).ready(function() {

            $('#saveButton').click(function() {
                var button = document.querySelector("#saveButton");
                var assignment_id = $('#assignmentId').val();
                var student_id = $('#studentId').val();
                var assignment_file = $('input[name="assignment_file"]').prop('files')[0];
                var formData = new FormData();
                formData.append('assignment_id', assignment_id);
                formData.append('student_id', student_id);
                formData.append('assignment_file', assignment_file);
                button.setAttribute("data-kt-indicator", "on");
                $.ajax({
                    url: "{{ route('submit.assignment') }}",
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#submitSolutionAssignmentForm')[0].reset();
                        button.removeAttribute("data-kt-indicator");
                        $('#submit_assignment_modal').modal('hide');
                        toastr.success(response.message);
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        $.each(error.responseJSON.errors, function(key, value) {
                            $('#error_' + key).html(value);
                        });
                    },
                });
            });
        });
    </script>
@endsection
