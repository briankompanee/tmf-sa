<?php

namespace App;

function load_request( $route, $company_symbol) {

    $request = NULL;
    $response_code = NULL;
    $response_message = NULL;

    // Check for transient
    if ( false === ( $response_body = get_transient( 'api_request_body' ) ) ) {

        // Set in wp-config.php
        $apiKey = API_KEY;
        $url = 'https://financialmodelingprep.com/api/v3/' . $route . $company_symbol . '?apikey='. $apiKey;

        // Send remote request
        $request = wp_safe_remote_get($url);

        // Retrieve information
        $response_code = wp_remote_retrieve_response_code($request);
        $response_message = wp_remote_retrieve_response_message($request);
        $response_body = wp_remote_retrieve_body($request);

    }

    if ( is_array( $request ) && ! is_wp_error( $request ) ) {

        if ( $response_code == '200' ) {

            return $response_body;

        }

	 set_transient( 'api_request_body', $response_body, 30 * MINUTE_IN_SECONDS );

	} else {

            echo '<div class="alert alert-danger" role="alert">API Error';

            if ( $response_code) {
                echo '<p>Response Code:' . $response_code . '</p>';
            }

            if ( $response_message) {
                echo '<p>Response Message:' . $response_message . '</p>';
            }

            if ( $response_body) {
                echo '<p>Response Message:' . $response_body . '</p>';
            }
            echo '</div>';
     }
}