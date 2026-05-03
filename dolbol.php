<?php
/**
 * Plugin Name: Dolbol
 * Plugin URI:  https://wordpress.org/plugins/dolbol
 * Description: Manages and displays team members using a shortcode.
 * Version:     0.1.0
 * Author:      Niloy Mahmud Apu
 * Author URI:  https://niloy.me
 * License:     GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dolbol
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DLBL_VERSION', '0.1.0' );
define( 'DLBL_DIR', plugin_dir_path( __FILE__ ) );
define( 'DLBL_URL', plugin_dir_url( __FILE__ ) );

function console_log( $data ) {
    file_put_contents(
        DLBL_DIR . 'console.log',
        print_r( $data, true ) . PHP_EOL,
        FILE_APPEND,
    );
}

require_once DLBL_DIR . 'includes/class-post-type.php';
require_once DLBL_DIR . 'includes/class-meta-box.php';
require_once DLBL_DIR . 'includes/class-shortcode.php';
require_once DLBL_DIR . 'includes/scripts-and-styles.php';

final class Dolbol {

	public static ?Dolbol $instance = null;

	public static function instance(): Dolbol {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		new DLBL_Post_Type();
		new DLBL_Meta_Box();
		new DLBL_Shortcode();
		new DLBL_Scripts_And_Styles();
	}
}

Dolbol::instance();