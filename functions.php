<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( '/inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

add_action( 'show_user_profile', 'team_field' );
add_action( 'edit_user_profile', 'team_field' );

function team_field( $user ) { ?>
    <table class="form-table">
    <tr>
        <th><label for="teamName"><?php _e("Team Name"); ?></label></th>
        <td>
            <input type="text" name="teamName" id="teamName" value="<?php echo esc_attr( get_the_author_meta( 'teamName', $user->ID ) ); ?>" class="regular-text" />
        </td>
    </tr>
    </table>
<?php }

add_action( 'show_user_profile', 'league_field' );
add_action( 'edit_user_profile', 'league_field' );

function league_field( $user ) { ?>
    <table class="form-table">
    <tr>
        <th><label for="league"><?php _e("League Name"); ?></label></th>
        <td>
            <input type="text" name="league" id="league" value="<?php echo esc_attr( get_the_author_meta( 'league', $user->ID ) ); ?>" class="regular-text" />
        </td>
    </tr>
    </table>
<?php }

add_action( 'show_user_profile', 'team_list_field' );
add_action( 'edit_user_profile', 'team_list_field' );

function team_list_field( $user ) { ?>
    <table class="form-table">
    <tr>
        <th><label for="teamList"><?php _e("Team List"); ?></label></th>
        <td>
            <textarea name="teamList" id="teamList" value="<?php echo esc_attr( get_the_author_meta( 'teamList', $user->ID ) ); ?>" class="regular-text" ></textarea>
        </td>
    </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

add_role(
    'team_manager',
    __( 'Team Manager' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
    )
);

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
	update_user_meta( $user_id, 'teamName', $_POST['teamName'] );
	update_user_meta( $user_id, 'league', $_POST['league'] );
}