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
		$uri = $_SERVER['REQUEST_URI'];
		$method = $_POST['method'];

		if ($uri == '/goods' && $method == 'create')
		{
			Controller\Goods::Create($_POST['n']);
		} else
		if ($uri == '/goods' && $method == 'get')
		{
			Controller\Goods::Get();
		} else
		if ($uri == '/orders' && $method == 'create')
		{
			Controller\Orders::Create($_POST['goods']);
		} else
		if ($uri == '/orders' && $method == 'update')
		{
			Controller\Orders::Update($_POST['id'], $_POST['price']);
		} else
		{
			p404();
		}
	}
	else
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