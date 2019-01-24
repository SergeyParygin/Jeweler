<?php
/**
 * The template for displaying the footer
 *
 */
?> 
	<div class="clear"></div> 
	<div class="container">
		<div class="row"> 
			<?php if ( is_active_sidebar( 'footer' ) ) { ?>
				<div class="footer-widgets">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			<?php } ?> 
		</div>
	</div>
	<div class="clear"></div> 
	<div class="container">
		<div class="row"> 
			<footer id="colophon" class="site-footer"> 
				<div class="col-sm-9"> 
					<span class="copyright">
						<?php 
							$saybusiness_copyright_text = esc_html(get_theme_mod('saybusiness_copyright_text'));
							if($saybusiness_copyright_text):
								echo esc_html($saybusiness_copyright_text);  
							endif;
						?>
						<?php 
							if( get_theme_mod( 'saybusiness_show_credits') == 1):  
								printf( esc_html__( ' Powered by %1$s', 'saybusiness' ), '<a href="' . esc_url( __( 'https://wordpress.org', 'saybusiness' ) ) . '" target="_blank">' . esc_html__( 'WordPress', 'saybusiness' ) . '</a>.' );
							endif;
						?> 
					</span>
				</div><!-- .site-info -->   
				<div class="col-sm-3">
					<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation" aria-label="<?php echo esc_html__( 'Footer Social links Menu', 'saybusiness' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>',
							) );
						?>
					</nav><!-- .social-navigation -->
					<?php endif; ?>
				</div>
			</footer><!-- .site-footer -->
			<a href="#header" id="scroll-up"><i class="icon-keyboard_arrow_up" aria-hidden="true"></i></a> 
		</div>
	</div>
</div><!-- .site --> 
<?php wp_footer(); ?>
</body>
</html>