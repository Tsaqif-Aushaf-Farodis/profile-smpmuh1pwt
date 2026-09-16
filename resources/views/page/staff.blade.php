<section class="page-header page-header--bg-two" data-jarallax data-speed="0.3" data-imgPosition="50% -100%">
    <div class="page-header__bg jarallax-img"></div><!-- /.page-header-bg -->
    <div class="page-header__overlay"></div><!-- /.page-header-overlay -->
    <div class="container text-center">
        <h2 class="page-header__title">Guru dan Tenaga Kependidikan</h2><!-- /.page-title -->
        <ul class="page-header__breadcrumb list-unstyled">
            <li><a href="/">Home</a></li>
            <li><span>Guru dan Tenaga Kependidikan</span></li>
        </ul><!-- /.page-breadcrumb list-unstyled -->
    </div><!-- /.container -->
</section><!-- /.page-header -->
 <section class="team-page">
            <div class="container">
                <div class="row">
                    @foreach ($staff as $item)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="{{ (100 + $loop->index * 100) }}ms">
                        <div class="team-two__item">
                            <div class="team-two__image">
                                <img src="{{ asset('storage/' . $item->photo) }}" alt="{{ $item->name }}">
                            </div><!-- /.team-image -->
                            <div class="team-two__content">
                                <h3 class="team-two__title">
                                    <a href="#">{{ $item->name }}</a>
                                </h3><!-- /.team-name -->
                                <span class="team-two__designation">{{ $item->position }} {{ $item->mapel }}</span><!-- /.team-designation -->
                                <div class="team-two__social">
                                     <a href="{{ $item->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ $item->instagram }}"><i class="fab fa-instagram"></i></a>
                                </div><!-- /.team-social -->
                            </div><!-- /.team-content -->
                        </div><!-- /.team-two -->
                    </div>
                    @endforeach 
                </div>
            </div>
</section>
