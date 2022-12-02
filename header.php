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

    <!-- Loading -->
    <?php include __DIR__ . '/lib/loading.html'; ?>
    <!-- Loading END -->

    <!--staticfile-->
    <?php if (strcmp($this->options->CDN, "staticfile") == 0) : ?>
        <link rel="stylesheet" href="//cdn.staticfile.org/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdn.staticfile.org/fancybox/3.5.7/jquery.fancybox.min.css">
    <?php endif; ?>
    <!--staticfile END-->

    <!--75cdn-->
    <?php if (strcmp($this->options->CDN, "75cdn") == 0) : ?>
        <link rel="stylesheet" href="//lib.baomitu.com/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="//lib.baomitu.com/fancybox/3.5.7/jquery.fancybox.min.css">
    <?php endif; ?>
    <!--75cdn END-->

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
        <link rel="stylesheet" href="<?php $this->options->themeUrl('css/bootstrap.min.css?v3.4.1'); ?>">
        <link rel="stylesheet" href="<?php $this->options->themeUrl('css/jquery.fancybox.min.css'); ?>">
    <?php endif; ?>
    <!--local END-->

    <!-- 使用url函数转换相关路径 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('css/waxyz.css?v2.0.3'); ?>">

    <!--代码高亮-->
    <?php if ($this->options->codeHighlightControl) : ?>
        <link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('lib/prism/css/'); ?><?php $this->options->codeHighlightTheme(); ?>" />
    <?php endif; ?>
    <!--END-->

    <!--自定义CSS-->
    <?php add_custom_css($this); ?>
    <!--END-->
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
</head>

<body class="home-template">
    <!-- start navigation -->
    <nav class="main-navigation">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="container">
                        <div class="menu menu-logo">
                            <a class="navbar-brand menu-title" href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->description() ?>">
                                <?php if (!empty($this->options->logoUrl)) { ?>
                                    <img src="<?php $this->options->logoUrl(); ?>" height="45" style="margin: -15px -15px 35px 0px;" alt="<?php $this->options->title(); ?>">
                                <?php } else {
                                    $this->options->title();
                                } ?>
                            </a>
                        </div>

                        <div class="navbar-header">
                            <?php if ($this->options->navbarSearch) : ?>
                                <div class="nav-toggle-search">
                                    <form method="post" action="<?php $this->options->siteUrl(); ?>" class="" role="search">
                                        <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
                                        <input aria-label="search input" type="text" name="s" class="text asearch" placeholder="<?php _e('输入关键字搜索'); ?>" />
                                        <button type="submit"></button>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <span class="nav-toggle-button collapsed" data-toggle="collapse" data-target="#main-menu">
                                <span class="sr-only">导航切换</span>
                                <i class="glyphicon glyphicon-menu-hamburger"></i>
                            </span>
                        </div>

                        <div class="collapse navbar-collapse" id="main-menu">
                            <ul class="menu">
                                <li<?php if ($this->is('index')) : ?> class="nav-current" <?php endif; ?>><a href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>

                                    <?php $this->widget('Widget_Metas_Category_List')->to($category);
                                    $lestCategory = null; ?>

                                    <?php if ($this->options->menuDropdown == 5) : $lestLevel = -1; ?>
                                        <li><a>分类<span class="caret"></span></a>
                                            <ul>
                                                <?php while ($category->next()) : ?>
                                                    <?php if ($lestLevel == -1) {
                                                        $lestLevel = $category->levels;
                                                        $lestSlug = $category->slug;
                                                        $lestName = $category->name;
                                                        $lestLink = $category->permalink;
                                                        continue;
                                                    }; ?>
                                                    <?php if ($lestLevel < $category->levels) { ?>
                                                        <li <?php if ($this->is('category', $lestSlug)) : ?> class="nav-current" <?php endif; ?>><a class="more" href="<?php echo $lestLink; ?>" title="<?php echo $lestName; ?>"><?php echo $lestName; ?></a>
                                                            <ul>
                                                            <?php } else { ?>
                                                                <li <?php if ($this->is('category', $lestSlug)) : ?> class="nav-current" <?php endif; ?>><a href="<?php echo $lestLink; ?>" title="<?php echo $lestName; ?>"><?php echo $lestName; ?></a></li>
                                                            <?php };   ?>
                                                            <?php $level = $lestLevel - $category->levels;
                                                            if ($lestLevel > $category->levels) {
                                                                $x = (int)$level;
                                                                while ($x > 0) {
                                                                    echo "</ul></li>";
                                                                    $x--;
                                                                }
                                                            } ?>
                                                            <?php $lestLevel = $category->levels;
                                                            $lestSlug = $category->slug;
                                                            $lestName = $category->name;
                                                            $lestLink = $category->permalink; ?>
                                                        <?php endwhile; ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if ($this->options->menuDropdown == 4) : ?>
                                                        <li><a>分类<span class="caret"></span></a>
                                                            <ul>
                                                                <?php while ($category->next()) : ?>
                                                                    <li <?php if ($this->is('category', $category->slug)) : ?> class="nav-current" <?php endif; ?>><a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a></li>
                                                                <?php endwhile; ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if ($this->options->menuDropdown == 3) : $lestLevel = -1; ?>
                                                        <?php while ($category->next()) : ?>
                                                            <?php if ($lestLevel == -1) {
                                                                $lestLevel = $category->levels;
                                                                $lestSlug = $category->slug;
                                                                $lestName = $category->name;
                                                                $lestLink = $category->permalink;
                                                                continue;
                                                            }; ?>
                                                            <?php if ($lestLevel < $category->levels) { ?>
                                                                <li <?php if ($this->is('category', $lestSlug)) : ?> class="nav-current" <?php endif; ?>><a <?php if (!$lestLevel == 0) : ?> class="more" <?php endif; ?> href="<?php echo $lestLink; ?>" title="<?php echo $lestName; ?>"><?php echo $lestName; ?><?php if ($lestLevel == 0) : ?><span class="caret"></span><?php endif; ?></a>
                                                                    <ul>
                                                                    <?php } else { ?>
                                                                        <li <?php if ($this->is('category', $lestSlug)) : ?> class="nav-current" <?php endif; ?>><a href="<?php echo $lestLink; ?>" title="<?php echo $lestName; ?>"><?php echo $lestName; ?></a></li>
                                                                    <?php };   ?>
                                                                    <?php $level = $lestLevel - $category->levels;
                                                                    if ($lestLevel > $category->levels) {
                                                                        $x = (int)$level;
                                                                        while ($x > 0) {
                                                                            echo "</ul></li>";
                                                                            $x--;
                                                                        }
                                                                    } ?>
                                                                    <?php $lestLevel = $category->levels;
                                                                    $lestSlug = $category->slug;
                                                                    $lestName = $category->name;
                                                                    $lestLink = $category->permalink; ?>
                                                                <?php endwhile; ?>
                                                            <?php endif; ?>

                                                            <?php if ($this->options->menuDropdown == 2) : $lestLevel = -1; ?>
                                                                <?php while ($category->next()) : ?>
                                                                    <?php if ($lestLevel == -1) {
                                                                        $lestLevel = $category->levels;
                                                                        $lestSlug = $category->slug;
                                                                        $lestName = $category->name;
                                                                        $lestLink = $category->permalink;
                                                                        continue;
                                                                    }; ?>
                                                                    <?php if ($lestLevel < $category->levels && $lestLevel == 0) { ?>
                                                                        <li <?php if ($this->is('category', $lestSlug)) : ?> class="nav-current" <?php endif; ?>><a <?php if (!$lestLevel == 0) : ?> class="more" <?php endif; ?> href="<?php echo  $lestLink; ?>" title="<?php echo $lestName; ?>"><?php echo $lestName; ?><?php if ($lestLevel == 0) : ?><span class="caret"></span><?php endif; ?></a>
                                                                            <ul>
                                                                            <?php } else { ?>
                                                                                <li <?php if ($this->is('category', $lestSlug)) : ?> class="nav-current" <?php endif; ?>><a href="<?php echo $lestLink; ?>" title="<?php echo $lestName; ?>"><?php echo $lestName; ?></a></li>
                                                                            <?php }   ?>
                                                                            <?php if ($lestLevel > $category->levels && $category->levels == 0) {
                                                                                echo "</ul></li>";
                                                                            }; ?>
                                                                            <?php $lestLevel = $category->levels;
                                                                            $lestSlug = $category->slug;
                                                                            $lestName = $category->name;
                                                                            $lestLink = $category->permalink; ?>
                                                                        <?php endwhile; ?>
                                                                    <?php endif; ?>

                                                                    <?php if ($this->options->menuDropdown == 1) : ?>
                                                                        <?php while ($category->next()) : ?>
                                                                            <?php if ($category->levels == 0) : ?>
                                                                                <li <?php if ($this->is('category', $category->slug)) : ?> class="nav-current" <?php endif; ?>><a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a></li>
                                                                            <?php endif; ?>
                                                                        <?php endwhile; ?>
                                                                    <?php endif; ?>

                                                                    <?php if ($this->options->menuDropdown == 0) : ?>
                                                                        <?php while ($category->next()) : ?>
                                                                            <li <?php if ($this->is('category', $category->slug)) : ?> class="nav-current" <?php endif; ?>><a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a></li>
                                                                        <?php endwhile; ?>
                                                                    <?php endif; ?>

                                                                    <?php if ($this->options->pageDropdown) : ?>
                                                                        <li><a>独立页面<span class="caret"></span></a>
                                                                            <ul>
                                                                            <?php endif; ?>
                                                                            <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                                                                            <?php while ($pages->next()) : ?>
                                                                                <li<?php if ($this->is('page', $pages->slug)) : ?> class="nav-current" <?php endif; ?>><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                                                                        </li>
                                                                    <?php endwhile; ?>
                                                                    <?php if ($this->options->pageDropdown) : ?>
                                                                            </ul><?php endif; ?>
                                                                        <?php add_menu_link($this); ?>
                                                                        <?php if ($this->options->navbarSearch) : ?>
                                                                            <div class="navbar-form navbar-right navbar-search">
                                                                                <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                                                                                    <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
                                                                                    <input type="text" name="s" class="text asearch" placeholder="<?php _e('输入关键字搜索'); ?>" />
                                                                                    <button type="submit"></button>
                                                                                </form>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- end navigation -->