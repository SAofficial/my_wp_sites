<?php 

/*
Template Name: My Reviews Template
*/

get_header(); 
nectar_page_header($post->ID); 

//full page
$fp_options = nectar_get_full_page_options();
extract($fp_options);

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
						<div class="col span_12">
					        <div class="history_clm">
						        <h2>User Reviews</h2>
					        </div>
					        <!-- <div class="mark_btn2">User Review</div> -->
						    <div class="reviews_body">
						    	<div class="main_reveiws">
						    		<?php

						    			    	if (isset($_GET['post_id'])) {
						    			    		?>
						    		<h6>Overall Rating</h6>
						    		<div class="star-rating"><s class="active"><s class="active"><s class="active"><s><s></s></s></s></s></s></div>
                                    <div class="show-result">3</div>
						    	</div>
						    	<?php
					
						    		# code...
										$the_query =  new WP_Query( array(
										'posts_per_page' 	=> -1,
		                                'post_type'       	=> 'review',
		                                'order'           	=> 'DESC',
		                                'post_status' 		=> array('publish', 'draft') ,
		                                'meta_query'      =>
		                                    array(
		                                       array(
		                                           'relation' => 'AND',
		                                         array(
		                                        'key' => 'challenge_id',
		                                        'value' => $_GET['post_id']
		                                       )
		                                            
		                                  )
		                                    )
		                                 )
		                              );
									if ( $the_query->have_posts() ) {
		                      			while ( $the_query->have_posts() ) {
		                      				$the_query->the_post();
												$review_id 	= get_the_ID();
												$rating 	= get_post_meta( $review_id, 'ratingValue', true );
												$review 	= get_post_meta( $review_id, 'review', true );
												$thumbnail_id = get_post_thumbnail_id($review_id);
							        			$user_img =	wp_get_attachment_image_url($thumbnail_id, 'home-slide-img-mobile',true);
													?>
													<div class="client_reviews">
						    							<div class="client_img">
						    								<img src="<?= $user_img; ?>">
						    					</div>
						    					<div class="content_box">
									    			<p><b>Markus Gater</b></p>
									    			<div class="star-rating">
									    				<?php
									    				for ($i=1; $i <=$rating ; $i++) { 
									    					echo "<s class=active></s>";
									    				}
									    				?>
									    			</div>
									    			<p><?= $review; ?></p>
									    		</div>
						    						</div>	
													<?php
												}
											}
											else{
												/*$the_query =  new WP_Query( array(
													'posts_per_page' 	=> -1,
					                                'post_type'       	=> 'review',
					                                'order'           	=> 'DESC',
					                                'post_status' 		=> array('publish', 'draft')
					                                 )
					                              );
													if ( $the_query->have_posts() ) {
		                      							while ( $the_query->have_posts() ) {
		                      								$challenge_id = get
		                      			}
		                      		}*/
		                      		?>
		                      		<div class="client_reviews">
						    		<div class="client_img">
						    			<img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/client-img2.png">
						    		</div>
						    		<div class="content_box">
						    			<p><b>Markus Gater</b></p>
						    			<div class="star-rating"><s class="active"><s class="active"><s class="active"><s><s></s></s></s></s></s></div>
						    			<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's lorem Ipsum has been the industry's.</p>
						    		</div>
						    	</div>		

						    	<?php
											}
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
<?php get_footer(); ?>