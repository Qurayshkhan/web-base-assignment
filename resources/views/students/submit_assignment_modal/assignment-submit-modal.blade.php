<div class="modal fade" tabindex="-1" id="submit_assignment_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Submit Assignment</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form action="{{ route('submit.assignment') }}" method="POST" id="submitSolutionAssignmentForm">
                    @csrf
                    <input type="hidden" id="assignmentId" name="assignment_id">
                    <input type="hidden" id="studentId" name="student_id">

                    <div class="form-group">
                        <label for="">Submit Assignment</label>
                        <input type="file" name="assignment_file" class="form-control">

                        <span id="error_assignment_file" class="text-danger"></span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary me-10" id="saveButton">
                            <span class="indicator-label">
                                Submit
                            </span>
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
