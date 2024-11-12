<?php

/**
 * Content for job submission (`[submit_job_form]`) shortcode.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-submit.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.34.3
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $job_manager;
$captcha_version = WP_Job_Manager\WP_Job_Manager_Recaptcha::instance()->get_recaptcha_version();

// Hook into job submission form handling.
add_action('job_manager_update_job_data', 'save_job_listing_taxonomies', 10, 2);
add_action('job_manager_save_job_listing', 'save_job_listing_taxonomies', 10, 2);

/**
 * Save job type and job category.
 *
 * @param int $job_id The ID of the job post.
 * @param array $values The submitted form values.
 */
function save_job_listing_taxonomies($job_id, $values)
{
    // Handle Job Type (taxonomy: job_listing_type).
    if (isset($_POST['job_type']) && ! empty($_POST['job_type'])) {
        $job_types = array_map('intval', $_POST['job_type']); // Make sure we have valid integers.
        wp_set_object_terms($job_id, $job_types, 'job_listing_type');
    } else {
        wp_set_object_terms($job_id, array(), 'job_listing_type');
    }

    // Handle Job Category (taxonomy: job_listing_category).
    if (isset($_POST['job_category']) && ! empty($_POST['job_category'])) {
        $job_categories = array_map('intval', $_POST['job_category']); // Make sure we have valid integers.
        wp_set_object_terms($job_id, $job_categories, 'job_listing_category');
    } else {
        wp_set_object_terms($job_id, array(), 'job_listing_category');
    }
}

function save_job_listing_additional_fields($job_id, $values)
{
    // Handle company logo upload
    $company_logo = '';
    if (!empty($_FILES['company_logo']['name'])) {
        $uploaded_logo = wp_handle_upload($_FILES['company_logo'], ['test_form' => false]);

        if (isset($uploaded_logo['file'])) {
            $company_logo = esc_url($uploaded_logo['url']); // Save the uploaded file URL
        } else {
            // Handle file upload error
            wp_die(__('Company logo upload failed: ', 'wp-job-manager') . $uploaded_logo['error']);
        }
    }

    // If a new logo was uploaded, save it to the post meta
    if (!empty($company_logo)) {
        update_post_meta($job_id, '_company_logo', $company_logo);
    } elseif ($job_id && isset($_POST['company_logo_current'])) {
        // If no new logo is uploaded, retain the existing logo
        update_post_meta($job_id, '_company_logo', sanitize_text_field($_POST['company_logo_current']));
    }

    // Continue saving other fields like company name, etc.
    if (isset($_POST['company_name'])) {
        update_post_meta($job_id, '_company_name', sanitize_text_field($_POST['company_name']));
    }
}
add_action('job_manager_save_job_listing', 'save_job_listing_additional_fields', 10, 2);


?>

<style>
    .spacer-20 {
        display: block;
        height: 20px;
    }

    #add_job {
        position: relative;
        width: 100%;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }

    #add_job .back_btn {
        width: 100%;
        display: flex;
        align-items: center;
        column-gap: 21px;
        font-size: 18px;
        line-height: 148%;
        font-weight: 500;
        color: #ff8200;
        margin-bottom: 16px;
    }

    #add_job h1 {
        font-size: 32px;
        line-height: 132%;
        color: #101010;
        margin-bottom: 40px;
    }

    #add_job .add_job-form {
        width: 100%;
        max-width: calc(100% - 408px - 20px);
    }

    #add_job .add_job-form .ae_form_card {
        padding: 24px 28px;
        border: 1px solid #e4e4e4;
        border-radius: 8px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-between;
        row-gap: 24px;
    }

    #add_job .add_job-form .ae_form_card .ae_form_card-title {
        font-size: 24px;
        color: #101010;
        line-height: 148%;
        font-weight: 600;
    }

    #add_job .add_job-form fieldset {
        display: flex;
        flex-direction: column;
        row-gap: 8px;
        width: 100%;
        margin: 0;
        padding: 0;
        border-bottom: 0;
    }

    #add_job .add_job-form .half_field {
        max-width: calc(50% - 8px);
    }

    #add_job .add_job-form fieldset .ae_label {
        font-size: 18px;
        font-weight: 600;
        color: #101010;
        line-height: 148%;
        width: 100%;
    }

    #add_job .add_job-form fieldset .ae_input {
        font-size: 18px;
        font-weight: 400;
        color: #636363;
        line-height: 148%;
        background-color: #eeeeee;
        border: 0;
        border-radius: 10px;
        padding: 10px 16px;
    }

    #add_job .add_job-form .add_job-form-btns {
        margin-top: 20px;
    }

    #add_job .add_job-form .add_job-form-btns input[type="submit"] {
        font-size: 18px;
        font-weight: 400;
        line-height: 148%;
        color: #fff;
        background-color: #ff8200;
        border: 1px solid #ff8200;
        border-radius: 10px;
        padding: 10px 24px;
        cursor: pointer;
        transition: 0.3s all ease-in-out;
    }

    #add_job .add_job-form .add_job-form-btns input[type="submit"]:hover {
        color: #ff8200;
        background-color: #fff;
        border: 1px solid #ff8200;
    }

    #add_job .add_job-form fieldset .ae_input:focus-visible {
        outline: 1px solid #ff8200;
    }

    #add_job .select2-container--default.select2-container--focus .select2-selection--multiple {
        border: solid #ff8200 1px;
        outline: 0;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #ff8200;
        color: white;
    }

    .select2-dropdown {
        border: 1px solid #ff8200;
    }

    #add_job .add_job-nav {
        width: 100%;
        max-width: 408px;
        border: 1px solid #e4e4e4;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    #add_job .add_job-nav-link {
        width: 100%;
        padding: 18px 0 18px 28px;
        position: relative;
        border-bottom: 1px solid #e4e4e4;

        font-size: 16px;
        font-weight: 600;
        color: #101010;
    }

    #add_job .add_job-nav-link:hover {
        color: #ff8200;
    }

    #add_job .add_job-nav-link:last-child {
        border-bottom: 0px;
    }

    #add_job .add_job-nav-link.active::before,
    #add_job .add_job-nav-link:hover::before {
        content: "";
        position: absolute;
        width: 4px;
        height: 100%;
        top: 0;
        left: 0;
        background-color: #ff8200;
    }
</style>

<div id="add_job">
    <div class="add_job-form">
        <a href="#" class="back_btn">
            <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 7H15M1 7L7 13M1 7L7 1" stroke="#FF8200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span>Back</span>
        </a>

        <h1>Add Job</h1>

        <form action="<?php echo esc_url($action); ?>" method="post" id="submit-job-form" class="job-manager-form" enctype="multipart/form-data">

            <?php do_action('submit_job_form_start'); ?>

            <?php if (job_manager_user_can_post_job() || job_manager_user_can_edit_job($job_id)) : ?>
                <?php

                $job_title = get_post_meta($job_id, '_job_title', true);
                $job_location = get_post_meta($job_id, '_job_location', true);
                $job_description = get_post_meta($job_id, '_job_description', true);
                $company_name = get_post_meta($job_id, '_company_name', true);
                $company_website = get_post_meta($job_id, '_company_website', true);

                $company_logo = get_post_meta($job_id, '_company_logo', true);

                wp_enqueue_script('wp-job-manager-term-multiselect');
                wp_enqueue_script('wp-job-manager-datepicker');
                wp_enqueue_style('jquery-ui');

                ?>
                <div id="jobDetails" class="ae_form_card">
                    <h4 class="ae_form_card-title">Job Details</h4>

                    <!-- Job Title Field -->
                    <fieldset class="fieldset-job_title fieldset-type-title">
                        <label for="job_title" class="ae_label"><?php esc_html_e('Job Title', 'wp-job-manager'); ?></label>
                        <input type="text" name="job_title" class="ae_input" id="job_title" value="<?php echo esc_attr($job_title); ?>" required />
                    </fieldset>

                    <!-- Job Location Field -->
                    <fieldset class="fieldset-job_location fieldset-type-location half_field">
                        <label for="job_location" class="ae_label"><?php esc_html_e('Job Location', 'wp-job-manager'); ?></label>
                        <input type="text" name="job_location" class="ae_input" id="job_location" value="<?php echo esc_attr($job_location); ?>" required />
                    </fieldset>

                    <!-- Job Type Field (Multiselect) -->
                    <fieldset class="fieldset-job_type fieldset-type-multiselect half_field">
                        <label for="job_type" class="ae_label"><?php esc_html_e('Type of Work', 'wp-job-manager'); ?></label>
                        <div class="multiselect_field">
                            <?php
                            job_manager_dropdown_categories([
                                'taxonomy'     => 'job_listing_type',  // This is the job type taxonomy.
                                'name'         => 'job_type[]',        // Allow multiple selections.
                                'orderby'      => 'name',
                                'selected'     => wp_get_post_terms($job_id, 'job_listing_type', ['fields' => 'ids']),
                                'hide_empty'   => false,
                                'hierarchical' => true,
                                'placeholder'  => __('Choose Job Type(s)', 'wp-job-manager'),
                            ]);
                            ?>
                        </div>
                    </fieldset>

                    <!-- Job Category Field (Multiselect) -->
                    <fieldset class="fieldset-job_category fieldset-type-multiselect half_field">
                        <label for="job_category" class="ae_label"><?php esc_html_e('Category of Work', 'wp-job-manager'); ?></label>
                        <div class="multiselect_field">
                            <?php
                            job_manager_dropdown_categories([
                                'taxonomy'     => 'job_listing_category',  // This is the job category taxonomy.
                                'name'         => 'job_category[]',        // Allow multiple selections.
                                'orderby'      => 'name',
                                'selected'     => wp_get_post_terms($job_id, 'job_listing_category', ['fields' => 'ids']),
                                'hide_empty'   => false,
                                'hierarchical' => true,
                                'placeholder'  => __('Choose Job Category(s)', 'wp-job-manager'),
                            ]);
                            ?>
                        </div>
                    </fieldset>

                    <!-- Application Period Field -->
                    <fieldset class="fieldset-application_period fieldset-type-date half_field">
                        <label for="application_period" class="ae_label"><?php esc_html_e('Application Period', 'wp-job-manager'); ?></label>
                        <input type="text" class="input-date job-manager-datepicker ae_input"
                            name="application_period"
                            id="application_period"
                            placeholder="<?php esc_attr_e('Select application period', 'wp-job-manager'); ?>"
                            value="<?php echo esc_attr($application_period); ?>" />
                        <?php if (! empty($application_period_description)) : ?>
                            <small class="description"><?php echo wp_kses_post($application_period_description); ?></small>
                        <?php endif; ?>
                    </fieldset>

                    <!-- Job Description Field (WYSIWYG Editor) -->
                    <fieldset class="fieldset-job_description fieldset-type-description">
                        <label for="job_description" class="ae_label" style="margin-bottom: -30px;"><?php esc_html_e('About The Role', 'wp-job-manager'); ?></label>
                        <?php
                        wp_editor(
                            $job_description,          // The content to display in the editor.
                            'job_description',         // The ID of the textarea element.
                            array(
                                'textarea_name' => 'job_description', // The name attribute of the textarea.
                                'textarea_rows' => 14,                 // Number of rows in the editor.
                                'media_buttons' => false,             // Hide "Add Media" button.
                                'tinymce'       => array(
                                    'toolbar1' => 'formatselect,bold,italic,underline,bullist,numlist,link,unlink', // Add 'formatselect' for paragraphs/headings.
                                    'toolbar2' => '',                  // Hide second toolbar row.
                                    'block_formats' => 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;', // Specify available formats.
                                ),
                            )
                        );
                        ?>
                    </fieldset>
                </div>
                <div class="spacer-20"></div>
                <div id="whoAreWe" class="ae_form_card">
                    <h4 class="ae_form_card-title">Who Are We?</h4>
                    <!-- Who We Are Field (WYSIWYG Editor) -->
                    <fieldset class="fieldset-who_we_are fieldset-type-description">
                        <label for="who_we_are" class="ae_label" style="margin-bottom: -30px;"><?php esc_html_e('Who We Are?', 'wp-job-manager'); ?></label>
                        <?php
                        wp_editor(
                            $job_description,          // The content to display in the editor.
                            'who_we_are',         // The ID of the textarea element.
                            array(
                                'textarea_name' => 'who_we_are', // The name attribute of the textarea.
                                'textarea_rows' => 14,                 // Number of rows in the editor.
                                'media_buttons' => false,             // Hide "Add Media" button.
                                'tinymce'       => array(
                                    'toolbar1' => 'formatselect,bold,italic,underline,bullist,numlist,link,unlink', // Add 'formatselect' for paragraphs/headings.
                                    'toolbar2' => '',                  // Hide second toolbar row.
                                    'block_formats' => 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;', // Specify available formats.
                                ),
                            )
                        );
                        ?>
                    </fieldset>
                </div>
                <div class="spacer-20"></div>
                <div id="whatDoWeOffer" class="ae_form_card">
                    <h4 class="ae_form_card-title">What Do We Offer?</h4>
                    <!-- Who We Are Field (WYSIWYG Editor) -->
                    <fieldset class="fieldset-what_do_we_offer fieldset-type-description">
                        <label for="what_do_we_offer" class="ae_label" style="margin-bottom: -30px;"><?php esc_html_e('What Do We Offer?', 'wp-job-manager'); ?></label>
                        <?php
                        wp_editor(
                            $job_description,          // The content to display in the editor.
                            'what_do_we_offer',         // The ID of the textarea element.
                            array(
                                'textarea_name' => 'what_do_we_offer', // The name attribute of the textarea.
                                'textarea_rows' => 14,                 // Number of rows in the editor.
                                'media_buttons' => false,             // Hide "Add Media" button.
                                'tinymce'       => array(
                                    'toolbar1' => 'formatselect,bold,italic,underline,bullist,numlist,link,unlink', // Add 'formatselect' for paragraphs/headings.
                                    'toolbar2' => '',                  // Hide second toolbar row.
                                    'block_formats' => 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;', // Specify available formats.
                                ),
                            )
                        );
                        ?>
                    </fieldset>
                </div>
                <div class="spacer-20"></div>
                <div id="responsibilities" class="ae_form_card">
                    <h4 class="ae_form_card-title">Key Responsibilities</h4>
                    <!-- Who We Are Field (WYSIWYG Editor) -->
                    <fieldset class="fieldset-key_responsibilities fieldset-type-description">
                        <label for="key_responsibilities" class="ae_label" style="margin-bottom: -30px;"><?php esc_html_e('Key Responsibilities?', 'wp-job-manager'); ?></label>
                        <?php
                        wp_editor(
                            $job_description,          // The content to display in the editor.
                            'key_responsibilities',         // The ID of the textarea element.
                            array(
                                'textarea_name' => 'key_responsibilities', // The name attribute of the textarea.
                                'textarea_rows' => 14,                 // Number of rows in the editor.
                                'media_buttons' => false,             // Hide "Add Media" button.
                                'tinymce'       => array(
                                    'toolbar1' => 'formatselect,bold,italic,underline,bullist,numlist,link,unlink', // Add 'formatselect' for paragraphs/headings.
                                    'toolbar2' => '',                  // Hide second toolbar row.
                                    'block_formats' => 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;', // Specify available formats.
                                ),
                            )
                        );
                        ?>
                    </fieldset>
                </div>
                <div class="spacer-20"></div>
                <div id="howToApply" class="ae_form_card">
                    <h4 class="ae_form_card-title">How To Apply?</h4>
                    <!-- Who We Are Field (WYSIWYG Editor) -->
                    <fieldset class="fieldset-how_to_apply fieldset-type-description">
                        <label for="how_to_apply" class="ae_label" style="margin-bottom: -30px;"><?php esc_html_e('How To Apply?', 'wp-job-manager'); ?></label>
                        <?php
                        wp_editor(
                            $job_description,          // The content to display in the editor.
                            'how_to_apply',         // The ID of the textarea element.
                            array(
                                'textarea_name' => 'how_to_apply', // The name attribute of the textarea.
                                'textarea_rows' => 14,                 // Number of rows in the editor.
                                'media_buttons' => false,             // Hide "Add Media" button.
                                'tinymce'       => array(
                                    'toolbar1' => 'formatselect,bold,italic,underline,bullist,numlist,link,unlink', // Add 'formatselect' for paragraphs/headings.
                                    'toolbar2' => '',                  // Hide second toolbar row.
                                    'block_formats' => 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;', // Specify available formats.
                                ),
                            )
                        );
                        ?>
                    </fieldset>
                </div>
                <div class="spacer-20"></div>
                <div id="companyDetails" class="ae_form_card">
                    <h4 class="ae_form_card-title">Company Details</h4>
                    <!-- Company Logo Field -->
                    <fieldset class="fieldset-company_logo fieldset-type-file">
                        <label for="company_logo" class="ae_label"><?php esc_html_e('Company Logo (JPG, PNG)', 'wp-job-manager'); ?></label>
                        <input type="file" name="company_logo" id="company_logo" accept="image/jpeg,image/png" />
                        <?php if ($company_logo): ?>
                            <input type="hidden" name="company_logo_current" value="<?php echo esc_attr($company_logo); ?>" />
                            <p><?php esc_html_e('Current Logo:', 'wp-job-manager'); ?> <a href="<?php echo esc_url($company_logo); ?>" target="_blank"><?php esc_html_e('View Logo', 'wp-job-manager'); ?></a></p>
                        <?php endif; ?>
                    </fieldset>
                    <!-- Company Name Field -->
                    <fieldset class="fieldset-company_name fieldset-type-text">
                        <label for="company_name" class="ae_label"><?php esc_html_e('Company Name', 'wp-job-manager'); ?></label>
                        <input type="text" name="company_name" id="company_name" class="ae_input" value="<?php echo esc_attr($company_name); ?>" required />
                    </fieldset>

                    <!-- Company Website Field (Optional) -->
                    <fieldset class="fieldset-company_website fieldset-type-url">
                        <label for="company_website" class="ae_label"><?php esc_html_e('Company Website', 'wp-job-manager'); ?> <small><?php esc_html_e('(optional)', 'wp-job-manager'); ?></small></label>
                        <input type="url" name="company_website" id="company_website" class="ae_input" value="<?php echo esc_url($company_website); ?>" />
                    </fieldset>
                </div>

                <?php do_action('submit_job_form_end'); ?>

                <div class="add_job-form-btns">
                    <input type="hidden" name="job_manager_form" value="<?php echo esc_attr($form); ?>" />
                    <input type="hidden" name="job_id" value="<?php echo esc_attr($job_id); ?>" />
                    <input type="hidden" name="step" value="<?php echo esc_attr($step); ?>" />
                    <input type="submit" name="submit_job" class="button"
                        <?php if ('v3' === $captcha_version) echo 'onclick="jm_job_submit_click(event)"'; ?> value="<?php echo esc_attr($submit_button_text); ?>" />
                    <span class="spinner" style="background-image: url(<?php echo esc_url(includes_url('images/spinner.gif')); ?>);"></span>
                </div>

            <?php else : ?>
                <?php do_action('submit_job_form_disabled'); ?>
            <?php endif; ?>


        </form>
    </div>
    <div class="add_job-nav">
        <a href="#" class="add_job-nav-link add_job-jobDetails">Job Details</a>
        <a href="#" class="add_job-nav-link add_job-whoAreWe">Who are we?</a>
        <a href="#" class="add_job-nav-link add_job-whatDoWeOffer">What do we Offer?</a>
        <a href="#" class="add_job-nav-link add_job-responsibilities">Key Responsibilities</a>
        <a href="#" class="add_job-nav-link add_job-howToApply">How to Apply</a>
        <a href="#" class="add_job-nav-link add_job-companyDetails">Company Details</a>
    </div>
</div>