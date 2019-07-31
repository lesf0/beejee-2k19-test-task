<?php

namespace Model{
class Goods {
	use \ModelTrait;

	const table	= 'goods';
	const keys	= ['id', 'name', 'price'];
}}

?>