<div class="modal fade" id="kt_modal_upload" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered mw-650px">

        <div class="modal-content">

            <form class="form" action="{{route('course.assignment')}}" id="kt_modal_upload_form" method="POST">
                @csrf
                <input type="hidden" name="course_id" id="courseId">
                <div class="modal-header">

                    <h2 class="fw-bold">Upload files</h2>
                </div>


                <div class="modal-body pt-10 pb-15 px-lg-17">

                    <div class="form-group">

                        <div class="fv-row mb-7">

                            <label class="required fs-6 fw-semibold mb-2">Upload File</label>
                            <input type="file" class="form-control form-control-solid"
                                placeholder="Enter collage contact" name="assignment_file" value=""
                                id="uploadFile" accept=".doc,.docx"/>
                            <!--end::Input-->
                            <span id="error_assignment_file" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="fv-row mb-7">
                            <label class="required fs-6 fw-semibold mb-2">Due Date</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter due date" name="due_date" value=""
                                id="dueDate"/>
                            <!--end::Input-->
                            <span id="error_due_date" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="fv-row mb-7">

                            <label class="required fs-6 fw-semibold mb-2">Total Marks</label>
                            <input type="number" class="form-control form-control-solid"
                                placeholder="Enter total marks" name="total_marks" value=""
                                id="totalMarks"/>
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













