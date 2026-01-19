<?php
/**
 * About/Services Section
 *
 * @package Cpfauto
 */
?>

<section class="about-services-section section-padding bg-primary-600 text-white relative overflow-hidden" id="about-services">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
    </div>

    <div class="container-custom relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Left Side - Image -->
            <div class="about-image-wrapper animate-slide-left">
                <?php
                $about_image = get_theme_mod('cpfauto_about_image', '');
                if ($about_image) {
                    ?>
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                        <img src="<?php echo esc_url($about_image); ?>" alt="<?php esc_attr_e('About Us', 'cpfauto'); ?>" class="w-full h-auto object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-900/50 to-transparent"></div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-primary-700 aspect-video flex items-center justify-center">
                        <svg class="w-32 h-32 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <?php
                }
                ?>
            </div>

            <!-- Right Side - Content -->
            <div class="about-content animate-slide-right">
                <!-- Section Label -->
                <div class="inline-flex items-center mb-4">
                    <span class="section-label text-sm font-heading font-semibold text-accent uppercase tracking-wide">
                        <?php echo esc_html(get_theme_mod('cpfauto_about_label', __('About Us', 'cpfauto'))); ?>
                    </span>
                </div>

                <!-- Title -->
                <h2 class="section-heading text-white mb-6">
                    <?php echo esc_html(get_theme_mod('cpfauto_about_title', __('Your Trusted Car Dealer', 'cpfauto'))); ?>
                </h2>

                <!-- Description -->
                <div class="body-text-lg text-white/90 mb-8 space-y-4">
                    <?php
                    $about_content = get_theme_mod('cpfauto_about_content', __('With over 20 years of experience in the automotive industry, we pride ourselves on providing exceptional service and premium vehicles. Our commitment to quality and customer satisfaction sets us apart.', 'cpfauto'));
                    echo wp_kses_post(wpautop($about_content));
                    ?>
                </div>

                <!-- Features Grid -->
                <div class="features-grid grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">
                    <?php
                    // Default icons for each feature
                    $default_icons = array(
                        '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                        '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                        '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
                        '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
                    );
                    
                    // Default titles and descriptions
                    $default_titles = array(
                        __('Certified Vehicles', 'cpfauto'),
                        __('Financing Options', 'cpfauto'),
                        __('Expert Service', 'cpfauto'),
                        __('Trade-In Program', 'cpfauto'),
                    );
                    
                    $default_descriptions = array(
                        __('All vehicles inspected and certified', 'cpfauto'),
                        __('Flexible payment plans available', 'cpfauto'),
                        __('Professional team ready to help', 'cpfauto'),
                        __('Get value for your current vehicle', 'cpfauto'),
                    );
                    
                    // Build services array from Customizer or use defaults
                    $services = array();
                    for ($i = 1; $i <= 4; $i++) {
                        $title = get_theme_mod("cpfauto_about_feature_{$i}_title", '');
                        $description = get_theme_mod("cpfauto_about_feature_{$i}_description", '');
                        
                        // Use customizer values if set, otherwise use defaults
                        $final_title = !empty($title) ? $title : (isset($default_titles[$i - 1]) ? $default_titles[$i - 1] : '');
                        $final_description = !empty($description) ? $description : (isset($default_descriptions[$i - 1]) ? $default_descriptions[$i - 1] : '');
                        
                        // Only add if we have a title (either from customizer or default)
                        if (!empty($final_title)) {
                            $services[] = array(
                                'icon' => isset($default_icons[$i - 1]) ? $default_icons[$i - 1] : $default_icons[0],
                                'title' => $final_title,
                                'description' => $final_description,
                            );
                        }
                    }

                    // Get customizable colors
                    $title_color = get_theme_mod('cpfauto_about_feature_title_color', '#ffffff');
                    $description_color = get_theme_mod('cpfauto_about_feature_description_color', 'rgba(255, 255, 255, 0.8)');
                    
                    // Sanitize colors
                    $title_color_style = 'color: ' . esc_attr($title_color) . ';';
                    $description_color_style = 'color: ' . esc_attr($description_color) . ';';
                    
                    foreach ($services as $service) {
                        ?>
                        <div class="feature-item bg-white/10 backdrop-blur-sm rounded-xl p-6 border border-white/20 hover:bg-white/20 transition-all duration-300">
                            <div class="feature-icon text-accent mb-4">
                                <?php echo $service['icon']; ?>
                            </div>
                            <h3 class="text-xl font-heading font-semibold mb-2" style="<?php echo esc_attr($title_color_style); ?>">
                                <?php echo esc_html($service['title']); ?>
                            </h3>
                            <p class="text-sm" style="<?php echo esc_attr($description_color_style); ?>">
                                <?php echo esc_html($service['description']); ?>
                            </p>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <!-- Stats Counters -->
                <div class="stats-grid grid grid-cols-3 gap-6 pt-8 border-t border-white/20">
                    <?php
                    $stats = array(
                        array(
                            'number' => get_theme_mod('cpfauto_stat_vehicles', '500'),
                            'label' => __('Vehicles', 'cpfauto'),
                            'suffix' => '+',
                        ),
                        array(
                            'number' => get_theme_mod('cpfauto_stat_customers', '2000'),
                            'label' => __('Happy Customers', 'cpfauto'),
                            'suffix' => '+',
                        ),
                        array(
                            'number' => get_theme_mod('cpfauto_stat_years', '20'),
                            'label' => __('Years Experience', 'cpfauto'),
                            'suffix' => '+',
                        ),
                    );

                    foreach ($stats as $stat) {
                        ?>
                        <div class="stat-item text-center">
                            <div class="stat-number counter text-4xl md:text-5xl font-display font-bold text-accent mb-2" data-target="<?php echo esc_attr($stat['number']); ?>">
                                0<?php echo esc_html($stat['suffix']); ?>
                            </div>
                            <div class="stat-label text-sm text-white/80 uppercase tracking-wide">
                                <?php echo esc_html($stat['label']); ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
