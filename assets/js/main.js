/**
 * Main JavaScript file
 *
 * @package Cpfauto
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // Initialize any jQuery-dependent functionality here
        
        // Example: Smooth scroll for anchor links (fallback if GSAP not available)
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 600);
            }
        });
    });

})(jQuery);
