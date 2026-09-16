@include('layout.header')

<section class="page-header page-header--bg-two" data-jarallax data-speed="0.3" data-imgPosition="50% -100%">
  <div class="page-header__bg jarallax-img"></div><!-- /.page-header-bg -->
  <div class="page-header__overlay"></div><!-- /.page-header-overlay -->
  <div class="container text-center">
      <h2 class="page-header__title">Artikel</h2><!-- /.page-title -->
      <ul class="page-header__breadcrumb list-unstyled">
          <li><a href="/">Home</a></li>
          <li><span>{{ $article->title }}</span></li>
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
                      <img src="{{ url('storage/' . $article->banner) }}" alt="Berita">
                  </div><!-- details-image -->
                  <div class="blog-details__meta">
                      <div class="blog-details__meta__cats">
                          <a href="blog-list-right.html">{{ $article->category->name }}</a>
                      </div>
                      <div class="blog-details__meta__date"><i class="icon-clock"></i>{{ date('M d, Y', strtotime($article->published_at)) }}</div>
                  </div><!-- /.details-meta -->
                  <h3 class="blog-details__title">{{ $article->title }}</h3>
                 <div class=blog-content>
                     {!! $article->content !!} 
                 </div>
                              
              </div><!-- details-content -->
              <div class="blog-details__bottom">
                  <div class="blog-details__tags">
                      <h5 class="blog-details__tags__title">Tags</h5>
                      @foreach ($article->tags as $tag)
                      <li><a href="#">{{ $tag->name }}</a></li> 
                     @endforeach                 
                  </div>
              
              </div><!-- details-tags-share -->
      
          </div>
      </div>
  </div>
</section>
<!-- Blog End -->

@include('layout.footer')