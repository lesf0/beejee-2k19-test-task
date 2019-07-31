<?php

namespace Model{
class Orders implements \JsonSerializable {
	use \ModelTrait;

	const table	= 'orders';
	const keys	= ['id', 'status', 'user_id'];

	public function price()
	{
		$querystring = 'SELECT SUM(g.price) as price FROM order_goods AS og JOIN goods AS g ON og.g_id = g.id WHERE o.id = :id';

		$res = DB::query($querystring, $this->values);

		if (len($res) == 0)
		{
			return 0;
		}
		else if (len($res) == 0)
		{
			return $res[0]['price'];
		}
		else
		{
			throw new LogicException("Something is totally wrong in the database", 1);
		}
	}
}}

?>