<?php
/**
 * Plugin Name: All in One Avada Addons
 * Plugin URI: http://www.advisionplus.com
 * Description: This is an addons collection for Avada Theme.
 * Version: 1.2.3
 * Author: Marco Pappalardo
 * Author URI: http://www.marcopappalardo.it
 * Domain Path: /languages
 * Text Domain: avada_addons
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

define('PLUGIN_URL', plugins_url('all-in-one-avada-addons/'));
define('PLUGIN_PATH', plugin_dir_path(__FILE__));

global $plugin_data;

if ( is_admin() ) {
    if( ! function_exists('get_plugin_data') ){
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }
    $plugin_data = get_plugin_data( __FILE__ );
}

define('AIO_PLUGIN_VERSION', $plugin_data['Version']);


function callback_for_setting_up_scripts() {
    wp_register_style( 'all-in-one-style', PLUGIN_URL.'assets/css/public/all-in-one-style.css');
    wp_enqueue_style( 'all-in-one-style' );
    wp_enqueue_script( 'global-jQuery', PLUGIN_URL.'assets/js/public/global.js', array(), false, true );  
}
add_action('wp_enqueue_scripts', 'callback_for_setting_up_scripts');

function callback_for_setting_up_scripts_admin() {
    wp_register_style( 'all-in-one-style-admin', PLUGIN_URL.'assets/css/admin/all-in-one-style-admin.css');
    wp_enqueue_style( 'all-in-one-style-admin' );
    wp_enqueue_script( 'global-jQuery', PLUGIN_URL.'assets/js/admin/global-admin.js', array(), false, true );  
}
add_action('admin_enqueue_scripts', 'callback_for_setting_up_scripts_admin');

add_action ('wp_enqueue_script', 'enqueue_scripts');

// Include Addon to add Credit.
include_once('builder-elements/credits.php');

// Include Addon to add Post Carousel.
include_once('builder-elements/post-carousel.php');

// Include Addon to add Post Card.
include_once('builder-elements/post-card.php');

// Include Addon to add Woocommerce products.
include_once('template/template-woo-product.php');

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/inc/aio-redux-core/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/inc/aio-redux-core/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/inc/aio-redux-core/config/config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/inc/aio-redux-core/config/config.php' );
}
if (file_exists( dirname( __FILE__ ) . '/function.php' ) ) {
    require_once( dirname( __FILE__ ) . '/function.php' );
}

/** REMOVE REDUX MESSAGES */
function remove_redux_messages() {
	if(class_exists('ReduxFramework')){
		remove_action( 'admin_notices', array( get_redux_instance('aio_avada'), '_admin_notices' ), 99);
	}
}

/** HOOK TO REMOVE REDUX MESSAGES */
add_action('init', 'remove_redux_messages');

// Show admin notice
function show_admin_notice_rating() {
	$class = 'notice notice-info is-dismissible';
	$message = __( 'Did you like all in one avada addons? Please leave us a review. For us it is important. <a target="_blank" href="https://wordpress.org/support/plugin/all-in-one-avada-addons/reviews/#new-post">Click here</a>', 'avada_addons' );

	printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), $message );
}
add_action( 'admin_notices', 'show_admin_notice_rating' );





function wpdocs_create_menu_and_submenu_page(){
    //add_menu_page( $page_title:string, $menu_title:string, $capability:string, $menu_slug:string, $function:callable, $icon_url:string, $position:integer|null )
    add_menu_page('Aio Avada Dashboard', 'Aio Avada', 'manage_options', 'aio_avada_dashboard', '', 'dashicons-avada', 3);
    //add_submenu_page( $parent_slug:string, $page_title:string, $menu_title:string, $capability:string, $menu_slug:string, $function:callable, $position:integer|null )
    add_submenu_page('aio_avada_dashboard', 'Dashboard', 'Dashboard', 'manage_options', 'aio_avada_dashboard', 'aio_submenu', 0);
}
add_action( 'admin_menu', 'wpdocs_create_menu_and_submenu_page' );

function aio_submenu(){
    echo '<div class="aio-header-dashboard"><img class="logo-aio-panel-options" src="'.PLUGIN_URL.'assets/img/all-in-one-avada-logo.svg'.'"><span class="aio-dash-plugin-name">All in One Avada Addons</span></div>';
    echo '<div class="aio-dashboard-areas">';
    echo '<div class="aio-dashboard-welcome-area">Welcome To Aio Avada Addons!</div>';
    echo '</div>';
}
