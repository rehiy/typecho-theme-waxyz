<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

$mod = $this->request->mod;
if (!is_callable('Apis::' . $mod)) {
    $mod = 'illegal';
}

Apis::$mod($this);

/**
 * 接口实现
 */
class Apis
{
    // 非法请求
    static function illegal($self)
    {
        $self->response->setStatus(200);
        $self->response->throwJson(array('code' => 0, 'data' => '非法请求'));
    }

    // 增加阅读数
    static function handle_post_view($self)
    {
        $self->response->setStatus(200);

        $cid = $self->request->cid;

        // sql注入校验
        if (!preg_match('/^\d+$/',  $cid)) {
            $self->response->throwJson(array('code' => 0, 'data' => '参数错误'));
        }

        // 判断来源信息
        if (stripos($_SERVER['HTTP_REFERER'], $cid) === false) {
            $self->response->throwJson(array('code' => 0, 'data' => '非法请求'));
        }

        // 获取文章信息
        $db = Typecho_Db::get();
        $row = $db->fetchRow($db->select()->from('table.contents')->where('cid = ?', $cid));
        if (empty($row)) {
            $self->response->throwJson(array('code' => 0, 'data' => '文章不存在'));
        }

        // 添加统计字段
        if (!array_key_exists('views', $row)) {
            $prefix = $db->getPrefix();
            $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        }

        // 增加阅读数
        $vw = array('views' => 1 + $row['views']);
        $rs = $db->query($db->update('table.contents')->rows($vw)->where('cid = ?', $cid));

        $self->response->throwJson(array('code' => $rs, 'data' => $vw['views']));
    }

    // 点赞和取消点赞
    static function handle_post_agree($self)
    {
        $self->response->setStatus(200);

        $cid = $self->request->cid;
        $type = $self->request->type;

        // sql注入校验
        if (!preg_match('/^\d+$/',  $cid)) {
            $self->response->throwJson(array('code' => 0, 'data' => '参数错误'));
        }
        if (!preg_match('/^[agree|disagree]+$/', $type)) {
            $self->response->throwJson(array('code' => 0, 'data' => '参数错误'));
        }

        // 获取文章信息
        $db = Typecho_Db::get();
        $row = $db->fetchRow($db->select()->from('table.contents')->where('cid = ?', $cid));
        if (empty($row)) {
            $self->response->throwJson(array('code' => 0, 'data' => '文章不存在'));
        }

        // 添加点赞字段
        if (!array_key_exists('agree', $row)) {
            $prefix = $db->getPrefix();
            $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `agree` INT(10) DEFAULT 0;');
        }

        // 增加点赞数
        $rw = array('agree' =>  $row['views'] + ($type === 'agree' ? 1 : -1));
        $rs = $db->query($db->update('table.contents')->rows($rw)->where('cid = ?', $cid));
        if (!$rs) {
            $self->response->throwJson(array('code' => 0, 'data' => '操作失败'));
        }

        // 返回最新点赞数
        $new = $db->fetchRow($db->select('agree')->from('table.contents')->where('cid = ?', $cid));
        $self->response->throwJson(array(
            'code' => 1,
            'data' => array('agree' => number_format($new['agree']))
        ));
    }

    // 查询百度是否收录
    static function test_baidu_record($self)
    {
        $self->response->setStatus(200);

        $url = urlencode($self->request->url);
        $baiduSite = 'https://www.baidu.com/s?ie=utf-8&wd=' . $url;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $baiduSite);
        curl_setopt($ch, CURLOPT_REFERER, 'https://www.baidu.com');
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $output = curl_exec($ch);
        curl_close($ch);

        $res = str_replace([' ', "\n", "\r"], '', $output);
        if (strpos($res, '/captcha/') > 0) {
            $self->response->throwJson(array('data' => '查询失败', 'url' => $baiduSite));
        }

        if (strpos($res, '抱歉，没有找到与') > 0 || strpos($res, '找到相关结果约0个') > 0 || strpos($res, '没有找到该URL') > 0 || strpos($res, '抱歉没有找到') > 0) {
            $self->response->throwJson(array('data' => '未收录'));
        }

        $self->response->throwJson(array('data' => '已收录'));
    }

    // 推送到百度收录
    static function push_baidu_record($self)
    {
        $self->response->setStatus(200);

        $options = Typecho_Widget::widget('Widget_Options');
        $token = $options->zzBaiduToken;

        $domain = $self->request->domain;
        $url = $self->request->url;
        $urls = explode(',', $url);
        $api = "http://data.zz.baidu.com/urls?site={$domain}&token={$token}";

        $ch = curl_init();
        $options =  array(
            CURLOPT_URL => $api,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS => implode("\n", $urls),
            CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);

        $self->response->throwJson(array(
            'domain' => $domain,
            'url' => $url,
            'data' => json_decode($result, TRUE)
        ));
    }
}
