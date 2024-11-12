<?php
// Register the meta box
function wpjm_register_certification_meta_box()
{
    add_meta_box(
        'resume_certification_data',
        __('Licences & Certifications', 'wp-job-manager-resumes'),
        'wpjm_display_certification_meta_box',
        'resume',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'wpjm_register_certification_meta_box');

// Display the meta box fields
function wpjm_display_certification_meta_box($post)
{
    $certifications = get_post_meta($post->ID, '_resume_certifications', true);
    wp_nonce_field('wpjm_save_certification_meta_box', 'wpjm_certification_nonce');
    echo '<div id="wpjm-certifications-repeater" class="wpjm-sortable">';

    if (!empty($certifications) && is_array($certifications)) {
        foreach ($certifications as $certification) {
            wpjm_certification_fields($certification);
        }
    } else {
        wpjm_certification_fields();
    }

    echo '</div>';
    echo '<button type="button" class="button add-certification">Add Licence/Certification</button>';

?>
    <script>
        jQuery(document).ready(function($) {
            $('#wpjm-certifications-repeater').sortable({
                handle: '.handle'
            });

            function addCertification() {
                var fieldHTML = `
                    <div class="certification">
                        <span class="handle dashicons dashicons-move"></span>
                        <input type="text" name="certifications[licence_name][]" placeholder="Licence Name" />
                        <input type="text" name="certifications[licence_issuer][]" placeholder="Licence Issuer" />
                        <input type="date" name="certifications[issue_date][]" placeholder="Issue Date" />
                        <input type="date" name="certifications[expiry_date][]" placeholder="Expiry Date" />
                        <button type="button" class="button remove-certification"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20"><path fill="currentColor" d="M14.95 6.46L11.41 10l3.54 3.54l-1.41 1.41L10 11.42l-3.53 3.53l-1.42-1.42L8.58 10L5.05 6.47l1.42-1.42L10 8.58l3.54-3.53z"/></svg></button>
                    </div>
                `;
                $('#wpjm-certifications-repeater').append(fieldHTML);
            }

            $('.add-certification').on('click', function() {
                addCertification();
            });

            $('#wpjm-certifications-repeater').on('click', '.remove-certification', function() {
                $(this).closest('.certification').remove();
            });
        });
    </script>
<?php
}

// Helper function to display certification fields
function wpjm_certification_fields($certification = array())
{
    $licence_name = isset($certification['licence_name']) ? esc_attr($certification['licence_name']) : '';
    $licence_issuer = isset($certification['licence_issuer']) ? esc_attr($certification['licence_issuer']) : '';
    $issue_date = isset($certification['issue_date']) ? esc_attr($certification['issue_date']) : '';
    $expiry_date = isset($certification['expiry_date']) ? esc_attr($certification['expiry_date']) : '';

    echo '<div class="certification">';
    echo '<span class="handle dashicons dashicons-move"></span>';
    echo '<input type="text" name="certifications[licence_name][]" placeholder="Licence Name" value="' . $licence_name . '" />';
    echo '<input type="text" name="certifications[licence_issuer][]" placeholder="Licence Issuer" value="' . $licence_issuer . '" />';
    echo '<input type="date" name="certifications[issue_date][]" placeholder="Issue Date" value="' . $issue_date . '" />';
    echo '<input type="date" name="certifications[expiry_date][]" placeholder="Expiry Date" value="' . $expiry_date . '" />';
    echo '<button type="button" class="button remove-certification"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 20 20"><path fill="currentColor" d="M14.95 6.46L11.41 10l3.54 3.54l-1.41 1.41L10 11.42l-3.53 3.53l-1.42-1.42L8.58 10L5.05 6.47l1.42-1.42L10 8.58l3.54-3.53z"/></svg></button>';
    echo '</div>';
}

// Save the meta box data
function wpjm_save_certification_meta_box($post_id)
{
    if (!isset($_POST['wpjm_certification_nonce']) || !wp_verify_nonce($_POST['wpjm_certification_nonce'], 'wpjm_save_certification_meta_box')) {
        return $post_id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    $certifications = array();
    if (isset($_POST['certifications']['licence_name'])) {
        $count = count($_POST['certifications']['licence_name']);
        for ($i = 0; $i < $count; $i++) {
            $certifications[] = array(
                'licence_name' => sanitize_text_field($_POST['certifications']['licence_name'][$i]),
                'licence_issuer' => sanitize_text_field($_POST['certifications']['licence_issuer'][$i]),
                'issue_date' => sanitize_text_field($_POST['certifications']['issue_date'][$i]),
                'expiry_date' => sanitize_text_field($_POST['certifications']['expiry_date'][$i]),
            );
        }
    }
    update_post_meta($post_id, '_resume_certifications', $certifications);
}
add_action('save_post', 'wpjm_save_certification_meta_box');
