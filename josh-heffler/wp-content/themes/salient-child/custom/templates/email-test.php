<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	function generateRandomString($length = 100) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


?>

<h3>
	Click <a href=<?= home_url().'/reset-password/?str='.generateRandomString().'&id='.$get_user->ID.'&str2='.generateRandomString(); ?> > here </a>to reset your password
</h3>
</body>
</html>