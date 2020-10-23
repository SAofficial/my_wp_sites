<?php 

/*
Template Name: User Dashboard Template
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
	<?php 
	require_once('custom/inc/sidebar-phone.php');
	?>			
</div>
<div class="container-wrap" id="placeimg">
	
	<div class="container main-content">
		<div class="row">
			<div class="user_dashboard">
				<div class="col span_3">
					<div class="phone_menu_btn">
                	   <a href="javascript:void(0)" id="menuBtn"><h4>Menu</h4></a>
                    </div>
					<?php 
						require_once('custom/inc/sidebar.php');
						?>	
				</div>
				<div class="col span_9 col_last">
					<div class="user_panel">
						<div class="col span_4">
							<a href=<?= home_url().'/new-challenge'; ?> >
							    <div class="user_box">
								    <div class="icon_box">
									    <img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/i1.png">
								    </div>
								    <div class="text_box">
									    <h4>Create New Challenge</h4>
								    </div>
							    </div>
							</a>
						</div>
						<div class="col span_4">
							<a href=<?= home_url().'/challenge-history'; ?> >
							    <div class="user_box">
								    <div class="icon_box">
									    <img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/i2.png">
								    </div>
								    <div class="text_box">
									    <h4>Challenge History</h4>
								    </div>
							    </div>
						    </a>
						</div>
						<div class="col span_4 col_last">
							<a href=<?= home_url().'/financial-dashboard'; ?> >
							    <div class="user_box">
								    <div class="icon_box">
									    <img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/i3.png">
								    </div>
								    <div class="text_box">
									    <h4>Financial Dashboard</h4>
								    </div>
							    </div>
						    </a>
						</div>												
					</div>
					<div class="user_panel">
						<div class="col span_4">
							<a href=<?= home_url().'/user-profile/'; ?>>
							    <div class="user_box">
								    <div class="icon_box">
									    <img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/i4.png">
								    </div>
								    <div class="text_box">
									    <h4>My Profile</h4>
								    </div>
							    </div>
						    </a>
						</div>
						<div class="col span_4">
							<a href=<?= home_url().'/setting'; ?>>
							    <div class="user_box">
								    <div class="icon_box">
									    <img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/i5.png">
								    </div>
								    <div class="text_box">
									    <h4>Settings</h4>
								    </div>
							    </div>
						    </a>
						</div>
						<div class="col span_4 col_last">
							<a href=<?= home_url().'/my-reviews'; ?>>
							    <div class="user_box">
								    <div class="icon_box">
									    <img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/i6.png">
								    </div>
								    <div class="text_box">
									    <h4>Reviews</h4>
								    </div>
							    </div>
						    </a>
						</div>												
					</div>					
				</div>
			</div>
		</div><!--/row-->
	</div><!--/container-->
</div><!--/container-wrap-->
<?php get_footer(); ?>