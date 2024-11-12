<?php
function wpjms_admin_resume_form_fields($fields)
{
    $fields['_candidate_right_to_work'] = array(
        'label' => __('Right to Work', 'job_manager'),
        'type' => 'select',
        'options' => array(
            '' => __('Select an Option', 'job_manager'),
            'australian-citizen' => __('Australian Citizen', 'job_manager'),
            'foreign-citizen' => __('Foreign Citizen', 'job_manager'),
        ),
        'placeholder' => __('Select an Option', 'job_manager'),
        'priority' => 1
    );

    $fields['_candidate_preferred_work_type'] = array(
        'label' => __('Preferred Work Types', 'job_manager'),
        'type' => 'select',
        'options' => array(
            '' => __('Select your Preferred Work Type', 'job_manager'),
            'full-time' => __('Full-Time', 'job_manager'),
            'part-time' => __('Part-Time', 'job_manager'),
            'contract' => __('Contract', 'job_manager'),
            'casual' => __('Casual', 'job_manager'),
        ),
        'placeholder' => __('Select your Preferred Work Type', 'job_manager'),
        'priority' => 1
    );

    $fields['_candidate_availability'] = array(
        'label' => __('Available for Work?', 'job_manager'),
        'type' => 'checkbox',
        'description' => __('Check if you are currently Available for Work.', 'job_manager'),
        'priority' => 9,
        'data_type' => 'integer',
        'show_in_admin' => true,
        'show_in_rest' => true,
    );

    return $fields;
}
add_filter('resume_manager_resume_fields', 'wpjms_admin_resume_form_fields');

function wpjms_admin_resume_education_form_fields($fields)
{
    $fields['qualification_complete'] = array(
        'label' => __('Qualification Complete', 'job_manager'),
        'name' => 'resume_education_qualification[]',
        'type' => 'checkbox',
        'data_type' => 'integer',
        'show_in_admin' => true,
        'show_in_rest' => true,
        'priority' => 1,
    );

    return $fields;
}
add_filter('resume_manager_resume_education_fields', 'wpjms_admin_resume_education_form_fields');


function wpjms_frontend_resume_form_fields($fields)
{
    $fields['resume_fields']['candidate_right_to_work'] = array(
        'label' => __('Right to Work', 'job_manager'),
        'type' => 'text',
        'placeholder' => __('Australia Citizen', 'job_manager'),
        'required' => true,
        'priority' => 1
    );

    $fields['resume_fields']['candidate_preferred_work_type'] = array(
        'label' => __('Preferred Work Types', 'job_manager'),
        'type' => 'text',
        'required' => true,
        'priority' => 1
    );

    $fields['resume_fields']['candidate_availability'] = array(
        'label' => __('Available for Work?', 'job_manager'),
        'type' => 'checkbox',
        'description' => __('Check if you are currently Available for Work.', 'job_manager'),
        'priority' => 9,
        'data_type' => 'integer',
        'show_in_admin' => true,
        'show_in_rest' => true,
    );

    return $fields;
}
add_filter('submit_resume_form_fields', 'wpjms_frontend_resume_form_fields');
