/**
 * GSAP Animation System for Cpfauto
 * 
 * Features:
 * - Page load animations (Hero, Header)
 * - Scroll-triggered fade-in animations
 * - Respects prefers-reduced-motion
 * 
 * @package Cpfauto
 */

(function() {
    'use strict';
    
    // Check if GSAP is loaded
    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        console.warn('GSAP or ScrollTrigger not loaded. Animations disabled.');
        return;
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        
        // Register GSAP plugins
        gsap.registerPlugin(ScrollTrigger);
        
        // Check for reduced motion preference
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
        
        // ===========================
        // 1. PAGE LOAD ANIMATIONS
        // ===========================
        
        /**
         * Header Animation on Page Load
         * Animates the header sliding down from the top
         */
        function initHeaderAnimation() {
            if (prefersReducedMotion.matches) {
                return;
            }
            
            const header = document.querySelector('.site-header');
            if (!header) {
                return;
            }
            
            gsap.from(header, {
                y: -100,
                opacity: 0,
                duration: 0.8,
                ease: 'power2.out',
            });
        }
        
        /**
         * Hero Section Animation
         * Animates hero elements on page load with premium effects
         */
        function initHeroAnimation() {
            if (prefersReducedMotion.matches) {
                return;
            }
            
            const heroSection = document.querySelector('.hero-section');
            if (!heroSection) {
                return;
            }
            
            const heroTimeline = gsap.timeline({
                defaults: { ease: 'power3.out' }
            });
            
            // Set initial states
            gsap.set('.hero-title', { y: 80, opacity: 0 });
            gsap.set('.hero-subtitle', { y: 40, opacity: 0 });
            gsap.set('.hero-cta', { y: 30, opacity: 0, scale: 0.9 });
            gsap.set('.hero-search', { y: 50, opacity: 0 });
            gsap.set('.hero-background', { scale: 1.1 });
            
            // Animate hero title - fade in with slide up
            heroTimeline.to('.hero-title', {
                y: 0,
                opacity: 1,
                duration: 1,
                ease: 'power3.out'
            });
            
            // Animate hero subtitle - slide up
            heroTimeline.to('.hero-subtitle', {
                y: 0,
                opacity: 1,
                duration: 0.8,
                ease: 'power2.out'
            }, '-=0.6');
            
            // Animate hero CTA buttons - stagger animation
            heroTimeline.to('.hero-cta', {
                y: 0,
                opacity: 1,
                scale: 1,
                duration: 0.6,
                stagger: 0.15,
                ease: 'back.out(1.2)'
            }, '-=0.4');
            
            // Animate search form - fade in
            heroTimeline.to('.hero-search', {
                y: 0,
                opacity: 1,
                duration: 0.8,
                ease: 'power2.out'
            }, '-=0.3');
            
            // Background zoom effect
            heroTimeline.to('.hero-background', {
                scale: 1,
                duration: 1.5,
                ease: 'power1.out'
            }, 0);
        }
        
        /**
         * Hero Parallax Effect
         * Creates parallax scrolling effect on hero background
         */
        function initHeroParallax() {
            if (prefersReducedMotion.matches) {
                return;
            }
            
            const heroSection = document.querySelector('.hero-section');
            const parallaxElement = document.querySelector('.hero-image.parallax');
            
            if (!heroSection || !parallaxElement) {
                return;
            }
            
            const speed = parseFloat(parallaxElement.dataset.speed) || 0.5;
            
            gsap.to(parallaxElement, {
                y: () => {
                    return (1 - speed) * ScrollTrigger.maxScroll(window);
                },
                ease: 'none',
                scrollTrigger: {
                    trigger: heroSection,
                    start: 'top top',
                    end: 'bottom top',
                    scrub: true,
                    invalidateOnRefresh: true
                }
            });
        }
        
        // ===========================
        // 2. SCROLL ANIMATIONS
        // ===========================
        
        /**
         * Fade In on Scroll
         * Usage: Add class "animate-fade-in" to any element you want to fade in on scroll
         * Example: <div class="animate-fade-in">Content here</div>
         */
        function initFadeInAnimations() {
            if (prefersReducedMotion.matches) {
                return;
            }
            
            const fadeElements = gsap.utils.toArray('.animate-fade-in');
            
            if (fadeElements.length === 0) {
                return;
            }
            
            fadeElements.forEach(element => {
                // Set initial state
                gsap.set(element, {
                    opacity: 0,
                    y: 30,
                });
                
                // Animate on scroll
                gsap.to(element, {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: element,
                        start: 'top 85%',
                        toggleActions: 'play none none none',
                        // markers: true, // Uncomment for debugging
                    }
                });
            });
        }
        
        /**
         * Stagger Animation for Grids/Lists
         * Usage: Add class "animate-stagger" to parent container
         */
        function initStaggerAnimations() {
            if (prefersReducedMotion.matches) {
                return;
            }
            
            const staggerContainers = gsap.utils.toArray('.animate-stagger');
            
            if (staggerContainers.length === 0) {
                return;
            }
            
            staggerContainers.forEach(container => {
                const children = container.children;
                
                if (children.length === 0) {
                    return;
                }
                
                // Set initial state
                gsap.set(children, {
                    opacity: 0,
                    y: 50,
                });
                
                // Animate on scroll
                gsap.to(children, {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    stagger: 0.1,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: container,
                        start: 'top 85%',
                        toggleActions: 'play none none none',
                    }
                });
            });
        }
        
        /**
         * Slide Left Animation
         * Usage: Add class "animate-slide-left" to any element
         */
        function initSlideLeftAnimations() {
            if (prefersReducedMotion.matches) {
                return;
            }
            
            const slideElements = gsap.utils.toArray('.animate-slide-left');
            
            slideElements.forEach(element => {
                gsap.set(element, {
                    x: -100,
                    opacity: 0,
                });
                
                gsap.to(element, {
                    x: 0,
                    opacity: 1,
                    duration: 0.8,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: element,
                        start: 'top 85%',
                        toggleActions: 'play none none none',
                    }
                });
            });
        }
        
        /**
         * Slide Right Animation
         * Usage: Add class "animate-slide-right" to any element
         */
        function initSlideRightAnimations() {
            if (prefersReducedMotion.matches) {
                return;
            }
            
            const slideElements = gsap.utils.toArray('.animate-slide-right');
            
            slideElements.forEach(element => {
                gsap.set(element, {
                    x: 100,
                    opacity: 0,
                });
                
                gsap.to(element, {
                    x: 0,
                    opacity: 1,
                    duration: 0.8,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: element,
                        start: 'top 85%',
                        toggleActions: 'play none none none',
                    }
                });
            });
        }
        
        /**
         * Counter Animation
         * Usage: Add class "counter" and data-target attribute
         * Example: <span class="counter" data-target="1000">0</span>
         */
        function initCounterAnimations() {
            if (prefersReducedMotion.matches) {
                return;
            }
            
            const counters = document.querySelectorAll('.counter');
            
            counters.forEach(counter => {
                const target = parseInt(counter.dataset.target) || 0;
                
                // Extract suffix from initial text (anything after numbers)
                const initialText = counter.textContent.trim();
                const suffixMatch = initialText.match(/[^0-9]+$/);
                const suffix = suffixMatch ? suffixMatch[0] : '';
                
                if (target === 0) {
                    return;
                }
                
                // Set initial value to 0
                counter.textContent = '0' + suffix;
                
                ScrollTrigger.create({
                    trigger: counter,
                    start: 'top 85%',
                    once: true,
                    onEnter: () => {
                        const obj = { value: 0 };
                        gsap.to(obj, {
                            value: target,
                            duration: 2,
                            ease: 'power1.out',
                            onUpdate: function() {
                                const value = Math.ceil(obj.value);
                                counter.textContent = value + suffix;
                            }
                        });
                    }
                });
            });
        }
        
        // ===========================
        // 3. INITIALIZE ALL ANIMATIONS
        // ===========================
        
        function init() {
            // Page load animations
            initHeaderAnimation();
            initHeroAnimation();
            
            // Scroll animations
            initFadeInAnimations();
            initStaggerAnimations();
            initSlideLeftAnimations();
            initSlideRightAnimations();
            initCounterAnimations();
            
            // Parallax effects
            initHeroParallax();
            
            // Refresh ScrollTrigger after everything is loaded
            ScrollTrigger.refresh();
        }
        
        // Initialize animations
        init();
        
        // Refresh ScrollTrigger on window resize
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                ScrollTrigger.refresh();
            }, 250);
        });
        
        // Listen for changes in reduced motion preference
        prefersReducedMotion.addEventListener('change', function() {
            if (prefersReducedMotion.matches) {
                // Kill all ScrollTriggers
                ScrollTrigger.getAll().forEach(trigger => trigger.kill());
                // Pause GSAP timeline
                gsap.globalTimeline.pause();
            } else {
                // Reinitialize animations if user enables motion
                init();
            }
        });
        
    });
    
})();
