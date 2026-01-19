<?php
/**
 * Newsletter Subscription Handler
 *
 * @package Cpfauto
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle newsletter subscription
 */
function cpfauto_handle_newsletter_subscription() {
    // Verify nonce
    if (!isset($_POST['cpfauto_newsletter_nonce']) || !wp_verify_nonce($_POST['cpfauto_newsletter_nonce'], 'cpfauto_newsletter_subscribe')) {
        wp_die('Security check failed', 'Error', array('response' => 403));
    }
    
    // Sanitize email
    $email = isset($_POST['newsletter_email']) ? sanitize_email($_POST['newsletter_email']) : '';
    
    if (!is_email($email)) {
        wp_redirect(add_query_arg('newsletter', 'invalid', wp_get_referer()));
        exit;
    }
    
    // Here you can integrate with your email marketing service
    // For now, we'll just store it as a user meta or send an email notification
    
    // Option 1: Store in WordPress (you can create a custom table or use options)
    $subscribers = get_option('cpfauto_newsletter_subscribers', array());
    if (!in_array($email, $subscribers)) {
        $subscribers[] = $email;
        update_option('cpfauto_newsletter_subscribers', $subscribers);
    }
    
    // Option 2: Send notification email to admin
    $admin_email = get_option('admin_email');
    $subject = sprintf(__('New Newsletter Subscription - %s', 'cpfauto'), get_bloginfo('name'));
    $message = sprintf(__('A new user has subscribed to your newsletter:\n\nEmail: %s\n\nTime: %s', 'cpfauto'), $email, current_time('mysql'));
    wp_mail($admin_email, $subject, $message);
    
    // Redirect with success message
    wp_redirect(add_query_arg('newsletter', 'success', wp_get_referer()));
    exit;
}
add_action('admin_post_cpfauto_newsletter_subscribe', 'cpfauto_handle_newsletter_subscription');
add_action('admin_post_nopriv_cpfauto_newsletter_subscribe', 'cpfauto_handle_newsletter_subscription');
