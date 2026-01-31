/**
 * MBR Elementor Form Icons - Editor Scripts
 * Ensures Font Awesome is loaded and hides global colors button
 */

(function($) {
    'use strict';
    
    $(window).on('elementor:init', function() {
        
        // Function to hide global colors button
        function hideGlobalColorsButton() {
            // Find and remove the global colors button for mbr_icon_color
            $('.elementor-control-mbr_icon_color .elementor-control-dynamic-switcher').each(function() {
                $(this).remove(); // Completely remove it from DOM
            });
        }
        
        // Hide on panel open
        elementor.hooks.addAction('panel/open_editor/widget', function(panel, model, view) {
            setTimeout(hideGlobalColorsButton, 100);
            setTimeout(hideGlobalColorsButton, 500);
            setTimeout(hideGlobalColorsButton, 1000);
        });
        
        // Watch for DOM changes in the panel
        var observer = new MutationObserver(function(mutations) {
            hideGlobalColorsButton();
        });
        
        // Start observing the panel
        setTimeout(function() {
            var panelElement = document.querySelector('#elementor-panel-content-wrapper');
            if (panelElement) {
                observer.observe(panelElement, {
                    childList: true,
                    subtree: true
                });
            }
        }, 1000);
        
        // Also use jQuery event delegation
        $(document).on('DOMNodeInserted', '.elementor-control-mbr_icon_color', function() {
            setTimeout(hideGlobalColorsButton, 50);
        });
        
        // Run periodically
        setInterval(hideGlobalColorsButton, 2000);
        
        // Ensure Font Awesome is loaded in the preview iframe
        var fontAwesomeCheckInterval = setInterval(function() {
            var $iframe = $('#elementor-preview-iframe');
            if ($iframe.length) {
                var iframeDoc = $iframe.contents();
                if (!iframeDoc.find('link[href*="font-awesome"]').length) {
                    iframeDoc.find('head').append(
                        '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">'
                    );
                }
                clearInterval(fontAwesomeCheckInterval);
            }
        }, 500);
    });
    
})(jQuery);
