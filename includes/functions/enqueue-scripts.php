<?php
// File: includes/functions/enqueue-scripts.php

function wpjm_enqueue_frontend_scripts()
{
    // Enqueue CSS
    wp_enqueue_style(
        'wpjm-frontend-styles', // Handle
        plugin_dir_url(__FILE__) . '../../assets/css/frontend-styles.css', // Path to the CSS file
        array(), // Dependencies
        '1.0.0' // Version
    );

    // Enqueue JavaScript
    wp_enqueue_script(
        'wpjm-frontend-scripts', // Handle
        plugin_dir_url(__FILE__) . '../../assets/js/frontend-scripts.js', // Path to the JS file
        array('jquery'), // Dependencies
        '1.0.0', // Version
        true // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'wpjm_enqueue_frontend_scripts');

function enqueue_dashboard_ajax_script()
{
    // Enqueue the custom dashboard AJAX script
    wp_enqueue_script('custom-dashboard-ajax', plugin_dir_url(__FILE__) . '../js/dashboard-ajax.js', array('jquery'), null, true);

    // Localize the script with necessary data
    wp_localize_script('custom-dashboard-ajax', 'wpjm_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'delete_resume_nonce' => wp_create_nonce('delete_resume_nonce'),
        'hide_resume_nonce' => wp_create_nonce('hide_resume_nonce'),
        'publish_resume_nonce' => wp_create_nonce('publish_resume_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_dashboard_ajax_script');
