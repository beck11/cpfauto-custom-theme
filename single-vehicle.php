<?php
/**
 * Single Vehicle Template
 *
 * @package Cpfauto
 */

get_header();
?>

<main id="main-content" class="site-main">
    <?php
    while (have_posts()) :
        the_post();

        // Get vehicle data
        $vehicle_id = get_the_ID();
        $vehicle_title = cpfauto_get_vehicle_title($vehicle_id);
        $price = cpfauto_get_vehicle_price($vehicle_id);
        $sale_price = cpfauto_get_vehicle_sale_price($vehicle_id);
        $discount = cpfauto_get_vehicle_discount($vehicle_id);
        $mileage = cpfauto_get_formatted_mileage($vehicle_id);
        $status = cpfauto_get_vehicle_meta($vehicle_id, 'status', 'available');
        $gallery = cpfauto_get_vehicle_gallery($vehicle_id);
        $contact = cpfauto_get_vehicle_contact($vehicle_id);
        ?>

        <!-- Vehicle Header -->
        <div class="bg-gradient-to-r from-primary to-primary-dark text-white py-8 md:py-12">
            <div class="container-custom">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold mb-2 animate-fade-in">
                            <?php echo esc_html($vehicle_title); ?>
                        </h1>
                        <div class="flex flex-wrap items-center gap-3 text-sm md:text-base animate-fade-in">
                            <?php echo cpfauto_get_vehicle_condition_badge($vehicle_id); ?>
                            <?php echo cpfauto_get_vehicle_status_badge($vehicle_id); ?>
                            <span class="text-white/80">
                                <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                <?php echo esc_html($mileage); ?>
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 md:mt-0 text-right animate-fade-in">
                        <?php if ($discount) : ?>
                            <div class="inline-block bg-accent text-white px-4 py-2 rounded-lg font-bold mb-2">
                                <?php echo esc_html($discount); ?>% <?php _e('OFF', 'cpfauto'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="text-4xl md:text-5xl font-bold">
                            <?php if ($sale_price) : ?>
                                <span class="line-through text-white/60 text-2xl md:text-3xl mr-2"><?php echo esc_html($price); ?></span>
                                <span class="text-accent"><?php echo esc_html($sale_price); ?></span>
                            <?php else : ?>
                                <?php echo esc_html($price); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vehicle Content -->
        <div class="container-custom py-8 md:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Main Content -->
                <div class="lg:col-span-2">

                    <!-- Vehicle Gallery -->
                    <?php if (!empty($gallery) || has_post_thumbnail()) : ?>
                        <div class="mb-8 animate-fade-in">
                            <div class="vehicle-gallery bg-white rounded-card shadow-card overflow-hidden">
                                <?php if (!empty($gallery)) : ?>
                                    <!-- Main Image -->
                                    <div class="main-image mb-4">
                                        <img src="<?php echo esc_url($gallery[0]['url']); ?>"
                                             alt="<?php echo esc_attr($vehicle_title); ?>"
                                             class="w-full h-auto object-cover rounded-lg">
                                    </div>

                                    <!-- Gallery Thumbnails -->
                                    <?php if (count($gallery) > 1) : ?>
                                        <div class="gallery-thumbnails grid grid-cols-4 md:grid-cols-6 gap-2 p-4">
                                            <?php foreach ($gallery as $index => $image) : ?>
                                                <button type="button"
                                                        class="gallery-thumb <?php echo $index === 0 ? 'active' : ''; ?>"
                                                        data-image="<?php echo esc_url($image['url']); ?>">
                                                    <img src="<?php echo esc_url($image['thumbnail']); ?>"
                                                         alt="<?php echo esc_attr($vehicle_title); ?> - Image <?php echo $index + 1; ?>"
                                                         class="w-full h-auto object-cover rounded cursor-pointer hover:opacity-75 transition-opacity">
                                                </button>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php elseif (has_post_thumbnail()) : ?>
                                    <div class="p-4">
                                        <?php the_post_thumbnail('full', array('class' => 'w-full h-auto object-cover rounded-lg')); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Vehicle Description -->
                    <?php if (get_the_content()) : ?>
                        <div class="mb-8 animate-fade-in">
                            <div class="bg-white rounded-card shadow-card p-6">
                                <h2 class="text-2xl font-heading font-bold text-gray-900 mb-4">
                                    <?php _e('Vehicle Description', 'cpfauto'); ?>
                                </h2>
                                <div class="prose prose-lg max-w-none text-gray-600">
                                    <?php the_content(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Technical Specifications -->
                    <div class="mb-8 animate-fade-in">
                        <div class="bg-white rounded-card shadow-card p-6">
                            <h2 class="text-2xl font-heading font-bold text-gray-900 mb-4">
                                <?php _e('Technical Specifications', 'cpfauto'); ?>
                            </h2>
                            <?php echo cpfauto_get_vehicle_specs_table($vehicle_id); ?>
                        </div>
                    </div>

                    <!-- Features & Options -->
                    <?php
                    $features = cpfauto_get_vehicle_features($vehicle_id);
                    if (!empty($features)) :
                    ?>
                        <div class="mb-8 animate-fade-in">
                            <div class="bg-white rounded-card shadow-card p-6">
                                <h2 class="text-2xl font-heading font-bold text-gray-900 mb-4">
                                    <?php _e('Features & Options', 'cpfauto'); ?>
                                </h2>
                                <?php echo cpfauto_get_vehicle_features($vehicle_id, true); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">

                    <!-- Contact Form -->
                    <div class="sticky top-8 animate-fade-in">
                        <div class="bg-white rounded-card shadow-card p-6 mb-6">
                            <h3 class="text-xl font-heading font-bold text-gray-900 mb-4">
                                <?php echo esc_html(get_theme_mod('cpfauto_inquiry_form_title', __('Interested in this vehicle?', 'cpfauto'))); ?>
                            </h3>

                            <?php
                            // Display success/error messages
                            if (isset($_GET['inquiry_sent']) && $_GET['inquiry_sent'] === 'success') {
                                echo '<div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4 text-center">';
                                echo '<p class="text-green-600 font-semibold">' . esc_html__('Thank you! Your inquiry has been sent successfully.', 'cpfauto') . '</p>';
                                echo '</div>';
                            } elseif (isset($_GET['inquiry_sent']) && $_GET['inquiry_sent'] === 'error') {
                                echo '<div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4 text-center">';
                                echo '<p class="text-red-600 font-semibold">' . esc_html__('Sorry, there was an error sending your inquiry. Please try again.', 'cpfauto') . '</p>';
                                echo '</div>';
                            }
                            ?>

                            <?php if ($status === 'sold') : ?>
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-center">
                                    <p class="text-red-600 font-semibold">
                                        <?php _e('This vehicle has been sold.', 'cpfauto'); ?>
                                    </p>
                                </div>
                            <?php else : ?>
                                <form class="space-y-4" id="vehicle-inquiry-form" method="post" action="<?php echo esc_url(get_permalink()); ?>">
                                    <?php wp_nonce_field('cpfauto_inquiry_form', 'cpfauto_inquiry_nonce'); ?>
                                    <input type="hidden" name="cpfauto_inquiry_action" value="submit_inquiry">
                                    <input type="hidden" name="vehicle_id" value="<?php echo esc_attr($vehicle_id); ?>">
                                    <input type="hidden" name="vehicle_title" value="<?php echo esc_attr($vehicle_title); ?>">

                                    <div>
                                        <label for="inquiry_name" class="block text-sm font-medium text-gray-700 mb-1">
                                            <?php echo esc_html(get_theme_mod('cpfauto_inquiry_name_label', __('Your Name', 'cpfauto'))); ?> *
                                        </label>
                                        <input type="text" id="inquiry_name" name="inquiry_name" required
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                    </div>

                                    <div>
                                        <label for="inquiry_email" class="block text-sm font-medium text-gray-700 mb-1">
                                            <?php echo esc_html(get_theme_mod('cpfauto_inquiry_email_label', __('Email Address', 'cpfauto'))); ?> *
                                        </label>
                                        <input type="email" id="inquiry_email" name="inquiry_email" required
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                    </div>

                                    <div>
                                        <label for="inquiry_phone" class="block text-sm font-medium text-gray-700 mb-1">
                                            <?php echo esc_html(get_theme_mod('cpfauto_inquiry_phone_label', __('Phone Number', 'cpfauto'))); ?>
                                        </label>
                                        <input type="tel" id="inquiry_phone" name="inquiry_phone"
                                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                    </div>

                                    <div>
                                        <label for="inquiry_message" class="block text-sm font-medium text-gray-700 mb-1">
                                            <?php echo esc_html(get_theme_mod('cpfauto_inquiry_message_label', __('Message', 'cpfauto'))); ?>
                                        </label>
                                        <textarea id="inquiry_message" name="inquiry_message" rows="4"
                                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                                  placeholder="<?php echo esc_attr(get_theme_mod('cpfauto_inquiry_message_placeholder', __('I am interested in this vehicle...', 'cpfauto'))); ?>"></textarea>
                                    </div>

                                    <button type="submit" class="btn-primary w-full">
                                        <?php echo esc_html(get_theme_mod('cpfauto_inquiry_submit_text', __('Send Inquiry', 'cpfauto'))); ?>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                        <!-- Contact Information -->
                        <?php if (!empty($contact['phone']) || !empty($contact['email'])) : ?>
                            <div class="bg-gray-50 rounded-card p-6">
                                <h3 class="text-lg font-heading font-bold text-gray-900 mb-4">
                                    <?php _e('Contact Information', 'cpfauto'); ?>
                                </h3>

                                <?php if (!empty($contact['name'])) : ?>
                                    <p class="text-gray-700 mb-2 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                        </svg>
                                        <?php echo esc_html($contact['name']); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if (!empty($contact['phone'])) : ?>
                                    <p class="text-gray-700 mb-2">
                                        <a href="tel:<?php echo esc_attr($contact['phone']); ?>" class="flex items-center hover:text-primary transition-colors">
                                            <svg class="w-5 h-5 mr-2 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                            </svg>
                                            <?php echo esc_html($contact['phone']); ?>
                                        </a>
                                    </p>
                                <?php endif; ?>

                                <?php if (!empty($contact['email'])) : ?>
                                    <p class="text-gray-700 mb-2">
                                        <a href="mailto:<?php echo esc_attr($contact['email']); ?>" class="flex items-center hover:text-primary transition-colors">
                                            <svg class="w-5 h-5 mr-2 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                            </svg>
                                            <?php echo esc_html($contact['email']); ?>
                                        </a>
                                    </p>
                                <?php endif; ?>

                                <?php if (!empty($contact['location'])) : ?>
                                    <p class="text-gray-700 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                        <?php echo esc_html($contact['location']); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>

            </div>
        </div>

        <!-- Related Vehicles -->
        <?php
        $related = cpfauto_get_related_vehicles($vehicle_id, 4);
        if ($related && $related->have_posts()) :
        ?>
            <div class="bg-gray-50 py-16">
                <div class="container-custom">
                    <h2 class="text-3xl font-heading font-bold text-center mb-8 animate-fade-in">
                        <?php _e('Similar Vehicles', 'cpfauto'); ?>
                    </h2>

                    <div class="vehicles-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <?php
                        while ($related->have_posts()) :
                            $related->the_post();
                            cpfauto_vehicle_card(get_post());
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    <?php endwhile; ?>
</main>

<script>
// Gallery functionality
document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.querySelector('.main-image img');
    const thumbs = document.querySelectorAll('.gallery-thumb');

    if (mainImage && thumbs.length > 0) {
        thumbs.forEach(thumb => {
            thumb.addEventListener('click', function() {
                const newSrc = this.getAttribute('data-image');

                // Remove active class from all thumbs
                thumbs.forEach(t => t.classList.remove('active'));

                // Add active class to clicked thumb
                this.classList.add('active');

                // Fade out, change src, fade in
                mainImage.style.opacity = '0';
                setTimeout(() => {
                    mainImage.src = newSrc;
                    mainImage.style.opacity = '1';
                }, 300);
            });
        });
    }
});
</script>

<style>
.main-image img {
    transition: opacity 0.3s ease;
}
.gallery-thumb.active img {
    border: 2px solid #15153f;
    opacity: 1 !important;
}
</style>

<?php get_footer(); ?>
