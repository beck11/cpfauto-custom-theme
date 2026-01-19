<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 *
 * @package Cpfauto
 */

get_header();
?>

<div class="container-custom py-8">
	<?php
	while (have_posts()) :
		the_post();
		get_template_part('template-parts/content/content', 'page');
		
		// If comments are open or we have at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) :
			comments_template();
		endif;
	endwhile;
	?>
</div>

<?php
// Show featured vehicles section on specific pages
// Check if current page slug or title matches "nos-vehicules", "nos-vehicles", or contains "vehicule"
$page_slug = get_post_field('post_name', get_the_ID());
$page_title = get_the_title();
$show_featured = false;

// Check by slug
if (in_array(strtolower($page_slug), array('nos-vehicules', 'nos-vehicles', 'vehicules', 'vehicles'))) {
	$show_featured = true;
}

// Check by title (case-insensitive)
if (stripos($page_title, 'vehicule') !== false || stripos($page_title, 'vehicle') !== false) {
	$show_featured = true;
}

// Show featured vehicles section
if ($show_featured) {
	get_template_part('template-parts/sections/featured-vehicles');
}
?>

<?php
get_footer();
