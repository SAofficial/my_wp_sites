<?php 

/*
Template Name: Logout
*/
get_header();

 wp_logout();
 $redirect_url = home_url().'/login-register';
 wp_redirect($redirect_url);

 get_footer();