<?php

namespace Controller{
class Users {
	public static function Login()
	{
		if (isset($_SESSION['user']))
		{
			header('Location: /');
			return;
		}

		\View\Users\Login::render(
			['title' => "Войти"]
		);
	}

	public static function Check($name, $password)
	{
		if (empty($name) || empty($password))
		{
			throw new \Exception("Some fields are missing", 1);
		}

		$users = \Model\Users::query('SELECT * FROM users WHERE name=:name AND password=:password',
			['name'=>$name, 'password'=>md5('the_saltiest_salt'.$password)]);

		if (count($users) != 1)
		{
			throw new \Exception("Wrong password or missing user", 1);
		}

		$_SESSION['user'] = reset($users);

		header('Location: /');
	}
}}

?>