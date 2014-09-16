<?php
// ----- Includes
define( 'ACF_LITE' , true );
include_once('includes/advanced-custom-fields/acf.php' );
include_once('includes/acf-repeater/acf-repeater.php');
include_once('includes/ACF-limiter-field-wysiwyg/acf-limiter.php');
include_once('includes/mce-table-buttons/mce_table_buttons.php');
include_once('includes/acf-wordpress-wysiwyg-field-master/acf-wp_wysiwyg.php');
include_once('includes/acf-field-date-time-picker-master/acf-date_time_picker.php');

// ----- Theme Customizer
function minisite_customize_register( $wp_customize ) {
	$wp_customize->add_setting( 'color_scheme' , array(
	    'default'     => 'red',
	    'transport'   => 'refresh',
	) );

    $wp_customize->add_control( 'color_scheme', array(
	    'label'   => 'Color Scheme',
	    'section' => 'colors',
	    'type'    => 'select',
	    'choices'    => array(
	        'red'  => 'Red',
	        'blue' => 'Blue',
	        'teal' => 'Teal',
	        'grey' => 'Grey'
	        ),
	) );

}
add_action( 'customize_register', 'minisite_customize_register' );
function color_swatch_script(){
	echo '<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>';
	echo '<script src="'.get_template_directory_uri().'/js/customizer.js"></script>';
	echo '<link href="'.get_template_directory_uri().'/css/customizer.css" rel="stylesheet" type="text/css">';
}
add_action( 'customize_controls_print_scripts', 'color_swatch_script' );

// ----- Theme Scripts
function theme_scripts() {
	wp_enqueue_script('headroom',get_bloginfo('template_directory').'/js/headroom.js');
	wp_enqueue_script('jquery-headroom',get_bloginfo('template_directory').'/js/jquery.headroom.js',array( 'jquery' ));
	wp_enqueue_script('aeh-minisite',get_bloginfo('template_directory').'/js/aeh-minisite.js',array( 'jquery' ));
}

add_action( 'wp_enqueue_scripts', 'theme_scripts' );


// ----- Header Support
$args = array(
	'width'         => 365,
	'height'        => 90,
	'flex-height'	=> true,
	'flex-width'	=> true,
	'default-image' => get_template_directory_uri() . '/img/default-logo.png',
);
add_theme_support( 'custom-header', $args );

// ----- Menus
register_nav_menus( array(
	'main-nav' => 'Main Menu',
	'social' => 'Social Menu'
) );

// ----- Agenda Post Type and Taxonomy
function register_agenda() {
  $labels = array(
    'name'               => 'Agenda',
    'singular_name'      => 'Agenda',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Agenda',
    'edit_item'          => 'Edit Agenda',
    'new_item'           => 'New Agenda',
    'all_items'          => 'All Agenda',
    'view_item'          => 'View Agenda',
    'search_items'       => 'Search Agenda',
    'not_found'          => 'No Agenda found',
    'not_found_in_trash' => 'No Agenda found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'Agenda'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'agenda-events' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  );

  register_post_type( 'agenda', $args );
}
add_action( 'init', 'register_agenda' );
add_action( 'init', 'tracks_taxonomies', 0 );

function tracks_taxonomies() {
	$labels = array(
		'name'              => _x( 'Tracks', 'taxonomy general name' ),
		'singular_name'     => _x( 'Track', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Tracks' ),
		'all_items'         => __( 'All Tracks' ),
		'parent_item'       => __( 'Parent Track' ),
		'parent_item_colon' => __( 'Parent Track:' ),
		'edit_item'         => __( 'Edit Track' ),
		'update_item'       => __( 'Update Track' ),
		'add_new_item'      => __( 'Add New Track' ),
		'new_item_name'     => __( 'New Track Name' ),
		'menu_name'         => __( 'Track' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'track' ),
	);

	register_taxonomy( 'track', array( 'agenda' ), $args );
}


// ----- Streamline Admin
	//Admin CSS
	function load_custom_wp_admin_style() {
        wp_register_style( 'minisite-css', get_template_directory_uri() . '/css/admin.css', false, '1.0.0' );
        wp_enqueue_style( 'minisite-css' );
	}
	add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );


	//Edit Admin Bar
	function custom_toolbar() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');
		$wp_admin_bar->remove_menu('updates');
		$wp_admin_bar->remove_menu('view-site');
		$wp_admin_bar->remove_menu('new-link');
		$wp_admin_bar->remove_menu('new-user');
		$wp_admin_bar->remove_menu('new-post');
		$wp_admin_bar->remove_menu('comments');
		$wp_admin_bar->remove_menu('edit');
		$wp_admin_bar->remove_menu('new-content');
		$wp_admin_bar->remove_menu('comments');
		$wp_admin_bar->remove_menu('site-name');
		$wp_admin_bar->remove_menu('search');
		$wp_admin_bar->remove_menu('site-name');
		$wp_admin_bar->remove_menu('my-account');
		$wp_admin_bar->remove_menu('view');

		$frontpage = get_site_option('editor_homepage');

		$args = array(
			'id'     => 'homepage',
			'title'  => __('Go to '.get_bloginfo('name')),
			'href'   => site_url(),
		);
		$wp_admin_bar->add_menu( $args );

		$args = array(
			'id'     => 'Customize',
			'title'  => __( 'Customize Theme', 'text_domain' ),
			'href'   => get_admin_url( get_current_blog_id(), 'customize.php' ),
		);
		$wp_admin_bar->add_menu( $args );

		$args = array(
			'id'     => 'Edit-FrontPage',
			'title'  => __( 'Edit Front-Page', 'text_domain' ),
			'href'   => get_admin_url( get_current_blog_id(), 'post.php?post='.$frontpage.'&action=edit' ),
		);
		$wp_admin_bar->add_menu( $args );

		$args = array(
			'id'     => 'Agenda-Events',
			'title'  => __( 'Add/Remove Agenda Events', 'text_domain' ),
			'href'   => get_admin_url( get_current_blog_id(), 'edit.php?post_type=agenda' ),
		);
		$wp_admin_bar->add_menu( $args );

		$args = array(
			'id'     => 'Tracks-Tax',
			'title'  => __( 'Add/Remove Tracks', 'text_domain' ),
			'href'   => get_admin_url( get_current_blog_id(), 'edit-tags.php?taxonomy=track&post_type=agenda' ),
		);
		$wp_admin_bar->add_menu( $args );
		$args = array(
			'id'     => 'Tracks-Tax',
			'title'  => __( 'WP Engine', 'text_domain' ),
			'href'   => get_admin_url( get_current_blog_id(), 'admin.php?page=wpengine-common' ),
		);
		$wp_admin_bar->add_menu( $args );

	}
	add_action( 'wp_before_admin_bar_render', 'custom_toolbar', 999 );

	//Menu
function minisite_admin_menu(){
	remove_menu_page('edit.php?post_type=page');			//Pages
	remove_menu_page('edit.php');							//Posts
	remove_menu_page('tools.php');							//Tools
	remove_menu_page('upload.php');							//Media
	remove_menu_page('edit-comments.php');					//Comments
	remove_menu_page('plugins.php');						//Plugins
	remove_menu_page('users.php');						//Users
}
add_action('admin_menu','minisite_admin_menu');
	//Submenu
function minisite_admin_submenu(){
	remove_submenu_page( 'themes.php', 'theme-editor.php' );				//Theme Editor
	remove_submenu_page( 'options-general.php', 'options-discussion.php' );	//Discussions Settings
	remove_submenu_page( 'options-general.php', 'options-reading.php' );	//Reading Settings
	remove_submenu_page( 'options-general.php', 'options-writing.php' );	//Writing Settings
}
add_action('admin_init', 'minisite_admin_submenu');
	//Dashboard
function remove_dashboard_widgets(){
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   		// Right Now
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); 	// Recent Comments
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  	// Incoming Links
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   			// Plugins
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); 			// Quick Press
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  		// Recent Drafts
    remove_meta_box('dashboard_primary', 'dashboard', 'side');   			// WordPress blog
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');   			// Other WordPress News
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

// ----- Create Page on Theme Load
function theme_activation_trigger(){
	/*Delete Existing Posts
	$args = array(
		'post_type' 	 => array('post','page'),
		'posts_per_page' => -1,
		'post_status'	 => 'any'
	);
	$posts = get_posts($args);
	foreach($posts as $post){
		wp_delete_post($post->ID,true);
	}*/

	//Create New Post
	$newpost = array(
		'post_title'	=> get_bloginfo('name'),
		'post_content'  => 'Placeholder content for '.get_bloginfo('name'),
		'post_status'	=> 'publish',
		'post_type'		=> 'page'
	);
	$post_id = wp_insert_post($newpost, true);
	update_site_option( 'page_on_front', $post_id );
	update_site_option( 'show_on_front', 'page' );
	add_site_option('editor_homepage',$post_id);
	update_site_option('editor_homepage',$post_id);
	update_site_option('permalink_structure','/%postname%/');

	//Placeholder Content
	add_post_meta($post_id, 'location', 'Fort Lauderdale, Florida', true);
	add_post_meta($post_id, 'date', 'June 17-21. 2014', true);
	add_post_meta($post_id, 'intro_left_column', '<strong>America’s Essential Hospitals</strong> invites you to it’s 2014 annual conference, to be held in Fort Lauderdale, Florida June 17-21. This year’s event will feature Lorem ipsum.', true);
	add_post_meta($post_id, 'intro_left_column_first', '<strong>This year’s event features</strong> lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis .nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', true);
	add_post_meta($post_id, 'intro_left_column_second', '<strong>Join nearly 300 peers and experts</strong> as we address topics ranging from health information technology and the power of patient engagement to integrated care delivery and population health. The program also will include the latest developments in health care policy, the federal budget and CMS regulations.  esse cillum dolore eu fugiat nulla pariatur.', true);
	add_post_meta($post_id, 'registration_label', 'Register Now »', true);
	add_post_meta($post_id, 'registration_link', 'www.google.com', true);
	add_post_meta($post_id, 'intro_right_column', '<p><strong>LOCATION</strong><br>Fort Lauderdale, Florida</p><p><strong>SAVE THE DATE</strong><br>June 17-21, 2014</p><p><strong>EARLYBIRD SIGN UP</strong><br>Mar 22, 2014</p><p><strong>DEADLINE FOR SIGN UP</strong><br>June 10, 2014</p><p><em>** Any other secondary info can go here, or more lists, like above.</em></p>', true);
	add_post_meta($post_id, 'intro_sponsors', '<h3>2014 Sponsors</h3><table border="0"><tbody><tr><td>Sponsor Name One</td><td>Sponsor Name One</td><td>Sponsor Name One</td><td>Sponsor Name One</td><td>Sponsor Name One</td></tr><tr><td>Sponsor Name Two</td><td>Sponsor Name Two</td><td>Sponsor Name Two</td><td>Sponsor Name Two</td><td>Sponsor Name Two</td></tr><tr><td>Sponsor Name Three</td><td>Sponsor Name Three</td><td>Sponsor Name Three</td><td>Sponsor Name Three</td><td>Sponsor Name Three</td></tr></tbody></table>', true);
	add_post_meta($post_id, 'sections', '0', true);
	add_post_meta($post_id, 'footer', '0', true);

}
add_action('after_switch_theme', 'theme_activation_trigger');

// ----- Add Included Custom Fields
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_agenda-fields',
		'title' => 'Agenda Fields',
		'fields' => array (
			array (
				'key' => 'field_529e265379022',
				'label' => 'Date & Location',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_52a5d1bab38a8',
				'label' => 'Date',
				'name' => 'date',
				'type' => 'date_time_picker',
				'required' => 1,
				'show_date' => 'true',
				'date_format' => 'mm/dd/yy',
				'time_format' => 'h:mm tt',
				'show_week_number' => 'false',
				'picker' => 'select',
				'save_as_timestamp' => 'true',
				'get_as_timestamp' => 'true',
			),
			array (
				'key' => 'field_529ceea60ae9f',
				'label' => 'Time',
				'name' => 'time',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '8:00 AM - 12:00 PM',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_529cee6c52d77',
				'label' => 'Location',
				'name' => 'location',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_529e265f79023',
				'label' => 'More Information',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_529e268779025',
				'label' => 'Add Tracks?',
				'name' => 'track',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_529e26a079026',
				'label' => 'Tracks',
				'name' => 'tracks',
				'type' => 'repeater',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_529e268779025',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'sub_fields' => array (
					array (
						'key' => 'field_52a5fa908f3d3',
						'label' => 'Tracks',
						'name' => 'tracks_new',
						'type' => 'taxonomy',
						'column_width' => '',
						'taxonomy' => 'track',
						'field_type' => 'checkbox',
						'allow_null' => 0,
						'load_save_terms' => 0,
						'return_format' => 'object',
						'multiple' => 0,
					),
					array (
						'key' => 'field_52a5e0e323802',
						'label' => 'Title',
						'name' => 'title',
						'type' => 'limiter',
						'required' => 1,
						'column_width' => '',
						'character_number' => 60,
						'displayCount' => 0,
					),
					array (
						'key' => 'field_529e26d179029',
						'label' => 'Location',
						'name' => 'location',
						'type' => 'text',
						'required' => 1,
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_52a5e10723803',
						'label' => 'Information',
						'name' => 'information',
						'type' => 'wp_wysiwyg',
						'required' => 1,
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
						'character_number' => 400,
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Track',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'agenda',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_minisite-sections',
		'title' => 'Minisite Sections',
		'fields' => array (
			array (
				'key' => 'field_529cd336f7746',
				'label' => 'Header',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_529cd344f7747',
				'label' => 'Location',
				'name' => 'location',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => 'townsville, pokey oaks',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_529cd372f7748',
				'label' => 'Date',
				'name' => 'date',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => 'January 1-2nd, 2014',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_529648d4e2da3',
				'label' => 'Intro',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_52964961e2da6',
				'label' => 'Left Column - Intro',
				'name' => 'intro_left_column',
				'type' => 'wp_wysiwyg',
				'required' => 1,
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'no',
			),
			array (
				'key' => 'field_5296491fe2da4',
				'label' => 'Left Column - Left',
				'name' => 'intro_left_column_first',
				'type' => 'wp_wysiwyg',
				'required' => 1,
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_52964952e2da5',
				'label' => 'Left Column - Right',
				'name' => 'intro_left_column_second',
				'type' => 'wp_wysiwyg',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_529649bcc9ca5',
				'label' => 'Registration Label',
				'name' => 'registration_label',
				'type' => 'text',
				'default_value' => 'Register Now »',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_529649a1c9ca4',
				'label' => 'Registration Link',
				'name' => 'registration_link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'www.website.com',
				'prepend' => 'http://',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5296498dc9ca3',
				'label' => 'Right Column',
				'name' => 'intro_right_column',
				'type' => 'wp_wysiwyg',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'yes',
			),
			array (
				'key' => 'field_529cdae14f6e3',
				'label' => 'Sponsors',
				'name' => 'intro_sponsors',
				'type' => 'wp_wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'no',
			),
			array (
				'key' => 'field_529649e3eb5a5',
				'label' => 'Sections',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_529647902524e',
				'label' => 'Sections',
				'name' => 'sections',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_529647db25250',
						'label' => 'Section Layout',
						'name' => 'layout',
						'type' => 'select',
						'required' => 1,
						'column_width' => '',
						'choices' => array (
							'half' => '1/2 & 1/2',
							'third' => '2/3 & 1/3',
							'agenda' => 'Agenda',
							'speaker' => 'Speakers',
							'image' => 'Image Strip',
						),
						'default_value' => '',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_529f575fbd777',
						'label' => 'Section Title',
						'name' => 'section_title',
						'type' => 'text',
						'instructions' => 'Used in top nav to direct to section on site. ie: Topics in the main nav would then direct to the Topics section.',
						'required' => 1,
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_52a23fe5b0147',
						'label' => 'Section Color',
						'name' => 'section_color',
						'type' => 'select',
						'column_width' => '',
						'choices' => array (
							'red' => 'Red',
							'blue' => 'Blue',
							'teal' => 'Teal',
							'grey' => 'Grey',
						),
						'default_value' => '',
						'allow_null' => 0,
						'multiple' => 0,
					),
					array (
						'key' => 'field_529ce16d2df00',
						'label' => 'Left Column - Title',
						'name' => 'half_left_column_title',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_529647db25250',
									'operator' => '==',
									'value' => 'half',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_52a0eb0a75a39',
						'label' => 'Left Column - Title',
						'name' => 'third_left_column_title',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_529647db25250',
									'operator' => '==',
									'value' => 'third',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_529ce1962df01',
						'label' => 'Left Column - Content',
						'name' => 'half_left_column_content',
						'type' => 'wp_wysiwyg',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_529647db25250',
									'operator' => '==',
									'value' => 'half',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
					array (
						'key' => 'field_529ce1b92df02',
						'label' => 'Right Column - Title',
						'name' => 'half_right_column_title',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_529647db25250',
									'operator' => '==',
									'value' => 'half',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_52a0eb2475a3a',
						'label' => 'Right Column - Title',
						'name' => 'third_right_column_title',
						'type' => 'text',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_529647db25250',
									'operator' => '==',
									'value' => 'third',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_529ce1d32df03',
						'label' => 'Right Column - Left',
						'name' => 'half_right_column_left',
						'type' => 'wp_wysiwyg',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_529647db25250',
									'operator' => '==',
									'value' => 'half',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
					array (
						'key' => 'field_52a0eb3675a3b',
						'label' => 'Right Column - Left',
						'name' => 'third_right_column_left',
						'type' => 'wp_wysiwyg',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_529647db25250',
									'operator' => '==',
									'value' => 'third',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
					array (
						'key' => 'field_529ce20e2df04',
						'label' => 'Right Column - Right',
						'name' => 'half_right_column_right',
						'type' => 'wp_wysiwyg',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_529647db25250',
									'operator' => '==',
									'value' => 'half',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
					array (
						'key' => 'field_52a0eb4575a3c',
						'label' => 'Right Column - Right',
						'name' => 'third_right_column_right',
						'type' => 'wp_wysiwyg',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_529647db25250',
									'operator' => '==',
									'value' => 'third',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'full',
						'media_upload' => 'yes',
					),
					array (
						'key' => 'field_529e4c93a3303',
						'label' => 'Speakers',
						'name' => 'speakers',
						'type' => 'repeater',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_529647db25250',
									'operator' => '==',
									'value' => 'speaker',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_529e4cb1a3304',
								'label' => 'Name',
								'name' => 'name',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_529e4cb8a3305',
								'label' => 'Portrait',
								'name' => 'portrait',
								'type' => 'image',
								'column_width' => '',
								'save_format' => 'url',
								'preview_size' => 'thumbnail',
								'library' => 'all',
							),
							array (
								'key' => 'field_529e4cc4a3306',
								'label' => 'Session',
								'name' => 'session',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array (
								'key' => 'field_529e4cd6a3307',
								'label' => 'Description',
								'name' => 'description',
								'type' => 'wp_wysiwyg',
								'column_width' => '',
								'default_value' => '',
								'toolbar' => 'basic',
								'media_upload' => 'no',
							),
						),
						'row_min' => '',
						'row_limit' => '',
						'layout' => 'row',
						'button_label' => 'Add Speaker',
					),
					array (
						'key' => 'field_529f5828179d5',
						'label' => 'Add/Remove Agenda Events',
						'name' => '',
						'type' => 'message',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_529647db25250',
									'operator' => '==',
									'value' => 'agenda',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'message' => 'To modify Agenda events, go to the <em>Add/Remove Agenda Events</em> button from the Dashboard',
					),
					array (
						'key' => 'field_52a5d24b7e15e',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'conditional_logic' => array (
							'status' => 1,
							'rules' => array (
								array (
									'field' => 'field_529647db25250',
									'operator' => '==',
									'value' => 'image',
								),
							),
							'allorany' => 'all',
						),
						'column_width' => '',
						'save_format' => 'url',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Section',
			),
			array (
				'key' => 'field_529e5582f262f',
				'label' => 'Footer',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_529e558df2630',
				'label' => 'Sponsors',
				'name' => 'footer_sponsors',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_529e5596f2631',
						'label' => 'Logo',
						'name' => 'logo',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'url',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_529e55a5f2632',
						'label' => 'URL',
						'name' => 'url',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => 'www.website.com',
						'prepend' => 'http://',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
				1 => 'excerpt',
				2 => 'custom_fields',
				3 => 'discussion',
				4 => 'comments',
				5 => 'revisions',
				6 => 'slug',
				7 => 'author',
				8 => 'format',
				9 => 'featured_image',
				10 => 'categories',
				11 => 'tags',
				12 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}

// ----- Custom Dashboard
class rc_sweet_custom_dashboard {
	function __construct() {
		add_action('admin_menu', array( &$this,'rc_scd_register_menu') );
		add_action('load-index.php', array( &$this,'rc_scd_redirect_dashboard') );
	}
	function rc_scd_redirect_dashboard() {
		if( is_admin() ) {
			$screen = get_current_screen();
			if( $screen->base == 'dashboard' ) {
				wp_redirect( admin_url( 'index.php?page=dashboard' ) );
			}
		}
	}
	function rc_scd_register_menu() {
		add_dashboard_page( 'Dashboard', 'Dashboard', 'read', 'dashboard', array( &$this,'rc_scd_create_dashboard') );
	}
	function rc_scd_create_dashboard() {
		include_once( 'includes/custom_dashboard.php'  );
	}
}
$GLOBALS['sweet_custom_dashboard'] = new rc_sweet_custom_dashboard();




?>