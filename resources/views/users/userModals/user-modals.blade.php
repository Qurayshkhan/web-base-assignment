{{-- Start User Modals --}}




<div class="modal fade" tabindex="-1" id="userModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Add a User</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-1"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">

                <form id="userForm">
                    @csrf
                    <input type="hidden" name="id" id="userId">
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


                    <div class="fv-row mb-7" id="userTypeFeild">

                        <label class="required fs-6 fw-semibold mb-2">Select user type</label>

                        <select class="form-select form-select-solid" aria-label="Select example" id="userType"
                            name="user_type">
                            <option>Select user type</option>

                            <option value="1">Collage</option>
                            <option value="2">Teacher</option>
                            <option value="3">Student</option>


                        </select>
                    </div>

                    <div class="fv-row mb-7">

                        <label class="required fs-6 fw-semibold mb-2">Select Role</label>

                        <select class="form-select form-select-solid" aria-label="Select example" id="roleSelectId"
                            name="role_id">
                            <option>Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach

                        </select>
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





{{-- End User Modals --}}
