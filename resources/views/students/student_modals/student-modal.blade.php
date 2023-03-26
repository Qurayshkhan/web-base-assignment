<div class="modal fade" id="studentModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered mw-650px">

        <div class="modal-content">

            <form class="form" action="#" id="studentForm">
                @csrf
                <input type="hidden" name="user_id" id="userId">
                <input type="hidden" name="id" id="id">
                <div class="modal-header" id="kt_modal_new_address_header">

                    <h2>Add New Student</h2>


                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">

                        <span class="svg-icon svg-icon-1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2"
                                    rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                    transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>

                    </div>

                </div>


                <div class="modal-body py-10 px-lg-17">

                    <div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_new_address_header"
                        data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">



                        <div class="row mb-5">

                            <div class="col-md-6 fv-row">

                                <label class="required fs-5 fw-semibold mb-2">Name</label>


                                <input type="text" class="form-control form-control-solid" placeholder=""
                                    name="name" id="name"/>

                            </div>


                            <div class="col-md-6 fv-row">

                                <label class="required fs-5 fw-semibold mb-2">Email</label>


                                <input type="email" class="form-control form-control-solid" placeholder=""
                                    name="email" id="email"/>

                            </div>

                        </div>


                        <div class="d-flex flex-column mb-5 fv-row">

                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span class="required">Select course</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Your payment statements may very based on selected country"></i>
                            </label>


                            <select name="course_id[]" id="courseSelectId" data-control="select2" data-dropdown-parent="#studentModal"
                                data-placeholder="Select a course ..." class="form-select form-select-solid" multiple>
                                <option value="">Select a course...</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>

                        </div>


                        <div class="d-flex flex-column mb-5 fv-row">

                            <label class="required fs-5 fw-semibold mb-2">Address</label>


                            <input class="form-control form-control-solid" placeholder="Enter Address"
                                name="location" id="address"/>

                        </div>


                        <div class="d-flex flex-column mb-5 fv-row">

                            <label class="d-flex align-items-center fs-5 fw-semibold mb-2">
                                <span class="required">Collage</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
                                    title="Your payment statements may very based on selected country"></i>
                            </label>


                            <select name="collage_id" data-control="select2" data-dropdown-parent="#studentModal"
                                data-placeholder="Select a Collage..." class="form-select form-select-solid" multiple id="collageSelectId">
                                <option value="">Select a Collage...</option>
                                @foreach ($collages as $collage)
                                    <option value="{{ $collage->id }}">{{ $collage->user->name }}</option>
                                @endforeach
                            </select>

                        </div>


                        <div class="d-flex flex-column mb-5 fv-row">

                            <label class="fs-5 fw-semibold mb-2">Contact</label>


                            <input class="form-control form-control-solid" placeholder="Enter Contact" name="contact" id="contact"/>

                        </div>


                        <div class="row g-9 mb-5">

                            <div class="col-md-6 fv-row">

                                <label class="fs-5 fw-semibold mb-2">Degree Title</label>


                                <input class="form-control form-control-solid" placeholder="" name="degree_title" id="degreeTitle"/>

                            </div>


                            <div class="col-md-6 fv-row">

                                <label class="fs-5 fw-semibold mb-2">Roll Number</label>


                                <input class="form-control form-control-solid" placeholder="" name="roll_number" id="rollNumber"/>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="modal-footer flex-center">

                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>


                    <button type="submit" id="saveButton" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
