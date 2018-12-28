<?php
/**
 * Template Name: Create League Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

$error = array(); 
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
    if ( count($error) == 0 ) {
        //action hook for plugins and extra fields saving

        $post_information = array(
            'post_title' => wp_strip_all_tags( $_POST['league'] ),
            'post_type' => 'post',
            'post_status' => 'pending'
        );
        wp_insert_post( $post_information );
        do_action('edit_user_profile_update', $current_user->ID);

        wp_redirect( '/league' );
        exit;
    }
}

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="full-width-page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12 content-area" id="primary">

				<main class="site-main" id="main" role="main">
                <form action="<?php the_permalink(); ?>" id="primaryPostForm" method="POST">
                    
                        <label for="league"><?php _e('League Name:', 'framework') ?></label>
                 
                        <input autocomplete="off" type="text" name="league" id="league" class="required" value="<?php echo esc_attr( get_the_author_meta( 'league', $user->ID ) ); ?>"/>
                 
                        <input type="hidden" name="submitted" id="submitted" value="true" />

                        <p class="form-submit">
                            <?php echo $referer; ?>
                            <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Create League', 'profile'); ?>" />
                            <?php wp_nonce_field( 'update-user' ) ?>
                            <input name="action" type="hidden" id="action" value="update-user" />
                        </p><!-- .form-submit -->
                 
                </form>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
