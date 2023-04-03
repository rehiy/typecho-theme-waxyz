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
        $('.content-wrap').animate({
            'opacity': 0.8
        }, 1500)
        $('.main-navigation').animate({
            'opacity': 0.9
        }, 1500)
        $('.background-media').animate({
            'opacity': 1
        }, 1500)
    </script>

<?php elseif (preg_match('/video|app/i', $media_type)) : ?>

    <div class="background-ctrls">
        <a class="btn-volume">
            <i class="glyphicon glyphicon-volume-up"></i>
        </a>
        <a class="btn-display">
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
    </div>

    <div class="background-media">
        <video id="bg-media" class="video-js" style="width:100%;height:100%">
            <source src="<?php echo $media_url; ?>" type="<?php echo $media_type; ?>">
        </video>
    </div>

    <script type="text/javascript">
        var player = videojs('bg-media', {
            controls: true,
            autoplay: 'any',
            preload: 'auto',
            loop: true,
        });
        player.on('loadeddata', (event) => {
            $('.content-wrap').animate({
                'opacity': 0.8
            }, 1500)
            $('.main-navigation').animate({
                'opacity': 0.9
            }, 1500)
            $('.background-media, .background-ctrls').animate({
                'opacity': 1
            }, 1500)
            $('.background-ctrls .btn-volume').click(function() {
                player.muted() ? player.muted(false) : player.muted(true)
            })
            $('.background-ctrls .btn-display').click(function() {
                $('.background-media').toggleClass('small')
            })
        });
    </script>

<?php endif; ?>