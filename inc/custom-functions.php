<?php
/**
 * Custom Helper Functions
 *
 * @package Cpfauto
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get theme option helper
 *
 * @param string $option Option name.
 * @param mixed  $default Default value.
 * @return mixed
 */
function cpfauto_get_option($option, $default = false) {
    return get_theme_mod($option, $default);
}

/**
 * Custom excerpt length
 *
 * @param int $length Excerpt length.
 * @return int
 */
function cpfauto_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'cpfauto_excerpt_length', 999);

/**
 * Custom excerpt more
 *
 * @param string $more More text.
 * @return string
 */
function cpfauto_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'cpfauto_excerpt_more');

/**
 * Filter vehicle archive query based on search parameters
 *
 * @param WP_Query $query The WordPress query object.
 */
function cpfauto_filter_vehicle_archive($query) {
    // Only modify the main query on the vehicle archive page
    if (is_admin() || !$query->is_main_query()) {
        return;
    }
    
    // Only apply filters on vehicle archive pages
    if (!is_post_type_archive('vehicle') && !is_tax('vehicle_category') && !is_tax('vehicle_tag')) {
        return;
    }
    
    $meta_query = array();
    
    // Filter by make
    if (isset($_GET['make']) && !empty($_GET['make'])) {
        $meta_query[] = array(
            'key'     => '_vehicle_make',
            'value'   => sanitize_text_field($_GET['make']),
            'compare' => '='
        );
    }
    
    // Filter by max price
    if (isset($_GET['max_price']) && !empty($_GET['max_price'])) {
        $max_price = intval($_GET['max_price']);
        $meta_query[] = array(
            'key'     => '_vehicle_price',
            'value'   => $max_price,
            'type'    => 'NUMERIC',
            'compare' => '<='
        );
    }
    
    // Filter by year
    if (isset($_GET['year']) && !empty($_GET['year'])) {
        $meta_query[] = array(
            'key'     => '_vehicle_year',
            'value'   => intval($_GET['year']),
            'type'    => 'NUMERIC',
            'compare' => '='
        );
    }
    
    // Filter by body type
    if (isset($_GET['body_type']) && !empty($_GET['body_type'])) {
        $meta_query[] = array(
            'key'     => '_vehicle_body_type',
            'value'   => sanitize_text_field($_GET['body_type']),
            'compare' => '='
        );
    }
    
    // Handle search query - search in title and meta fields
    if (isset($_GET['s']) && !empty($_GET['s'])) {
        $search_query = sanitize_text_field($_GET['s']);
        
        // Add meta search conditions to the meta_query array
        $meta_query[] = array(
            'relation' => 'OR',
            array(
                'key'     => '_vehicle_make',
                'value'   => $search_query,
                'compare' => 'LIKE'
            ),
            array(
                'key'     => '_vehicle_model',
                'value'   => $search_query,
                'compare' => 'LIKE'
            )
        );
        
        // Set search query for title/content search
        $query->set('s', $search_query);
    }
    
    // Apply meta query if we have filters or search
    if (!empty($meta_query)) {
        $meta_query['relation'] = 'AND';
        $query->set('meta_query', $meta_query);
    }
    
    // Handle sorting
    if (isset($_GET['orderby']) && !empty($_GET['orderby'])) {
        $orderby = sanitize_text_field($_GET['orderby']);
        
        switch ($orderby) {
            case 'price_asc':
                $query->set('meta_key', '_vehicle_price');
                $query->set('orderby', 'meta_value_num');
                $query->set('order', 'ASC');
                break;
                
            case 'price_desc':
                $query->set('meta_key', '_vehicle_price');
                $query->set('orderby', 'meta_value_num');
                $query->set('order', 'DESC');
                break;
                
            case 'year':
                $query->set('meta_key', '_vehicle_year');
                $query->set('orderby', 'meta_value_num');
                $query->set('order', 'DESC');
                break;
                
            case 'mileage':
                $query->set('meta_key', '_vehicle_mileage');
                $query->set('orderby', 'meta_value_num');
                $query->set('order', 'ASC');
                break;
                
            case 'date':
            default:
                $query->set('orderby', 'date');
                $query->set('order', 'DESC');
                break;
        }
    }
}
add_action('pre_get_posts', 'cpfauto_filter_vehicle_archive');

/**
 * Add custom body classes
 *
 * @param array $classes Body classes.
 * @return array
 */
function cpfauto_body_classes($classes) {
    // Add page slug if it doesn't exist
    if (is_singular()) {
        global $post;
        $classes[] = 'page-' . $post->post_name;
    }
    
    // Add class for no sidebar
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }
    
    return $classes;
}
add_filter('body_class', 'cpfauto_body_classes');

/**
 * Add custom post classes
 *
 * @param array $classes Post classes.
 * @return array
 */
function cpfauto_post_classes($classes) {
    if (!is_singular()) {
        $classes[] = 'entry-summary';
    }
    
    return $classes;
}
add_filter('post_class', 'cpfauto_post_classes');

/**
 * Get post reading time
 *
 * @param int $post_id Post ID.
 * @return string
 */
function cpfauto_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed: 200 words per minute
    
    return sprintf(
        /* translators: %d: reading time in minutes */
        _n('%d minute read', '%d minutes read', $reading_time, 'cpfauto'),
        $reading_time
    );
}

/**
 * Display Vehicle Card Component
 *
 * @param int|WP_Post $post Optional. Post ID or object. Default is global $post.
 * @param array       $args Optional. Array of vehicle data to override post meta.
 */
function cpfauto_vehicle_card($post = null, $args = array()) {
    global $post, $wp_query;
    
    // Store original post
    $original_post = $post;
    
    // Setup post data
    if ($post && is_object($post)) {
        // If it's a post object, use it directly
        $wp_query->setup_postdata($post);
    } elseif ($post && is_numeric($post)) {
        // If it's a post ID, get the post object
        $post = get_post($post);
        if ($post) {
            $wp_query->setup_postdata($post);
        }
    } elseif (!$post) {
        // If no post provided, use global post (should already be set up in the loop)
        // Just ensure post data is available
        if (in_the_loop()) {
            // Post data should already be set up
        }
    }
    
    // Set vehicle data query var
    set_query_var('vehicle_data', $args);
    
    // Load vehicle card template
    get_template_part('template-parts/content/card-vehicle');
    
    // Reset post data only if we changed it
    if ($original_post && $original_post !== $post) {
        $post = $original_post;
        wp_reset_postdata();
    }
}

/**
 * Footer Fallback Menu
 */
function cpfauto_footer_fallback_menu() {
    ?>
    <ul class="footer-menu space-y-3">
        <li><a href="<?php echo esc_url(home_url('/')); ?>" class="text-gray-400 hover:text-accent transition-colors"><?php esc_html_e('Home', 'cpfauto'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/vehicles')); ?>" class="text-gray-400 hover:text-accent transition-colors"><?php esc_html_e('Vehicles', 'cpfauto'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/about')); ?>" class="text-gray-400 hover:text-accent transition-colors"><?php esc_html_e('About', 'cpfauto'); ?></a></li>
        <li><a href="<?php echo esc_url(home_url('/contact')); ?>" class="text-gray-400 hover:text-accent transition-colors"><?php esc_html_e('Contact', 'cpfauto'); ?></a></li>
    </ul>
    <?php
}

/**
 * Sanitize select
 *
 * @param mixed $input Input value.
 * @param mixed $setting Setting object.
 * @return mixed
 */
function cpfauto_sanitize_select($input, $setting) {
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * Fallback menu for when no menu is assigned
 */
function cpfauto_fallback_menu() {
    echo '<ul class="hidden lg:flex lg:items-center lg:space-x-1">';
    echo '<li><a href="' . esc_url(home_url('/')) . '" class="nav-link">' . esc_html__('Home', 'cpfauto') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/inventory')) . '" class="nav-link">' . esc_html__('Inventory', 'cpfauto') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about')) . '" class="nav-link">' . esc_html__('About', 'cpfauto') . '</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '" class="nav-link">' . esc_html__('Contact', 'cpfauto') . '</a></li>';
    echo '</ul>';
}

/**
 * Custom Navigation Walker for Tailwind CSS (Desktop)
 */
class Cpfauto_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    /**
     * Start the element output.
     */
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"submenu absolute left-0 top-full bg-white shadow-xl rounded-lg py-2 min-w-[200px] opacity-0 invisible transition-all duration-300 group-hover:opacity-100 group-hover:visible z-50\">\n";
    }
    
    /**
     * End the element output.
     */
    function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    
    /**
     * Start the element output.
     */
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Add Tailwind classes
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . ($depth === 0 ? ' group relative' : '') . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names . '>';
        
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        
        // Tailwind classes for menu links - Premium Design
        $link_classes = 'nav-link block px-4 py-2 text-gray-700 hover:text-primary hover:bg-gray-50 transition-colors duration-200';
        if ($depth === 0) {
            // Premium navigation links - colors handled by CSS (white by default, black on scroll)
            $link_classes = 'nav-link-desktop px-5 py-2 font-heading font-medium text-sm lg:text-base transition-all duration-300 relative group';
            $link_classes .= ' hover:text-accent';
        }
        if (in_array('current-menu-item', $classes) || in_array('current-page-ancestor', $classes)) {
            $link_classes .= ' current-menu-item font-semibold';
        }
        
        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes . ' class="' . esc_attr($link_classes) . '">';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    /**
     * End the element output.
     */
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}

/**
 * Custom Navigation Walker for Mobile Menu
 */
class Cpfauto_Mobile_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    /**
     * Start the element output.
     */
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"submenu hidden pl-4 mt-2 space-y-2 border-l-2 border-gray-200\">\n";
    }
    
    /**
     * End the element output.
     */
    function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }
    
    /**
     * Start the element output.
     */
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Check if has children
        $has_children = in_array('menu-item-has-children', $classes);
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names . '>';
        
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        
        // Tailwind classes for mobile menu links - Touch-friendly (44px min height)
        $link_classes = 'block px-6 py-4 text-gray-700 hover:text-primary hover:bg-gray-50 transition-colors duration-200 rounded-lg min-h-[44px] flex items-center';
        if (in_array('current-menu-item', $classes) || in_array('current-page-ancestor', $classes)) {
            $link_classes .= ' text-primary font-semibold bg-gray-50';
        }
        
        $item_output = isset($args->before) ? $args->before : '';
        $item_output .= '<a' . $attributes . ' class="' . esc_attr($link_classes) . '">';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after : '');
        if ($has_children) {
            $item_output .= ' <svg class="w-4 h-4 inline-block ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';
        }
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after : '';
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    /**
     * End the element output.
     */
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}

/**
 * Handle vehicle inquiry form submission
 */
function cpfauto_handle_inquiry_form() {
    // Check if form was submitted
    if (!isset($_POST['cpfauto_inquiry_action']) || $_POST['cpfauto_inquiry_action'] !== 'submit_inquiry') {
        return;
    }
    
    // Verify nonce
    if (!isset($_POST['cpfauto_inquiry_nonce']) || !wp_verify_nonce($_POST['cpfauto_inquiry_nonce'], 'cpfauto_inquiry_form')) {
        wp_redirect(add_query_arg('inquiry_sent', 'error', wp_get_referer()));
        exit;
    }
    
    // Sanitize and validate input
    $name = isset($_POST['inquiry_name']) ? sanitize_text_field($_POST['inquiry_name']) : '';
    $email = isset($_POST['inquiry_email']) ? sanitize_email($_POST['inquiry_email']) : '';
    $phone = isset($_POST['inquiry_phone']) ? sanitize_text_field($_POST['inquiry_phone']) : '';
    $message = isset($_POST['inquiry_message']) ? sanitize_textarea_field($_POST['inquiry_message']) : '';
    $vehicle_id = isset($_POST['vehicle_id']) ? intval($_POST['vehicle_id']) : 0;
    $vehicle_title = isset($_POST['vehicle_title']) ? sanitize_text_field($_POST['vehicle_title']) : '';
    
    // Validate required fields
    if (empty($name) || empty($email) || !is_email($email)) {
        wp_redirect(add_query_arg('inquiry_sent', 'error', wp_get_referer()));
        exit;
    }
    
    // Get recipient email from customizer or use admin email
    $recipient_email = get_theme_mod('cpfauto_inquiry_recipient_email', get_option('admin_email'));
    if (empty($recipient_email) || !is_email($recipient_email)) {
        $recipient_email = get_option('admin_email');
    }
    
    // Get vehicle link
    $vehicle_link = $vehicle_id ? get_permalink($vehicle_id) : '';
    
    // Prepare email subject
    $subject = sprintf(__('New Vehicle Inquiry: %s', 'cpfauto'), $vehicle_title);
    
    // Prepare email body
    $email_body = __('New vehicle inquiry received:', 'cpfauto') . "\n\n";
    $email_body .= __('Vehicle:', 'cpfauto') . ' ' . $vehicle_title . "\n";
    if ($vehicle_link) {
        $email_body .= __('Vehicle Link:', 'cpfauto') . ' ' . $vehicle_link . "\n";
    }
    $email_body .= "\n";
    $email_body .= __('Contact Information:', 'cpfauto') . "\n";
    $email_body .= __('Name:', 'cpfauto') . ' ' . $name . "\n";
    $email_body .= __('Email:', 'cpfauto') . ' ' . $email . "\n";
    if (!empty($phone)) {
        $email_body .= __('Phone:', 'cpfauto') . ' ' . $phone . "\n";
    }
    $email_body .= "\n";
    if (!empty($message)) {
        $email_body .= __('Message:', 'cpfauto') . "\n" . $message . "\n";
    }
    
    // Set email headers
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>',
        'Reply-To: ' . $name . ' <' . $email . '>',
    );
    
    // Send email
    $mail_sent = wp_mail($recipient_email, $subject, $email_body, $headers);
    
    // Redirect with success/error message
    if ($mail_sent) {
        wp_redirect(add_query_arg('inquiry_sent', 'success', wp_get_referer()));
    } else {
        wp_redirect(add_query_arg('inquiry_sent', 'error', wp_get_referer()));
    }
    exit;
}
add_action('template_redirect', 'cpfauto_handle_inquiry_form');
