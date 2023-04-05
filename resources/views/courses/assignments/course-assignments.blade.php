@extends('layouts.master')
@section('content')

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
                        <td><a href="{{\Storage::url('assignments/'.$assignment->name)}}">{{$assignment->name}}</a></td>
                        <td>2011/04/25</td>
                        <td>20</td>
                        <td>pending</td>
                        <td>10</td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

</div>






@endsection

@section('script')

@endsection
