<?php
/**
 * The site footer template - Professional Design
 *
 * @package Cpfauto
 */
?>

<footer id="colophon" class="site-footer bg-primary-900 text-white relative overflow-hidden">
	<!-- Background Pattern -->
	<div class="absolute inset-0 opacity-5">
		<div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 40px 40px;"></div>
	</div>

	<!-- Main Footer Content -->
	<div class="footer-main relative z-10 section-padding">
		<div class="container-custom">
			<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
				
				<!-- Column 1: Logo + Tagline + Social Icons -->
				<div class="footer-column footer-brand animate-fade-in">
					<?php if (has_custom_logo()) : ?>
						<?php
						$logo_id = get_theme_mod('custom_logo');
						$logo = wp_get_attachment_image_src($logo_id, 'full');
						if ($logo) {
							?>
							<a href="<?php echo esc_url(home_url('/')); ?>" class="block mb-4" rel="home">
								<img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="h-12 w-auto filter brightness-0 invert">
							</a>
							<?php
						}
						?>
					<?php else : ?>
						<h3 class="text-2xl font-heading font-bold mb-4">
							<a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-accent transition-colors" rel="home">
								<?php bloginfo('name'); ?>
							</a>
						</h3>
					<?php endif; ?>
					
					<?php
					$tagline = get_bloginfo('description', 'display');
					if ($tagline) {
						?>
						<p class="text-gray-400 mb-6 text-sm leading-relaxed">
							<?php echo esc_html($tagline); ?>
						</p>
						<?php
					}
					?>
					
					<!-- Social Icons -->
					<div class="footer-social">
						<h4 class="text-sm font-semibold text-white mb-3 uppercase tracking-wide">
							<?php esc_html_e('Follow Us', 'cpfauto'); ?>
						</h4>
						<div class="flex items-center space-x-4">
							<?php
							$social_icons = array(
								'facebook' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
								'twitter' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>',
								'instagram' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM12 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>',
								'linkedin' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
								'youtube' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
							);
							
							$social_networks = array('facebook', 'twitter', 'instagram', 'linkedin', 'youtube');
							foreach ($social_networks as $network) {
								$url = get_theme_mod('cpfauto_social_' . $network);
								if ($url && isset($social_icons[$network])) {
									?>
									<a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer" class="footer-social-link text-gray-400 hover:text-accent transition-all duration-300 hover:scale-110" aria-label="<?php echo esc_attr(ucfirst($network)); ?>">
										<?php echo $social_icons[$network]; ?>
									</a>
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>

				<!-- Column 2: Quick Links -->
				<div class="footer-column footer-links animate-fade-in" style="animation-delay: 0.1s;">
					<h4 class="footer-title text-lg font-heading font-semibold mb-6 text-white">
						<?php esc_html_e('Quick Links', 'cpfauto'); ?>
					</h4>
					<?php
					wp_nav_menu(array(
						'theme_location'  => 'footer',
						'container'       => false,
						'menu_class'      => 'footer-menu space-y-3',
						'fallback_cb'     => 'cpfauto_footer_fallback_menu',
						'depth'           => 1,
					));
					?>
				</div>

				<!-- Column 3: Contact Information -->
				<div class="footer-column footer-contact animate-fade-in" style="animation-delay: 0.2s;">
					<h4 class="footer-title text-lg font-heading font-semibold mb-6 text-white">
						<?php esc_html_e('Contact Us', 'cpfauto'); ?>
					</h4>
					<div class="space-y-4">
						<?php
						$address = get_theme_mod('cpfauto_footer_address', '');
						$phone = get_theme_mod('cpfauto_header_phone', '');
						$email = get_theme_mod('cpfauto_header_email', '');
						?>
						
						<?php if ($address) : ?>
							<div class="flex items-start">
								<svg class="w-5 h-5 mr-3 text-accent flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
								</svg>
								<p class="text-gray-400 text-sm leading-relaxed">
									<?php echo esc_html($address); ?>
								</p>
							</div>
						<?php endif; ?>
						
						<?php if ($phone) : ?>
							<div class="flex items-center">
								<svg class="w-5 h-5 mr-3 text-accent flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
								</svg>
								<a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>" class="text-gray-400 hover:text-accent transition-colors text-sm">
									<?php echo esc_html($phone); ?>
								</a>
							</div>
						<?php endif; ?>
						
						<?php if ($email) : ?>
							<div class="flex items-center">
								<svg class="w-5 h-5 mr-3 text-accent flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
								</svg>
								<a href="mailto:<?php echo esc_attr($email); ?>" class="text-gray-400 hover:text-accent transition-colors text-sm">
									<?php echo esc_html($email); ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Column 4: Newsletter Signup -->
				<div class="footer-column footer-newsletter animate-fade-in" style="animation-delay: 0.3s;">
					<h4 class="footer-title text-lg font-heading font-semibold mb-6 text-white">
						<?php esc_html_e('Newsletter', 'cpfauto'); ?>
					</h4>
					<p class="text-gray-400 text-sm mb-4">
						<?php esc_html_e('Subscribe to get updates on new vehicles and special offers.', 'cpfauto'); ?>
					</p>
					
					<?php
					// Display newsletter messages
					if (isset($_GET['newsletter'])) {
						if ($_GET['newsletter'] === 'success') {
							?>
							<div class="mb-4 p-3 bg-green-500/20 border border-green-500/50 rounded-lg text-green-400 text-sm">
								<?php esc_html_e('Thank you for subscribing!', 'cpfauto'); ?>
							</div>
							<?php
						} elseif ($_GET['newsletter'] === 'invalid') {
							?>
							<div class="mb-4 p-3 bg-red-500/20 border border-red-500/50 rounded-lg text-red-400 text-sm">
								<?php esc_html_e('Please enter a valid email address.', 'cpfauto'); ?>
							</div>
							<?php
						}
					}
					?>
					
					<form class="footer-newsletter-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
						<?php wp_nonce_field('cpfauto_newsletter_subscribe', 'cpfauto_newsletter_nonce'); ?>
						<input type="hidden" name="action" value="cpfauto_newsletter_subscribe">
						<div class="flex flex-col sm:flex-row gap-2">
							<input 
								type="email" 
								name="newsletter_email" 
								placeholder="<?php esc_attr_e('Your email address', 'cpfauto'); ?>"
								required
								class="flex-1 px-4 py-3 rounded-lg bg-primary-800 border border-primary-700 text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-accent focus:border-transparent transition-all"
							>
							<button 
								type="submit" 
								class="btn-secondary px-6 py-3 whitespace-nowrap"
							>
								<?php esc_html_e('Subscribe', 'cpfauto'); ?>
							</button>
						</div>
						<p class="text-xs text-gray-500 mt-2">
							<?php esc_html_e('We respect your privacy. Unsubscribe at any time.', 'cpfauto'); ?>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Bottom Bar -->
	<div class="footer-bottom border-t border-primary-800 relative z-10">
		<div class="container-custom py-6">
			<div class="flex flex-col md:flex-row justify-between items-center gap-4">
				<!-- Copyright -->
				<div class="footer-copyright text-sm text-gray-400">
					<?php
					$footer_text = get_theme_mod('cpfauto_footer_text', '© ' . date('Y') . ' ' . get_bloginfo('name') . '. All rights reserved.');
					echo esc_html($footer_text);
					?>
				</div>

				<!-- Legal Links -->
				<div class="footer-legal flex items-center space-x-6 text-sm">
					<?php
					$privacy_page = get_privacy_policy_url();
					if ($privacy_page) {
						?>
						<a href="<?php echo esc_url($privacy_page); ?>" class="text-gray-400 hover:text-accent transition-colors">
							<?php esc_html_e('Privacy Policy', 'cpfauto'); ?>
						</a>
						<?php
					}
					
					$terms_page = get_theme_mod('cpfauto_terms_page', '');
					if ($terms_page) {
						?>
						<a href="<?php echo esc_url($terms_page); ?>" class="text-gray-400 hover:text-accent transition-colors">
							<?php esc_html_e('Terms of Service', 'cpfauto'); ?>
						</a>
						<?php
					}
					?>
				</div>

				<!-- Back to Top Button -->
				<button 
					id="back-to-top" 
					class="back-to-top-btn bg-accent text-primary-900 p-3 rounded-full hover:bg-accent-400 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-110"
					aria-label="<?php esc_attr_e('Back to top', 'cpfauto'); ?>"
					style="display: none;"
				>
					<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
					</svg>
				</button>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->
