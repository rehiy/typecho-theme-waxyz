<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js" lang="zh-CN">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php $this->options->charset(); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="shortcut icon" href="<?php $this->options->faviconUrl(); ?>" type="image/x-icon" />

    <title><?php $this->archiveTitle(array(
                'category'  =>  _t('分类 %s 下的文章'),
                'search'    =>  _t('包含关键字 %s 的文章'),
                'tag'       =>  _t('标签 %s 下的文章'),
                'author'    =>  _t('%s 发布的文章')
            ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <!--Library-->
    <?php if ($this->options->CDN == "local") : ?>
        <link rel="stylesheet" href="<?php $this->options->themeUrl('library/bootstrap.min.css?v3.4.1'); ?>">
        <link rel="stylesheet" href="<?php $this->options->themeUrl('library/jquery.fancybox.min.css?3.5.7'); ?>">
        <link rel="stylesheet" href="<?php $this->options->themeUrl('library/hint.min.css?v2.6.0'); ?>">
        <link rel="stylesheet" href="<?php $this->options->themeUrl('library/video.min.css?7.10.2'); ?>">
        <link rel="stylesheet" href="<?php $this->options->themeUrl('library/viewer.min.css?1.11.3'); ?>">
    <?php else : ?>
        <link rel="stylesheet" href="//<?php echo $this->options->CDN; ?>/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//<?php echo $this->options->CDN; ?>/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
        <link rel="stylesheet" href="//<?php echo $this->options->CDN; ?>/ajax/libs/hint.css/2.6.0/hint.min.css" />
        <link rel="stylesheet" href="//<?php echo $this->options->CDN; ?>/ajax/libs/video.js/7.10.2/video-js.min.css" />
        <link rel="stylesheet" href="//<?php echo $this->options->CDN; ?>/ajax/libs/viewerjs/1.11.3/viewer.min.css" />
    <?php endif; ?>

    <!--公共样式-->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/global.css?v1.3.5'); ?>">

    <!--自定义头部代码-->
    <?php add_custom_header(); ?>

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
</head>

<body>

    <script type="text/javascript">
        <?php
        $Waxyz = [
            'cid' => $this->cid ?? 0,
            'isSingle' => $this->is('single'),
            'archiveType' => $this->archiveType,
            'sticky' => $this->options->sticky,
            'mouseClickEffects' => $this->options->mouseClickEffects,
            'apiPath' => '/apis',
        ];
        ?>
        var Waxyz = <?php echo json_encode($Waxyz); ?>
    </script>

    <?php $this->need('include/loading.html'); ?>
    <?php $this->need('include/navigation.php'); ?>