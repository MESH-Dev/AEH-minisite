<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css"  charset="utf-8">
	<?php wp_head(); ?>
</head>
<body onload="window.print()" <?php body_class(); ?> id="<?php if(get_theme_mod('color_scheme')){echo get_theme_mod('color_scheme');}else{echo 'red';}; ?>">