/**
 * 下拉菜单
 */

$(function () {
    $('.menu ul li').hover(function () {
        $(this).children('ul').show(); //mouseover
    }, function () {
        $(this).children('ul').hide(); //mouseout
    });
});

/**
 * 回到顶部
 */

$(function () {
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

/**
 * 图片查看器
 */

$(function () {
    new Viewer(document.querySelector('article'))
});

/**
 * 图片懒加载
 */

$(function () {
    $('img').lazyload({
        placeholder: '/usr/themes/waxyz/assets//loading.gif',
        effect: 'fadeIn'
    });
});

/**
 * 页面浏览统计
 */

if (Waxyz.isSingle && Waxyz.cid > 0) {
    $.ajax({
        url: Waxyz.apiPath + '?mod=handle_post_view&cid=' + Waxyz.cid,
        type: 'GET',
    });
}

/**
 * 置顶文章滚动
 */

$(function () {
    if (!Waxyz.sticky) {
        return;
    }
    var stickyList = Waxyz.sticky.split(/,|\s/).filter(function (id) {
        return id > 0;
    });
    // 激活滚动支持
    if (stickyList.length > 0 && $('#top-article').length > 0) {
        setInterval(function () {
            var $parent = $('.js-slide-list');
            var $first = $parent.find('li:first');
            var height = $first.height();
            $first.animate({
                marginTop: -height + 'px'
            }, 500, function () {
                $first.css('marginTop', 0).appendTo($parent);
            });
        }, 2000);
    }
});

/**
 * 百度收录检测
 */

$(function () {
    $record = $('#baidu_record');
    if ($record.length === 0) {
        return;
    }
    // 主动推送
    function push_baidu_record() {
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
    // 检测收录
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
                $('<a href="javascript:;">推送</a>').click(push_baidu_record).insertAfter($record);
            }
            else {
                $record.css('color', '#E6A23C');
                setTimeout(push_baidu_record, 1000);
            }
        }
    });
});

/**
 * 鼠标点击特效
 */

$(function () {
    if (!Waxyz.mouseClickEffect) {
        return;
    }
    // 注册特效
    $('body').click(function (ev) {
        if (ev.target.tagName != 'A') {
            show(ev), play();
        }
    });
    // 显示音符
    var si = 0;
    function show(ev) {
        var x = ev.pageX, y = ev.pageY;
        var ss = '♪ ♩ ♫ ♬ ¶ ‖ ♭ ♯ § ∮'.split(' ');
        var $b = $('<b></b>').text(ss[si]);
        si = (si + 1) % ss.length;
        $b.css({
            'top': y - 20,
            'left': x,
            'z-index': 99999999,
            'position': 'absolute',
            'user-select': 'none',
            'font-size': 1 + 2 * Math.random() + 'rem',
            'color': 'rgb(' + ~~(255 * Math.random()) + ',' + ~~(255 * Math.random()) + ',' + ~~(255 * Math.random()) + ')'
        });
        $('body').append($b);
        $b.animate(
            { 'top': y - 120, 'opacity': 0 }, 600, function () { $b.remove(); }
        );
    }
    // 播放音乐
    var AudioContext = window.AudioContext || window.webkitAudioContext;
    var sheet = '880 987 1046 987 1046 1318 987 659 659 880 784 880 1046 784 659 659 698 659 698 1046 659 1046 1046 1046 987 698 698 987 987 880 987 1046 987 1046 1318 987 659 659 880 784 880 1046 784 659 698 1046 987 1046 1174 1174 1174 1046 1046 880 987 784 880 1046 1174 1318 1174 1318 1567 1046 987 1046 1318 1318 1174 784 784 880 1046 987 1174 1046 784 784 1396 1318 1174 659 1318 1046 1318 1760 1567 1567 1318 1174 1046 1046 1174 1046 1174 1567 1318 1318 1760 1567 1318 1174 1046 1046 1174 1046 1174 987 880 880 987 880'.split(' ');
    var ctx, i = 0, play = function () {
        if (!AudioContext) {
            return;
        }
        sheet[i] || (i = 0);
        ctx || (ctx = new AudioContext);
        var c = ctx.createOscillator(),
            l = ctx.createGain(),
            m = ctx.createGain();
        c.connect(l);
        l.connect(m);
        m.connect(ctx.destination);
        m.gain.setValueAtTime(1, ctx.currentTime);
        c.type = 'sine';
        c.frequency.value = sheet[i++];
        l.gain.setValueAtTime(0, ctx.currentTime);
        l.gain.linearRampToValueAtTime(1, ctx.currentTime + .01);
        c.start(ctx.currentTime);
        l.gain.exponentialRampToValueAtTime(.001, ctx.currentTime + 1);
        c.stop(ctx.currentTime + 1);
    };
});
