<?php
/**
 * The template part for displaying slider
 *
 * @package VW One Page
 * @subpackage vw-one-page
 * @since VW One Page 1.0
 */
?>
<div class="col-md-4 col-sm-4">
	<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
	    <div class="post-main-box">
	      	<div class="box-image">
	          	<?php 
		            if(has_post_thumbnail()) { 
		              the_post_thumbnail(); 
		            }
	          	?>
	        </div>
	        <h3 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h3>      
	        <div class="new-text">
	          	<?php the_excerpt();?>
	        </div>
	        <div class="content-bttn">
		    	<a href="<?php echo esc_url( get_permalink() );?>" title="<?php esc_attr_e( 'Read More','vw-one-page' ); ?>"><?php esc_html_e('READ MORE','vw-one-page'); ?></a>
		    </div>
	    </div>
	    <div class="clearfix"></div>
  	</div>
</div>