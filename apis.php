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
        $self->response->throwJson(array('code' => 0, 'data' => '非法请求，已屏蔽！'));
    }

    // 点赞和取消点赞
    static function handle_agree($self)
    {
        $self->response->setStatus(200);

        $cid = $self->request->cid;
        $type = $self->request->type;

        /* sql注入校验 */
        if (!preg_match('/^\d+$/',  $cid)) {
            return $self->response->throwJson(array('code' => 0, 'data' => '参数错误'));
        }
        /* sql注入校验 */
        if (!preg_match('/^[agree|disagree]+$/', $type)) {
            return $self->response->throwJson(array('code' => 0, 'data' => '参数错误'));
        }

        $db = Typecho_Db::get();
        $row = $db->fetchRow($db->select('agree')->from('table.contents')->where('cid = ?', $cid));
        if (sizeof($row) > 0) {
            $up = $type === 'agree' ? 1 : -1;
            $rw = array('agree' => (int)$row['agree'] + $up);
            $db->query($db->update('table.contents')->rows($rw)->where('cid = ?', $cid));
            $self->response->throwJson(array(
                'code' => 1,
                'data' => array('agree' => number_format($db->fetchRow($db->select('agree')->from('table.contents')->where('cid = ?', $cid))['agree']))
            ));
        }

        $self->response->throwJson(array('code' => 0, 'data' => null));
    }

    // 查询百度是否收录
    static function test_baidu_record($self)
    {
        $self->response->setStatus(200);

        $url = urlencode($self->request->url);

        $encryption = '0x' . substr(md5(mt_rand(1655, 100860065) . time()), 8, 16);
        $baiduSite = "https://www.baidu.com/s?wd={$url}&rsv_spt=1&rsv_iqid={$encryption}&issp=1&f=8&rsv_bp=1&rsv_idx=2&ie=utf-8&tn=baiduhome_pg&rsv_enter=1&rsv_dl=tb&rsv_n=2&rsv_sug3=1&rsv_sug2=0&rsv_btype=i&inputT=1086&rsv_sug4=1086";

        $ip = mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255) . '.' . mt_rand(0, 255);
        $header[] = 'Accept-Encoding: gzip,deflate';
        $header[] = 'Accept-Language: en-US,en;q=0.8';
        $header[] = 'CLIENT-IP: ' . $ip;
        $header[] = 'X-FORWARDED-FOR: ' . $ip;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $baiduSite);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_REFERER, 'https://www.baidu.com/s?ie=utf-8&wd=' . $url);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.79 Safari/537.36');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $output = curl_exec($ch);
        curl_close($ch);

        $res = str_replace([' ', "\n", "\r"], '', $output);
        if (strpos($res, '抱歉，没有找到与') || strpos($res, '找到相关结果约0个') || strpos($res, '没有找到该URL') || strpos($res, '抱歉没有找到')) {
            $self->response->throwJson(array('data' => '未收录', 'url' => $baiduSite));
        }

        $self->response->throwJson(array('data' => '已收录', 'url' => $baiduSite));
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
