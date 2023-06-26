<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                &copy; <?php echo date("Y", strtotime($this->options->startTime))  . ' - ' . date("Y"); ?>
                <a href="<?php $this->options->siteUrl(); ?>" target="_blank"><?php $this->options->title(); ?></a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                Powered by <a href="http://typecho.org/" target="_blank">Typecho</a> & <a href="https://github.com/rehiy/typecho-theme-waxyz" target="_blank">Waxyz</a>
                <?php add_icp_code(); add_psb_code(); ?>
            </div>
        </div>
    </div>
</div>

<a class="back-to-top"><i class="glyphicon glyphicon-menu-up"></i></a>

<!--Library-->
<?php if ($this->options->CDN == "local") : ?>
    <script src="<?php $this->options->themeUrl('library/jquery.min.js?v3.6.1'); ?>"></script>
    <script src="<?php $this->options->themeUrl('library/jquery.fancybox.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('library/jquery.lazyload.min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('library/bootstrap.min.js?v3.4.1'); ?>"></script>
    <script src="<?php $this->options->themeUrl('library/video.min.js?8.0.4'); ?>"></script>
<?php else : ?>
    <script src="//<?php echo $this->options->CDN; ?>/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//<?php echo $this->options->CDN; ?>/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//<?php echo $this->options->CDN; ?>/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="//<?php echo $this->options->CDN; ?>/ajax/libs/jquery_lazyload/1.9.7/jquery.lazyload.min.js"></script>
    <script src="//<?php echo $this->options->CDN; ?>/ajax/libs/video.js/8.0.4/video.min.js"></script>
<?php endif; ?>

<!--代码高亮-->
<?php if ($this->options->codeHighlightControl) : ?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('library/prism/css/') . $this->options->codeHighlightTheme(); ?>" />
    <script type="text/javascript">
        (function() {
            var pres = document.querySelectorAll('pre');
            var lineNumberClassName = 'line-numbers';
            pres.forEach(function(item, index) {
                item.className = item.className == '' ? lineNumberClassName : item.className + ' ' + lineNumberClassName;
            });
        })();
    </script>
    <script type="text/javascript" src="<?php $this->options->themeUrl('library/prism/clipboard.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php $this->options->themeUrl('library/prism/prism.js'); ?>"></script>
<?php endif; ?>

<!--公共脚本-->
<script src="<?php $this->options->themeUrl('assets/global.js?v17'); ?>"></script>

<!--鼠标特效-->
<?php if ($this->options->mouseClickEffects) : ?>
    <script type="text/javascript" src="<?php $this->options->themeUrl('assets/mouse.js'); ?>"></script>
<?php endif; ?>

<!--置顶文章滚动支持-->
<?php if (!empty($this->options->sticky) && count(explode(',', strtr($this->options->sticky, ' ', ','))) > 1) : ?>
    <script type="text/javascript">
        setInterval(function() {
            var $parent = $('.js-slide-list');
            var $first = $parent.find('li:first');
            var height = $first.height();
            $first.animate({
                marginTop: -height + 'px'
            }, 500, function() {
                $first.css('marginTop', 0).appendTo($parent);
            });
        }, 2000);
    </script>
<?php endif; ?>

<!--网站加载动画-->
<?php if ($this->options->loadHtml) : ?>
    <script type="text/javascript">
        $("#loading").fadeOut(500);
    </script>
<?php endif; ?>

<!--多媒体背景-->
<?php add_background_media($this); ?>

<!--自定义尾部代码-->
<?php add_custom_footer(); ?>

<?php $this->footer(); ?>
</body>

</html>