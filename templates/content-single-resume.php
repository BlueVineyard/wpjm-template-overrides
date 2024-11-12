<?php

/**
 * Content for a single resume.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/content-single-resume.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager-resumes
 * @category    Template
 * @version     1.7.0
 */

if (! defined('ABSPATH')) {
    exit;
}

if (resume_manager_user_can_view_resume($post->ID)) : ?>
    <style>
        #ae_resume {
            padding-top: 56px;
        }

        #ae_resume .ae_resume_header {
            position: relative;
            border: 1px solid #e4e4e4;
            border-radius: 16px;
        }

        #ae_resume .ae_resume_header .ae_resume_header_img {
            width: 100%;
            border-radius: 16px 16px 0 0;
        }

        #ae_resume .ae_resume_header .ae_resume_header-content {
            margin-top: -74px;
            padding: 0 40px 40px;

            display: flex;
            flex-wrap: wrap;
        }

        #ae_resume .ae_resume_header .ae_resume_header-content .ae_resume_header-left {
            width: 100%;
            max-width: 50%;
        }

        #ae_resume .ae_resume_header .ae_resume_header-content .ae_resume_header-right {
            width: 100%;
            max-width: 50%;

            padding-top: calc(74px + 38px);

            display: flex;
            column-gap: 32px;
            row-gap: 24px;
            flex-wrap: wrap;
        }

        #ae_resume .ae_resume_header .ae_resume_header-content .candidate_photo {
            width: 148px;
            height: 148px;
            object-fit: contain;
            border-radius: 50%;
            border: 2px solid #fff;
            background: #e2e8f0;
        }

        #ae_resume .ae_resume_header .ae_resume_header-content .candidate_title {
            font-size: 26px;
            color: #101010;
            line-height: 132%;
            font-weight: bold;
        }

        #ae_resume .ae_resume_header .ae_resume_header-content .ae_resume_header-meta {
            margin-top: 12px;
            display: flex;
            align-items: center;
            column-gap: 16px;
        }

        #ae_resume .ae_resume_header .ae_resume_header-content .ae_resume_header-meta .ae_resume_header-meta-divider {
            display: inline-block;
            width: 1px;
            height: 20px;
            background-color: #a4a4a4;

        }

        #ae_resume .ae_resume_header .ae_resume_header-content .ae_resume_header-meta .candidate_location_wrapper {
            display: flex;
            align-items: center;
            column-gap: 3px;
        }

        #ae_resume .ae_resume_header .ae_resume_header-content .ae_resume_header-meta .candidate_location_wrapper a {
            font-size: 20px;
            font-weight: 400;
            line-height: 148%;
            color: #101010;
        }

        #ae_resume .ae_resume_header .ae_resume_header-content .ae_resume_header-meta .candidate_availability_wrapper {
            display: flex;
            align-items: center;
            column-gap: 10px;
        }

        #ae_resume .ae_resume_header .ae_resume_header-content .ae_resume_header-meta .candidate_availability_wrapper .availability_icon {
            display: inline-block;
            width: 12px;
            height: 12px;
            background-color: #17B86A;
            box-shadow: 0 0 0 3px rgba(23, 184, 106, 0.16);
            border-radius: 50%;
        }

        #ae_resume .ae_resume_header .ae_resume_header-content .ae_resume_header-meta .candidate_availability_wrapper span {
            font-size: 20px;
            font-weight: 400;
            line-height: 148%;
            color: #101010;
        }

        #ae_resume .ae_icon-box {
            display: flex;
            align-items: center;
            column-gap: 16px;
            width: fit-content;
        }

        #ae_resume .ae_icon-box .ae_icon-box-icon {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            padding: 13px;
        }

        #ae_resume .ae_resume_header .ae_resume_header-content .ae_resume_header-right .ae_icon-box-icon {
            background-color: #16D5E9;
        }

        #ae_resume .ae_icon-box .ae_icon-box-info h6 {
            font-size: 16px;
            font-weight: 400;
            line-height: 148%;
            color: #757575;
            margin-bottom: 2px;
        }

        #ae_resume .ae_icon-box .ae_icon-box-info a,
        #ae_resume .ae_icon-box .ae_icon-box-info span {
            font-size: 18px;
            font-weight: 600;
            line-height: 148%;
            color: #101010;
        }

        #ae_resume .ae_resume_body {
            margin-top: 20px;
            display: flex;
            column-gap: 20px;
            align-items: flex-start;
            justify-content: space-between;
            position: relative;
            /* flex-wrap: wrap; */
        }

        #ae_resume .ae_resume_body .ae_resume_body-left {
            display: flex;
            flex-wrap: wrap;
            row-gap: 20px;
            width: 100%;
            max-width: calc(852px);
        }

        #ae_resume .ae_resume_body .ae_resume_body-left .ae_resume_body-card {
            width: 100%;
        }

        #ae_resume .ae_resume_body .ae_resume_body-right {
            width: 100%;
            max-width: calc(408px - 20px);

            background-color: #FAFAFA;
            border: 1px solid #DADADA;
            border-radius: 8px;
            padding: 24px;
        }

        #ae_resume .ae_resume_body .ae_resume_body-right .ae_icon-box {
            margin-bottom: 20px;
        }

        #ae_resume .ae_resume_body .ae_resume_body-right .ae_icon-box:last-child {
            margin-bottom: 0px;
        }

        #ae_resume .ae_resume_body .ae_resume_body-right .ae_icon-box .ae_icon-box-icon {
            background-color: #EEEEEE;
        }

        #ae_resume .ae_resume_body .ae_resume_body-card {
            padding: 28px;
            border: 1px solid #e4e4e4;
            border-radius: 8px;

            font-size: 18px;
            font-weight: 500;
            line-height: 148%;
        }

        #ae_resume .ae_resume_body .ae_resume_body-card h2,
        #ae_resume .ae_resume_body .ae_resume_body-right h2 {
            font-size: 24px;
            font-weight: bold;
            line-height: 148%;
            color: #101010;
            margin-bottom: 12px;
        }

        #ae_resume .ae_resume_body .ae_resume_body-right .ae_resume-file {
            margin-top: 24px;
        }

        #ae_resume .ae_resume_body .ae_resume_body-right .ae_resume-file h3 {
            font-size: 20px;
            font-weight: 600;
            line-height: 148%;
            color: #101010;
            margin-bottom: 12px;
        }

        #ae_resume .ae_resume_body .ae_resume_body-right .ae_resume-file a {
            background-color: #fff;
            padding: 12px 14px;
            border-radius: 8px;
            width: 100%;
            height: 71px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        #ae_resume .ae_resume_body .ae_resume_body-right .ae_resume-file a span {
            font-size: 16px;
            font-weight: 600;
            line-height: 148%;
            color: #101010;
        }

        #ae_resume .ae_resume_body .ae_resume_body-card h3 {
            font-size: 18px;
            font-weight: 600;
            line-height: 148%;
            color: #101010;
            margin-bottom: 4px;
        }

        #ae_resume .ae_resume_body .ae_resume_body-card .ae_resume-subtitle {
            font-size: 16px;
            font-weight: 600;
            line-height: 148%;
            color: #101010;
            margin-bottom: 4px;
        }

        #ae_resume .ae_resume_body .ae_resume_body-card .ae_resume-date {
            font-size: 16px;
            font-weight: 400;
            line-height: 148%;
            color: #101010;
            margin-bottom: 12px;
        }

        #ae_resume .ae_resume_body .ae_resume_body-card .ae_resume-skill {
            background-color: #E8E8E8;
            padding: 8px 16px;
            font-size: 16px;
            font-weight: 600;
            line-height: 132%;
            color: #101010;
            margin-right: 8px;
            border-radius: 50px;
        }

        #ae_resume .ae_resume_body .ae_resume_body-card hr {
            margin: 20px 0;
            width: 100%;
            border: 1px solid #e4e4e4;
        }

        #ae_resume .ae_resume_body .ae_resume_body-card hr:last-child {
            display: none;
        }

        #ae_resume .ae_resume_body .toggle-text-link,
        .ae-toggle-text .toggle-link {
            color: #FF8200;
        }
    </style>
    <div class="single-resume-content ct-section-inner-wrap" id="ae_resume">

        <?php
        $candidate_email = get_post_meta($post->ID, '_candidate_email', true);
        $candidate_availability = get_post_meta($post->ID, '_candidate_availability', true);
        $candidate_resume = get_post_meta($post->ID, '_resume_file', true);
        $candidate_role = get_post_meta($post->ID, '_candidate_title', true);
        $candidate_location = get_post_meta($post->ID, '_candidate_location', true);
        $candidate_right_to_work = get_post_meta($post->ID, '_candidate_right_to_work', true);
        $candidate_preferred_work_type = get_post_meta($post->ID, '_candidate_preferred_work_type', true);
        ?>

        <div class="ae_resume_header">
            <img class="ae_resume_header_img" src="/wp-content/uploads/2024/08/resume_header.png" alt="Single Resume Header">
            <div class="ae_resume_header-content">
                <div class="ae_resume_header-left">
                    <?php the_candidate_photo(); ?>
                    <h1 class="candidate_title"><?php echo get_the_title(); ?><?php do_action('single_resume_start'); ?></h1>
                    <div class="ae_resume_header-meta">
                        <div class="candidate_location_wrapper">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4 10.1433C4 5.64588 7.58172 2 12 2C16.4183 2 20 5.64588 20 10.1433C20 14.6055 17.4467 19.8124 13.4629 21.6744C12.5343 22.1085 11.4657 22.1085 10.5371 21.6744C6.55332 19.8124 4 14.6055 4 10.1433Z"
                                    stroke="#101010" stroke-width="1.5" />
                                <circle cx="12" cy="10" r="3" stroke="#101010" stroke-width="1.5" />
                            </svg>
                            <?php the_candidate_location(); ?>
                        </div>
                        <?php if ($candidate_availability == 1) : ?>
                            <span class="ae_resume_header-meta-divider"></span>
                            <div class="candidate_availability_wrapper">
                                <span class="availability_icon"></span>
                                <span>Available for Work</span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="ae_resume_header-right">
                    <div class="ae_icon-box">
                        <div class="ae_icon-box-icon">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.7694 1.4585H15.228C16.5496 1.45847 17.6297 1.45845 18.4823 1.57308C19.3736 1.69291 20.1463 1.95224 20.7631 2.56905C21.38 3.18586 21.6393 3.95859 21.7591 4.84986C21.818 5.28819 21.8467 5.78659 21.8606 6.347C23.0952 6.54617 24.107 6.93824 24.9172 7.74851C25.7903 8.6216 26.1778 9.7287 26.3617 11.0965C26.5404 12.4256 26.5404 14.1239 26.5404 16.2679V16.3995C26.5404 18.5436 26.5404 20.2418 26.3617 21.5709C26.1778 22.9387 25.7903 24.0459 24.9172 24.9189C24.0442 25.792 22.937 26.1795 21.5692 26.3634C20.2401 26.5421 18.5419 26.5421 16.3978 26.5421H11.5996C9.4555 26.5421 7.75726 26.5421 6.42817 26.3634C5.06035 26.1795 3.95324 25.792 3.08015 24.9189C2.20706 24.0459 1.81959 22.9387 1.63569 21.5709C1.457 20.2418 1.45701 18.5436 1.45703 16.3995V16.2679C1.45701 14.1239 1.457 12.4256 1.63569 11.0965C1.81959 9.7287 2.20706 8.6216 3.08015 7.74851C3.89041 6.93824 4.90222 6.54617 6.13682 6.347C6.15072 5.78659 6.17935 5.28819 6.23828 4.84986C6.35811 3.95859 6.61744 3.18586 7.23425 2.56905C7.85106 1.95224 8.62379 1.69291 9.51506 1.57308C10.3677 1.45845 11.4478 1.45847 12.7694 1.4585ZM6.1237 8.12732C5.27088 8.29852 4.7304 8.57313 4.31759 8.98594C3.82384 9.47969 3.52789 10.1559 3.37008 11.3297C3.20889 12.5287 3.20703 14.1091 3.20703 16.3337C3.20703 18.5583 3.20889 20.1388 3.37008 21.3377C3.52789 22.5115 3.82384 23.1878 4.31759 23.6815C4.81133 24.1753 5.48758 24.4712 6.66135 24.629C7.8603 24.7902 9.44074 24.7921 11.6654 24.7921H16.332C18.5567 24.7921 20.1371 24.7902 21.336 24.629C22.5098 24.4712 23.1861 24.1753 23.6798 23.6815C24.1736 23.1878 24.4695 22.5115 24.6273 21.3377C24.7885 20.1388 24.7904 18.5583 24.7904 16.3337C24.7904 14.1091 24.7885 12.5287 24.6273 11.3297C24.4695 10.1559 24.1736 9.47969 23.6798 8.98594C23.267 8.57313 22.7265 8.29852 21.8737 8.12732V9.48108C21.8737 9.53491 21.8738 9.58809 21.8738 9.64064C21.8748 10.5577 21.8756 11.2841 21.5708 11.9348C21.266 12.5855 20.7075 13.0499 20.0024 13.6363C19.962 13.6699 19.9211 13.7039 19.8797 13.7383L18.9963 14.4745C17.9622 15.3363 17.1241 16.0347 16.3843 16.5105C15.6137 17.0061 14.8633 17.3192 13.9987 17.3192C13.1341 17.3192 12.3837 17.0061 11.6131 16.5105C10.8733 16.0347 10.0352 15.3363 9.00113 14.4745L8.11768 13.7383C8.07633 13.7039 8.03544 13.6699 7.99504 13.6363C7.28989 13.0499 6.73137 12.5855 6.4266 11.9348C6.12183 11.2841 6.12261 10.5577 6.12359 9.64063C6.12364 9.58808 6.1237 9.53491 6.1237 9.48108L6.1237 8.12732ZM9.74825 3.30748C9.05103 3.40122 8.70915 3.56903 8.47169 3.80649C8.23423 4.04395 8.06642 4.38583 7.97268 5.08305C7.87556 5.80544 7.8737 6.76717 7.8737 8.16683V9.48108C7.8737 10.6376 7.89303 10.9398 8.01138 11.1925C8.12973 11.4452 8.34953 11.6535 9.238 12.3939L10.0776 13.0936C11.166 14.0006 11.9217 14.6283 12.5597 15.0386C13.1773 15.4359 13.5961 15.5692 13.9987 15.5692C14.4013 15.5692 14.8201 15.4359 15.4377 15.0386C16.0757 14.6283 16.8314 14.0006 17.9198 13.0936L18.7594 12.3939C19.6479 11.6535 19.8677 11.4452 19.986 11.1925C20.1044 10.9398 20.1237 10.6376 20.1237 9.48108V8.16683C20.1237 6.76717 20.1218 5.80544 20.0247 5.08305C19.931 4.38583 19.7632 4.04395 19.5257 3.80649C19.2882 3.56903 18.9464 3.40122 18.2491 3.30748C17.5268 3.21036 16.565 3.2085 15.1654 3.2085H12.832C11.4324 3.2085 10.4706 3.21036 9.74825 3.30748ZM10.7904 7.00016C10.7904 6.51692 11.1821 6.12516 11.6654 6.12516H16.332C16.8153 6.12516 17.207 6.51692 17.207 7.00016C17.207 7.48341 16.8153 7.87516 16.332 7.87516H11.6654C11.1821 7.87516 10.7904 7.48341 10.7904 7.00016ZM11.957 10.5002C11.957 10.0169 12.3488 9.62516 12.832 9.62516H15.1654C15.6486 9.62516 16.0404 10.0169 16.0404 10.5002C16.0404 10.9834 15.6486 11.3752 15.1654 11.3752H12.832C12.3488 11.3752 11.957 10.9834 11.957 10.5002Z"
                                    fill="white" />
                            </svg>
                        </div>
                        <div class="ae_icon-box-info">
                            <h6>Email Address</h6>
                            <a href="mailto:<?php echo $candidate_email; ?>"><?php echo $candidate_email; ?></a>
                        </div>
                    </div>
                    <div class="ae_icon-box">
                        <div class="ae_icon-box-icon">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M6.68943 2.3835C8.10965 0.971347 10.4481 1.22271 11.6373 2.81123L13.1084 4.77636C14.0761 6.06889 13.9907 7.87537 12.8421 9.01744L12.5635 9.29442C12.5514 9.32976 12.5219 9.44084 12.5546 9.65195C12.6284 10.1274 13.0254 11.1358 14.692 12.793C16.358 14.4495 17.3736 14.8461 17.8557 14.9201C18.0743 14.9536 18.1885 14.9224 18.2239 14.91L18.6999 14.4367C19.721 13.4215 21.29 13.2317 22.5542 13.9189L24.7831 15.1306C26.6918 16.1681 27.174 18.7625 25.6103 20.3173L23.953 21.9652C23.4308 22.4844 22.7286 22.9174 21.8716 22.9972C19.761 23.194 14.8398 22.9429 9.66899 17.8015C4.84143 13.0013 3.91502 8.81534 3.79781 6.75287L4.6714 6.70322L3.79781 6.75287C3.73854 5.70997 4.23136 4.82762 4.85823 4.20431L6.68943 2.3835ZM10.2364 3.85999C9.6453 3.07046 8.54364 3.00768 7.92334 3.62446L6.09214 5.44526C5.70723 5.82799 5.52204 6.24977 5.54499 6.65358C5.63812 8.29227 6.3863 12.0696 10.9029 16.5605C15.6413 21.272 20.0176 21.4125 21.7091 21.2548C22.0547 21.2226 22.3984 21.043 22.7191 20.7242L24.3764 19.0763C25.0501 18.4065 24.9015 17.1868 23.9473 16.6681L21.7184 15.4564C21.1029 15.1218 20.3819 15.2322 19.9338 15.6777L19.4025 16.206L18.7855 15.5855C19.4025 16.206 19.4017 16.2069 19.4008 16.2077L19.3991 16.2094L19.3956 16.2128L19.388 16.2201L19.3709 16.236C19.3586 16.2472 19.3446 16.2595 19.3287 16.2726C19.2971 16.2989 19.2581 16.3286 19.2115 16.3598C19.1181 16.4224 18.9947 16.4904 18.8398 16.5482C18.5237 16.6659 18.107 16.7291 17.5904 16.6499C16.5792 16.4948 15.2395 15.8053 13.4581 14.0339C11.6772 12.2632 10.9819 10.9297 10.8253 9.92024C10.7452 9.40404 10.8091 8.98719 10.9282 8.67096C10.9866 8.51598 11.0554 8.39275 11.1186 8.29954C11.1501 8.25306 11.1801 8.21419 11.2065 8.18263C11.2197 8.16684 11.2321 8.15287 11.2433 8.14065L11.2594 8.12364L11.2667 8.1161L11.2702 8.11257L11.2719 8.11087C11.2727 8.11003 11.2736 8.1092 11.8905 8.72968L11.2736 8.1092L11.6082 7.77649C12.1082 7.27929 12.1783 6.45393 11.7075 5.82513L10.2364 3.85999Z"
                                    fill="white" />
                            </svg>
                        </div>
                        <div class="ae_icon-box-info">
                            <h6>Phone Number</h6>
                            <a href="tel:+03 9876 5432">+03 9876 5432</a>
                        </div>
                    </div>
                    <div class="ae_icon-box">
                        <div class="ae_icon-box-icon">
                            <svg width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.6387 3.28147C6.64374 3.92364 6.39581 4.54199 5.94854 5.00282C5.50127 5.46364 4.89059 5.72991 4.24856 5.74404C3.60786 5.72076 3.00061 5.45221 2.55231 4.99389C2.10401 4.53557 1.84895 3.92252 1.83984 3.28147C1.86753 2.65673 2.13186 2.06593 2.57919 1.62895C3.02652 1.19196 3.62335 0.94153 4.24856 0.928467C4.87192 0.94178 5.46663 1.19284 5.91096 1.63026C6.35528 2.06768 6.61563 2.65839 6.6387 3.28147ZM2.09799 10.1195C2.09799 8.70432 2.9987 8.92532 4.24856 8.92532C5.49841 8.92532 6.38056 8.70432 6.38056 10.1195V23.9069C6.38056 25.3406 5.47984 25.0472 4.24856 25.0472C3.01727 25.0472 2.09799 25.3406 2.09799 23.9069V10.1195ZM10.0948 10.1213C10.0948 9.33018 10.3883 9.0349 10.847 8.9439C11.3057 8.8529 12.888 8.9439 13.4396 8.9439C13.9911 8.9439 14.2121 9.84461 14.1936 10.5243C14.6659 9.89196 15.2922 9.39102 16.0129 9.06919C16.7336 8.74736 17.5247 8.61536 18.3108 8.68575C19.0829 8.63861 19.8563 8.7544 20.5808 9.0256C21.3052 9.2968 21.9645 9.71734 22.5158 10.2599C23.0672 10.8025 23.4982 11.455 23.781 12.175C24.0637 12.895 24.1919 13.6664 24.1571 14.4392V23.8512C24.1571 25.2849 23.275 24.9915 22.0233 24.9915C20.7734 24.9915 19.8913 25.2849 19.8913 23.8512V16.4988C19.9236 16.1204 19.8742 15.7395 19.7463 15.382C19.6185 15.0244 19.4151 14.6986 19.1502 14.4265C18.8852 14.1545 18.5648 13.9427 18.2107 13.8055C17.8567 13.6683 17.4772 13.6089 17.0981 13.6313C16.7205 13.6214 16.3451 13.6918 15.9968 13.838C15.6485 13.9841 15.3352 14.2026 15.0778 14.4791C14.8203 14.7555 14.6246 15.0835 14.5035 15.4413C14.3825 15.7991 14.3388 16.1785 14.3756 16.5545V23.9069C14.3756 25.3406 13.4748 25.0472 12.225 25.0472C10.9751 25.0472 10.093 25.3406 10.093 23.9069V10.1195L10.0948 10.1213Z"
                                    stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="ae_icon-box-info">
                            <h6>LinkedIn</h6>
                            <a href="#"><?php echo get_the_title(); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ae_resume_body">
            <div class="ae_resume_body-left">
                <div class="ae_resume_body-summary ae_resume_body-card toggle-text">
                    <h2>Personal Summary</h2>
                    <?php echo apply_filters('the_resume_description', get_the_content()); ?>
                </div>

                <?php if ($items = get_post_meta($post->ID, '_candidate_experience', true)) : ?>
                    <div class="ae_resume_body-career ae_resume_body-card">
                        <h2>Careers History</h2>
                        <?php foreach ($items as $item) : ?>
                            <div>
                                <h3><?php echo esc_html($item['job_title']); ?></h3>
                                <strong class="ae_resume-subtitle"><?php echo esc_html($item['employer']); ?></strong>
                                <div>
                                    <span class="ae_resume-date"><?php echo esc_html($item['date']); ?></span>
                                </div>
                                <?php echo wpautop(wptexturize($item['notes'])); ?>
                            </div>

                            <hr>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($items = get_post_meta($post->ID, '_candidate_education', true)) : ?>
                    <div class="ae_resume_body-education ae_resume_body-card">
                        <h2>Education</h2>
                        <?php foreach ($items as $item) : ?>
                            <div>
                                <h3><?php echo esc_html($item['qualification']); ?></h3>
                                <strong class="ae_resume-subtitle"><?php echo esc_html($item['location']); ?></strong>
                                <div>
                                    <span class="ae_resume-date"><?php echo esc_html($item['date']); ?></span>
                                </div>
                                <div class="ae-toggle-text">
                                    <?php echo wpautop(wptexturize($item['notes'])); ?>
                                </div>
                            </div>

                            <hr>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($items = get_post_meta($post->ID, '_resume_certifications', true)) : ?>
                    <div class="ae_resume_body-certification ae_resume_body-card">
                        <h2>Licences & Certifications</h2>
                        <?php foreach ($items as $item) : ?>
                            <div>
                                <h3><?php echo esc_html($item['licence_name']); ?></h3>
                                <strong class="ae_resume-subtitle"><?php echo esc_html($item['licence_issuer']); ?></strong>
                                <div>
                                    <span class="ae_resume-date">Issue Date: <?php echo esc_html($item['issue_date']); ?></span>
                                    <span class="ae_resume-date">Expiry Date: <?php echo esc_html($item['expiry_date']); ?></span>
                                </div>
                            </div>

                            <hr>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if (($skills = wp_get_object_terms($post->ID, 'resume_skill', ['fields' => 'names'])) && is_array($skills)) : ?>
                    <div class="ae_resume_body-skills ae_resume_body-card">
                        <h2>Professional Skills</h2>
                        <?php echo '<span class="ae_resume-skill">' . implode('</span><span class="ae_resume-skill">', $skills) . '</span>'; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="ae_resume_body-right">
                <h2>More Informations</h2>
                <!-- Role -->
                <?php if ($candidate_role) : ?>
                    <div class="ae_icon-box">
                        <div class="ae_icon-box-icon">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="13.9987" cy="7.00016" r="4.66667" stroke="#101010" stroke-width="1.8" />
                                <path d="M17.5013 15.5481C16.4205 15.302 15.239 15.1665 14.0013 15.1665C8.84664 15.1665 4.66797 17.517 4.66797 20.4165C4.66797 23.316 4.66797 25.6665 14.0013 25.6665C20.6366 25.6665 22.5547 24.4785 23.1092 22.7498" stroke="#101010" stroke-width="1.8" />
                                <circle cx="20.9987" cy="18.6667" r="4.66667" stroke="#101010" stroke-width="1.8" />
                                <path d="M21 17.1111V20.2222" stroke="#101010" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M19.4434 18.6667L22.5545 18.6667" stroke="#101010" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="ae_icon-box-info">
                            <h6>Role</h6>
                            <span><?php echo $candidate_role; ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Right to Work -->
                <?php if ($candidate_right_to_work) : ?>
                    <div class="ae_icon-box">
                        <div class="ae_icon-box-icon">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.5 12.1527C3.5 8.42217 3.5 6.55691 3.94043 5.9294C4.38087 5.30188 6.13471 4.70154 9.6424 3.50084L10.3107 3.27209C12.1391 2.6462 13.0534 2.33325 14 2.33325C14.9466 2.33325 15.8609 2.6462 17.6893 3.27209L18.3576 3.50084C21.8653 4.70154 23.6191 5.30188 24.0596 5.9294C24.5 6.55691 24.5 8.42217 24.5 12.1527C24.5 12.7162 24.5 13.3272 24.5 13.9898C24.5 20.5676 19.5545 23.7597 16.4517 25.1151C15.61 25.4827 15.1891 25.6666 14 25.6666C12.8109 25.6666 12.39 25.4827 11.5483 25.1151C8.44546 23.7597 3.5 20.5676 3.5 13.9898C3.5 13.3272 3.5 12.7162 3.5 12.1527Z" stroke="#101010" stroke-width="1.8" />
                                <circle cx="14.0013" cy="10.4998" r="2.33333" stroke="#101010" stroke-width="1.8" />
                                <path d="M18.6654 17.4998C18.6654 18.7885 18.6654 19.8332 13.9987 19.8332C9.33203 19.8332 9.33203 18.7885 9.33203 17.4998C9.33203 16.2112 11.4214 15.1665 13.9987 15.1665C16.576 15.1665 18.6654 16.2112 18.6654 17.4998Z" stroke="#101010" stroke-width="1.8" />
                            </svg>

                        </div>
                        <div class="ae_icon-box-info">
                            <h6>Right to Work</h6>
                            <span><?php echo $candidate_right_to_work; ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Preferred Work Type -->
                <?php if ($candidate_preferred_work_type) : ?>
                    <div class="ae_icon-box">
                        <div class="ae_icon-box-icon">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="10.5013" cy="10.4998" r="2.33333" stroke="#101010" stroke-width="1.8" />
                                <path d="M15.1654 17.4998C15.1654 18.7885 15.1654 19.8332 10.4987 19.8332C5.83203 19.8332 5.83203 18.7885 5.83203 17.4998C5.83203 16.2112 7.92137 15.1665 10.4987 15.1665C13.076 15.1665 15.1654 16.2112 15.1654 17.4998Z" stroke="#101010" stroke-width="1.8" />
                                <path d="M2.33203 13.9998C2.33203 9.60006 2.33203 7.40017 3.69887 6.03334C5.0657 4.6665 7.26559 4.6665 11.6654 4.6665H16.332C20.7318 4.6665 22.9317 4.6665 24.2985 6.03334C25.6654 7.40017 25.6654 9.60006 25.6654 13.9998C25.6654 18.3996 25.6654 20.5995 24.2985 21.9663C22.9317 23.3332 20.7318 23.3332 16.332 23.3332H11.6654C7.26559 23.3332 5.0657 23.3332 3.69887 21.9663C2.33203 20.5995 2.33203 18.3996 2.33203 13.9998Z" stroke="#101010" stroke-width="1.8" />
                                <path d="M22.168 14H17.5013" stroke="#101010" stroke-width="1.8" stroke-linecap="round" />
                                <path d="M22.168 10.5H16.3346" stroke="#101010" stroke-width="1.8" stroke-linecap="round" />
                                <path d="M22.168 17.5H18.668" stroke="#101010" stroke-width="1.8" stroke-linecap="round" />
                            </svg>

                        </div>
                        <div class="ae_icon-box-info">
                            <h6>Preferred Work Types</h6>
                            <span><?php echo $candidate_preferred_work_type; ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Preferred Location -->
                <?php if ($candidate_location) : ?>
                    <div class="ae_icon-box">
                        <div class="ae_icon-box-icon">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.66797 11.834C4.66797 6.58702 8.84664 2.3335 14.0013 2.3335C19.156 2.3335 23.3346 6.58702 23.3346 11.834C23.3346 17.0399 20.3558 23.1146 15.7081 25.287C14.6246 25.7934 13.378 25.7934 12.2945 25.287C7.64685 23.1146 4.66797 17.0399 4.66797 11.834Z" stroke="#101010" stroke-width="1.8" />
                                <circle cx="14" cy="11.6667" r="3.5" stroke="#101010" stroke-width="1.8" />
                            </svg>

                        </div>
                        <div class="ae_icon-box-info">
                            <h6>Preferred Locations</h6>
                            <span><?php echo $candidate_location; ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Resume -->
                <?php if ($candidate_resume) : ?>
                    <div class="ae_resume-file">
                        <h3>File Attachment</h3>
                        <a target="_blank" href="<?php echo $candidate_resume; ?>">
                            <span>Download Resume</span>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 16.5V18.75C3 19.3467 3.23705 19.919 3.65901 20.341C4.08097 20.7629 4.65326 21 5.25 21H18.75C19.3467 21 19.919 20.7629 20.341 20.341C20.7629 19.919 21 19.3467 21 18.75V16.5M16.5 12L12 16.5M12 16.5L7.5 12M12 16.5V3" stroke="#FF8200" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>



        <ul class="meta">
            <?php do_action('single_resume_meta_start'); ?>

            <?php if (get_the_resume_category()) : ?>
                <li class="resume-category"><?php the_resume_category(); ?></li>
            <?php endif; ?>

            <?php do_action('single_resume_meta_end'); ?>
        </ul>



    </div>
    <?php do_action('single_resume_end'); ?>

<?php else : ?>

    <?php get_job_manager_template_part('access-denied', 'single-resume', 'wp-job-manager-resumes', RESUME_MANAGER_PLUGIN_DIR . '/templates/'); ?>

<?php endif; ?>