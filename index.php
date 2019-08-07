<?php

define("ROOT",__DIR__);
define("CLASS_DIR", ROOT . '/classes');
define("LAYOUT_DIR", ROOT . '/layout');

// Autoload:

set_include_path(CLASS_DIR.PATH_SEPARATOR.get_include_path());
spl_autoload_extensions('.php');
spl_autoload_register();

// Conf

require('conf.php');

// Session stuff

session_start();

// Routes:
// TODO : Better router

function p404()
{
	http_response_code(404);
	View\Json::render(['error'=>'page not found']);
}
function p500($error)
{
	http_response_code(500);
	View\Json::render(['error'=>$error.'']);
}

try {
	if(count($_POST) && array_key_exists('method', $_POST)){
		$method = $_POST['method'];
	}
	else
	{
		$method = 'get';
	}

	$uri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

	if ($uri == '/' && $method == 'get')
	{
		Controller\Problems::Get($_GET['p'] ?? 0, $_GET['o'] ?? null);
	} else
	if ($uri == '/login' && $method == 'get')
	{
		Controller\Users::Login();
	} else
	if ($uri == '/login' && $method == 'put')
	{
		Controller\Users::Check($_POST['name'], $_POST['password']);
	} else
	if ($uri == '/add' && $method == 'get')
	{
		Controller\Problems::Add();
	} else
	if ($uri == '/create' && $method == 'create')
	{
		Controller\Problems::Create($_POST['name'], $_POST['email'], $_POST['descr']);
	} else
	if (preg_match("/\/edit\/(\d+)/", $uri, $matches) && $method == 'get')
	{
		Controller\Problems::Edit($matches[1]);
	} else
	if (preg_match("/\/update\/(\d+)/", $uri, $matches) && $method == 'update')
	{
		Controller\Problems::Update($matches[1], $_POST['name'], $_POST['email'], $_POST['descr'], (int)array_key_exists('completed', $_POST));
	} else
	{
		p404();
	}
}
catch(Exception $error)
{
	p500($error);
}
catch(Error $error)
{
	p500($error);
}

?>