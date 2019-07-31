<?php

define("ROOT",__DIR__);
define("CLASS_DIR", ROOT . '/classes');

// Autoload:

set_include_path(CLASS_DIR.PATH_SEPARATOR.get_include_path());
spl_autoload_extensions('.php');
spl_autoload_register();

// Conf

require('conf.php');

// Route:

$good = new \Model\Goods();
$good->name = 'Big Beautiful Car';
$good->price = 1000000000.99;

$good->save();

var_dump(\Model\Goods::all());

?>