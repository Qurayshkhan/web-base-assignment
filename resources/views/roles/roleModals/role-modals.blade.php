<div class="modal fade" tabindex="-1" id="roleModal">
    <div class="modal-dialog  modal-dialog-scrollable mw-850px">
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

                        <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label> <span class="text-danger"
                            id="error_permissions"></span>


                        <div class="table-responsive">

                            <table class="table align-middle table-row-dashed fs-6 gy-5">

                                <tbody class="text-gray-600 fw-semibold">
                                    @can(\App\Helpers\Permissions::VIEW_USER)
                                    <tr>

                                        <td class="text-gray-800">User Management</td>

                                        <td>

                                            <div class="d-flex">

                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="user" type="checkbox"
                                                        value="user" name="permissions[]" />
                                                    <span class="form-check-label">User</span>
                                                </label>

                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="view_user" type="checkbox"
                                                        value="view_user" name="permissions[]" />
                                                    <span class="form-check-label">view</span>
                                                </label>


                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="delete_user" type="checkbox"
                                                        value="delete_user" name="permissions[]" />
                                                    <span class="form-check-label">delete</span>
                                                </label>


                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="create_user" type="checkbox"
                                                        value="create_user" name="permissions[]" />
                                                    <span class="form-check-label">create</span>
                                                </label>



                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" id="edit_user" type="checkbox"
                                                        value="edit_user" name="permissions[]" />
                                                    <span class="form-check-label">edit</span>
                                                </label>

                                            </div>

                                        </td>

                                    </tr>
                                    @endcan
                                    @can(\App\Helpers\Permissions::VIEW_COLLAGE)
                                    <tr>

                                        <td class="text-gray-800">Collage Management</td>

                                        <td>

                                            <div class="d-flex">

                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="collage" type="checkbox"
                                                        value="collage" name="permissions[]" />
                                                    <span class="form-check-label">Collage</span>
                                                </label>
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="create_collage" type="checkbox"
                                                        value="create_collage" name="permissions[]" />
                                                    <span class="form-check-label">create</span>
                                                </label>
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="view_collage" type="checkbox"
                                                        value="view_collage" name="permissions[]" />
                                                    <span class="form-check-label">view</span>
                                                </label>


                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="delete_collage" type="checkbox"
                                                        value="delete_collage" name="permissions[]" />
                                                    <span class="form-check-label">delete</span>
                                                </label>


                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" id="edit_collage" type="checkbox"
                                                        value="edit_collage" name="permissions[]" />
                                                    <span class="form-check-label">edit</span>
                                                </label>

                                            </div>

                                        </td>

                                    </tr>
                                    @endcan

                                    <tr>

                                        <td class="text-gray-800">Teacher Managment</td>

                                        <td>

                                            <div class="d-flex">

                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="teacher" type="checkbox"
                                                        value="teacher" name="permissions[]" />
                                                    <span class="form-check-label">Teacher</span>
                                                </label>
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="create_teacher"
                                                        type="checkbox" value="create_teacher"
                                                        name="permissions[]" />
                                                    <span class="form-check-label">create</span>
                                                </label>
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="view_teacher" type="checkbox"
                                                        value="view_teacher" name="permissions[]" />
                                                    <span class="form-check-label">view</span>
                                                </label>


                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="delete_teacher"
                                                        type="checkbox" value="delete_teacher"
                                                        name="permissions[]" />
                                                    <span class="form-check-label">delete</span>
                                                </label>


                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" id="edit_teacher" type="checkbox"
                                                        value="edit_teacher" name="permissions[]" />
                                                    <span class="form-check-label">edit</span>
                                                </label>

                                            </div>

                                        </td>

                                    </tr>
                                    <tr>

                                        <td class="text-gray-800">Student Managment</td>

                                        <td>

                                            <div class="d-flex">

                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="student" type="checkbox"
                                                        value="student" name="permissions[]" />
                                                    <span class="form-check-label">Student</span>
                                                </label>
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="create_student"
                                                        type="checkbox" value="create_student"
                                                        name="permissions[]" />
                                                    <span class="form-check-label">create</span>
                                                </label>
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="view_student" type="checkbox"
                                                        value="view_student" name="permissions[]" />
                                                    <span class="form-check-label">view</span>
                                                </label>


                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="delete_student"
                                                        type="checkbox" value="delete_student"
                                                        name="permissions[]" />
                                                    <span class="form-check-label">delete</span>
                                                </label>


                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" id="edit_student" type="checkbox"
                                                        value="edit_student" name="permissions[]" />
                                                    <span class="form-check-label">edit</span>
                                                </label>

                                            </div>

                                        </td>

                                    </tr>
                                    <tr>

                                        <td class="text-gray-800">Course Managment</td>

                                        <td>

                                            <div class="d-flex">

                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="course" type="checkbox"
                                                        value="course" name="permissions[]" />
                                                    <span class="form-check-label">Course</span>
                                                </label>
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="create_course"
                                                        type="checkbox" value="create_course" name="permissions[]" />
                                                    <span class="form-check-label">create</span>
                                                </label>
                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="view_course" type="checkbox"
                                                        value="view_course" name="permissions[]" />
                                                    <span class="form-check-label">view</span>
                                                </label>


                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                    <input class="form-check-input" id="delete_course"
                                                        type="checkbox" value="delete_course" name="permissions[]" />
                                                    <span class="form-check-label">delete</span>
                                                </label>


                                                <label
                                                    class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" id="edit_course" type="checkbox"
                                                        value="edit_course" name="permissions[]" />
                                                    <span class="form-check-label">edit</span>
                                                </label>




                                            </div>

                                        </td>

                                    </tr>
                                    <tr>



                                        <td>
                                            <div class="d-flex">
                                        <td class="d-flex">
                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" id="upload_file" type="checkbox"
                                                    value="upload_file" name="permissions[]" />
                                                <span class="form-check-label">File upload</span>
                                            </label>
                                        </td>
                        </div>
                        </td>
                        </tr>
                        <tr>

                            <td class="text-gray-800">Role Managment</td>

                            <td>

                                <div class="d-flex">

                                    <label
                                        class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                        <input class="form-check-input" id="roles" type="checkbox"
                                            value="roles" name="permissions[]" />
                                        <span class="form-check-label">Roles</span>
                                    </label>
                                    <label
                                        class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                        <input class="form-check-input" id="create_role"
                                            type="checkbox" value="create_role" name="permissions[]" />
                                        <span class="form-check-label">create</span>
                                    </label>
                                    <label
                                        class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                        <input class="form-check-input" id="view_role" type="checkbox"
                                            value="view_role" name="permissions[]" />
                                        <span class="form-check-label">view</span>
                                    </label>


                                    <label
                                        class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                        <input class="form-check-input" id="delete_role"
                                            type="checkbox" value="delete_role" name="permissions[]" />
                                        <span class="form-check-label">delete</span>
                                    </label>


                                    <label
                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" id="edit_role" type="checkbox"
                                            value="edit_role" name="permissions[]" />
                                        <span class="form-check-label">edit</span>
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
