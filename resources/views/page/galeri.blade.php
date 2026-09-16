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

 <!-- gallery-start -->
 <section class="gallery-page" >

    <div class="container">
        <div class="row">
            @foreach ($galeri as $item)
            <!-- gallery-item-start -->
                @foreach ($item->image as $gambar)
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-page__single">
                        <img src="{{ asset('storage/' . $gambar) }}" alt="{{ $item->title }}">
                        <div class="gallery-page__icon">
                            <a class="img-popup" href="{{ asset('storage/' . $gambar) }}"></a>
                        </div>
                        <div class="galeri-title">{{ $item->title }}</div>
                    </div>
                </div>
            <!-- gallery-item-end -->
                @endforeach
            @endforeach
        </div>
    </div>
</section>
<!-- gallery-end-->