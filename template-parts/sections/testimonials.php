<?php
/**
 * Testimonials Section
 *
 * @package Cpfauto
 */

// Get testimonials (you can customize this query or use custom post type)
$testimonials = array(
    array(
        'name' => get_theme_mod('cpfauto_testimonial_1_name', __('John Smith', 'cpfauto')),
        'role' => get_theme_mod('cpfauto_testimonial_1_role', __('Car Owner', 'cpfauto')),
        'photo' => get_theme_mod('cpfauto_testimonial_1_photo', ''),
        'quote' => get_theme_mod('cpfauto_testimonial_1_quote', __('Excellent service and a great selection of vehicles. Found my dream car here!', 'cpfauto')),
        'rating' => 5,
    ),
    array(
        'name' => get_theme_mod('cpfauto_testimonial_2_name', __('Sarah Johnson', 'cpfauto')),
        'role' => get_theme_mod('cpfauto_testimonial_2_role', __('Business Owner', 'cpfauto')),
        'photo' => get_theme_mod('cpfauto_testimonial_2_photo', ''),
        'quote' => get_theme_mod('cpfauto_testimonial_2_quote', __('Professional team, transparent pricing, and smooth process. Highly recommended!', 'cpfauto')),
        'rating' => 5,
    ),
    array(
        'name' => get_theme_mod('cpfauto_testimonial_3_name', __('Mike Davis', 'cpfauto')),
        'role' => get_theme_mod('cpfauto_testimonial_3_role', __('Family Man', 'cpfauto')),
        'photo' => get_theme_mod('cpfauto_testimonial_3_photo', ''),
        'quote' => get_theme_mod('cpfauto_testimonial_3_quote', __('Best car buying experience ever. They helped me find the perfect family vehicle.', 'cpfauto')),
        'rating' => 5,
    ),
);
?>

<section class="testimonials-section section-padding bg-white relative overflow-hidden" id="testimonials">
    <!-- Subtle Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, currentColor 10px, currentColor 20px);"></div>
    </div>

    <div class="container-custom relative z-10">
        <!-- Section Header -->
        <header class="section-header text-center mb-12 md:mb-16 animate-fade-in">
            <div class="inline-flex items-center justify-center mb-4">
                <span class="section-label text-sm font-heading font-semibold text-accent uppercase tracking-wide">
                    <?php esc_html_e('Testimonials', 'cpfauto'); ?>
                </span>
            </div>
            <h2 class="section-heading text-primary mb-4">
                <?php echo esc_html(get_theme_mod('cpfauto_testimonials_title', __('What Our Customers Say', 'cpfauto'))); ?>
            </h2>
            <p class="section-subheading max-w-2xl mx-auto">
                <?php echo esc_html(get_theme_mod('cpfauto_testimonials_subtitle', __('Don\'t just take our word for it - hear from our satisfied customers', 'cpfauto'))); ?>
            </p>
        </header>

        <!-- Testimonials Carousel -->
        <div class="testimonials-carousel-wrapper relative">
            <div class="testimonials-carousel flex gap-6 overflow-x-auto snap-x snap-mandatory scrollbar-hide pb-4" data-testimonials-carousel>
                <?php foreach ($testimonials as $index => $testimonial) : ?>
                    <div class="testimonial-card flex-shrink-0 w-full md:w-1/2 lg:w-1/3 snap-start animate-fade-in" style="animation-delay: <?php echo esc_attr($index * 0.1); ?>s;">
                        <div class="bg-white rounded-2xl shadow-card p-8 h-full border border-gray-100 hover:shadow-card-hover transition-shadow duration-300">
                            <!-- Star Rating -->
                            <div class="flex items-center mb-4">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    $star_class = $i <= $testimonial['rating'] ? 'text-accent' : 'text-gray-300';
                                    ?>
                                    <svg class="w-5 h-5 <?php echo esc_attr($star_class); ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <?php
                                }
                                ?>
                            </div>

                            <!-- Quote -->
                            <blockquote class="text-gray-700 mb-6 text-lg leading-relaxed">
                                <span class="text-4xl text-primary-200 leading-none">"</span>
                                <?php echo esc_html($testimonial['quote']); ?>
                                <span class="text-4xl text-primary-200 leading-none">"</span>
                            </blockquote>

                            <!-- Author -->
                            <div class="flex items-center">
                                <?php if ($testimonial['photo']) : ?>
                                    <img src="<?php echo esc_url($testimonial['photo']); ?>" alt="<?php echo esc_attr($testimonial['name']); ?>" class="w-12 h-12 rounded-full object-cover mr-4 border-2 border-primary-200">
                                <?php else : ?>
                                    <div class="w-12 h-12 rounded-full bg-primary-200 flex items-center justify-center mr-4 border-2 border-primary-300">
                                        <span class="text-primary-600 font-heading font-bold text-lg">
                                            <?php echo esc_html(substr($testimonial['name'], 0, 1)); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <div class="font-heading font-semibold text-gray-900">
                                        <?php echo esc_html($testimonial['name']); ?>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        <?php echo esc_html($testimonial['role']); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Carousel Navigation -->
            <div class="flex justify-center items-center mt-8 gap-2">
                <?php foreach ($testimonials as $index => $testimonial) : ?>
                    <button class="carousel-dot rounded-full transition-all duration-300 <?php echo $index === 0 ? 'bg-primary-600 w-8' : 'bg-gray-300 w-2'; ?> h-2 hover:bg-primary-600" data-slide="<?php echo esc_attr($index); ?>" aria-label="<?php echo esc_attr(sprintf(__('Go to slide %d', 'cpfauto'), $index + 1)); ?>"></button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
