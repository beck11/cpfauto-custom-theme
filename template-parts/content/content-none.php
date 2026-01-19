<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Cpfauto
 */
?>

<section class="no-results not-found text-center py-16">
	<header class="page-header mb-8">
		<h1 class="page-title text-3xl md:text-4xl font-heading font-bold text-primary">
			<?php esc_html_e('Nothing Found', 'cpfauto'); ?>
		</h1>
	</header>

	<div class="page-content max-w-2xl mx-auto">
		<?php if (is_home() && current_user_can('publish_posts')) : ?>
			<p class="text-gray-600 mb-6">
				<?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'cpfauto'),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url(admin_url('post-new.php'))
				);
				?>
			</p>
		<?php elseif (is_search()) : ?>
			<p class="text-gray-600 mb-6">
				<?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'cpfauto'); ?>
			</p>
			<?php get_search_form(); ?>
		<?php else : ?>
			<p class="text-gray-600 mb-6">
				<?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'cpfauto'); ?>
			</p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</section>
