<?php
/**
 * Plugin Name:       Free WP Github Webhooks
 * Description:       Free plugin for setting up Github webhooks for CI/CD
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Tom Do
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'add_carbon_fields' );
function add_carbon_fields() {
    Container::make( 'theme_options', __( 'Free WP Webhooks' ) )
        ->add_fields([
            Field::make( 'text', 'fwpgw_access_token', 'Access Token' ),
            Field::make( 'text', 'fwpgw_endpoint', 'Github Webhook URL (Ends in /dispatches for workflow_dispatch)' ),
            Field::make( 'text', 'fwpgw_branch', 'Github Branch' ),
        ]);
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

//Run webhook on post update and create.
// if you don't add 3 as as 4th argument, this will not work as expected
add_action( 'save_post', 'fwpgw_gh_webhooks', 10, 3 );
function fwpgw_gh_webhooks( $post_ID, $post, $update ) {
	if( wp_is_post_revision( $post_ID) || wp_is_post_autosave( $post_ID )) { 
		// Guard Break
		return; 
	}
	$url = carbon_get_theme_option('fwpgw_endpoint');
    $token = carbon_get_theme_option('fwpgw_access_token');
    $branch = carbon_get_theme_option('fwpgw_branch');
	$data = '{"ref": "' . $branch . '"}';

	$additional_headers = array(                                                                          
   		'Accept: application/vnd.github+json',
		'Authorization: Bearer ' . $token,
		'user-agent: php',
	);

	$ch = curl_init($url);                                                                      
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);                                                                  
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
	curl_setopt($ch, CURLOPT_HTTPHEADER, $additional_headers); 

	curl_exec($ch);
}