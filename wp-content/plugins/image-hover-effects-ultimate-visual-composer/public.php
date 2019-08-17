<?php

if (!defined('ABSPATH'))
    exit;

function oxilab_flip_box_shortcode_function($styleid, $userdata) {
    global $wpdb;
    $styleid = (int) $styleid;
    $table_list = $wpdb->prefix . 'oxi_div_list';
    $table_name = $wpdb->prefix . 'oxi_div_style';
    $listdata = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_list WHERE styleid = %d ORDER by id ASC ", $styleid), ARRAY_A);
    $styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d ", $styleid), ARRAY_A);
    if (is_array($styledata)) {
        wp_enqueue_script('jquery');
        $stylename = $styledata['style_name'];
        $styledata = $styledata['css'];
        wp_enqueue_style('oxilab-flip-box', plugins_url('public/style.css', __FILE__));
        wp_enqueue_style('animation', plugins_url('public/animation.css', __FILE__));
        wp_enqueue_script('oxilab-animation', plugins_url('public/animation.js', __FILE__));
        $styledata = explode('|', $styledata);
        include_once oxilab_flip_box_url . 'public/' . $stylename . '.php';
        $stylefunctionmane = 'oxilab_flip_box_shortcode_function_' . $stylename . '';
        echo '<div class="oxi-addons-container">';
        $stylefunctionmane($styleid, $userdata, $styledata, $listdata);
        echo '</div>';
    }
}
