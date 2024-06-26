<?php

/**
 * Waxyz 简约自适应博客主题，轻量高效，悦于书写！
 * 支持主题自定义、短代码、文章置顶/标星、公告、CDN切换等功能。<br/>
 *
 * @package Waxyz
 * @author 若海
 * @version 2023.09.10
 * @link https://www.rehiy.com
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<section class="content-wrap">
    <div class="container">
        <div class="row">
            <main class="col-md-8 main-content">

                <?php if ($this->is('index')) {
                    on_top_text();
                    on_up_post();
                } ?>

                <?php while ($this->next()) : ?>

                    <!----全文模式开始----->
                    <?php if ($this->options->indexType == 1) : ?>
                        <article id="<?php $this->cid() ?>" class="post">
                            <?php if ($this->___fields()->__isSet('star')) : ?>
                                <div class="featured" title="推荐文章">
                                    <i class="glyphicon glyphicon-star"></i>
                                </div>
                            <?php endif; ?>
                            <div class="post-head">
                                <h1 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
                                <div class="post-meta">
                                    <span class="author">作者：<a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a></span>
                                    <time class="post-date" datetime="<?php $this->date('c'); ?>" title="<?php $this->date('Y年m月d日'); ?>">时间：<?php $this->date('Y年m月d日'); ?></time>
                                    <span class="author">分类：<?php $this->category(','); ?></span>
                                    <span class="author">阅读：<?php get_post_view($this) ?></span>
                                </div>
                                <div class="post-border"></div>
                            </div>
                            <?php if ($this->___fields()->__isSet('img')) : ?>
                                <div class="featured-media">
                                    <a href="<?php $this->permalink() ?>"><img src="<?php $this->fields->img(); ?>" alt="<?php $this->title() ?>"></a>
                                </div>
                            <?php elseif (get_first_img($this->content)) : ?>
                                <div class="featured-media">
                                    <a href="<?php $this->permalink() ?>"><img src="<?php echo get_first_img($this->content); ?>" alt="<?php $this->title() ?>"></a>
                                </div>
                            <?php endif; ?>
                            <div class="post-content">
                                <?php echo get_content_more($this->content, $this->permalink); ?>
                            </div>
                            <footer class="post-footer clearfix">
                                <div class="pull-left tag-list">
                                    <i class="glyphicon glyphicon-tags"></i> <?php $this->tags(' , ', true, 'none'); ?>
                                </div>
                                <div class="pull-right post-permalink">
                                    <a href="<?php $this->permalink() ?>#comments" class="btn btn-default">前往评论</a>
                                </div>
                            </footer>
                        </article>
                    <?php endif; ?>

                    <!----摘要模式开始----->
                    <?php if ($this->options->indexType == 0) : ?>
                        <article id="<?php $this->cid() ?>" class="post" style="padding:25px 10px;">
                            <?php if ($this->___fields()->__isSet('star')) : ?>
                                <div class="featured" title="推荐文章"> <i class="glyphicon glyphicon-star"></i></div>
                            <?php endif; ?>
                            <div class="excerpt">
                                <?php if ($this->___fields()->__isSet('img')) : ?>
                                    <div class="excerpt-img">
                                        <img class="lazyload" src="'<?php $this->options->lazyloadGif(); ?>" data-original="<?php $this->fields->img(); ?>" alt="<?php $this->title() ?>" title="<?php $this->title() ?>">
                                    </div>
                                <?php else : ?>
                                    <?php if (get_first_img($this->content)) : ?>
                                        <div class="excerpt-img">
                                            <img class="lazyload" src="<?php $this->options->lazyloadGif(); ?>" data-original="<?php echo get_first_img($this->content); ?>" alt="<?php $this->title() ?>" title="<?php $this->title() ?>">
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div class="post-excerpt">
                                    <div class="excerpt-title">
                                        <a href="<?php $this->permalink() ?>"><?php $this->title() ?></a>
                                    </div>
                                    <div class="excerpt-info">
                                        <div class="excerpt-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><a href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a></div>
                                        <div class="excerpt-item"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><?php $this->date('Y-m-d'); ?></div>
                                        <div class="excerpt-item"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span><?php $this->category(','); ?></div>
                                        <div class="excerpt-item"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><?php get_post_view($this); ?></div>
                                    </div>
                                    <div class="excerpt-content">
                                        <?php if ($this->___fields()->__isSet('info')) {
                                            $this->fields->info();
                                        } else {
                                            echo get_excerpt($this->text, 75, '');
                                        } ?>
                                        <a href="<?php $this->permalink() ?>" style="white-space:nowrap;"> - 阅读更多 - </a>
                                    </div>
                                    <!--div class="excerpt-info">
                                        <div class="excerpt-item"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span> <?php $this->tags(' , ', true, 'none'); ?></div>
                                    </div-->
                                </div>
                            </div>
                        </article>
                    <?php endif; ?>

                <?php endwhile; ?>

                <?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>

            </main>

            <?php $this->need('sidebar.php'); ?>

        </div>
    </div>
</section>

<?php $this->need('footer.php'); ?>