<?php
/**
 * Cpfauto functions and definitions
 *
 * @package Cpfauto
 * @since 1.0.0
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('CPFAUTO_VERSION', '1.0.0');
define('CPFAUTO_DIR', get_template_directory());
define('CPFAUTO_URI', get_template_directory_uri());

// Include theme setup
require_once CPFAUTO_DIR . '/inc/theme-setup.php';

// Include enqueue scripts
require_once CPFAUTO_DIR . '/inc/enqueue.php';

// Include custom functions
require_once CPFAUTO_DIR . '/inc/custom-functions.php';

// Include theme customizer
require_once CPFAUTO_DIR . '/inc/customizer.php';

// Include security functions
require_once CPFAUTO_DIR . '/inc/security.php';

// Include newsletter handler
require_once CPFAUTO_DIR . '/inc/newsletter-handler.php';

// Include custom post types
require_once CPFAUTO_DIR . '/inc/post-types.php';

// Include vehicle meta boxes
require_once CPFAUTO_DIR . '/inc/vehicle-meta-boxes.php';

// Include vehicle helper functions
require_once CPFAUTO_DIR . '/inc/vehicle-helpers.php';

// Include admin notices (only in admin)
if (is_admin()) {
    require_once CPFAUTO_DIR . '/inc/admin-notices.php';
}
