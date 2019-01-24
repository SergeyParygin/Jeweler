<?php
/**
 * The template part for displaying single post
 */
?> 
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 
	<?php if( has_post_thumbnail() ) { ?>
		<div class="entry-header">
			<div class="article-cover"> 
				<?php
					$image = ''; 
					$title_attribute = get_the_title( $post->ID ); 
					$image .= '<a href="' . get_the_post_thumbnail_url() . '" title="'.the_title( '', '', false ).'" data-lightbox="image-1" rel="image-1">';
					$image .= get_the_post_thumbnail( $post->ID, '', array( 'title' => esc_attr( $title_attribute ),  'alt' => esc_attr( $title_attribute ) ) ).'</a>'; 
					echo $image; 
				?>  
				<div class="entry-footer-absolute">
					<?php saybusiness_entry_meta(); 
							echo '<span>';
							$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
									// Construct sharing URL
							$twitterURL = 'https://twitter.com/intent/tweet?text='.get_the_title().'&amp;url='.get_permalink();
							$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.get_permalink();
							$googleURL = 'https://plus.google.com/share?url='.get_permalink();
							$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.get_permalink().'&amp;media='.$post_thumbnail[0].'&amp;description='.get_the_title();
							$mailURL = 'mailto:?Subject='.get_the_title().'&amp;Body='.get_permalink();

							echo '<div class="saybusiness-share-buttons">';
							echo '<a target="_blank" href="'.$facebookURL.'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
							echo '<a target="_blank" href="'. $twitterURL .'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
							echo '<a target="_blank" href="'.$googleURL.'" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';
							echo '<a target="_blank" href="'.$pinterestURL.'" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>';
							echo '<a target="_blank" href="'.$mailURL.'"><i class="fa fa-envelope" aria-hidden="true"></i></a>'; 
							echo '</div>';		
							echo '</span>';	?>
				</div><!-- .entry-footer -->  
			</div>
				<h2 class="entry-title">
					<?php the_title(); ?>
				</h2>
		</div><!-- .entry-header --> 
	<?php } else { ?>
		<div class="entry-header">  
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_title(); ?>
					</a>
				</h2>
		</div><!-- .entry-header --> 
		<div class="entry-footer-relative">
			<?php saybusiness_entry_meta(); 
							echo '<span>';
							$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
									// Construct sharing URL
							$twitterURL = 'https://twitter.com/intent/tweet?text='.get_the_title().'&amp;url='.get_permalink();
							$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.get_permalink();
							$googleURL = 'https://plus.google.com/share?url='.get_permalink();
							$pinterestURL = 'https://pinterest.com/pin/create/button/?url='.get_permalink().'&amp;media='.$post_thumbnail[0].'&amp;description='.get_the_title();
							$mailURL = 'mailto:?Subject='.get_the_title().'&amp;Body='.get_permalink();

							echo '<div class="saybusiness-share-buttons">';
							echo '<a target="_blank" href="'.$facebookURL.'" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
							echo '<a target="_blank" href="'. $twitterURL .'" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
							echo '<a target="_blank" href="'.$googleURL.'" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';
							echo '<a target="_blank" href="'.$pinterestURL.'" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>';
							echo '<a target="_blank" href="'.$mailURL.'"><i class="fa fa-envelope" aria-hidden="true"></i></a>'; 
							echo '</div>';		
							echo '</span>'; ?>
		</div><!-- .entry-footer -->						
	<?php } ?>
	<div class="entry-content">
		<?php 
			the_content( null, true );
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'saybusiness' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'saybusiness' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) ); 
				get_template_part( 'template-parts/biography' ); 
			?>
	</div><!-- .entry-content -->    
</article><!-- #post-## -->