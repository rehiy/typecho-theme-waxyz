// 下拉菜单
$(document).ready(function () {
    $('.menu ul li').hover(function () {
        $(this).children('ul').show(); //mouseover
    }, function () {
        $(this).children('ul').hide(); //mouseout
    });
});

// 图片查看器
$(document).ready(function () {
    new Viewer(document.querySelector('article'))
});

// 图片懒加载
$(document).ready(function () {
    $('img').lazyload({
        placeholder: '/usr/themes/waxyz/assets//loading.gif',
        effect: 'fadeIn'
    });
});

// 回到顶部
$(document).ready(function () {
    var bt = $('.back-to-top');
    if ($(document).width() > 480) {
        $(window).scroll(function () {
            var st = $(window).scrollTop();
            bt.css('display', st > 400 ? 'block' : 'none');
        });
        bt.click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
        });
    }
});

// 百度收录检测

function test_baidu() {
    $record = $('#baidu_record');
    if ($record.length === 0) {
        return;
    }
    $.ajax({
        url: Waxyz.apiPath + '?mod=test_baidu_record',
        type: 'POST',
        dataType: 'json',
        data: {
            url: window.location.href
        },
        success(res) {
            if (!res.data) {
                return
            }
            $record.html(res.data);
            if (res.data === '已收录') {
                $record.css('color', '#67C23A');
            }
            else if (res.data === '查询失败') {
                $record.css('color', '#F56C6C').attr('href', res.url);
                $('<a href="javascript:;" onclick="push_baidu()">推送</a>').insertAfter($record);
            }
            else {
                $record.css('color', '#E6A23C');
                setTimeout(push_baidu, 1000);
            }
        }
    });
}

function push_baidu() {
    $record = $('#baidu_record');
    $record.html('<span style="color: #E6A23C">推送中</span>');
    $.ajax({
        url: Waxyz.apiPath + '?mod=push_baidu_record',
        type: 'POST',
        dataType: 'json',
        data: {
            domain: window.location.protocol + '//' + window.location.hostname,
            url: encodeURI(window.location.href)
        },
        success(res) {
            if (res.data.error) {
                $record.html('<span style="color: #F56C6C">推送失败，请检查</span>');
            } else {
                $record.html('<span style="color: #67C23A">推送成功</span>');
            }
        }
    });
}

$(document).ready(test_baidu);
