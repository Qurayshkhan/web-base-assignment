<div class="row gy-0 gx-5 gx-xl-8">

    @foreach ($courses as $course)
        <div class="col-xl-4">
            <div class="card card-xl-stretch mb-5 mb-xl-0">
                <div class="card-body d-flex flex-column pb-10 pb-lg-15">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center pe-2 mb-5">
                            <span class="text-muted fw-bold fs-5 flex-grow-1">{{$course->name}}</span>
                            <div class="symbol symbol-50px">
                                <span class="symbol-label bg-light">
                                    <img src="assets/media/svg/brand-logos/plurk.svg" class="h-50 align-self-center"
                                        alt="">
                                </span>
                            </div>
                        </div>
                        <a href="#" class="text-dark fw-bold text-hover-primary fs-4">PitStop - Multiple Email
                            Generator</a>
                        <p class="py-3">Pitstop creates quick email campaigns.
                            <br>We help to strengthen your brand.
                        </p>
                    </div>
                    <div class="d-flex align-items-center">
                        <a href="#" class="symbol symbol-35px me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Assignment">
                            <i class="fa-solid fa-book-open text-dark fs-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
