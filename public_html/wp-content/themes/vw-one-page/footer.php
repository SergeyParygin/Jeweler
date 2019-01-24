<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package VW One Page
 */
?>
<div  id="footer" class="copyright-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <?php dynamic_sidebar('footer-1');?>
            </div>
            <div class="col-md-3 col-sm-3">
                <?php dynamic_sidebar('footer-2');?>
            </div>
            <div class="col-md-3 col-sm-3">
                <?php dynamic_sidebar('footer-3');?>
            </div>
            <div class="col-md-3 col-sm-3">
                <?php dynamic_sidebar('footer-4');?>
            </div>
        </div>
    </div>
</div>

<div id="footer-2">
  	<div class="copyright container">
        <p><?php echo esc_html(get_theme_mod('vw_one_page_footer_text',__('Copyright 2018 -','vw-one-page'))); ?> <?php vw_one_page_credit(); ?></p>
  	</div>
  	<div class="clear"></div>
</div>

<?php wp_footer(); ?>
</body>
</html>