   <!-- program Start -->
   <section class="service-two"  id="{{ Str::before($section->type, '_template') }}" style="background-image: url(assets/images/shapes/service-bg-3.png);">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title wow fadeInLeft" data-wow-delay="100ms">
                    <h5 class="section-title__tagline">
                        Mengapa Pilih Kami?
                        <svg class="arrow-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55 13">
                            <g clip-path="url(#clip0_324_36194)">
                                <path d="M10.5406 6.49995L0.700562 12.1799V8.56995L4.29056 6.49995L0.700562 4.42995V0.819946L10.5406 6.49995Z" />
                                <path d="M25.1706 6.49995L15.3306 12.1799V8.56995L18.9206 6.49995L15.3306 4.42995V0.819946L25.1706 6.49995Z" />
                                <path d="M39.7906 6.49995L29.9506 12.1799V8.56995L33.5406 6.49995L29.9506 4.42995V0.819946L39.7906 6.49995Z" />
                                <path d="M54.4206 6.49995L44.5806 12.1799V8.56995L48.1706 6.49995L44.5806 4.42995V0.819946L54.4206 6.49995Z" />
                            </g>
                        </svg>
                    </h5>
                    <h2 class="section-title__title">{{ $program[0]['title'] }}</h2>
                </div><!-- section-title -->
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="100ms">
                <p class="service-three__section-text">
                    {{ $program[0]['detail'] }}
                </p>
            </div>
        </div>
        <div class="row justify-content-md-center">
            @foreach ($unggulan as $item)
            <div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="{{ (200 + $loop->index * 100) }}ms">
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