<?php 

/*
Template Name: New Challenge Template
*/
$user_id = get_current_user_id();
if ($user_id != 0) {
get_header(); 
nectar_page_header($post->ID); 

//full page
$fp_options = nectar_get_full_page_options();
extract($fp_options);


if (isset($_GET['challenge_id'])) {

if(!empty($_GET['challenge_id']) && is_numeric($_GET['challenge_id']) && !is_null(get_post($_GET['challenge_id'])) && get_post_type($_GET['challenge_id']) == 'challenges' ){
	$post_id 	= $_GET['challenge_id'];
	$title 		= get_post_meta( $post_id, 'challenge_title', true );
	$Description = get_post_meta( $post_id, 'description', true );
	$category 	= wp_get_post_terms($post_id,'category_custom', array('fields' => 'names' ) );
	$Financial 	= get_post_meta( $post_id, 'financial_goal', true );
	$Donation   = get_post_meta( $post_id, 'donation', true );
	$thumbnail_id = get_post_thumbnail_id($post_id);
	$image_url = 	wp_get_attachment_image_url($thumbnail_id, 'home-slide-img-mobile',true);

}
else{
	wp_redirect(home_url().'/user-dashboard');
	}
}


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
						<div class="col span_7">
					        <div class="history_clm">
						        <h2>Create New Challenge</h2>
						        <form id="create-challenge" method="post">
							        <div class="history_box">
							        	<label>Title</label>
							        	<div class="fields">
								            <input type="text" name="title" class="required" value="<?php echo (isset($title)? $title : ''); ?>">
								            <input type="hidden" name="action" value="create_challenge">
								        	<input type="hidden" name="image_url" value="<?= (empty($image_url)? '' : $image_url); ?>">

								        </div>
							        </div>
							          <div class="history_box">
							        	<label>Category</label>
							        	<div class="fields">
							        			
												<!-- /*echo "<pre>";
												var_dump($terms);
												echo "</pre>";*/
 -->

								            <select name="cat" class="required">
								            	<option value="">::Select Any::</option>
								            	<?php
												$terms = get_terms([
													    'taxonomy' => 'category_custom',
													    'hide_empty' => false,
													]);
												foreach ($terms as $term) {
													echo "<option value=".$term->term_id." ".(($term->name == $category[0])? 'selected': '').">".$term->name."</option>";
												}
												?>
								            </select>
								        </div>
							        </div>
							        <div class="history_box">
							        	<label>Description</label>
							        	<div class="fields">
								            <textarea name="Description" class="required"><?php echo (isset($Description)? $Description : ''); ?></textarea>
								        </div>
							        </div>	
							        <div class="history_box">
							        	<label>Financial Goal</label>
							        	<div class="fields">
								            <input type="text" name="Financial" class="required"><br>
								            <input type="checkbox" id="donate" name="donation" value="<?= ($donation == 'Yes')? 'Yes':'No' ?>">
  											<label for="Doantion">Donate Challenge Proceeds to Charity</label><br>
								        	<div class="mySelect">
								        		<label class="myLabel">
		                                            <input type="file" id="myLabel" name="dare_pic" class="<?= (empty($image_url)? 'required' : ''); ?> upload">
		                                            <span>Select Files</span>
		                                        </label>
								        	</div>								            
								        </div>
							        </div>							        						    
							        <button name="challenge_create">Create</button>												
						        </form>
					        </div>
						</div>
						<div class="col span_5 col_last">
					        <div class="history_clm">
						<!--<div class="mark_btn">
						        	Mark Completed <i class="fa fa-thumbs-up" aria-hidden="true"></i>
						        </div> -->
						        <div class="Profile">
						        	<!-- <p>Drop files anywhere to Upload</p> -->
						        	<?php
						        	$uploaddir = wp_upload_dir();
								    $image_ur = $uploaddir['baseurl']; 
						        	if(isset($image_url))
						        	{
						        	?>				
							        	<img src="<?= $image_url; ?>" class="img-class">
							        <?php
							        }
							        else
							        {
							        ?>
							           <img src="<?= $image_ur.'/2020/06/placeholder-images-image_large.png'; ?>" class="img-class">
							        <?php
							        }
							        ?>	
	<!-- 						        	<ruby>OR</ruby>
						        	<div class="mySelect">
						        		<label class="myLabel">
                                            <input type="file" name="upload_file" class="upload">
                                            <span>Select Files</span>
                                        </label>
						        	</div>
 -->						    </div>
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
	wp_redirect(home_url().'/login-register?redirect_url=new-challenge');
}
 ?>

