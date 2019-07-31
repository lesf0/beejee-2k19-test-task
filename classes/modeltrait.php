<?php

trait modelTrait {
	protected $values;

	public function __get($key)
	{
		if (in_array($key, static::keys) && array_key_exists($key, $this->values))
		{
			return $this->values[$key];
		}
		else
		{
			return null;
		}
	}

	public function __set($key, $value)
	{
		if (in_array($key, static::keys))
		{
			$this->values[$key] = $value;
		}
		else
		{
			throw new Exception("Key does not exist", 1);
		}
	}

	public function save()
	{
		$table = static::table;

		$keys = array_keys($this->values);

		if (array_key_exists('id', $this->values))
		{
			$keys_w_ph = [];
			foreach ($keys as $key)
			{
				$keys_w_ph[] = "$key = :$key";
			}
			$keys_list = join($keys_w_ph, ',');

			$querystring = "UPDATE $table SET $keys_list WHERE id=:id";

			DB::exec($querystring, $this->values);
		}
		else
		{
			$keys_list = join($keys, ',');
			$keys_ph = join($keys, ',:');
			if($keys_ph)
			{
				$keys_ph = ':'.$keys_ph;
			}

			$querystring = "INSERT INTO $table($keys_list) VALUES($keys_ph)";

			$id = DB::exec($querystring, $this->values);

			$this->values['id'] = $id;
		}
	}

	public static function query($querystring, $values = [])
	{
		$raw = DB::query($querystring, $values);
		$res = [];

		foreach ($raw as $row)
		{
			$tmp = new static();

			foreach ($row as $key => $value) {
				$tmp->__set($key, $value);
			}

			$res[] = $tmp;
		}

		return $res;
	}

	public static function all()
	{
		$table = static::table;

		$querystring = "SELECT * FROM $table";

		return static::query($querystring);
	}
}

?>