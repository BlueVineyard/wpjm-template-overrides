<?php
/*
Plugin Name: WP Job Manager Template Overrides
Description: Custom plugin to override WP Job Manager templates.
Version: 1.0
Author: Rohan T George
*/

// Security check to prevent direct access
if (! defined('ABSPATH')) {
    exit;
}

// Include the template override functionality
include_once plugin_dir_path(__FILE__) . 'includes/template-overrides.php';
