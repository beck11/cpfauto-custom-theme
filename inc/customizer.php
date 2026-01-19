<?php
/**
 * Theme Customizer
 *
 * @package Cpfauto
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cpfauto_customize_register($wp_customize) {
    
    // Add Theme Options Panel
    $wp_customize->add_panel('cpfauto_theme_options', array(
        'title'    => esc_html__('Theme Options', 'cpfauto'),
        'priority' => 130,
    ));
    
    // Add Header Section
    $wp_customize->add_section('cpfauto_header', array(
        'title'    => esc_html__('Header Settings', 'cpfauto'),
        'panel'    => 'cpfauto_theme_options',
        'priority' => 10,
    ));
    
    // Header Phone Number
    $wp_customize->add_setting('cpfauto_header_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_header_phone', array(
        'label'    => esc_html__('Phone Number', 'cpfauto'),
        'section'  => 'cpfauto_header',
        'type'     => 'text',
        'description' => esc_html__('Display phone number in header top bar', 'cpfauto'),
    ));
    
    // Header Email
    $wp_customize->add_setting('cpfauto_header_email', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_header_email', array(
        'label'    => esc_html__('Email Address', 'cpfauto'),
        'section'  => 'cpfauto_header',
        'type'     => 'email',
        'description' => esc_html__('Display email in header top bar', 'cpfauto'),
    ));
    
    // Header CTA Text
    $wp_customize->add_setting('cpfauto_header_cta_text', array(
        'default'           => esc_html__('Schedule Test Drive', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_header_cta_text', array(
        'label'    => esc_html__('CTA Button Text', 'cpfauto'),
        'section'  => 'cpfauto_header',
        'type'     => 'text',
    ));
    
    // Header CTA Link
    $wp_customize->add_setting('cpfauto_header_cta_link', array(
        'default'           => '#contact',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_header_cta_link', array(
        'label'    => esc_html__('CTA Button Link', 'cpfauto'),
        'section'  => 'cpfauto_header',
        'type'     => 'url',
    ));
    
    // Add Footer Section
    $wp_customize->add_section('cpfauto_footer', array(
        'title'    => esc_html__('Footer Settings', 'cpfauto'),
        'panel'    => 'cpfauto_theme_options',
        'priority' => 20,
    ));
    
    // Footer Copyright Text
    $wp_customize->add_setting('cpfauto_footer_text', array(
        'default'           => '© ' . date('Y') . ' ' . get_bloginfo('name') . '. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_footer_text', array(
        'label'    => esc_html__('Footer Copyright Text', 'cpfauto'),
        'section'  => 'cpfauto_footer',
        'type'     => 'text',
    ));
    
    // Footer Address
    $wp_customize->add_setting('cpfauto_footer_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_footer_address', array(
        'label'    => esc_html__('Footer Address', 'cpfauto'),
        'section'  => 'cpfauto_footer',
        'type'     => 'textarea',
        'description' => esc_html__('Enter your business address to display in the footer', 'cpfauto'),
    ));
    
    // Terms of Service Page
    $wp_customize->add_setting('cpfauto_terms_page', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_terms_page', array(
        'label'    => esc_html__('Terms of Service Page URL', 'cpfauto'),
        'section'  => 'cpfauto_footer',
        'type'     => 'url',
    ));
    
    // Add Hero Section
    $wp_customize->add_section('cpfauto_hero', array(
        'title'    => esc_html__('Hero Section', 'cpfauto'),
        'panel'    => 'cpfauto_theme_options',
        'priority' => 5,
    ));
    
    // Hero Background Image
    $wp_customize->add_setting('cpfauto_hero_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cpfauto_hero_image', array(
        'label'    => esc_html__('Hero Background Image', 'cpfauto'),
        'section'  => 'cpfauto_hero',
        'description' => esc_html__('Upload a background image for the hero section. Recommended size: 1920x1080px', 'cpfauto'),
    )));
    
    // Hero Headline
    $wp_customize->add_setting('cpfauto_hero_headline', array(
        'default'           => esc_html__('Find Your Dream Car', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_hero_headline', array(
        'label'    => esc_html__('Hero Headline', 'cpfauto'),
        'section'  => 'cpfauto_hero',
        'type'     => 'text',
    ));
    
    // Hero Subtitle
    $wp_customize->add_setting('cpfauto_hero_subtitle', array(
        'default'           => esc_html__('Discover premium vehicles with exceptional quality and unbeatable service. Your perfect ride awaits.', 'cpfauto'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_hero_subtitle', array(
        'label'    => esc_html__('Hero Subtitle', 'cpfauto'),
        'section'  => 'cpfauto_hero',
        'type'     => 'textarea',
    ));
    
    // Primary CTA Text
    $wp_customize->add_setting('cpfauto_hero_primary_cta_text', array(
        'default'           => esc_html__('Browse Inventory', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_hero_primary_cta_text', array(
        'label'    => esc_html__('Primary CTA Button Text', 'cpfauto'),
        'section'  => 'cpfauto_hero',
        'type'     => 'text',
    ));
    
    // Primary CTA Link
    $wp_customize->add_setting('cpfauto_hero_primary_cta_link', array(
        'default'           => '#inventory',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_hero_primary_cta_link', array(
        'label'    => esc_html__('Primary CTA Button Link', 'cpfauto'),
        'section'  => 'cpfauto_hero',
        'type'     => 'url',
    ));
    
    // Secondary CTA Text
    $wp_customize->add_setting('cpfauto_hero_secondary_cta_text', array(
        'default'           => esc_html__('Schedule Test Drive', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_hero_secondary_cta_text', array(
        'label'    => esc_html__('Secondary CTA Button Text', 'cpfauto'),
        'section'  => 'cpfauto_hero',
        'type'     => 'text',
    ));
    
    // Secondary CTA Link
    $wp_customize->add_setting('cpfauto_hero_secondary_cta_link', array(
        'default'           => '#contact',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_hero_secondary_cta_link', array(
        'label'    => esc_html__('Secondary CTA Button Link', 'cpfauto'),
        'section'  => 'cpfauto_hero',
        'type'     => 'url',
    ));
    
    // Hero Search Form Title
    $wp_customize->add_setting('cpfauto_hero_search_title', array(
        'default'           => esc_html__('Search Our Inventory', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_hero_search_title', array(
        'label'    => esc_html__('Search Form Title', 'cpfauto'),
        'section'  => 'cpfauto_hero',
        'type'     => 'text',
        'description' => esc_html__('Title displayed above the hero search form', 'cpfauto'),
    ));
    
    // Add Featured Vehicles Section
    $wp_customize->add_section('cpfauto_featured_vehicles', array(
        'title'    => esc_html__('Featured Vehicles Section', 'cpfauto'),
        'panel'    => 'cpfauto_theme_options',
        'priority' => 15,
    ));
    
    $wp_customize->add_setting('cpfauto_featured_vehicles_title', array(
        'default'           => esc_html__('Featured Vehicles', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_featured_vehicles_title', array(
        'label'    => esc_html__('Section Title', 'cpfauto'),
        'section'  => 'cpfauto_featured_vehicles',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('cpfauto_featured_vehicles_subtitle', array(
        'default'           => esc_html__('Discover our handpicked selection of premium vehicles', 'cpfauto'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_featured_vehicles_subtitle', array(
        'label'    => esc_html__('Section Subtitle', 'cpfauto'),
        'section'  => 'cpfauto_featured_vehicles',
        'type'     => 'textarea',
    ));
    
    // Section Label (small uppercase text above title)
    $wp_customize->add_setting('cpfauto_featured_vehicles_label', array(
        'default'           => esc_html__('Our Inventory', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_featured_vehicles_label', array(
        'label'    => esc_html__('Section Label', 'cpfauto'),
        'section'  => 'cpfauto_featured_vehicles',
        'type'     => 'text',
        'description' => esc_html__('Small uppercase label displayed above the section title', 'cpfauto'),
    ));
    
    $wp_customize->add_setting('cpfauto_inventory_page_link', array(
        'default'           => home_url('/inventory'),
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_inventory_page_link', array(
        'label'    => esc_html__('View All Vehicles Link', 'cpfauto'),
        'section'  => 'cpfauto_featured_vehicles',
        'type'     => 'url',
    ));
    
    // View All Vehicles Button Text
    $wp_customize->add_setting('cpfauto_view_all_vehicles_text', array(
        'default'           => esc_html__('View All Vehicles', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_view_all_vehicles_text', array(
        'label'    => esc_html__('View All Vehicles Button Text', 'cpfauto'),
        'section'  => 'cpfauto_featured_vehicles',
        'type'     => 'text',
        'description' => esc_html__('Text displayed on the button that links to all vehicles', 'cpfauto'),
    ));
    
    // Vehicle Archive Page Description
    $wp_customize->add_setting('cpfauto_vehicle_archive_description', array(
        'default'           => esc_html__('Explore our wide selection of quality vehicles. Find your perfect car today!', 'cpfauto'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_vehicle_archive_description', array(
        'label'    => esc_html__('Vehicle Archive Page Description', 'cpfauto'),
        'section'  => 'cpfauto_featured_vehicles',
        'type'     => 'textarea',
        'description' => esc_html__('Description text displayed on the vehicle archive page header', 'cpfauto'),
    ));
    
    // Vehicle Archive Header Background Color
    $wp_customize->add_setting('cpfauto_vehicle_archive_header_bg', array(
        'default'           => '#15153f',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cpfauto_vehicle_archive_header_bg', array(
        'label'    => esc_html__('Vehicle Archive Header Background Color', 'cpfauto'),
        'section'  => 'cpfauto_featured_vehicles',
        'description' => esc_html__('Background color for the vehicle archive page header section', 'cpfauto'),
    )));
    
    // Vehicle Archive Header Background Color (Gradient End)
    $wp_customize->add_setting('cpfauto_vehicle_archive_header_bg_end', array(
        'default'           => '#090924',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cpfauto_vehicle_archive_header_bg_end', array(
        'label'    => esc_html__('Vehicle Archive Header Background Color (Gradient End)', 'cpfauto'),
        'section'  => 'cpfauto_featured_vehicles',
        'description' => esc_html__('End color for the gradient background (darker shade)', 'cpfauto'),
    )));
    
    // Vehicle Archive Header Heading Color
    $wp_customize->add_setting('cpfauto_vehicle_archive_heading_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cpfauto_vehicle_archive_heading_color', array(
        'label'    => esc_html__('Vehicle Archive Header Heading Color', 'cpfauto'),
        'section'  => 'cpfauto_featured_vehicles',
        'description' => esc_html__('Text color for the main heading on the vehicle archive page', 'cpfauto'),
    )));
    
    // Add Vehicle Inquiry Form Section
    $wp_customize->add_section('cpfauto_inquiry_form', array(
        'title'    => esc_html__('Vehicle Inquiry Form', 'cpfauto'),
        'panel'    => 'cpfauto_theme_options',
        'priority' => 14,
    ));
    
    // Inquiry Form Title
    $wp_customize->add_setting('cpfauto_inquiry_form_title', array(
        'default'           => esc_html__('Interested in this vehicle?', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_inquiry_form_title', array(
        'label'    => esc_html__('Form Title', 'cpfauto'),
        'section'  => 'cpfauto_inquiry_form',
        'type'     => 'text',
        'description' => esc_html__('Title displayed above the inquiry form', 'cpfauto'),
    ));
    
    // Name Field Label
    $wp_customize->add_setting('cpfauto_inquiry_name_label', array(
        'default'           => esc_html__('Your Name', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_inquiry_name_label', array(
        'label'    => esc_html__('Name Field Label', 'cpfauto'),
        'section'  => 'cpfauto_inquiry_form',
        'type'     => 'text',
    ));
    
    // Email Field Label
    $wp_customize->add_setting('cpfauto_inquiry_email_label', array(
        'default'           => esc_html__('Email Address', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_inquiry_email_label', array(
        'label'    => esc_html__('Email Field Label', 'cpfauto'),
        'section'  => 'cpfauto_inquiry_form',
        'type'     => 'text',
    ));
    
    // Phone Field Label
    $wp_customize->add_setting('cpfauto_inquiry_phone_label', array(
        'default'           => esc_html__('Phone Number', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_inquiry_phone_label', array(
        'label'    => esc_html__('Phone Field Label', 'cpfauto'),
        'section'  => 'cpfauto_inquiry_form',
        'type'     => 'text',
    ));
    
    // Message Field Label
    $wp_customize->add_setting('cpfauto_inquiry_message_label', array(
        'default'           => esc_html__('Message', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_inquiry_message_label', array(
        'label'    => esc_html__('Message Field Label', 'cpfauto'),
        'section'  => 'cpfauto_inquiry_form',
        'type'     => 'text',
    ));
    
    // Message Placeholder
    $wp_customize->add_setting('cpfauto_inquiry_message_placeholder', array(
        'default'           => esc_html__('I am interested in this vehicle...', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_inquiry_message_placeholder', array(
        'label'    => esc_html__('Message Placeholder Text', 'cpfauto'),
        'section'  => 'cpfauto_inquiry_form',
        'type'     => 'text',
    ));
    
    // Submit Button Text
    $wp_customize->add_setting('cpfauto_inquiry_submit_text', array(
        'default'           => esc_html__('Send Inquiry', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_inquiry_submit_text', array(
        'label'    => esc_html__('Submit Button Text', 'cpfauto'),
        'section'  => 'cpfauto_inquiry_form',
        'type'     => 'text',
    ));
    
    // Recipient Email Address
    $wp_customize->add_setting('cpfauto_inquiry_recipient_email', array(
        'default'           => get_option('admin_email'),
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_inquiry_recipient_email', array(
        'label'    => esc_html__('Recipient Email Address', 'cpfauto'),
        'section'  => 'cpfauto_inquiry_form',
        'type'     => 'email',
        'description' => esc_html__('Email address where inquiry form submissions will be sent', 'cpfauto'),
    ));
    
    // Add About Section
    $wp_customize->add_section('cpfauto_about', array(
        'title'    => esc_html__('About/Services Section', 'cpfauto'),
        'panel'    => 'cpfauto_theme_options',
        'priority' => 16,
    ));
    
    // About Section Label
    $wp_customize->add_setting('cpfauto_about_label', array(
        'default'           => esc_html__('About Us', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_about_label', array(
        'label'    => esc_html__('Section Label', 'cpfauto'),
        'section'  => 'cpfauto_about',
        'type'     => 'text',
        'description' => esc_html__('Small uppercase label displayed above the section title', 'cpfauto'),
    ));
    
    // Feature Items (4 items)
    for ($i = 1; $i <= 4; $i++) {
        // Feature Title
        $wp_customize->add_setting("cpfauto_about_feature_{$i}_title", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control("cpfauto_about_feature_{$i}_title", array(
            'label'    => sprintf(esc_html__('Feature %d Title', 'cpfauto'), $i),
            'section'  => 'cpfauto_about',
            'type'     => 'text',
        ));
        
        // Feature Description
        $wp_customize->add_setting("cpfauto_about_feature_{$i}_description", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control("cpfauto_about_feature_{$i}_description", array(
            'label'    => sprintf(esc_html__('Feature %d Description', 'cpfauto'), $i),
            'section'  => 'cpfauto_about',
            'type'     => 'text',
        ));
    }
    
    // Feature Item Title Color
    $wp_customize->add_setting('cpfauto_about_feature_title_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'cpfauto_about_feature_title_color', array(
        'label'    => esc_html__('Feature Item Title Color', 'cpfauto'),
        'section'  => 'cpfauto_about',
        'description' => esc_html__('Color for the feature item titles', 'cpfauto'),
    )));
    
    // Feature Item Description Color
    $wp_customize->add_setting('cpfauto_about_feature_description_color', array(
        'default'           => 'rgba(255, 255, 255, 0.8)',
        'sanitize_callback' => 'cpfauto_sanitize_color',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_about_feature_description_color', array(
        'label'    => esc_html__('Feature Item Description Color', 'cpfauto'),
        'section'  => 'cpfauto_about',
        'type'     => 'text',
        'description' => esc_html__('Color for the feature item descriptions (hex color or rgba, e.g., #ffffff or rgba(255,255,255,0.8))', 'cpfauto'),
    ));
    
    $wp_customize->add_setting('cpfauto_about_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'cpfauto_about_image', array(
        'label'    => esc_html__('About Section Image', 'cpfauto'),
        'section'  => 'cpfauto_about',
    )));
    
    $wp_customize->add_setting('cpfauto_about_title', array(
        'default'           => esc_html__('Your Trusted Car Dealer', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_about_title', array(
        'label'    => esc_html__('About Title', 'cpfauto'),
        'section'  => 'cpfauto_about',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('cpfauto_about_content', array(
        'default'           => esc_html__('With over 20 years of experience in the automotive industry, we pride ourselves on providing exceptional service and premium vehicles. Our commitment to quality and customer satisfaction sets us apart.', 'cpfauto'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_about_content', array(
        'label'    => esc_html__('About Content', 'cpfauto'),
        'section'  => 'cpfauto_about',
        'type'     => 'textarea',
    ));
    
    // Stats
    $wp_customize->add_setting('cpfauto_stat_vehicles', array(
        'default'           => '500',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_stat_vehicles', array(
        'label'    => esc_html__('Vehicles Count', 'cpfauto'),
        'section'  => 'cpfauto_about',
        'type'     => 'number',
    ));
    
    $wp_customize->add_setting('cpfauto_stat_customers', array(
        'default'           => '2000',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_stat_customers', array(
        'label'    => esc_html__('Happy Customers Count', 'cpfauto'),
        'section'  => 'cpfauto_about',
        'type'     => 'number',
    ));
    
    $wp_customize->add_setting('cpfauto_stat_years', array(
        'default'           => '20',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_stat_years', array(
        'label'    => esc_html__('Years Experience', 'cpfauto'),
        'section'  => 'cpfauto_about',
        'type'     => 'number',
    ));
    
    // Add Testimonials Section
    $wp_customize->add_section('cpfauto_testimonials', array(
        'title'    => esc_html__('Testimonials Section', 'cpfauto'),
        'panel'    => 'cpfauto_theme_options',
        'priority' => 17,
    ));
    
    $wp_customize->add_setting('cpfauto_testimonials_title', array(
        'default'           => esc_html__('What Our Customers Say', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_testimonials_title', array(
        'label'    => esc_html__('Section Title', 'cpfauto'),
        'section'  => 'cpfauto_testimonials',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('cpfauto_testimonials_subtitle', array(
        'default'           => esc_html__('Don\'t just take our word for it - hear from our satisfied customers', 'cpfauto'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_testimonials_subtitle', array(
        'label'    => esc_html__('Section Subtitle', 'cpfauto'),
        'section'  => 'cpfauto_testimonials',
        'type'     => 'textarea',
    ));
    
    // Testimonial 1
    $wp_customize->add_setting('cpfauto_testimonial_1_name', array(
        'default'           => esc_html__('John Smith', 'cpfauto'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_testimonial_1_name', array(
        'label'    => esc_html__('Testimonial 1 - Name', 'cpfauto'),
        'section'  => 'cpfauto_testimonials',
        'type'     => 'text',
    ));
    
    $wp_customize->add_setting('cpfauto_testimonial_1_quote', array(
        'default'           => esc_html__('Excellent service and a great selection of vehicles. Found my dream car here!', 'cpfauto'),
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));
    
    $wp_customize->add_control('cpfauto_testimonial_1_quote', array(
        'label'    => esc_html__('Testimonial 1 - Quote', 'cpfauto'),
        'section'  => 'cpfauto_testimonials',
        'type'     => 'textarea',
    ));
    
    // Add Social Media Section
    $wp_customize->add_section('cpfauto_social', array(
        'title'    => esc_html__('Social Media', 'cpfauto'),
        'panel'    => 'cpfauto_theme_options',
        'priority' => 30,
    ));
    
    // Social Media Links
    $social_networks = array(
        'facebook'  => esc_html__('Facebook', 'cpfauto'),
        'twitter'   => esc_html__('Twitter', 'cpfauto'),
        'instagram' => esc_html__('Instagram', 'cpfauto'),
        'linkedin'  => esc_html__('LinkedIn', 'cpfauto'),
        'youtube'   => esc_html__('YouTube', 'cpfauto'),
    );
    
    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting('cpfauto_social_' . $network, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'refresh',
        ));
        
        $wp_customize->add_control('cpfauto_social_' . $network, array(
            'label'    => $label,
            'section'  => 'cpfauto_social',
            'type'     => 'url',
        ));
    }
}
add_action('customize_register', 'cpfauto_customize_register');

/**
 * Sanitize color value (hex or rgba)
 *
 * @param string $color Color value to sanitize.
 * @return string Sanitized color value.
 */
function cpfauto_sanitize_color($color) {
    // Check if it's a hex color
    if (preg_match('/^#[a-fA-F0-9]{6}$/', $color)) {
        return sanitize_hex_color($color);
    }
    
    // Check if it's an rgba color
    if (preg_match('/^rgba?\(\s*\d+\s*,\s*\d+\s*,\s*\d+\s*(,\s*[\d.]+)?\s*\)$/', $color)) {
        return $color;
    }
    
    // Default fallback
    return sanitize_text_field($color);
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cpfauto_customize_preview_js() {
    wp_enqueue_script(
        'cpfauto-customizer',
        CPFAUTO_URI . '/assets/js/customizer.js',
        array('customize-preview'),
        CPFAUTO_VERSION,
        true
    );
}
add_action('customize_preview_init', 'cpfauto_customize_preview_js');
