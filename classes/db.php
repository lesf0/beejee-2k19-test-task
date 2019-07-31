<?php

class DB {
	public static $name = '';
	public static $user = '';
	public static $password = '';
	public static $host = '';

	protected static $dbh = null;

	public static function getPDO()
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

	public static function exec($querystring, $values = [], $table = '')
	{
		$dbh = DB::getPDO();

		$stmt = $dbh->prepare($querystring);

		foreach ($values as $key => $value) {
			$stmt->bindValue(':'.$key, $value);
		}

		$stmt->execute();

		return $dbh->lastInsertId($table . '_id_seq');
	}

	public static function query($querystring, $values = [])
	{
		$dbh = DB::getPDO();

		$stmt = $dbh->prepare($querystring);

		foreach ($values as $key => $value) {
			$stmt->bindValue(':'.$key, $value);
		}

		$stmt->execute();
		$stocks = [];
		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
			$stocks[] = $row;
		}
		return $stocks;
	}
}

?>