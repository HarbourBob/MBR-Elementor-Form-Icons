<?php
/**
 * Form Field Controls
 * 
 * Adds custom controls to Elementor Pro form fields
 */

if (!defined('ABSPATH')) {
    exit;
}

class MBR_EFI_Form_Field_Controls {
    
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        // Hook into Elementor Pro form field registration
        add_action('elementor/element/form/section_form_fields/before_section_end', [$this, 'add_icon_controls'], 10, 2);
    }
    
    /**
     * Add icon controls to form fields
     */
    public function add_icon_controls($element, $args) {
        // Get the form fields repeater
        $form_fields = $element->get_controls('form_fields');
        
        if (!$form_fields) {
            return;
        }
        
        // Add icon controls to each field type
        $form_fields['fields']['mbr_enable_icon'] = [
            'name' => 'mbr_enable_icon',
            'label' => esc_html__('Enable Icon', 'mbr-elementor-form-icons'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Yes', 'mbr-elementor-form-icons'),
            'label_off' => esc_html__('No', 'mbr-elementor-form-icons'),
            'return_value' => 'yes',
            'default' => '',
            'separator' => 'before',
            'inner_tab' => 'form_fields_content_tab',
            'tab' => 'content',
            'tabs_wrapper' => 'form_fields_tabs',
        ];
        
        $form_fields['fields']['mbr_selected_icon'] = [
            'name' => 'mbr_selected_icon',
            'label' => esc_html__('Choose Icon', 'mbr-elementor-form-icons'),
            'type' => \Elementor\Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-user',
                'library' => 'fa-solid',
            ],
            'condition' => [
                'mbr_enable_icon' => 'yes',
            ],
            'inner_tab' => 'form_fields_content_tab',
            'tab' => 'content',
            'tabs_wrapper' => 'form_fields_tabs',
        ];
        
        $form_fields['fields']['mbr_icon_position'] = [
            'name' => 'mbr_icon_position',
            'label' => esc_html__('Icon Position', 'mbr-elementor-form-icons'),
            'type' => \Elementor\Controls_Manager::SELECT,
            'options' => [
                'above' => esc_html__('Above Field', 'mbr-elementor-form-icons'),
                'placeholder' => esc_html__('In Placeholder', 'mbr-elementor-form-icons'),
            ],
            'default' => 'above',
            'condition' => [
                'mbr_enable_icon' => 'yes',
            ],
            'inner_tab' => 'form_fields_content_tab',
            'tab' => 'content',
            'tabs_wrapper' => 'form_fields_tabs',
        ];
        
        $form_fields['fields']['mbr_icon_color'] = [
            'name' => 'mbr_icon_color',
            'label' => esc_html__('Icon Color', 'mbr-elementor-form-icons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '#333333',
            'condition' => [
                'mbr_enable_icon' => 'yes',
            ],
            'selectors' => [
                '{{WRAPPER}} .mbr-efi-icon-{{mbr_icon_class}}' => 'color: {{VALUE}};',
            ],
            'inner_tab' => 'form_fields_content_tab',
            'tab' => 'content',
            'tabs_wrapper' => 'form_fields_tabs',
        ];
        
        $form_fields['fields']['mbr_icon_size'] = [
            'name' => 'mbr_icon_size',
            'label' => esc_html__('Icon Size', 'mbr-elementor-form-icons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 50,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 16,
            ],
            'condition' => [
                'mbr_enable_icon' => 'yes',
            ],
            'selectors' => [
                '{{WRAPPER}} .mbr-efi-icon-{{mbr_icon_class}}' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
            'inner_tab' => 'form_fields_content_tab',
            'tab' => 'content',
            'tabs_wrapper' => 'form_fields_tabs',
        ];
        
        // Add helpful note about preview
        $form_fields['fields']['mbr_icon_note'] = [
            'name' => 'mbr_icon_note',
            'type' => \Elementor\Controls_Manager::RAW_HTML,
            'raw' => '<div style="padding: 12px; background: #f0f0f1; border-left: 4px solid #2271b1; margin: 10px 0; font-size: 13px; line-height: 1.5; color: #000;"><strong>ℹ️ Note:</strong> Icon changes can only be seen in Preview mode or on the Frontend. Click the "Preview" button to see your icons.</div>',
            'condition' => [
                'mbr_enable_icon' => 'yes',
            ],
            'inner_tab' => 'form_fields_content_tab',
            'tab' => 'content',
            'tabs_wrapper' => 'form_fields_tabs',
        ];
        
        // Update the repeater with new fields
        $element->update_control('form_fields', $form_fields);
    }
}
