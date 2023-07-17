<div class="modal fade" id="marksModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered mw-650px">

        <div class="modal-content">

            <form class="" action="{{ route('assignment.mark.results') }}" id="" method="POST">
                @csrf
                <input type="hidden" name="student_id" id="studentIdForMarkAssignment">
                <input type="hidden" name="assignment_id" id="assignmentIdForRemarks">
                <div class="modal-header">

                    <h2 class="fw-bold">Marks Assignment</h2>
                </div>


                <div class="modal-body pt-10 pb-15 px-lg-17">

                    <div class="form-group">

                        <div class="fv-row mb-7">

                            <label class="required fs-6 fw-semibold mb-2">Results Marks</label>
                            <input type="number" class="form-control form-control-solid"
                                placeholder="Enter total marks" name="results" value="" id="" />
                            <!--end::Input-->
                            <span id="error_total_marks" class="text-danger"></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary me-10" id="saveButton">
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
