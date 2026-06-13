<?php

/**
 * 友情链接（支持 Markdown）
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');

function getFriendsHtml($content, $cid)
{
    $content = get_content($content);
    $GLOBALS['friendCommentCoids'] = [];
    $friends = [];

    if (preg_match('/<table.+<\/table>/iUs', $content, $table)) {
        $table0 = preg_replace('/[\r\n]/', '', $table[0]);
        if (preg_match_all('/<tr><td>(.+)<\/td><\/tr>/iUs', $table0, $trlist)) {
            foreach ($trlist[1] as $tr) {
                $t = explode('</td><td>', $tr);
                $link = trim(strip_tags($t[1] ?? ''));
                if ($link === '') {
                    continue;
                }
                $friends[] = [
                    'name' => trim(strip_tags($t[0] ?? '')),
                    'link' => $link,
                    'logo' => trim(strip_tags($t[2] ?? '')),
                    'description' => trim(strip_tags($t[3] ?? '')),
                    'tag' => trim(strip_tags($t[4] ?? ''))
                ];
            }
            $content = str_replace($table[0], '<!-- friends-placeholder -->', $content);
        }
    }

    $friends = array_merge($friends, getFriendsFromComments($cid));
    $friendsHtml = renderFriendsList($friends);
    if (strpos($content, '<!-- friends-placeholder -->') !== false) {
        $content = str_replace('<!-- friends-placeholder -->', $friendsHtml, $content);
    } else {
        $content .= $friendsHtml;
    }

    return $content;
}


function getFriendsFromComments($cid)
{
    $db = Typecho_Db::get();
    // Direct DB query keeps approved friend replies independent from comment pagination.
    $comments = $db->fetchAll($db->select('coid', 'text')->from('table.comments')
        ->where('cid = ?', $cid)
        ->where('type = ?', 'comment')
        ->where('status = ?', 'approved')
        ->order('created', Typecho_Db::SORT_DESC));

    $friends = [];
    foreach ($comments as $comment) {
        $friend = parseFriendComment($comment['text']);
        if (!empty($friend['name']) && !empty($friend['link'])) {
            $friends[] = $friend;
            $GLOBALS['friendCommentCoids'][] = (int) $comment['coid'];
        }
    }

    return $friends;
}

function parseFriendComment($text)
{
    $text = preg_replace('/<\s*br\s*\/?\s*>/i', "\n", $text);
    $text = preg_replace('/<\s*\/(p|div|li)\s*>/i', "\n", $text);
    $text = friendText($text);
    $friend = [
        'name' => '',
        'link' => '',
        'logo' => '',
        'description' => '',
        'tag' => ''
    ];
    foreach (preg_split('/\r\n|\r|\n/', $text) as $line) {
        if (!preg_match('/^\s*(?:[-*+•]|\d+[.)、])?\s*([^:=：＝]+?)\s*[:=：＝]\s*(.*?)\s*$/u', $line, $matches)) {
            continue;
        }
        $field = friendField($matches[1]);
        if ($field !== '') {
            $friend[$field] = friendText($matches[2]);
        }
    }

    return $friend;
}

function friendKey($text)
{
    return strtolower(preg_replace('/\s+/u', '', friendText($text)));
}

function friendField($key)
{
    $key = friendKey($key);
    if (preg_match('/(头像|图标|图片|logo)/iu', $key)) {
        return 'logo';
    }
    if (preg_match('/(名称|名字|站名)/u', $key)) {
        return 'name';
    }
    if (preg_match('/(网址|地址|链接|站点)/u', $key)) {
        return 'link';
    }
    if (preg_match('/(简介|寄语|描述|说明|介绍)/u', $key)) {
        return 'description';
    }
    if (strpos($key, '标签') !== false) {
        return 'tag';
    }

    return '';
}

function friendText($text)
{
    $text = preg_replace('/<\s*(((?:https?:)?\/\/|mailto:)[^<>\s]+|[a-z0-9][a-z0-9.-]*\.[a-z]{2,}[^<>\s]*)\s*>/iu', '$1', $text);
    $text = html_entity_decode(strip_tags($text), ENT_QUOTES, 'UTF-8');
    return preg_replace('/^[\s\x{FEFF}\x{3000}]+|[\s\x{FEFF}\x{3000}]+$/u', '', $text);
}

function normalizeFriendURL($url)
{
    $url = friendText($url);
    if ($url !== '' && !preg_match('/^(?:[a-z][a-z0-9+.-]*:)?\/\//i', $url) && !preg_match('/^(?:mailto:|data:)/i', $url)) {
        $url = 'https://' . $url;
    }

    return $url;
}

function friendLogo($logo, $link)
{
    $logo = friendText($logo);
    if ($logo !== '' && preg_match('/^(?:https?:)?\/\//i', $logo)) {
        return normalizeFriendURL($logo);
    }

    return friendDefaultLogo($link);
}

function friendDefaultLogo($link)
{
    return 'https://cravatar.cn/avatar/' . md5($link) . '?s=128&d=monsterid';
}

function renderFriendsList($friends)
{
    if (empty($friends)) {
        return '';
    }

    shuffle($friends);
    $html = [
        '<ul class="row">'
    ];
    foreach ($friends as $friend) {
        $link = normalizeFriendURL($friend['link']);
        $logo = friendLogo($friend['logo'], $link);
        $description = friendText($friend['description']);
        $tag = friendText($friend['tag']);
        $html[] = '
            <li class="col-sm-12 col-lg-6">
                <a href="' . htmlspecialchars($link, ENT_QUOTES, 'UTF-8') . '" target="_blank" rel="noopener noreferrer" title="' . htmlspecialchars($description, ENT_QUOTES, 'UTF-8') . '">
                    <img src="' . htmlspecialchars($logo, ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($friend['name'], ENT_QUOTES, 'UTF-8') . '" onerror="this.onerror=null;this.src=&quot;' . htmlspecialchars(friendDefaultLogo($link), ENT_QUOTES, 'UTF-8') . '&quot;;" />
                    <div>
                        <p><b>' . htmlspecialchars($friend['name'], ENT_QUOTES, 'UTF-8') . '</b></p>
                        <p>寄语：<span>' . htmlspecialchars($description, ENT_QUOTES, 'UTF-8') . '</span></p>
                        ' . ($tag === '' ? '' : '<p>标签：<span>' . htmlspecialchars($tag, ENT_QUOTES, 'UTF-8') . '</span></p>') . '
                    </div>
                </a>
            </li>
        ';
    }
    $html[] = '</ul>';

    return implode('', $html);
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
                        <?php echo getFriendsHtml($this->content, $this->cid); ?>
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
