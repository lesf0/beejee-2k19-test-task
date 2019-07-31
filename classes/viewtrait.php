<?php

trait ViewTrait
{
	public static function render($_values)
	{
		extract($_values);
		unset($_values);

		require(LAYOUT_DIR . static::layout);
	}
}

?>