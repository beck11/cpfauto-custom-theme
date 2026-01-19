<?php
/**
 * Enqueue scripts and styles
 *
 * @package Cpfauto
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue stylesheets
 */
function cpfauto_enqueue_styles() {
    
    // Main stylesheet (compiled Tailwind CSS)
    wp_enqueue_style(
        'cpfauto-style',
        CPFAUTO_URI . '/assets/css/main.css',
        array(),
        file_exists(CPFAUTO_DIR . '/assets/css/main.css') ? filemtime(CPFAUTO_DIR . '/assets/css/main.css') : '1.0.0'
    );
    
    // Google Fonts - Professional Car Dealer Typography
    // Combination 1: Playfair Display (elegant serif) + Inter (clean sans-serif) - Luxury & Sophisticated
    // Combination 2: Montserrat (modern sans-serif) + Inter (body) - Professional & Trustworthy
    // Combination 3: Bebas Neue (bold display) + Source Sans Pro (readable) - Bold & Automotive
    // 
    // Current implementation: Playfair Display + Inter + Montserrat (hybrid approach)
    wp_enqueue_style(
        'cpfauto-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@300;400;600;700&display=swap',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'cpfauto_enqueue_styles');

/**
 * Enqueue scripts
 */
function cpfauto_enqueue_scripts() {
    
    // GSAP Core Library
    wp_enqueue_script(
        'gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
        array(),
        '3.12.5',
        true
    );
    
    // GSAP ScrollTrigger Plugin
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
        array('gsap'),
        '3.12.5',
        true
    );
    
    // Navigation script
    wp_enqueue_script(
        'cpfauto-navigation',
        CPFAUTO_URI . '/assets/js/navigation.js',
        array(),
        file_exists(CPFAUTO_DIR . '/assets/js/navigation.js') ? filemtime(CPFAUTO_DIR . '/assets/js/navigation.js') : '1.0.0',
        true
    );
    
    // GSAP Animations
    wp_enqueue_script(
        'cpfauto-animations',
        CPFAUTO_URI . '/assets/js/animations.js',
        array('gsap', 'gsap-scrolltrigger'),
        file_exists(CPFAUTO_DIR . '/assets/js/animations.js') ? filemtime(CPFAUTO_DIR . '/assets/js/animations.js') : '1.0.0',
        true
    );
    
    // Vehicle Cards Animations
    wp_enqueue_script(
        'cpfauto-vehicle-cards',
        CPFAUTO_URI . '/assets/js/vehicle-cards.js',
        array('gsap'),
        file_exists(CPFAUTO_DIR . '/assets/js/vehicle-cards.js') ? filemtime(CPFAUTO_DIR . '/assets/js/vehicle-cards.js') : '1.0.0',
        true
    );
    
    // Testimonials Carousel
    wp_enqueue_script(
        'cpfauto-testimonials',
        CPFAUTO_URI . '/assets/js/testimonials.js',
        array('gsap'),
        file_exists(CPFAUTO_DIR . '/assets/js/testimonials.js') ? filemtime(CPFAUTO_DIR . '/assets/js/testimonials.js') : '1.0.0',
        true
    );
    
    // Footer Scripts
    wp_enqueue_script(
        'cpfauto-footer',
        CPFAUTO_URI . '/assets/js/footer.js',
        array('gsap', 'gsap-scrolltrigger'),
        file_exists(CPFAUTO_DIR . '/assets/js/footer.js') ? filemtime(CPFAUTO_DIR . '/assets/js/footer.js') : '1.0.0',
        true
    );
    
    // Main JavaScript
    wp_enqueue_script(
        'cpfauto-main',
        CPFAUTO_URI . '/assets/js/main.js',
        array('jquery'),
        file_exists(CPFAUTO_DIR . '/assets/js/main.js') ? filemtime(CPFAUTO_DIR . '/assets/js/main.js') : '1.0.0',
        true
    );
    
    // Localize script with theme data
    wp_localize_script('cpfauto-main', 'cpfautoData', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('cpfauto_nonce'),
        'homeUrl' => home_url('/'),
        'themeUrl' => CPFAUTO_URI,
    ));
    
    // Comments script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'cpfauto_enqueue_scripts');

/**
 * Conditionally load GSAP only on specific pages (Performance Optimization)
 */
function cpfauto_conditional_gsap() {
    // Example: Only load on front page and specific templates
    if (!is_front_page() && !is_page_template('template-animated.php')) {
        wp_dequeue_script('gsap');
        wp_dequeue_script('gsap-scrolltrigger');
        wp_dequeue_script('cpfauto-animations');
    }
}
// Uncomment to enable conditional loading:
// add_action('wp_enqueue_scripts', 'cpfauto_conditional_gsap', 20);

/**
 * Add async/defer attributes to scripts
 */
function cpfauto_add_async_defer($tag, $handle) {
    
    // Scripts to defer
    $defer_scripts = array(
        'cpfauto-main',
        'cpfauto-navigation',
    );
    
    // Scripts to async
    $async_scripts = array(
        'gsap',
        'gsap-scrolltrigger',
    );
    
    if (in_array($handle, $defer_scripts)) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    if (in_array($handle, $async_scripts)) {
        return str_replace(' src', ' async src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'cpfauto_add_async_defer', 10, 2);

/**
 * Preload critical assets
 */
function cpfauto_preload_assets() {
    // Preload main CSS
    if (file_exists(CPFAUTO_DIR . '/assets/css/main.css')) {
        echo '<link rel="preload" href="' . esc_url(CPFAUTO_URI . '/assets/css/main.css') . '" as="style">';
    }
    
    // Preload fonts
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action('wp_head', 'cpfauto_preload_assets', 1);
