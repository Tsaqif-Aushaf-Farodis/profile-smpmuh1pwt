<section class="page-header page-header--bg-two" data-jarallax data-speed="0.3" data-imgPosition="50% -100%">
    <div class="page-header__bg jarallax-img"></div><!-- /.page-header-bg -->
    <div class="page-header__overlay"></div><!-- /.page-header-overlay -->
    <div class="container text-center">
        <h2 class="page-header__title">{{ $page->title }}</h2><!-- /.page-title -->
        <ul class="page-header__breadcrumb list-unstyled">
            <li><a href="/">Home</a></li>
            <li><span>{{ $page->title }}</span></li>
        </ul><!-- /.page-breadcrumb list-unstyled -->
    </div><!-- /.container -->
</section><!-- /.page-header -->

   <!-- program Start -->
   <section class="service-two" style="background-image: url(assets/images/shapes/service-bg-3.png);">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title wow fadeInLeft" data-wow-delay="100ms">
                    <h5 class="section-title__tagline">
                        Program Unggulan
                        <svg class="arrow-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55 13">
                            <g clip-path="url(#clip0_324_36194)">
                                <path d="M10.5406 6.49995L0.700562 12.1799V8.56995L4.29056 6.49995L0.700562 4.42995V0.819946L10.5406 6.49995Z" />
                                <path d="M25.1706 6.49995L15.3306 12.1799V8.56995L18.9206 6.49995L15.3306 4.42995V0.819946L25.1706 6.49995Z" />
                                <path d="M39.7906 6.49995L29.9506 12.1799V8.56995L33.5406 6.49995L29.9506 4.42995V0.819946L39.7906 6.49995Z" />
                                <path d="M54.4206 6.49995L44.5806 12.1799V8.56995L48.1706 6.49995L44.5806 4.42995V0.819946L54.4206 6.49995Z" />
                            </g>
                        </svg>
                    </h5>
                    
                </div><!-- section-title -->
            </div>
         
        </div>
        <div class="row justify-content-md-center">
            @foreach ($program as $item)
            <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay="{{ (200 + $loop->index * 100) }}ms">
                <div class="service-three__item text-center">
                    <div class="service-three__wrapper">
                        <div class="service-three__hover"></div><!-- /.service-icon -->
                        <div class="service-three__icon">
                            @if (isset($item->data['content']['icon']))
                                <img src="{{ asset('storage/' . $item->data['content']['icon']) }}" alt="icon">
                            @endif
                        </div><!-- /.service-icon -->
                        <h3 class="service-three__title">
                            <a href="{{ route('program', ['slug' => $item->slug]) }}">{{$item->title}}</a>
                        </h3><!-- /.service-title -->
                        <p class="service-three__text"></p><!-- /.service-content -->
                        <div class="service-three__br"></div>
                        <a class="service-three__rm" href="{{ route('program', ['slug' => $item->slug]) }}"></a>
                    </div>
                </div><!-- /.service-card-three -->
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- program End -->