<?php

namespace Model{
class Order_Goods implements \JsonSerializable {
	use \ModelTrait;

	const table	= 'order_goods';
	const keys	= ['id', 'g_id', 'o_id'];
}}

?>