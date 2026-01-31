<?php
/**
 * Plugin Name: MBR Elementor Form Icons
 * Plugin URI: https://littlewebshack.com
 * Description: Add Font Awesome icons to Elementor Pro form fields - in placeholders or above fields
 * Version: 1.2.1
 * Author: Robert Palmer
 * Author URI: https://littlewebshack.com
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: mbr-elementor-form-icons
 * Domain Path: /languages
 * Requires at least: 5.8
 * Requires PHP: 7.4
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Buy Me a Coffee
add_filter( 'plugin_row_meta', function ( $links, $file, $data ) {
    if ( ! function_exists( 'plugin_basename' ) || $file !== plugin_basename( __FILE__ ) ) {
        return $links;
    }

    $url = 'https://buymeacoffee.com/robertpalmer/';
    $links[] = sprintf(
	// translators: %s: The name of the plugin author.
        '<a href="%s" target="_blank" rel="noopener nofollow" aria-label="%s">☕ %s</a>',
        esc_url( $url ),
		// translators: %s: The name of the plugin author.
        esc_attr( sprintf( __( 'Buy %s a coffee', 'mbr-elementor-form-icons' ), isset( $data['AuthorName'] ) ? $data['AuthorName'] : __( 'the author', 'mbr-elementor-form-icons' ) ) ),
        esc_html__( 'Buy me a coffee', 'mbr-elementor-form-icons' )
    );

    return $links;
}, 10, 3 );


// Define plugin constants
define('MBR_EFI_VERSION', '1.0.0');
define('MBR_EFI_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MBR_EFI_PLUGIN_URL', plugin_dir_url(__FILE__));
define('MBR_EFI_PLUGIN_BASENAME', plugin_basename(__FILE__));

/**
 * Main Plugin Class
 */
class MBR_Elementor_Form_Icons {
    
    /**
     * Instance of this class
     */
    private static $instance = null;
    
    /**
     * Get instance
     */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * Constructor
     */
    private function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }
    
    /**
     * Initialize plugin
     */
    public function init() {
        // Check if Elementor is installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_elementor']);
            return;
        }
        
        // Check if Elementor Pro is installed and activated
        if (!function_exists('elementor_pro_load_plugin')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_elementor_pro']);
            return;
        }
        
        // Load plugin files
        $this->load_files();
        
        // Initialize components
        add_action('elementor/init', [$this, 'init_components']);
        
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_assets']);
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'enqueue_editor_assets']);
    }
    
    /**
     * Load plugin files
     */
    private function load_files() {
        require_once MBR_EFI_PLUGIN_DIR . 'includes/class-form-field-controls.php';
        require_once MBR_EFI_PLUGIN_DIR . 'includes/class-form-field-renderer.php';
    }
    
    /**
     * Initialize components
     */
    public function init_components() {
        MBR_EFI_Form_Field_Controls::get_instance();
        MBR_EFI_Form_Field_Renderer::get_instance();
    }
    
    /**
     * Enqueue frontend assets
     */
    public function enqueue_frontend_assets() {
        // Always enqueue Font Awesome
        wp_enqueue_style(
            'mbr-efi-fontawesome',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
            [],
            '6.5.1'
        );
        
        // Enqueue plugin styles
        wp_enqueue_style(
            'mbr-efi-styles',
            MBR_EFI_PLUGIN_URL . 'assets/css/form-icons.css',
            ['mbr-efi-fontawesome'],
            MBR_EFI_VERSION
        );
        
        // Enqueue jQuery (core dependency)
        wp_enqueue_script('jquery');
        
        // Enqueue plugin scripts
        wp_enqueue_script(
            'mbr-efi-scripts',
            MBR_EFI_PLUGIN_URL . 'assets/js/form-icons.js',
            ['jquery'],
            MBR_EFI_VERSION,
            true
        );
    }
    
    /**
     * Enqueue editor assets
     */
    public function enqueue_editor_assets() {
        // Enqueue Font Awesome in editor too
        wp_enqueue_style(
            'mbr-efi-fontawesome-editor',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
            [],
            '6.5.1'
        );
        
        wp_enqueue_style(
            'mbr-efi-editor-styles',
            MBR_EFI_PLUGIN_URL . 'assets/css/editor.css',
            [],
            MBR_EFI_VERSION
        );
        
        // Enqueue editor JavaScript
        wp_enqueue_script(
            'mbr-efi-editor-scripts',
            MBR_EFI_PLUGIN_URL . 'assets/js/editor.js',
            ['jquery', 'elementor-editor'],
            MBR_EFI_VERSION,
            true
        );
    }
    
    /**
     * Admin notice - Elementor not installed
     */
    public function admin_notice_missing_elementor() {
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'mbr-elementor-form-icons'),
            '<strong>' . esc_html__('MBR Elementor Form Icons', 'mbr-elementor-form-icons') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'mbr-elementor-form-icons') . '</strong>'
        );
        
        printf('<div class="notice notice-warning is-dismissible"><p>%s</p></div>', wp_kses_post($message));
    }
    
    /**
     * Admin notice - Elementor Pro not installed
     */
    public function admin_notice_missing_elementor_pro() {
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'mbr-elementor-form-icons'),
            '<strong>' . esc_html__('MBR Elementor Form Icons', 'mbr-elementor-form-icons') . '</strong>',
            '<strong>' . esc_html__('Elementor Pro', 'mbr-elementor-form-icons') . '</strong>'
        );
        
        printf('<div class="notice notice-warning is-dismissible"><p>%s</p></div>', wp_kses_post($message));
    }
}

// Initialize plugin
MBR_Elementor_Form_Icons::get_instance();
