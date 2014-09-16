<?php get_header();
	if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

	<?php get_template_part( 'partials/template', 'intro' ); ?>

	<?php
	$sponsors = get_field('footer_sponsors');
	$sections = get_field('sections');
	$i = 0;
	foreach($sections as $section){ ?>
		<div id="panel-<?php echo $i; ?>" class="jumpsection <?php echo $section['section_color']; ?>">
		<?php include(locate_template('partials/panel-'.$section['layout'].'.php')); ?>
		</div>
		<?php $i++; ?>
	<?php } ?>


<?php } } ?>
<?php get_footer(); ?>