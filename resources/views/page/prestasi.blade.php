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


 <!-- Blog Start -->
 <section class="blog-page">
    <div class="container">
        <div class="row">
            @foreach ($prestasi as $item)
            <div class="col-xl-4 col-md-6 wow fadeInUp" data-wow-delay="{{ (100 + $loop->index * 100) }}ms">
                <div class="blog-two__item">
                    <div class="blog-two__image">
                        <img src="{{ asset('storage/' . $item->data['content']['image']) }}" alt="eduact">
                        <a href="{{ route('prestasi', ['slug' => $item->slug]) }}"></a>
                    </div><!-- /.blog-image -->
                    <div class="blog-two__content">
                        <div class="blog-two__top-meta">
                            <div class="blog-two__cats"><a href="{{ route('prestasi', ['slug' => $item->slug]) }}">{{$item->data['content']['juara']}}</a></div><!-- /.blog-cats -->
                            <div class="blog-two__date">{{$item->data['content']['date']}}</div><!-- /.blog-date -->
                        </div>
                        <h3 class="blog-two__title">
                            <a href="{{ route('prestasi', ['slug' => $item->slug]) }}">{{$item->title}}</a>
                        </h3><!-- /.blog-title -->
                        <div class="blog-two__meta">
                            <div class="blog-two__meta__author">
                                <a href="{{ route('prestasi', ['slug' => $item->slug]) }}">{{$item->data['content']['lomba']}}</a>
                                Detail
                            </div>
                            <a class="blog-two__rm" href="{{ route('prestasi', ['slug' => $item->slug]) }}"><span class="icon-arrow"></span></a><!-- /.read-more-btn -->
                        </div><!-- /.blog-meta -->
                    </div><!-- /.blog-content -->
                </div><!-- /.blog-card-one -->
            </div>
            @endforeach
        </div>       
    </div>
</section>
<!-- Blog End -->