<?php
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[2];
?>
<div class="phone_menu">
	    <ul>
		    <li><a href="<?= home_url().'/user-dashboard'?>" class=<?= ($first_part=='user-dashboard')? 'menu_active':''; ?>><i class="fa fa-area-chart" aria-hidden="true"></i> Dashboard</a></li>
		    <li><a href="<?= home_url().'/user-profile'?>" class=<?= ($first_part=='user-profile')? 'menu_active':''; ?> ><i class="fa fa-address-card" aria-hidden="true"></i></i> Profile</a></li>
		    <li><a href="<?= home_url().'/challenge-history'?>" class=<?= ($first_part=='challenge-history')? 'menu_active':''; ?>><i class="fa fa-history" aria-hidden="true"></i> Challenge History</a></li>
		    <li><a href="<?= home_url().'/new-challenge'?>" class=<?= ($first_part=='new-challenge')? 'menu_active':''; ?>><i class="fa fa-money" aria-hidden="true"></i> New Challenge</a></li>
		 <!--    <li><a href="<?= home_url().'/my-reviews'?>" class=<?= ($first_part=='my-reviews')? 'menu_active':''; ?>><i class="fa fa-file-text-o" aria-hidden="true"></i> Reviews</a></li> -->
		    <li><a href="<?= home_url().'/financial-dashboard'?>" class=<?= ($first_part=='financial-dashboard')? 'menu_active':''; ?>><i class="fa fa-usd" aria-hidden="true"></i> Financial Dashboard</a></li>
		    <li><a href="<?= home_url().'/setting'?>" class=<?= ($first_part=='setting')? 'menu_active':''; ?>><i class="fa fa-cogs" aria-hidden="true"></i> Settings</a></li>				
	    <ul>				    	
	</div>	