<?php
/**
 * Plugin Name: Aurora Cards for CCI Posts Carousel
 * Plugin URI: https://coolcatideas.com/products/cci-posts-carousel-aurora-cards/
 * Description: Gives posts, pages and linked WooCommerce products one consistent Aurora card style inside CCI Posts Carousel.
 * Version: 1.0.1
 * Author: Cool Cat Ideas
 * Author URI: https://coolcatideas.com/
 * Text Domain: aurora-cards-for-cci-posts-carousel
 * Requires at least: 6.2
 * Requires PHP: 7.4
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * SPDX-License-Identifier: GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WP_Posts_Carousel_Aurora_Cards_Addon', false ) ) {

	define( 'WP_POSTS_CAROUSEL_AURORA_CARDS_DIR', plugin_dir_path( __FILE__ ) );
	define( 'WP_POSTS_CAROUSEL_AURORA_CARDS_URL', plugin_dir_url( __FILE__ ) );

	final class WP_Posts_Carousel_Aurora_Cards_Addon {

		public function __construct() {
			add_filter( 'wp_posts_carousel_templates_paths', array( $this, 'register_template_path' ) );
			add_action( 'admin_notices', array( $this, 'dependency_notice' ) );
		}

		public function register_template_path( $paths ) {
			$paths[ WP_POSTS_CAROUSEL_AURORA_CARDS_DIR . 'templates' ] = WP_POSTS_CAROUSEL_AURORA_CARDS_URL . 'templates';

			return $paths;
		}

		public function dependency_notice() {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return;
			}

			if ( defined( 'WP_POSTS_CAROUSEL_VERSION' ) && version_compare( (string) WP_POSTS_CAROUSEL_VERSION, '2.0.0', '>=' ) ) {
				return;
			}

			echo '<div class="notice notice-warning"><p>'
			. esc_html__( 'Aurora Cards requires CCI Posts Carousel 2.0.0 or newer. Install and activate the main plugin, or update it if you have an older version. Then open the carousel editor and select Aurora Cards under Design > Template.', 'aurora-cards-for-cci-posts-carousel' )
			. ' <a href="' . esc_url( admin_url( 'plugins.php' ) ) . '">'
			. esc_html__( 'Manage plugins', 'aurora-cards-for-cci-posts-carousel' )
			. '</a></p></div>';
		}
	}

	add_action(
		'plugins_loaded',
		static function () {
			new WP_Posts_Carousel_Aurora_Cards_Addon();
		}
	);

}
