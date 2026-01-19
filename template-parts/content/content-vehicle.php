<?php
/**
 * Template part for displaying vehicle posts
 *
 * @package Cpfauto
 */

// Use vehicle card component - ensure post data is set up
if (function_exists('cpfauto_vehicle_card')) {
	cpfauto_vehicle_card();
} else {
	get_template_part('template-parts/content/card-vehicle');
}
