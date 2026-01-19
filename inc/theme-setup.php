<?php
/**
 * Theme Setup
 *
 * @package Cpfauto
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 * 
 * This function is hooked to 'after_setup_theme' which runs after the theme
 * is loaded but before any other hooks. This is the standard place to register
 * theme features and support.
 */
function cpfauto_setup() {
    
    // Make theme available for translation
    // Loads translation files from /languages directory
    // Allows the theme to be translated into other languages
    load_theme_textdomain('cpfauto', CPFAUTO_DIR . '/languages');
    
    // Add default posts and comments RSS feed links to head
    // Automatically adds <link> tags for RSS feeds in the <head>
    // Users can subscribe to your blog's RSS feed
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    // WordPress will automatically generate <title> tags based on page context
    // Better for SEO than hardcoding titles
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails (Featured Images)
    // Allows posts and pages to have featured images
    // Essential for car dealer listings and blog posts
    add_theme_support('post-thumbnails');
    
    // Add custom image sizes for car dealer industry
    // These sizes are optimized for vehicle listings and galleries
    // Format: name, width, height, crop (true = hard crop, false = soft crop)
    add_image_size('cpfauto-featured', 1200, 675, true);  // Hero/featured images (16:9 ratio)
    add_image_size('cpfauto-thumbnail', 400, 300, true);  // Vehicle thumbnails (4:3 ratio)
    add_image_size('cpfauto-small', 300, 200, true);      // Small thumbnails/gallery
    
    // Register navigation menus
    // Creates menu locations that appear in Appearance > Menus
    // Users can assign custom menus to these locations
    register_nav_menus(array(
        'primary'   => esc_html__('Primary Menu', 'cpfauto'),    // Main header navigation
        'footer'    => esc_html__('Footer Menu', 'cpfauto'),     // Footer links
        'mobile'    => esc_html__('Mobile Menu', 'cpfauto'),     // Mobile-specific menu
    ));
    
    // Switch default core markup to output valid HTML5
    // Modernizes WordPress output to use HTML5 semantic elements
    // Improves accessibility and SEO
    add_theme_support('html5', array(
        'search-form',   // Modern search form markup
        'comment-form', // Modern comment form markup
        'comment-list', // Modern comment list markup
        'gallery',      // HTML5 gallery markup
        'caption',      // HTML5 caption markup
        'style',        // HTML5 style tag support
        'script',       // HTML5 script tag support
    ));
    
    // Add theme support for selective refresh for widgets
    // Enables live preview in Customizer when editing widgets
    // Better user experience during theme customization
    add_theme_support('customize-selective-refresh-widgets');
    
    // Add support for custom logo
    // Allows users to upload a logo via Appearance > Customize
    // Flexible dimensions for different logo sizes
    add_theme_support('custom-logo', array(
        'height'      => 100,      // Maximum height in pixels
        'width'       => 400,      // Maximum width in pixels
        'flex-height' => true,     // Allow flexible height
        'flex-width'  => true,     // Allow flexible width
    ));
    
    // Add support for wide and full alignment (Gutenberg)
    // Enables wide (1200px) and full-width blocks in the editor
    // Allows for more creative page layouts
    add_theme_support('align-wide');
    
    // Add support for responsive embeds
    // Automatically makes embedded content (YouTube, Vimeo, etc.) responsive
    // Prevents videos from breaking on mobile devices
    add_theme_support('responsive-embeds');
    
    // Add support for editor styles
    // Styles the Gutenberg editor to match the frontend
    // Better visual consistency when editing content
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
    
    // Add support for custom background
    // Allows users to set a custom background color/image
    // Appears in Appearance > Customize > Background
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff', // Default white background
    ));
    
    // Add excerpt support for pages
    // Allows pages (not just posts) to have excerpts
    // Useful for page listings and search results
    add_post_type_support('page', 'excerpt');
}
add_action('after_setup_theme', 'cpfauto_setup');

/**
 * Set the content width in pixels
 * 
 * This is used to determine the maximum width of embedded content
 * (videos, images, etc.) to ensure they don't overflow the container.
 * The value can be filtered by other themes or plugins.
 */
function cpfauto_content_width() {
    $GLOBALS['content_width'] = apply_filters('cpfauto_content_width', 1200);
}
add_action('after_setup_theme', 'cpfauto_content_width', 0);

/**
 * Register widget areas (sidebars)
 * 
 * Widget areas are regions where users can add widgets via
 * Appearance > Widgets. These are essential for flexible layouts.
 */
function cpfauto_widgets_init() {
    
    // Main Sidebar
    // Typically appears on blog posts and archive pages
    register_sidebar(array(
        'name'          => esc_html__('Main Sidebar', 'cpfauto'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here for the main sidebar.', 'cpfauto'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // Footer Widget Area 1
    // First column in footer (typically for company info, contact)
    register_sidebar(array(
        'name'          => esc_html__('Footer 1', 'cpfauto'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here for footer column 1.', 'cpfauto'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    // Footer Widget Area 2
    // Second column in footer (typically for quick links, services)
    register_sidebar(array(
        'name'          => esc_html__('Footer 2', 'cpfauto'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here for footer column 2.', 'cpfauto'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    // Footer Widget Area 3
    // Third column in footer (typically for social media, newsletter)
    register_sidebar(array(
        'name'          => esc_html__('Footer 3', 'cpfauto'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here for footer column 3.', 'cpfauto'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'cpfauto_widgets_init');
