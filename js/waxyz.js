// 图片懒加载
$(document).ready(function () {
    $('img').lazyload({
        /*placeholder: '/loading.gif',*/
        effect: 'fadeIn'
    });
});

// 下拉菜单
$(document).ready(function () {
    $('.menu ul li').hover(function () {
        $(this).children('ul').show(); //mouseover
    }, function () {
        $(this).children('ul').hide(); //mouseout
    });
});

// 回到顶部按钮
$(document).ready(function () {
    var bt = $('#back-to-top');
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

// 鼠标点击特效
$(document).ready(function ($) {
    var a_idx = 0;
    $('body').click(function (e) {
        var x = e.pageX, y = e.pageY;
        var a = new Array('富强', '民主', '文明', '和谐', '自由', '平等', '公正', '法治', '爱国', '敬业', '诚信', '友善');
        var $i = $('<span></span>').text(a[a_idx]);
        a_idx = (a_idx + 1) % a.length;
        $i.css({
            'z-index': 9999999999999999999999,
            'top': y - 20,
            'left': x,
            'position': 'absolute',
            'font-weight': 'bold',
            'color': 'rgb(' + ~~(255 * Math.random()) + ',' + ~~(255 * Math.random()) + ',' + ~~(255 * Math.random()) + ')'
        });
        $('body').append($i);
        $i.animate(
            {
                'top': y - 180,
                'opacity': 0
            },
            1500,
            function () {
                $i.remove();
            }
        );
    });
});

// 菜单音乐 - 天空之城
$(document).ready(function () {
    var AudioContext = window.AudioContext || window.webkitAudioContext;

    if (!AudioContext) {
        return;
    }

    var i = 0, ctx, dom;

    var notes = '♪ ♩ ♫ ♬ ♭ € § ¶ ♯'.split(' ');
    var sheet = '880 987 1046 987 1046 1318 987 659 659 880 784 880 1046 784 659 659 698 659 698 1046 659 1046 1046 1046 987 698 698 987 987 880 987 1046 987 1046 1318 987 659 659 880 784 880 1046 784 659 698 1046 987 1046 1174 1174 1174 1046 1046 880 987 784 880 1046 1174 1318 1174 1318 1567 1046 987 1046 1318 1318 1174 784 784 880 1046 987 1174 1046 784 784 1396 1318 1174 659 1318 1046 1318 1760 1567 1567 1318 1174 1046 1046 1174 1046 1174 1567 1318 1318 1760 1567 1318 1174 1046 1046 1174 1046 1174 987 880 880 987 880'.split(' ');

    document.querySelectorAll('.menu-logo, .menu li').forEach((el) => {
        el.addEventListener('mouseenter', (e) => {
            e.stopPropagation();

            if (dom) {
                return;
            }

            if (!ctx) {
                ctx = new AudioContext;
            }

            sheet[i] || (i = 0);

            var c = ctx.createOscillator(),
                l = ctx.createGain(),
                m = ctx.createGain();
            c.connect(l);
            l.connect(m);
            m.connect(ctx.destination);
            m.gain.setValueAtTime(1, ctx.currentTime);
            c.type = 'sine';
            c.frequency.value = sheet[i];
            l.gain.setValueAtTime(0, ctx.currentTime);
            l.gain.linearRampToValueAtTime(1, ctx.currentTime + .01);
            c.start(ctx.currentTime);
            l.gain.exponentialRampToValueAtTime(.001, ctx.currentTime + 1);
            c.stop(ctx.currentTime + 1);

            var x = e.pageX,
                y = e.pageY - 5,
                d = Math.round(7 * Math.random());
            dom = document.createElement('b');
            dom.textContent = notes[d];
            dom.style.zIndex = '99999';
            dom.style.top = y - 100 + 'px';
            dom.style.left = x + 'px';
            dom.style.position = 'absolute';
            dom.style.color = '#FF6EB4';
            document.body.appendChild(dom);
            dom.animate([{ top: y + 'px' }, { opacity: 0 }], { duration: 500 });

            setTimeout(() => { dom.remove(); dom = null; }, 500);

            i++;
        });
    });
});
