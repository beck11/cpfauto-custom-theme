<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package Cpfauto
 */

get_header();
?>

<?php
// Show hero section on homepage
if (is_front_page() || is_home()) {
	get_template_part('template-parts/hero/hero-section');
	
	// Featured Vehicles Section
	get_template_part('template-parts/sections/featured-vehicles');
	
	// About/Services Section
	get_template_part('template-parts/sections/about-services');
}
?>

<div class="container-custom py-8">
	<?php if (have_posts()) : ?>
		
		<?php if (is_home() && !is_front_page()) : ?>
			<header class="page-header mb-8">
				<h1 class="page-title text-3xl md:text-4xl font-heading font-bold text-primary">
					<?php single_post_title(); ?>
				</h1>
			</header>
		<?php endif; ?>

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
			<?php
			while (have_posts()) :
				the_post();
				get_template_part('template-parts/content/content', get_post_type());
			endwhile;
			?>
		</div>

		<?php
		// Pagination
		the_posts_pagination(array(
			'mid_size'  => 2,
			'prev_text' => __('&laquo; Previous', 'cpfauto'),
			'next_text' => __('Next &raquo;', 'cpfauto'),
		));
		?>

	<?php else : ?>
		<?php get_template_part('template-parts/content/content', 'none'); ?>
	<?php endif; ?>
</div>

<?php
get_footer();
