
       <!-- Counter Start -->
       <section class="fact-two" style="background-image: url(assets/images/shapes/blog-bg-3.jpg);" id="{{ Str::before($section->type, '_template') }}">
        <div class="container">
            <div class="fact-two__inner" style="background-image: url(assets/images/shapes/fact-bg-inner.png);">
                <div class="row">
                    @foreach ($counters as $counter)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                        <div class="fact-two__item text-center">
                            <div class="fact-two__icon">   
                            @if (isset($counter['icon']))
                                <img src="{{ asset('storage/' . $counter['icon']) }}" alt="icon">
                            @endif
                            </div>
                            <div class="fact-two__count">
                                <span class="count-box">
                                    <span class="count-text" data-stop="{{ $counter['count'] }}" data-speed="1500"></span>
                                </span>
                            </div><!-- /.fact-two__count -->
                            <h3 class="fact-two__title">{{ $counter['title'] }}</h3><!-- /.fact-two__title -->
                        </div><!-- /.fact-item -->
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Counter End -->