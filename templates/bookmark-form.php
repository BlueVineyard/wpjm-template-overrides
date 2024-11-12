<?php

/**
 * Form for adding and removing a bookmark.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-bookmarks/bookmark-form.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager - Bookmarks
 * @category    Template
 * @version     1.4.0
 */

if (! defined('ABSPATH')) {
    exit;
}

global $wp;
?>
<form method="post" action="<?php echo defined('DOING_AJAX') ? '' : esc_url(remove_query_arg(array('page', 'paged'), add_query_arg($wp->query_string, '', home_url($wp->request)))); ?>" class="ae_resume_card-bookmark_form <?php echo $is_bookmarked ? 'has-bookmark' : ''; ?>">
    <a class="add-bookmark" href="#" data-tooltip="<?php echo $is_bookmarked ? 'Update/Remove Bookmark' : 'Bookmark this Job'; ?>">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M16.1269 3.04559C17.1353 3.16292 17.875 4.03284 17.875 5.0485V19.2504L11 15.8129L4.125 19.2504V5.0485C4.125 4.03284 4.86383 3.16292 5.87308 3.04559C9.27959 2.65017 12.7204 2.65017 16.1269 3.04559Z"
                stroke="#636363" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </a>
    <div class="bookmark-details" style="display:none;">
        <div class="form-group">
            <label for="bookmark_notes"><?php _e('Notes:', 'wp-job-manager-bookmarks'); ?></label>
            <textarea name="bookmark_notes" id="bookmark_notes" cols="25" rows="3"><?php echo esc_textarea($note); ?></textarea>
        </div>
        <div>
            <?php wp_nonce_field('update_bookmark'); ?>
            <input type="hidden" name="bookmark_post_id" value="<?php echo absint($post->ID); ?>" />
            <input type="submit" class="submit-bookmark-button" name="submit_bookmark" value="<?php echo $is_bookmarked ? __('Update Bookmark', 'wp-job-manager-bookmarks') : __('Add Bookmark', 'wp-job-manager-bookmarks'); ?>" />
            <?php
            if ($is_bookmarked) {
            ?>
                <a class="remove-bookmark" href="<?php echo wp_nonce_url(add_query_arg('remove_bookmark', absint($post->ID), add_query_arg($_GET, '', get_permalink())), 'remove_bookmark'); ?>">
                    Remove Bookmark
                </a>
            <?php
            }
            ?>
            <span class="spinner" style="background-image: url(<?php echo includes_url('images/spinner.gif'); ?>);"></span>
        </div>
    </div>
</form>