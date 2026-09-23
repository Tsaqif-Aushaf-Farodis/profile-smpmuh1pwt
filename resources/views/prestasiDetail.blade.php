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

              <div class="blog-details__comment" id="komentar">
                  <h3 class="blog-details__comment__title">Komentar ({{ $comments->count() }})</h3>

                  @forelse ($comments as $comment)
                      <div class="blog-details__comment__item" style="padding-left: 0;">
                          <div class="blog-details__comment__content">
                              <h3 class="blog-details__comment__name">{{ $comment->name }}</h3>
                              <div class="blog-details__meta__date" style="margin-bottom: 10px;">
                                  <i class="icon-clock"></i>{{ $comment->created_at->format('d M Y, H:i') }} WIB
                              </div>
                              <p class="blog-details__comment__text">{{ $comment->content }}</p>
                          </div>
                      </div>
                  @empty
                      <p>Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                  @endforelse
              </div><!-- details-comment -->

              <div class="blog-details__comment-form">
                  <h3 class="blog-details__comment-form__title">Tinggalkan Komentar</h3>

                  @if (session('comment_status'))
                      <p style="color: var(--eduact-secondary); font-weight: 600;">{{ session('comment_status') }}</p>
                  @endif

                  <form action="{{ route('prestasi.comment.store', ['slug' => $detail->slug]) }}" method="POST">
                      @csrf
                      <div class="row">
                          <div class="col-lg-12">
                              <div class="blog-details__comment-form__input-box">
                                  <input type="text" name="name" placeholder="Nama Anda" value="{{ old('name') }}" required>
                                  @error('name')
                                      <small style="color: red;">{{ $message }}</small>
                                  @enderror
                              </div>
                          </div>
                          <div class="col-lg-12">
                              <div class="blog-details__comment-form__input-box">
                                  <textarea name="content" placeholder="Tulis komentar Anda" required>{{ old('content') }}</textarea>
                                  @error('content')
                                      <small style="color: red;">{{ $message }}</small>
                                  @enderror
                              </div>
                          </div>
                          <div style="position: absolute; left: -9999px;" aria-hidden="true">
                              <label>Website</label>
                              <input type="text" name="website" tabindex="-1" autocomplete="off">
                          </div>
                      </div>
                      <button type="submit" class="eduact-btn"><span class="eduact-btn__curve"></span>Kirim Komentar<i class="icon-arrow"></i></button>
                  </form>
              </div><!-- details-comment-form -->

          </div>
      </div>
  </div>
</section>
<!-- Blog End -->

@include('layout.footer');