<?php

namespace Model{
class Orders implements \JsonSerializable {
	use \ModelTrait;

	const table	= 'orders';
	const keys	= ['id', 'status', 'user_id'];

	public function price()
	{
		$querystring = 'SELECT SUM(g.price) AS price FROM order_goods AS og JOIN goods AS g ON og.g_id = g.id WHERE og.o_id = :id';

		$res = \DB::query($querystring, ['id'=>$this->values['id']]);

		if (count($res) == 0)
		{
			return -1;
		}
		else if (count($res) == 1)
		{
			return $res[0]['price'];
		}
		else
		{
			throw new \LogicException("Something is totally wrong in the database", 1);
		}
	}
}}

?>