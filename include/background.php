<?php

/**
 * Background Media
 *
 * @package     Library
 * @subpackage  Background
 * @author      rehiy <https://www.rehiy.com>
 * @version     1.0.0
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$media_type = pathinfo($media_url, PATHINFO_EXTENSION);
?>

<?php if (preg_match('/jpeg|jpg|png|gif/i', $media_type)) : ?>

    <div class="background-media">
        <img src="<?php echo $media_url; ?>" width="auto" />
    </div>

    <script type="text/javascript">
        document.querySelector('.main-navigation').style.opacity = 0.9
        document.querySelector('.content-wrap').style.opacity = 0.8
    </script>

<?php elseif (preg_match('/mp4/i', $media_type)) : ?>

    <a class="background-ctrl">
        <i class="glyphicon glyphicon glyphicon-film"></i>
    </a>
    <div class="background-media">
        <video loop muted autoplay width="auto" type="video/mp4" src="<?php echo $media_url; ?>"></video>
    </div>

    <script type="text/javascript">
        var pictureInPicture = false
        var $btn = document.querySelector('.background-ctrl')
        var $bgm = document.querySelector('.background-media')
        var $mp4 = document.querySelector('.background-media video')
        $mp4.addEventListener('play', (event) => {
            $btn.style.display = 'block'
        });
        $mp4.addEventListener('enterpictureinpicture', (event) => {
            $bgm.style.display = 'none'
            pictureInPicture = true
        });
        $mp4.addEventListener('leavepictureinpicture', (event) => {
            $bgm.style.display = 'block'
            pictureInPicture = false
        });
        $btn.addEventListener('click', function() {
            pictureInPicture ? document.exitPictureInPicture() : $mp4.requestPictureInPicture()
        })
        document.querySelector('.main-navigation').style.opacity = 0.9
        document.querySelector('.content-wrap').style.opacity = 0.8
    </script>

<?php endif; ?>