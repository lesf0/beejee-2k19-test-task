<?php

class DB {
	public static $name = '';
	public static $user = '';
	public static $password = '';
	public static $host = '';

	protected static $dbh = null;

	protected static function getPDO()
	{
		$dbh = DB::$dbh;
	
		if ($dbh === null) {
			$name = DB::$name;
			$host = DB::$host;
			$user = DB::$user;
			$password = DB::$password;

			$dbh = DB::$dbh = new \PDO("pgsql:dbname=$name;host=$host", $user, $password);
		}

		return $dbh;
	}

	public static function exec($querystring)
	{
		$dbh = DB::getPDO();

		$stmt = $dbh->exec($querystring);
	}

	public static function query($querystring)
	{
		$dbh = DB::getPDO();

		$stmt = $dbh->query($querystring);
		$stocks = [];
		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
			$stocks[] = $row;
		}
		return $stocks;
	}
}

?>