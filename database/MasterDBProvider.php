<?php
require_once("DatabaseProvider.php");

class MasterDBProvider extends DatabaseProvider
{
	private static $databaseProvider = null;

	// singleton
	static function getDBProvider() {
		if(!self::$databaseProvider) {
			self::$databaseProvider = new self();
		}

		return self::$databaseProvider;
	}

	function getUser(string $username, string $password) {
		$username = $this->mysqlEscapeString(trim($username));
		$password = $this->mysqlEscapeString(trim($password));
		$password = hash("sha256", $password);

		$user = "";
		$sql = "SELECT `username` FROM user WHERE `username` = '$username' and `password` = '$password' limit 0,1";
		$queryResult = $this->query($sql);
		$numberOfRows = $this->getQueryNumberOfRows($queryResult);
		if ($numberOfRows > 0) {
			$rs = $this->mysqlFetchArray($queryResult);
			$user = $rs["username"];
		}

		return $user;
	}
	
	function saveUser(string $username, string $password, string $email) {
		$username = $this->mysqlEscapeString(trim($username));
		$email = $this->mysqlEscapeString(trim($email));
		$password = $this->mysqlEscapeString(trim($password));
		$password = hash("sha256", $password);

		$sql = "INSERT ignore INTO user (`username`, `password`, `email`, `time`) values ('$username', '$password', '$email', unix_timestamp())";
		$queryResult = $this->query($sql);
	}
}
?>