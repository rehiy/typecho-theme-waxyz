<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <span>Copyright &copy; <?php echo date("Y"); ?> <a href="<?php $this->options->siteUrl(); ?>" target="_blank"><?php $this->options->title(); ?></a></span><br />
                <span>Powered by <a href="http://typecho.org/" target="_blank">Typecho</a> & <a href="https://github.com/rehiy/typecho-theme-waxyz" target="_blank">Waxyz</a> <?php add_icp_code($this); ?></span><br />
            </div>
        </div>
    </div>
</div>

<a id="back-to-top"><i class="glyphicon glyphicon-menu-up"></i></a>

<!--staticfile-->
<?php if (strcmp($this->options->CDN, "staticfile") == 0) : ?>
    <script src="//cdn.staticfile.org/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.staticfile.org/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.staticfile.org/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="//cdn.staticfile.org/jquery_lazyload/1.8.4/jquery.lazyload.min.js"></script>
<?php endif; ?>
<!--staticfile END-->

<!--75cdn-->
<?php if (strcmp($this->options->CDN, "75cdn") == 0) : ?>
    <script src="//lib.baomitu.com/jquery/3.6.1/jquery.min.js"></script>
    <script src="//lib.baomitu.com/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//lib.baomitu.com/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="//lib.baomitu.com/jquery.lazyload/1.8.4/jquery.lazyload.min.js"></script>
<?php endif; ?>
<!--75cdn END-->

<!--bootcss-->
<?php if (strcmp($this->options->CDN, "bootcss") == 0) : ?>
    <script src="//cdn.bootcdn.net/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.bootcdn.net/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.bootcdn.net/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="//cdn.bootcdn.net/ajax/libs/jquery_lazyload/1.9.7/jquery.lazyload.min.js"></script>
<?php endif; ?>
<!--bootcss END-->

<!--jsdelivr-->
<?php if (strcmp($this->options->CDN, "jsdelivr") == 0) : ?>
    <script src="//cdn.jsdelivr.net/gh/jquery/jquery@3.6.1/dist/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/lazyload@1.8.4/jquery.lazyload.min.js"></script>
<?php endif; ?>
<!--jsdelivr END-->

<!--local-->
<?php if (strcmp($this->options->CDN, "local") == 0) : ?>
    <script src="<?php $this->options->themeUrl('js/jquery.min.js?v3.6.1'); ?>"></script>
    <script src="<?php $this->options->themeUrl('js/bootstrap.min.js?v3.4.1'); ?>"></script>
    <script src="<?php $this->options->themeUrl('js/jquery.fancybox.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('js/jquery.lazyload.min.js'); ?>"></script>
<?php endif; ?>
<!--local END-->

<script src="<?php $this->options->themeUrl('js/waxyz.js?v17'); ?>"></script>

<!--代码高亮-->
<?php if ($this->options->codeHighlightControl) : ?>
    <script type="text/javascript">
        (function() {
            var pres = document.querySelectorAll('pre');
            var lineNumberClassName = 'line-numbers';
            pres.forEach(function(item, index) {
                item.className = item.className == '' ? lineNumberClassName : item.className + ' ' + lineNumberClassName;
            });
        })();
    </script>
    <script type="text/javascript" src="<?php $this->options->themeUrl('lib/prism/clipboard.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php $this->options->themeUrl('lib/prism/prism.js'); ?>"></script>
<?php endif; ?>
<!--END-->

<!--置顶文章滚动支持-->
<?php if (!empty($this->options->sticky) && count(explode(',', strtr($this->options->sticky, ' ', ','))) > 1) : ?>
    <script type="text/javascript">
        var doscroll = function() {
            var $parent = $('.js-slide-list');
            var $first = $parent.find('li:first');
            var height = $first.height();
            $first.animate({
                marginTop: -height + 'px'
            }, 500, function() {
                $first.css('marginTop', 0).appendTo($parent);
            });
        };
        setInterval(function() {
            doscroll()
        }, 2000);
    </script>
<?php endif; ?>
<!--END-->

<!--网站加载动画-->
<?php if ($this->options->loadHtml) : ?>
    <script type="text/javascript">
        $("#loading").fadeOut(500);
    </script>
<?php endif; ?>
<!--END-->

<!--自定义尾部代码-->
<?php add_custom_footer($this); ?>
<!--END-->

<?php $this->footer(); ?>
</body>

</html>