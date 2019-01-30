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

	function getUser(string $email, string $password) {
		$email = $this->mysqlEscapeString(trim($email));
		$password = $this->mysqlEscapeString(trim($password));
		$password = hash("sha256", $password);

		$user = "";
		$sql = "SELECT `username` FROM `user` WHERE `email` = '$email' and `password` = '$password' limit 0,1";
		$queryResult = $this->query($sql);
		$numberOfRows = $this->getQueryNumberOfRows($queryResult);
		if ($numberOfRows > 0) {
			$rs = $this->mysqlFetchArray($queryResult);
			$user = $rs["username"];
		}

		return $user;
	}

	function getUserByEmail(string $email) {
		$email = $this->mysqlEscapeString(trim($email));

		$user = "";
		$sql = "SELECT `username` FROM `user` WHERE `email` = '$email' limit 0,1";
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

		$sql = "INSERT ignore INTO `user` (`username`, `password`, `email`, `time`) values ('$username', '$password', '$email', unix_timestamp())";
		$queryResult = $this->query($sql);
	}

	function findUsers(string $searchQuery) {
		$searchQuery = $this->mysqlEscapeString(trim($searchQuery));

		$searchResults = [];
		$sql = "SELECT `username` from  `user` WHERE username like '%$searchQuery%' or email like '%$searchQuery%@%'";
		$queryResult = $this->query($sql);
		$numberOfRows = $this->getQueryNumberOfRows($queryResult);
		if ($numberOfRows > 0) {
			while ($rs = $this->mysqlFetchArray($queryResult)) {
				$searchResults[] = $rs["username"];
			}
		}

		return $searchResults;
	}
}
?>