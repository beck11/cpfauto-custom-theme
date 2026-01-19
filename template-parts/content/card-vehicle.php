<?php
/**
 * Vehicle Card Component - Premium Car Dealer
 *
 * @package Cpfauto
 * 
 * Usage: 
 * Include this file in your template:
 * get_template_part('template-parts/content/card-vehicle');
 * 
 * Or use with custom data:
 * set_query_var('vehicle_data', $custom_data);
 * get_template_part('template-parts/content/card-vehicle');
 */

// Get vehicle data (supports custom fields or post meta)
$vehicle_data = get_query_var('vehicle_data', array());
$post_id = get_the_ID();

// Extract vehicle information using correct meta keys
$vehicle_price = !empty($vehicle_data['price']) ? $vehicle_data['price'] : get_post_meta($post_id, '_vehicle_price', true);
$vehicle_make = !empty($vehicle_data['make']) ? $vehicle_data['make'] : get_post_meta($post_id, '_vehicle_make', true);
$vehicle_model = !empty($vehicle_data['model']) ? $vehicle_data['model'] : get_post_meta($post_id, '_vehicle_model', true);
$vehicle_year = !empty($vehicle_data['year']) ? $vehicle_data['year'] : get_post_meta($post_id, '_vehicle_year', true);
$vehicle_mileage = !empty($vehicle_data['mileage']) ? $vehicle_data['mileage'] : get_post_meta($post_id, '_vehicle_mileage', true);
$vehicle_transmission = !empty($vehicle_data['transmission']) ? $vehicle_data['transmission'] : get_post_meta($post_id, '_vehicle_transmission', true);
$vehicle_seats = !empty($vehicle_data['seats']) ? $vehicle_data['seats'] : get_post_meta($post_id, '_vehicle_seats', true);
$vehicle_exterior_color = !empty($vehicle_data['exterior_color']) ? $vehicle_data['exterior_color'] : get_post_meta($post_id, '_vehicle_exterior_color', true);
$vehicle_interior_color = !empty($vehicle_data['interior_color']) ? $vehicle_data['interior_color'] : get_post_meta($post_id, '_vehicle_interior_color', true);
$vehicle_location = !empty($vehicle_data['location']) ? $vehicle_data['location'] : get_post_meta($post_id, '_vehicle_location', true);
$vehicle_description = !empty($vehicle_data['description']) ? $vehicle_data['description'] : get_the_excerpt();

// Combine colors if both exist
$vehicle_colors = '';
if ($vehicle_exterior_color && $vehicle_interior_color) {
    $vehicle_colors = $vehicle_exterior_color . ' / ' . $vehicle_interior_color;
} elseif ($vehicle_exterior_color) {
    $vehicle_colors = $vehicle_exterior_color;
} elseif ($vehicle_interior_color) {
    $vehicle_colors = $vehicle_interior_color;
}

// Fallback sample data if no custom fields are set (for demonstration)
if (empty($vehicle_price) && empty($vehicle_model) && empty($vehicle_mileage)) {
    // Extract basic info from post title if it contains car info
    $title = get_the_title();
    
    // Try to extract make/model from title (e.g., "BMW X5 2020" -> Make: BMW, Model: X5)
    if (preg_match('/^([A-Za-z]+)\s+([A-Za-z0-9]+)/', $title, $matches)) {
        if (empty($vehicle_make)) {
            $vehicle_make = $matches[1];
        }
        if (empty($vehicle_model)) {
            $vehicle_model = $matches[2];
        }
    }
    
    // Set fallback values for demonstration
    if (empty($vehicle_price)) {
        $vehicle_price = rand(25000, 75000); // Random price for demo
    }
    if (empty($vehicle_mileage)) {
        $vehicle_mileage = rand(10000, 50000); // Random miles for demo
    }
    if (empty($vehicle_transmission)) {
        $vehicle_transmission = 'automatic';
    }
    if (empty($vehicle_seats)) {
        $vehicle_seats = '5';
    }
    if (empty($vehicle_colors)) {
        $colors = array(__('Black', 'cpfauto'), __('White', 'cpfauto'), __('Silver', 'cpfauto'), __('Red', 'cpfauto'), __('Blue', 'cpfauto'));
        $vehicle_colors = $colors[array_rand($colors)];
    }
    if (empty($vehicle_location)) {
        $vehicle_location = __('Available Now', 'cpfauto');
    }
}

// Format price
$formatted_price = $vehicle_price ? '$' . number_format(floatval($vehicle_price)) : __('Price on Request', 'cpfauto');
?>

<article id="vehicle-<?php the_ID(); ?>" <?php post_class('vehicle-card group relative bg-white rounded-card shadow-vehicle-card overflow-hidden transition-all duration-300 hover:shadow-vehicle-card-hover'); ?> data-vehicle-card>
	<!-- Featured Image with Hover Overlay -->
	<div class="vehicle-image-wrapper relative overflow-hidden bg-gray-200 aspect-vehicle">
		<?php if (has_post_thumbnail()) : ?>
			<a href="<?php the_permalink(); ?>" class="block h-full">
				<?php the_post_thumbnail('cpfauto-thumbnail', array(
					'class' => 'vehicle-image w-full h-full object-cover transition-transform duration-500 group-hover:scale-110',
					'alt' => get_the_title()
				)); ?>
			</a>
		<?php else : ?>
			<div class="w-full h-full bg-gradient-to-br from-primary-200 to-primary-400 flex items-center justify-center">
				<svg class="w-24 h-24 text-primary-600 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
				</svg>
			</div>
		<?php endif; ?>
		
		<!-- Hover Overlay -->
		<div class="vehicle-overlay absolute inset-0 bg-gradient-to-t from-primary-900/90 via-primary-800/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
			<div class="vehicle-overlay-content p-6 text-white w-full transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
				<?php if ($vehicle_description) : ?>
					<p class="text-sm leading-relaxed line-clamp-3">
						<?php echo esc_html(wp_trim_words($vehicle_description, 20)); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
		
		<!-- Badge/Status (optional) -->
		<?php if ($vehicle_price && floatval($vehicle_price) < 30000) : ?>
			<div class="absolute top-4 left-4 bg-accent text-primary-900 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">
				<?php esc_html_e('Great Deal', 'cpfauto'); ?>
			</div>
		<?php endif; ?>
	</div>

	<!-- Card Content -->
	<div class="vehicle-content p-6">
		<!-- Title -->
		<header class="vehicle-header mb-4">
			<h3 class="vehicle-title text-xl md:text-2xl font-heading font-bold text-gray-900 mb-2 line-clamp-2">
				<a href="<?php the_permalink(); ?>" class="hover:text-primary transition-colors duration-200">
					<?php the_title(); ?>
				</a>
			</h3>
			
			<!-- Make, Model & Year -->
			<?php if ($vehicle_make || $vehicle_model || $vehicle_year) : ?>
				<div class="vehicle-model-version text-sm text-gray-600 mb-3">
					<?php if ($vehicle_make) : ?>
						<span class="font-semibold"><?php echo esc_html($vehicle_make); ?></span>
					<?php endif; ?>
					<?php if ($vehicle_model) : ?>
						<?php if ($vehicle_make) : ?><span class="text-gray-400"> • </span><?php endif; ?>
						<span><?php echo esc_html($vehicle_model); ?></span>
					<?php endif; ?>
					<?php if ($vehicle_year) : ?>
						<span class="text-gray-400"> • </span>
						<span><?php echo esc_html($vehicle_year); ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</header>

		<!-- Location -->
		<?php if ($vehicle_location) : ?>
			<div class="vehicle-location flex items-center text-sm text-gray-600 mb-4">
				<svg class="w-4 h-4 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
				</svg>
				<span><?php echo esc_html($vehicle_location); ?></span>
			</div>
		<?php endif; ?>

		<!-- Key Features Grid -->
		<div class="vehicle-features grid grid-cols-2 gap-3 mb-6">
			<!-- Mileage -->
			<div class="feature-item flex items-center text-sm">
				<svg class="w-4 h-4 mr-2 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
				</svg>
				<span class="text-gray-700">
					<?php if ($vehicle_mileage) : ?>
						<strong><?php echo esc_html(number_format(floatval($vehicle_mileage))); ?></strong>
						<span class="text-gray-500 text-xs ml-1"><?php esc_html_e('mi', 'cpfauto'); ?></span>
					<?php else : ?>
						<span class="text-gray-500"><?php esc_html_e('N/A', 'cpfauto'); ?></span>
					<?php endif; ?>
				</span>
			</div>
			
			<!-- Transmission -->
			<div class="feature-item flex items-center text-sm">
				<svg class="w-4 h-4 mr-2 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
				</svg>
				<span class="text-gray-700">
					<?php 
					if ($vehicle_transmission) {
						$transmission_labels = array(
							'automatic' => __('Automatic', 'cpfauto'),
							'manual' => __('Manual', 'cpfauto'),
							'cvt' => __('CVT', 'cpfauto'),
							'semi-automatic' => __('Semi-Auto', 'cpfauto'),
						);
						$transmission_display = isset($transmission_labels[$vehicle_transmission]) ? $transmission_labels[$vehicle_transmission] : ucfirst($vehicle_transmission);
						echo esc_html($transmission_display);
					} else {
						echo '<span class="text-gray-500">' . esc_html__('N/A', 'cpfauto') . '</span>';
					}
					?>
				</span>
			</div>
			
			<!-- Seats -->
			<div class="feature-item flex items-center text-sm">
				<svg class="w-4 h-4 mr-2 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
				</svg>
				<span class="text-gray-700">
					<?php if ($vehicle_seats) : ?>
						<strong><?php echo esc_html($vehicle_seats); ?></strong>
						<span class="text-gray-500 text-xs ml-1"><?php esc_html_e('seats', 'cpfauto'); ?></span>
					<?php else : ?>
						<span class="text-gray-500"><?php esc_html_e('N/A', 'cpfauto'); ?></span>
					<?php endif; ?>
				</span>
			</div>
			
			<!-- Colors -->
			<div class="feature-item flex items-center text-sm">
				<svg class="w-4 h-4 mr-2 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
				</svg>
				<span class="text-gray-700">
					<?php echo $vehicle_colors ? esc_html($vehicle_colors) : '<span class="text-gray-500">' . esc_html__('N/A', 'cpfauto') . '</span>'; ?>
				</span>
			</div>
		</div>
		
		<!-- Additional Info: Make, Model, Year (if not shown above) -->
		<?php if (!$vehicle_make && !$vehicle_model && !$vehicle_year) : ?>
			<div class="vehicle-basic-info text-sm text-gray-600 mb-4">
				<p><?php echo esc_html(get_the_title()); ?></p>
			</div>
		<?php endif; ?>

		<!-- Price -->
		<div class="vehicle-price mb-6">
			<div class="price-amount text-3xl font-heading font-bold text-primary mb-1">
				<?php echo esc_html($formatted_price); ?>
			</div>
			<?php if ($vehicle_price && floatval($vehicle_price) > 0) : ?>
				<p class="price-label text-xs text-gray-500 uppercase tracking-wide">
					<?php esc_html_e('Starting Price', 'cpfauto'); ?>
				</p>
			<?php endif; ?>
		</div>

		<!-- CTA Button -->
		<footer class="vehicle-footer">
			<a href="<?php the_permalink(); ?>" class="vehicle-cta btn-primary w-full text-center block group/btn">
				<span class="cta-text-sm"><?php esc_html_e('View Details', 'cpfauto'); ?></span>
				<svg class="w-4 h-4 inline-block ml-2 group-hover/btn:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
				</svg>
			</a>
		</footer>
	</div>
</article>
