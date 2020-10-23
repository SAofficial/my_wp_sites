<?php 
require_once('custom/custom.php');
add_action( 'wp_enqueue_scripts', 'salient_child_enqueue_styles');

function salient_child_enqueue_styles() {

	

		$nectar_theme_version = nectar_get_theme_version();

		

    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array('font-awesome'), $nectar_theme_version);
//    wp_enqueue_style( 'datatable', 'https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css');
//    wp_enqueue_script( 'datatable-js', 'https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js','','',true);   


    if ( is_rtl() ) 

   		wp_enqueue_style(  'salient-rtl',  get_template_directory_uri(). '/rtl.css', array(), '1', 'screen' );

}
