<?php

if(!defined("INDEX")) {
	header("HTTP/1.0 404 Not Found");
	die();
}

class ThemeManager {
	private $theme;

	public function ValidateTheme($theme) {
		if(!file_exists("cms/themes/$theme/index.php"))
			return false;
		else if(!file_exists("cms/themes/$theme/register.php"))
			return false;
		else if(!file_exists("cms/themes/$theme/client.php"))
			return false;
		else if(!file_exists("cms/themes/$theme/home.php"))
			return false;
		else {
			$this->theme = $theme;
			return true;
		}
	}

	public function GetPage() {
		if(isset($_GET["page"]) && ctype_alnum($_GET["page"])) {
			return stripslashes($_GET["page"]);
		}
		else return "false";
	}

    protected $Repalcements = array();
	public function SetVariable($var, $value)
    {
        $this->Repalcements[$var] = $value;
        return $this;
    }

	public function LoadPage($page) {
        extract($this->Repalcements);
        ob_start();
        include "cms/themes/$this->theme/$page.php";
        echo ob_get_clean();
	}

	public function ExistsPage($page) {
		return file_exists("cms/themes/$this->theme/$page.php");
	}
}

?>