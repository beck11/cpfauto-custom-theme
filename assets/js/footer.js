/**
 * Footer Functionality - Back to Top Button with GSAP
 *
 * @package Cpfauto
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const backToTopBtn = document.getElementById('back-to-top');
        
        if (!backToTopBtn) {
            return;
        }

        // Check for reduced motion preference
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

        // Show/hide back to top button based on scroll position
        function toggleBackToTop() {
            const scrollY = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollY > 300) {
                if (typeof gsap !== 'undefined' && !prefersReducedMotion.matches) {
                    gsap.to(backToTopBtn, {
                        opacity: 1,
                        scale: 1,
                        duration: 0.3,
                        ease: 'power2.out',
                        display: 'block'
                    });
                } else {
                    backToTopBtn.style.display = 'block';
                    backToTopBtn.style.opacity = '1';
                }
            } else {
                if (typeof gsap !== 'undefined' && !prefersReducedMotion.matches) {
                    gsap.to(backToTopBtn, {
                        opacity: 0,
                        scale: 0.8,
                        duration: 0.3,
                        ease: 'power2.out',
                        onComplete: function() {
                            backToTopBtn.style.display = 'none';
                        }
                    });
                } else {
                    backToTopBtn.style.display = 'none';
                    backToTopBtn.style.opacity = '0';
                }
            }
        }

        // Initial check
        toggleBackToTop();

        // Listen to scroll events
        let scrollTimer;
        window.addEventListener('scroll', function() {
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(toggleBackToTop, 10);
        }, { passive: true });

        // Back to top functionality
        backToTopBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Use native smooth scroll (GSAP ScrollTo is premium plugin)
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Animate footer columns on scroll
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined' && !prefersReducedMotion.matches) {
            const footerColumns = document.querySelectorAll('.footer-column');
            
            footerColumns.forEach(function(column, index) {
                gsap.set(column, {
                    opacity: 0,
                    y: 30
                });
                
                ScrollTrigger.create({
                    trigger: column,
                    start: 'top 90%',
                    once: true,
                    onEnter: function() {
                        gsap.to(column, {
                            opacity: 1,
                            y: 0,
                            duration: 0.6,
                            delay: index * 0.1,
                            ease: 'power2.out'
                        });
                    }
                });
            });
        }
    });
})();
