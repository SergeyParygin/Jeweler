<?php
/**
 * The template part for displaying a message that posts cannot be found
 */
?>
<section class="no-results not-found">
	<header class="entry-header">
	    <br><h2 class="entry-title"><?php echo esc_html__( 'Nothing Found', 'saybusiness' ); ?></h2>
	</header><!-- .page-header --> 
	<div class="entry-content">
		<?php if ( is_search() ) : ?>
			<p><?php echo esc_html__( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'saybusiness' ); ?></p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p><?php echo esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'saybusiness' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->