# Classic WordPress Theme Development Template

> **CUSTOMIZATION REQUIRED**: Replace the following placeholders throughout this document:
> - `[CPF Auto]` - Your theme name (e.g., "Corporate Pro", "Agency Theme")
> - `[Tailwind]` - Choose either "Bootstrap" or "Tailwind"
> - `[Car dealer]` - Target industry (e.g., "real estate", "restaurant", "law firm", "e-commerce")
> - `[#15153f]` - Main brand color (e.g., "#3B82F6", "#10B981")
> - `[#be1e2e]` - Secondary brand color
> - `[#febf00]` - Accent/highlight color
> - `[#1F2937]` - Main text color (e.g., "#1F2937")
> - `[#FFFFFF]` - Background color (e.g., "#FFFFFF")

---

## Project Overview

**Theme Name**: `[CPF Auto]`  
**Type**: Classic WordPress Theme  
**CSS Framework**: `[tailwind]`  
**Animation Library**: GSAP 3.x  
**Target Industry**: `[car dealer]`  
**WordPress Version**: 6.9+  
**PHP Version**: 7.4+

---

## Color Scheme

```css
/* Brand Colors */
--primary-color: [#15153f];
--secondary-color: [#be1e2e];
--accent-color: [#febf00];

/* Text Colors */
--text-primary: [#1F2937];
--text-secondary: #6B7280;
--text-light: #9CA3AF;

/* Background Colors */
--bg-primary: [#FFFFFF];
--bg-secondary: #F9FAFB;
--bg-dark: #111827;

/* UI Colors */
--border-color: #E5E7EB;
--success: #10B981;
--warning: #F59E0B;
--error: #EF4444;
```

---

## Project Structure

```
[THEME_NAME]/
├── assets/
│   ├── css/
│   │   ├── main.css                # Compiled CSS (generated)
│   │   └── editor-style.css        # Gutenberg editor styles
│   ├── js/
│   │   ├── main.js                 # Main JavaScript
│   │   ├── animations.js           # GSAP animations
│   │   └── navigation.js           # Menu/navigation logic
│   ├── images/
│   │   ├── logo.svg
│   │   └── placeholder.jpg
│   └── src/
│       └── style.css               # Source CSS (you edit this)
├── template-parts/
│   ├── content/
│   │   ├── content.php             # Default post content
│   │   ├── content-single.php      # Single post content
│   │   └── content-page.php        # Page content
│   ├── header/
│   │   ├── site-header.php         # Main header
│   │   └── site-navigation.php     # Navigation menu
│   └── footer/
│       └── site-footer.php         # Main footer
├── inc/
│   ├── theme-setup.php             # Theme configuration
│   ├── enqueue.php                 # Script/style enqueuing
│   ├── custom-functions.php        # Custom helper functions
│   ├── customizer.php              # Theme customizer options
│   └── security.php                # Security functions
├── style.css                        # Theme header (required)
├── functions.php                    # Main functions file
├── index.php                        # Main fallback template
├── header.php                       # Site header
├── footer.php                       # Site footer
├── sidebar.php                      # Sidebar template
├── page.php                         # Single page template
├── single.php                       # Single post template
├── archive.php                      # Archive template
├── search.php                       # Search results
├── 404.php                          # Not found page
├── comments.php                     # Comments template
├── screenshot.png                   # Theme preview (1200x900px)
├── package.json                     # Node dependencies
├── [CSS_FRAMEWORK].config.js       # CSS framework config
└── README.md                        # Documentation
```

---

## Phase 1: Initial Setup

### 1.1 Create Theme Folder

```bash
cd wp-content/themes
mkdir [THEME_NAME]
cd [THEME_NAME]
```

### 1.2 Initialize Package Manager

```bash
npm init -y
```

### 1.3 Install Dependencies

**For Tailwind CSS:**
```bash
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init
```

**For Bootstrap:**
```bash
npm install bootstrap
npm install -D sass
```

### 1.4 Configure Build Scripts

**package.json** (update scripts section):

**For Tailwind:**
```json
{
  "scripts": {
    "dev": "tailwindcss -i ./assets/src/style.css -o ./assets/css/main.css --watch",
    "build": "tailwindcss -i ./assets/src/style.css -o ./assets/css/main.css --minify",
    "watch": "npm run dev"
  }
}
```

**For Bootstrap:**
```json
{
  "scripts": {
    "dev": "sass --watch assets/src/style.scss:assets/css/main.css",
    "build": "sass assets/src/style.scss:assets/css/main.css --style=compressed",
    "watch": "npm run dev"
  }
}
```

---

## Phase 2: CSS Framework Configuration

### 2.1 Tailwind Configuration

**tailwind.config.js**:
```javascript
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './template-parts/**/*.php',
    './inc/**/*.php',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        primary: '[PRIMARY_COLOR]',
        secondary: '[SECONDARY_COLOR]',
        accent: '[ACCENT_COLOR]',
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
        heading: ['Poppins', 'sans-serif'],
      },
      spacing: {
        '128': '32rem',
        '144': '36rem',
      },
      animation: {
        'fade-in': 'fadeIn 0.6s ease-in-out',
        'slide-up': 'slideUp 0.6s ease-out',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
  ],
  // Safelist for WordPress-generated classes
  safelist: [
    'alignwide',
    'alignfull',
    'wp-block-image',
    'current-menu-item',
    'menu-item',
    'sub-menu',
    {
      pattern: /^wp-/,
    },
  ],
}
```

**assets/src/style.css** (Tailwind):
```css
@tailwind base;
@tailwind components;
@tailwind utilities;

/* Custom Base Styles */
@layer base {
  :root {
    --color-primary: [PRIMARY_COLOR];
    --color-secondary: [SECONDARY_COLOR];
    --color-accent: [ACCENT_COLOR];
  }
  
  body {
    @apply text-gray-900 font-sans antialiased;
  }
  
  h1, h2, h3, h4, h5, h6 {
    @apply font-heading font-bold;
  }
}

/* Custom Components */
@layer components {
  .btn-primary {
    @apply bg-primary text-white px-6 py-3 rounded-lg font-semibold 
           hover:bg-primary/90 transition-all duration-300 
           focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2;
  }
  
  .btn-secondary {
    @apply bg-secondary text-white px-6 py-3 rounded-lg font-semibold 
           hover:bg-secondary/90 transition-all duration-300;
  }
  
  .container-custom {
    @apply max-w-7xl mx-auto px-4 sm:px-6 lg:px-8;
  }
  
  .section-padding {
    @apply py-16 md:py-24;
  }
  
  .card {
    @apply bg-white rounded-xl shadow-lg p-6 
           hover:shadow-xl transition-shadow duration-300;
  }
}

/* WordPress Core Styles */
@layer utilities {
  .alignwide {
    @apply max-w-screen-xl mx-auto;
  }
  
  .alignfull {
    @apply w-full max-w-none;
  }
  
  .wp-block-image img {
    @apply max-w-full h-auto;
  }
}
```

### 2.2 Bootstrap Configuration

**assets/src/style.scss** (Bootstrap):
```scss
// Custom Variables - Override Bootstrap defaults
$primary: [PRIMARY_COLOR];
$secondary: [SECONDARY_COLOR];
$success: #10B981;
$danger: #EF4444;
$warning: #F59E0B;
$info: #3B82F6;

$font-family-sans-serif: 'Inter', system-ui, -apple-system, sans-serif;
$font-family-heading: 'Poppins', sans-serif;

$border-radius: 0.5rem;
$border-radius-lg: 1rem;

// Import Bootstrap
@import "~bootstrap/scss/bootstrap";

// Custom Styles
body {
  font-family: $font-family-sans-serif;
  color: [TEXT_COLOR];
}

h1, h2, h3, h4, h5, h6 {
  font-family: $font-family-heading;
  font-weight: 700;
}

// Custom Button Styles
.btn-custom-primary {
  background-color: $primary;
  border-color: $primary;
  color: white;
  font-weight: 600;
  padding: 0.75rem 1.5rem;
  border-radius: $border-radius-lg;
  transition: all 0.3s ease;
  
  &:hover {
    background-color: darken($primary, 10%);
    border-color: darken($primary, 10%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba($primary, 0.3);
  }
}

// Custom Card Styles
.card-custom {
  border: none;
  border-radius: $border-radius-lg;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  
  &:hover {
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    transform: translateY(-4px);
  }
}

// Section Spacing
.section-padding {
  padding: 4rem 0;
  
  @media (min-width: 768px) {
    padding: 6rem 0;
  }
}

// WordPress Alignment Classes
.alignwide {
  max-width: 1200px;
  margin-left: auto;
  margin-right: auto;
}

.alignfull {
  width: 100%;
  max-width: none;
}

.wp-block-image img {
  max-width: 100%;
  height: auto;
}
```

---

## Phase 3: WordPress Core Files

### 3.1 style.css (Theme Header)

```css
/*
Theme Name: [THEME_NAME]
Theme URI: https://yoursite.com/[THEME_NAME]
Author: Your Name
Author URI: https://yoursite.com
Description: Professional [INDUSTRY] WordPress theme built with [CSS_FRAMEWORK] and GSAP animations. Features modern design, smooth animations, and optimized performance for [INDUSTRY] websites.
Version: 1.0.0
Requires at least: 6.0
Tested up to: 6.4
Requires PHP: 7.4
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: [THEME_NAME]
Tags: [INDUSTRY], [CSS_FRAMEWORK], responsive, custom-menu, featured-images, threaded-comments, translation-ready
*/

/* 
 * This file is only for the theme header.
 * All styling is handled by [CSS_FRAMEWORK] in assets/css/main.css
 */
```

### 3.2 functions.php (Main Hub)

```php
<?php
/**
 * [THEME_NAME] functions and definitions
 *
 * @package [THEME_NAME]
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('[THEME_NAME]_VERSION', '1.0.0');
define('[THEME_NAME]_DIR', get_template_directory());
define('[THEME_NAME]_URI', get_template_directory_uri());

// Include theme setup
require_once [THEME_NAME]_DIR . '/inc/theme-setup.php';

// Include enqueue scripts
require_once [THEME_NAME]_DIR . '/inc/enqueue.php';

// Include custom functions
require_once [THEME_NAME]_DIR . '/inc/custom-functions.php';

// Include theme customizer
require_once [THEME_NAME]_DIR . '/inc/customizer.php';

// Include security functions
require_once [THEME_NAME]_DIR . '/inc/security.php';
```

### 3.3 inc/theme-setup.php

```php
<?php
/**
 * Theme Setup
 *
 * @package [THEME_NAME]
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function [THEME_NAME]_setup() {
    
    // Make theme available for translation
    load_theme_textdomain('[THEME_NAME]', [THEME_NAME]_DIR . '/languages');
    
    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');
    
    // Let WordPress manage the document title
    add_theme_support('title-tag');
    
    // Enable support for Post Thumbnails
    add_theme_support('post-thumbnails');
    
    // Add custom image sizes for [INDUSTRY]
    add_image_size('[THEME_NAME]-featured', 1200, 675, true);
    add_image_size('[THEME_NAME]-thumbnail', 400, 300, true);
    add_image_size('[THEME_NAME]-small', 300, 200, true);
    
    // Register navigation menus
    register_nav_menus(array(
        'primary'   => esc_html__('Primary Menu', '[THEME_NAME]'),
        'footer'    => esc_html__('Footer Menu', '[THEME_NAME]'),
        'mobile'    => esc_html__('Mobile Menu', '[THEME_NAME]'),
    ));
    
    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');
    
    // Add support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Add support for wide and full alignment (Gutenberg)
    add_theme_support('align-wide');
    
    // Add support for responsive embeds
    add_theme_support('responsive-embeds');
    
    // Add support for editor styles
    add_theme_support('editor-styles');
    add_editor_style('assets/css/editor-style.css');
    
    // Add support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));
    
    // Add excerpt support for pages
    add_post_type_support('page', 'excerpt');
}
add_action('after_setup_theme', '[THEME_NAME]_setup');

/**
 * Set the content width in pixels
 */
function [THEME_NAME]_content_width() {
    $GLOBALS['content_width'] = apply_filters('[THEME_NAME]_content_width', 1200);
}
add_action('after_setup_theme', '[THEME_NAME]_content_width', 0);

/**
 * Register widget areas
 */
function [THEME_NAME]_widgets_init() {
    
    // Main Sidebar
    register_sidebar(array(
        'name'          => esc_html__('Main Sidebar', '[THEME_NAME]'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here for the main sidebar.', '[THEME_NAME]'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    // Footer Widget Area 1
    register_sidebar(array(
        'name'          => esc_html__('Footer 1', '[THEME_NAME]'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here for footer column 1.', '[THEME_NAME]'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    // Footer Widget Area 2
    register_sidebar(array(
        'name'          => esc_html__('Footer 2', '[THEME_NAME]'),
        'id'            => 'footer-2',
        'description'   => esc_html__('Add widgets here for footer column 2.', '[THEME_NAME]'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
    
    // Footer Widget Area 3
    register_sidebar(array(
        'name'          => esc_html__('Footer 3', '[THEME_NAME]'),
        'id'            => 'footer-3',
        'description'   => esc_html__('Add widgets here for footer column 3.', '[THEME_NAME]'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', '[THEME_NAME]_widgets_init');
```

### 3.4 inc/enqueue.php

```php
<?php
/**
 * Enqueue scripts and styles
 *
 * @package [THEME_NAME]
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue stylesheets
 */
function [THEME_NAME]_enqueue_styles() {
    
    // Main stylesheet (compiled [CSS_FRAMEWORK])
    wp_enqueue_style(
        '[THEME_NAME]-style',
        [THEME_NAME]_URI . '/assets/css/main.css',
        array(),
        filemtime([THEME_NAME]_DIR . '/assets/css/main.css')
    );
    
    // Google Fonts (customize based on your design)
    wp_enqueue_style(
        '[THEME_NAME]-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700;800&display=swap',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', '[THEME_NAME]_enqueue_styles');

/**
 * Enqueue scripts
 */
function [THEME_NAME]_enqueue_scripts() {
    
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
        '[THEME_NAME]-navigation',
        [THEME_NAME]_URI . '/assets/js/navigation.js',
        array(),
        filemtime([THEME_NAME]_DIR . '/assets/js/navigation.js'),
        true
    );
    
    // GSAP Animations
    wp_enqueue_script(
        '[THEME_NAME]-animations',
        [THEME_NAME]_URI . '/assets/js/animations.js',
        array('gsap', 'gsap-scrolltrigger'),
        filemtime([THEME_NAME]_DIR . '/assets/js/animations.js'),
        true
    );
    
    // Main JavaScript
    wp_enqueue_script(
        '[THEME_NAME]-main',
        [THEME_NAME]_URI . '/assets/js/main.js',
        array('jquery'),
        filemtime([THEME_NAME]_DIR . '/assets/js/main.js'),
        true
    );
    
    // Localize script with theme data
    wp_localize_script('[THEME_NAME]-main', '[THEME_NAME]Data', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('[THEME_NAME]_nonce'),
        'homeUrl' => home_url('/'),
        'themeUrl' => [THEME_NAME]_URI,
    ));
    
    // Comments script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', '[THEME_NAME]_enqueue_scripts');

/**
 * Conditionally load GSAP only on specific pages (Performance Optimization)
 */
function [THEME_NAME]_conditional_gsap() {
    // Example: Only load on front page and specific templates
    if (!is_front_page() && !is_page_template('template-animated.php')) {
        wp_dequeue_script('gsap');
        wp_dequeue_script('gsap-scrolltrigger');
        wp_dequeue_script('[THEME_NAME]-animations');
    }
}
// Uncomment to enable conditional loading:
// add_action('wp_enqueue_scripts', '[THEME_NAME]_conditional_gsap', 20);

/**
 * Add async/defer attributes to scripts
 */
function [THEME_NAME]_add_async_defer($tag, $handle) {
    
    // Scripts to defer
    $defer_scripts = array(
        '[THEME_NAME]-main',
        '[THEME_NAME]-navigation',
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
add_filter('script_loader_tag', '[THEME_NAME]_add_async_defer', 10, 2);

/**
 * Preload critical assets
 */
function [THEME_NAME]_preload_assets() {
    // Preload main CSS
    echo '<link rel="preload" href="' . esc_url([THEME_NAME]_URI . '/assets/css/main.css') . '" as="style">';
    
    // Preload fonts
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action('wp_head', '[THEME_NAME]_preload_assets', 1);
```

---

## Phase 4: GSAP Integration & Animation System

### 4.1 assets/js/animations.js (Complete Animation System)

```javascript
/**
 * GSAP Animation System for [THEME_NAME]
 * 
 * Features:
 * - Page load animations
 * - Scroll-triggered animations
 * - Hover effects
 * - Parallax scrolling
 * - Stagger animations
 * 
 * @package [THEME_NAME]
 */

(function() {
    'use strict';
    
    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        
        // Register GSAP plugins
        gsap.registerPlugin(ScrollTrigger);
        
        // ===========================
        // 1. PAGE LOAD ANIMATIONS
        // ===========================
        
        /**
         * Hero Section Animation
         */
        function initHeroAnimation() {
            const heroTimeline = gsap.timeline({
                defaults: { ease: 'power3.out' }
            });
            
            heroTimeline
                .from('.hero-title', {
                    y: 100,
                    opacity: 0,
                    duration: 1,
                })
                .from('.hero-subtitle', {
                    y: 50,
                    opacity: 0,
                    duration: 0.8,
                }, '-=0.5')
                .from('.hero-cta', {
                    y: 30,
                    opacity: 0,
                    duration: 0.6,
                    stagger: 0.2,
                }, '-=0.4')
                .from('.hero-image', {
                    scale: 0.9,
                    opacity: 0,
                    duration: 1,
                }, '-=0.8');
        }
        
        /**
         * Header/Navigation Animation
         */
        function initHeaderAnimation() {
            gsap.from('.site-header', {
                y: -100,
                opacity: 0,
                duration: 0.8,
                ease: 'power2.out',
            });
        }
        
        // ===========================
        // 2. SCROLL ANIMATIONS
        // ===========================
        
        /**
         * Fade In on Scroll
         * Usage: Add class "animate-fade-in" to any element
         */
        function initFadeInAnimations() {
            const fadeElements = gsap.utils.toArray('.animate-fade-in');
            
            fadeElements.forEach(element => {
                gsap.from(element, {
                    opacity: 0,
                    y: 50,
                    duration: 1,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: element,
                        start: 'top 85%',
                        end: 'top 60%',
                        toggleActions: 'play none none none',
                        // markers: true, // Uncomment for debugging
                    }
                });
            });
        }
        
        /**
         * Slide In from Left
         * Usage: Add class "animate-slide-left" to any element
         */
        function initSlideLeftAnimations() {
            const slideElements = gsap.utils.toArray('.animate-slide-left');
            
            slideElements.forEach(element => {
                gsap.from(element, {
                    x: -100,
                    opacity: 0,
                    duration: 1,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: element,
                        start: 'top 85%',
                        toggleActions: 'play none none none',
                    }
                });
            });
        }
        
        /**
         * Slide In from Right
         * Usage: Add class "animate-slide-right" to any element
         */
        function initSlideRightAnimations() {
            const slideElements = gsap.utils.toArray('.animate-slide-right');
            
            slideElements.forEach(element => {
                gsap.from(element, {
                    x: 100,
                    opacity: 0,
                    duration: 1,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: element,
                        start: 'top 85%',
                        toggleActions: 'play none none none',
                    }
                });
            });
        }
        
        /**
         * Scale Up on Scroll
         * Usage: Add class "animate-scale" to any element
         */
        function initScaleAnimations() {
            const scaleElements = gsap.utils.toArray('.animate-scale');
            
            scaleElements.forEach(element => {
                gsap.from(element, {
                    scale: 0.8,
                    opacity: 0,
                    duration: 0.8,
                    ease: 'back.out(1.4)',
                    scrollTrigger: {
                        trigger: element,
                        start: 'top 85%',
                        toggleActions: 'play none none none',
                    }
                });
            });
        }
        
        /**
         * Stagger Animation for Lists/Grids
         * Usage: Add class "animate-stagger" to parent container
         */
        function initStaggerAnimations() {
            const staggerContainers = gsap.utils.toArray('.animate-stagger');
            
            staggerContainers.forEach(container => {
                const children = container.children;
                
                gsap.from(children, {
                    y: 50,
                    opacity: 0,
                    duration: 0.8,
                    stagger: 0.1,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: container,
                        start: 'top 85%',
                        toggleActions: 'play none none none',
                    }
                });
            });
        }
        
        // ===========================
        // 3. PARALLAX EFFECTS
        // ===========================
        
        /**
         * Parallax Scrolling
         * Usage: Add class "parallax" and data-speed attribute
         * Example: <div class="parallax" data-speed="0.5"></div>
         */
        function initParallaxEffect() {
            const parallaxElements = gsap.utils.toArray('.parallax');
            
            parallaxElements.forEach(element => {
                const speed = element.dataset.speed || 0.5;
                
                gsap.to(element, {
                    y: () => (1 - speed) * ScrollTrigger.maxScroll(window),
                    ease: 'none',
                    scrollTrigger: {
                        start: 0,
                        end: 'max',
                        invalidateOnRefresh: true,
                        scrub: 0.5,
                    }
                });
            });
        }
        
        // ===========================
        // 4. HOVER ANIMATIONS
        // ===========================
        
        /**
         * Card Hover Effects
         * Usage: Add class "card-hover" to any element
         */
        function initCardHoverEffects() {
            const cards = document.querySelectorAll('.card-hover');
            
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    gsap.to(card, {
                        y: -10,
                        boxShadow: '0 20px 40px rgba(0,0,0,0.15)',
                        duration: 0.3,
                        ease: 'power2.out',
                    });
                });
                
                card.addEventListener('mouseleave', () => {
                    gsap.to(card, {
                        y: 0,
                        boxShadow: '0 4px 6px rgba(0,0,0,0.1)',
                        duration: 0.3,
                        ease: 'power2.out',
                    });
                });
            });
        }
        
        /**
         * Button Hover Effects
         * Usage: Add class "btn-hover-effect" to buttons
         */
        function initButtonHoverEffects() {
            const buttons = document.querySelectorAll('.btn-hover-effect');
            
            buttons.forEach(button => {
                button.addEventListener('mouseenter', () => {
                    gsap.to(button, {
                        scale: 1.05,
                        duration: 0.3,
                        ease: 'power2.out',
                    });
                });
                
                button.addEventListener('mouseleave', () => {
                    gsap.to(button, {
                        scale: 1,
                        duration: 0.3,
                        ease: 'power2.out',
                    });
                });
            });
        }
        
        // ===========================
        // 5. ADVANCED EFFECTS
        // ===========================
        
        /**
         * Counter Animation
         * Usage: Add class "counter" and data-target attribute
         * Example: <span class="counter" data-target="1000">0</span>
         */
        function initCounterAnimations() {
            const counters = document.querySelectorAll('.counter');
            
            counters.forEach(counter => {
                const target = parseInt(counter.dataset.target);
                
                ScrollTrigger.create({
                    trigger: counter,
                    start: 'top 80%',
                    once: true,
                    onEnter: () => {
                        gsap.to(counter, {
                            innerText: target,
                            duration: 2,
                            ease: 'power1.out',
                            snap: { innerText: 1 },
                            onUpdate: function() {
                                counter.innerText = Math.ceil(counter.innerText);
                            }
                        });
                    }
                });
            });
        }
        
        /**
         * Progress Bar Animation
         * Usage: Add class "progress-bar" and data-width attribute
         * Example: <div class="progress-bar" data-width="75"></div>
         */
        function initProgressBarAnimations() {
            const progressBars = document.querySelectorAll('.progress-bar');
            
            progressBars.forEach(bar => {
                const width = bar.dataset.width || 100;
                
                gsap.from(bar, {
                    width: 0,
                    duration: 1.5,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: bar,
                        start: 'top 85%',
                        toggleActions: 'play none none none',
                    }
                });
            });
        }
        
        /**
         * Text Reveal Animation
         * Usage: Add class "text-reveal" to any text element
         */
        function initTextRevealAnimations() {
            const textElements = gsap.utils.toArray('.text-reveal');
            
            textElements.forEach(element => {
                const text = element.textContent;
                element.innerHTML = text.split('').map(char => 
                    `<span style="display:inline-block;">${char === ' ' ? '&nbsp;' : char}</span>`
                ).join('');
                
                const chars = element.querySelectorAll('span');
                
                gsap.from(chars, {
                    y: 50,
                    opacity: 0,
                    duration: 0.05,
                    stagger: 0.02,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: element,
                        start: 'top 85%',
                        toggleActions: 'play none none none',
                    }
                });
            });
        }
        
        // ===========================
        // 6. SMOOTH SCROLLING
        // ===========================
        
        /**
         * Smooth Scroll to Anchor Links
         */
        function initSmoothScrolling() {
            const anchorLinks = document.querySelectorAll('a[href^="#"]');
            
            anchorLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const targetId = this.getAttribute('href');
                    
                    if (targetId === '#') return;
                    
                    const target = document.querySelector(targetId);
                    
                    if (target) {
                        e.preventDefault();
                        
                        gsap.to(window, {
                            duration: 1,
                            scrollTo: {
                                y: target,
                                offsetY: 80, // Header height offset
                            },
                            ease: 'power2.inOut',
                        });
                    }
                });
            });
        }
        
        // ===========================
        // 7. PERFORMANCE OPTIMIZATIONS
        // ===========================
        
        /**
         * Reduce motion for accessibility
         */
        function respectReducedMotion() {
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
            
            if (prefersReducedMotion.matches) {
                // Disable all animations
                gsap.globalTimeline.pause();
                ScrollTrigger.getAll().forEach(trigger => trigger.kill());
                console.log('Animations disabled due to user preference for reduced motion');
            }
        }
        
        /**
         * Lazy load animations for better performance
         */
        function initLazyAnimations() {
            // Only initialize animations when elements are near viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animation-ready');
                    }
                });
            }, {
                rootMargin: '100px'
            });
            
            const lazyElements = document.querySelectorAll('[data-lazy-animate]');
            lazyElements.forEach(el => observer.observe(el));
        }
        
        // ===========================
        // INITIALIZE ALL ANIMATIONS
        // ===========================
        
        function init() {
            // Check for reduced motion preference
            respectReducedMotion();
            
            // Page load animations
            if (document.querySelector('.hero-title')) {
                initHeroAnimation();
            }
            initHeaderAnimation();
            
            // Scroll animations
            initFadeInAnimations();
            initSlideLeftAnimations();
            initSlideRightAnimations();
            initScaleAnimations();
            initStaggerAnimations();
            
            // Parallax effects
            initParallaxEffect();
            
            // Hover effects
            initCardHoverEffects();
            initButtonHoverEffects();
            
            // Advanced effects
            initCounterAnimations();
            initProgressBarAnimations();
            initTextRevealAnimations();
            
            // Smooth scrolling
            initSmoothScrolling();
            
            // Performance optimizations
            initLazyAnimations();
            
            // Refresh ScrollTrigger after everything is loaded
            ScrollTrigger.refresh();
        }
        
        // Initialize animations
        init();
        
        // Refresh ScrollTrigger on window resize
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                ScrollTrigger.refresh();
            }, 250);
        });
        
    });
    
})();
```

### 4.2 GSAP Animation Classes Reference

Add these classes to your HTML elements to trigger animations:

```html
<!-- Fade In Animations -->
<div class="animate-fade-in">Content fades in</div>

<!-- Slide Animations -->
<div class="animate-slide-left">Slides from left</div>
<div class="animate-slide-right">Slides from right</div>

<!-- Scale Animation -->
<div class="animate-scale">Scales up</div>

<!-- Stagger Animation (for lists/grids) -->
<div class="animate-stagger">
    <div>Item 1</div>
    <div>Item 2</div>
    <div>Item 3</div>
</div>

<!-- Parallax Effect -->
<div class="parallax" data-speed="0.5">Parallax element</div>

<!-- Card Hover Effect -->
<div class="card-hover">Lifts on hover</div>

<!-- Button Hover Effect -->
<button class="btn-hover-effect">Scales on hover</button>

<!-- Counter Animation -->
<span class="counter" data-target="1000">0</span>

<!-- Progress Bar -->
<div class="progress-bar" data-width="75"></div>

<!-- Text Reveal -->
<h2 class="text-reveal">Text reveals character by character</h2>
```

---

## Phase 5: Security Best Practices

### 5.1 inc/security.php

```php
<?php
/**
 * Security Functions
 *
 * @package [THEME_NAME]
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Remove version from scripts and styles
 */
function [THEME_NAME]_remove_version_strings($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', '[THEME_NAME]_remove_version_strings', 9999);
add_filter('script_loader_src', '[THEME_NAME]_remove_version_strings', 9999);

/**
 * Disable XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Remove RSD link from head
 */
remove_action('wp_head', 'rsd_link');

/**
 * Remove Windows Live Writer manifest link
 */
remove_action('wp_head', 'wlwmanifest_link');

/**
 * Disable user enumeration
 */
function [THEME_NAME]_disable_user_enumeration() {
    if (is_admin()) {
        return;
    }
    
    if (isset($_REQUEST['author']) && !empty($_REQUEST['author'])) {
        wp_die('Author archives are disabled.');
    }
}
add_action('init', '[THEME_NAME]_disable_user_enumeration');

/**
 * Add security headers
 */
function [THEME_NAME]_add_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
}
add_action('send_headers', '[THEME_NAME]_add_security_headers');

/**
 * Sanitize file uploads
 */
function [THEME_NAME]_sanitize_file_uploads($file) {
    $filetype = wp_check_filetype($file['name']);
    
    if (!$filetype['ext']) {
        $file['error'] = 'Invalid file type.';
    }
    
    return $file;
}
add_filter('wp_handle_upload_prefilter', '[THEME_NAME]_sanitize_file_uploads');

/**
 * Escape output functions
 */
function [THEME_NAME]_esc_html($text) {
    return esc_html($text);
}

function [THEME_NAME]_esc_attr($text) {
    return esc_attr($text);
}

function [THEME_NAME]_esc_url($url) {
    return esc_url($url);
}

/**
 * Validate and sanitize input
 */
function [THEME_NAME]_sanitize_text($input) {
    return sanitize_text_field($input);
}

function [THEME_NAME]_sanitize_email($email) {
    return sanitize_email($email);
}

/**
 * CSRF Protection for forms
 */
function [THEME_NAME]_verify_nonce($nonce, $action) {
    if (!wp_verify_nonce($nonce, $action)) {
        wp_die('Security check failed');
    }
}

/**
 * Limit login attempts (basic implementation)
 * For production, use a dedicated plugin like Wordfence
 */
function [THEME_NAME]_check_attempted_login($user, $username, $password) {
    if (get_transient('attempted_login_' . $username)) {
        $datas = get_transient('attempted_login_' . $username);
        
        if ($datas['tried'] >= 3) {
            $until = get_option('_transient_timeout_' . 'attempted_login_' . $username);
            $time = [THEME_NAME]_time_to_go($until);
            
            return new WP_Error('too_many_tries', sprintf(
                __('Too many login attempts. Please try again in %s.', '[THEME_NAME]'),
                $time
            ));
        }
    }
    
    return $user;
}
add_filter('authenticate', '[THEME_NAME]_check_attempted_login', 30, 3);

function [THEME_NAME]_login_failed($username) {
    if (get_transient('attempted_login_' . $username)) {
        $datas = get_transient('attempted_login_' . $username);
        $datas['tried']++;
        
        if ($datas['tried'] <= 3) {
            set_transient('attempted_login_' . $username, $datas, 300);
        }
    } else {
        $datas = array(
            'tried' => 1
        );
        set_transient('attempted_login_' . $username, $datas, 300);
    }
}
add_action('wp_login_failed', '[THEME_NAME]_login_failed', 10, 1);

function [THEME_NAME]_time_to_go($timestamp) {
    $periods = array("second", "minute", "hour", "day", "week", "month", "year");
    $lengths = array(60, 60, 24, 7, 4.35, 12);
    $current_timestamp = time();
    $difference = abs($current_timestamp - $timestamp);
    
    for ($i = 0; $difference >= $lengths[$i] && $i < count($lengths) - 1; $i++) {
        $difference /= $lengths[$i];
    }
    
    $difference = round($difference);
    
    if ($difference != 1) {
        $periods[$i] .= "s";
    }
    
    return "$difference $periods[$i]";
}

/**
 * Content Security Policy (CSP)
 * Customize based on your needs
 */
function [THEME_NAME]_add_csp_header() {
    $csp = "default-src 'self'; ";
    $csp .= "script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.googleapis.com; ";
    $csp .= "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; ";
    $csp .= "font-src 'self' https://fonts.gstatic.com; ";
    $csp .= "img-src 'self' data: https:; ";
    $csp .= "connect-src 'self';";
    
    // Uncomment to enable:
    // header("Content-Security-Policy: " . $csp);
}
add_action('send_headers', '[THEME_NAME]_add_csp_header');
```

---

## Phase 6: Responsive Design Guidelines

### 6.1 Responsive Breakpoints

**Tailwind CSS Breakpoints:**
```css
/* Default Tailwind breakpoints */
sm: 640px   /* Small devices (tablets) */
md: 768px   /* Medium devices (laptops) */
lg: 1024px  /* Large devices (desktops) */
xl: 1280px  /* Extra large devices */
2xl: 1536px /* 2X Extra large devices */
```

**Bootstrap Breakpoints:**
```css
/* Default Bootstrap breakpoints */
xs: <576px   /* Extra small devices (phones) */
sm: ≥576px   /* Small devices (tablets) */
md: ≥768px   /* Medium devices (laptops) */
lg: ≥992px   /* Large devices (desktops) */
xl: ≥1200px  /* Extra large devices */
xxl: ≥1400px /* 2X Extra large devices */
```

### 6.2 Mobile-First Approach

```html
<!-- Tailwind Example: Mobile-first responsive design -->
<div class="
    w-full             /* Full width on mobile */
    px-4               /* Padding on mobile */
    md:w-1/2           /* Half width on tablets */
    md:px-6            /* More padding on tablets */
    lg:w-1/3           /* One-third width on desktop */
    lg:px-8            /* Even more padding on desktop */
">
    Content
</div>

<!-- Bootstrap Example: Mobile-first responsive design -->
<div class="
    col-12             /* Full width on mobile */
    col-md-6           /* Half width on tablets */
    col-lg-4           /* One-third width on desktop */
    px-3 px-md-4       /* Responsive padding */
">
    Content
</div>
```

### 6.3 Responsive Typography

**Tailwind:**
```html
<h1 class="text-2xl md:text-4xl lg:text-5xl font-bold">
    Responsive Heading
</h1>

<p class="text-sm md:text-base lg:text-lg">
    Responsive paragraph text
</p>
```

**Bootstrap:**
```html
<h1 class="display-6 display-md-4 display-lg-3">
    Responsive Heading
</h1>

<p class="fs-6 fs-md-5 fs-lg-4">
    Responsive paragraph text
</p>
```

### 6.4 Responsive Images

```php
<!-- WordPress responsive images -->
<?php 
if (has_post_thumbnail()) {
    the_post_thumbnail('full', array(
        'class' => 'w-full h-auto object-cover',
        'loading' => 'lazy',
    ));
}
?>

<!-- Tailwind responsive images -->
<img 
    src="image.jpg" 
    alt="Description"
    class="w-full h-auto object-cover rounded-lg"
    loading="lazy"
>

<!-- Bootstrap responsive images -->
<img 
    src="image.jpg" 
    alt="Description"
    class="img-fluid rounded"
    loading="lazy"
>
```

### 6.5 Responsive Navigation

```html
<!-- Mobile Menu Toggle Button -->
<button 
    id="mobile-menu-toggle"
    class="block md:hidden"
    aria-label="Toggle mobile menu"
    aria-expanded="false"
>
    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
    </svg>
</button>

<!-- Mobile Menu (hidden by default, shown on mobile) -->
<nav id="mobile-menu" class="hidden md:block">
    <!-- Menu items -->
</nav>
```

### 6.6 Testing Checklist

```markdown
## Responsive Testing Checklist

### Device Testing
- [ ] iPhone SE (375px)
- [ ] iPhone 12/13 Pro (390px)
- [ ] iPhone 14 Pro Max (430px)
- [ ] iPad Mini (768px)
- [ ] iPad Pro (1024px)
- [ ] Desktop (1280px+)
- [ ] Large Desktop (1920px+)

### Browser Testing
- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)
- [ ] Mobile Safari (iOS)
- [ ] Chrome Mobile (Android)

### Functionality Testing
- [ ] Navigation works on all devices
- [ ] Forms are usable on mobile
- [ ] Images scale correctly
- [ ] Text is readable without zooming
- [ ] Touch targets are at least 44x44px
- [ ] Horizontal scrolling is eliminated
- [ ] All interactive elements work on touch
- [ ] GSAP animations perform well on mobile
```

---

## Phase 7: Performance Optimization

### 7.1 Image Optimization

```php
/**
 * Add to inc/custom-functions.php
 */

/**
 * Enable WebP support
 */
function [THEME_NAME]_enable_webp_upload($mimes) {
    $mimes['webp'] = 'image/webp';
    return $mimes;
}
add_filter('upload_mimes', '[THEME_NAME]_enable_webp_upload');

/**
 * Add lazy loading to images
 */
function [THEME_NAME]_add_lazy_loading($content) {
    if (is_admin() || is_feed()) {
        return $content;
    }
    
    $content = preg_replace(
        '/<img(.*?)>/i',
        '<img$1 loading="lazy">',
        $content
    );
    
    return $content;
}
add_filter('the_content', '[THEME_NAME]_add_lazy_loading');

/**
 * Disable unnecessary image sizes
 */
function [THEME_NAME]_remove_default_image_sizes($sizes) {
    unset($sizes['thumbnail']);
    unset($sizes['medium_large']);
    return $sizes;
}
add_filter('intermediate_image_sizes_advanced', '[THEME_NAME]_remove_default_image_sizes');
```

### 7.2 Asset Optimization

```php
/**
 * Defer CSS loading (Critical CSS inline)
 */
function [THEME_NAME]_defer_css($html, $handle) {
    if ('critical-css' === $handle) {
        return $html;
    }
    
    return str_replace("rel='stylesheet'", "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\"", $html);
}
// add_filter('style_loader_tag', '[THEME_NAME]_defer_css', 10, 2);

/**
 * Remove jQuery migrate
 */
function [THEME_NAME]_remove_jquery_migrate($scripts) {
    if (!is_admin() && isset($scripts->registered['jquery'])) {
        $script = $scripts->registered['jquery'];
        
        if ($script->deps) {
            $script->deps = array_diff($script->deps, array('jquery-migrate'));
        }
    }
}
add_action('wp_default_scripts', '[THEME_NAME]_remove_jquery_migrate');

/**
 * Disable emojis
 */
function [THEME_NAME]_disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}
add_action('init', '[THEME_NAME]_disable_emojis');

/**
 * Remove query strings from static resources
 */
function [THEME_NAME]_remove_query_strings($src) {
    if (strpos($src, '?ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', '[THEME_NAME]_remove_query_strings', 15, 1);
add_filter('style_loader_src', '[THEME_NAME]_remove_query_strings', 15, 1);
```

### 7.3 Database Optimization

```php
/**
 * Limit post revisions
 */
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 3);
}

/**
 * Set autosave interval (in seconds)
 */
if (!defined('AUTOSAVE_INTERVAL')) {
    define('AUTOSAVE_INTERVAL', 300);
}

/**
 * Optimize database queries
 */
function [THEME_NAME]_optimize_queries() {
    global $wpdb;
    
    // Only run on admin
    if (!is_admin()) {
        return;
    }
    
    // Clean expired transients
    $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_%' AND option_value < UNIX_TIMESTAMP()");
    $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_%' AND option_name NOT LIKE '_transient_timeout_%' AND option_name NOT IN (SELECT REPLACE(option_name, '_transient_timeout_', '_transient_') FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_%')");
}
// Run weekly
if (!wp_next_scheduled('[THEME_NAME]_optimize_queries')) {
    wp_schedule_event(time(), 'weekly', '[THEME_NAME]_optimize_queries');
}
add_action('[THEME_NAME]_optimize_queries', '[THEME_NAME]_optimize_queries');
```

### 7.4 Caching Strategies

```php
/**
 * Browser caching via .htaccess (add to root)
 */
/*
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType application/pdf "access plus 1 month"
    ExpiresByType text/html "access plus 1 day"
</IfModule>
*/

/**
 * Fragment caching for expensive queries
 */
function [THEME_NAME]_get_cached_posts($args, $cache_key) {
    $cached = get_transient($cache_key);
    
    if (false === $cached) {
        $query = new WP_Query($args);
        set_transient($cache_key, $query, HOUR_IN_SECONDS);
        return $query;
    }
    
    return $cached;
}

/**
 * Clear cache on post update
 */
function [THEME_NAME]_clear_post_cache($post_id) {
    // Clear specific transients
    delete_transient('[THEME_NAME]_recent_posts');
    delete_transient('[THEME_NAME]_featured_posts');
}
add_action('save_post', '[THEME_NAME]_clear_post_cache');
```

### 7.5 Performance Monitoring

```php
/**
 * Add performance metrics (development only)
 */
function [THEME_NAME]_performance_metrics() {
    if (defined('WP_DEBUG') && WP_DEBUG) {
        $queries = get_num_queries();
        $memory = size_format(memory_get_peak_usage());
        $time = timer_stop(0, 3);
        
        echo "<!-- Performance: {$queries} queries, {$memory} memory, {$time}s generation time -->";
    }
}
add_action('wp_footer', '[THEME_NAME]_performance_metrics');
```

---

## Phase 8: Accessibility (A11y) Standards

### 8.1 Semantic HTML

```html
<!-- Use proper HTML5 semantic elements -->
<header>
    <nav aria-label="Primary navigation">
        <!-- Navigation content -->
    </nav>
</header>

<main id="main-content">
    <article>
        <header>
            <h1>Article Title</h1>
        </header>
        <section>
            <!-- Article content -->
        </section>
    </article>
</main>

<aside aria-label="Sidebar">
    <!-- Sidebar content -->
</aside>

<footer>
    <!-- Footer content -->
</footer>
```

### 8.2 ARIA Labels and Attributes

```php
/**
 * Add to navigation menu
 */
wp_nav_menu(array(
    'theme_location' => 'primary',
    'menu_class'     => 'menu',
    'container'      => 'nav',
    'container_aria_label' => 'Primary',
));
```

```html
<!-- Skip to main content link -->
<a href="#main-content" class="skip-link">
    Skip to main content
</a>

<!-- Proper button labels -->
<button 
    type="button"
    aria-label="Open mobile menu"
    aria-expanded="false"
    aria-controls="mobile-menu"
>
    <span aria-hidden="true">☰</span>
</button>

<!-- Form labels -->
<label for="email">
    Email Address
    <span class="required" aria-label="required">*</span>
</label>
<input 
    type="email" 
    id="email" 
    name="email"
    required
    aria-required="true"
    aria-describedby="email-error"
>
<span id="email-error" role="alert"></span>
```

### 8.3 Keyboard Navigation

```javascript
/**
 * Add to assets/js/navigation.js
 */

// Ensure all interactive elements are keyboard accessible
document.addEventListener('DOMContentLoaded', function() {
    
    // Trap focus in modal
    function trapFocus(element) {
        const focusableElements = element.querySelectorAll(
            'a[href], button, textarea, input, select, [tabindex]:not([tabindex="-1"])'
        );
        
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];
        
        element.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                if (e.shiftKey && document.activeElement === firstElement) {
                    e.preventDefault();
                    lastElement.focus();
                } else if (!e.shiftKey && document.activeElement === lastElement) {
                    e.preventDefault();
                    firstElement.focus();
                }
            }
            
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    }
    
    // Keyboard navigation for dropdown menus
    const menuItems = document.querySelectorAll('.menu-item-has-children > a');
    
    menuItems.forEach(item => {
        item.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });
});
```

### 8.4 Color Contrast

```css
/**
 * Ensure WCAG AA compliance (4.5:1 for normal text, 3:1 for large text)
 * Use tools like https://webaim.org/resources/contrastchecker/
 */

/* Good contrast examples */
.text-primary {
    color: #1F2937; /* Dark gray on white background */
}

.button-primary {
    background-color: [PRIMARY_COLOR];
    color: #FFFFFF; /* Ensure sufficient contrast */
}

/* Focus indicators */
*:focus {
    outline: 2px solid [PRIMARY_COLOR];
    outline-offset: 2px;
}

/* Never remove focus outline without replacement */
button:focus-visible {
    outline: 2px solid [PRIMARY_COLOR];
    outline-offset: 2px;
}
```

### 8.5 Accessibility Testing Checklist

```markdown
## Accessibility Testing Checklist

### Keyboard Navigation
- [ ] All interactive elements reachable by Tab
- [ ] Tab order is logical
- [ ] Focus indicators are visible
- [ ] Escape key closes modals
- [ ] Enter/Space activates buttons
- [ ] Arrow keys navigate menus

### Screen Reader Testing
- [ ] Test with NVDA (Windows)
- [ ] Test with JAWS (Windows)
- [ ] Test with VoiceOver (Mac/iOS)
- [ ] All images have alt text
- [ ] Form labels are associated
- [ ] Headings are hierarchical (h1, h2, h3)
- [ ] ARIA labels are meaningful

### Visual
- [ ] Color contrast meets WCAG AA (4.5:1)
- [ ] Text is resizable to 200%
- [ ] Content works without CSS
- [ ] No content conveyed by color alone

### Forms
- [ ] All fields have labels
- [ ] Required fields are marked
- [ ] Error messages are clear
- [ ] Success messages are announced

### Media
- [ ] Videos have captions
- [ ] Audio has transcripts
- [ ] Auto-playing media can be paused
```

---

## Phase 9: SEO Optimization

### 9.1 SEO Functions

```php
/**
 * Add to inc/custom-functions.php
 */

/**
 * Add Open Graph meta tags
 */
function [THEME_NAME]_add_og_tags() {
    if (is_singular()) {
        global $post;
        
        $og_title = get_the_title();
        $og_description = get_the_excerpt();
        $og_url = get_permalink();
        $og_image = get_the_post_thumbnail_url($post->ID, 'full');
        
        echo '<meta property="og:title" content="' . esc_attr($og_title) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($og_description) . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url($og_url) . '">' . "\n";
        echo '<meta property="og:type" content="article">' . "\n";
        
        if ($og_image) {
            echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";
        }
    }
}
add_action('wp_head', '[THEME_NAME]_add_og_tags');

/**
 * Add Twitter Card meta tags
 */
function [THEME_NAME]_add_twitter_cards() {
    if (is_singular()) {
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr(get_the_title()) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr(get_the_excerpt()) . '">' . "\n";
        
        $twitter_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if ($twitter_image) {
            echo '<meta name="twitter:image" content="' . esc_url($twitter_image) . '">' . "\n";
        }
    }
}
add_action('wp_head', '[THEME_NAME]_add_twitter_cards');

/**
 * Add schema.org structured data
 */
function [THEME_NAME]_add_schema_markup() {
    if (is_singular('post')) {
        global $post;
        
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => get_the_title(),
            'description' => get_the_excerpt(),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'author' => array(
                '@type' => 'Person',
                'name' => get_the_author(),
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => get_bloginfo('name'),
                'logo' => array(
                    '@type' => 'ImageObject',
                    'url' => get_site_icon_url(),
                ),
            ),
        );
        
        $thumbnail = get_the_post_thumbnail_url($post->ID, 'full');
        if ($thumbnail) {
            $schema['image'] = $thumbnail;
        }
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
    }
}
add_action('wp_head', '[THEME_NAME]_add_schema_markup');

/**
 * Generate XML sitemap (basic)
 * For production, use Yoast SEO or Rank Math
 */
function [THEME_NAME]_generate_sitemap() {
    // This is a simplified example
    // Use a proper SEO plugin for production
}

/**
 * Add breadcrumbs
 */
function [THEME_NAME]_breadcrumbs() {
    if (is_front_page()) {
        return;
    }
    
    echo '<nav aria-label="Breadcrumb" class="breadcrumbs">';
    echo '<ol>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    
    if (is_category() || is_single()) {
        echo '<li>';
        the_category(' </li><li> ');
        echo '</li>';
        
        if (is_single()) {
            echo '<li>' . get_the_title() . '</li>';
        }
    } elseif (is_page()) {
        echo '<li>' . get_the_title() . '</li>';
    }
    
    echo '</ol>';
    echo '</nav>';
}
```

### 9.2 SEO Best Practices

```markdown
## SEO Checklist

### On-Page SEO
- [ ] Unique page titles (50-60 characters)
- [ ] Meta descriptions (150-160 characters)
- [ ] H1 tag on every page (only one)
- [ ] Hierarchical heading structure (H1-H6)
- [ ] Alt text for all images
- [ ] Descriptive URLs (short, keyword-rich)
- [ ] Internal linking structure
- [ ] External links open in new tab (where appropriate)

### Technical SEO
- [ ] XML sitemap generated
- [ ] Robots.txt configured
- [ ] 301 redirects for moved content
- [ ] Canonical URLs set
- [ ] Schema markup implemented
- [ ] Open Graph tags
- [ ] Twitter Cards
- [ ] Page speed optimized
- [ ] Mobile-friendly
- [ ] HTTPS enabled
- [ ] No broken links

### Content SEO
- [ ] Original, quality content
- [ ] Keyword research completed
- [ ] Readability optimized
- [ ] Regular content updates
- [ ] Multimedia content (images, videos)
- [ ] Social sharing enabled
```

---

## Phase 10: Testing & Deployment

### 10.1 Pre-Launch Testing

```markdown
## Testing Checklist

### Functionality Testing
- [ ] All pages load correctly
- [ ] Navigation works on all devices
- [ ] Forms submit successfully
- [ ] Search functionality works
- [ ] Contact forms deliver emails
- [ ] All links work (internal and external)
- [ ] 404 page displays correctly
- [ ] Comments work (if enabled)

### Cross-Browser Testing
- [ ] Chrome (latest)
- [ ] Firefox (latest)
- [ ] Safari (latest)
- [ ] Edge (latest)
- [ ] Mobile Safari
- [ ] Chrome Mobile

### Performance Testing
- [ ] Google PageSpeed Insights (90+ score)
- [ ] GTmetrix analysis
- [ ] WebPageTest results
- [ ] Mobile performance check
- [ ] Image optimization verified
- [ ] GSAP animations perform smoothly
- [ ] No console errors

### Security Testing
- [ ] SSL certificate installed
- [ ] Security headers configured
- [ ] File permissions correct (644 for files, 755 for folders)
- [ ] Admin username not "admin"
- [ ] Strong passwords enforced
- [ ] Login attempts limited
- [ ] Database prefix changed
- [ ] wp-config.php secured

### SEO Testing
- [ ] Google Search Console verified
- [ ] XML sitemap submitted
- [ ] Robots.txt configured
- [ ] Meta tags on all pages
- [ ] Schema markup validated
- [ ] Open Graph tags working
- [ ] Mobile-friendly test passed

### Accessibility Testing
- [ ] WAVE accessibility test passed
- [ ] Screen reader testing completed
- [ ] Keyboard navigation works
- [ ] Color contrast verified
- [ ] All images have alt text
- [ ] Forms are accessible
```

### 10.2 Deployment Process

```bash
# 1. Build production assets
npm run build

# 2. Remove development files
rm -rf node_modules
rm package-lock.json
rm .git (if present)

# 3. Create theme zip
cd wp-content/themes
zip -r [THEME_NAME].zip [THEME_NAME]/ -x "*.git*" "node_modules/*" "*.md"

# 4. Upload to production
# Via FTP, cPanel, or WordPress admin

# 5. Activate theme in WordPress admin
# Appearance > Themes > Activate

# 6. Clear all caches
# - WordPress cache
# - CDN cache (if applicable)
# - Browser cache
```

### 10.3 Post-Launch Checklist

```markdown
## Post-Launch Checklist

### Immediate Tasks
- [ ] Test all critical functionality again
- [ ] Monitor error logs for 24 hours
- [ ] Check analytics tracking
- [ ] Submit sitemap to Google
- [ ] Check mobile responsiveness
- [ ] Test checkout process (if e-commerce)
- [ ] Verify email notifications work

### Within First Week
- [ ] Monitor site speed daily
- [ ] Check for broken links
- [ ] Review search console for errors
- [ ] Gather initial user feedback
- [ ] Fix any reported bugs
- [ ] Monitor GSAP animation performance

### Ongoing Maintenance
- [ ] Weekly security scans
- [ ] Monthly performance audits
- [ ] Regular WordPress updates
- [ ] Plugin updates (if any)
- [ ] Content updates
- [ ] Backup verification
```

---

## Best Practices Summary

### Development Best Practices

1. **Version Control**
   - Use Git from day one
   - Commit frequently with clear messages
   - Use branches for features

2. **Code Organization**
   - Keep functions.php clean (use inc/ folder)
   - Comment your code
   - Follow WordPress Coding Standards
   - Use meaningful variable/function names

3. **Performance**
   - Minimize HTTP requests
   - Optimize images before upload
   - Use lazy loading
   - Implement caching strategies
   - Conditionally load scripts
   - Monitor database queries

4. **Security**
   - Always escape output
   - Sanitize user input
   - Use nonces for forms
   - Validate data server-side
   - Keep WordPress/plugins updated
   - Use strong passwords

5. **Accessibility**
   - Use semantic HTML
   - Provide keyboard navigation
   - Include ARIA labels
   - Ensure color contrast
   - Test with screen readers

6. **SEO**
   - Use proper heading hierarchy
   - Add meta tags
   - Implement schema markup
   - Create XML sitemap
   - Optimize page speed
   - Make it mobile-friendly

7. **GSAP Animations**
   - Keep animations subtle and purposeful
   - Respect prefers-reduced-motion
   - Test performance on mobile
   - Don't animate too many elements at once
   - Use will-change CSS property sparingly
   - Load GSAP conditionally when possible

8. **Responsive Design**
   - Mobile-first approach
   - Test on real devices
   - Use relative units (rem, em, %)
   - Optimize touch targets (44x44px minimum)
   - Consider slow connections

---

## Resources & Documentation

### Official Documentation
- WordPress Codex: https://codex.wordpress.org/
- WordPress Developer Reference: https://developer.wordpress.org/
- Tailwind CSS Docs: https://tailwindcss.com/docs
- Bootstrap Docs: https://getbootstrap.com/docs/
- GSAP Documentation: https://greensock.com/docs/
- GSAP ScrollTrigger: https://greensock.com/docs/v3/Plugins/ScrollTrigger

### Tools & Validators
- HTML Validator: https://validator.w3.org/
- CSS Validator: https://jigsaw.w3.org/css-validator/
- Accessibility Checker: https://wave.webaim.org/
- PageSpeed Insights: https://pagespeed.web.dev/
- Schema Validator: https://validator.schema.org/
- Color Contrast Checker: https://webaim.org/resources/contrastchecker/

### WordPress Coding Standards
- PHP: https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/
- HTML: https://developer.wordpress.org/coding-standards/wordpress-coding-standards/html/
- CSS: https://developer.wordpress.org/coding-standards/wordpress-coding-standards/css/
- JavaScript: https://developer.wordpress.org/coding-standards/wordpress-coding-standards/javascript/

---

## Customization Notes

**Remember to replace throughout this template:**
- `[THEME_NAME]` → Your actual theme name (e.g., "agency-pro")
- `[CSS_FRAMEWORK]` → "Tailwind" or "Bootstrap"
- `[INDUSTRY]` → Your target industry
- `[PRIMARY_COLOR]` → Your main brand color hex code
- `[SECONDARY_COLOR]` → Your secondary color hex code
- `[ACCENT_COLOR]` → Your accent color hex code
- `[TEXT_COLOR]` → Your main text color hex code
- `[BACKGROUND_COLOR]` → Your background color hex code

**File naming convention:**
- Use lowercase
- Use hyphens for spaces
- Be descriptive but concise
- Example: `template-full-width.php`, `page-about-us.php`

---

## Support & Maintenance

### Regular Maintenance Tasks

**Daily:**
- Monitor error logs
- Check uptime

**Weekly:**
- Review performance metrics
- Check for broken links
- Scan for security issues

**Monthly:**
- Update WordPress core
- Update plugins (if any)
- Review analytics
- Backup database and files
- Test all forms and functionality

**Quarterly:**
- Performance audit
- Accessibility review
- SEO audit
- Content review
- Security audit

---

## Final Notes

This template provides a comprehensive foundation for building professional Classic WordPress themes with modern technologies. Remember:

1. **Start simple** - Build core functionality first, then enhance
2. **Test frequently** - Don't wait until the end to test
3. **Document as you go** - Comment your code and keep notes
4. **Optimize progressively** - Don't premature optimize
5. **Follow standards** - Stick to WordPress and industry best practices
6. **Think about users** - Accessibility and usability first
7. **Performance matters** - Fast sites rank better and convert more
8. **Security is critical** - Never compromise on security practices

Good luck with your WordPress theme development!

---

**Version**: 1.0.0  
**Last Updated**: 2024  
**License**: GNU General Public License v2 or later