<?php

/**
 * Shortcode parent file for the affiliates jobs display widget.
 */
function affiliates_jobs_display_widget() {
    // Enqueue our JS file
    wp_enqueue_script(
        'affiliates-jobs-fetch',
        plugins_url( '../assets/js/affiliates-jobs-fetch.js', __FILE__ ),
        array(),
        '1.0',
        true
    );

    // Create a global variable to store the REST API URL and perPage value
    // This will be used in the JS file to fetch data
    // Use get_rest_url() to ensure the correct URL for the current site (works in multisite)
    wp_localize_script( 'affiliates-jobs-fetch', 'affiliatesJobs', array(
        'restUrl' => get_rest_url( null, 'affiliates/v1/jobs' ), // Use get_rest_url()
        'perPage' => 5
    ) );

    ob_start();
    include plugin_dir_path( __FILE__ ) . '../templates/affiliates-jobs-display.php';
    return ob_get_clean();
}
add_shortcode('affiliates_portal_jobs', 'affiliates_jobs_display_widget');