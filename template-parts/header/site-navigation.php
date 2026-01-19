<?php
/**
 * The site navigation template - Premium Car Dealer Design
 *
 * @package Cpfauto
 */
?>

<nav id="site-navigation" class="main-navigation hidden lg:flex lg:items-center lg:justify-center flex-1" role="navigation" aria-label="<?php esc_attr_e('Primary Menu', 'cpfauto'); ?>">
	<?php
	wp_nav_menu(array(
		'theme_location'  => 'primary',
		'menu_id'         => 'primary-menu',
		'container'       => false,
		'menu_class'      => 'flex items-center space-x-1',
		'fallback_cb'     => 'cpfauto_fallback_menu',
		'walker'          => new Cpfauto_Walker_Nav_Menu(),
		'depth'           => 2,
	));
	?>
</nav><!-- #site-navigation -->

<!-- Mobile Menu Overlay -->
<div id="mobile-menu" class="mobile-menu-overlay fixed inset-0 bg-white z-40 transform translate-x-full transition-transform duration-300 ease-in-out" data-mobile-menu>
	<div class="mobile-menu-content h-full overflow-y-auto pt-24 pb-8">
		<div class="container-custom">
			<?php
			wp_nav_menu(array(
				'theme_location'  => 'primary',
				'menu_id'         => 'mobile-primary-menu',
				'container'       => false,
				'menu_class'      => 'flex flex-col space-y-1',
				'fallback_cb'     => 'cpfauto_fallback_menu',
				'depth'           => 2,
				'walker'          => new Cpfauto_Mobile_Walker_Nav_Menu(),
			));
			?>

			<!-- Mobile CTA -->
			<?php
			$cta_text = get_theme_mod('cpfauto_header_cta_text', __('Schedule Test Drive', 'cpfauto'));
			$cta_link = get_theme_mod('cpfauto_header_cta_link', '#contact');
			if ($cta_text && $cta_link) {
				?>
				<div class="mt-8 pt-8 border-t border-gray-200">
					<a href="<?php echo esc_url($cta_link); ?>" class="btn-secondary w-full text-center block">
						<span class="cta-text-sm"><?php echo esc_html($cta_text); ?></span>
					</a>
				</div>
				<?php
			}

			// Mobile Contact Info
			$phone = get_theme_mod('cpfauto_header_phone', '');
			if ($phone) {
				?>
				<div class="mt-6 pt-6 border-t border-gray-200">
					<a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="flex items-center justify-center space-x-3 text-primary font-heading font-semibold text-lg py-3">
						<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
						</svg>
						<span><?php echo esc_html($phone); ?></span>
					</a>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
