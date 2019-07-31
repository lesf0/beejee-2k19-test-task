<?php

define("ROOT",__DIR__);
define("CLASS_DIR", ROOT . '/classes');

// Autoload:

set_include_path(CLASS_DIR.PATH_SEPARATOR.get_include_path());
spl_autoload_extensions('.php');
spl_autoload_register();

// Conf

require('conf.php');

// Script:

DB::exec('CREATE TABLE IF NOT EXISTS goods (id SERIAL,name varchar,price decimal)');

?>