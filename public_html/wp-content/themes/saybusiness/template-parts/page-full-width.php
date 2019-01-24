<?php
/*
Template Name: Page full-width
*/ 
get_header(); ?> 
<div class="site-content">
	<div class="container">
		<div class="row"> 
			<div id="primary" class="col-sm-12">
				<main id="main" class="site-main"> 
					<?php if (!is_active_sidebar( 'sidebar-homepage' )  ) : ?>  
						<?php
							while ( have_posts() ) : the_post();  
								get_template_part( 'template-parts/content', 'page' );  
							endwhile;
						?> 
					<?php endif; ?> 					
				</main>
			</div><!-- .content-area -->   
		</div>
	</div>
</div>
<?php get_footer(); ?>