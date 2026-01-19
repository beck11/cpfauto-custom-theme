<?php
/**
 * The front page template
 *
 * This template is used when a static page is set as the homepage
 * in Settings > Reading > "A static page"
 *
 * @package Cpfauto
 */

get_header();
?>

<?php
// Hero Section
get_template_part('template-parts/hero/hero-section');

// Featured Vehicles Section
get_template_part('template-parts/sections/featured-vehicles');

// About/Services Section
get_template_part('template-parts/sections/about-services');

// Page Content (if any)
if (have_posts()) {
    while (have_posts()) {
        the_post();
        $content = get_the_content();
        // Only show section if there's actual content
        if (!empty(trim($content))) {
            ?>
            <section class="page-content-section section-padding bg-white">
                <div class="container-custom">
                    <div class="max-w-4xl mx-auto prose prose-lg">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
            <?php
        }
    }
}
?>

<?php
get_footer();
