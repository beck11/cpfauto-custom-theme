<?php
/**
 * The header template
 *
 * @package Cpfauto
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site min-h-screen flex flex-col">
	<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e('Skip to content', 'cpfauto'); ?></a>

	<?php get_template_part('template-parts/header/site-header'); ?>

	<!-- Spacer for fixed header -->
	<div class="header-spacer h-20 lg:h-32"></div>

	<main id="main-content" class="site-main flex-grow">
