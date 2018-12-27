<?php
/**
 * Template Name: League Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

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
                <h1>
                        <?php global $current_user;
                        get_currentuserinfo();
                        echo $current_user->league;?>
                    </h1>

					<?php
                    
                        // The Query
                        $user_query = new WP_User_Query( $current_user->league );

                        // User Loop
                        if ( ! empty( $user_query->get_results() ) ) {
                            foreach ( $user_query->get_results() as $user ) {
                                echo '<p>' . $user->teamName . '</p>';
                            }
                        } else {
                            echo 'No users found.';
                        }
                        ?>

				</main><!-- #main -->

			</div><!-- #primary -->

		</div><!-- .row end -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
