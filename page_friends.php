<?php

/**
 * 友情链接（支持 Markdown）
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');

function getFriendsHtml($content)
{
    $content = get_content($content);

    if (preg_match('/<table.+<\/table>/iUs', $content, $table)) {
        $table0 = preg_replace('/[\r\n]/', '', $table[0]);
        if (preg_match_all('/<tr><td>(.+)<\/td><\/tr>/iUs', $table0, $trlist)) {
            $html = [
                '<ul class="row">'
            ];
            shuffle($trlist[1]);
            foreach ($trlist[1] as $tr) {
                $t = explode('</td><td>', $tr);
                $link = trim(strip_tags($t[1]));
                $logo = trim(strip_tags($t[2])) ?: 'https://cravatar.cn/avatar/' . md5($link) . '?s=128&d=monsterid';
                $html[] = '
                    <li class="col-sm-12 col-lg-6">
                        <a href="' . $link . '" target="_blank" title="' . $t[3] . '">
                            <img src="' . $logo . '" />
                            <div>
                                <p><b>' . $t[0] . '</b></p>
                                <p>寄语：<span>' . $t[3] . '</span></p>
                                <p>标签：<span>' . $t[4] . '</span></p>
                            </div>
                        </a>
                    </li>
                ';
            }
            $html[] = '</ul>';
            $content = str_replace($table[0], implode('', $html), $content);
        }
    }

    return $content;
}
?>

<link rel="stylesheet" href="<?php $this->options->themeUrl('assets/page_friends.css?v1.0.0'); ?>">

<section class="content-wrap">
    <div class="container">
        <div class="row">
            <main class="col-md-8 main-content">
                <article id="<?php $this->cid() ?>" class="post">
                    <header class="post-head">
                        <h2>友情链接</h2>
                        <div style="text-align: left;color: #BDBDBD;">有朋自远方来，不亦乐乎？</div>
                    </header>
                    <section class="post-content">
                        <?php echo getFriendsHtml($this->content); ?>
                    </section>
                </article>
                <div class="about-author clearfix">
                    <?php $this->need('comments.php'); ?>
                </div>
            </main>
            <?php $this->need('sidebar.php'); ?>
        </div class="row">
    </div class="container">
</section>

<?php $this->need('footer.php'); ?>