<?php
ini_set('mysql.connect_timeout', '3');

abstract class DatabaseProvider
{
	protected $connection;
	protected $databaseAddress = "localhost";
	protected $username = "test";
	protected $password = "test";
	protected $databaseName = "webtest";

	protected function __construct() {
		$this->openConnection();
	}

	function __destruct() {
		$this->closeConnection();
	}

	protected function openConnection() {
		if (empty($this->connection)) {
            $this->connection = @mysqli_connect($this->databaseAddress, $this->username, $this->password, $this->databaseName);
        }
	}

	private function closeConnection() {
		$result = true;
		if(!empty($this->connection)) {
			$result = mysqli_close($this->connection);
			unset($this->connection);
		}

		return $result;
	}

	function query($sql) {
		$result = mysqli_query($this->connection, $sql);

		return $result;
	}

	function getQueryNumberOfRows($queryResult) {
		$numberOfRows = mysqli_num_rows($queryResult);

		return $numberOfRows;
	}

	function mysqlFetchArray($queryResult) {
		$result = mysqli_fetch_array($queryResult);

		return $result;
	}

	function mysqlFetchAssoc($queryResult) {
		$result = mysqli_fetch_assoc($queryResult);

		return $result;
	}

	function getLastInsertedRowId() {
		$lastInsertedRowId = mysqli_insert_id($this->connection);

		return $lastInsertedRowId;
	}

	function getThreadId() {
		$threadId = mysqli_thread_id($this->connection);

		return $threadId;
	}

	function mysqlEscapeString($value) {
		$value = $this->connection->escape_string($value);

		return $value;
	}
}
?>