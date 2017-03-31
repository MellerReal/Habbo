<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $hotelname; ?> - Virtual World, Avatar Chat, and Pixel Art - <?php echo $hotelname; ?></title>
		<link rel="shortcut icon" href="<?php echo $image_folder; ?>/favicon.ico">
		<link href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold|Ubuntu+Condensed:regular" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo $style_folder; ?>/index.css?<?php echo rand(); ?>">
		<script type="text/javascript" src="<?php echo $script_folder; ?>/jquery.js"></script>
		<script type="text/javascript" src="<?php echo $script_folder; ?>/index.js?<?php echo rand(); ?>"></script>
	</head>
	<body>
		<header>
			<!--<a id="more" href="#more"><center>More ways to<br>login</center></a>-->
			<a id="facebook" href="#facebook"></a>
			<div id="stripe"></div>
			<form method="post">
				<input type="submit" name="login" value="Let's go!">
				<input type="password" name="password" placeholder="Password">
				<input type="text" name="username" placeholder="Username" autofocus>
			</form>
		</header>
		<?php if(isset($warn_cookies)) { ?>
		<div class="cookies">
			<p><?php echo $hotelname; ?> uses its own and third-party cookies in order to provide a better service and display advertisement that fits your preferences. By using our website you agree to our cookie policy.</p>
			<input type="button" name="cookies">
		</div>
		<?php } ?>
	</body>
</html>
<?php if(isset($invalid_username)) echo "<script id='remove'>console.log('   > Invalid username entered on submit.');</script>"; ?>
<?php if(isset($invalid_password)) echo "<script id='remove'>console.log('   > Invalid password entered on submit.');</script>"; ?>