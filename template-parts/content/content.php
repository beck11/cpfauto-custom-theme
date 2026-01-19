<?php
/**
 * Template part for displaying posts
 *
 * @package Cpfauto
 */

// If this is a vehicle post type, use the vehicle card template instead
global $post;
$current_post_type = get_post_type();
$post_id = get_the_ID();

// Check by post type, post object, or post class
$is_vehicle = false;
if ($current_post_type === 'vehicle') {
	$is_vehicle = true;
} elseif ($post && isset($post->post_type) && $post->post_type === 'vehicle') {
	$is_vehicle = true;
} elseif ($post_id) {
	$post_type_check = get_post_type($post_id);
	if ($post_type_check === 'vehicle') {
		$is_vehicle = true;
	}
}

if ($is_vehicle) {
	// Use the vehicle card component function to ensure proper setup
	if (function_exists('cpfauto_vehicle_card')) {
		cpfauto_vehicle_card();
	} else {
		get_template_part('template-parts/content/card-vehicle');
	}
	return;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card animate-fade-in'); ?>>
	<?php if (has_post_thumbnail()) : ?>
		<div class="post-thumbnail mb-4">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('cpfauto-thumbnail', array('class' => 'w-full h-auto rounded-lg')); ?>
			</a>
		</div>
	<?php endif; ?>

	<header class="entry-header mb-4">
		<?php
		if (is_singular()) {
			the_title('<h1 class="entry-title text-2xl md:text-3xl font-heading font-bold text-primary">', '</h1>');
		} else {
			the_title('<h2 class="entry-title text-xl md:text-2xl font-heading font-bold text-primary"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		}
		?>

		<?php if ('post' === get_post_type()) : ?>
			<div class="entry-meta text-sm text-gray-600 mt-2">
				<span class="posted-on">
					<?php echo esc_html(get_the_date()); ?>
				</span>
				<span class="byline ml-4">
					<?php esc_html_e('by', 'cpfauto'); ?> <?php the_author(); ?>
				</span>
			</div>
		<?php endif; ?>
	</header>

	<div class="entry-content text-gray-700">
		<?php
		if (is_singular()) {
			the_content();
		} else {
			the_excerpt();
		}
		?>
	</div>

	<?php if (!is_singular()) : ?>
		<footer class="entry-footer mt-4">
			<a href="<?php the_permalink(); ?>" class="btn-primary">
				<?php esc_html_e('Read More', 'cpfauto'); ?>
			</a>
		</footer>
	<?php endif; ?>
</article>
