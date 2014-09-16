<?php
/**
 * Our custom dashboard page
 */

/** WordPress Administration Bootstrap */
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php' );
?>
<div class="wrap about-wrap">

	<h1><em><?php echo bloginfo('name'); ?></em> Editor</h1>

	<div class="about-text">
		Make changes to this minisite here.
		<div id="page" class="aeh">
		<?php $frontpage = get_site_option('editor_homepage'); ?>
			<a class="navi customize" href="<?php echo get_admin_url( get_current_blog_id(), 'customize.php' ); ?>">Customize Theme</a>
			<a class="navi frontpage" href="<?php echo get_admin_url( get_current_blog_id(), 'post.php?post='.$frontpage.'&action=edit' ); ?>">Edit Front-Page</a>
			<a class="navi agenda" href="<?php echo get_admin_url( get_current_blog_id(), 'edit.php?post_type=agenda' ); ?>">Add/Remove Agenda Events</a>
			<a class="navi settings" href="<?php echo get_admin_url( get_current_blog_id(), 'edit-tags.php?taxonomy=track&post_type=agenda' ); ?>">Add/Remove Tracks</a>
			<a class="navi settings" href="<?php echo get_admin_url( get_current_blog_id(), 'themes.php?page=custom-header' ); ?>">Edit/Upload Logo</a>
		</div>
	</div>
</div>
<?php include( ABSPATH . 'wp-admin/admin-footer.php' );