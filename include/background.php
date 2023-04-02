<?php

/**
 * Background Media
 *
 * @author      rehiy <https://www.rehiy.com>
 * @version     1.0.0
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

[$media_type, $media_url] = explode(',', $media_url, 2);
[$media_type, $media_url]  = [trim($media_type), trim($media_url)];
?>

<?php if (preg_match('/image/i', $media_type)) : ?>

    <div class="background-media">
        <img src="<?php echo $media_url; ?>" width="auto" />
    </div>

    <script type="text/javascript">
        document.querySelector('.main-navigation').style.opacity = 0.9
        document.querySelector('.content-wrap').style.opacity = 0.8
    </script>

<?php elseif (preg_match('/video|app/i', $media_type)) : ?>

    <a class="background-ctrl">
        <i class="glyphicon glyphicon glyphicon-film"></i>
    </a>

    <div class="background-media">
        <video id="bg-media" class="video-js" style="width:100%;height:100%">
            <source src="<?php echo $media_url; ?>" type="<?php echo $media_type; ?>">
        </video>
    </div>

    <script type="text/javascript">
        var player = videojs('bg-media', {
            controls: true,
            autoplay: "any",
            preload: 'auto',
            loop: true,
        });
        var $ctl = document.querySelector('.background-ctrl')
        var $bgm = document.querySelector('.background-media')
        player.on('loadeddata', (event) => {
            document.querySelector('.main-navigation').style.opacity = 0.9
            document.querySelector('.content-wrap').style.opacity = 0.8
            $ctl.style.display = 'block'
            $bgm.style.opacity = 1
        });
        $ctl.addEventListener('click', function() {
            $bgm.classList.contains('small') ? $bgm.classList.remove('small') : $bgm.classList.add('small')
        })
    </script>

<?php endif; ?>