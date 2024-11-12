<?php
// File: includes/template-overrides.php

// Include separate files for cleaner organization
include_once plugin_dir_path(__FILE__) . 'functions/admin-scripts.php';
include_once plugin_dir_path(__FILE__) . 'functions/meta-box-certifications.php';
include_once plugin_dir_path(__FILE__) . 'functions/custom-fields.php';
include_once plugin_dir_path(__FILE__) . 'functions/enqueue-scripts.php';
include_once plugin_dir_path(__FILE__) . 'functions/meta-box-who-are-we.php';
include_once plugin_dir_path(__FILE__) . 'functions/meta-box-what-do-we-offer.php';
include_once plugin_dir_path(__FILE__) . 'functions/meta-box-key-responsibilities.php';
include_once plugin_dir_path(__FILE__) . 'functions/meta-box-how-to-apply.php';

// Custom template override function
function my_custom_job_manager_template($template, $template_name, $template_path)
{
    $custom_template_path = plugin_dir_path(__FILE__) . '../templates/' . $template_name;
    if (file_exists($custom_template_path)) {
        return $custom_template_path;
    }
    return $template;
}
add_filter('job_manager_locate_template', 'my_custom_job_manager_template', 10, 3);

// Handle delete resume via AJAX
function ajax_delete_resume()
{
    check_ajax_referer('delete_resume_nonce', 'nonce');

    $resume_id = intval($_POST['resume_id']);
    if (current_user_can('delete_post', $resume_id) && get_post_type($resume_id) === 'resume') {
        wp_delete_post($resume_id, true); // Force delete
        wp_send_json_success(array('message' => __('Resume deleted successfully.', 'wp-job-manager-resumes')));
    } else {
        wp_send_json_error(array('message' => __('You cannot delete this resume.', 'wp-job-manager-resumes')));
    }
}
add_action('wp_ajax_delete_resume', 'ajax_delete_resume');

// Handle hide resume via AJAX
function ajax_hide_resume()
{
    check_ajax_referer('hide_resume_nonce', 'nonce');

    $resume_id = intval($_POST['resume_id']);
    if (current_user_can('edit_post', $resume_id) && get_post_type($resume_id) === 'resume') {
        wp_update_post(array('ID' => $resume_id, 'post_status' => 'hidden'));
        wp_send_json_success(array('message' => __('Resume hidden successfully.', 'wp-job-manager-resumes')));
    } else {
        wp_send_json_error(array('message' => __('You cannot hide this resume.', 'wp-job-manager-resumes')));
    }
}
add_action('wp_ajax_hide_resume', 'ajax_hide_resume');

// Handle publish resume via AJAX
function ajax_publish_resume()
{
    check_ajax_referer('publish_resume_nonce', 'nonce');

    $resume_id = intval($_POST['resume_id']);
    if (current_user_can('edit_post', $resume_id) && get_post_type($resume_id) === 'resume') {
        wp_update_post(array('ID' => $resume_id, 'post_status' => 'publish'));
        wp_send_json_success(array('message' => __('Resume published successfully.', 'wp-job-manager-resumes')));
    } else {
        wp_send_json_error(array('message' => __('You cannot publish this resume.', 'wp-job-manager-resumes')));
    }
}
add_action('wp_ajax_publish_resume', 'ajax_publish_resume');
