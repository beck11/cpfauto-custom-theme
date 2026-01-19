<?php
/**
 * Template part for displaying pages
 *
 * @package Cpfauto
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('max-w-4xl mx-auto'); ?>>
	<header class="entry-header mb-8">
		<?php the_title('<h1 class="entry-title text-3xl md:text-4xl font-heading font-bold text-primary">', '</h1>'); ?>
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
</article>
