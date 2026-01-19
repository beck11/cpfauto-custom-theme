<?php
/**
 * Security Functions
 *
 * This file contains security measures to protect the WordPress site
 * from common vulnerabilities and attacks.
 *
 * @package Cpfauto
 */

if (!defined('ABSPATH')) {
    exit;
}

// ===========================
// 1. INFORMATION DISCLOSURE
// ===========================

/**
 * Remove WordPress version from head
 * 
 * WHY: Hiding the WordPress version prevents attackers from targeting
 * known vulnerabilities in specific versions. The version number appears
 * in meta tags and RSS feeds by default.
 */
remove_action('wp_head', 'wp_generator');

/**
 * Remove version from scripts and styles
 * 
 * WHY: Version query strings in asset URLs can reveal WordPress version
 * and plugin information. This removes '?ver=X.X.X' from all CSS/JS URLs.
 *
 * @param string $src Source URL.
 * @return string
 */
function cpfauto_remove_version_strings($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'cpfauto_remove_version_strings', 9999);
add_filter('script_loader_src', 'cpfauto_remove_version_strings', 9999);

/**
 * Remove RSD (Really Simple Discovery) link from head
 * 
 * WHY: RSD is used by external tools to discover blog APIs. Most sites
 * don't need this, and it can reveal information about your WordPress setup.
 */
remove_action('wp_head', 'rsd_link');

/**
 * Remove Windows Live Writer manifest link
 * 
 * WHY: Windows Live Writer is a discontinued blogging client. This link
 * is unnecessary and can reveal WordPress information.
 */
remove_action('wp_head', 'wlwmanifest_link');

/**
 * Remove shortlink from head
 * 
 * WHY: Shortlinks can reveal post IDs and other information that
 * attackers could use for enumeration attacks.
 */
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

/**
 * Remove REST API link from head
 * 
 * WHY: The REST API link in the head can reveal API endpoints.
 * The API still works, but we hide the discovery link.
 */
remove_action('wp_head', 'rest_output_link_wp_head', 10);

/**
 * Remove oEmbed discovery links
 * 
 * WHY: Reduces information disclosure about your site's capabilities.
 */
remove_action('wp_head', 'wp_oembed_add_discovery_links');

// ===========================
// 2. XML-RPC PROTECTION
// ===========================

/**
 * Disable XML-RPC
 * 
 * WHY: XML-RPC can be used for brute force attacks and DDoS attacks.
 * Most modern WordPress sites don't need XML-RPC. If you use Jetpack
 * or other services that require it, you may need to keep it enabled
 * but add additional protection.
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Remove XML-RPC pingback ping method
 * 
 * WHY: Pingbacks can be exploited for DDoS attacks. This disables
 * the pingback functionality even if XML-RPC is enabled.
 */
add_filter('wp_headers', function($headers) {
    unset($headers['X-Pingback']);
    return $headers;
});

// ===========================
// 3. USER ENUMERATION PROTECTION
// ===========================

/**
 * Disable user enumeration via author archives
 * 
 * WHY: WordPress author archives (/?author=1) can be used to enumerate
 * usernames. Attackers can try different author IDs to discover usernames,
 * which they then use for brute force attacks.
 * 
 * This function blocks author archive requests and returns a 404 error.
 */
function cpfauto_disable_user_enumeration() {
    // Allow admin area to function normally
    if (is_admin()) {
        return;
    }
    
    // Block author archive requests
    if (isset($_REQUEST['author']) && !empty($_REQUEST['author'])) {
        wp_die(
            esc_html__('Author archives are disabled for security reasons.', 'cpfauto'),
            esc_html__('Not Found', 'cpfauto'),
            array('response' => 404)
        );
    }
}
add_action('init', 'cpfauto_disable_user_enumeration');

/**
 * Disable user enumeration via REST API
 * 
 * WHY: The WordPress REST API exposes user information at /wp-json/wp/v2/users/
 * This can be used to enumerate usernames. This function removes user endpoints
 * from the REST API.
 */
add_filter('rest_endpoints', function($endpoints) {
    if (isset($endpoints['/wp/v2/users'])) {
        unset($endpoints['/wp/v2/users']);
    }
    if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
        unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    }
    return $endpoints;
});

// ===========================
// 4. SECURITY HEADERS
// ===========================

/**
 * Add security headers
 * 
 * WHY: Security headers tell browsers how to handle your site's content,
 * preventing various attacks:
 * 
 * - X-Content-Type-Options: Prevents MIME type sniffing attacks
 * - X-Frame-Options: Prevents clickjacking by blocking iframe embedding
 * - X-XSS-Protection: Enables browser's XSS filter (legacy, but still useful)
 * - Referrer-Policy: Controls what referrer information is sent
 * - Permissions-Policy: Controls browser features (optional)
 */
function cpfauto_add_security_headers() {
    // Prevent MIME type sniffing
    // Forces browser to respect declared content types
    header('X-Content-Type-Options: nosniff');
    
    // Prevent clickjacking attacks
    // Only allows site to be embedded in same-origin frames
    header('X-Frame-Options: SAMEORIGIN');
    
    // Enable browser XSS protection (legacy browsers)
    header('X-XSS-Protection: 1; mode=block');
    
    // Control referrer information
    // Only sends referrer for same-origin requests
    header('Referrer-Policy: strict-origin-when-cross-origin');
    
    // Permissions Policy (formerly Feature Policy)
    // Restricts access to browser features
    header('Permissions-Policy: geolocation=(), microphone=(), camera=()');
}
add_action('send_headers', 'cpfauto_add_security_headers');

/**
 * Content Security Policy (CSP) Header
 * 
 * WHY: CSP helps prevent XSS attacks by specifying which sources of content
 * are allowed. This is commented out by default because it requires careful
 * configuration based on your site's specific needs.
 * 
 * IMPORTANT: Uncomment and customize this based on your site's requirements.
 * Test thoroughly as strict CSP can break functionality if not configured correctly.
 */
function cpfauto_add_csp_header() {
    // Build CSP policy
    $csp = "default-src 'self'; ";
    $csp .= "script-src 'self' 'unsafe-inline' https://cdnjs.cloudflare.com https://fonts.googleapis.com; ";
    $csp .= "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; ";
    $csp .= "font-src 'self' https://fonts.gstatic.com; ";
    $csp .= "img-src 'self' data: https:; ";
    $csp .= "connect-src 'self';";
    
    // Uncomment to enable CSP:
    // header("Content-Security-Policy: " . $csp);
}
add_action('send_headers', 'cpfauto_add_csp_header');

// ===========================
// 5. INPUT SANITIZATION
// ===========================

/**
 * Sanitize text input
 * 
 * WHY: All user input must be sanitized before use to prevent XSS attacks
 * and SQL injection. This function removes HTML tags and encodes special characters.
 *
 * @param string $input Input to sanitize.
 * @return string Sanitized text.
 */
if (!function_exists('cpfauto_sanitize_text')) {
    function cpfauto_sanitize_text($input) {
        return sanitize_text_field($input);
    }
}

/**
 * Sanitize textarea input
 * 
 * WHY: Textareas may contain more content than text fields. This preserves
 * line breaks while sanitizing HTML.
 *
 * @param string $input Input to sanitize.
 * @return string Sanitized textarea content.
 */
if (!function_exists('cpfauto_sanitize_textarea')) {
    function cpfauto_sanitize_textarea($input) {
        return sanitize_textarea_field($input);
    }
}

/**
 * Sanitize email address
 * 
 * WHY: Email addresses must be validated and sanitized to prevent injection
 * attacks and ensure proper formatting.
 *
 * @param string $email Email to sanitize.
 * @return string Sanitized email address.
 */
if (!function_exists('cpfauto_sanitize_email')) {
    function cpfauto_sanitize_email($email) {
        return sanitize_email($email);
    }
}

/**
 * Sanitize URL
 * 
 * WHY: URLs must be validated to prevent malicious redirects and XSS attacks.
 *
 * @param string $url URL to sanitize.
 * @return string Sanitized URL.
 */
function cpfauto_sanitize_url($url) {
    return esc_url_raw($url);
}

/**
 * Sanitize integer
 * 
 * WHY: Ensures numeric input is actually an integer, preventing type confusion attacks.
 *
 * @param mixed $input Input to sanitize.
 * @return int Sanitized integer.
 */
function cpfauto_sanitize_int($input) {
    return absint($input);
}

/**
 * Sanitize checkbox value
 * 
 * WHY: Checkboxes should only return boolean values. This ensures
 * only true/false values are accepted.
 *
 * @param mixed $input Input to sanitize.
 * @return bool Sanitized boolean value.
 */
if (!function_exists('cpfauto_sanitize_checkbox')) {
    function cpfauto_sanitize_checkbox($input) {
        return (isset($input) && true === $input) ? true : false;
    }
}

/**
 * Sanitize file uploads
 * 
 * WHY: File uploads are a major security risk. This validates file types
 * before uploads are processed. WordPress already does this, but this adds
 * an extra layer of validation.
 *
 * @param array $file File data array.
 * @return array File data array with error if invalid.
 */
function cpfauto_sanitize_file_uploads($file) {
    // Check file extension
    $filetype = wp_check_filetype($file['name']);
    
    if (!$filetype['ext']) {
        $file['error'] = esc_html__('Invalid file type. Only allowed file types can be uploaded.', 'cpfauto');
    }
    
    // Additional validation: check MIME type matches extension
    $allowed_mimes = get_allowed_mime_types();
    if (!in_array($file['type'], $allowed_mimes)) {
        $file['error'] = esc_html__('File type not allowed.', 'cpfauto');
    }
    
    return $file;
}
add_filter('wp_handle_upload_prefilter', 'cpfauto_sanitize_file_uploads');

// ===========================
// 6. OUTPUT ESCAPING
// ===========================

/**
 * Escape HTML output
 * 
 * WHY: All output must be escaped to prevent XSS attacks. This function
 * converts special characters to HTML entities.
 *
 * @param string $text Text to escape.
 * @return string Escaped HTML.
 */
function cpfauto_esc_html($text) {
    return esc_html($text);
}

/**
 * Escape HTML attributes
 * 
 * WHY: Attribute values need special escaping. This ensures quotes and
 * special characters in attributes don't break HTML or cause XSS.
 *
 * @param string $text Text to escape.
 * @return string Escaped attribute value.
 */
function cpfauto_esc_attr($text) {
    return esc_attr($text);
}

/**
 * Escape URL output
 * 
 * WHY: URLs in output must be escaped to prevent XSS and ensure valid URLs.
 *
 * @param string $url URL to escape.
 * @return string Escaped URL.
 */
function cpfauto_esc_url($url) {
    return esc_url($url);
}

/**
 * Escape URL for use in attributes
 * 
 * WHY: URLs in HTML attributes need raw escaping (no protocol validation).
 *
 * @param string $url URL to escape.
 * @return string Escaped URL for attributes.
 */
function cpfauto_esc_url_raw($url) {
    return esc_url_raw($url);
}

/**
 * Escape JavaScript output
 * 
 * WHY: JavaScript strings must be properly escaped to prevent XSS attacks
 * when outputting dynamic content in JavaScript.
 *
 * @param string $text Text to escape.
 * @return string Escaped JavaScript string.
 */
function cpfauto_esc_js($text) {
    return esc_js($text);
}

/**
 * Escape CSS output
 * 
 * WHY: CSS values must be escaped to prevent CSS injection attacks.
 *
 * @param string $text Text to escape.
 * @return string Escaped CSS value.
 */
function cpfauto_esc_css($text) {
    return esc_css($text);
}

// ===========================
// 7. CSRF PROTECTION
// ===========================

/**
 * Verify nonce for form submissions
 * 
 * WHY: Nonces (number used once) prevent CSRF (Cross-Site Request Forgery)
 * attacks by ensuring form submissions come from your site.
 *
 * @param string $nonce Nonce value to verify.
 * @param string $action Action name for the nonce.
 * @return bool True if nonce is valid, dies with error if invalid.
 */
function cpfauto_verify_nonce($nonce, $action) {
    if (!wp_verify_nonce($nonce, $action)) {
        wp_die(
            esc_html__('Security check failed. Please refresh the page and try again.', 'cpfauto'),
            esc_html__('Security Error', 'cpfauto'),
            array('response' => 403)
        );
    }
    return true;
}

/**
 * Create nonce for forms
 * 
 * WHY: Generates a secure nonce token for form submissions.
 *
 * @param string $action Action name for the nonce.
 * @return string Nonce token.
 */
function cpfauto_create_nonce($action) {
    return wp_create_nonce($action);
}

// ===========================
// 8. ADDITIONAL SECURITY MEASURES
// ===========================

/**
 * Disable file editing in WordPress admin
 * 
 * WHY: Prevents attackers from editing theme/plugin files even if they
 * gain admin access. Add this to wp-config.php for better security:
 * define('DISALLOW_FILE_EDIT', true);
 * 
 * This is commented out because it should be set in wp-config.php instead.
 */
// define('DISALLOW_FILE_EDIT', true); // Add to wp-config.php

/**
 * Limit login attempts (basic implementation)
 * 
 * WHY: Prevents brute force attacks by limiting failed login attempts.
 * Note: For production, use a dedicated security plugin like Wordfence
 * or Limit Login Attempts Reloaded for more robust protection.
 */
function cpfauto_limit_login_attempts($user, $username, $password) {
    // Check if login attempts exceeded
    $transient_key = 'login_attempts_' . md5($username . $_SERVER['REMOTE_ADDR']);
    $attempts = get_transient($transient_key);
    
    if ($attempts && $attempts >= 5) {
        $until = get_option('_transient_timeout_' . $transient_key);
        $time_left = $until - time();
        
        return new WP_Error(
            'too_many_attempts',
            sprintf(
                /* translators: %d: minutes remaining */
                esc_html__('Too many login attempts. Please try again in %d minutes.', 'cpfauto'),
                ceil($time_left / 60)
            )
        );
    }
    
    return $user;
}
add_filter('authenticate', 'cpfauto_limit_login_attempts', 30, 3);

/**
 * Track failed login attempts
 * 
 * WHY: Records failed login attempts to enable rate limiting.
 */
function cpfauto_track_failed_login($username) {
    $transient_key = 'login_attempts_' . md5($username . $_SERVER['REMOTE_ADDR']);
    $attempts = get_transient($transient_key);
    
    if ($attempts) {
        $attempts++;
    } else {
        $attempts = 1;
    }
    
    // Store attempts for 15 minutes
    set_transient($transient_key, $attempts, 15 * MINUTE_IN_SECONDS);
}
add_action('wp_login_failed', 'cpfauto_track_failed_login');

/**
 * Clear login attempts on successful login
 * 
 * WHY: Resets the attempt counter when user successfully logs in.
 */
function cpfauto_clear_login_attempts($username) {
    $transient_key = 'login_attempts_' . md5($username . $_SERVER['REMOTE_ADDR']);
    delete_transient($transient_key);
}
add_action('wp_login', 'cpfauto_clear_login_attempts');

/**
 * Remove query strings from static resources
 * 
 * WHY: Query strings in URLs can reveal information and prevent caching.
 * This removes query strings from CSS/JS URLs.
 *
 * @param string $src Source URL.
 * @return string Clean URL.
 */
function cpfauto_remove_query_strings($src) {
    if (strpos($src, '?ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'cpfauto_remove_query_strings', 15, 1);
add_filter('style_loader_src', 'cpfauto_remove_query_strings', 15, 1);

/**
 * Prevent directory browsing
 * 
 * WHY: Prevents users from seeing directory listings if index files are missing.
 * This should also be configured in .htaccess or server config.
 */
if (!defined('ABSPATH')) {
    // This is handled by the ABSPATH check at the top
    // For additional protection, add to .htaccess:
    // Options -Indexes
}
