<?php 

/*
Template Name: Login Register Temaplate
*/

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
				<div class="col span_5">
					<div class="login_clm">
						<h2>Login Now</h2>
						<form method="post" id="user-login-form">
							<label>Enter Email Or Username</label>
							<div class="fields">
								<input type="text" name="user_name" placeholder="Info@Company.com">
								<input type="hidden" name="redirect_url" value="<?= (!empty( $_GET['redirect_url']) && isset( $_GET['redirect_url'] ) )? $_GET['redirect_url'] : '' ; ?>">
								<input type="hidden" name="challenge_id" value="<?= (!empty( $_GET['challenge_id']) && isset( $_GET['challenge_id'] ) )? $_GET['challenge_id'] : '' ; ?>">
								<input type="hidden" name="user_id" value="<?= (!empty( $_GET['user_id']) && isset( $_GET['user_id'] ) )? $_GET['user_id'] : '' ; ?>">
								<input type="hidden" name="lchallenge_id" value="<?= (!empty( $_GET['lchallenge_id']) && isset( $_GET['lchallenge_id'] ) )? $_GET['lchallenge_id'] : '' ; ?>">
								
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</div>
							<label>Enter password</label>
							<div class="fields">
								<input type="password" name="pass" placeholder="**************">
								<input type="hidden" name="action" value="user_login">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</div>	
							<div class="col span_6">
								<div class="check_box">
									<input type="checkbox" name="user_system_remember">Remember me
								</div>
							</div>	
							<div class="col span_6 col_last">
								<div class="forget_anchor">
									<a href=<?= home_url().'/forget-password'; ?> >Forgot Password?</a>
								</div>
							</div>
							<button name="login_btn" id="login-user">LOGIN</button>													
						</form>
					</div>
				</div>
				<div class="col span_7 col_last">
					<div class="login_clm">
						<div class="regiter_box">
						<div class="col span_7">
						    <h2>Register Now</h2>
						    <form method="post" id="user_register_form">
							    <label>Enter Username</label>
							    <div class="fields">
								    <input type="text" name="username" placeholder="Info@Company.com">
								    <i class="fa fa-envelope" aria-hidden="true"></i>
							    </div>	
							    <label>Enter Email</label>
							    <div class="fields">
								    <input type="email" name="email" placeholder="Info@Company.com">
								    <i class="fa fa-envelope" aria-hidden="true"></i>
							    </div>	
							    <label>Enter Password</label>
							    <div class="fields">
								    <input type="password" id="pass" name="pass" placeholder="****************">
								    <input type="hidden" name="action" value="daily_user_registration_form">
								    <i class="fa fa-lock" aria-hidden="true"></i>
							    </div>	
							    <label>Confirm Password</label>
							    <div class="fields">
								    <input type="password" name="c_pass" placeholder="****************">
								    <i class="fa fa-lock" aria-hidden="true"></i>
							    </div>
								<div class="check_box">
									<input type="checkbox" name="registering">By registering, you accept our Terms & Conditions
								</div>	
								<div class="check_box">
									<input type="checkbox" name="registering2" checked>Opt-in to receive email updates about new exciting challenges
								
								</div>
								<button name="Register_btn" id="register_submit" type="submit">Register</button>   
							</form>						
						</div>
						<div class="col span_5 col_last">
							<div class="social_btns">
								<ul>
									<li><?php 
									echo do_shortcode("[nextend_social_login provider='google']");
								?></li>
									
									<!-- <li><a href="#"><img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/google.png"></a></li> -->
									<li><a href="#"><img src="http://dev3.onlinetestingserver.com/josh-heffler/wp-content/uploads/2020/05/fb.png"></a></li>
								</ul>
							</div>
						</div>
					</div>
				    </div>
				</div>			
			</div>
		</div><!--/row-->
	</div><!--/container-->
</div><!--/container-wrap-->
<?php get_footer(); ?>



