<div class="modal fade" tabindex="-1" id="roleModal">
    <div class="modal-dialog  modal-dialog-scrollable mw-750px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add a Role</h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x"></span>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <form id="roleForm">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fs-6 fw-semibold mb-2">Name</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" placeholder="Enter user name"
                            name="role_name" value="" />
                        <!--end::Input-->
                        <span class="text-danger" id="error_role_name"></span>
                    </div>



                    <div class="fv-row">

                        <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>   <span class ="text-danger" id="error_permissions"></span>


                        <div class="table-responsive">

                            <table class="table align-middle table-row-dashed fs-6 gy-5">

                                <tbody class="text-gray-600 fw-semibold">

                                    <tr>

                                        <td class="text-gray-800">User Management</td>

                                        <td>

                                            <div class="d-flex">

                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="view_user" type="checkbox" value="view_user"
                                                        name="permissions[]" />
                                                    <span class="form-check-label">View</span>
                                                </label>


                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="delete_user" type="checkbox" value="delete_user"
                                                        name="permissions[]" />
                                                    <span class="form-check-label">Delete</span>
                                                </label>


                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="create_user" type="checkbox" value="create_user"
                                                        name="permissions[]" />
                                                    <span class="form-check-label">Create</span>
                                                </label>



                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" id="edit_user" type="checkbox" value="edit_user"
                                                        name="permissions[]" />
                                                    <span class="form-check-label">Edit</span>
                                                </label>

                                            </div>

                                        </td>

                                    </tr>

                                </tbody>
                            </table>

                        </div>


                    </div>


                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="closeButton">Close</button>
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
