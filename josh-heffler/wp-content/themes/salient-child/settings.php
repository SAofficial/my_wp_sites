<?php 

/*
Template Name: Setting Template
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
						<div class="col span_6">
					        <div class="login_clm">
						        <h4>Privacy</h4>
						        <form action="" method="post" class="provacy_fom">
							        <div class="fields">
								        <input type="checkbox" checked="" name="news_check">I want to recieve monthly newsletter
							        </div>							        							    
							        <div class="fields">
								        <input type="checkbox" checked="" name="goal_check">I want to recieve email notification of goal reach
							        </div>	
							        <div class="fields">
								        <input type="checkbox" checked="" name="review_check">I want to recieve email alerts about new reviews
							        </div>	
							        <button name="check_btn">Update</button>												
						        </form>
					        </div>
						</div>
						<div class="col span_6 col_last">
					        <div class="login_clm">
						        <h4>Delete Account</h4>
						        <form action="" method="post">
							        <label>Enter Reason</label>
							        <div class="fields">
								        <select name="reason_select">
								        	<option value="blank">Select Reason</option>
								        	<option value="Select Reason">Select Reason 1</option>
								        	<option value="Select Reason">Select Reason 2</option>
								        	<option value="Select Reason">Select Reason 3</option>
								        </select>
							        </div>
							        <label>Description</label>
							        <div class="fields">
							        	<textarea name="discription"></textarea>
							        </div>						        							    
							        <button name="delete_btn">Delete</button>												
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