/**
 * Testimonials Carousel Functionality
 *
 * @package Cpfauto
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.querySelector('[data-testimonials-carousel]');
        const dots = document.querySelectorAll('.carousel-dot');
        
        if (!carousel || dots.length === 0) {
            return;
        }

        let currentSlide = 0;
        const slides = carousel.querySelectorAll('.testimonial-card');
        const totalSlides = slides.length;
        
        if (totalSlides === 0) {
            return;
        }

        // Calculate slide width
        function getSlideWidth() {
            if (window.innerWidth >= 1024) {
                return carousel.offsetWidth / 3; // 3 columns on desktop
            } else if (window.innerWidth >= 768) {
                return carousel.offsetWidth / 2; // 2 columns on tablet
            } else {
                return carousel.offsetWidth; // 1 column on mobile
            }
        }

        // Update active dot
        function updateDots(index) {
            dots.forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('active', 'bg-primary-600', 'w-8');
                    dot.classList.remove('bg-gray-300', 'w-2');
                } else {
                    dot.classList.remove('active', 'bg-primary-600', 'w-8');
                    dot.classList.add('bg-gray-300', 'w-2');
                }
            });
        }

        // Scroll to slide
        function scrollToSlide(index) {
            if (index < 0 || index >= totalSlides) {
                return;
            }
            
            currentSlide = index;
            const slideWidth = getSlideWidth();
            const scrollPosition = slideWidth * index;
            
            if (typeof gsap !== 'undefined') {
                gsap.to(carousel, {
                    scrollLeft: scrollPosition,
                    duration: 0.5,
                    ease: 'power2.out'
                });
            } else {
                carousel.scrollTo({
                    left: scrollPosition,
                    behavior: 'smooth'
                });
            }
            
            updateDots(index);
        }

        // Dot click handlers
        dots.forEach((dot, index) => {
            dot.addEventListener('click', function() {
                scrollToSlide(index);
            });
        });

        // Auto-scroll carousel (optional)
        let autoScrollInterval;
        
        function startAutoScroll() {
            autoScrollInterval = setInterval(function() {
                const nextSlide = (currentSlide + 1) % totalSlides;
                scrollToSlide(nextSlide);
            }, 5000); // Change slide every 5 seconds
        }

        function stopAutoScroll() {
            if (autoScrollInterval) {
                clearInterval(autoScrollInterval);
            }
        }

        // Pause on hover
        carousel.addEventListener('mouseenter', stopAutoScroll);
        carousel.addEventListener('mouseleave', startAutoScroll);

        // Handle scroll events to update active dot
        let scrollTimer;
        carousel.addEventListener('scroll', function() {
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(function() {
                const slideWidth = getSlideWidth();
                const scrollIndex = Math.round(carousel.scrollLeft / slideWidth);
                if (scrollIndex !== currentSlide) {
                    currentSlide = scrollIndex;
                    updateDots(scrollIndex);
                }
            }, 100);
        }, { passive: true });

        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                scrollToSlide(currentSlide);
            }, 250);
        });

        // Initialize
        updateDots(0);
        startAutoScroll();
    });
})();
