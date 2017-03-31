<?php

if(!defined("INDEX")) {
	header("HTTP/1.0 404 Not Found");
	die();
}

$Config = [];
$Config["database"]["hostname"] 		= "localhost";
$Config["database"]["username"] 		= "loy";
$Config["database"]["password"] 		= "123";
$Config["database"]["database"] 		= "PH5H";

$Config["cms"]["host_ip"] 				= "::1";
$Config["cms"]["theme"] 				= "Habbo";
$Config["cms"]["hotelname"] 			= "Habbo";
$Config["cms"]["image_folder"] 			= "http://localhost/cms/themes/" . $Config["cms"]["theme"] . "/images";
$Config["cms"]["style_folder"] 			= "http://localhost/cms/themes/" . $Config["cms"]["theme"] . "/styles";
$Config["cms"]["script_folder"] 		= "http://localhost/cms/themes/" . $Config["cms"]["theme"] . "/scripts";
$Config["cms"]["warn_cookies"] 			= true;


// Do not touch.
if(file_exists("./readme.txt"))
	$Config["readme"] = true;
?>