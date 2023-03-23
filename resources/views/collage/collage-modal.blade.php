<div class="modal fade" tabindex="-1" id="collageModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Edit collage information</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">

                <form id="collageForm">
                    @csrf
                    <input type="hidden" name="user_id" id="userId">
                    <input type="hidden" name="collage_id" id="collageId">
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-semibold mb-2">Name</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" placeholder="Enter collage name"
                            name="name" id="name" value="" />
                        <!--end::Input-->
                        <span id="error_name" class="text-danger"></span>
                    </div>
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-semibold mb-2">Email</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="email" class="form-control form-control-solid" placeholder="Enter collage email"
                            name="email" value="" id="email" />
                        <!--end::Input-->
                        <span id="error_email" class="text-danger"></span>

                    </div>


                    <div class="fv-row mb-7">

                        <label class="required fs-6 fw-semibold mb-2">Enter Contact</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Enter collage contact"
                            name="contact" value="" id="contact" />
                        <!--end::Input-->
                        <span id="error_contact" class="text-danger"></span>


                    </div>
                    <div class="fv-row mb-7">

                        <label class="required fs-6 fw-semibold mb-2">Enter Address</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Enter collage address"
                            name="location" value="" id="address" />
                        <!--end::Input-->
                        <span id="error_address" class="text-danger"></span>


                    </div>
                </form>


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
        </div>
    </div>
</div>
