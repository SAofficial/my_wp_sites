<?php
require_once dirname(dirname(__FILE__)).'/custom/stripe/vendor/autoload.php';
if (WP_DEBUG) { 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
$GLOBALS['current_user_id'] = get_current_user_id();
/*hide pages when user is logged out*/
add_action('get_header', 'redirect_home_if_log_out');

add_theme_support( 'post-thumbnails' );
add_image_size( 'home-slide-img-mobile', 640, 1072, true ); //resize, crop in functions.php

 /*hide pages when users are logged out*/
function redirect_home_if_log_out(){
    global $current_user_id;
    $pages = array(
        0 => 'user-profile',
        1 => 'user-dashboard',
        // 2 => 'new-challenge',
        3 => 'challenge-history',
        // 4 => 'view-challange'
    );
        foreach ($pages as $index => $page_slug) {
        if (is_page($pages[$index]) && $current_user_id == 0) {
            wp_redirect(home_url());
        }
    }
}
/*hide pages when user is logged in*/
add_action('get_header', 'redirect_home_if_log_in');

function redirect_home_if_log_in(){
    global $current_user_id;
    $pages = array(
        0 => 'login-register'
    );
        foreach ($pages as $index => $page_slug) {
        if (is_page($pages[$index]) && $current_user_id != 0) {
            wp_redirect(home_url());
        }
    }
}

 add_action( 'wp_enqueue_scripts', 'custom_scripts' );

 function custom_scripts(){
     wp_enqueue_script( 'jquery-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js','','',true);
      wp_enqueue_script('jquery-validatee-additional','https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js','','',true);    
   wp_enqueue_script( 'sweet-alert', 'https://cdn.jsdelivr.net/npm/sweetalert2@9','','',true);
   if (is_page( 'our-challenges' )) {
        wp_enqueue_script('stripe-init','https://js.stripe.com/v3/','','',true);
        wp_enqueue_script( 'stripe-script', get_stylesheet_directory_uri().'/custom/js/stripe.js', '', '', true );
   }

    wp_enqueue_script( 'carousel-js', get_stylesheet_directory_uri().'/custom/js/carosel.js', '', '', true );
     
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri().'/custom/js/custom-script.js', '', '', true );
    
   wp_localize_script('custom-script', 'the_ajax_script', array('ajaxurl' =>admin_url('admin-ajax.php')));
    wp_enqueue_style( 'custom-style.css', get_stylesheet_directory_uri().'/custom/css/custom-style.css', '', '', 'all' );
 }

add_role('josh-user','Josh User');
    
    function wp_custom_shortcode($atts) {
    extract( shortcode_atts( array(
        'type' => 'myvalue'

    ), $atts ) );

    switch( $type ){
        case 'challange_img':
                             include('templates/homepage-shortcode-template.php');

            break;

        case 'user_img':
                            include('templates/homepage-shortcode-template-user.php');

                            
            break;
        case 'review_img':
                            include('templates/homepage-reviews-shortcode.php');
        
                            
            break;

        default:
            $output = '<div class="defaultshortcodecontent"></div>';
            break;
    }

    return $output; 
        
}
// register shortcode
add_shortcode('custom_shortcode', 'wp_custom_shortcode'); 

add_action('wp_ajax_daily_user_registration_form', 'daily_user_registration_form');
add_action('wp_ajax_nopriv_daily_user_registration_form', 'daily_user_registration_form');

        /*USER REGISTRATION*/
function daily_user_registration_form(){
    $username = $_POST['username'];
    $email = $_POST['email'];
    if (empty($_POST['username']) || empty($_POST['pass']) || empty($_POST['registering'])) {
         $response = array(
                    "message" =>"Fill out all required fields",
                    "error" => true
                );
                return response_json($response);
        wp_die();
    }
    if (email_exists(trim($email)) && !empty($email)) {
        $response = array(
                    "message" =>"The Email you enetered is already registered, Try another one.",
                    "error" => true
                );
                return response_json($response);
        wp_die();
    }
    if (username_exists(trim($username)) && !empty($username)) {
        $response = array(
                    "message" =>"Username , you enetered is already registered, Try another one.",
                    "error" => true
                );
                return response_json($response);
        wp_die();
    }
    else{
            /** FORM REGISTRATION  **/
            if (empty($email)) {
                $userdata = array(
                    'user_login' => $username,
                    'user_pass' => $_POST['pass'], // When creating a new user, `user_pass` is expected.
                    'role' => 'josh-user'
                );
            }
            else{
                $userdata = array(
                    'user_login' => $username,
                    'user_pass' => $_POST['pass'], // When creating a new user, `user_pass` is expected.
                    'user_email' => $email,
                    'role' => 'josh-user'
                );
            }
            // asda
            
         
            
            // \dsdd
            
        $user_id  = wp_insert_user($userdata);
          $creds = array(
                'user_login' => $username,
                'user_password' => $_POST['pass']
            );
            $user  = wp_signon($creds, false);
            if (is_wp_error($user)) {
                $passwordErr   = "Can't login";
                $response['error']  = $passwordErr;
                $response['status'] = false;
                //return $user->get_error_message();
            } else {
                $response['status']       = true;
                $response['message']       = "User Registered";
                $response['redirect_url'] = home_url().'/user-dashboard';
            } 
  /*      $response = array(
                    "message" =>"User registered",
                    "redirect_url" => home_url().'/login-register/', 
                    "error" => false
                );*/
        return response_json($response);
       
    }
}

/*USER LOGIN*/
add_action('wp_ajax_user_login', 'user_login');
add_action('wp_ajax_nopriv_user_login', 'user_login');

function user_login(){
       
    $user_system_email = $_POST['user_name'];
    $user_system_password = $_POST['pass'];
    $redirect_after_login = $_POST['redirect_url'];
    $user_id = $_POST['user_id'];
    $lchallenge_id = $_POST['lchallenge_id'];
    $challenge_id = $_POST['challenge_id'];
    if (empty($user_system_email)) {
        $emailErr      = "Email/User Login is required";
        $err['error']  = $emailErr;
        $err['status'] = false;
    } 
    else {
        $user_system_email = user_system_test_input($user_system_email);
        // check if e-mail address is well-formed
        if (!filter_var($user_system_email, FILTER_VALIDATE_EMAIL)) {
            // it's not a email
            $userlogin_emailStatus = true;
        } else {
            // it's not a login
            $userlogin_emailStatus = false;
        }
    }

    //password
    if (empty($user_system_password)) {
        $passwordErr   = "Password is required";
        $err['error']  = $passwordErr;
        $err['status'] = false;
    } else {
        $user_system_password = user_system_test_input($user_system_password);
    }

    //REMEMBER ME
    if (isset($_POST['user_system_remember'])) {
        $remember_me = true;
    } else {
        $remember_me = false;
    }
    if ($userlogin_emailStatus == true) {
        $get_user = get_user_by('login', $user_system_email);
    } else {
        $get_user = get_user_by('email', $user_system_email);
    }
    $user_role = $get_user->roles[0];
    if ($user_role == 'josh-user') {

        //$get_user = get_user_by( 'email', $shears_email );
        if ($get_user != false) {

        // echo "<pre>".var_dump($user_role)."</pre>";
        if (wp_check_password($user_system_password, $get_user->data->user_pass, $get_user->ID)) {
            $creds = array(
                'user_login' => $get_user->data->user_login,
                'user_password' => $user_system_password,
                'remember' => $remember_me
            );
            $user  = wp_signon($creds, false);
            if (is_wp_error($user)) {
                $passwordErr   = "Can't login";
                $err['error']  = $passwordErr;
                $err['status'] = false;
                //return $user->get_error_message();
            } else {
                if (!empty($redirect_after_login)) {
                    $redirect_url = '/'.$redirect_after_login."?challenge_id=".$challenge_id;
                }
                else if($redirect_after_login == 'view-uprofile'){
                    $redirect_url = '/'.$redirect_after_login."?user_id=".$user_id;
                }
                else if($redirect_after_login == 'our-challenges'){
                    $redirect_url = '/'.$redirect_after_login."?challenge_id=".$lchallenge_id;
                }
                else{
                    $redirect_url = '/user-dashboard';
                }
                $redirect_dashboard  = home_url($redirect_url);
                $err['status']       = true;
                $err['redirect_url'] = $redirect_dashboard;
            }
        } 
        else {
            $passwordErr   = "Password is inncorrect";
            $err['error']  = $passwordErr;
            $err['status'] = false;
        }
      
    } else {
        $emailErr      = "User with this email/username doesn't exists";
        $err['error']  = $emailErr;
        $err['status'] = false;
    }
}
    else{
        $emailErr      = "User with this email/username doesn't exists";
        $err['error']  = $emailErr;
        $err['status'] = false;
    }

    return response_json($err);
    // echo json_encode($err);
    // wp_die();
}
/*forgot password*/
add_action('wp_ajax_forgot_password', 'forgot_password');
add_action('wp_ajax_nopriv_forgot_password', 'forgot_password');

function forgot_password(){

    $get_user = get_user_by('email', $_POST['email']);
    if($get_user){
      
        ob_start();
        include(get_stylesheet_directory() .'/custom/templates/email-test.php');
        $email_content = ob_get_contents();
        ob_end_clean();
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail($_POST['email'], "Josh Heffler Reset Password", $email_content, $headers);
        $err['message']  = "Email Sent";
        $err['redirect_url']  = home_url().'/retreive-password';
        $err['status'] = true;
    }
    else{
        $err['message']  = "User with this email doesn't exists";
        $err['status'] = false;
    }
    return response_json($err);

}

/*reset password*/
add_action('wp_ajax_reset_password_custom', 'reset_password_custom');
add_action('wp_ajax_nopriv_reset_password_custom', 'reset_password_custom');

function reset_password_custom(){
    $user_id = $_POST['user_id'];
    $password = $_POST['c_pass'];

        wp_set_password( $password, $user_id );
        $err['message']  = "Password reset successfully";
        $err['status'] = true;
        $err['redirect_url'] = home_url().'/login-register';
   
    return response_json($err);

}

    /*Extra user profile fields*/

    add_action( 'show_user_profile', 'extra_user_profile_fields' );
    add_action( 'edit_user_profile', 'extra_user_profile_fields' );

        function extra_user_profile_fields($user) {
         ?>
            <h3><?php _e("Extra profile information", "blank"); ?></h3>

            <table class="form-table">
            <tr>
                <th><label for="phone_no"><?php _e("Phone No"); ?></label></th>
                <td>
                    <input type="text" name="phone_no" id="phone_no" value="<?php echo esc_attr( get_the_author_meta( 'state', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
            </tr>
            <tr>
                <th><label for="state"><?php _e("State"); ?></label></th>
                <td>
                    <input type="text" name="state" id="state" value="<?php echo esc_attr( get_the_author_meta( 'state', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
            </tr>
          <tr>
            <th><label for="city"><?php _e("City"); ?></label></th>
                <td>
                    <input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
            </tr>
            <tr>
            <th><label for="fb_url"><?php _e("Facebook Url"); ?></label></th>
                <td>
                    <input type="url" name="fb_url" id="fb_url" value="<?php echo esc_attr( get_the_author_meta( 'fb_url', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
            </tr> 
            <tr>
            <th><label for="insta_url"><?php _e("Instagram Url"); ?></label></th>
                <td>
                    <input type="url" name="insta_url" id="insta_url" value="<?php echo esc_attr( get_the_author_meta( 'insta_url', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
            </tr> 
            <tr>
            <th><label for="youtube_url"><?php _e("Youtube Url"); ?></label></th>
                <td>
                    <input type="url" name="youtube_url" id="youtube_url" value="<?php echo esc_attr( get_the_author_meta( 'youtube_url', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
            </tr> 
            <tr>
            <th><label for="tiktok_url"><?php _e("Tiktok Url"); ?></label></th>
                <td>
                    <input type="url" name="tiktok_url" id="tiktok_url" value="<?php echo esc_attr( get_the_author_meta( 'tiktok_url', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
            </tr> 
            </table>
        <?php }



        add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
        add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

        function save_extra_user_profile_fields($user_id) {

            if ( !current_user_can( 'edit_user', $user_id ) ) { 
                return false; 
            }
            update_user_meta( $user_id, 'phone_no', $_POST['phone_no'] );
            update_user_meta( $user_id, 'state', $_POST['state'] );
            update_user_meta( $user_id, 'city', $_POST['city'] );
            update_user_meta( $user_id, 'fb_url', $_POST['fb_url'] );
            update_user_meta( $user_id, 'insta_url', $_POST['insta_url'] );
            update_user_meta( $user_id, 'youtube_url', $_POST['youtube_url'] );
            update_user_meta( $user_id, 'tiktok_url', $_POST['tiktok_url'] );
        }


/*update profile*/
add_action('wp_ajax_update_profile', 'update_profile');
add_action('wp_ajax_nopriv_update_profile', 'update_profile');

function update_profile(){


    $user_id = $_POST['user_id'];
    $password = $_POST['retype_pass'];
    $user = get_user_by('ID',$user_id);
    
            if (!empty($_FILES['user_pic']['name'])) {
                 
     
               require( dirname(__FILE__) . '/../../../../wp-load.php' );
                $wordpress_upload_dir = wp_upload_dir();
                $i = 1;
                $user_pic = $_FILES['user_pic'];
                $user_pic_name = $user_pic['name'];
                $user_pic_name = preg_replace('/\s+/', '', $user_pic_name);
                $new_file_path = $wordpress_upload_dir['path'] . '/' . $user_pic_name;
                $new_file_mime = mime_content_type( $user_pic['tmp_name'] );
        
                if( move_uploaded_file( $user_pic['tmp_name'], $new_file_path ) ) {
             
                $upload_id = wp_insert_attachment( array(
                    'guid'           => $new_file_path, 
                    'post_mime_type' => $new_file_mime,
                    'post_title'     => preg_replace( '/\.[^.]+$/', '', $user_pic_name ),
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                ), $new_file_path );
             
                // wp_generate_attachment_metadata() won't work if you do not include this file
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
             
                // Generate and save the attachment metas into the database
                wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
             
                // Show the uploaded file in browser
               // wp_redirect( $wordpress_upload_dir['url'] . '/' . basename( $new_file_path ) );
        
                $response_image = array(
                    "thumbnail_id" =>$upload_id,
                    "type" => "success",
                    "error" => false
                );
            }   else{
                     $response_image = array(
                        "type" => "failure",
                        "test"=> $user_pic['tmp_name'] ,
                        "error" => true
                    );
                }
            }
            else{
                $response_image = array(
                        "type" => "failure",
                        "error" => true
                    );
            }

            
    if ( $user && wp_check_password( $password, $user->data->user_pass, $user->ID ) ) {

        $args = array( 
            'ID' => $user_id, 
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name']
            );
        wp_update_user($args);
            
           if( $response_image['error'] == false  && !empty($user_pic)){
            update_user_meta($user_id, '_thumbnail_id', $response_image['thumbnail_id']);  
            }
            update_user_meta( $user_id, 'phone_no', $_POST['phone'] );
            update_user_meta( $user_id, 'state', $_POST['state'] );
            update_user_meta( $user_id, 'city', $_POST['city'] );
            update_user_meta( $user_id, 'fb_url', $_POST['fb_url'] );
            update_user_meta( $user_id, 'insta_url', $_POST['insta_url'] );
            update_user_meta( $user_id, 'youtube_url', $_POST['utube_url'] );
            update_user_meta( $user_id, 'tiktok_url', $_POST['tiktok_url'] );
            if(!empty($user_pic)){
            update_user_meta( $user_id, 'user_pic', $user_pic['name']);
                }
            $err['message']  = "Profile Updated";
            $err['status'] = true;
            return response_json($err);
    
    } else {
                $err['message']  = "Incorrect Password";
                $err['status'] = false;
                return response_json($err);
    }
}
/*update profile*/
add_action('wp_ajax_update_pswd', 'update_pswd');
add_action('wp_ajax_nopriv_update_pswd', 'update_pswd');

function update_pswd(){
    $user_id = get_current_user_id();
    $user = get_user_by('ID',$user_id);
    $old_password = $_POST['current_pass'];
    $new_password = $_POST['confirm_new_pass'];
     
     if(wp_check_password( $old_password, $user->data->user_pass, $user->ID )){
             wp_set_password( $new_password, $user_id );
            $err['message']  = "Password Updated";
            $err['status'] = true;
            return response_json($err);
     }
     else{
                $err['message']  = "Please enter your current password";
                $err['status'] = false;
                return response_json($err);
     }
    
}

/*Custom Post type start*/

    function challenges() {
        $supports = array(
        'title', // post title
        'editor', // post content
        // 'author', // post author
        'thumbnail', // featured images
        'excerpt', // post excerpt
        'custom-fields', // custom fields
        'comments', // post comments
        'revisions', // post revisions
        'post-formats', // post formats
    );

    $labels = array(
    'name'              => _x('Challenges', 'plural'),
    'singular_name'     => _x('Challenge', 'singular'),
    'menu_name'         => _x('Challenges', 'admin menu'),
    'name_admin_bar'    => _x('Challenges', 'admin bar'),
    'view_item'         => __('View Challenges Property'),
    'all_items'         => __('All Challenges'),
    'search_items'      => __('Search Challenges Properties'),
    'not_found'         => __('No Challenges Found.'),

    );
    
    $supports = array(
    'thumbnail', // featured images
    'custom-fields', // custom fields
        );

    $args = array(
    'supports'          => $supports,
    'labels'            => $labels,
    'public'            => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => 'challenges'),
    'has_archive'       => true,
    'hierarchical'      => false,
    'map_meta_cap'      => true,
    'capabilities'      => array(
                'create_posts' => false
            )
    );
    $args_taxonomy = array(
        'name'              => _x('Category', 'plural'),
        'public'       => false,
        'rewrite'      => false,
        'hierarchical' => true
    );

    register_taxonomy('category_custom',array('challenges'), array(
        'hierarchical' => true,
        'labels' => $args_taxonomy,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'challenges' ),
      ));

register_post_type('challenges', $args);
}
add_action('init', 'challenges');

 /*TO MAKE ACF FIELD READONLY WHOSE TYPE IS TEXT */

add_filter('acf/load_field/type=text', 'acf_read_only');
function acf_read_only($field) {
    $field['readonly'] = 1;
    return $field;
}
add_filter('acf/load_field/type=textarea', 'acf_read_only_textarea');
function acf_read_only_textarea($field) {
    $field['readonly'] = 1;
    return $field;
}

 /*TO REMOVE VIEW AND QUICK EDIT OPTION FROM TICKETS POST TYPE*/

 function wpc_remove_row_actions( $actions )  {  
    if( get_post_type() === 'challenges' ) // choose the post type where you want to hide the button  
        unset( $actions['edit'] ); // this hides the EDIT button on your edit post screen  
        unset( $actions['view'] ); // this hides the VIEW button on your edit post screen  
        unset( $actions['inline hide-if-no-js'] ); // this hides the VIEW button on your edit post screen  
    return $actions;  
}  

add_filter( 'post_row_actions', 'wpc_remove_row_actions', 10, 1 );  
/*create challenge*/
add_action('wp_ajax_create_challenge', 'create_challenge');
add_action('wp_ajax_nopriv_create_challenge', 'create_challenge');

function create_challenge(){
    $user = get_user_by('ID',get_current_user_id());
    // var_dump();exit();
    // $_FILES['dare_pic['name']']
    if (empty($_FILES['dare_pic']['name']) || !isset($_FILES['dare_pic']['name'])) {
    $user_pic = $_POST['image_url'];
    }
       if ( !empty($_POST['title'] ) ) {
         $post = array(
            'post_status'       => "publish",
            'post_title'        =>  $_POST['title'],
            'post_type'         => "challenges",
            'post_author'       => get_current_user_id(),
            );
         $post_id = wp_insert_post( $post );
        if (!isset($user_pic) || empty($user_pic)) {
            require( dirname(__FILE__) . '/../../../../wp-load.php' );
                $wordpress_upload_dir = wp_upload_dir();
                $i = 1;
                $user_pic = $_FILES['dare_pic'];
                $new_file_path = $wordpress_upload_dir['path'] . '/' . $user_pic['name'];
                $new_file_mime = mime_content_type( $user_pic['tmp_name'] );
        
                if( move_uploaded_file( $user_pic['tmp_name'], $new_file_path ) ) {
             
                $upload_id = wp_insert_attachment( array(
                    'guid'           => $new_file_path, 
                    'post_mime_type' => $new_file_mime,
                    'post_title'     => preg_replace( '/\.[^.]+$/', '', $user_pic['name'] ),
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                ), $new_file_path );
             
                // wp_generate_attachment_metadata() won't work if you do not include this file
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
             
                // Generate and save the attachment metas into the database
                wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
             
                // Show the uploaded file in browser
               // wp_redirect( $wordpress_upload_dir['url'] . '/' . basename( $new_file_path ) );
        
                $response_image = array(
                    "thumbnail_id" =>$upload_id,
                    "type" => "success",
                    "error" => false
                );
            }   else{
                     $response_image = array(
                        "type" => "failure",
                        "test"=> $user_pic['tmp_name'] ,
                        "error" => true
                    );
                }
        }
        else{
              $upload_id =   Generate_Featured_Image($user_pic,$post_id);
              $response_image = array(
                    "thumbnail_id" =>$upload_id,
                    "type" => "success",
                    "error" => false
                );        
            }
           
           
        //  wp_set_post_terms( $post_id, array(5), 'status');
         $donation = isset($_POST['donation'])? "Yes":"No";
         add_post_meta($post_id, 'author_id',get_current_user_id());
         add_post_meta($post_id, 'author_name',$user->user_login);
         add_post_meta($post_id, 'challenge_title',$_POST['title']);
         add_post_meta($post_id, 'description',$_POST['Description']);
         add_post_meta($post_id, 'financial_goal',$_POST['Financial']);
         add_post_meta($post_id, 'donation',$donation);
         wp_set_post_terms( $post_id, array($_POST['cat']), 'category_custom');

        if( $response_image['error'] == false  && !empty($user_pic)){
            add_post_meta($post_id, '_thumbnail_id', $response_image['thumbnail_id']);  

        }
       /* ob_start();
        include(get_stylesheet_directory() .'/inc/email-template.php');
        $email_content = ob_get_contents();
        ob_end_clean();
        $headers = array('Content-Type: text/html; charset=UTF-8');
        // $email_array = array('rjones@pureproofinc.com','afarinella@pureproofinc.com','gcapardi@pureproofinc.com ');

        wp_mail('maxwilson908@gmail.com', "PureProof New Ticket Opened", $email_content, $headers);*/
        $share_options = "<div class='ssba-classic-2 ssba ssbp-wrap left ssbp--theme-1'><div style='text-align:left'>
        <span class='ssba-share-text'>Share this...</span><br>
        <a data-site='' class='ssba_facebook_share' href='http://www.facebook.com/sharer.php?u=http://dev3.onlinetestingserver.com/josh-heffler/our-challenges/?challenge_id=".$post_id."' target='_blank'><img src='http://dev3.onlinetestingserver.com/josh-heffler/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/facebook.png' style='width: 35px;' title='Facebook' class='ssba ssba-img' alt='Share on Facebook'><div title='Facebook' class='ssbp-text'>Facebook</div></a>
        <a data-site='pinterest' class='ssba_pinterest_share' href='javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());'><img src='http://dev3.onlinetestingserver.com/josh-heffler/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/pinterest.png' style='width: 35px;' title='Pinterest' class='ssba ssba-img' alt='Pin on Pinterest'><div title='Pinterest' class='ssbp-text'>Pinterest</div></a><a data-site='' class='ssba_twitter_share' href='http://twitter.com/share?url=http://dev3.onlinetestingserver.com/josh-heffler/our-challenges/?challenge_id=".$post_id."text=OurChallenges' target='_blank;'><img src='http://dev3.onlinetestingserver.com/josh-heffler/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/twitter.png' style='width: 35px;' title='Twitter' class='ssba ssba-img' alt='Tweet about this on Twitter'><div title='Twitter' class='ssbp-text'>Twitter</div></a><a data-site='linkedin' class='ssba_linkedin_share ssba_share_link' href='http://www.linkedin.com/shareArticle?mini=true;url=http://dev3.onlinetestingserver.com/josh-heffler/our-challenges/?challenge_id=".$post_id." target='_blank;'><img src='http://dev3.onlinetestingserver.com/josh-heffler/wp-content/plugins/simple-share-buttons-adder/buttons/somacro/linkedin.png' style='width: 35px;' title='LinkedIn' class='ssba ssba-img' alt='Share on LinkedIn'><div title='Linkedin' class='ssbp-text'>Linkedin</div></a></div></div>";

            global $wpdb;
            $sql = "SELECT follower_email FROM ". $wpdb->prefix ."follow_system 
               WHERE followed =  ". get_current_user_id();

            $result = $wpdb->get_results($sql);
             if($wpdb->num_rows > 0){
                $site_name = get_option('blogname');
                $headers = array();
               $headers = array('Content-Type: text/html; charset=UTF-8');
               $subject = "New Challenge Created By";
               $headers[] = 'From: '.$site_name.''."\r\n";
               $message= '<div align="center">
                       <table width="600" cellspacing="5" cellpadding="5" border="0" style="color:#666 !important;background:none repeat scroll 0% 0% rgb(255,255,255);border-radius:3px;border:1px solid rgb(236,233,233)">
                       <tbody>
                       <tr><td style="text-align:center">
                       <!-- <img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/06/dare.png" height="100px" align="center" class="CToWUd a6T" tabindex="0"> -->
                       <div class="a6S" dir="ltr" style="opacity: 0.01; left: 842.641px; top: 334px;"><div id=":14o" class="T-I J-J5-Ji aQv T-I-ax7 L3 a5q" title="Download" role="button" tabindex="0" aria-label="Download attachment " data-tooltip-class="a1V"><div class="aSK J-J5-Ji aYr"></div></div></div></td></tr>
                       <tr>
                       <th style="background-color:#FFF;color:#666; font-size:18px" align="center"><strong>Dare Your Friend</strong></th>
                       </tr>
                       <tr>
                       <th height="8px" style="font-size:8px">&nbsp;</th>
                       </tr>
                       

                       <tr>
                       <th style="background-color:#fff;color:#666">Hello User</th>
                       </tr>
                       <tr>
                       <td valign="top" style="text-align:left;color:#666;font-weight:600"><span style="color:#666;padding-bottom:10px;font-weight:300;display:block">New Challenge has been created by '.$user->user_login.' </span>
                       '.home_url().'/our-challenges/?challenge_id='.$post_id.' <br>
                       </td>
                       </tr>
                       <tr><td><br>Regards,<br><b>Dare Your Friend</b></td></td></tr>
                       </tbody>
                       </table>
                       </div>';
            foreach ($result as $key => $value) {
                    $headers = array('Content-Type: text/html; charset=UTF-8');
                    wp_mail( $result[$key]->follower_email, $subject, $message, $headers);
            }
              }
        $response = array(
            "message" =>'Challenge Created Successfully',
            "redirect_url" => home_url().'/new-challenge',
            "share_link" => home_url().'/our-challenges/?challenge_id='.$post_id,
            "share_buttons" => $share_options,
            "status" => true
        );
        return response_json($response);
    }
    else{
        $response = array(
            "message" =>'Oops! Something Missing',
            "status" => false
        );
        return response_json($response);
    }
    
}

/*edit challenge*/
add_action('wp_ajax_edit_challenge', 'edit_challenge');
add_action('wp_ajax_nopriv_edit_challenge', 'edit_challenge');

function edit_challenge(){
    $post_id = $_POST['post_id'];

    $check_challenge =0;


            if(isset($_FILES['video'] )) {

                $check_challenge = 1;

                $file_type = $_FILES['video']['type'];
                if (!empty($file_type)) {
                    if ( ! function_exists( 'wp_handle_upload' ) ) {

                            require_once( ABSPATH . 'wp-admin/includes/image.php' );
                            require_once( ABSPATH . 'wp-admin/includes/file.php' );
                            require_once( ABSPATH . 'wp-admin/includes/media.php' ); 
                        }

                        $uploadedfile = $_FILES['video'];
                        $upload_overrides = array( 'test_form' => false );
                        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );


                 if ( $movefile ){
                        $image_url = $movefile["url"];
                        $upload_dir = wp_upload_dir();
                        $image_data = file_get_contents($image_url);
                        $filename = basename($image_url);
                        if(wp_mkdir_p($upload_dir['path']))
                            $file = $upload_dir['path'] . '/' . $filename;
                        else
                            $file = $upload_dir['basedir'] . '/' . $filename;
                        file_put_contents($file, $image_data);

                        $wp_filetype = wp_check_filetype($filename, null );
                        $attachment = array(
                            'post_mime_type' => $wp_filetype['type'],
                            'post_title' => sanitize_file_name($filename),
                            'post_content' => '',
                            'post_status' => 'inherit'
                        );

                        $listing_post_id = $post_id ; //your post id to which you want to attach the video
                        $attach_id = wp_insert_attachment( $attachment, $file, $listing_post_id);

                        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
                        wp_update_attachment_metadata( $attach_id, $attach_data );
                        add_post_meta($post_id, '_video_id', $attach_id);
                        $video_url = wp_get_attachment_url($attach_id);
                        update_post_meta($post_id, 'video_url', $video_url);  

                      }
            }
        }


    $my_post = array(
        'ID'           => $post_id,
        'post_status'  => "complete",
        'post_type'     => "challenges",
        'post_title'   => $_POST['title']
    );
 
    // Update the post into the database
    if($check_challenge)
    {
    wp_update_post( $my_post );
   }
 
    update_post_meta($post_id,'challenge_title', $_POST['title']);
    update_post_meta($post_id,'description', $_POST['Description']);
    unregister_taxonomy_for_object_type( 'category_custom', 'challenges' );
    wp_set_post_terms( $post_id, array($_POST['cat']), 'category_custom');
    update_post_meta($post_id,'financial_goal', $_POST['Financial']);

     $response = array(
            "message" =>'Challenge Updated',
            "status" => true
        );
        return response_json($response);
    
}

/*delete challenge*/
add_action('wp_ajax_delete_challenge', 'delete_challenge');
add_action('wp_ajax_nopriv_delete_challenge', 'delete_challenge');

function delete_challenge(){
    if (!empty($_POST['post_id'])) {

         $args = array(
              'ID'              => $_POST['post_id'],
              'post_status'     => 'deleted'
            );
         wp_update_post($args);
        $response = array(
            "message" =>'Challenge deleted',
            "status" => true
        );
        return response_json($response);
    }
    else{
        $response = array(
            "message" =>'Error deleting',
            "status" => false
        );
        return response_json($response);
    }
}
/*TO HIDE TOOLBAR FOR ALL USERS ACCEPT ADMIN*/

add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}
add_action('wp_ajax_follow_unfollow', 'follow_unfollow');
add_action('wp_ajax_nopriv_follow_unfollow', 'follow_unfollow');


function follow_unfollow(){
    


    if(isset($_POST['followerof']) && isset($_POST['follower'])){

        $followerof     = $_POST['followerof'];
        $follower       = $_POST['follower'];
        
        $checkfollow    = checkfollow($followerof);
        if($checkfollow)
        {
            unfollow($followerof);

        }
        else
        {
            follow($followerof);

        }


    }

}



function checkfollow($followed){
    global $wpdb;
    $sql = "SELECT * FROM ". $wpdb->prefix ."follow_system 
           WHERE follower_id =  ". get_current_user_id() ." and followed = $followed";
               $result = $wpdb->get_results($sql);
          if($wpdb->num_rows == 0){
                return 0;
              }
              else{
                return 1;
              }

    
}

function unfollow($to_be_unfollowed){

    global $wpdb;
    $sql = "DELETE FROM ". $wpdb->prefix ."follow_system 
    WHERE follower_id =  ". get_current_user_id() ." and followed = $to_be_unfollowed";
    $result = $wpdb->get_results($sql);
    

        $response['status'] = false;
    return response_json($response);


}

function follow($to_be_followed){
    $user = get_user_by( 'ID', get_current_user_id());
    $user_id = get_current_user_id();
    global $wpdb;
    $tablename = $wpdb->prefix . "follow_system";
    $wpdb->insert($tablename, array(
    'follower_id' => $user_id,
    'follower_email' => $user->user_email,
    'followed' => $to_be_followed, // ... and so on
    ));

        $response['status'] = true;
    return response_json($response);
}
add_action('wp_ajax_like_unlike', 'like_unlike');
add_action('wp_ajax_nopriv_like_unlike', 'like_unlike');


function like_unlike(){
    


    if(isset($_POST['likeof'])){

        $challenge_id = $_POST['likeof'];
        
        $checklike = checklike($challenge_id);
        if($checklike)
        {
            unlike($challenge_id);

        }
        else
        {
            like($challenge_id);

        }


    }

}



function checklike($challenge_id){
    global $wpdb;
    $sql = "SELECT * FROM ". $wpdb->prefix ."like_system 
           WHERE user_id =  ". get_current_user_id() ." and challenge_id= $challenge_id and  challenge_like = 1";
               $result = $wpdb->get_results($sql);
          if($wpdb->num_rows == 0){
                return 0;
              }
              else{
                return 1;
              }

    
}

function unlike($to_be_unlike){

    global $wpdb;
    $sql = "DELETE FROM ". $wpdb->prefix ."like_system
    WHERE user_id =".get_current_user_id()." and challenge_id= $to_be_unlike and  challenge_like = 1"; 
    $result = $wpdb->get_results($sql);
    

        $response['status'] = false;
    return response_json($response);


}

function like($to_be_liked){
    $user = get_user_by( 'ID', get_current_user_id());
    $user_id = get_current_user_id();
    global $wpdb;
    $tablename = $wpdb->prefix . "like_system";
    $wpdb->insert($tablename, array(
    'user_id' => $user_id,
    'challenge_id' => $to_be_liked,
    'challenge_like' => 1, // ... and so on
    ));

        $response['status'] = true;
    return response_json($response);
}





add_shortcode('review_form','review_func');
function review_func(){
?>
<div class="col span_12">

    <?php


    $the_query =  new WP_Query( array(
        'posts_per_page'    => -1,
        'post_type'         => 'review',
        'order'             => 'DESC',
        'post_status'       => array('publish') ,
        'meta_query'      =>
            array(
               array(
                   'relation' => 'AND',
                 array(
                'key' => 'challenge_id',
                'value' => $_GET['challenge_id']
               )
                    
          )
            )
         )
      );


if ($the_query->have_posts() ){
while ($the_query->have_posts() ) {
  $the_query->the_post();

   $post_id = get_the_ID();

   $name = get_the_title();

   $rating = get_post_meta( $post_id, 'ratingValue', true);

   $desc = get_the_content();
   $date = get_the_date();

   $thumbnail_id = get_post_thumbnail_id( $post_id );  
   
   $abc = explode(',', $thumbnail_id);

   $image_url = wp_get_attachment_image_src($abc[0]);
   ?>
   <div class="col span_1">
       <img style="height: 55px; border-radius: 50%" src="<?php echo $image_url[0];?>" class="agntdtlimg" >
   </div>
   <div class="col span_9">
        <div class="name-of-user"><?php  echo $name;?>  </div>
        <div class="name-of-user1"><?php  echo $desc;?>  </div>  
        <div class="name-of-user"><?php  echo $date;?>  </div> 
<fieldset class="rating">
<?php
for ($i=1; $i <=$rating ; $i++) { 
  ?>  
    <input type="radio" id="star5" disabled="" name="rating"/><label class = "show-star" for="star5"></label>

  <?php
}
?>

</fieldset>               
   </div> 


<?php


}

}

$user_id = get_current_user_id();
$user =get_user_by( 'ID', $user_id );
$name =$user->user_login;


?>
<div class="col span_2 col_last">
    <button type="button" id="rating-form-show">Add Reviews</button>
</div>
</div>
<form id="Review" method="post" style="display: none;">
  <label for="fname"> Name:</label><br>
  <input type="text" id="fname" name="fname" value="<?= $name;  ?>" ><br>
  <input type="hidden" name="post_name" value="<?= get_the_title($_GET['challenge_id']); ?>">
  <input type="hidden" name="post_id" value="<?= $_GET['challenge_id']; ?>">

Review
<textarea id="review" name="review" rows="4" cols="50">
</textarea>
<br>
<fieldset class="rating">
    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
</fieldset>

<label for="rating" class="error" style="display:none;" > </label>
<br><br>

<div class="col span_12">
<!-- <div><label>Upload your review photos here</label></div><br> -->
<!-- <input type="file" placeholder="Browse" name="image_new"><br><br> -->
<!-- <div class="mySelect"> -->
    <!-- <label class="myLabel"> -->
        <!-- <input type="file" placeholder="Browse" name="image_new"> -->
        <!-- <span>Upload Image</span>                         -->
    <!-- </label> -->
<!-- </div> -->
<!-- </div> -->
<br>

<div>
<input type="hidden" name="action" value="reviews">

<!-- <input type="submit" value="Submit" name="submit"> -->
<button type="submit" name="submit" id="submit-btn">Submit</button>
<button type="button" id="cancel-rate-form">Cancel</button>
</div>


</form>
<?php
}
//    CUSTOM POST TYPE       //

function Review() {
   $supports = array(
    'thumbnail', // featured images
    'custom-fields', // custom fields
        );
$labels = array(
'name' => _x('Review', 'plural'),
'singular_name' => _x('Review', 'singular'),
'menu_name' => _x('Reviews', 'admin menu'),
'name_admin_bar' => _x('Review', 'admin bar'),
'add_new' => _x('Add New', 'add new'),
'add_new_item' => __('Add New Review'),
'new_item' => __('New Review'),
'edit_item' => __('Edit Review'),
'view_item' => __('View Review'),
'all_items' => __('All Review'),
'search_items' => __('Search Reviews'),
'not_found' => __('No Reviews Found.'),
);
$args = array(
'supports' => $supports,
'labels' => $labels,
'public' => true,
'menu_icon'=> 'dashicons-star-filled',
'query_var' => true,
'rewrite' => array('slug' => 'review'),
'has_archive' => true,
'hierarchical' => true,
);
register_post_type('review', $args);
}
add_action('init', 'Review');

/*  FUNCTION Review*/

add_action('wp_ajax_reviews', 'reviews');

add_action('wp_ajax_nopriv_reviews', 'reviews');

function reviews(){
    $user_id = get_current_user_id();
/////////////
    $user_pic_id   = get_user_meta($user_id, '_thumbnail_id', true);
    $img_url =  wp_get_attachment_image_url($user_pic_id, 'home-slide-img-mobile',true);

    


    


/////////////

$post = array(
        'post_author' => $user_id,
        'post_status' => "publish",
        'post_title' => $_POST['fname'],
        'post_type' => "review",
    );

       
        $post_id = wp_insert_post($post);
        $upload_id =   Generate_Featured_Image($img_url,$post_id);
        /*
        require( dirname(__FILE__) . '/../../../../wp-load.php' );
        $wordpress_upload_dir = wp_upload_dir();

        $user_pic = $_FILES['image_new'];
        $new_file_path = $wordpress_upload_dir['path'] . '/' . $user_pic['name'];
        $new_file_mime = mime_content_type( $user_pic['tmp_name'] );

        if( move_uploaded_file( $user_pic['tmp_name'], $new_file_path ) ) {
     
        $upload_id = wp_insert_attachment( array(
            'guid'           => $new_file_path, 
            'post_mime_type' => $new_file_mime,
            'post_title'     => preg_replace( '/\.[^.]+$/', '', basename($new_file_path) ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        ), $new_file_path );
        // wp_generate_attachment_metadata() won't work if you do not include this file
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
     
        // Generate and save the attachment metas into the database
        wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );
     
        // Show the uploaded file in browser
       // wp_redirect( $wordpress_upload_dir['url'] . '/' . basename( $new_file_path ) );

        $response_image = array(
            "thumbnail_id" =>$upload_id,
            "type" => "success",
            "error" => false
        );
        
    }
    else{
         $response_image = array(
            "type" => "failure",
            "error" => true
        );
    }*/
    if($post_id)
    // && $response_image['error'] == false)
    {
    add_post_meta( $post_id, 'challenge_id', $_POST['post_id']);
    add_post_meta( $post_id, 'challenge_name', $_POST['post_name']);
    add_post_meta( $post_id, 'user_name', $_POST['fname']);
    add_post_meta( $post_id, 'ratingValue', $_POST['ratingValue']);
    add_post_meta( $post_id, 'review', $_POST['review']);
    add_post_meta($post_id, '_thumbnail_id', $upload_id);
    //add_post_meta($post_id, '_thumbnail_id', $response_image['thumbnail_id']);  

    $response = array(
    "message" =>"Successfully Submitted",
    "type" => "success",
    "error" => false    
  );
  
    }
    else{
        $response = array(
        "message" =>"Failed to submit the Request",
        "type" => "failure",
        "error" => true
        );

    }

return response_json($response);

}

add_action('wp_ajax_stripe_payment','stripe_payment');
add_action('wp_ajax_nopriv_stripe_payment','stripe_payment');
//stripe_payment();
function stripe_payment(){
    $token = $_POST['token'];
    $name = $_POST['your_name'];
    $amount = $_POST['amount'];
    $post_id = $_POST['post_id'];
    $post_title = get_the_title( $post_id );

    \Stripe\Stripe::setApiKey('sk_test_4z8tSkEJJDNb1YygiS7rdOgg00GC48arNi');

    // $stripe = new \Stripe\StripeClient('sk_test_4z8tSkEJJDNb1YygiS7rdOgg00GC48arNi');

    if (!empty($token)) {

        $charge = \Stripe\Charge::create([
          'amount' => $amount*100,
          'currency' => 'usd',
          'description' => 'Amount raised against challenge '.$post_title,
          'source' => $token,
          
        ]);

        // Retrieve charge details 
        $chargeJson = $charge->jsonSerialize(); 
        $transactionID = $chargeJson['balance_transaction']; 
        $payment_status = $chargeJson['status']; // succeeded

        if($payment_status == 'succeeded'){

              $value = array(
                'user_name'         => $name,
                'amount'            => $amount,
                'transaction_id'    => $transactionID
            );
            add_row('amount', $value, $post_id);

            $return_message = array (
                'error' => false,
                'message' => 'Payment is submitted successfully',
                'redirect_uri' => home_url('thank-you'),
                'transaction_id' => $transactionID 
            );
        }
        else{
            $return_message = array (
                'error' => true,
                'message' => 'Oops Something went wrong!',
            );
        }
    }
    return response_json($return_message);

}
add_action('wp_ajax_request_admin','request_admin');
add_action('wp_ajax_nopriv_request_admin','request_admin');
//stripe_payment();
function request_admin(){
      $response = array(
        "message" =>"Failed to submit the Request",
        "type" => "failure",
        "error" => true
        );

return response_json($response);

}


/*Mark complete challenge*/
add_action('wp_ajax_mark_completed','mark_completed');
add_action('wp_ajax_nopriv_mark_completed','mark_completed');

function mark_completed(){
    if (!empty($_POST['post_id'])) {
            $status = get_post_status($_POST['post_id']);
            if($status == 'complete'){
                  $response = array(
                    "message" =>'Challenge already completed!',
                    "status" => false
                );
            }
            elseif($status == 'in-active'){
                  $response = array(
                    "message" =>'Challenge is in-active yet!',
                    "status" => false
                );
            }
            else{
                 $args = array(
                  'ID'              => $_POST['post_id'],
                  'post_status'     => 'complete'
                );
                 wp_update_post($args);
                    $response = array(
                    "message" =>'Challenge Completed!',
                    "status" => true
                );
            }
        
        return response_json($response);
    }
    
}

 function search_category() { 
        if(isset($_GET['search_custom'])){
        $cat = $_GET['cat_post'];
        $post_title = $_GET['title'];
    
            if(isset($_GET['title']) && !empty($post_title)){
                     wp_redirect(home_url().'/get-category/?&title='."$post_title".'');
                }
            if(isset($_GET['cat_post']) && !empty($cat)){
                    wp_redirect(home_url().'/get-category/?cat_id='."$cat".'');
            }
            if(isset($_GET['cat_post']) && isset($_GET['title']) && !empty($cat) && !empty($post_title)){
                    wp_redirect(home_url().'/get-category/?cat_id='."$cat".'&title='."$post_title".'');
            }   
}
?>
        <form method="get" class="search_category_custom">
            <input type="text" placeholder="Search By Keyword" name="title">
            <select name="cat_post">
                <option value="">Search by category</option>
            <?php
                $terms = get_terms([
                    'taxonomy' => 'category_custom',
                    'hide_empty' => true,
                ]);
            foreach ($terms as $term) {
                echo "<option value=".$term->term_id.">".$term->name."</option>";
            }
            ?>
            </select>
            <input type="submit" name="search_custom" value="Search">
        </form>
<?php
}

// register shortcode
add_shortcode('wp_search_category', 'search_category'); 

function Generate_Featured_Image( $image_url, $post_id = ''){
    $upload_dir = wp_upload_dir();
    $image_data = wp_remote_fopen($image_url);
    $filename   = basename($image_url); // Create image file name
    if(wp_mkdir_p($upload_dir['path']))     $file = $upload_dir['path'] . '/' . $filename;
    else                                    $file = $upload_dir['basedir'] . '/' . $filename;
    file_put_contents($file, $image_data);
    $wp_filetype = wp_check_filetype($filename, null );
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename) ,
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment( $attachment, $file, $post_id );
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
    $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
    return $attach_id;
}

function user_system_test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function response_json($data){
    header('Content-Type: application/json');
    echo json_encode($data);
    wp_die();
}