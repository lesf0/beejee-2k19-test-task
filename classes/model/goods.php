<?php

namespace Model{
class Goods implements \JsonSerializable {
	use \ModelTrait;

	const table	= 'goods';
	const keys	= ['id', 'name', 'price'];
}}

?>