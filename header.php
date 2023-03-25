<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js" lang="zh-CN">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php $this->options->charset(); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="shortcut icon" href="<?php $this->options->faviconUrl(); ?>" type="image/x-icon" />

    <!-- title -->
    <title><?php $this->archiveTitle(array(
                'category'  =>  _t('分类 %s 下的文章'),
                'search'    =>  _t('包含关键字 %s 的文章'),
                'tag'       =>  _t('标签 %s 下的文章'),
                'author'    =>  _t('%s 发布的文章')
            ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <!-- title END -->

    <!--staticfile-->
    <?php if (strcmp($this->options->CDN, "staticfile") == 0) : ?>
        <link rel="stylesheet" href="//cdn.staticfile.org/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.staticfile.org/fancybox/3.5.7/jquery.fancybox.min.css">
    <?php endif; ?>
    <!--staticfile END-->

    <!--bootcss-->
    <?php if (strcmp($this->options->CDN, "bootcss") == 0) : ?>
        <link rel="stylesheet" href="//cdn.bootcdn.net/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.bootcdn.net/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">
    <?php endif; ?>
    <!--bootcss END-->

    <!--jsdelivr-->
    <?php if (strcmp($this->options->CDN, "jsdelivr") == 0) : ?>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    <?php endif; ?>
    <!--jsdelivr END-->

    <!--local-->
    <?php if (strcmp($this->options->CDN, "local") == 0) : ?>
        <link rel="stylesheet" href="<?php $this->options->themeUrl('library/bootstrap.min.css?v3.4.1'); ?>">
        <link rel="stylesheet" href="<?php $this->options->themeUrl('library/jquery.fancybox.min.css'); ?>">
    <?php endif; ?>
    <!--local END-->

    <!--代码高亮-->
    <?php if ($this->options->codeHighlightControl) : ?>
        <link rel="stylesheet" href="<?php $this->options->themeUrl('library/prism/css/') . $this->options->codeHighlightTheme(); ?>" />
    <?php endif; ?>
    <!--END-->

    <!-- 其他样式 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/hint.min.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->themeUrl('assets/waxyz.css'); ?>">
    <!--local END-->

    <!--自定义头部代码-->
    <?php add_custom_header(); ?>
    <!--END-->

    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
</head>

<body class="home-template">
    <!-- start loading -->
    <?php include __DIR__ . '/include/loading.html'; ?>
    <!-- end loading -->

    <!-- start navigation -->
    <?php include __DIR__ . '/include/navigation.php'; ?>
    <!-- end navigation -->