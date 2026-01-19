<?php
/**
 * Template part for displaying search results
 *
 * @package Cpfauto
 */

// Check if this is a vehicle post type
if ('vehicle' === get_post_type()) {
	// Display the full vehicle card with all custom fields and featured image
	cpfauto_vehicle_card(get_post());
} else {
	// Display default search result format for other post types
	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('card animate-fade-in'); ?>>
		<header class="entry-header mb-4">
			<?php the_title('<h2 class="entry-title text-xl md:text-2xl font-heading font-bold text-primary"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>

			<?php if ('post' === get_post_type()) : ?>
				<div class="entry-meta text-sm text-gray-600 mt-2">
					<span class="posted-on">
						<?php echo esc_html(get_the_date()); ?>
					</span>
				</div>
			<?php endif; ?>
		</header>

		<div class="entry-summary text-gray-700">
			<?php the_excerpt(); ?>
		</div>

		<footer class="entry-footer mt-4">
			<a href="<?php the_permalink(); ?>" class="btn-primary">
				<?php esc_html_e('Read More', 'cpfauto'); ?>
			</a>
		</footer>
	</article>
	<?php
}
?>
