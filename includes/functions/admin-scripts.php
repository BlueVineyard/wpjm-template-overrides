<?php
// Enqueue scripts
function wpjm_enqueue_admin_scripts()
{
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_style('wpjm-admin-styles', plugin_dir_url(__FILE__) . '../css/admin-styles.css');
    wp_enqueue_script('wpjm-ae-resume', plugin_dir_url(__FILE__) . '../js/ae-resume.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'wpjm_enqueue_admin_scripts');
