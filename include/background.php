<?php

/**
 * Background Media
 *
 * @author      rehiy <https://www.rehiy.com>
 * @version     1.0.0
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$media_type = pathinfo($media_url, PATHINFO_EXTENSION);
$media_type = strtolower(trim($media_type));
?>

<?php if (preg_match('/webp|jpeg|jpg|png|gif/i', $media_type)) : ?>

    <div class="background-media">
        <img src="<?php echo $media_url; ?>" width="auto" />
    </div>

    <script type="text/javascript">
        document.querySelector('.main-navigation').style.opacity = 0.9
        document.querySelector('.content-wrap').style.opacity = 0.8
    </script>

<?php elseif (preg_match('/webm|mp4|ogv|m3u8|/i', $media_type)) : ?>

    <a class="background-ctrl">
        <i class="glyphicon glyphicon glyphicon-film"></i>
    </a>

    <div class="background-media">
        <video id="bg-media" class="video-js" style="width:100%;height:100%" loop muted autoplay preload="auto">
            <?php if ($media_type == "webm") { ?>
                <source src="<?php echo $media_url; ?>" type="video/webm">
                </source>
            <?php } elseif ($media_type == "mp4") { ?>
                <source src="<?php echo $media_url; ?>" type="video/mp4">
                </source>
            <?php } elseif ($media_type == "ogv") { ?>
                <source src="<?php echo $media_url; ?>" type="video/ogg">
                </source>
            <?php } elseif ($media_type == "m3u8") { ?>
                <source src="<?php echo $media_url; ?>" type="application/x-mpegURL">
                </source>
            <?php } ?>
        </video>
    </div>

    <script type="text/javascript">
        var player = videojs('bg-media');
        var pictureInPicture = false
        var $ctl = document.querySelector('.background-ctrl')
        var $bgm = document.querySelector('.background-media')
        var $mp4 = document.querySelector('.background-media video')
        $mp4.addEventListener('play', (event) => {
            $ctl.style.display = 'block'
            $bgm.style.display = 'flex'
        });
        $mp4.addEventListener('enterpictureinpicture', (event) => {
            $bgm.style.display = 'none'
            pictureInPicture = true
        });
        $mp4.addEventListener('leavepictureinpicture', (event) => {
            $bgm.style.display = 'block'
            pictureInPicture = false
        });
        $ctl.addEventListener('click', function() {
            pictureInPicture ? document.exitPictureInPicture() : $mp4.requestPictureInPicture()
        })
        document.querySelector('.main-navigation').style.opacity = 0.9
        document.querySelector('.content-wrap').style.opacity = 0.8
    </script>

<?php endif; ?>