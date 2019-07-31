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
}}

?>