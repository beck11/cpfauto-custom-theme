/**
 * Premium Navigation functionality with GSAP animations
 *
 * @package Cpfauto
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const header = document.querySelector('.site-header');
        const menuToggle = document.querySelector('[data-menu-toggle]');
        const mobileMenu = document.querySelector('[data-mobile-menu]');
        const hamburgerLines = document.querySelectorAll('.hamburger-line');
        const body = document.body;
        const isHomePage = document.body.classList.contains('home') || window.location.pathname === '/';
        
        if (!header || !menuToggle || !mobileMenu) {
            return;
        }

        // ===========================
        // HEADER SCROLL BEHAVIOR
        // ===========================
        
        let lastScroll = 0;
        let scrollThreshold = 50;
        
        function handleHeaderScroll() {
            const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
            
            // Add/remove scrolled class for styling
            if (currentScroll > scrollThreshold) {
                header.classList.add('header-scrolled');
                header.classList.remove('header-transparent');
            } else {
                header.classList.remove('header-scrolled');
                if (isHomePage) {
                    header.classList.add('header-transparent');
                }
            }
            
            lastScroll = currentScroll;
        }
        
        // Initial state
        if (isHomePage && window.pageYOffset < scrollThreshold) {
            header.classList.add('header-transparent');
        } else {
            header.classList.add('header-scrolled');
        }
        
        // Throttled scroll handler
        let scrollTimer;
        window.addEventListener('scroll', function() {
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(handleHeaderScroll, 10);
        }, { passive: true });
        
        // Initial check
        handleHeaderScroll();

        // ===========================
        // MOBILE MENU WITH GSAP
        // ===========================
        
        let menuOpen = false;
        let menuTimeline = null;
        
        function openMobileMenu() {
            if (menuOpen) return;
            menuOpen = true;
            
            menuToggle.setAttribute('aria-expanded', 'true');
            body.classList.add('overflow-hidden');
            
            // Show menu
            mobileMenu.classList.remove('hidden');
            
            // GSAP Animation
            if (typeof gsap !== 'undefined') {
                // Reset menu position
                gsap.set(mobileMenu, { x: '100%' });
                
                // Create timeline
                menuTimeline = gsap.timeline();
                
                // Slide in menu
                menuTimeline.to(mobileMenu, {
                    x: '0%',
                    duration: 0.4,
                    ease: 'power3.out'
                });
                
                // Animate menu items
                const menuItems = mobileMenu.querySelectorAll('#mobile-primary-menu > li');
                menuTimeline.from(menuItems, {
                    x: 50,
                    opacity: 0,
                    duration: 0.3,
                    stagger: 0.05,
                    ease: 'power2.out'
                }, '-=0.2');
                
                // Animate hamburger to X
                gsap.to(hamburgerLines[0], {
                    y: 8,
                    rotate: 45,
                    duration: 0.3,
                    ease: 'power2.out'
                });
                gsap.to(hamburgerLines[1], {
                    opacity: 0,
                    duration: 0.2,
                    ease: 'power2.out'
                });
                gsap.to(hamburgerLines[2], {
                    y: -8,
                    rotate: -45,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            } else {
                // Fallback without GSAP
                mobileMenu.classList.remove('translate-x-full');
                mobileMenu.classList.add('translate-x-0');
                hamburgerLines[0].style.transform = 'translateY(8px) rotate(45deg)';
                hamburgerLines[1].style.opacity = '0';
                hamburgerLines[2].style.transform = 'translateY(-8px) rotate(-45deg)';
            }
        }
        
        function closeMobileMenu() {
            if (!menuOpen) return;
            menuOpen = false;
            
            menuToggle.setAttribute('aria-expanded', 'false');
            body.classList.remove('overflow-hidden');
            
            if (typeof gsap !== 'undefined' && menuTimeline) {
                // Reverse animation
                menuTimeline.reverse();
                
                // Reset hamburger
                gsap.to(hamburgerLines, {
                    y: 0,
                    rotate: 0,
                    opacity: 1,
                    duration: 0.3,
                    ease: 'power2.out'
                });
                
                // Hide menu after animation
                setTimeout(function() {
                    if (!menuOpen) {
                        mobileMenu.classList.add('hidden');
                    }
                }, 400);
            } else {
                // Fallback without GSAP
                mobileMenu.classList.remove('translate-x-0');
                mobileMenu.classList.add('translate-x-full');
                hamburgerLines[0].style.transform = '';
                hamburgerLines[1].style.opacity = '1';
                hamburgerLines[2].style.transform = '';
                
                setTimeout(function() {
                    if (!menuOpen) {
                        mobileMenu.classList.add('hidden');
                    }
                }, 300);
            }
        }

        // Toggle mobile menu
        menuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            if (menuOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!menuToggle.contains(event.target) && !mobileMenu.contains(event.target)) {
                if (menuOpen) {
                    closeMobileMenu();
                }
            }
        });

        // Close menu when clicking on a link
        const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        mobileMenuLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                closeMobileMenu();
            });
        });

        // Close menu on window resize (if resizing to desktop)
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                if (window.innerWidth >= 1024 && menuOpen) {
                    closeMobileMenu();
                }
            }, 250);
        });

        // Handle submenu toggles on mobile
        const submenuToggles = mobileMenu.querySelectorAll('.menu-item-has-children > a');
        submenuToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function(e) {
                if (window.innerWidth < 1024) {
                    e.preventDefault();
                    const parent = toggle.parentElement;
                    const submenu = parent.querySelector('.submenu');
                    
                    if (submenu) {
                        const isOpen = !submenu.classList.contains('hidden');
                        
                        if (typeof gsap !== 'undefined') {
                            if (isOpen) {
                                gsap.to(submenu, {
                                    height: 0,
                                    opacity: 0,
                                    duration: 0.3,
                                    ease: 'power2.in',
                                    onComplete: function() {
                                        submenu.classList.add('hidden');
                                        parent.classList.remove('submenu-open');
                                    }
                                });
                            } else {
                                submenu.classList.remove('hidden');
                                parent.classList.add('submenu-open');
                                
                                gsap.from(submenu, {
                                    height: 0,
                                    opacity: 0,
                                    duration: 0.3,
                                    ease: 'power2.out'
                                });
                            }
                        } else {
                            parent.classList.toggle('submenu-open');
                            submenu.classList.toggle('hidden');
                        }
                    }
                }
            });
        });

        // ===========================
        // SMOOTH SCROLL FOR ANCHOR LINKS
        // ===========================
        
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        anchorLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                
                if (targetId === '#' || targetId === '#0') return;
                
                const target = document.querySelector(targetId);
                
                if (target) {
                    e.preventDefault();
                    
                    const headerHeight = header.offsetHeight;
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;
                    
                    // Use native smooth scroll (GSAP ScrollTo is premium plugin)
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    if (menuOpen) {
                        closeMobileMenu();
                    }
                }
            });
        });
    });
})();
