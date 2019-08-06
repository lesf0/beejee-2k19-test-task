<?php

namespace Model{
class Users implements \JsonSerializable {
	use \ModelTrait;

	const table	= 'users';
	const keys	= ['id', 'name', 'password', 'is_admin'];
}}

?>