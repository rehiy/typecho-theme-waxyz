<?php

/**
 * 文章归档（时间线样式）
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/page_archiver.css?v1.0.0'); ?>">

<section class="content-wrap">
    <div class="container">
        <div class="row">
            <main class="col-md-8 main-content">
                <article id="arc" class="post">
                    <header class="post-head">
                        <div style="float: left;color: #BDBDBD;">很好! 目前共计<span style="font-weight:600;margin:0 3px;"><?php Typecho_Widget::widget('Widget_Stat')->to($stat)->publishedPostsNum(); ?></span>篇文章，继续加油呀~</div>
                    </header>
                    <section class="post-content">
                        <div id="archives" class="archive-list">

                            <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
                            $year = 0;
                            $mon = 0;
                            $i = 0;
                            $j = 0;
                            // while($archives->next()):
                            //     $year_tmp = date('Y',$archives->created);
                            //     $mon_tmp = date('m',$archives->created);
                            //     $y=$year; $m=$mon;
                            //     if ($mon != $mon_tmp && $mon > 0) echo '</ul></li>';
                            //     if ($year != $year_tmp && $year > 0) echo '</ul>';
                            //     if ($year != $year_tmp) {
                            //       $year = $year_tmp;
                            //     //   echo '<h1 class="al_year">'. $year .' 年</h1>'; //输出年份
                            //     }
                            //     if ($mon != $mon_tmp) {
                            //         $mon = $mon_tmp;
                            //         echo '<h2 ><a style="color:#505050;" href="/'. $year .'/'. $mon .'/">'. $year .' 年 '. $mon .' 月</a></h2><ul class="al_post_list">'; //输出月份
                            //     }
                            //     //echo '<li>'.date('d日: ',$archives->created).'<a href="'.$archives->permalink .'">'. $archives->title .'</a>';
                            //     echo '<li><a href="'.$archives->permalink .'">'. $archives->title .'</a>';
                            //     echo ' <span style="color: #959595;">（'.date('Y/m/d',$archives->created).'）</span>';
                            //     //echo '<em>（'. $archives->commentsNum.'条评论）</em>';
                            //     echo '</li>'; //输出文章日期和标题
                            // endwhile;
                            // echo '</ul>';
                            while ($archives->next()) :
                                $year_tmp = date('Y', $archives->created);
                                $mon_tmp = date('m', $archives->created);
                                $y = $year;
                                $m = $mon;
                                if ($year != $year_tmp) {
                                    $year = $year_tmp;
                                    echo '<h2 class="archive-year">' . $year . '</h2>'; //输出年份
                                }
                                echo '<div class="archive-item"><a class="meta" href="' . $archives->permalink . '"><time>' . date('m/d', $archives->created) . '</time>' . $archives->title . '</a></div>';
                            endwhile;
                            ?>
                        </div>
                    </section>
                </article>
            </main>
            <?php $this->need('sidebar.php'); ?>
        </div>
    </div>
</section>

<?php $this->need('footer.php'); ?>