<?php

/**
 * Single job listing.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-single-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @since       1.0.0
 * @version     1.37.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $post;

if (job_manager_user_can_view_job_listing($post->ID)) : ?>
    <style>
        #ae_job-listing {
            padding: 0;
        }

        #ae_job-listing .job_listing_header_img {
            display: block;
            margin-bottom: 40px;
        }

        #ae_job-listing .ae_job-listing-logo {
            max-width: 200px;
            height: auto;
        }

        #ae_job-listing .ae_job-listing-title {
            font-size: 24px;
            font-weight: bold;
            line-height: 148%;
            color: #101010;
        }

        #ae_job-listing .back-btn {
            font-size: 16px;
            font-weight: 500;
            line-height: 148%;
            color: #FF8200;
        }

        #ae_job-listing .ae_job-listing-companyName {
            font-size: 20px;
            font-weight: 500;
            line-height: 148%;
            color: #757575;
            margin: 8px 0 24px;
        }

        #ae_job-listing .ae_job-listing-meta span {
            display: flex;
            align-items: center;
            column-gap: 16px;
            margin-bottom: 16px;

            font-size: 18px;
            font-weight: 400;
            line-height: 132%;
        }

        #ae_job-listing .ae_job-listing-meta span {
            margin: 8px 0 24px;
        }

        #ae_job-listing .ae_job-listing-meta .ae_job-listing-deadline {
            display: flex;
            align-items: center;
            column-gap: 16px;
            margin-bottom: 16px;
            font-size: 18px;
            font-weight: 400;
            line-height: 132%;
            color: #D83636;
            margin: 8px 0 44px;
        }

        #ae_job-listing .ae_job-listing-meta .ae_job-listing-deadline span {
            margin: 0;
        }

        #ae_job-listing .ae_job-listing-body {
            margin-top: 40px;
        }

        #ae_job-listing .ae_job-listing-body .job_description {
            color: #101010;
        }
    </style>
    <?php
    $_company_logo_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $_company_name = get_post_meta($post->ID, '_company_name', true);
    $_job_location = get_post_meta($post->ID, '_job_location', true);
    $what_do_we_offer = get_post_meta($post->ID, '_what_do_we_offer', true);
    $who_are_we = get_post_meta($post->ID, '_who_are_we', true);
    $key_responsibilities = get_post_meta($post->ID, '_key_responsibilities', true);
    $how_to_apply = get_post_meta($post->ID, '_how_to_apply', true);
    $salary = get_post_meta(get_the_ID(), '_job_salary', true);
    $job_types = wp_get_post_terms(get_the_ID(), 'job_listing_type', array('fields' => 'names'));
    $jobDuration = get_post_meta(get_the_ID(), '_job_expires', true);
    $jobDeadline = get_post_meta(get_the_ID(), '_application_deadline', true);
    $last_updated = human_time_diff(get_the_modified_time('U'), current_time('timestamp')) . ' ago';


    $map_svg = '<svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.33337 8.95258C3.33337 5.20473 6.31814 2.1665 10 2.1665C13.6819 2.1665 16.6667 5.20473 16.6667 8.95258C16.6667 12.6711 14.5389 17.0102 11.2192 18.5619C10.4453 18.9236 9.55483 18.9236 8.78093 18.5619C5.46114 17.0102 3.33337 12.6711 3.33337 8.95258Z" stroke="#7C7C7D" stroke-width="1.5" /><ellipse cx="10" cy="8.8335" rx="2.5" ry="2.5" stroke="#7C7C7D" stroke-width="1.5" /></svg>';
    $salary_svg = '<svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="10" cy="10.4998" r="8.33333" stroke="#7C7C7D" stroke-width="1.5"/><path d="M10 5.5V15.5" stroke="#7C7C7D" stroke-width="1.5" stroke-linecap="round"/><path d="M12.5 8.41683C12.5 7.26624 11.3807 6.3335 10 6.3335C8.61929 6.3335 7.5 7.26624 7.5 8.41683C7.5 9.56742 8.61929 10.5002 10 10.5002C11.3807 10.5002 12.5 11.4329 12.5 12.5835C12.5 13.7341 11.3807 14.6668 10 14.6668C8.61929 14.6668 7.5 13.7341 7.5 12.5835" stroke="#7C7C7D" stroke-width="1.5" stroke-linecap="round"/></svg>';
    $time_svg = '<svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.66659 10.5003C1.66659 15.1027 5.39755 18.8337 9.99992 18.8337C14.6023 18.8337 18.3333 15.1027 18.3333 10.5003C18.3333 5.89795 14.6023 2.16699 9.99992 2.16699" stroke="#7C7C7D" stroke-width="1.5" stroke-linecap="round"/><path d="M10 8V11.3333H13.3333" stroke="#7C7C7D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="10" cy="10.5003" r="8.33333" stroke="#7C7C7D" stroke-width="1.5" stroke-linecap="round" stroke-dasharray="0.5 3.5"/></svg>';
    $type_svg = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.97883 9.68508C2.99294 8.89073 2 8.49355 2 8C2 7.50645 2.99294 7.10927 4.97883 6.31492L7.7873 5.19153C9.77318 4.39718 10.7661 4 12 4C13.2339 4 14.2268 4.39718 16.2127 5.19153L19.0212 6.31492C21.0071 7.10927 22 7.50645 22 8C22 8.49355 21.0071 8.89073 19.0212 9.68508L16.2127 10.8085C14.2268 11.6028 13.2339 12 12 12C10.7661 12 9.77318 11.6028 7.7873 10.8085L4.97883 9.68508Z" stroke="#7C7C7D" stroke-width="1.5"/><path d="M5.76613 10L4.97883 10.3149C2.99294 11.1093 2 11.5065 2 12C2 12.4935 2.99294 12.8907 4.97883 13.6851L7.7873 14.8085C9.77318 15.6028 10.7661 16 12 16C13.2339 16 14.2268 15.6028 16.2127 14.8085L19.0212 13.6851C21.0071 12.8907 22 12.4935 22 12C22 11.5065 21.0071 11.1093 19.0212 10.3149L18.2339 10" stroke="#7C7C7D" stroke-width="1.5"/><path d="M5.76613 14L4.97883 14.3149C2.99294 15.1093 2 15.5065 2 16C2 16.4935 2.99294 16.8907 4.97883 17.6851L7.7873 18.8085C9.77318 19.6028 10.7661 20 12 20C13.2339 20 14.2268 19.6028 16.2127 18.8085L19.0212 17.6851C21.0071 16.8907 22 16.4935 22 16C22 15.5065 21.0071 15.1093 19.0212 14.3149L18.2339 14" stroke="#7C7C7D" stroke-width="1.5"/></svg>';
    ?>

    <div class="single-job-listing-content ct-section-inner-wrap" id="ae_job-listing">
        <div class="ae_job-listing-left">
            <img class="job_listing_header_img" src="/wp-content/uploads/2024/08/single-job-listing-header.png" alt="Job Listing Header">

            <div class="ae_job-listing-header">
                <div>
                    <?php if ($_company_logo_url): ?>
                        <img class="ae_job-listing-logo" src="<?php echo $_company_logo_url ?>" alt="<?php echo get_the_title(); ?>">
                    <?php else: ?>
                        <img class="ae_job-listing-logo" src="/wp-content/plugins/wp-job-manager/assets/images/company.png" alt="<?php echo get_the_title(); ?>">
                    <?php endif; ?>
                </div>
                <h1 class="ae_job-listing-title"><?php echo get_the_title(); ?></h1>
                <p class="ae_job-listing-companyName"><?php echo $_company_name; ?> &nbsp; <a class="back-btn" href="/job-filter/">View all jobs</a></p>

                <?php if (is_position_filled()) : ?>
                    <li class="position-filled"><?php _e('This position has been filled', 'wp-job-manager'); ?></li>
                <?php elseif (! candidates_can_apply() && 'preview' !== $post->post_status) : ?>
                    <li class="listing-expired"><?php _e('Applications have closed', 'wp-job-manager'); ?></li>
                <?php endif; ?>

                <?php if (!is_position_filled()) : ?>
                    <div class="ae_job-listing-meta">

                        <?php if (!empty($_job_location)): ?>
                            <span class="ae_job-listing-location"><?php echo $map_svg ?><?php echo $_job_location; ?></span>
                        <?php endif; ?>

                        <?php
                        if (!empty($job_types)) {
                            foreach ($job_types as $job_type) {
                                $job_type_color = '';
                                switch ($job_type) {
                                    case 'Full Time':
                                        $job_type_color = '17B86A';
                                        break;
                                    case 'Part Time':
                                        $job_type_color = 'FF8200';
                                        break;
                                    case 'Contract':
                                        $job_type_color = '0275F4';
                                        break;
                                    case 'Casual':
                                        $job_type_color = '101010';
                                        break;
                                }
                                echo '<span class="ae_job-listing-type" style="color: #' . $job_type_color . ';">' . $type_svg . '' . esc_html($job_type) . '</span>';
                            }
                        }
                        ?>

                        <?php if (!empty($jobDeadline)): ?>
                            <?php
                            // Convert to formatted date
                            $formatted_date = date('jS \of F, Y', strtotime($jobDeadline));
                            ?>
                            <div class="ae_job-listing-deadline"><?php echo $time_svg ?><span style="color: #757b8a;">Applications close: </span><span><?php echo $formatted_date; ?></span></div>
                        <?php endif; ?>

                        <?php if (!empty($salary)): ?>
                            <span class="ae_job-listing-salary"><?php echo $salary_svg ?><?php echo $salary; ?></span>
                        <?php endif; ?>

                        <?php if (candidates_can_apply()) : ?>
                            <?php get_job_manager_template('job-application.php'); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="ae_job-listing-body">
                <div class="job_description">
                    <?php wpjm_the_job_description(); ?>
                    <?php if ($who_are_we) : ?>
                        <?php echo $who_are_we; ?>
                    <?php endif; ?>
                    <?php if ($what_do_we_offer) : ?>
                        <?php echo $what_do_we_offer; ?>
                    <?php endif; ?>
                    <?php if ($key_responsibilities) : ?>
                        <?php echo $key_responsibilities; ?>
                    <?php endif; ?>
                    <?php if ($how_to_apply) : ?>
                        <?php echo $how_to_apply; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="ae_job-listing-right"></div>
    </div>

<?php else : ?>

    <?php get_job_manager_template_part('access-denied', 'single-job_listing'); ?>

<?php endif; ?>