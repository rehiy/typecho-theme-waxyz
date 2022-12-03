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
        if (preg_match_all('/<tr><td>(.+)<\/td><\/tr>/iUs', $table[0], $trlist)) {
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

<style type="text/css">
    .post-head {
        border-bottom: 1px solid #ebebeb;
    }

    .post-head h2 {
        margin: 0 0 5px 0;
        font-size: 1.6em;
        text-align: left;
    }

    .post-content ul {
        list-style: none;
        margin: 0 auto;
        padding: 0;
    }

    .post-content ul li {
        margin: 0;
        padding: 6px;
    }

    .post-content ul li a {
        display: flex;
        align-items: center;
        width: 100%;
        height: 96px;
        border: 1px solid #DEDEDC;
        border-radius: 8px;
        transition: all .2s ease 0s;
    }

    .post-content ul li a:hover {
        text-decoration: none;
        box-shadow: rgba(0, 0, 0, .2) 0 1px 3px, rgba(157, 182, 200, .1) 0 1px 20px;
    }

    .post-content ul li a img {
        width: 96px;
        height: 96px;
    }

    .post-content ul li a div,
    .post-content ul li a div p {
        margin: 4px 0 4px 8px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .post-content ul li a div p span {
        color: #666;
    }
</style>

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