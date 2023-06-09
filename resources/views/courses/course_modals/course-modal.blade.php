<div class="modal fade" id="courseModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered mw-650px">

        <div class="modal-content">

            <form class="form"  id="courseForm"  onsubmit="saveCourse(event)">
                @csrf
                <input type="hidden" name="course_id" id="courseId">
                <div class="modal-header">

                    <h2 class="fw-bold">Course</h2>
                </div>


                <div class="modal-body pt-10 pb-15 px-lg-17">

                    <div class="form-group">

                        <div class="fv-row mb-7">

                            <label class="required fs-6 fw-semibold mb-2">Name</label>
                            <input type="text" class="form-control form-control-solid"
                                placeholder="Enter course name" name="name" value=""
                                id="CourseId"/>
                            <!--end::Input-->
                            <span id="error_name" class="text-danger"></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary me-10" id="saveButtonCourse">
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
