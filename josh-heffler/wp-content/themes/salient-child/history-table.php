<?php 

/*
Template Name: History Table Template
*/

get_header(); 
nectar_page_header($post->ID); 

//full page
$fp_options = nectar_get_full_page_options();
extract($fp_options);

?>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


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
							<div class="history_table">
								<table id="example" class="table table-striped table-bordered zero-configuration" style="width:100%">
								 <thead>
								 	<?php
										$the_query =  new WP_Query( array(
										'posts_per_page' 	=> -1,
		                                'post_type'       	=> 'challenges',
		                                'order'           	=> 'DESC',
		                                'post_status' 		=> array('complete', 'in-active','publish') ,
		                                'author'        	=>  $current_user->ID
		                               /* 'meta_query'      =>
		                                    array(
		                                       array(
		                                           'relation' => 'OR',
		                                         array(
		                                        'key' => 'user_id',
		                                        'value' => $current_user->ID
		                                       )
		                                            
		                                  )
		                                    )*/
		                                 )
		                              );

								 	?>
									<tr>
										<th>Title</th>
										<th>Category</th>
										<th>Status</th>
										<th>Challenge Amount</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
									</thead>
									<tbody>
											<?php
									if ( $the_query->have_posts() ) {
		                      			while ( $the_query->have_posts() ) {
		                      				$the_query->the_post();
												$post_id 	= get_the_ID();
												$title 		= get_post_meta( $post_id, 'challenge_title', true );
												$category 	= wp_get_post_terms($post_id,'category_custom', array('fields' => 'names' ) );
												$goal 		= get_post_meta( $post_id, 'financial_goal', true );
												$status 	= get_post_status ( $post_id );
												$post_date 	= get_the_date( 'F j, Y' );

												?>
													<tr id=<?= $post_id; ?>>
												<td><?= $title; ?></td>
												<td><?= ((!empty($category[0]))? $category[0]:'') ; ?></td>
												<td><?= $status; ?></td>
												<td>$<?= $goal ?></td>
												<td><?= $post_date; ?></td>
												<td>
											<ul>
												<li><a href="<?= home_url().'/view-challange?post_id='.$post_id.'&action=view' ; ?>" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i><p>View</p></a></li>
												<li><a href="<?= home_url().'/view-challange?post_id='.$post_id. '&action=edit' ; ?>" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i><p>Edit</p></a></li>
												<li><a href="javascript:void(0)" ><i class="fa fa-trash-o" aria-hidden="true"></i><p class="delete-btn" data-id=<?= $post_id; ?>>Delete</p></a></li>
											</ul>
										</td>
									</tr>
												<?php
						                }
		                      		 }?>
								
									</tbody>
								</table>
							</div>
						</div>												
					</div>					
				</div>
			</div>
		</div><!--/row-->
	</div><!--/container-->
</div><!--/container-wrap-->
<?php get_footer(); ?>