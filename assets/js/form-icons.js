/**
 * MBR Elementor Form Icons - Frontend Scripts
 * Version: 1.0.0
 */

(function($) {
    'use strict';
    
    /**
     * Form Icons Handler
     */
    var MBR_EFI_Handler = {
        
        /**
         * Initialize
         */
        init: function() {
            // Wait for Elementor frontend to be ready
            $(window).on('elementor/frontend/init', function() {
                MBR_EFI_Handler.initFormIcons();
            });
            
            // Fallback for non-Elementor pages
            $(document).ready(function() {
                setTimeout(function() {
                    MBR_EFI_Handler.initFormIcons();
                }, 100);
            });
        },
        
        /**
         * Initialize form icons
         */
        initFormIcons: function() {
            // Handle any additional initialization if needed
            // Most of the work is now done via inline scripts in PHP
            
            // Add placeholder icon styling
            $('.mbr-efi-has-placeholder-icon').each(function() {
                $(this).css('font-family', '"Font Awesome 6 Free", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif');
            });
        }
    };
    
    // Initialize
    MBR_EFI_Handler.init();
    
})(jQuery);
