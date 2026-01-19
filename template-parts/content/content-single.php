<?php
/**
 * Template part for displaying single posts
 *
 * @package Cpfauto
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('max-w-4xl mx-auto'); ?>>
	<header class="entry-header mb-8">
		<?php the_title('<h1 class="entry-title text-3xl md:text-4xl font-heading font-bold text-primary mb-4">', '</h1>'); ?>

		<?php if ('post' === get_post_type()) : ?>
			<div class="entry-meta text-sm text-gray-600 flex flex-wrap items-center gap-4">
				<span class="posted-on">
					<time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
						<?php echo esc_html(get_the_date()); ?>
					</time>
				</span>
				<span class="byline">
					<?php esc_html_e('by', 'cpfauto'); ?> <span class="author"><?php the_author(); ?></span>
				</span>
				<?php if (has_category()) : ?>
					<span class="cat-links">
						<?php the_category(', '); ?>
					</span>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</header>

	<?php if (has_post_thumbnail()) : ?>
		<div class="post-thumbnail mb-8">
			<?php the_post_thumbnail('cpfauto-featured', array('class' => 'w-full h-auto rounded-lg')); ?>
		</div>
	<?php endif; ?>

	<div class="entry-content prose prose-lg max-w-none">
		<?php
		the_content();

		wp_link_pages(array(
			'before' => '<div class="page-links mt-8">' . esc_html__('Pages:', 'cpfauto'),
			'after'  => '</div>',
		));
		?>
	</div>

	<footer class="entry-footer mt-8 pt-8 border-t border-gray-200">
		<?php if (has_tag()) : ?>
			<div class="tags-links mb-4">
				<span class="text-sm font-semibold text-gray-700"><?php esc_html_e('Tags:', 'cpfauto'); ?></span>
				<?php the_tags('<span class="ml-2">', ', ', '</span>'); ?>
			</div>
		<?php endif; ?>
	</footer>
</article>
