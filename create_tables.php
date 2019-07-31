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

DB::exec('DROP TABLE order_goods');
DB::exec('DROP TABLE orders');
DB::exec('DROP TABLE goods');
DB::exec('CREATE TABLE IF NOT EXISTS goods (id SERIAL PRIMARY KEY,name varchar,price decimal)');
DB::exec('CREATE TABLE IF NOT EXISTS orders (id SERIAL PRIMARY KEY,status boolean default FALSE,user_id integer not null)');
DB::exec('CREATE TABLE IF NOT EXISTS order_goods (id SERIAL PRIMARY KEY,g_id integer not null, o_id integer not null, FOREIGN KEY (g_id) REFERENCES goods (id), FOREIGN KEY (o_id) REFERENCES orders (id))');

?>