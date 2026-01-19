<?php
/**
 * Hero Section Template - Premium Car Dealer
 *
 * @package Cpfauto
 */
?>

<section class="hero-section relative min-h-screen flex items-center justify-center overflow-hidden" id="hero">
	<!-- Background Image with Parallax -->
	<div class="hero-background absolute inset-0 z-0 overflow-hidden">
		<?php
		// Get hero background image from customizer or use default
		$hero_image = get_theme_mod('cpfauto_hero_image', '');
		
		// Default background image - you can replace this URL with your own image
		$default_image = 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80';
		
		// Use customizer image if set, otherwise use default
		$bg_image = $hero_image ? $hero_image : $default_image;
		?>
		<div class="w-full h-full bg-cover bg-center bg-no-repeat" style="background-image: url('<?php echo esc_url($bg_image); ?>');">
		</div>
		<!-- Gradient Overlay -->
		<div class="absolute inset-0 bg-gradient-to-b from-primary-900/80 via-primary-800/70 to-primary-900/90 z-10"></div>
		<div class="absolute inset-0 bg-black/30 z-10"></div>
	</div>

	<!-- Hero Content -->
	<div class="hero-content relative z-10 container-custom text-center px-4">
		<div class="max-w-4xl mx-auto">
			<!-- Headline -->
			<h1 class="hero-title display-heading-lg text-white mb-6">
				<?php
				$hero_headline = get_theme_mod('cpfauto_hero_headline', __('Find Your Dream Car', 'cpfauto'));
				echo esc_html($hero_headline);
				?>
			</h1>

			<!-- Subtitle -->
			<p class="hero-subtitle lead-text text-white/90 mb-8 max-w-2xl mx-auto">
				<?php
				$hero_subtitle = get_theme_mod('cpfauto_hero_subtitle', __('Discover premium vehicles with exceptional quality and unbeatable service. Your perfect ride awaits.', 'cpfauto'));
				echo esc_html($hero_subtitle);
				?>
			</p>

			<!-- CTA Buttons -->
			<div class="hero-cta-group flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
				<a href="<?php echo esc_url(get_theme_mod('cpfauto_hero_primary_cta_link', '#inventory')); ?>" class="hero-cta btn-secondary text-lg px-8 py-4 min-w-[200px]">
					<span class="cta-text"><?php echo esc_html(get_theme_mod('cpfauto_hero_primary_cta_text', __('Browse Inventory', 'cpfauto'))); ?></span>
				</a>
				<a href="<?php echo esc_url(get_theme_mod('cpfauto_hero_secondary_cta_link', '#contact')); ?>" class="hero-cta btn-accent text-lg px-8 py-4 min-w-[200px]">
					<span class="cta-text"><?php echo esc_html(get_theme_mod('cpfauto_hero_secondary_cta_text', __('Schedule Test Drive', 'cpfauto'))); ?></span>
				</a>
			</div>

			<!-- Car Search Form -->
			<div class="hero-search animate-fade-in">
				<div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-6 md:p-8 max-w-4xl mx-auto">
					<h3 class="section-heading-sm text-primary mb-6">
						<?php echo esc_html(get_theme_mod('cpfauto_hero_search_title', __('Search Our Inventory', 'cpfauto'))); ?>
					</h3>
					<form action="<?php echo esc_url(get_post_type_archive_link('vehicle')); ?>" method="get" class="hero-search-form">
						<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
							<!-- Make/Model Search -->
							<div>
								<label for="hero-search-make" class="block text-sm font-semibold text-gray-700 mb-2">
									<?php esc_html_e('Make/Model', 'cpfauto'); ?>
								</label>
								<select 
									id="hero-search-make" 
									name="make" 
									class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
								>
									<option value=""><?php esc_html_e('All Makes', 'cpfauto'); ?></option>
									<?php
									// Get all unique vehicle makes from the database
									global $wpdb;
									$makes = $wpdb->get_col("
										SELECT DISTINCT meta_value 
										FROM {$wpdb->postmeta} 
										WHERE meta_key = '_vehicle_make' 
										AND meta_value != '' 
										AND post_id IN (
											SELECT ID FROM {$wpdb->posts} 
											WHERE post_type = 'vehicle' 
											AND post_status = 'publish'
										)
										ORDER BY meta_value ASC
									");
									
									foreach ($makes as $make) :
										if (!empty($make)) :
									?>
										<option value="<?php echo esc_attr($make); ?>">
											<?php echo esc_html($make); ?>
										</option>
									<?php
										endif;
									endforeach;
									?>
								</select>
							</div>

							<!-- Price Range -->
							<div>
								<label for="hero-search-price" class="block text-sm font-semibold text-gray-700 mb-2">
									<?php esc_html_e('Max Price', 'cpfauto'); ?>
								</label>
								<select 
									id="hero-search-price" 
									name="max_price"
									class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
								>
									<option value=""><?php esc_html_e('Any Price', 'cpfauto'); ?></option>
									<option value="10000"><?php esc_html_e('Under $10,000', 'cpfauto'); ?></option>
									<option value="20000"><?php esc_html_e('Under $20,000', 'cpfauto'); ?></option>
									<option value="30000"><?php esc_html_e('Under $30,000', 'cpfauto'); ?></option>
									<option value="50000"><?php esc_html_e('Under $50,000', 'cpfauto'); ?></option>
									<option value="75000"><?php esc_html_e('Under $75,000', 'cpfauto'); ?></option>
									<option value="100000"><?php esc_html_e('Under $100,000', 'cpfauto'); ?></option>
								</select>
							</div>

							<!-- Search Button -->
							<div class="flex items-end">
								<button 
									type="submit" 
									class="btn-primary w-full py-3 text-base font-semibold"
								>
									<span class="cta-text-sm"><?php esc_html_e('Search', 'cpfauto'); ?></span>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Scroll Indicator -->
	<div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10 animate-bounce-subtle">
		<a href="#main-content" class="flex flex-col items-center text-white/80 hover:text-white transition-colors group" aria-label="<?php esc_attr_e('Scroll down', 'cpfauto'); ?>">
			<span class="text-sm font-medium mb-2"><?php esc_html_e('Scroll', 'cpfauto'); ?></span>
			<svg class="w-6 h-6 group-hover:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
			</svg>
		</a>
	</div>
</section>
