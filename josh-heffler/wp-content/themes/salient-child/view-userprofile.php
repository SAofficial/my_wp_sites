<?php
/*
Template Name: User Profile Template
*/

if (isset($_GET['user_id']) && !empty($_GET['user_id']) && is_numeric($_GET['user_id'])) {
	
get_header(); 
nectar_page_header($post->ID); 

//full page
$fp_options = nectar_get_full_page_options();
extract($fp_options);

?>
<style type="text/css">
	.Challenge_image img.inner-clng{
		height: auto !important;
	}
	 a.follow_a_tag{
     font-size: 24px; 
     font-family: Teko; 
     padding: 5px 18px !important; 
     border: none; 
     background-color: #ff8a0d; 
     color: #fff; 
     cursor: pointer; 
}

</style>
<div class="phone_menu_body manimated fadeIn">
	<div class="close_btn">
		<a href="javascript:void(0)" id="close_btn">×</a>
	</div>
 <?php // require_once('custom/inc/sidebar-phone.php'); ?>		
</div>
<div class="container-wrap" id="placeimg">
	
	<div class="container main-content">
		<div class="row">
			<div class="our_challenges">
				<?php
				$current_userid= $_GET['user_id'];
				$userdata		= get_user_by('ID',$current_userid);
				$uname			= $userdata->user_login;
				$fname			= $userdata->first_name;
				$lname			= $userdata->last_name;
				$email			= $userdata->user_email;
				$state 			= get_user_meta($current_userid, 'state', true);
				$phone_no 		= get_user_meta($current_userid, 'phone_no', true);
				$city 			= get_user_meta($current_userid, 'city', true);
				$fb_url 		= get_user_meta($current_userid, 'fb_url', true);
				$insta_url 		= get_user_meta($current_userid, 'insta_url', true);
				$utube_url 		= get_user_meta($current_userid, 'youtube_url', true);
				$tiktok_url 	= get_user_meta($current_userid, 'tiktok_url', true);
				$user_pic_id 	= get_user_meta($current_userid, '_thumbnail_id', true);
				?>

				<div class="col span_3">
					<h2>Followers</h2>
					<div class="Challenge_image">
						<?php $image_url = wp_get_attachment_url($user_pic_id);
						if (empty($user_pic_id)) {
						        		?>
							        	<img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/06/placeholder-images-image_large.png" class="img-class">
							        	<h6 align="center">Profile Photo</h6>
							        	<?php
						        	}
							        	else{
							        		?>
							        	 <img class="inner-clng" src="<?= $image_url; ?>">
							        	 <h6 align="center">Profile Photo</h6>
							        		<?php
							        	}
						       	 ?>
 											
					</div>
				</div>
				<div class="col span_9 col_last">
					<div class="Challenge_details">
						<div class="details_inner">
							<h6>User Name</h6>
						    <p><?= $uname; ?></p>
						</div>
						<div class="details_inner">
							<h6>First Name</h6>
						    <p><?= $fname; ?></p>
						</div>
						<div class="details_inner">
							<h6>Last Name</h6>
						    <p><?= ($lname)? $lname:'profile not updated by user'; ?></p>
						</div>
						<div class="details_inner">
							<h6>Email Address</h6>
						    <p><?= $email; ?></p>
						</div>
						<div class="details_inner">
							<h6>Phone Number</h6>
						    <p><?= $phone_no; ?></p>
						</div>
						<div class="details_inner">
							<h6>State</h6>
						    <p><?= $state; ?></p>
						</div>
						<div class="details_inner">
							<h6>City</h6>
						    <p><?= $city; ?></p>
						</div>
						<div class="details_inner">
							<h6>Facebook URL</h6>
						    <p><?= $fb_url; ?></p>
						</div>
						<div class="details_inner">
							<h6>Instagram URL</h6>
						    <p><?= $insta_url; ?></p>
						</div>
						<div class="details_inner">
							<h6>Youtube URL</h6>
						    <p><?= $utube_url; ?></p>
						</div>
						<div class="details_inner">
							<h6>Tik Tok URL</h6>
						    <p><?= $tiktok_url; ?></p>
						</div>
						<div class="details_inner">
							<?php //echo do_shortcode('[review_form]'); ?>
							<?php echo do_shortcode('[ssba]'); ?>
						</div>
						<div class="details_inner">
							<?php
							if($current_userid != $current_user_id){

								?>
							<form method ="post" id="follow-unfollow">
								<input type="hidden" name="followerof"  value="<?php echo $current_userid;?>">
								<input type="hidden" name="follower"  value="<?php echo get_current_user_id();?>">
								<input type="hidden" name="action" value="follow_unfollow">
								<?php
								if ($current_user_id == 0) {
									?>
									<a href="<?= home_url().'/login-register/?redirect_url=view-uprofile&user_id='.$current_userid;?>" class="follow_a_tag">Follow</a>
									<?php
								}
								else{
									?>
									<button type="button" id="follow-btn"><?= ((checkfollow($current_userid))? 'Unfollow':'Follow'); ?></button>
									<?php
								}
								?>

							</form>
							<?php
							}
							?>
						</div>

						
						</div>			
					</div>
				</div>
			</div>
		</div><!--/row-->
	</div><!--/container-->
</div><!--/container-wrap-->
<?php get_footer();
}
else{
	wp_redirect(home_url());
} ?>