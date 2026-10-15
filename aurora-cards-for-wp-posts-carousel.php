<?php
/**
 * Plugin Name: Aurora Cards for WP Posts Carousel
 * Plugin URI: https://coolcatideas.com/products/wp-posts-carousel-aurora-cards/
 * Description: Gives posts, pages and linked WooCommerce products one consistent Aurora card style inside WP Posts Carousel All In One.
 * Version: 1.0.0
 * Author: Cool Cat Ideas
 * Author URI: https://coolcatideas.com/
 * Text Domain: aurora-cards-for-wp-posts-carousel
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Requires Plugins: wp-posts-carousel
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * SPDX-License-Identifier: GPL-2.0-or-later
 */

if (!defined('ABSPATH')) {
    exit;
}

define('WP_POSTS_CAROUSEL_AURORA_CARDS_DIR', plugin_dir_path(__FILE__));
define('WP_POSTS_CAROUSEL_AURORA_CARDS_URL', plugin_dir_url(__FILE__));

final class WP_Posts_Carousel_Aurora_Cards_Addon
{
    public function __construct()
    {
        add_filter('wp_posts_carousel_templates_paths', array($this, 'register_template_path'));
        add_action('admin_notices', array($this, 'dependency_notice'));
    }

    public function register_template_path($paths)
    {
        $paths[WP_POSTS_CAROUSEL_AURORA_CARDS_DIR . 'templates'] = WP_POSTS_CAROUSEL_AURORA_CARDS_URL . 'templates';

        return $paths;
    }

    public function dependency_notice()
    {
        if (defined('WP_POSTS_CAROUSEL_VERSION') || !current_user_can('activate_plugins')) {
            return;
        }

        echo '<div class="notice notice-warning"><p>'
            . esc_html__('Aurora Cards for WP Posts Carousel requires WP Posts Carousel All In One 2.0.0 or newer.', 'aurora-cards-for-wp-posts-carousel')
            . '</p></div>';
    }
}

add_action('plugins_loaded', static function () {
    new WP_Posts_Carousel_Aurora_Cards_Addon();
});
