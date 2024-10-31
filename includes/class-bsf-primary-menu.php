<?php 
/**
 * Functions related to primary login/logout Nav
 *
 * @package PRIMARY-LOGIN-LOGOUT-MENU
 */

add_filter( 'wp_nav_menu_items', 'bsf_loginout_menu_link', 10, 2 );

/**
 * For rendering the search box.
 *
 * @param int $atts Get attributes for the search field.
 * @param int $content Get content to search from.
 */
function bsf_loginout_menu_link( $items, $args ) {
   if ($args->theme_location == 'primary') {
      if (is_user_logged_in()) {
         $items .= '<li id="logout"><a href="'. wp_logout_url() .'">'. __("Log Out") .'</a></li>';
      } else {
         $items .= '<li id="login"><a href="'. wp_login_url(get_permalink()) .'">'. __("Log In") .'</a></li>';
      }
   }
   return $items;
}

function redirect_non_admin_user() {
	$login_url = get_option( 'login_url' );
    if ( !defined( 'DOING_AJAX' ) && !current_user_can('administrator') ){
        wp_redirect( site_url( $login_url ) );  exit;
    } 
}

add_action( 'admin_init', 'redirect_non_admin_user' );