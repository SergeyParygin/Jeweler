<?php
/**
 * The template for displaying search results pages
 *
 */
get_header(); ?>
<div class="site-content">
	<div class="container">
		<div class="row">
			<div id="primary" class="col-sm-9">
				<main id="main" class="site-main">
					<?php if ( have_posts() ) : ?>
						<header class="page-header">
							<h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'saybusiness' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
						</header><!-- .page-header -->
						<?php
						// Start the loop.
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content', 'search' );
						// End the loop.
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
				</main><!-- .site-main -->
			</div><!-- .content-area -->
			<div id="secondary" class="col-sm-3">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>