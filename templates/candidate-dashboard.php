<?php

/**
 * Custom Template for the candidate dashboard (`[candidate_dashboard]`) shortcode.
 * Fully custom dashboard with AJAX actions for deleting and hiding resumes.
 */

if (! defined('ABSPATH')) {
    exit;
}

$current_user_id = get_current_user_id();
$submission_limit = get_option('resume_manager_submission_limit');
$submit_resume_form_page_id = get_option('resume_manager_submit_resume_form_page_id');

// Fetch resumes posted by the current user
$resumes = get_posts(array(
    'post_type'   => 'resume',
    'author'      => $current_user_id,
    'post_status' => array('publish', 'hidden', 'expired', 'pending'),
    'numberposts' => -1,
));

?>
<style>
    #custom-candidate-dashboard .custom-dashboard-table {
        width: 100%;
        text-align: center;
    }

    #custom-candidate-dashboard .custom-dashboard-table td:first-child {
        text-align: left;
    }

    #custom-candidate-dashboard .custom-dashboard-table td:last-child {
        text-align: right;
    }

    #custom-candidate-dashboard .custom-dashboard-table .resume_name {
        font-weight: 600;
        color: #101010;
    }
</style>

<div id="custom-candidate-dashboard">

    <?php if (!empty($resumes)) : ?>
        <table class="custom-dashboard-table">
            <tbody>
                <?php foreach ($resumes as $resume) : ?>
                    <tr id="resume-<?php echo esc_attr($resume->ID); ?>">
                        <td><a class="resume_name" href="<?php echo get_permalink($resume->ID); ?>"><?php echo esc_html($resume->post_title); ?></a></td>
                        <td><?php echo esc_html(ucwords($resume->post_status)); ?></td>
                        <td>
                            <!-- Custom Edit Button -->
                            <a href="<?php echo add_query_arg(['action' => 'edit', 'resume_id' => $resume->ID], site_url('/submit-resume/')); ?>" class="custom-edit-button">
                                <?php _e('Edit', 'wp-job-manager-resumes'); ?>
                            </a> |

                            <!-- Custom Hide/Publish Button -->
                            <a href="<?php echo get_permalink($resume->ID); ?>">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p><?php _e('You do not have any resumes.', 'wp-job-manager-resumes'); ?></p>
    <?php endif; ?>

    <!-- Option to Add Resume -->
    <?php if ($submit_resume_form_page_id && (resume_manager_count_user_resumes() < $submission_limit || !$submission_limit)) : ?>
        <a href="<?php echo esc_url(get_permalink($submit_resume_form_page_id)); ?>" class="button">
            <?php _e('Add Resume', 'wp-job-manager-resumes'); ?>
        </a>
    <?php endif; ?>
</div>