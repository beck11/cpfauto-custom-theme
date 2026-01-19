<?php
/**
 * Featured Vehicles Section
 *
 * @package Cpfauto
 */

// Get featured vehicles (using vehicle custom post type)
// First try to get vehicles with featured_vehicle meta
$featured_args = array(
    'post_type'      => 'vehicle',
    'posts_per_page' => 6,
    'meta_key'       => 'featured_vehicle',
    'meta_value'     => 'yes',
    'orderby'        => 'date',
    'order'          => 'DESC',
);

// Fallback: Get latest vehicles if no featured vehicles
$featured_query = new WP_Query($featured_args);
if (!$featured_query->have_posts()) {
    $featured_args = array(
        'post_type'      => 'vehicle',
        'posts_per_page' => 6,
        'orderby'        => 'date',
        'order'          => 'DESC',
    );
    $featured_query = new WP_Query($featured_args);
}
?>

<section class="featured-vehicles-section section-padding bg-gray-50" id="featured-vehicles">
    <div class="container-custom">
        <!-- Section Header -->
        <header class="section-header text-center mb-12 md:mb-16 animate-fade-in">
            <div class="inline-flex items-center justify-center mb-4">
                <span class="section-label text-sm font-heading font-semibold text-accent uppercase tracking-wide">
                    <?php echo esc_html(get_theme_mod('cpfauto_featured_vehicles_label', __('Our Inventory', 'cpfauto'))); ?>
                </span>
            </div>
            <h2 class="section-heading text-primary mb-4">
                <?php echo esc_html(get_theme_mod('cpfauto_featured_vehicles_title', __('Featured Vehicles', 'cpfauto'))); ?>
            </h2>
            <p class="section-subheading max-w-2xl mx-auto">
                <?php echo esc_html(get_theme_mod('cpfauto_featured_vehicles_subtitle', __('Discover our handpicked selection of premium vehicles', 'cpfauto'))); ?>
            </p>
        </header>

        <!-- Vehicles Grid -->
        <?php if ($featured_query->have_posts()) : ?>
            <div class="vehicles-grid animate-stagger grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 mb-12">
                <?php
                while ($featured_query->have_posts()) :
                    $featured_query->the_post();
                    get_template_part('template-parts/content/card-vehicle');
                endwhile;
                wp_reset_postdata();
                ?>
            </div>

            <!-- View All CTA -->
            <div class="text-center animate-fade-in">
                <a href="<?php echo esc_url(get_post_type_archive_link('vehicle')); ?>" class="btn-primary inline-flex items-center">
                    <span class="cta-text"><?php echo esc_html(get_theme_mod('cpfauto_view_all_vehicles_text', __('View All Vehicles', 'cpfauto'))); ?></span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        <?php else : ?>
            <div class="text-center py-12">
                <p class="text-gray-600"><?php esc_html_e('No vehicles found.', 'cpfauto'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</section>
