{{-- Start User Modals --}}




<div class="modal fade" tabindex="-1" id="teacherModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Edit a Teacher</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">

                <form id="teacherForm">
                    @csrf
                    <input type="hidden" name="id" id="teacherId">
                    <input type="hidden" name="user_id" id="userId">
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-semibold mb-2">Name</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" placeholder="Enter user name"
                            name="name" id="name" value="" />
                        <!--end::Input-->
                        <span id="error_name" class="text-danger"></span>
                    </div>
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-semibold mb-2">Email</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="email" class="form-control form-control-solid" placeholder="Enter email"
                            name="email" value="" id="email" />
                        <!--end::Input-->
                        <span id="error_email" class="text-danger"></span>

                    </div>
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-semibold mb-2">Location</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="email" class="form-control form-control-solid" placeholder="Enter location"
                            name="location" value="" id="address" />
                        <!--end::Input-->
                        <span id="error_address" class="text-danger"></span>

                    </div>
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-semibold mb-2">Contact</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="email" class="form-control form-control-solid" placeholder="Enter Contact"
                            name="contact" value="" id="contact" />
                        <!--end::Input-->
                        <span id="error_contact" class="text-danger"></span>

                    </div>


                    <div class="fv-row mb-7">

                        <label class="required fs-6 fw-semibold mb-2">Select Collage</label>

                        <select class="form-select form-select-solid" aria-label="Select example" id="collageSelectId"
                            name="collage_id">
                            <option>Select Collage</option>
                            @foreach ($collages as $collage)
                                <option value="{{ $collage->id }}">{{ $collage->user->name }}</option>
                            @endforeach
                        </select>
                        <span id="error_collage_id" class="text-danger"></span>
                    </div>
                    <div class="fv-row mb-7">

                        <label class="required fs-6 fw-semibold mb-2">Select Course</label>

                        <select class="form-select form-select-solid" aria-label="Select example" id="courseSelectId"
                            name="course_name[]" multiple data-control="select2" data-dropdown-parent="#teacherModal" data-placeholder="Select an course" data-allow-clear="true">
                            <option value="">Select Course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                        <span id="error_course_name" class="text-danger"></span>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light close" data-bs-dismiss="modal">Close</button>

                <button type="button" class="btn btn-primary me-10" id="saveButton">
                    <span class="indicator-label">
                        Submit
                    </span>
                    <span class="indicator-progress">
                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>





{{-- End User Modals --}}
