/**
 * Vehicle Card Hover Animations with GSAP
 *
 * @package Cpfauto
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const vehicleCards = document.querySelectorAll('[data-vehicle-card]');
        
        if (vehicleCards.length === 0) {
            return;
        }

        // Check for reduced motion preference
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
        
        if (prefersReducedMotion.matches) {
            return;
        }

        vehicleCards.forEach(function(card) {
            const image = card.querySelector('.vehicle-image');
            const overlay = card.querySelector('.vehicle-overlay');
            const overlayContent = card.querySelector('.vehicle-overlay-content');
            
            if (!card || !image) {
                return;
            }

            // Set initial states
            if (typeof gsap !== 'undefined') {
                gsap.set(card, { y: 0 });
                gsap.set(image, { scale: 1 });
                if (overlay) {
                    gsap.set(overlay, { opacity: 0 });
                }
                if (overlayContent) {
                    gsap.set(overlayContent, { y: 20 });
                }
            }

            // Hover enter animation
            card.addEventListener('mouseenter', function() {
                if (typeof gsap !== 'undefined') {
                    // Lift card
                    gsap.to(card, {
                        y: -8,
                        duration: 0.4,
                        ease: 'power2.out'
                    });

                    // Scale image
                    gsap.to(image, {
                        scale: 1.1,
                        duration: 0.6,
                        ease: 'power2.out'
                    });

                    // Show overlay
                    if (overlay) {
                        gsap.to(overlay, {
                            opacity: 1,
                            duration: 0.3,
                            ease: 'power2.out'
                        });
                    }

                    // Animate overlay content
                    if (overlayContent) {
                        gsap.to(overlayContent, {
                            y: 0,
                            duration: 0.4,
                            ease: 'power2.out',
                            delay: 0.1
                        });
                    }
                } else {
                    // Fallback without GSAP
                    card.style.transform = 'translateY(-8px)';
                    image.style.transform = 'scale(1.1)';
                    if (overlay) {
                        overlay.style.opacity = '1';
                    }
                }
            });

            // Hover leave animation
            card.addEventListener('mouseleave', function() {
                if (typeof gsap !== 'undefined') {
                    // Reset card position
                    gsap.to(card, {
                        y: 0,
                        duration: 0.4,
                        ease: 'power2.out'
                    });

                    // Reset image scale
                    gsap.to(image, {
                        scale: 1,
                        duration: 0.6,
                        ease: 'power2.out'
                    });

                    // Hide overlay
                    if (overlay) {
                        gsap.to(overlay, {
                            opacity: 0,
                            duration: 0.3,
                            ease: 'power2.out'
                        });
                    }

                    // Reset overlay content
                    if (overlayContent) {
                        gsap.to(overlayContent, {
                            y: 20,
                            duration: 0.3,
                            ease: 'power2.out'
                        });
                    }
                } else {
                    // Fallback without GSAP
                    card.style.transform = '';
                    image.style.transform = '';
                    if (overlay) {
                        overlay.style.opacity = '0';
                    }
                }
            });
        });
    });
})();
