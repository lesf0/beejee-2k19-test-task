<?php

namespace Model{
class Problems implements \JsonSerializable {
	use \ModelTrait;

	const table	= 'problems';
	const keys	= ['id', 'name', 'email', 'descr', 'edited', 'completed'];
}}

?>