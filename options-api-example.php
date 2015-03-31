<?php
/**
 * This file is optional. It is an example implementation of the image uploader using the options API
 */

namespace Marslender\ImageSelect;

add_action( 'admin_menu', 'Marslender\ImageSelect\add_admin_page' );
add_action( 'admin_init', 'Marslender\ImageSelect\register_settings' );

function get_settings_page_slug() {
	return 'example-media-uploader';
}

function get_settings_section() {
	return 'example-media-uploader';
}

function add_admin_page() {
	add_menu_page( 'Example Media Upload', 'Example Media Upload', 'edit_others_posts', get_settings_page_slug(), 'Marslender\ImageSelect\render_example_media', 'dashicons-admin-media' );
}

function register_settings() {
	// Add our section, so we can actually get these guys to render..
	add_settings_section( get_settings_section(), 'Settings Section Title', '__return_null', get_settings_page_slug() );

	// ----- REPEAT THIS SECTION FOR EACH UPLOAD FIELD YOU NEED, ADJUSTING VALUES AS NECESSARY -------

	$option_name = 'cmm-example-upload-1';
	// These get passed to the callback, so in this case, its the args for render_image_select
	$render_args = array(
		'label' => 'Render Image Select Label 1',
		'name' => $option_name,
		'image_id' => get_option( $option_name, 0 ),
	);
	add_settings_field( $option_name, 'Settings Field Title 1', 'Marslender\ImageSelect\render_image_select', get_settings_page_slug(), get_settings_section(), $render_args );
	register_setting( get_settings_section(), $option_name, 'intval' );

	// ------------------------------ END REPEATING SECTION ------------------------------------------

	// ----- REPEAT OF ABOVE, WITH VALUES ADJUSTED ACCORDINGLY -------

	$option_name = 'cmm-example-upload-2';
	// These get passed to the callback, so in this case, its the args for render_image_select
	$render_args = array(
		'label' => 'Render Image Select Label 2',
		'name' => $option_name,
		'image_id' => get_option( $option_name, 0 ),
	);
	add_settings_field( $option_name, 'Settings Field Title 2', 'Marslender\ImageSelect\render_image_select', get_settings_page_slug(), get_settings_section(), $render_args );
	register_setting( get_settings_section(), $option_name, 'intval' );

	// ------------------------------ END REPEATING SECTION ------------------------------------------
}

function render_example_media() {
	?>
	<div class="wrap">

		<h2>Example Media Page</h2>

		<?php settings_errors(); ?>

		<form method="post" action="<?php echo esc_url( admin_url( 'options.php' ) ); ?>">
			<?php
			settings_fields( get_settings_page_slug() ); // the nonce, action, etc
			do_settings_sections( get_settings_page_slug() ); // the actual fields
			submit_button();
			?>
		</form>

	</div>
<?php
}
