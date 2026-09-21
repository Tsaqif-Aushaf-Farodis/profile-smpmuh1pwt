@php
    $shareUrl = route('article', ['slug' => $article->slug]);
    $metaDescription = $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 155);
    $bannerFile = $article->banner ? \Illuminate\Support\Facades\Storage::disk('public')->path($article->banner) : null;
    $bannerInfo = $bannerFile && is_file($bannerFile) ? @getimagesize($bannerFile) : false;
@endphp

@include('layout.header', [
    'metaTitle' => $article->title . ' - SMP Muhammadiyah 1 Purwokerto',
    'metaDescription' => $metaDescription,
    'metaImage' => $article->banner_url ?: asset('assets/images/logo.png'),
    'metaImageWidth' => $bannerInfo[0] ?? null,
    'metaImageHeight' => $bannerInfo[1] ?? null,
    'metaImageType' => $bannerInfo['mime'] ?? null,
    'metaType' => 'article',
    'metaUrl' => $shareUrl,
])

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
              
                  <div class="blog-details__share">
                      <h5 class="blog-details__share__title">Bagikan</h5>
                      <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . $shareUrl) }}" target="_blank" rel="noopener" class="blog-details__share__link" title="Bagikan ke WhatsApp">
                          <i class="fab fa-whatsapp"></i>
                      </a>
                      <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" rel="noopener" class="blog-details__share__link" title="Bagikan ke Facebook">
                          <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode($shareUrl) }}" target="_blank" rel="noopener" class="blog-details__share__link" title="Bagikan ke Twitter/X">
                          <i class="fab fa-twitter"></i>
                      </a>
                      <button type="button" class="blog-details__share__link" title="Salin tautan" onclick="shareCopyLink(this, '{{ $shareUrl }}')">
                          <i class="fas fa-link"></i>
                      </button>
                  </div><!-- /.details-share -->

              </div><!-- details-tags-share -->

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

                  <form action="{{ route('article.comment.store', ['slug' => $article->slug]) }}" method="POST">
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

@include('layout.footer')

<style>
    .blog-details__share {
        position: relative;
        margin-top: 30px;
    }
    .blog-details__share__title {
        font-size: 20px;
        margin: 0 0 15px;
    }
    .blog-details__share__link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--eduact-soft5);
        color: var(--eduact-text);
        font-size: 16px;
        margin-right: 10px;
        border: none;
        cursor: pointer;
        transition: 0.3s;
    }
    .blog-details__share__link:hover {
        background-color: var(--eduact-secondary);
        color: var(--eduact-white);
    }
</style>

<script>
    function shareCopyLink(button, url) {
        function showCopied() {
            var icon = button.querySelector('i');
            icon.classList.remove('fa-link');
            icon.classList.add('fa-check');
            setTimeout(function () {
                icon.classList.remove('fa-check');
                icon.classList.add('fa-link');
            }, 1500);
        }

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(url).then(showCopied);
            return;
        }

        // Fallback for non-secure (HTTP) contexts where the Clipboard API is unavailable.
        var textarea = document.createElement('textarea');
        textarea.value = url;
        textarea.style.position = 'fixed';
        textarea.style.left = '-9999px';
        document.body.appendChild(textarea);
        textarea.focus();
        textarea.select();
        try {
            document.execCommand('copy');
            showCopied();
        } catch (e) {
            window.prompt('Salin tautan berikut:', url);
        }
        document.body.removeChild(textarea);
    }
</script>