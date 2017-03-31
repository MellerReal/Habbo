<?php

if(!defined("INDEX")) {
	header("HTTP/1.0 404 Not Found");
	die();
}

class DatabaseManager {
	protected $connection;
	protected $query;
	public function Execute($hostname, $username, $password, $database) {
		@$this->connection = new mysqli($hostname, $username, $password, $database);
		if($this->connection->connect_error)
			return false;
		else
			return true;
	}

	public function Error() {
		return $this->connection->connect_errno . ": " . $this->connection->connect_error;
	}

	public function ValidateTables() {
		return true;
	}

	public function Exit() {
		$this->connection->close();
	}

	public function Secure($variable) {
		return $this->connection->real_escape_string(stripslashes($variable));
	}

	public function RunQuery($query) {
		$this->query = $this->connection->query($query);
	}

	public function QueryRows() {
		return $this->query->num_rows;
	}

	public function GetRow($row) {
		$row2 = $this->query->fetch_assoc();
		    return $row2[$row];
	}

	public function OnSubmit($page, $form, $ipv4, $input1 = "", $input2 = "", $input3 = "", $input4 = "") {
		switch($page) {
			case "index":
				switch($form) {
					case "login":
						if(empty($input1) || !ctype_alnum($input1))
							return 1;
						else if(empty($input2) || !ctype_alnum($input2))
							return 2;

						$input1 = $this->Secure($input1);
						$input2 = $this->Secure($input2);
						$datetime = date("Y-m-d H:i:s");
						$this->RunQuery("SELECT id FROM users WHERE username = '$input1' LIMIT 1");
						if($this->QueryRows() == 0)
							return 1;
						$this->RunQuery("SELECT id FROM users WHERE username = '$input1' AND password = '$input2' LIMIT 1;");
						if($this->QueryRows() == 0) {
							$this->RunQuery("INSERT INTO user_attempts VALUES (null, '$ipv4', '$input1', '0', '$datetime');");
							return 2;
						}

						//Success
						$Client = new ClientManager();
						$this->RunQuery("SELECT * FROM users WHERE username = '$input1' LIMIT 1;");
						$Client->LogIn($this->GetRow("id"));
						$this->RunQuery("UPDATE users SET last_login = '$datetime', last_ip = '$ipv4' WHERE username = '$input1' LIMIT 1;");

						break;
				}
				break;
		}
	}
}

?>