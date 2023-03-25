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

    <style type="text/css">
        .main-navigation,
        .content-wrap {
            opacity: 0.9;
        }

        .background-media {
            position: fixed;
            top: 0;
            z-index: -1000;
        }
    </style>

<?php elseif (preg_match('/mp4/i', $media_type)) : ?>

    <a class="background-ctrl">
        <i class="glyphicon glyphicon-play"></i>
    </a>
    <div class="background-media">
        <video loop muted autoplay width="auto" type="video/mp4" src="<?php echo $media_url; ?>"></video>
    </div>

    <style type="text/css">
        .main-navigation,
        .content-wrap {
            opacity: 0.9;
        }

        .background-media {
            position: fixed;
            top: 0;
            z-index: -1000;
        }

        .background-ctrl {
            position: fixed;
            right: 25px;
            bottom: 80px;
            background: rgba(244, 100, 95, 0.6);
            color: #ffffff;
            text-align: center;
            border-radius: 6px;
            z-index: 1;
            display: none;
        }

        .background-ctrl:hover {
            background: #f4645f;
            color: #ffffff;
        }

        .background-ctrl i {
            width: 45px;
            height: 45px;
            line-height: 45px;
        }
    </style>

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
    </script>

<?php endif; ?>