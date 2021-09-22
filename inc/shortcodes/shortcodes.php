<?php
/**
 * Custom Customizer controls and options
 * 
 * @package WordPress
 * @subpackage GDI-Theme
 */
    
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

define('SHORTCODES_CLASS', 'GDI_Shortcodes');
define('SHORTCODES_DIR', THEME_INC_DIR . 'shortcodes/blocks/');

class GDI_Shortcodes {

    /**
     * Setup the shortcodes
     */
    public function __construct()
    {
        $dir = SHORTCODES_DIR;
        
        $codes = array(
            'gdi_empreendimentos',
            'blog_feed',
            'icon/medidas',
            'icon/habitacoes',
        );

        // Add shortcodes
        foreach($codes as $code) {
            $code_function = str_replace(['/','-'], '_', $code);
            if(file_exists($dir . $code . '.php')) {
                require_once($dir . $code . '.php');
                add_shortcode($code_function, $code_function);
            }
        }
    }
    
}

new GDI_Shortcodes();