<?php
/**
 * The template for displaying search results
 *
 * @package Cpfauto
 */

get_header();
?>

<div class="container-custom py-8">
	<?php if (have_posts()) : ?>
		<header class="page-header mb-8">
			<h1 class="page-title text-3xl md:text-4xl font-heading font-bold text-primary">
				<?php
				/* translators: %s: search query. */
				printf(esc_html__('Search Results for: %s', 'cpfauto'), '<span>' . get_search_query() . '</span>');
				?>
			</h1>
		</header>

		<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
			<?php
			while (have_posts()) :
				the_post();
				get_template_part('template-parts/content/content', 'search');
			endwhile;
			?>
		</div>

		<?php
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
