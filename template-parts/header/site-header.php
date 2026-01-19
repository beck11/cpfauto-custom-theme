<?php
/**
 * The site header template - Premium Car Dealer Design
 *
 * @package Cpfauto
 */
?>

<header id="masthead" class="site-header header-premium fixed top-0 left-0 right-0 z-50 transition-all duration-300" data-header>
	<!-- Main Header -->
	<div class="container-custom">
		<div class="flex items-center justify-between py-4 lg:py-5 text-white">
			<!-- Logo/Branding - Left -->
			<div class="site-branding flex-shrink-0 z-10">
				<?php
				if (has_custom_logo()) {
					$logo_id = get_theme_mod('custom_logo');
					$logo = wp_get_attachment_image_src($logo_id, 'full');
					if ($logo) {
						?>
						<a href="<?php echo esc_url(home_url('/')); ?>" class="block logo-link" rel="home" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>">
							<img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="h-16 lg:h-[120px] w-auto transition-all duration-300 logo-image">
						</a>
						<?php
					}
				} else {
					?>
					<a href="<?php echo esc_url(home_url('/')); ?>" class="site-title text-xl lg:text-3xl font-display font-bold text-white lg:text-primary transition-colors duration-300" rel="home">
						<?php bloginfo('name'); ?>
					</a>
					<?php
				}
				?>
			</div>

			<!-- Center Navigation - Desktop Only -->
			<?php get_template_part('template-parts/header/site-navigation'); ?>

			<!-- Right Side - Phone + CTA - Desktop Only -->
			<div class="hidden lg:flex items-center space-x-6 flex-shrink-0">
				<?php
				$phone = get_theme_mod('cpfauto_header_phone', '');
				if ($phone) {
					?>
					<a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="header-phone flex items-center space-x-2 text-white lg:text-gray-700 font-heading font-semibold text-sm lg:text-base hover:text-accent transition-colors duration-300 group">
						<svg class="w-4 h-4 lg:w-5 lg:h-5 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
						</svg>
						<span class="whitespace-nowrap"><?php echo esc_html($phone); ?></span>
					</a>
					<?php
				}
				
				$cta_text = get_theme_mod('cpfauto_header_cta_text', __('Schedule Test Drive', 'cpfauto'));
				$cta_link = get_theme_mod('cpfauto_header_cta_link', '#contact');
				if ($cta_text && $cta_link) {
					?>
					<a href="<?php echo esc_url($cta_link); ?>" class="btn-secondary whitespace-nowrap header-cta">
						<span class="cta-text-sm"><?php echo esc_html($cta_text); ?></span>
					</a>
					<?php
				}
				?>
			</div>

			<!-- Mobile Menu Toggle -->
			<button class="menu-toggle lg:hidden relative z-50 w-11 h-11 flex items-center justify-center bg-primary text-white rounded-lg hover:bg-primary-600 transition-colors duration-300" aria-controls="mobile-menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle menu', 'cpfauto'); ?>" data-menu-toggle>
				<span class="sr-only"><?php esc_html_e('Primary Menu', 'cpfauto'); ?></span>
				<!-- Hamburger Icon -->
				<div class="hamburger-icon w-6 h-5 flex flex-col justify-between">
					<span class="hamburger-line block w-full h-0.5 bg-current transition-all duration-300 origin-center"></span>
					<span class="hamburger-line block w-full h-0.5 bg-current transition-all duration-300 origin-center"></span>
					<span class="hamburger-line block w-full h-0.5 bg-current transition-all duration-300 origin-center"></span>
				</div>
			</button>
		</div>
	</div>
</header><!-- #masthead -->
