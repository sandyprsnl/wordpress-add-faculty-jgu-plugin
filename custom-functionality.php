<?php
/*
/**
* @package booking
**/
/*
/*
Plugin Name: Custom functionality
Description: Add Custom CPT, Add Shortcode,add JGU faculty
Version: 1.0
Author:  Sandeep Bhardwaj
*/

defined('ABSPATH') or die();

require_once(wp_normalize_path(ABSPATH).'wp-load.php');



define('NECPATH',plugin_dir_path(__FILE__).'/');
define('NECURL',plugin_dir_url(__FILE__));
if(file_exists(NECPATH.'init.php')){
    require_once NECPATH.'init.php';
}
if(file_exists(NECPATH.'faculty-shortcode.php')){
    require_once NECPATH.'faculty-shortcode.php';
}
if(file_exists(NECPATH.'news-shortcode.php')){
    require_once NECPATH.'news-shortcode.php';
}
if(file_exists(NECPATH.'booking-ajax.php')){
    require_once NECPATH.'booking-ajax.php';
}
// register_activation_hook(__FILE__, 'bookingActivation');

function news_events_Activation(){
    Init::register();
}
news_events_Activation();