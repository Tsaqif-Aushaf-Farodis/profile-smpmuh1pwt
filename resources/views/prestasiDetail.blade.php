@include('layout.header');

<section class="page-header page-header--bg-two" data-jarallax data-speed="0.3" data-imgPosition="50% -100%">
  <div class="page-header__bg jarallax-img"></div><!-- /.page-header-bg -->
  <div class="page-header__overlay"></div><!-- /.page-header-overlay -->
  <div class="container text-center">
      <h2 class="page-header__title">Prestasi</h2><!-- /.page-title -->
      <ul class="page-header__breadcrumb list-unstyled">
          <li><a href="/">Home</a></li>
          <li><span>{{ $detail->title }}</span></li>
      </ul><!-- /.page-breadcrumb list-unstyled -->
  </div><!-- /.container -->
</section><!-- /.page-header -->
<!-- Blog Start -->
<section class="blog-details">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-xl-8 col-lg-7">
              <div class="blog-details__content">
                  <div class="blog-details__img">
                      <img src="{{ url('storage/' . $detail->data['content']['image']) }}" alt="Berita">
                  </div><!-- details-image -->
                  <div class="blog-details__meta">
                      <div class="blog-details__meta__cats">
                          {{ $detail->data['content']['juara'] }}
                      </div>
                      <div class="blog-details__meta__date"><i class="icon-clock"></i>{{ date('M d, Y', strtotime($detail->data['content']['date'])) }}</div>
                  </div><!-- /.details-meta -->
                  <h3 class="blog-details__title">{{ $detail->title }}</h3><!-- details-tiele -->
                  <p class="blog-details__text">
                    {!! $detail->data['content']['detail'] !!} 
                  </p>             
              </div><!-- details-content -->
            
      
          </div>
      </div>
  </div>
</section>
<!-- Blog End -->

@include('layout.footer');