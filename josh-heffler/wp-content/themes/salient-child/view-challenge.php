<?php 

/*
Template Name: View Challenge Template
*/

get_header(); 
nectar_page_header($post->ID); 

//full page
$fp_options = nectar_get_full_page_options();
extract($fp_options);

if (isset($_GET['post_id']) && !empty($_GET['post_id']) ) {

	$post_id 	= $_GET['post_id'];
	$title 		= get_post_meta( $post_id, 'challenge_title', true );
	$desc 		= get_post_meta( $post_id, 'description', true );
	$category 	= wp_get_post_terms($post_id,'category_custom', array('fields' => 'names' ) );
	$goal 		= get_post_meta( $post_id, 'financial_goal', true );
	$status 	= get_post_status ( $post_id );
	$video_url 	= get_post_meta( $post_id, 'video_url', true );
	$post_date 	= get_the_date( 'F j, Y' );
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
						        <h2>Challenge</h2>
						        <?php
						        if ($_GET['action'] == 'view' ) {
						        	?>
						        	<form action="" method="post">
							        <div class="history_box">
							        	<label>Title</label>
							        	<div class="fields">
								            <input type="text" name="title" disabled="" value="<?= $title; ?>">
								            <a href="javascript:void(0)"></a>
								        </div>
							        </div>
							         <div class="history_box">
							        	<label>Category</label>
							        	<div class="fields">
								            <input type="text" name="cat" disabled="" value="<?= $category[0]; ?>">
								            <a href="javascript:void(0)"></a>
								        </div>
							        </div>
							        <div class="history_box">
							        	<label>Description</label>
							        	<div class="fields">
								            <textarea name="Description" disabled=""><?= $desc; ?></textarea>
								            <a href="javascript:void(0)"></a>
								        </div>
							        </div>	
							        <div class="history_box">
							        	<label>Financial Goal</label>
							        	<div class="fields">
								            <input type="text" name="Financial" disabled="" value="<?= $goal; ?>">
								            <a href="javascript:void(0)"></a>
								        </div>
								        <strong><a class="link-class" style="color: #fd9424;" href="<?= home_url().'/my-reviews/?post_id='.$post_id ?>">View Reviews</a></strong>
							        </div>							        						    
						        </form>
						                </div>
								</div>
								<div class="col span_5 col_last">
					        <div class="history_clm">
						        <div class="Profile">
						        	<?php

						        	$thumbnail_id = get_post_thumbnail_id($post_id);
							        $x = 	wp_get_attachment_image_url($thumbnail_id, 'home-slide-img-mobile',true);

						        	?>
						        	<img src=<?= $x; ?>>
						        	<!-- <p>Drop files anywhere to Upload</p>
						        	<ruby>OR</ruby> -->
						        	<!-- <div class="mySelect">
						        		<label class="myLabel">
                                            <input type="file" name="upload_file" class="upload">
                                            <span>Select Files</span>
                                        </label>
						        	</div> -->
						        </div>
					        </div>
						</div>		
						        <?php
						        }
						        if ($_GET['action']== 'edit') {
						        	?>
						        	 <form id="edit-challenge" method="post">
							        <div class="history_box">
							        	<label>Title</label>
							        	<div class="fields">
								            <input type="text" name="title" class="required" value=<?= $title; ?>>
								            <input type="hidden" name="post_id" value=<?= $_GET['post_id']; ?>>
								            <a href="javascript:void(0)"><i class="fa fa-pencil" aria-hidden="true"></i></a>
								        </div>
							        </div>
							         <div class="history_box">
							        	<label>Category</label>
							        	<div class="fields">
							        		<select name="cat" class="required">
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
								            
								        	<!-- <label>Add video Button</label> -->
								            <input type="hidden" name="action" value="edit_challenge">
								        </div>
							        </div>
							        <div class="history_box">
							        	<label>Description</label>
							        	<div class="fields">
							        		<?php if(get_post_status($post_id) != 'complete'){
							        			?>
							        		<input type="file" name="video">
							        	<?php }?>
								            <textarea name="Description" class="required"><?= $desc; ?></textarea>
								            <a href="javascript:void(0)"><i class="fa fa-pencil" aria-hidden="true"></i></a>
								        </div>
							        </div>	
							        <div class="history_box">
							        	<label>Financial Goal</label>
							        	<div class="fields">
								            <input type="text" name="Financial" class="required" value="<?= $goal; ?>">
								            <a href="javascript:void(0)"><i class="fa fa-pencil" aria-hidden="true"></i></a>
								        </div>
							        </div>							        						    
							        <button name="history_save" type="submit" disabled="true">Save</button>												
						        </form>
					        </div>
							</div>
							<div class="col span_5 col_last">
						        <div class="history_clm">
						        <!-- <div class="mark_btn" data-id="<?= $_GET['post_id']; ?>"> -->
						        	<!-- Mark Completed <i class="fa fa-thumbs-up" aria-hidden="true"></i> -->
						        <!-- </div> -->
						        <div class="Profile">
						        	<?php
						        	$thumbnail_id = get_post_thumbnail_id($post_id);
							        $x = 	wp_get_attachment_image_url($thumbnail_id, 'home-slide-img-mobile',true);
							        							        
						        	?>
						        	<img src=<?= $x; ?>>
						     
						        	<video width="400" controls>
										  <source src=<?= $video_url; ?>>
										  Your browser does not support HTML video.
									</video>
						        	<!-- <p>Drop files anywhere to Upload</p>
						        	<ruby>OR</ruby>
						        	<div class="mySelect">
						        		<label class="myLabel">
                                            <input type="file" name="upload_file" class="upload">
                                            <span>Select Files</span>
                                        </label>
						        	</div> -->
						        </div>
					        </div>
						</div>	

						        	<?php
						        }
						        ?>
						       											
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
}

 ?>