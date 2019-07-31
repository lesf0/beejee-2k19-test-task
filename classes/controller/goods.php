<?php

namespace Controller{
class Goods {
	public static function Get()
	{
		$all = \Model\Goods::all();

		\View\Json::render(['goods'=>$all]);
	}

	const name1 = ['Beautiful', 'Strong', 'Crazy', 'Sophisticated', 'Breathtaking', 'Bored', 'Explosive', 'Naked'];
	const name2 = ['Newton', 'Duck', 'Banana', 'Guacamole', 'Bizon', 'Teenager', 'Oak Tree', 'Programmer'];
	public static function Create($n = 20)
	{
		$all = [];

		for ($i=0; $i < $n; $i++) { 
			$tmp = new \Model\Goods();

			$tmp->name = self::name1[array_rand(self::name1)] . ' ' . self::name2[array_rand(self::name2)];
			$tmp->price = mt_rand(100, 10000);

			$tmp->save();

			$all[] = $tmp;
		}

		\View\Json::render(['goods'=>$all]);
	}
}}

?>