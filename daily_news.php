<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://natnaelti.com
 * @since             1.0.0
 * @package           Daily_news
 *
 * @wordpress-plugin
 * Plugin Name:       Daily News
 * Plugin URI:        https://daily_news.org
 * Description:       Daily news and information around the world plugin.
 * Version:           1.0.0
 * Author:            Natnael
 * Author URI:        https://natnaelti.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       daily_news
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DAILY_NEWS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-daily_news-activator.php
 */
function activate_daily_news() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-daily_news-activator.php';
	Daily_news_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-daily_news-deactivator.php
 */
function deactivate_daily_news() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-daily_news-deactivator.php';
	Daily_news_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_daily_news' );
register_deactivation_hook( __FILE__, 'deactivate_daily_news' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-daily_news.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */



function run_daily_news() {

	$plugin = new Daily_news();
	$plugin->run();

}
run_daily_news();
