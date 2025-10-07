<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

// 模板目录
define('WAXYZ_DIR', '/usr/themes/waxyz/');

// 设置时区
date_default_timezone_set('Asia/Shanghai');

// 主题设置
function themeConfig($form)
{
    include __DIR__ . '/include/config-helper.php';

    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text(
        'logoUrl',
        NULL,
        NULL,
        _t('站点 Logo'),
        _t('在这里填入一个图片地址（URL）, 用来显示网站 LOGO，为空则显示网站标题')
    );
    $form->addInput($logoUrl);

    $faviconUrl = new Typecho_Widget_Helper_Form_Element_Text(
        'faviconUrl',
        NULL,
        NULL,
        _t('Favicon'),
        _t('请填入完整链接，作为网站标签图标，建议尺寸 32x32')
    );
    $form->addInput($faviconUrl);

    $startTime = new Typecho_Widget_Helper_Form_Element_Text(
        'startTime',
        NULL,
        "2019-11-23 13:55:00",
        _t('建站日期'),
        _t('格式：2019-11-23 13:55:00')
    );
    $form->addInput($startTime);

    $ICP = new Typecho_Widget_Helper_Form_Element_Text(
        'ICP',
        NULL,
        NULL,
        _t('ICP 备案号'),
        _t('网站 ICP 备案号，留空关闭')
    );
    $form->addInput($ICP);

    $PSB = new Typecho_Widget_Helper_Form_Element_Text(
        'PSB',
        NULL,
        NULL,
        _t('公安备案号'),
        _t('网站公安备案号，留空关闭')
    );
    $form->addInput($PSB);

    $zzBaiduToken = new Typecho_Widget_Helper_Form_Element_Text(
        'zzBaiduToken',
        NULL,
        NULL,
        _t('百度搜索推送密钥'),
        _t('向百度搜索主动推送资源，缩短爬虫发现网站链接的时间，不保证收录和展现效果，留空关闭。<br>获取地址 https://ziyuan.baidu.com/dashboard/index')
    );
    $form->addInput($zzBaiduToken);

    $cardName = new Typecho_Widget_Helper_Form_Element_Text(
        'cardName',
        NULL,
        NULL,
        _t('站长昵称'),
        _t('在关于侧边栏中展示')
    );
    $form->addInput($cardName);

    $cardImg = new Typecho_Widget_Helper_Form_Element_Text(
        'cardImg',
        NULL,
        NULL,
        _t('站长头像'),
        _t('在关于侧边栏中展示，请填入绝对地址（URL）')
    );
    $form->addInput($cardImg);

    $cardDescription = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cardDescription',
        NULL,
        NULL,
        _t('站长介绍/一言'),
        _t('在关于侧边栏中展示，支持 html')
    );
    $form->addInput($cardDescription);

    $cardlinks = new Typecho_Widget_Helper_Form_Element_Textarea(
        'cardlinks',
        NULL,
        NULL,
        _t('社交/分享链接'),
        _t('一行一条，格式(请用半角逗号分隔)：名称,地址；目前支持：rss/github/facebook/twitter/telegram/email/weibo/wechat')
    );
    $form->addInput($cardlinks);

    $cardBg = new Typecho_Widget_Helper_Form_Element_Text(
        'cardBg',
        NULL,
        WAXYZ_DIR . 'assets/aside.jpg',
        _t('关于背景'),
        _t('请填入完整链接（URL），设置关于侧边栏区块的背景（填充模式），建议大于360*170，留空自动关闭')
    );
    $form->addInput($cardBg);

    $loadHtml = new Typecho_Widget_Helper_Form_Element_Radio(
        'loadHtml',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '1',
        _t('预加载动画'),
        _t('是否启用等待站点加载完毕的动画')
    );
    $form->addInput($loadHtml);

    $toptext = new Typecho_Widget_Helper_Form_Element_Text(
        'toptext',
        NULL,
        NULL,
        _t('置顶公告'),
        _t('置顶公告，留空则关闭')
    );
    $form->addInput($toptext);

    $sticky = new Typecho_Widget_Helper_Form_Element_Text(
        'sticky',
        NULL,
        NULL,
        _t('文章置顶'),
        _t('置顶的文章cid，多个请用逗号或空格分隔，留空则关闭')
    );
    $form->addInput($sticky);

    $indexType = new Typecho_Widget_Helper_Form_Element_Radio(
        'indexType',
        array(
            '1' => '文章模式',
            '0' => '摘要模式'
        ),
        '0',
        _t('首页文章展示样式'),
        _t('设置首页文章展示样式')
    );
    $form->addInput($indexType);

    $findFirstImage = new Typecho_Widget_Helper_Form_Element_Radio(
        'findFirstImage',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '0',
        _t('自动寻找文章首图'),
        _t('是否自动使用文章内第一张图片作为文章首图')
    );
    $form->addInput($findFirstImage);

    $firstImages = new Typecho_Widget_Helper_Form_Element_Textarea(
        'firstImages',
        NULL,
        NULL,
        _t('文章首图'),
        _t('一行一条，随机使用，留空则关闭，权重：文章内定义首图 > 文章内第一张图片（如果启用） > 本处设置')
    );
    $form->addInput($firstImages);

    $shortCode = new Typecho_Widget_Helper_Form_Element_Radio(
        'shortCode',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '1',
        _t('短代码支持'),
        _t('是否启用短代码支持，移植自 WordPress 的功能，一般用于兼容转移过来的文章')
    );
    $form->addInput($shortCode);

    $picHtmlPrint = new Typecho_Widget_Helper_Form_Element_Radio(
        'picHtmlPrint',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '1',
        _t('图片高级功能'),
        _t('居中、懒加载、灯箱总控制开关')
    );
    $form->addInput($picHtmlPrint);

    $fancybox = new Typecho_Widget_Helper_Form_Element_Radio(
        'fancybox',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '1',
        _t('图片灯箱效果'),
        _t('是否启用图片灯箱效果（fancybox）')
    );
    $form->addInput($fancybox);

    $lazyload = new Typecho_Widget_Helper_Form_Element_Radio(
        'lazyload',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '1',
        _t('图片懒加载'),
        _t('是否启用图片懒加载（lazyload）')
    );
    $form->addInput($lazyload);

    $lazyloadGif = new Typecho_Widget_Helper_Form_Element_Text(
        'lazyloadGif',
        NULL,
        WAXYZ_DIR . 'assets/loading.gif',
        _t('懒加载占位图'),
        _t('设置图片懒加载时的载入图片（gif格式）')
    );
    $form->addInput($lazyloadGif);

    $navbarSearch = new Typecho_Widget_Helper_Form_Element_Radio(
        'navbarSearch',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '1',
        _t('菜单栏搜索框'),
        _t('设置是否在菜单栏右侧显示一个自适应搜索框')
    );
    $form->addInput($navbarSearch);

    $menuDropdown = new Typecho_Widget_Helper_Form_Element_Radio(
        'menuDropdown',
        array(
            '0' => '不显示<br/>',
            '2' => '全部展开（包括子分类）<br/>',
            '4' => '展开一级分类（收纳子分类，每级独立列表）'
        ),
        '4',
        _t('分类下拉菜单设置'),
        _t('设置分类下拉菜单的样式')
    );
    $form->addInput($menuDropdown);

    $menuLink = new Typecho_Widget_Helper_Form_Element_Textarea(
        'menuLink',
        NULL,
        '登录,/admin/login.php',
        _t('自定义菜单'),
        _t('一行一条，留空则关闭，格式(请用半角逗号分隔)：链接名称,链接地址（URL）')
    );
    $form->addInput($menuLink);

    $sidebarBlock = new Typecho_Widget_Helper_Form_Element_Checkbox(
        'sidebarBlock',
        array(
            'ShowSearch' => _t('显示搜索'),
            'ShowAbouts' => _t('显示关于'),
            'ShowCategory' => _t('显示分类'),
            'ShowTags' => _t('显示标签云'),
            'ShowRecentPosts' => _t('显示最新文章'),
            'ShowRecentComments' => _t('显示最近回复'),
            'ShowArchive' => _t('显示归档'),
            'ShowMySide' => _t('显示自定义侧边栏'),
            'ShowLinks' => _t('显示友情链接'),
            'ShowOther' => _t('显示其它杂项')
        ),
        array(
            'ShowAbouts',
            'ShowTags',
            'ShowRecentPosts',
            'ShowRecentComments',
            'ShowLinks'
        ),
        _t('侧边栏显示')
    );
    $form->addInput($sidebarBlock->multiMode());

    $mySideTitle = new Typecho_Widget_Helper_Form_Element_Text(
        'mySideTitle',
        NULL,
        '微信关注',
        _t('自定义侧边栏标题'),
        _t('设置自定义侧边栏显示标题')
    );
    $form->addInput($mySideTitle);

    $mySideInfo = new Typecho_Widget_Helper_Form_Element_Textarea(
        'mySideInfo',
        NULL,
        '<img src="' . WAXYZ_DIR . 'assets/loading.gif" title="欢迎关注公众号" alt="欢迎关注公众号" />',
        _t('自定义侧边栏内容'),
        _t('设置自定义侧边栏显示显示的内容，支持 html')
    );
    $form->addInput($mySideInfo);

    $links = new Typecho_Widget_Helper_Form_Element_Textarea(
        'links',
        NULL,
        '若海の技术写真,https://www.rehiy.com,https://www.rehiy.com/logo.png,一个全栈攻城狮的纯技术干货分享',
        _t('侧边栏友情链接'),
        _t('一行一条，字段用半角逗号分隔：网站名称,网站地址,网站图标,网站说明')
    );
    $form->addInput($links);

    $mouseClickEffects = new Typecho_Widget_Helper_Form_Element_Radio(
        'mouseClickEffects',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '0',
        _t('鼠标点击特效'),
        _t('是否启用鼠标点击特效')
    );
    $form->addInput($mouseClickEffects);

    $lostTime = new Typecho_Widget_Helper_Form_Element_Radio(
        'lostTime',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '0',
        _t('长期未修改提醒'),
        _t('是否启用提醒 “这篇文章距离上次修改已过xx天，其中的内容可能已经有所变动”')
    );
    $form->addInput($lostTime);

    $codeHighlightControl = new Typecho_Widget_Helper_Form_Element_Radio(
        'codeHighlightControl',
        array(
            '1' => '开启',
            '0' => '关闭'
        ),
        '0',
        _t('代码高亮'),
        _t('是否启用代码高亮功能，如需使用其他同类型插件，请关闭此项防止冲突')
    );
    $form->addInput($codeHighlightControl);

    $codeHighlightTheme = new Typecho_Widget_Helper_Form_Element_Radio(
        'codeHighlightTheme',
        array(
            'Default.css' => _t('Default'),
            'Okaidia.css' => _t('Okaidia'),
            'Coy.css' => _t('Coy'),
            'SolarizedLight.css' => _t('Solarized Light'),
            'TomorrowNight.css' => _t('Tomorrow Night'),
            'Twilight.css' => _t('Twilight'),
            'Funky.css' => _t('Funky'),
            'Dark.css' => _t('Dark'),
        ),
        'Okaidia.css',
        _t('代码高亮主题'),
        _t('设置代码高亮插件使用的主题')
    );
    $form->addInput($codeHighlightTheme);

    $CDN = new Typecho_Widget_Helper_Form_Element_Radio(
        'CDN',
        array(
            'local' => _t('本地'),
            'cdnjs.cloudflare.com' => _t('cdnjs.cloudflare.com'),
            'cdn.bootcdn.net' => _t('cdn.bootcdn.net'),
        ),
        'local',
        _t('公共资源 CDN'),
        _t('如果你的服务器带宽较低可以使用公共 CDN 加速js和css文件')
    );
    $form->addInput($CDN);

    $backgroundIndex = new Typecho_Widget_Helper_Form_Element_Radio(
        'backgroundIndex',
        array(
            '0' => '关闭',
            'all' => '全站',
            'index' => '仅首页',
            'index,category' => '+分类页',
            'index,category,tag' => '+标签页',
            'index,category,tag,archive' => '+归档页',
            'index,category,tag,archive,post' => '+内容页',
            'index,category,tag,archive,post,single' => '+单页',
        ),
        '0',
        _t('多媒体背景开关'),
        _t('选择显示多媒体背景的页面，`+` 表示包含首页和前面选项')
    );
    $form->addInput($backgroundIndex);

    $backgroundMedia = new Typecho_Widget_Helper_Form_Element_Textarea(
        'backgroundMedia',
        NULL,
        NULL,
        _t('多媒体背景地址'),
        _t('一行一个地址，留空则不显示，格式(请用半角逗号分隔)：类型,地址；目前支持：image/*,video/webm,video/mp4,video/ogg,application/x-mpegURL')
    );
    $form->addInput($backgroundMedia);

    $customHeader = new Typecho_Widget_Helper_Form_Element_Textarea(
        'customHeader',
        NULL,
        NULL,
        _t('自定义头部代码'),
        _t('代码将插入 header 标签结束之前')
    );
    $form->addInput($customHeader);

    $customFooter = new Typecho_Widget_Helper_Form_Element_Textarea(
        'customFooter',
        NULL,
        NULL,
        _t('自定义尾部代码'),
        _t('代码将插入 body 标签结束之前')
    );
    $form->addInput($customFooter);
}

// 加载短代码扩展支持
function themeInit()
{
    $options = Typecho_Widget::widget('Widget_Options');
    if ($options->shortCode) {
        require_once __DIR__ . '/include/shortcode.php';
    }
}

//*************************************************************//

// 文章页内容
function get_content($content)
{
    $options = Typecho_Widget::widget('Widget_Options');
    // 短代码
    if ($options->shortCode) {
        $content = do_shortcode($content);
    }
    // 图片功能
    if ($options->picHtmlPrint) {
        $content = get_pic_html($content);
    }
    return $content;
}

// 首页内容-more
function get_content_more($content, $permalink)
{
    $content = get_content($content);
    $array = explode('<!--more-->', $content);
    $content = $array[0];

    if ($array[1] !== null) {
        $content = $content . '
            <div class="readall_box" >
                <div class="readall_mask" ></div>
                <a href="' . $permalink . '" alt="阅读剩余部分" class="readall_text">阅读剩余部分</a>
                <i class="glyphicon glyphicon-chevron-down readall_icon"></i>
            </div>
        ';
    }

    return $content;
}

// 摘要格式清理
function get_excerpt($excerpt, $num, $str)
{
    $array = explode('<!--more-->', $excerpt);
    $excerpt = $array[0];

    //短代码
    $excerpt = preg_replace('/\[[A-Za-z0-9 ="\/]+?\]/', '', $excerpt);
    //标题/引用/无序列表
    $excerpt = preg_replace('/[-|>|#]+?[ ]/', '', $excerpt);
    //代码块
    $excerpt = preg_replace('/[`]{1,3}[\S\s]+?[`]{1,3}/', '', $excerpt);
    //粗斜删字体样式
    $excerpt = preg_replace('/[~|*]+?([\S\s]+?)[~|*]+?/', '$1', $excerpt);
    //超链接和图片
    $excerpt = preg_replace('/[!]{0,1}\[([\S\s]+?)\]\([\S\s]+?\)/', '$1', $excerpt);
    //分隔符
    $excerpt = preg_replace('/[-|*]+?/', '', $excerpt);
    //转义HTML
    $excerpt = htmlentities($excerpt);

    //使用mb_substr防止中文截取成乱码
    if ($str !== '' || $num !== -1) {
        return mb_substr($excerpt, 0, $num, "UTF-8") . $str;
    } else {
        return $excerpt;
    }
}

// 图片功能
function get_pic_html($content)
{
    $options = Typecho_Widget::widget('Widget_Options');

    $pattern = '/\<img.*?src\=\"(.*?)\".*?alt\=\"(.*?)\".*?title\=\"(.*?)\"[^>]*>/i';
    $replacement = '<center><img src="$1" alt="$2" title="$3"><span class="imgtitle">$3<span></center>';
    // 懒加载
    if ($options->lazyload) {
        $replacement = '<center><img class="lazyload" src="' . $options->lazyloadGif . '" data-original="$1" alt="$2" title="$3"><span class="imgtitle">$3<span></center>';
    }
    // 灯箱效果
    if ($options->fancybox) {
        $replacement = '<center><a data-fancybox="gallery" href="$1"><img  src="$1" alt="$2" title="$3"></a><span class="imgtitle">$3<span></center>';
    }
    //all in
    if ($options->fancybox && $options->lazyload) {
        $replacement = '<center><a data-fancybox="gallery" href="$1"><img class="lazyload" src="' . $options->lazyloadGif . '" data-original="$1" alt="$2" title="$3"></a><span class="imgtitle">$3<span></center>';
    }
    $content = preg_replace($pattern, $replacement, $content);

    return $content;
}

// 获取文章中第一个图片地址
function get_first_img($content)
{
    $options = Typecho_Widget::widget('Widget_Options');
    // 获取第一张图
    if ($options->findFirstImage) {
        preg_match_all('/\<img.*?src\=\"(.*?)\".*?[^>]*>/i', $content, $match);
        if (isset($match[1][0])) {
            return $match[1][0];
        }
    }
    // 随机图
    if ($options->firstImages) {
        $images_list = explode(PHP_EOL, $options->firstImages);
        return $images_list[array_rand($images_list)];
    }
    return '';
}

// 秒转时间，格式 年 月 日 时 分 秒
function get_build_time()
{
    $options = Typecho_Widget::widget('Widget_Options');
    // 获取建站时间
    $start_Time = $options->startTime;
    if (empty($start_Time)) {
        $site_create_time = strtotime('2019-11-23 13:55:00');
    } else {
        $site_create_time = strtotime($start_Time);
    }
    // 计算建站到现在的时间
    $time = time() - $site_create_time;
    if (is_numeric($time)) {
        $value = array(
            'years' => 0, 'days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 0,
        );
        if ($time >= 31556926) {
            $value['years'] = floor($time / 31556926);
            $time = ($time % 31556926);
        }
        if ($time >= 86400) {
            $value['days'] = floor($time / 86400);
            $time = ($time % 86400);
        }
        if ($time >= 3600) {
            $value['hours'] = floor($time / 3600);
            $time = ($time % 3600);
        }
        if ($time >= 60) {
            $value['minutes'] = floor($time / 60);
            $time = ($time % 60);
        }
        $value['seconds'] = floor($time);

        if ($value['years'] > 0) {
            echo $value['years'] . '年' . $value['days'] . '天' . $value['hours'] . '小时' . $value['minutes'] . '分';
        } else {
            echo $value['days'] . '天' . $value['hours'] . '小时' . $value['minutes'] . '分';
        }
    }
}

// 获取栏目id
function get_category_id($slug)
{
    $db = Typecho_Db::get();
    $postnum = $db->fetchRow($db->select()->from('table.metas')->where('slug=?', $slug)->where('type=?', 'category'));
    return $postnum['mid'] ?? '0';
}

// 获取阅读数
function get_post_view($self)
{
    $cid = $self->cid;
    $db = Typecho_Db::get();
    $row = $db->fetchRow($db->select()->from('table.contents')->where('cid = ?', $cid));
    echo $row['views'] ?? '0';
}

// 文章置顶
function on_up_post()
{
    $options = Typecho_Widget::widget('Widget_Options');
    $sticky = $options->sticky; //置顶的文章cid，按照排序输入, 请以半角逗号或空格分隔
    // 检查 $sticky 是否为 null 或空字符串
    if (empty($sticky)) {
        $sticky_cids = array();
    } else {
        $sticky_cids = explode(',', strtr($sticky, ' ', ',')); //分割cid
        $sticky_cids = array_filter($sticky_cids); //去除空白
    }
    
    if (!empty($sticky_cids)) {
        echo '
            <article id="top-article" class="post top-article">
                <div class="featured" title="置顶文章">
                    <i class="glyphicon glyphicon-bookmark"></i>
                </div>
                <div class="top-article-body">
                    <div class="top-article-slide">
                        <ul class="top-article-slide-list js-slide-list">
        ';
        $db = Typecho_Db::get(); //获取数据库连接
        $sticky_post = $db->fetchAll(
            $db->select()->from('table.contents')
                ->where('status = ?', 'publish')
                ->where('type = ?', 'post')
                ->where('cid in ?', $sticky_cids)
                ->order('cid', Typecho_Db::SORT_ASC)
        );
        if ($sticky_post) {
            foreach ($sticky_post as $val) {
                $item = Typecho_Widget::widget('Widget_Abstract_Contents');
                $item->push($val);
                $time = date('Y年m月d日', $val["created"]);
                $post_title = htmlspecialchars($val['title']);
                echo '<li class=""><span><a href="' . $item->permalink . '">《' . $post_title . '》</a></span><span style="color: #959595;">（' . $time . '）</span></li>';
            }
        }
        echo '</ul></div></div></article>';
    }
}

// 显示公告
function on_top_text()
{
    $options = Typecho_Widget::widget('Widget_Options');
    $top_text = $options->toptext;
    if (!empty($top_text)) {
        echo '
            <article id="top-text" class="post top-text">
                <div class="featured" title="公告"><i class="glyphicon glyphicon-comment"></i></div>
                <div class="top-text-body">' . $top_text . '</span></div>
            </article>
        ';
    }
}

// 自定义头部代码
function add_background_media($self)
{
    $options = Typecho_Widget::widget('Widget_Options');
    if ($options->backgroundIndex == '0') {
        return;
    }
    // 如果不是全站则判断
    if ($options->backgroundIndex != 'all') {
        $list = explode(',', $options->backgroundIndex);
        if (empty(array_filter($list, [$self, 'is']))) {
            return;
        }
    }
    // 如果设置了背景则加载
    if ($media = trim($options->backgroundMedia)) {
        $media_list = explode("\n", $media);
        $media_url = $media_list[array_rand($media_list)];
        if ($media_url && strpos($media_url, ',') > 0) {
            include __DIR__ . '/include/background.php';
        }
    }
}

// 自定义头部代码
function add_custom_header()
{
    $options = Typecho_Widget::widget('Widget_Options');
    $content = $options->customHeader;
    if (!empty($content)) {
        echo $content;
    }
}

// 自定义尾部代码
function add_custom_footer()
{
    $options = Typecho_Widget::widget('Widget_Options');
    $content = $options->customFooter;
    if (!empty($content)) {
        echo $content;
    }
}

// 工信部备案
function add_icp_code()
{
    $options = Typecho_Widget::widget('Widget_Options');
    $ICP_text = $options->ICP;
    if (!empty($ICP_text)) {
        echo ' | <a rel="nofollow noopener noreferrer" href="https://beian.miit.gov.cn/" target="_blank">' . $ICP_text . '</a></span>';
    }
}

// 公安部备案
function add_psb_code()
{
    $options = Typecho_Widget::widget('Widget_Options');
    $PSB_text = $options->PSB;
    if (!empty($PSB_text)) {
        echo ' | <a rel="nofollow noopener noreferrer" href="http://www.beian.gov.cn/" target="_blank">' . $PSB_text . '</a></span>';
    }
}

// 显示友链
function add_links()
{
    $options = Typecho_Widget::widget('Widget_Options');
    $links = $options->links;
    if (!empty($links)) {
        $links_list = explode(PHP_EOL, $links);
        foreach ($links_list as $links_text) {
            $links_text_list = explode(',', $links_text);
            echo '<div class="recent-single-post">';
            echo '<a rel="noopener" href="' . $links_text_list[1] . '" title="' . $links_text_list[3] . '" target="_blank" class="post-title">';
            if ($links_text_list[2]) {
                echo '<img src="' . $links_text_list[2] . '" alt="' . $links_text_list[0] . '" width="100">';
            }
            echo '<span style="margin-left: 10px;">' . $links_text_list[0] . '</span>';
            echo '</a>';
            echo '</div>';
        }
    }
}

// 显示自定义链接
function add_menu_link()
{
    $options = Typecho_Widget::widget('Widget_Options');
    $menuLink = $options->menuLink;
    if (!empty($menuLink)) {
        $menuLink_list = explode(PHP_EOL, $menuLink);
        foreach ($menuLink_list as $menuLink_text) {
            $menuLink_text_list = explode(',', $menuLink_text);
            echo '<li><a href="' . $menuLink_text_list[1] . '" title="' . $menuLink_text_list[1] . '">' . $menuLink_text_list[0] . '</a></li>';
        }
    }
}

// 显示社交/分享链接
function add_cardlinks()
{
    $options = Typecho_Widget::widget('Widget_Options');
    $cardlinks = $options->cardlinks;
    if (!empty($cardlinks)) {
        echo '<div class="card-icon">';
        $cardlinks_list = explode(PHP_EOL, $cardlinks);
        foreach ($cardlinks_list as $cardlinks_text) {
            $cardlinks_text_list = explode(',', $cardlinks_text);
            echo '<a href="' . $cardlinks_text_list[1] . '" title="' . $cardlinks_text_list[0] . '" class="icon-' . $cardlinks_text_list[0] . '"></a>';
        }
        echo '</div>';
    }
}
