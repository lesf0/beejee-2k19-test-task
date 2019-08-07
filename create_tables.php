<?php

define("ROOT",__DIR__);
define("CLASS_DIR", ROOT . '/classes');

// Autoload:

set_include_path(CLASS_DIR.PATH_SEPARATOR.get_include_path());
spl_autoload_extensions('.php');
spl_autoload_register();

// Conf

require('conf.php');

// Migrate:

DB::exec('DROP TABLE problems');
DB::exec('DROP TABLE users');
DB::exec('CREATE TABLE IF NOT EXISTS problems (
			id SERIAL PRIMARY KEY,
			name varchar NOT NULL,
			email varchar NOT NULL,
			descr text NOT NULL,
			edited boolean NOT NULL DEFAULT false,
			completed boolean NOT NULL DEFAULT false
		)');
DB::exec('CREATE TABLE IF NOT EXISTS users (
			id SERIAL PRIMARY KEY,
			name varchar UNIQUE NOT NULL,
			password varchar NOT NULL,
			is_admin boolean DEFAULT false
		)');

// Seed:

DB::exec("INSERT INTO problems(name,email,descr) VALUES
			('Вася', 'vasya@ma.il', '2+2=?'),
			('Петя', 'petya@ma.il', 'int(log(xdx))'),
			('Иннокентий Петрович', 'innokentiy.petrovich.1963.gorod.volgograd@nauchno-issledovatelskiy-institut-himicheskih-udobreniy-i-yadov.gov.ru', 'Что в чёрном ящике?'),
			('Серёжа', 'serj@ma.il', 'А ты любишь мамбу?')
		");
DB::exec("INSERT INTO users(name,password,is_admin) VALUES (:name,:password,true)",
			['name'=>'admin','password'=>md5('the_saltiest_salt'.'123')])

?>