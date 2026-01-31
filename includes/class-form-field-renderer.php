<?php
/**
 * Form Field Renderer
 * 
 * Handles rendering of icons in form fields using widget-level hooks
 */

if (!defined('ABSPATH')) {
    exit;
}

class MBR_EFI_Form_Field_Renderer {
    
    private static $instance = null;
    private $form_fields_with_icons = [];
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        // Use widget-level hooks instead of field-level hooks
        add_action('elementor/widget/render_content', [$this, 'inject_icons'], 10, 2);
        add_action('elementor/widget/before_render_content', [$this, 'capture_form_settings'], 10, 1);
        
        // Also add for editor preview
        add_action('elementor/preview/enqueue_styles', [$this, 'enqueue_preview_styles']);
    }
    
    /**
     * Enqueue styles for editor preview
     */
    public function enqueue_preview_styles() {
        wp_enqueue_style(
            'mbr-efi-fontawesome-preview',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
            [],
            '6.5.1'
        );
    }
    
    /**
     * Capture form settings before rendering
     */
    public function capture_form_settings($widget) {
        // Check if this is a form widget
        if ('form' !== $widget->get_name()) {
            return;
        }
        
        $settings = $widget->get_settings_for_display();
        
        if (empty($settings['form_fields'])) {
            return;
        }
        
        // Store fields that have icons enabled
        $this->form_fields_with_icons = [];
        
        foreach ($settings['form_fields'] as $field) {
            if (!empty($field['mbr_enable_icon']) && $field['mbr_enable_icon'] === 'yes' && !empty($field['mbr_selected_icon']['value'])) {
                // Handle color - Elementor automatically converts global colors to hex
                $icon_color = !empty($field['mbr_icon_color']) ? $field['mbr_icon_color'] : '#333333';
                
                $this->form_fields_with_icons[$field['custom_id']] = [
                    'icon_value' => $field['mbr_selected_icon']['value'],
                    'icon_library' => !empty($field['mbr_selected_icon']['library']) ? $field['mbr_selected_icon']['library'] : 'fa-solid',
                    'icon_position' => !empty($field['mbr_icon_position']) ? $field['mbr_icon_position'] : 'above',
                    'icon_color' => $icon_color,
                    'icon_size' => !empty($field['mbr_icon_size']['size']) ? intval($field['mbr_icon_size']['size']) : 16,
                ];
            }
        }
    }
    
    /**
     * Inject icons into the rendered form HTML
     */
    public function inject_icons($content, $widget) {
        // Check if this is a form widget
        if ('form' !== $widget->get_name()) {
            return $content;
        }
        
        // Check if we have any fields with icons
        if (empty($this->form_fields_with_icons)) {
            return $content;
        }
        
        // Add inline script and styles to handle icons
        $script = $this->generate_icon_script();
        
        return $content . $script;
    }
    
    /**
     * Generate JavaScript to add icons to fields
     */
    private function generate_icon_script() {
        if (empty($this->form_fields_with_icons)) {
            return '';
        }
        
        ob_start();
        ?>
        <script type="text/javascript">
        (function($) {
            
            function addIconsToForm() {
                // First, clean up any existing icons to prevent duplicates
                $('.mbr-efi-icon').remove();
                $('.mbr-efi-icon-above').remove();
                $('.mbr-efi-placeholder-icon').remove();
                
                // Reset any modified field styling
                $('.elementor-field').each(function() {
                    var $field = $(this);
                    if ($field.data('mbr-efi-placeholder-added')) {
                        $field.removeData('mbr-efi-placeholder-added');
                        $field.css('padding-left', ''); // Reset padding
                    }
                });
                
                <?php foreach ($this->form_fields_with_icons as $field_id => $icon_data): ?>
                    (function() {
                        var fieldId = '<?php echo esc_js($field_id); ?>';
                        var iconValue = '<?php echo esc_js($icon_data['icon_value']); ?>';
                        var iconPosition = '<?php echo esc_js($icon_data['icon_position']); ?>';
                        var iconColor = '<?php echo esc_js($icon_data['icon_color']); ?>';
                        var iconSize = '<?php echo esc_js($icon_data['icon_size']); ?>';
                        
                        // Create icon using Elementor's icon format
                        var $icon = $('<i>', {
                            'class': iconValue + ' mbr-efi-icon',
                            'aria-hidden': 'true'
                        }).css({
                            'color': iconColor,
                            'font-size': iconSize + 'px',
                            'display': 'inline-block'
                        });
                        
                        var iconHtml = $icon.prop('outerHTML');
                        
                        var $fieldGroup = $('.elementor-field-group-' + fieldId);
                        
                        if (!$fieldGroup.length) {
                            return;
                        }
                        
                        var $field = $fieldGroup.find('input, textarea, select').first();
                        
                        if (!$field.length) {
                            return;
                        }
                        
                        if (iconPosition === 'above') {
                            var $label = $fieldGroup.find('.elementor-field-label');
                            
                            if ($label.length) {
                                // Check if icon already exists in label
                                if (!$label.find('.mbr-efi-icon').length) {
                                    // Place icon before (to the left of) the label text
                                    $label.prepend(iconHtml + ' ');
                                }
                            } else {
                                // No label, place above the field
                                if (!$fieldGroup.find('.mbr-efi-icon-above').length) {
                                    $field.before('<div class="mbr-efi-icon-above" style="margin-bottom: 8px; display: block;">' + iconHtml + '</div>');
                                }
                            }
                        } else if (iconPosition === 'placeholder') {
                            // Only update if not already done
                            if (!$field.data('mbr-efi-placeholder-added')) {
                                var currentPlaceholder = $field.attr('placeholder') || '';
                                
                                // Don't modify the placeholder text at all - keep it as-is
                                // Add an absolutely positioned icon element within the field group (not wrapping the field)
                                
                                if (!$fieldGroup.find('.mbr-efi-placeholder-icon').length) {
                                    // Create icon element
                                    var $iconElement = $(iconHtml).addClass('mbr-efi-placeholder-icon');
                                    
                                    // Make the field group position relative if not already
                                    if ($fieldGroup.css('position') === 'static') {
                                        $fieldGroup.css('position', 'relative');
                                    }
                                    
                                    // Add icon directly to field group (not wrapping anything)
                                    $fieldGroup.append($iconElement);
                                    
                                    // Calculate proper top position based on label and field type
                                    var $label = $fieldGroup.find('.elementor-field-label');
                                    var labelHeight = $label.length ? $label.outerHeight(true) : 0;
                                    var fieldHeight = $field.outerHeight();
                                    var isTextarea = $field.is('textarea');
                                    
                                    // Position icon - centered for inputs, top for textareas
                                    if (isTextarea) {
                                        $iconElement.css({
                                            'position': 'absolute',
                                            'left': '12px',
                                            'top': (labelHeight + 15) + 'px', // 15px from top of textarea
                                            'pointer-events': 'none',
                                            'z-index': '1',
                                            'line-height': '1'
                                        });
                                    } else {
                                        $iconElement.css({
                                            'position': 'absolute',
                                            'left': '12px',
                                            'top': labelHeight + (fieldHeight / 2) + 'px',
                                            'transform': 'translateY(-50%)',
                                            'pointer-events': 'none',
                                            'z-index': '1',
                                            'line-height': '1'
                                        });
                                    }
                                    
                                    // Add padding to field so placeholder text doesn't overlap icon
                                    var iconWidth = parseInt(iconSize) || 16;
                                    var paddingLeft = iconWidth + 24; // icon size + spacing
                                    $field.css('padding-left', paddingLeft + 'px');
                                    
                                    // Hide icon when field has value or is focused with value
                                    $field.on('input change focus', function() {
                                        if ($(this).val()) {
                                            $iconElement.hide();
                                        } else {
                                            $iconElement.show();
                                        }
                                    });
                                    
                                    // Show icon when field loses focus and is empty
                                    $field.on('blur', function() {
                                        if (!$(this).val()) {
                                            $iconElement.show();
                                        }
                                    });
                                    
                                    // Check initial value
                                    if ($field.val()) {
                                        $iconElement.hide();
                                    }
                                }
                                
                                // Mark as added
                                $field.data('mbr-efi-placeholder-added', true);
                            }
                        }
                    })();
                <?php endforeach; ?>
            }
            
            // Try multiple times to ensure DOM is ready
            $(document).ready(function() {
                addIconsToForm();
                
                // Try again after a short delay for AJAX-loaded forms
                setTimeout(addIconsToForm, 500);
                setTimeout(addIconsToForm, 1000);
            });
            
            // Also try when Elementor frontend is ready
            $(window).on('elementor/frontend/init', function() {
                setTimeout(addIconsToForm, 100);
                
                // For editor: listen to widget updates
                if (typeof elementorFrontend !== 'undefined') {
                    elementorFrontend.hooks.addAction('frontend/element_ready/form.default', function($scope) {
                        setTimeout(function() {
                            addIconsToForm();
                        }, 100);
                    });
                }
            });
            
            // Listen for refresh trigger from editor
            $(document).on('mbr-efi-refresh', '.elementor-widget-form', function() {
                setTimeout(addIconsToForm, 100);
            });
            
            // For Elementor editor - watch for DOM changes
            $(document).on('DOMNodeInserted', '.elementor-widget-form', function() {
                setTimeout(addIconsToForm, 200);
            });
            
        })(jQuery);
        </script>
        <?php
        
        return ob_get_clean();
    }
}
