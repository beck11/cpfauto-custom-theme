<?php
/**
 * Admin Notices
 *
 * @package Cpfauto
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display admin notice to flush rewrite rules
 */
function cpfauto_flush_rewrite_rules_notice() {
    // Check if we've already shown this notice
    $dismissed = get_option('cpfauto_flush_rewrite_dismissed', false);

    if ($dismissed) {
        return;
    }

    // Check if user can manage options
    if (!current_user_can('manage_options')) {
        return;
    }

    // Check if we're on the right screen
    $screen = get_current_screen();
    if (!$screen || $screen->base !== 'themes') {
        return;
    }

    ?>
    <div class="notice notice-warning is-dismissible cpfauto-flush-notice">
        <p>
            <strong><?php _e('CPF Auto Theme Activated!', 'cpfauto'); ?></strong>
        </p>
        <p>
            <?php _e('To ensure the Vehicle custom post type works correctly, please go to Settings > Permalinks and click "Save Changes" to flush the rewrite rules.', 'cpfauto'); ?>
        </p>
        <p>
            <a href="<?php echo admin_url('options-permalink.php'); ?>" class="button button-primary">
                <?php _e('Go to Permalinks Settings', 'cpfauto'); ?>
            </a>
            <button type="button" class="button cpfauto-dismiss-notice">
                <?php _e('Dismiss this notice', 'cpfauto'); ?>
            </button>
        </p>
    </div>

    <script>
    jQuery(document).ready(function($) {
        $('.cpfauto-dismiss-notice, .cpfauto-flush-notice .notice-dismiss').on('click', function() {
            $.post(ajaxurl, {
                action: 'cpfauto_dismiss_flush_notice',
                nonce: '<?php echo wp_create_nonce('cpfauto_dismiss_flush_notice'); ?>'
            });
        });
    });
    </script>
    <?php
}
add_action('admin_notices', 'cpfauto_flush_rewrite_rules_notice');

/**
 * Handle dismiss notice AJAX
 */
function cpfauto_dismiss_flush_notice_ajax() {
    check_ajax_referer('cpfauto_dismiss_flush_notice', 'nonce');

    if (!current_user_can('manage_options')) {
        wp_die();
    }

    update_option('cpfauto_flush_rewrite_dismissed', true);

    wp_send_json_success();
}
add_action('wp_ajax_cpfauto_dismiss_flush_notice', 'cpfauto_dismiss_flush_notice_ajax');

/**
 * Add vehicle quick stats to dashboard
 */
function cpfauto_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'cpfauto_vehicle_stats',
        __('Vehicle Inventory Stats', 'cpfauto'),
        'cpfauto_dashboard_widget_callback'
    );
}
add_action('wp_dashboard_setup', 'cpfauto_add_dashboard_widget');

/**
 * Dashboard widget callback
 */
function cpfauto_dashboard_widget_callback() {
    // Get vehicle counts by status
    $total = wp_count_posts('vehicle');
    $published = isset($total->publish) ? $total->publish : 0;

    // Count by status
    global $wpdb;
    $available = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->postmeta} pm INNER JOIN {$wpdb->posts} p ON pm.post_id = p.ID WHERE pm.meta_key = '_vehicle_status' AND pm.meta_value = 'available' AND p.post_status = 'publish' AND p.post_type = 'vehicle'");
    $sold = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->postmeta} pm INNER JOIN {$wpdb->posts} p ON pm.post_id = p.ID WHERE pm.meta_key = '_vehicle_status' AND pm.meta_value = 'sold' AND p.post_status = 'publish' AND p.post_type = 'vehicle'");
    $pending = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->postmeta} pm INNER JOIN {$wpdb->posts} p ON pm.post_id = p.ID WHERE pm.meta_key = '_vehicle_status' AND pm.meta_value = 'pending' AND p.post_status = 'publish' AND p.post_type = 'vehicle'");

    ?>
    <div class="cpfauto-dashboard-stats" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">

        <div style="text-align: center; padding: 20px; background: #f0f0f1; border-radius: 8px;">
            <div style="font-size: 32px; font-weight: bold; color: #2271b1; margin-bottom: 5px;">
                <?php echo number_format($published); ?>
            </div>
            <div style="color: #50575e; font-size: 13px; text-transform: uppercase; font-weight: 600;">
                <?php _e('Total Vehicles', 'cpfauto'); ?>
            </div>
        </div>

        <div style="text-align: center; padding: 20px; background: #f0f0f1; border-radius: 8px;">
            <div style="font-size: 32px; font-weight: bold; color: #10B981; margin-bottom: 5px;">
                <?php echo number_format($available); ?>
            </div>
            <div style="color: #50575e; font-size: 13px; text-transform: uppercase; font-weight: 600;">
                <?php _e('Available', 'cpfauto'); ?>
            </div>
        </div>

        <div style="text-align: center; padding: 20px; background: #f0f0f1; border-radius: 8px;">
            <div style="font-size: 32px; font-weight: bold; color: #EF4444; margin-bottom: 5px;">
                <?php echo number_format($sold); ?>
            </div>
            <div style="color: #50575e; font-size: 13px; text-transform: uppercase; font-weight: 600;">
                <?php _e('Sold', 'cpfauto'); ?>
            </div>
        </div>

        <div style="text-align: center; padding: 20px; background: #f0f0f1; border-radius: 8px;">
            <div style="font-size: 32px; font-weight: bold; color: #F59E0B; margin-bottom: 5px;">
                <?php echo number_format($pending); ?>
            </div>
            <div style="color: #50575e; font-size: 13px; text-transform: uppercase; font-weight: 600;">
                <?php _e('Pending', 'cpfauto'); ?>
            </div>
        </div>

    </div>

    <p style="margin-top: 20px; text-align: center;">
        <a href="<?php echo admin_url('edit.php?post_type=vehicle'); ?>" class="button button-primary">
            <?php _e('Manage Vehicles', 'cpfauto'); ?>
        </a>
        <a href="<?php echo admin_url('post-new.php?post_type=vehicle'); ?>" class="button">
            <?php _e('Add New Vehicle', 'cpfauto'); ?>
        </a>
    </p>
    <?php
}
