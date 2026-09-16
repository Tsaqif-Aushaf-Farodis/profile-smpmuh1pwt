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
            <div class="row justify-content-center">
                <div class="col-xl-8 col-lg-7">
                    <div class="row">
                        @foreach ($berita as $item)
                        <div class="col-xl-12 col-lg-12 col-md-12 wow fadeInUp" data-wow-delay="{{ (100 + $loop->index * 100) }}ms">
                            <div class="blog-two__item blog-two__item--list">
                                <div class="blog-two__image">
                                    <img src="{{ asset('storage/' . $item->banner) }}" height="200px" alt="berita">
                                    <a href="{{ route('article', ['slug' => $item->slug]) }}"></a>
                                </div><!-- /.blog-image -->
                                <div class="blog-two__content">
                                    <div class="blog-two__top-meta">
                                        <div class="blog-two__cats"><a href="{{ route('article', ['slug' => $item->slug]) }}">{{ $item->category->name }}</a></div><!-- /.blog-cats -->
                                        <div class="blog-two__date"><i class="icon-clock"></i>{{ date('d M Y', strtotime($item->published_at)) }}</div><!-- /.blog-date -->
                                    </div>
                                    <h3 class="blog-two__title">
                                        <a href="{{ route('article', ['slug' => $item->slug]) }}">{{ $item->title }}</a>
                                    </h3><!-- /.blog-title -->
                                    <p class="blog-two__text">
                                         {{ $item->excerpt }}  <a href="{{ route('article', ['slug' => $item->slug]) }}">Read more...</a>
                                    </p><!-- /.blog-content -->
                                    <div class="blog-two__meta">
                                        <div class="blog-two__meta__author">
                                            <img src="{{ asset('storage/' . $item->author->photo) }}" alt="eduact" />
                                            <a href="{{ route('article', ['slug' => $item->slug]) }}">{{$item->author->name}}</a>
                                            Author
                                        </div>
                                        <a class="blog-two__rm" href="{{ route('article', ['slug' => $item->slug]) }}"><span class="icon-arrow"></span></a><!-- /.read-more-btn -->
                                    </div><!-- /.blog-meta -->
                                </div><!-- /.blog-content -->
                            </div><!-- /.blog-two-one -->
                        </div>
                       @endforeach
                    </div>
                   
                </div>
            </div>
        </div>
    </section>
    <!-- Blog End -->