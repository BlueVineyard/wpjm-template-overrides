<?php

/**
 * Show job application when viewing a single job listing.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-application.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.31.1
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<?php if ($apply = get_the_job_application_method()) :
    wp_enqueue_script('wp-job-manager-job-application');
?>

    <style>
        .application_button,
        .application_details input[type="submit"] {
            cursor: pointer;
            border-radius: 10px;
            padding: 12px 24px;
            font-size: 18px;
            line-height: 148%;
            font-weight: 500;
            background-color: #FF8200;
            border: 1px solid #FF8200;
            color: #fff;
            transition: 0.3s all ease-in-out;
        }

        .application_button:hover,
        .application_details input[type="submit"]:hover {
            background-color: #fff;
            border: 1px solid #FF8200;
            color: #FF8200;
        }

        .application_details {
            margin-top: 20px;
        }

        .application_details * {
            font-family: 'Open Sans';
            float: unset !important;
        }

        .application_details label {
            color: #101010;
            font-size: 18px;
            font-weight: 600;
            line-height: 148%;
            margin-bottom: 8px !important;
            text-transform: capitalize;
        }

        .application_details input[type="text"],
        .application_details select,
        .application_details textarea {
            background-color: #EEEEEE;
            border: 1px solid #eeeeee;
            border-radius: 10px;
            padding: 10px 16px;
            color: #636363;
            font-size: 18px;
            font-weight: 400;
            line-height: 148%;
        }

        .application_details input[type="text"]:focus-visible,
        .application_details select:focus-visible,
        .application_details textarea:focus-visible {
            outline: 1px solid #FF8200;
        }
    </style>

    <div class="job_application application">

        <?php if (get_field('apply_externally') == "yes") : ?>
            <a class="application_button button" target="_blank" href="<?php echo esc_url(get_field('external_application_link')) ?>">Apply Here</a>
        <?php else : ?>
            <?php do_action('job_application_start', $apply); ?>

            <input type="button" class="application_button button" value="<?php esc_attr_e('Quick Apply Now', 'wp-job-manager'); ?>" />

            <div class="application_details">
                <?php
                /**
                 * job_manager_application_details_email or job_manager_application_details_url hook
                 */
                do_action('job_manager_application_details_' . $apply->type, $apply);
                ?>
            </div>
            <?php do_action('job_application_end', $apply); ?>
        <?php endif; ?>


    </div>
<?php endif; ?>