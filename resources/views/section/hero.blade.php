       <!--Hero Banner Start-->    
       <section class="hero-banner" style="background-image: url(assets/images/shapes/banner-bg-1.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-banner__content">
                        <div class="hero-banner__bg-shape1 wow zoomIn" data-wow-delay="300ms">
                            <div class="hero-banner__bg-round">
                                <div class="hero-banner__bg-round-border"></div>
                            </div>
                        </div>
                        <h3 class="hero-banner__title wow fadeInUp" data-wow-delay="400ms">{{ $hero[0]['title'] }}</h3>
                        <p class="hero-banner__text wow fadeInUp" data-wow-delay="500ms">
                            {{ $hero[0]['detail'] }}
                            <img src="{{ asset('assets/images/shapes/banner-1-shape-1.png') }}" alt="eduact">
                        </p>
                        <div class="hero-banner__btn wow fadeInUp" data-wow-delay="600ms">
                            <a href="https://ppdb.smpmuh1pwt.my.id/" class="eduact-btn eduact-btn-second" target="_blank"><span class="eduact-btn__curve"></span>Daftar PPDB<i class="icon-arrow"></i></a>
                            <a href="https://smpmuh1pwt.my.id/kontak-kami" class="eduact-btn"><span class="eduact-btn__curve"></span>Hubungi Kami<i class="icon-arrow"></i></a>
                        </div><!-- banner-btn -->
                    </div><!-- banner-content -->
                </div>
                <div class="col-lg-6">
                    <div class="hero-banner__thumb wow fadeInUp" data-wow-delay="700ms">
                        <img src="{{ asset('storage/' . $hero[0]['image']) }}" alt="eduact">
                        <div class="hero-banner__cap wow slideInDown" data-wow-delay="800ms"><img src="{{ asset('assets/images/shapes/banner-cap.png') }}" alt="eduact"></div><!-- banner-cap -->
                        <div class="hero-banner__star wow slideInDown" data-wow-delay="850ms"><img src="{{ asset('assets/images/shapes/banner-star.png') }}" alt="eduact"></div><!-- banner-star -->
                        <div class="hero-banner__map wow slideInDown" data-wow-delay="900ms"><img src="{{ asset('assets/images/shapes/banner-map.png') }}" alt="eduact"></div><!-- banner-map -->
                        <div class="hero-banner__video wow zoomIn" data-wow-delay="950ms" style="background-image: url(assets/images/resources/youtube.png);">
                            <a href="{{ $hero[0]['video'] }}" class="video-popup"><span class="icon-play"></span></a>
                        </div><!-- banner-video -->
                        <div class="hero-banner__book wow slideInUp" data-wow-delay="1000ms"><img src="{{ asset('assets/images/shapes/banner-book.png') }}" alt="eduact"></div><!-- banner-book -->
                        <div class="hero-banner__star2 wow slideInUp" data-wow-delay="1050ms"><img src="{{ asset('assets/images/shapes/banner-star2.png') }}" alt="eduact"></div><!-- banner-star -->
                     
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-banner__border wow fadeInUp" data-wow-delay="1100ms"></div><!-- banner-border -->
    </section>
    <!--Hero Banner End--> 