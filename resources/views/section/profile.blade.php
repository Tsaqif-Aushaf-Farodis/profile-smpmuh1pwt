<!-- About Start -->
<section class="about-three" id="{{ Str::before($section->type, '_template') }}">
    <div class="container">
        <div class="row">
            <div class="col-xl-6">
                <div class="about-one__thumb wow fadeInLeft" data-wow-delay="100ms"><!-- about thumb start -->
                    <div class="about-one__thumb__one eduact-tilt" data-tilt-options='{ "glare": false, "maxGlare": 0, "maxTilt": 2, "speed": 700, "scale": 1 }'>
                        <img src="{{ asset('storage/' . $profile[0]['image']) }}" alt="eduact">
                    </div>
                    <div class="about-one__thumb__shape1 wow zoomIn" data-wow-delay="300ms">
                        <img src="assets/images/shapes/about-shape-1-1.png" alt="eduact">
                    </div>
                    <div class="about-one__thumb__shape2 wow zoomIn" data-wow-delay="400ms">
                        <img src="assets/images/shapes/about-shape-1-2.png" alt="eduact">
                    </div>                    
                </div><!-- about thumb end -->
            </div>

             {{-- <div class="col-xl-6 wow fadeInRight" data-wow-delay="100ms">
                <div class="about-three__thumb"><!-- about thumb start -->
                    <div class="about-three__thumb__one eduact-tilt" data-tilt-options='{ "glare": false, "maxGlare": 0, "maxTilt": 2, "speed": 700, "scale": 1 }'>
                        <img src="{{ asset('storage/' . $profile[0]['image']) }}" alt="eduact">
                    </div><!-- /.about-thumb-one -->
                    <div class="about-three__thumb__shape-one"></div><!-- /.about-shape-one -->
                    <div class="about-three__thumb__shape-three"><span></span><span></span><span></span><span></span><span></span></div><!-- /.about-shape-three -->
                    <div class="about-three__thumb__shape-four"><img src="assets/images/shapes/about-3-shape-1.png" alt="eduact" /></div><!-- /.about-shape-four -->
                    <div class="about-three__thumb__shape-five"><span></span><span></span><span></span><span></span><span></span></div><!-- /.about-shape-five -->
                    <div class="about-three__thumb__shape-six"><span></span><span></span><span></span><span></span><span></span></div><!-- /.about-shape-six -->
                    <div class="about-three__thumb__shape-seven"></div><!-- /.about-shape-seven -->
                </div><!-- about thumb end -->
            </div> --}}
            <div class="col-xl-6 wow fadeInLeft" data-wow-delay="100ms">
                <div class="about-three__content"><!-- about content start-->
                    <div class="section-title">
                        <h5 class="section-title__tagline">
                            TENTANG KAMI
                            <svg class="arrow-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55 13">
                                <g clip-path="url(#clip0_324_36194)">
                                    <path d="M10.5406 6.49995L0.700562 12.1799V8.56995L4.29056 6.49995L0.700562 4.42995V0.819946L10.5406 6.49995Z" />
                                    <path d="M25.1706 6.49995L15.3306 12.1799V8.56995L18.9206 6.49995L15.3306 4.42995V0.819946L25.1706 6.49995Z" />
                                    <path d="M39.7906 6.49995L29.9506 12.1799V8.56995L33.5406 6.49995L29.9506 4.42995V0.819946L39.7906 6.49995Z" />
                                    <path d="M54.4206 6.49995L44.5806 12.1799V8.56995L48.1706 6.49995L44.5806 4.42995V0.819946L54.4206 6.49995Z" />
                                </g>
                            </svg>
                        </h5>
                        <h2 class="section-title__title"></h2>
                    </div><!-- section-title -->
                    <p class="about-three__content__text">
                        {{ $profile[0]['profile'] }}
                    </p>
                    <div class="about-two__about-box">
                        <div class="about-two__about-box__top">
                            <div class="about-two__about-box__icon"><span class="icon-logical-thinking"></span></div>
                            <h4 class="about-two__about-box__title">Visi</h4>
                        </div>
                        <p class="about-two__about-box__text">
                            {{ $profile[0]['visi'] }}
                        </p>
                    </div><!-- /.icon-box -->
                    <div class="about-two__about-box">
                        <div class="about-two__about-box__top">
                            <div class="about-two__about-box__icon"><span class="icon-vision"></span></div>
                            <h4 class="about-two__about-box__title">Misi</h4>
                        </div>
                      {!! $profile[0]['misi'] !!}
                    </div><!-- /.icon-box -->
                    <div class="about-three__br"></div>
                   
                </div><!-- about content end -->
            </div>
           
        </div>
    </div>
</section>
<!-- About End -->