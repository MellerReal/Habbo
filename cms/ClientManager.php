<?php

if(!defined("INDEX")) {
	header("HTTP/1.0 404 Not Found");
	die();
}

class ClientManager {
	public function Execute() {
		session_start();
	}

	public function IsLoggedIn() {
		if(isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"] == true)
			return true;
		else return false;
	}

	public function SeenCookieWarning() {
		if(isset($_SESSION["seen_cookie_warning"]) && $_SESSION["seen_cookie_warning"])
			return true;
		else {
			$_SESSION["seen_cookie_warning"] = true;
			return false;
		}
	}

	public function IPv4() {
		return (isset($_SERVER["HTTP_CF_CONNECTING_IP"])?$_SERVER["HTTP_CF_CONNECTING_IP"]:$_SERVER['REMOTE_ADDR']);
	}

	public function LogIn($userid) {
		$_SESSION["is_logged_in"] = true;
		$_SESSION["user_id"] = $userid;
 	}

	public function LogOut() {
		$_SESSION["is_logged_in"] = false;
		$_SESSION["user_id"] = 0;
		header("Location: /index");
 	}

 	public function GenerateKey($userid) {
 		return "$userid-" . rand(100000, 999999) . "/" . date("z/B") . "/Habbo";
 	}
}

?>