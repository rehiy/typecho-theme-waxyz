// 回到顶部按钮
$(document).ready((function (_this) {
    return function () {
        var bt;
        bt = $('#back-to-top');
        if ($(document).width() > 480) {
            $(window).scroll(function () {
                var st;
                st = $(window).scrollTop();
                if (st > 400) {
                    return bt.css('display', 'block');
                } else {
                    return bt.css('display', 'none');
                }
            });
            return bt.click(function () {
                $('body,html').animate({
                    scrollTop: 0
                },
                    800);
                return false;
            });
        }
    };
})(this));

// 图片懒加载
$(document).ready(function () {
    $("img").lazyload({
        /*placeholder: "/loading.gif",*/
        effect: "fadeIn"
    });
});

// 下拉菜单
function menuDropdown(ulclass) {
    $(document).ready(function () {
        $(ulclass + ' li').hover(function () {
            $(this).children("ul").show(); //mouseover
        }, function () {
            $(this).children("ul").hide(); //mouseout
        });
    });
}
$(document).ready(function () {
    menuDropdown('.menu ul');
});

// 鼠标特效
var a_idx = 0;
jQuery(document).ready(function ($) {
    $("body").click(function (e) {
        var a = new Array("富强", "民主", "文明", "和谐", "自由", "平等", "公正", "法治", "爱国", "敬业", "诚信", "友善");
        var $i = $("<span></span>").text(a[a_idx]);
        a_idx = (a_idx + 1) % a.length;
        var x = e.pageX,
            y = e.pageY;
        $i.css({
            "z-index": 999999999999999999999999999999999999999999999999999999999999999999999,
            "top": y - 20,
            "left": x,
            "position": "absolute",
            "font-weight": "bold",
            "color": "rgb(" + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + "," + ~~(255 * Math.random()) + ")"
        });
        $("body").append($i);
        $i.animate({
            "top": y - 180,
            "opacity": 0
        },
            1500,
            function () {
                $i.remove();
            });
    });
});

// 天空之城
jQuery(document).ready(function () {
    const AudioContext = window.AudioContext || window.webkitAudioContext;

    if (!AudioContext) {
        return;
    }

    const sheet = '880 987 1046 987 1046 1318 987 659 659 880 784 880 1046 784 659 659 698 659 698 1046 659 1046 1046 1046 987 698 698 987 987 880 987 1046 987 1046 1318 987 659 659 880 784 880 1046 784 659 698 1046 987 1046 1174 1174 1174 1046 1046 880 987 784 880 1046 1174 1318 1174 1318 1567 1046 987 1046 1318 1318 1174 784 784 880 1046 987 1174 1046 784 784 1396 1318 1174 659 1318 1046 1318 1760 1567 1567 1318 1174 1046 1046 1174 1046 1174 1567 1318 1318 1760 1567 1318 1174 1046 1046 1174 1046 1174 987 880 880 987 880'.split(' ');

    let ctx,
        i = 0,
        o = 1,
        dom,
        a = '♪ ♩ ♫ ♬ ♭ € § ¶ ♯'.split(' '),
        selects = document.querySelectorAll('.menu li')
        ;

    selects.forEach((select) => {
        select.addEventListener('mouseenter', (e) => {
            if (dom) {
                return;
            }

            let r = sheet[i];
            if (!r) {
                i = 0;
                r = sheet[i];
            }
            i += o;

            if (!ctx) {
                ctx = new AudioContext;
            }

            const c = ctx.createOscillator(), l = ctx.createGain(), mainGain = ctx.createGain();
            c.connect(l);
            l.connect(mainGain);
            mainGain.connect(ctx.destination);
            mainGain.gain.setValueAtTime(1, ctx.currentTime);
            c.type = 'sine';
            c.frequency.value = r;
            l.gain.setValueAtTime(0, ctx.currentTime);
            l.gain.linearRampToValueAtTime(1, ctx.currentTime + .01);
            c.start(ctx.currentTime);
            l.gain.exponentialRampToValueAtTime(.001, ctx.currentTime + 1);
            c.stop(ctx.currentTime + 1);

            const d = Math.round(7 * Math.random());
            const h = e.pageX;
            const p = e.pageY - 5;
            dom = document.createElement('b');
            dom.textContent = a[d];
            dom.style.zIndex = '99999';
            dom.style.top = p - 100 + 'px';
            dom.style.left = h + 'px';
            dom.style.position = 'absolute';
            dom.style.color = '#FF6EB4';
            document.body.appendChild(dom);
            dom.animate([
                { top: p + 'px' },
                { opacity: 0 }
            ], {
                duration: 500
            });
            setTimeout(() => {
                dom.remove();
                dom = null;
            }, 500);

            e.stopPropagation();
        });
    });

});
