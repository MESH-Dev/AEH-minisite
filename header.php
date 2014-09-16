<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" charset="utf-8">
	<?php wp_head(); ?>
	<!--[if lt IE 9]>
		<script src="<?php bloginfo('template_directory'); ?>/js/html5shiv.js"></script>
	<![endif]-->
</head>
<body <?php body_class(); ?> id="<?php if(get_theme_mod('color_scheme')){echo get_theme_mod('color_scheme');}else{echo 'red';}; ?>">
<header id="header">
	<div class="container">
		<div class="gutter clearfix">
			<div id="logo">
				<a href="#intro"><img alt="<?php bloginfo('description'); ?>" src="<?php header_image(); ?>"></a>
			</div>
			<nav id="primary">
			<?php
				if(has_nav_menu('main-nav')){
				$defaults = array(
					'theme_location'  => 'main-nav',
					'menu'            => 'main-nav',
					'container'       => '',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'menu',
					'menu_id'         => 'main-nav',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          => ''
				);
			wp_nav_menu( $defaults );
			}else{

			} ?>
				<ul id="main-nav" class="menu">
					<?php $sections = get_field('sections');
					$i = 0;
					foreach($sections as $section){ ?>
						<li><a href="#panel-<?php echo $i; ?>"><?php echo $section['section_title']; ?></a></li>
					<?php $i++; } ?>
				</ul>
			</nav>

			<div id="utility">
				<div id="conf-details">
					<span class="location"><?php the_field('location'); ?></span>
					<span class="time"><?php the_field('date'); ?></span>
				</div>
				<div class="social">
					<!-- AddThis Button BEGIN -->
						<div class="addthis_toolbox addthis_32x32_style" style="">
						<a class="addthis_button_facebook"></a>
						<a class="addthis_button_twitter"></a>
						<a class="addthis_button_linkedin"></a>
						<a class="addthis_button_email"></a>
						<a class="addthis_button_compact"></a>
						</div>
						<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
						<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=naphsyscom"></script>
						<!-- AddThis Button END -->
				</div>
			</div>
		</div>
	</div>
</header>