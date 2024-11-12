<?php

// File: includes/functions/meta-box-about-us.php

function wpjm_register_what_do_we_offer_meta_box()
{
    add_meta_box(
        'what_do_we_offer_data',
        __('What Do We Offer?', 'wp-job-manager'),
        'wpjm_display_what_do_we_offer_meta_box',
        'job_listing',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'wpjm_register_what_do_we_offer_meta_box');

function wpjm_display_what_do_we_offer_meta_box($post)
{
    $what_do_we_offer_content = get_post_meta($post->ID, '_what_do_we_offer', true);
    wp_editor(
        $what_do_we_offer_content,
        'what_do_we_offer_editor',
        array(
            'textarea_name' => 'what_do_we_offer',
            'textarea_rows' => 14,
            'media_buttons' => false,
            'tinymce'       => array(
                'toolbar1' => 'formatselect,bold,italic,underline,bullist,numlist,link,unlink',
                'toolbar2' => 'strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help',
                'block_formats' => 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;',
            ),
        )
    );
    wp_nonce_field('wpjm_save_what_do_we_offer_meta_box', 'wpjm_what_do_we_offer_nonce');
}

function wpjm_save_what_do_we_offer_meta_box($post_id)
{
    if (!isset($_POST['wpjm_what_do_we_offer_nonce']) || !wp_verify_nonce($_POST['wpjm_what_do_we_offer_nonce'], 'wpjm_save_what_do_we_offer_meta_box')) {
        return $post_id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    if (isset($_POST['what_do_we_offer'])) {
        update_post_meta($post_id, '_what_do_we_offer', wp_kses_post($_POST['what_do_we_offer']));
    }
}
add_action('save_post', 'wpjm_save_what_do_we_offer_meta_box');
