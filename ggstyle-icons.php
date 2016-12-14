<?php
namespace ggi;

/*
Plugin Name: Ggstyle Icons
Plugin URI:  https://greengraphics.com.au
Description: A plugin to display a bunch of icons
Version:     0.0.1
Author:      Nathan
Author URI:  https://greengraphics.com.au
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: ggi
Domain Path: /languages
*/

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Ggi
{

    /**
     * function __construct()
     *
     * This function setups up the plugin.
     *
     * @package Ggstyle Icons
     * @since 0.0.1
     */
    public function __construct()
    {
        include_once('inc/helper-functions.php');

        // Styles
        add_action('wp_enqueue_scripts', array($this, 'registerStyles'));

        // Scripts

        // Shortcodes
        add_shortcode('icon', array($this, 'shortcodeIcon'));
    }


    /**
     * function shortcodeIcon()
     *
     * This function registers any styling we need.
     *
     * @package Ggstyle Icons
     * @since 0.0.1
     */
    public function registerStyles()
    {
        wp_enqueue_style('ggi-style', plugins_url('inc/css/main.css', __FILE__));
    }


    /**
     * function shortcodeIcon()
     *
     * This function handles the [icon] shortcode
     *
     * @package Ggstyle Icons
     * @since 0.0.1
     */
    public function shortcodeIcon($atts)
    {
        extract(shortcode_atts(array(
            'name'  => '',
            'link'  => '',
        ), $atts));

        $slug = str_replace(' ', '-', strtolower($name));

        // To do:
        // - Move output to seperate views folder
        $output = '';
        $output .= ($link ? "<a class='icon-link' href='$link' title='$name' target='_blank'>" : '');
        $output .= "<i class='icon icon-$slug'>";
        $output .= helper_functions\ggi_include(plugins_url("inc/icons/$slug.svg", __FILE__));
        $output .= "</i>";
        $output .= "<span class='icon-name'>$name</span>";
        $output .= ($link ? "</a>" : "");

        return $output;
    }
} // class Ggi

// Launch!
$ggi = new Ggi();
