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
$(document).ready(function () {
    $record = $('#baidu_record');
    if ($record.length === 0) {
        return;
    }
    $.ajax({
        url: '/apis?mod=test_baidu_record',
        type: 'POST',
        dataType: 'json',
        data: {
            url: window.location.href
        },
        success(res) {
            if (res.data && res.data === '已收录') {
                $record.css('color', '#67C23A');
                $record.html('已收录');
            } else {
                $record.html('<span style="color: #E6A23C">未收录，推送中</span>');
                const _timer = setTimeout(function () {
                    $.ajax({
                        url: '/apis?mod=push_baidu_record',
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
                    clearTimeout(_timer);
                }, 1000);
            }
        }
    });
});
