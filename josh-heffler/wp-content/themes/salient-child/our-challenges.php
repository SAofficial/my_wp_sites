<?php 

/*
Template Name: Our Challenges Template
*/
if (isset($_GET['challenge_id']) && !empty($_GET['challenge_id']) && is_numeric($_GET['challenge_id'])) {
	
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
				$post_id 	= $_GET['challenge_id'];
				$post_data  = get_post($post_id);
				//$user_id    = $post_data->post_author;
				$user       = get_post_meta( $post_id, 'author_name', true );
				$user_id    = get_post_meta( $post_id, 'author_id', true );
						$user_pic_id   = get_user_meta($user_id, '_thumbnail_id', true);
						$image_url_user = 	wp_get_attachment_image_url($user_pic_id, 'home-slide-img-mobile',true);
						if (!empty($user_pic_id))
						{
		
						?>
						<img style="float: right;" class="inner-clng" src="<?= $image_url_user; ?>">
				<?php
			}

				
				$title 		= get_post_meta( $post_id, 'challenge_title', true );
				$desc 		= get_post_meta( $post_id, 'description', true );
				$category 	= wp_get_post_terms($post_id,'category_custom', array('fields' => 'names' ) );
				$goal 		= get_post_meta( $post_id, 'financial_goal', true );
				// $video_url 	= get_post_meta( $post_id, 'video_url', true );
				$post_date 	= get_the_date( 'F j, Y' );
				?>
				<div class="col span_3">
					<div class="Challenge_image">
						<?php
 						$thumbnail_id = get_post_thumbnail_id($post_id);
						$image_url = 	wp_get_attachment_image_url($thumbnail_id, 'home-slide-img-mobile',true);
						?>
						<img class="inner-clng" src="<?= $image_url; ?>">
					</div>
				</div>
				<div class="col span_9 col_last">
					<div class="Challenge_details">
						<div class="details_inner">
							<h6>Challenge Created By</h6>
						    <p><?= $user ?></p>
						</div>
						<div class="details_inner">
							<h6>Title</h6>
						    <p><?= $title ?></p>
						</div>
						<div class="details_inner">
							<h6>Category</h6>
						    <p><?= $category[0]; ?></p>
						</div>
						<div class="details_inner">
							<h6>Description</h6>
						    <p><?= $desc; ?></p>
						</div>
						<div class="details_inner">
							<h6>Financial Goal</h6>
						    <p><?= $goal; ?></p>
						    	<?php
			    			$repeater_field = get_field('amount',$post_id);
			    			$sum =0;
			    			  while( the_repeater_field('amount',$post_id) ){

			    			  		 $sum = (int)get_sub_field('amount',$post_id) + $sum;
			    			  }
			    			  if ($goal != 0) {
			    			  $reached = ($sum*100)/(int)$goal;

			    			  }
			    		
			    			?>
			    			<progress class="sb-progress sb-progress--orange" value="<?= $reached; ?>" max="100"></progress>
			    			<h2>$<?= $sum; ?></h2>
			    			<p>Pledged of $<?= $goal; ?></p>
						</div>
						<div class="details_inner">
							<?php echo do_shortcode('[review_form]'); ?>
							<?php echo do_shortcode('[ssba]'); ?>
							<div >
							<?php
							if (get_current_user_id() == 0) {
								?>
								<h3>
							<a href=<?= home_url().'/login-register?redirect_url=new-challenge&challenge_id='.$post_id; ?> >
								Accept Challengesss
							</a>
						</h3>
								<?php
							}
							else{
								?>
								<h3>
							<a href="<?php $link = home_url();
							echo $link;?><?php echo '/new-challenge/?challenge_id='.$post_id?>">Accept Challenge</a></h3>
								<?php
							}
							?>
							<br>
							<form method ="post" id="like-unlike">
								<input type="hidden" name="likeof"  value="<?php echo $post_id;?>">
								<input type="hidden" name="action" value="like_unlike">
								<?php
								if ($current_user_id != 0) {
									?>
									<button type="button" id="like-btn"><?= ((checklike($post_id))? 'UnLike':'Like'); ?></button>
									<?php
								}
								?>

							</form>
							</div>
							<br>
							<?php
							if($user_id != $current_user_id){
								?>
							<form method ="post" id="follow-unfollow">
								<input type="hidden" name="followerof"  value="<?php echo $user_id;?>">
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
									<button type="button" id="follow-btn"><?= ((checkfollow($user_id))? 'Unfollow':'Follow'); ?></button>
									<?php
								}
								?>

							</form>
							<?php
							}
							?>


						</div>	
						<div class="details_inner">
							<form method="post" id="stripe_form">
								<input type="hidden" name="token">
						           <input type="hidden" name="action" value="stripe_payment">
						           <label>Name</label>
						           <input type="text" 	name="your_name" placeholder="Your name" class="required">
						           <label>$1000</label>
						           <input type="number" name="amount" placeholder="Amount in USD (only digits)" class="required">
						           <input type="hidden" name="post_id" value="<?= $post_id; ?>">
					            <div class="group">
					                <div class="col span_6">
					                <label>
					                  <span>Card number</span>
					                  <div id="card-number-element" class="field"></div>
					                </label>
					              </div>
					               <div class="col span_6 col_last">
					                <label>
					                  <span>Expiry date</span>
					                  <div id="card-expiry-element" class="field"></div>
					                </label>
					              </div>
					               <div class="col span_12">
					                <label>
					                  <span>CVC</span>
					                  <div id="card-cvc-element" class="field"></div>
					                </label>
					              </div>
					                <!-- <label>
					                  <span>Postal code</span>
					                  <input id="postal-code" name="postal_code" class="field" placeholder="Postal Code" />
					                </label> -->
            						</div>
            						<button type="submit" name="donate">Raise</button>
            						<div class="outcome">
					              <div class="error"></div>
					              <div class="success" style="display: none;"> Success! Your Stripe token is <span class="token"></span></div>
						            </div>
							</form>
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