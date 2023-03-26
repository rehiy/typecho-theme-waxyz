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
