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
