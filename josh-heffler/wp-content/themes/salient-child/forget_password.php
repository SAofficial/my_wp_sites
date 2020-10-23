<?php 

/*
Template Name: Forget Password Template
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
				<div class="forget_pass">
				    <div class="col span_12">
					    <div class="login_clm">
						    <h2>Retreive Your Account</h2>
						    <form id="forget_pass_form" method="post">
							    <label>Enter Email Address</label>
							    <div class="fields">
								    <input type="email" name="email" placeholder="Info@Company.com" class="required">
								    <input type="hidden" name="action" value="forgot_password">
								    <i class="fa fa-envelope" aria-hidden="true"></i>
							    </div>
							    <button name="forget_submit" id="forgot_mail" type="submit">Submit</button>
							    <div class="para">
								    <p>Enter your register email address to retreive your account and reset the password.</p>
							    </div>													
						    </form>
					    </div>
				    </div>
				</div>			
			</div>
		</div><!--/row-->
	</div><!--/container-->
</div><!--/container-wrap-->
<?php get_footer(); ?>


