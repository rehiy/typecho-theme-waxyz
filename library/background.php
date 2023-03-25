<?php

/**
 * Background Media
 *
 * @package     Library
 * @subpackage  Background
 * @author      rehiy <https://www.rehiy.com>
 * @version     1.0.0
 */

$media_type = pathinfo($media_url, PATHINFO_EXTENSION);

?>

<style>
    .content-wrap {
        opacity: 0.9;
    }
</style>

<div style="position: fixed; top: 0; z-index: -1000;">
    <?php if (preg_match('/jpeg|jpg|png|gif/i', $media_type)) : ?>
        <img src="<?php echo $media_url; ?>" width="auto" />
    <?php elseif (preg_match('/mp4/i', $media_type)) : ?>
        <video loop muted autoplay width="auto" type="video/mp4" src="<?php echo $media_url; ?>"></video>
    <?php endif; ?>
</div>