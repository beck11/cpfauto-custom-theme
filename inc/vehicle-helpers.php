<?php
/**
 * Vehicle Helper Functions
 *
 * @package Cpfauto
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get Vehicle Meta
 *
 * @param int    $post_id Post ID.
 * @param string $key Meta key.
 * @param mixed  $default Default value.
 * @return mixed
 */
function cpfauto_get_vehicle_meta($post_id = null, $key = '', $default = '') {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $value = get_post_meta($post_id, '_vehicle_' . $key, true);

    return !empty($value) ? $value : $default;
}

/**
 * Get Vehicle Title
 *
 * @param int $post_id Post ID.
 * @return string
 */
function cpfauto_get_vehicle_title($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $year = cpfauto_get_vehicle_meta($post_id, 'year');
    $make = cpfauto_get_vehicle_meta($post_id, 'make');
    $model = cpfauto_get_vehicle_meta($post_id, 'model');

    return trim($year . ' ' . $make . ' ' . $model);
}

/**
 * Get Vehicle Price
 *
 * @param int  $post_id Post ID.
 * @param bool $formatted Return formatted price.
 * @return string|float
 */
function cpfauto_get_vehicle_price($post_id = null, $formatted = true) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $price = cpfauto_get_vehicle_meta($post_id, 'price');
    $currency = cpfauto_get_vehicle_meta($post_id, 'currency', 'USD');

    if (!$formatted) {
        return $price;
    }

    if (empty($price)) {
        return __('Contact for Price', 'cpfauto');
    }

    $symbols = array(
        'USD' => '$',
        'EUR' => '€',
        'GBP' => '£',
        'CAD' => 'CA$',
        'AUD' => 'AU$',
    );

    $symbol = isset($symbols[$currency]) ? $symbols[$currency] : '$';

    return $symbol . number_format($price, 0);
}

/**
 * Get Vehicle Sale Price
 *
 * @param int  $post_id Post ID.
 * @param bool $formatted Return formatted price.
 * @return string|float|false
 */
function cpfauto_get_vehicle_sale_price($post_id = null, $formatted = true) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $sale_price = cpfauto_get_vehicle_meta($post_id, 'sale_price');

    if (empty($sale_price)) {
        return false;
    }

    if (!$formatted) {
        return $sale_price;
    }

    $currency = cpfauto_get_vehicle_meta($post_id, 'currency', 'USD');

    $symbols = array(
        'USD' => '$',
        'EUR' => '€',
        'GBP' => '£',
        'CAD' => 'CA$',
        'AUD' => 'AU$',
    );

    $symbol = isset($symbols[$currency]) ? $symbols[$currency] : '$';

    return $symbol . number_format($sale_price, 0);
}

/**
 * Get Vehicle Discount Percentage
 *
 * @param int $post_id Post ID.
 * @return int|false
 */
function cpfauto_get_vehicle_discount($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $price = cpfauto_get_vehicle_meta($post_id, 'price');
    $original_price = cpfauto_get_vehicle_meta($post_id, 'original_price');

    if (empty($price) || empty($original_price) || $price >= $original_price) {
        return false;
    }

    $discount = (($original_price - $price) / $original_price) * 100;

    return round($discount);
}

/**
 * Check if Vehicle is on Sale
 *
 * @param int $post_id Post ID.
 * @return bool
 */
function cpfauto_is_vehicle_on_sale($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $sale_price = cpfauto_get_vehicle_meta($post_id, 'sale_price');

    return !empty($sale_price);
}

/**
 * Get Vehicle Status Badge
 *
 * @param int $post_id Post ID.
 * @return string
 */
function cpfauto_get_vehicle_status_badge($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $status = cpfauto_get_vehicle_meta($post_id, 'status', 'available');

    $status_labels = array(
        'available' => __('Available', 'cpfauto'),
        'sold'      => __('Sold', 'cpfauto'),
        'pending'   => __('Pending', 'cpfauto'),
        'reserved'  => __('Reserved', 'cpfauto'),
    );

    $status_colors = array(
        'available' => 'bg-green-500',
        'sold'      => 'bg-red-500',
        'pending'   => 'bg-yellow-500',
        'reserved'  => 'bg-blue-500',
    );

    $label = isset($status_labels[$status]) ? $status_labels[$status] : $status_labels['available'];
    $color = isset($status_colors[$status]) ? $status_colors[$status] : $status_colors['available'];

    return '<span class="inline-block px-3 py-1 text-xs font-semibold text-white ' . esc_attr($color) . ' rounded-full uppercase">' . esc_html($label) . '</span>';
}

/**
 * Get Vehicle Condition Badge
 *
 * @param int $post_id Post ID.
 * @return string
 */
function cpfauto_get_vehicle_condition_badge($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $condition = cpfauto_get_vehicle_meta($post_id, 'condition', 'used');

    $condition_labels = array(
        'new'       => __('New', 'cpfauto'),
        'used'      => __('Used', 'cpfauto'),
        'certified' => __('Certified Pre-Owned', 'cpfauto'),
    );

    $condition_colors = array(
        'new'       => 'bg-primary',
        'used'      => 'bg-gray-600',
        'certified' => 'bg-accent',
    );

    $label = isset($condition_labels[$condition]) ? $condition_labels[$condition] : $condition_labels['used'];
    $color = isset($condition_colors[$condition]) ? $condition_colors[$condition] : $condition_colors['used'];

    return '<span class="inline-block px-3 py-1 text-xs font-semibold text-white ' . esc_attr($color) . ' rounded-full">' . esc_html($label) . '</span>';
}

/**
 * Get Vehicle Features
 *
 * @param int  $post_id Post ID.
 * @param bool $as_list Return as HTML list.
 * @return array|string
 */
function cpfauto_get_vehicle_features($post_id = null, $as_list = false) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $features = get_post_meta($post_id, '_vehicle_features', true);
    $features = is_array($features) ? $features : array();

    $feature_labels = array(
        'air_conditioning' => __('Air Conditioning', 'cpfauto'),
        'heated_seats'     => __('Heated Seats', 'cpfauto'),
        'leather_seats'    => __('Leather Seats', 'cpfauto'),
        'sunroof'          => __('Sunroof/Moonroof', 'cpfauto'),
        'navigation'       => __('Navigation System', 'cpfauto'),
        'backup_camera'    => __('Backup Camera', 'cpfauto'),
        'bluetooth'        => __('Bluetooth', 'cpfauto'),
        'cruise_control'   => __('Cruise Control', 'cpfauto'),
        'parking_sensors'  => __('Parking Sensors', 'cpfauto'),
        'blind_spot'       => __('Blind Spot Monitor', 'cpfauto'),
        'lane_departure'   => __('Lane Departure Warning', 'cpfauto'),
        'apple_carplay'    => __('Apple CarPlay', 'cpfauto'),
        'android_auto'     => __('Android Auto', 'cpfauto'),
        'premium_sound'    => __('Premium Sound System', 'cpfauto'),
        'keyless_entry'    => __('Keyless Entry', 'cpfauto'),
        'push_start'       => __('Push Button Start', 'cpfauto'),
        'power_windows'    => __('Power Windows', 'cpfauto'),
        'power_locks'      => __('Power Locks', 'cpfauto'),
        'alloy_wheels'     => __('Alloy Wheels', 'cpfauto'),
        'tow_package'      => __('Tow Package', 'cpfauto'),
    );

    $feature_list = array();
    foreach ($features as $feature) {
        if (isset($feature_labels[$feature])) {
            $feature_list[] = $feature_labels[$feature];
        }
    }

    // Add custom features
    $custom_features = cpfauto_get_vehicle_meta($post_id, 'custom_features');
    if (!empty($custom_features)) {
        $custom_array = array_filter(array_map('trim', explode("\n", $custom_features)));
        $feature_list = array_merge($feature_list, $custom_array);
    }

    if (!$as_list) {
        return $feature_list;
    }

    if (empty($feature_list)) {
        return '<p>' . __('No features listed', 'cpfauto') . '</p>';
    }

    $html = '<ul class="vehicle-features-list grid grid-cols-1 md:grid-cols-2 gap-2">';
    foreach ($feature_list as $feature) {
        $html .= '<li class="flex items-center text-gray-700">';
        $html .= '<svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>';
        $html .= esc_html($feature);
        $html .= '</li>';
    }
    $html .= '</ul>';

    return $html;
}

/**
 * Get Vehicle Gallery
 *
 * @param int $post_id Post ID.
 * @return array
 */
function cpfauto_get_vehicle_gallery($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $gallery_ids = cpfauto_get_vehicle_meta($post_id, 'gallery');

    if (empty($gallery_ids)) {
        return array();
    }

    $ids = explode(',', $gallery_ids);
    $gallery = array();

    foreach ($ids as $id) {
        $image = wp_get_attachment_image_src($id, 'full');
        if ($image) {
            $gallery[] = array(
                'id'        => $id,
                'url'       => $image[0],
                'width'     => $image[1],
                'height'    => $image[2],
                'thumbnail' => wp_get_attachment_image_src($id, 'thumbnail')[0],
                'alt'       => get_post_meta($id, '_wp_attachment_image_alt', true),
            );
        }
    }

    return $gallery;
}

/**
 * Display Vehicle Specs Table
 *
 * @param int $post_id Post ID.
 * @return string
 */
function cpfauto_get_vehicle_specs_table($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $specs = array(
        'make'            => __('Make', 'cpfauto'),
        'model'           => __('Model', 'cpfauto'),
        'year'            => __('Year', 'cpfauto'),
        'condition'       => __('Condition', 'cpfauto'),
        'body_type'       => __('Body Type', 'cpfauto'),
        'mileage'         => __('Mileage', 'cpfauto'),
        'engine'          => __('Engine', 'cpfauto'),
        'transmission'    => __('Transmission', 'cpfauto'),
        'drivetrain'      => __('Drivetrain', 'cpfauto'),
        'fuel_type'       => __('Fuel Type', 'cpfauto'),
        'exterior_color'  => __('Exterior Color', 'cpfauto'),
        'interior_color'  => __('Interior Color', 'cpfauto'),
        'doors'           => __('Doors', 'cpfauto'),
        'seats'           => __('Seats', 'cpfauto'),
        'mpg_city'        => __('MPG City', 'cpfauto'),
        'mpg_highway'     => __('MPG Highway', 'cpfauto'),
        'vin'             => __('VIN', 'cpfauto'),
        'stock_number'    => __('Stock Number', 'cpfauto'),
    );

    $html = '<div class="vehicle-specs-table overflow-x-auto">';
    $html .= '<table class="w-full border border-gray-200">';
    $html .= '<tbody>';

    $row_count = 0;
    foreach ($specs as $key => $label) {
        $value = cpfauto_get_vehicle_meta($post_id, $key);

        if (empty($value)) {
            continue;
        }

        // Format specific fields
        if ($key === 'mileage') {
            $value = number_format($value) . ' ' . __('miles', 'cpfauto');
        } elseif ($key === 'condition') {
            $conditions = array(
                'new'       => __('New', 'cpfauto'),
                'used'      => __('Used', 'cpfauto'),
                'certified' => __('Certified Pre-Owned', 'cpfauto'),
            );
            $value = isset($conditions[$value]) ? $conditions[$value] : ucfirst($value);
        } elseif (in_array($key, array('transmission', 'drivetrain', 'fuel_type', 'body_type'))) {
            $value = ucwords(str_replace(array('-', '_'), ' ', $value));
        }

        $row_class = ($row_count % 2 === 0) ? 'bg-gray-50' : 'bg-white';
        $html .= '<tr class="' . $row_class . '">';
        $html .= '<td class="px-4 py-3 font-semibold text-gray-700 border-r border-gray-200">' . esc_html($label) . '</td>';
        $html .= '<td class="px-4 py-3 text-gray-600">' . esc_html($value) . '</td>';
        $html .= '</tr>';

        $row_count++;
    }

    $html .= '</tbody>';
    $html .= '</table>';
    $html .= '</div>';

    return $html;
}

/**
 * Get Vehicle Contact Information
 *
 * @param int $post_id Post ID.
 * @return array
 */
function cpfauto_get_vehicle_contact($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    return array(
        'name'     => cpfauto_get_vehicle_meta($post_id, 'contact_name'),
        'phone'    => cpfauto_get_vehicle_meta($post_id, 'contact_phone'),
        'email'    => cpfauto_get_vehicle_meta($post_id, 'contact_email'),
        'location' => cpfauto_get_vehicle_meta($post_id, 'location'),
    );
}

/**
 * Format Vehicle Mileage
 *
 * @param int $post_id Post ID.
 * @return string
 */
function cpfauto_get_formatted_mileage($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $mileage = cpfauto_get_vehicle_meta($post_id, 'mileage');

    if (empty($mileage)) {
        return __('N/A', 'cpfauto');
    }

    return number_format($mileage) . ' ' . __('miles', 'cpfauto');
}

/**
 * Get Vehicle Query Args
 *
 * @param array $args Additional query arguments.
 * @return array
 */
function cpfauto_get_vehicle_query_args($args = array()) {
    $defaults = array(
        'post_type'      => 'vehicle',
        'posts_per_page' => 12,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish',
    );

    return wp_parse_args($args, $defaults);
}

/**
 * Get Related Vehicles
 *
 * @param int $post_id Post ID.
 * @param int $count Number of vehicles to retrieve.
 * @return WP_Query|false
 */
function cpfauto_get_related_vehicles($post_id = null, $count = 4) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    // Get vehicle make for related vehicles
    $make = cpfauto_get_vehicle_meta($post_id, 'make');

    if (empty($make)) {
        return false;
    }

    $args = array(
        'post_type'      => 'vehicle',
        'posts_per_page' => $count,
        'post__not_in'   => array($post_id),
        'meta_query'     => array(
            array(
                'key'     => '_vehicle_make',
                'value'   => $make,
                'compare' => '=',
            ),
        ),
    );

    return new WP_Query($args);
}
