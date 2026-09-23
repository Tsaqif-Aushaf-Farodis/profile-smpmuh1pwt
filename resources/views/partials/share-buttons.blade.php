@php
    $shareTitle = $shareTitle ?? '';
    $shareUrl = $shareUrl ?? url()->current();
@endphp

<div class="blog-details__share">
    <h5 class="blog-details__share__title">Bagikan</h5>
    <a href="https://wa.me/?text={{ urlencode($shareTitle . ' - ' . $shareUrl) }}" target="_blank" rel="noopener" class="blog-details__share__link" title="Bagikan ke WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}" target="_blank" rel="noopener" class="blog-details__share__link" title="Bagikan ke Facebook">
        <i class="fab fa-facebook-f"></i>
    </a>
    <a href="https://twitter.com/intent/tweet?text={{ urlencode($shareTitle) }}&url={{ urlencode($shareUrl) }}" target="_blank" rel="noopener" class="blog-details__share__link" title="Bagikan ke Twitter/X">
        <i class="fab fa-twitter"></i>
    </a>
    <button type="button" class="blog-details__share__link" title="Salin tautan" onclick="shareCopyLink(this, '{{ $shareUrl }}')">
        <i class="fas fa-link"></i>
    </button>
</div><!-- /.details-share -->
