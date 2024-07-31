<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
//--------------------------- Redirect Login/logout Page ---------------------------//
//Disable WordPress Login page access 
$options = get_option('AJDWP_theme_options');
if (!empty($options['redirect_login_page'])) {
    function custom_login_url() {
        $options = get_option('AJDWP_theme_options');
        wp_redirect(esc_url($options['login_page_url']));
        exit();
    }

    add_action('login_form', 'custom_login_url');

}
?>