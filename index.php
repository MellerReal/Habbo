<?php

define("INDEX", true);

// Classes
	require_once "cms/ClientManager.php";
	require_once "cms/ConfigurationManager.php";
	require_once "cms/DatabaseManager.php";
	require_once "cms/ThemeManager.php";

// Main
	if(isset($Config["readme"]))
		die("<h2><b>Configuration Error</b></h2> Please remove the 'readme.txt' file after setting up the hotel.");

	//////////////////////

	$Database = new DatabaseManager();
	if(!$Database->Execute($Config["database"]["hostname"], $Config["database"]["username"], $Config["database"]["password"], $Config["database"]["database"]))
		if($_SERVER["REMOTE_ADDR"] == $Config["cms"]["host_ip"])
			die("<h2><b>Database Error</b></h2> Could not connect to the database.<br><br>" . $Database->Error());
		else
			die("<h2><b>Database Error</b></h2> Could not connect to the database.");

	if(!$Database->ValidateTables())
		die("<h2><b>Database Error</b></h2> Missing table structure.");

	//////////////////////

	$Client = new ClientManager();
	$Client->Execute();

	//////////////////////

	$Theme = new ThemeManager();
	if(!$Theme->ValidateTheme($Config["cms"]["theme"]))
		die("<h2><b>Theme Error</b></h2> Missing the 4 most important files.");

	$Theme->SetVariable("hotelname", $Config["cms"]["hotelname"]);
	$Theme->SetVariable("image_folder", $Config["cms"]["image_folder"]);
	$Theme->SetVariable("style_folder", $Config["cms"]["style_folder"]);
	$Theme->SetVariable("script_folder", $Config["cms"]["script_folder"]);
	if($Config["cms"]["warn_cookies"] == true && !$Client->SeenCookieWarning())
		$Theme->SetVariable("warn_cookies", true);
	if(isset($_POST)) {
		if((!$Theme->GetPage() || $Theme->GetPage() == "index") && !$Client->IsLoggedIn()) {
			if(isset($_POST["login"])) {
				$code = $Database->OnSubmit("index", "login", $Client->IPv4(), $_POST["username"], $_POST["password"]);
				if($code > 0) {
					switch($code) {
						case 1: 
							$Theme->SetVariable("invalid_username", true);
							break;
						case 2: 
							$Theme->SetVariable("invalid_password", true);
							break;
					}
				}
			}
		}
	}
	if($Theme->GetPage() == "false" && !$Client->IsLoggedIn()) {
		$Theme->LoadPage("index");
	}
	else {
		if($Theme->ExistsPage($Theme->GetPage()) || $Theme->GetPage() == "logout") {
			if($Theme->GetPage() == "logout")
				$Client->LogOut();
			else
				$Theme->LoadPage($Theme->GetPage());
		}
		else {
			if($Client->IsLoggedIn())
				header("Location: home");
			else
				$Theme->LoadPage("index");
		}
	}

	//////////////////////

	$Database->Exit();

?>