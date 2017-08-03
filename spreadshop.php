<?php
/*
Plugin Name: SpreadShop
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: This plugin intecrates a Spreadshirt Shop into Wordpress.
Version: 1.0
Author: Robert Schulz
Author URI:http://rschulz.me/t-shirt-shop
License: GPL2
*/
include "spreadshop_options.php";
add_action('admin_menu', 'spreadshop_admin_menu');
add_action( 'update_option_spreadshopID', 'init_spreadshop');
add_action('admin_init','register_spreadshop_settings');
add_action( 'activated_plugin', 'spreadshop_activation_redirect' );
add_filter( 'wp_nav_menu_items', 'spreadshop_nav_menu_items' );
add_filter( 'template_include', 'spreadshop_page_template',99 );
register_deactivation_hook( __FILE__, 'spreadshop_deactivate' );


function spreadshop_nav_menu_items($items) {
    $homelink = '<li class="home"><a href="'.get_site_url().'/'.get_option('spreadshopSlug').'">' . __('Shop') . '</a></li>';
    $items = $homelink . $items;
    return $items;
}

function register_spreadshop_settings(){
    register_setting( 'spreadshop-settings-group', 'spreadshopID' );
    register_setting( 'spreadshop-settings-group', 'spreadshopPlatform');
    register_setting( 'spreadshop-settings-group', 'spreadshopInitialized' );
    register_setting( 'spreadshop-settings-group', 'spreadshopSlug');
    register_setting( 'spreadshop-settings-group', 'spreadshopOffsetTop');
    add_option('spreadshopID','undefined');
}

function spreadshop_change_title($title) {
    if (is_404()) {
        return 'T-Shirt-Shop';
    }
    return $title;
}

function spreadshop_page_template($template){
    if(strpos($_SERVER["REQUEST_URI"], get_option('spreadshopSlug'))){
        wp_register_script( 'spreadshop_config', plugins_url('js/spreadshop_config.js', __FILE__));
        $config_array = array(
            'spreadshopID' => get_option('spreadshopID'),
            'spreadshopTLD' =>get_option('spreadshopTLD')
        );
        wp_localize_script( 'spreadshop_config', 'spreadshop_config_data', $config_array );
        status_header(200);
        add_filter('pre_get_document_title', 'spreadshop_change_title');
        wp_enqueue_script( 'spreadshop_config' );
        wp_enqueue_script( 'spreadshop_js_sources', esc_url_raw( '//shop.spreadshirt.de/shopfiles/shopclient/shopclient.nocache.js' ));
        $plugin_path = plugin_dir_path( __FILE__ );
        $template_name = 'spreadshop-page-template.php';
        return $plugin_path . $template_name;
    }
    return $template;
}

function spreadshop_admin_menu(){
    add_menu_page("SpreadShop", "SpreadShop", "manage_options", "SpreadShop", "spreadshop_options","dashicons-cart",99);

}

function spreadshop_activation_redirect() {
    exit( wp_redirect( admin_url( 'options-general.php?page=SpreadShop' ) ) );
}

function spreadshop_deactivate() {
    delete_option('spreadshopID');
    delete_option('spreadshopPlatform');
    delete_option('spreadshopInitialized');
    delete_option('spreadshopSlug');
    delete_option('spreadshopOffsetTop');
}

function init_spreadshop() {
    if($_REQUEST['spreadshopPlatform']=='EU' ||$_REQUEST['spreadshopPlatform']=='') {
        $shop_TLD='net';
    }
    else{
        $shop_TLD='com';
    }
    add_option("spreadshopTLD",$shop_TLD);
    wp_redirect(admin_url( 'admin.php?page=SpreadShop'));
}