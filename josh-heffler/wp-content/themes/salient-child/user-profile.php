<?php 

/*
Template Name: Profile Template
*/

get_header(); 
nectar_page_header($post->ID); 
//full page
$fp_options = nectar_get_full_page_options();
extract($fp_options);

$state = get_user_meta($current_user_id, 'state', true);
$phone_no = get_user_meta($current_user_id, 'phone_no', true);
$city = get_user_meta($current_user_id, 'city', true);
$fb_url = get_user_meta($current_user_id, 'fb_url', true);
$insta_url = get_user_meta($current_user_id, 'insta_url', true);
$utube_url = get_user_meta($current_user_id, 'youtube_url', true);
$tiktok_url = get_user_meta($current_user_id, 'tiktok_url', true);
$user_pic_id = get_user_meta($current_user_id, '_thumbnail_id', true);
// $user_pic = get_user_meta($current_user_id, 'user_pic', true);


?>
<div class="phone_menu_body manimated fadeIn">
	<div class="close_btn">
		<a href="javascript:void(0)" id="close_btn">×</a>
	</div>
 <?php require_once('custom/inc/sidebar-phone.php'); ?>	
</div>
<div class="container-wrap" id="placeimg">
	
	<div class="container main-content">
		<div class="row">
			<div class="user_dashboard">
				<div class="col span_3">
					<div class="phone_menu_btn">
                	   <a href="javascript:void(0)" id="menuBtn"><h4>Menu</h4></a>
                    </div>
                    <?php require_once('custom/inc/sidebar.php'); ?>
				</div>
				<div class="col span_9 col_last">
					<div class="user_panel">
						<div class="col span_4">
					        <div class="login_clm">
					        	<?php
					        	global $wpdb;
					        	$sql = "SELECT follower_email FROM ". $wpdb->prefix ."follow_system 
               WHERE followed =  ". get_current_user_id();
               $result = $wpdb->get_results($sql);
               $tfollowers = $wpdb->num_rows;
               

					        	?>
					        	<h3>Followers : <?= $tfollowers; ?> </h3>
						        <h4>Profile Photo</h4>
						        <div class="Profile">
						        	<!-- <p>Drop files anywhere to Upload</p> -->
						        	<?php
									$image_ur = wp_get_attachment_url($user_pic_id);
									
						        	if (empty($user_pic_id)) {
						        		?>
							        	<img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/06/placeholder-images-image_large.png" class="img-class">
							        	<?php
						        	}
							        	else{
							        		?>
							        	 <img src="<?= $image_ur; ?>" class="img-class"> 
							        		<?php
							        	}
						        	 ?>
						        	<!-- <ruby>OR</ruby> -->
						        </div>
						        <div class="mySelect">
						        	<label class="myLabel">
						        <form id="update-profile-form" method="post" enctype="multipart/form-data">
                                        <input type="file" name="user_pic" class="upload">
                                        <span>Select Files</span>
                                    </label>
						        </div>						        
<!-- 						        <div class="profile_view">
						        	<img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/preview.png">
						        </div> -->
					        </div>
						</div>
						<div class="col span_4">
					        <div class="login_clm">
						        <h4>Profile Detail</h4>
							        <label>Username</label>
							        <div class="fields">
							        	<?php
							        	 $user = get_user_by('ID',$current_user_id);
							        	 /*echo "<pre>";
							        	 var_dump($user);
							        	 echo "</pre>";exit();*/
							        	 ?>
								        <input type="text" name="name" placeholder="Markus John"   value=<?= ($user->user_login)? "$user->user_login": "";  ?> <?= ($user->user_login)? "disabled": "";  ?> > 
								         
							        </div>
							        <label>Email Address</label>
							        <div class="fields">
								       <input type="email" name="email" placeholder="info@example.com" value="<?= ($user->user_email)? "$user->user_email": "";  ?>" <?= ($user->user_email)? "disabled": "";  ?>>
								       <input type="hidden" name="user_id" value=<?= $current_user_id; ?> >
								       <input type="hidden" name="action" value="update_profile" >
								        
							        </div>
							        <label>First Name</label>
							        <div class="fields">
								       <input type="text" name="first_name" placeholder="Markus" value="<?= ($user->first_name)? "$user->first_name": "";  ?>">
								        
							        </div>
							        <label>Last Name</label>
							        <div class="fields">
								       <input type="text" name="last_name" placeholder="John" value="<?= ($user->last_name)? "$user->last_name": "";  ?>">
								        
							        </div>
							        <label>Phone Number</label>
							        <div class="fields">	
								       <input type="number" name="phone" placeholder="012 345 6789" value="<?= ($phone_no)? "$phone_no": "";  ?>">
								        
							        </div>
							        <label>State</label>
							        <div class="fields">
								       <input type="text" name="state" placeholder="Xyz state" value="<?= ($state)? "$state": "";  ?>">
								       
								        <!-- <input type="file" name="user_pic"> -->
								        
							        </div>
							        <label>City</label>
							        <div class="fields">
								       <input type="text" name="city" placeholder="Xyz City" value="<?= ($city)? "$city": "";  ?>">
								        
							        </div>
							        <label>Facebook URL</label>
							        <div class="fields">
								       <input type="url" name="fb_url" placeholder="Facebook.abcdefg" value="<?= ($fb_url)? "$fb_url": "";  ?>">
								        
							        </div>
							        <label>Instagram URL</label>
							        <div class="fields">
								       <input type="url" name="insta_url" placeholder="Instagram.abcdefg" value="<?= ($insta_url)? "$insta_url": "";  ?>">
								        
							        </div>
							        <label>Youtube URL</label>
							        <div class="fields">
								       <input type="url" name="utube_url" placeholder="Youtube.abcdefg" value="<?= ($utube_url)? "$utube_url": "";  ?>">
								        
							        </div>
							        <label>Tik Tok URL</label>
							        <div class="fields">
								       <input type="url" name="tiktok_url" placeholder="Tiktok.abcdefg" value="<?= ($tiktok_url)? "$tiktok_url": "";  ?>">
							        </div>
							        <label>Retype New Password</label>
							        <div class="fields">
								       <input type="password" name="retype_pass" placeholder="****************" class="required">
							        </div>	    
							        <button name="Profile_update" id="update-profile" type="submit">Update</button>												
						        </form>
					        </div>
						</div>
						<div class="col span_4 col_last">
					        <div class="login_clm">
						        <h4>Change Password</h4>
						        <form id="change_password" method="post">
							        <label>Current Password</label>
							        <div class="fields">
								        <input type="password" name="current_pass" placeholder="****************">
								        <input type ="hidden" name="action" value="update_pswd">
								         
							        </div>
							        <label>New Password</label>
							        <div class="fields">
								       <input type="password" name="new_pass" id="pass_update" placeholder="****************">
								        
							        </div>
							        <label>Confirm New Password</label>
							        <div class="fields">
								       <input type="password" name="confirm_new_pass" placeholder="****************">
								        
							        </div>							        							    
							        <button name="update_btn" id="update-pswd">Update</button>												
						        </form>
					        </div>
						</div>												
					</div>					
				</div>
			</div>
		</div><!--/row-->
	</div><!--/container-->
</div><!--/container-wrap-->
<?php get_footer(); ?>