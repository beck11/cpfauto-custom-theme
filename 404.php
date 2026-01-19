<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Cpfauto
 */

get_header();
?>

<div class="container-custom py-16 md:py-24 text-center">
	<div class="max-w-2xl mx-auto">
		<h1 class="text-6xl md:text-8xl font-heading font-bold text-primary mb-4">404</h1>
		<h2 class="text-2xl md:text-3xl font-heading font-bold text-gray-900 mb-4">
			<?php esc_html_e('Page Not Found', 'cpfauto'); ?>
		</h2>
		<p class="text-gray-600 mb-8">
			<?php esc_html_e('Sorry, the page you are looking for could not be found.', 'cpfauto'); ?>
		</p>
		<a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary inline-block">
			<?php esc_html_e('Go to Homepage', 'cpfauto'); ?>
		</a>
	</div>
</div>

<?php
get_footer();
