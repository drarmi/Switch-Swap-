<?php
// Подключаем стили родительской темы
function storefront_child_enqueue_styles() {
    wp_enqueue_style('storefront-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('storefront-child-style', get_stylesheet_uri(), array('storefront-style'));
}
add_action('wp_enqueue_scripts', 'storefront_child_enqueue_styles');



// Define theme directory path if not already defined.
if ( ! defined( 'THEME_DIR_PATH' ) ) {
    define( 'THEME_DIR_PATH', untrailingslashit( get_template_directory() ) );
}

// Define theme directory URI if not already defined.
if ( ! defined( 'THEME_DIR_URI' ) ) {
    define( 'THEME_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}

// Define theme version if not already defined.
if ( ! defined( 'THEME_VERSION' ) ) {
    define( 'THEME_VERSION', gmdate( 'YmdHis' ) );
}

// Define nonce code if not already defined.
if ( ! defined( 'NONCE_CODE' ) ) {
    define( 'NONCE_CODE', untrailingslashit( get_template_directory_uri() ) );
}

// Include Composer autoload file.
require_once __DIR__ . '/vendor/autoload.php';

// Include autoloader file for theme classes.
require_once( trailingslashit( get_theme_file_path() ) . 'src/inc/class-autoloader.php' );

// Import necessary class for theme setup.
use Omnis\src\inc\classes\setup\Omnis_Theme;

// Get instance of the Omnis_Theme class to initiate theme setup.
Omnis_Theme::get_instance();