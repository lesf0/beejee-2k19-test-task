<?php

namespace Controller{
class Orders {
	public static function Create($g_ids)
	{
		$order = new \Model\Orders();

		$order->user_id = 1;

		$order->save();

		foreach ($g_ids as $g_id) {
			$og = new \Model\Order_Goods();

			$og->g_id = $g_id;
			$og->o_id = $order->id;

			$og->save();
		}

		\View\Json::render(['order'=>$order]);
	}

	public static function Update($id, $price)
	{
		$orders = \Model\Orders::query('SELECT * FROM orders WHERE id=:id', ['id'=>$id]);

		if (count($orders) == 1)
		{
			$order = $orders[0];

			if ($order->price() == $price)
			{
				if( $curl = curl_init() ) {
					curl_setopt($curl, CURLOPT_URL, 'https://ya.ru/');
					curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
					curl_exec($curl);
					$res = !curl_errno($curl) && curl_getinfo($curl, CURLINFO_HTTP_CODE) == 200;
					curl_close($curl);
					if ($res)
					{
						$order->status = true;
						$order->save();

						\View\Json::render(['order'=>$order]);
					}
					else
					{
						throw new \Exception("Curl error", 1);
					}
				}
			}
			else
			{
				throw new \Exception("Wrong price of order", 1);
			}
		}
		else
		{
			throw new \Exception("Wrong size of db response", 1);
		}
	}
}}

?>