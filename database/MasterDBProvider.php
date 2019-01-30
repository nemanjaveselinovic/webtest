<?php
require_once("DatabaseProvider.php");

class MasterDBProvider extends DatabaseProvider
{
	private static $databaseProvider = null;

	static function getDBProvider() {
		if(!self::$databaseProvider) {
			self::$databaseProvider = new self();
		}

		return self::$databaseProvider;
	}
}
?>