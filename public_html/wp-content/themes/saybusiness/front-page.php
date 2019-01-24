<?php
/**
* Front Page
*
*/
get_header(); ?>
	<?php 
		if( esc_html(get_theme_mod( 'saybusiness_show_slider','0')) == 1 ):
			if ( is_front_page() || is_home() ) {  
				saybusiness_slider();
			} 
		endif;
	?>
	<?php 
	if ( is_front_page() || is_home() ) {
	$saybusiness_show_pagearea = esc_html(get_theme_mod('saybusiness_show_pagearea', '0')); 
	if($saybusiness_show_pagearea  == 1) {
	if(esc_html(get_theme_mod('saybusiness_page-box1',true)) != '' && esc_html(get_theme_mod('saybusiness_page-box2',true)) != '' && esc_html(get_theme_mod('saybusiness_page-box3',true)) != '') { 
	$saybusiness_show_slider = esc_html(get_theme_mod('saybusiness_show_slider', '0'));
	$saybusiness_style_inner= "";
	$saybusiness_style_pagearea = "";
	if ($saybusiness_show_slider == 0 && $saybusiness_show_pagearea  == 1) :  
		$saybusiness_style_pagearea = "height: 600px";
		$saybusiness_style_inner = "top: 80px";
		
	endif;
	?>
	<section id="pagearea" style="<?php echo $saybusiness_style_pagearea; ?>"> 
		<div class="container"> 
			<div class="row">  
				<div class="pagearea-inner" style="<?php echo $saybusiness_style_inner; ?>"> 
				<?php for($f=1; $f<4; $f++) { ?>
				<?php if(esc_html(get_theme_mod('saybusiness_page-box'.$f)) != '') { ?>
				<?php $page_query = new WP_Query(array('page_id' => esc_html(get_theme_mod('saybusiness_page-box'.$f)))); ?>
				<?php while( $page_query->have_posts() ) : $page_query->the_post(); ?> 
				<div class="fourbox col-sm-4"> 
					<div class="thumbbx"><?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?></div> 
					<div class="fourbxcontent"> 
						<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>  
						<p><?php the_excerpt(); ?></p> 
						<a class="button" href="<?php the_permalink(); ?>"><?php _e('Read More','saybusiness'); ?></a> 
					</div> 
				</div> 
				<?php endwhile; ?>
				<?php } } ?>
				<div class="clear"></div>
				</div>
			</div>
		</div> 
	</section>
 	<?php
				} 
			}
		}
	?>   
	<?php 
		if ( is_front_page() || is_home() ) {
		$saybusiness_show_about = esc_html(get_theme_mod('saybusiness_show_about', '0'));
		if($saybusiness_show_about == 1) { 
	?>
		<section id="about"> 
			<div class="container"> 
				<div class="row"> 
					<?php 
						$args = array('page_id' => esc_html(get_theme_mod('saybusiness_page-about')));
						$query = new WP_Query($args);
						if($query->have_posts()): 
						while($query->have_posts()) : $query->the_post();
					?> 
					<div class="col-sm-6"> 
						<div class="thumbbx">
							<a href="<?php the_permalink(); ?>"><?php if(has_post_thumbnail()) { ?><?php the_post_thumbnail(); ?><?php } ?></a>
						</div>
					</div>
					<div class="col-sm-6"> 
						<div class="fourbxcontent">
							<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
							<p><?php the_excerpt(); ?></p>
							<a class="button" href="<?php the_permalink(); ?>"><?php _e('Read More','saybusiness'); ?></a>
						</div>
					</div>
					<?php
						endwhile;
						endif;
						wp_reset_postdata();
					?>
				</div>
			</div> 
		</section> 
	<?php 
			}
		}
	?>   
<div class="clear"></div> 
<?php 
	$saybusiness_show_slider = esc_html(get_theme_mod('saybusiness_show_slider', '0'));
	$saybusiness_show_pagearea = esc_html(get_theme_mod('saybusiness_show_pagearea', '0'));
	$saybusiness_style_sitecontent = "";
	if ($saybusiness_show_slider == 0 && $saybusiness_show_pagearea  == 1) :
		$saybusiness_style_sitecontent = "top: 15px";
	endif;
?>
<div class="container-fluid">
	<?php if ( is_active_sidebar( 'sidebar-homepage' )  ) : ?>
		<?php dynamic_sidebar( 'sidebar-homepage' ); ?> 
	<?php endif; ?> 
</div>  
<?php 
	if ( is_page_template( 'template-parts/page-full-width.php' ) ) {
?>
	<div class="site-content" style="<?php echo $saybusiness_style_sitecontent; ?>">
		<div class="container">
			<div class="row"> 
				<div id="primary" class="col-sm-12">
					<main id="main" class="">
						<?php get_template_part( 'template-parts/content', 'page' ); ?>
					</main>
				</div>
			</div>
		</div>
	</div>
	<?php
	} else { 
	?>
	<div class="site-content" style="<?php echo $saybusiness_style_sitecontent; ?>">
		<div class="container">
			<div class="row"> 
				<div id="primary" class="col-sm-9">
					<main id="main" class="site-main">  
						<?php 
							if ( have_posts() ) : 
								// Start the loop.
								while ( have_posts() ) : the_post(); 
									// Include the Post-Format-specific template for the content.
									if(is_page()):
										get_template_part( 'template-parts/content', 'page' );
									else :
										get_template_part( 'template-parts/content', 'loop' );
									endif;
								endwhile; 
								// Previous/next page navigation.
								the_posts_pagination( array(
									'prev_text'          => esc_html__( 'Previous page', 'saybusiness' ),
									'next_text'          => esc_html__( 'Next page', 'saybusiness' ),
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'saybusiness' ) . ' </span>',
								) );
							// If no content, include the "No posts found" template.
							else :
								get_template_part( 'template-parts/content', 'none' );
							endif;						
						?>				
					</main>
				</div><!-- .content-area -->   
				<div id="secondary" class="col-sm-3">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div> 
	</div>
<?php 
	}
?> 
	<?php 
		if ( is_front_page() || is_home() ) {
		$saybusiness_show_action = esc_html(get_theme_mod('saybusiness_show_action', '0')); 
		if($saybusiness_show_action == 1) {  
			$args = array('page_id' => esc_html(get_theme_mod('saybusiness_page-action')));
			$query = new WP_Query($args);
			if($query->have_posts()):
			while($query->have_posts()) : $query->the_post();
	?>
		<section id="action" style="background: url(<?php  if ( has_post_thumbnail() ) { echo get_the_post_thumbnail_url(); } ?>) no-repeat center center / cover; background-attachment: fixed;">
			<div class="container">
				<div class="row">  
					<div class="col-sm-10 col-sm-offset-1 text-center">  
						<div class="action-content">
							<h3 style="color: #fff !important;"><?php the_title(); ?></h3> 
							<div style="color: #fff !important;"><?php the_excerpt(); ?></div>
							<a class="button" href="<?php the_permalink(); ?>"><?php _e('Read more','saybusiness'); ?></a> 
						</div>
					</div>  
				</div>
			</div> 
		</section>  
	<?php
			endwhile;
			endif;
			wp_reset_postdata();
			}
		} 
	?> 
<?php get_footer(); ?>