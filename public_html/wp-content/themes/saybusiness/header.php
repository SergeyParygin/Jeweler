<?php
/**
 * The template for displaying the header
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?> 
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">   
	<header id="header" class="site-header affix"> 
	<nav class="navbar">
        <div class="container">
          <div class="navbar-header">
            <div type="button" class="navbar-toggle collapsed menu-toggle visible-sm visible-xs" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <i class="icon-menu" aria-hidden="true"></i>
			</div>
			<span class="site-branding">
				<?php saybusiness_the_custom_logo(); ?> 
				<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html(bloginfo( 'name' )); ?></a>  
				<?php $description = esc_html(get_bloginfo( 'description', 'display' )); ?> 
				<?php  if ( $description ) : ?> 
					<span class="site-description" itemprop="description"><?php echo $description; ?></span> 
				<?php endif; ?>
			</span> 
          </div>
          <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" aria-label="<?php esc_html__( 'Primary Menu', 'saybusiness' ); ?>">
            <ul id="site-nav" class="nav navbar-nav main-nav" role="navigation">
			<div class="nav-menu">
				<?php
					wp_nav_menu( array(
						'theme_location' => 'primary', 
						'container' 	 => false,
						'fallback_cb'    => 'saybusiness_primary_menu_fallback',
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>', 
						) );
				?>
			</div>
			<div class="search-top hidden-sm hidden-xs">
				<i class="icon-search" aria-hidden="true"></i>
			</div>
			<div class="search-form-top hidden" style="display: block;">
				<?php get_search_form(); ?>
			</div>
            </ul> 
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
	</header><!-- .site-header --> 
		<?php if ( get_header_image() ) : ?>
			<?php  $custom_header_sizes = apply_filters( 'saybusiness_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1920px' ); ?>
			<div class="header-image">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id ) ); ?>" sizes="<?php echo esc_attr( $custom_header_sizes ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>
			</div><!-- .header-image -->
		<?php endif; // End header image check. ?> 
		<?php if( !( is_front_page() ) ) { ?>
		<div class="page-title-bar">
			<div class="container"> 
				<div class="row">
					<div class="col-sm-12">
						<?php do_action('saybusiness_action_breadcrumb'); ?> 
					</div>
				</div> 
			</div>
			</div> 
		<?php } ?>
<div id="content">
