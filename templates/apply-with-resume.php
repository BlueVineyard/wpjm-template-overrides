<?php

/**
 * Apply with Resume content that displays on single job listings.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/apply-with-resume.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @version     1.16.0
 */

if (! defined('ABSPATH')) {
    exit;
}

global $post;

if (! get_option('resume_manager_force_application')) {
    echo '<hr />';
}

if (is_user_logged_in() && count($resumes)) : ?>
    <form class="apply_with_resume" method="post">
        <p><?php esc_html_e('Apply using your online resume; just enter a short message to send your application.', 'wp-job-manager-resumes'); ?></p>
        <p>
            <label for="resume_id"><?php esc_html_e('Online resume', 'wp-job-manager-resumes'); ?>:</label>
            <select name="resume_id" id="resume_id" required>
                <?php
                foreach ($resumes as $resume) {
                    echo '<option value="' . esc_attr(absint($resume->ID)) . '">' . esc_html(get_resume_select_label($resume)) . '</option>';
                }
                ?>
            </select>
        </p>
        <p>
            <label><?php esc_html_e('Message', 'wp-job-manager-resumes'); ?>:</label>
            <textarea name="application_message" cols="20" rows="4" required><?php
                                                                                if (isset($_POST['application_message'])) {
                                                                                    echo esc_textarea(stripslashes($_POST['application_message']));
                                                                                } else {
                                                                                    echo _x('To whom it may concern,', 'default cover letter', 'wp-job-manager-resumes') . "\n\n";

                                                                                    printf(_x('I am very interested in the %1$s position at %2$s. I believe my skills and work experience make me an ideal candidate for this role. I look forward to speaking with you soon about this position.', 'default cover letter', 'wp-job-manager-resumes'), $post->post_title, get_post_meta($post->ID, '_company_name', true));

                                                                                    echo "\n\n" . _x('Thank you for your consideration.', 'default cover letter', 'wp-job-manager-resumes');
                                                                                }
                                                                                ?></textarea>
        </p>
        <p>
            <input type="submit" name="wp_job_manager_resumes_apply_with_resume" value="<?php esc_attr_e('Send Application', 'wp-job-manager-resumes'); ?>" />
            <input type="hidden" name="job_id" value="<?php echo esc_attr(absint($post->ID)); ?>" />
        </p>
    </form>
<?php else : ?>
    <style>
        .submit_resume_candidate {
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

        .submit_resume_candidate:hover {
            background-color: #fff;
            border: 1px solid #FF8200;
            color: #FF8200;
        }
    </style>
    <form class="apply_with_resume" method="post" action="<?php echo esc_url(get_permalink(get_option('resume_manager_submit_resume_form_page_id'))); ?>">
        <p><?php esc_html_e('You can apply to this job and others using your online resume. Click the link below to submit your online resume and email your application to this employer.', 'wp-job-manager-resumes'); ?></p>

        <p>
            <a href="javascript:void(0);" class="submit_resume_candidate"><?php esc_attr_e('Submit Resume &amp; Apply', 'wp-job-manager-resumes'); ?></a>
            <!-- <input type="submit" name="wp_job_manager_resumes_apply_with_resume_create" value="<?php #esc_attr_e('Submit Resume &amp; Apply', 'wp-job-manager-resumes'); 
                                                                                                    ?>" /> -->
            <input type="hidden" name="job_id" value="<?php echo esc_attr(absint($post->ID)); ?>" />
        </p>
    </form>
<?php endif; ?>