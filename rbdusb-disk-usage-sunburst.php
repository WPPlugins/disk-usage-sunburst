<?php
/**
 * Plugin Name: Disk Usage Sunburst
 * Plugin URI:  http://raidboxes.de/rbdusb-disk-usage-sunburst/
 * Description: Visualizes the size of all directories in your WordPress installation.
 * Author:      RAIDBOXES.de
 * Author URI:  https://raidboxes.de
 * Version:     1.0.4
 * License:     GPL2
 * Network:     true
 */

defined('ABSPATH') or die();

$RBDUSB_ABSPATH = ABSPATH;

add_action('admin_menu', function() {
    add_submenu_page('tools.php', 'Disk Usage', 'Disk Usage', 'administrator', __FILE__, 'rbdusb_action');
});
add_action('admin_enqueue_scripts', function() {
    wp_register_script('rbdusb_d3', plugins_url('/js/d3.v3.min.js', __FILE__));
    wp_enqueue_script('rbdusb_d3');
});
add_action('wp_ajax_rbdusb_data', function() {
    global $RBDUSB_ABSPATH;
    include(dirname(__FILE__).'/views/ajax.php');
    wp_die();
});
function rbdusb_action() {
    global $RBDUSB_ABSPATH;
    include(dirname(__FILE__).'/views/index.php');
}
