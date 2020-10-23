<?php 

/*
Template Name: Reset Password Template
*/
$user_id = get_current_user_id();
if (isset($_GET['id']) && !empty($_GET['id']) && $user_id == 0) {

get_header(); 
nectar_page_header($post->ID); 

//full page
$fp_options = nectar_get_full_page_options();
extract($fp_options);

?>
<div class="container-wrap" id="placeimg">
	
	<div class="container main-content">
		<div class="row">
			<div class="main_sec">
				<div class="forget_pass">
				    <div class="col span_12">
					    <div class="login_clm">
						    <h2>Reset Your Password</h2>
						    <form id="reset_password_form" method="post">
							    <label>Enter New Password</label>
							    <div class="fields">
								    <input type="password" name="pass" id="pass2" placeholder="****************">
								    <i class="fa fa-lock" aria-hidden="true"></i>
							    </div>
							    <label>Retype New Password</label>
							    <div class="fields">
								    <input type="password" name="c_pass" placeholder="****************">
								    <input type="hidden" name="user_id" value=<?= $_GET['id']; ?>>
								    <input type="hidden" name="action" value="reset_password_custom" >
								    <i class="fa fa-lock" aria-hidden="true"></i>
							    </div>							    
							    <button name="forget_submit" type="submit" id="reset-pswd-btn">Submit</button>												
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
}
 ?>}
