<?php
/**
 * The template for displaying single posts
 *
 * @package Cpfauto
 */

get_header();
?>

<div class="container-custom py-8">
	<?php
	while (have_posts()) :
		the_post();
		get_template_part('template-parts/content/content', 'single');
		
		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;
	endwhile;
	?>
</div>

<?php
get_footer();
