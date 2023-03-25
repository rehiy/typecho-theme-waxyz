<?php

/**
 * Navigation
 *
 * @package     Library
 * @subpackage  Navigation
 * @author      rehiy <https://www.rehiy.com>
 * @version     1.0.0
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

<nav class="main-navigation">
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
                <li <?php if ($this->is('index')) : ?> class="category-active" <?php endif; ?>>
                    <a href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a>
                </li>

                <?php $this->widget('Widget_Metas_Category_List', 'current=' . get_category_id($this->getArchiveSlug()))->to($category); ?>

                <!-- 展开分类菜单 -->
                <?php
                if ($this->options->menuDropdown == 4) {
                    $category->listCategories();
                } elseif ($this->options->menuDropdown == 2) {
                    while ($category->next()) {
                ?>
                        <li <?php if ($this->is('category', $category->slug)) : ?> class="category-active" <?php endif; ?>>
                            <a href="<?php $category->permalink(); ?>" title="<?php $category->name(); ?>"><?php $category->name(); ?></a>
                        </li>
                <?php
                    }
                }
                ?>
                <!-- 展开分类菜单 end -->

                <!-- 展开独立页面 -->
                <?php
                $this->widget('Widget_Contents_Page_List')->to($pages);
                while ($pages->next()) {
                ?>
                    <li <?php if ($this->is('page', $pages->slug)) : ?> class="category-active" <?php endif; ?>>
                        <a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
                    </li>
                <?php } ?>
                <!-- 展开独立页面 end -->

                <!-- 自定义菜单 -->
                <?php add_menu_link(); ?>
                <!-- 自定义菜单 end -->

                <!-- 顶部搜索框 -->
                <?php
                if ($this->options->navbarSearch) { ?>
                    <div class="navbar-form navbar-right navbar-search">
                        <form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                            <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
                            <input type="text" name="s" class="text asearch" placeholder="<?php _e('输入关键字搜索'); ?>" />
                            <button type="submit"></button>
                        </form>
                    </div>
                <?php } ?>
                <!-- 顶部搜索框 end -->
            </ul>
        </div>

    </div>
</nav>