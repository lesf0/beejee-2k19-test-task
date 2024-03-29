<?php

namespace Controller{
class Problems {
	public static function Get($page = 0, $order = null)
	{
		if (is_null($order) || !filter_var($order, FILTER_VALIDATE_REGEXP, ['options'=>['regexp'=>'/^\w+$/']]))
		{
			if (array_key_exists('problem_order', $_SESSION))
			{
				$order = $_SESSION['problem_order'];
			}
			else
			{
				$order = 1;
			}
		}
		elseif (array_key_exists('problem_order', $_SESSION) && $order == $_SESSION['problem_order'])
		{
			$order = $order . ' DESC';
		}

		$_SESSION['problem_order'] = $order;

		$all = \Model\Problems::all($page * 3, 3, $order);

		$total = \ceil(\Model\Problems::count() / 3);

		$page_h = $page+1;

		\View\Problems\ProblemList::render(
			['title' => "Задачи: страница $page_h из $total", 'problems'=>$all, 'page'=>$page, 'total'=>$total]
		);
	}

	public static function Add()
	{
		$name = $_SESSION['name'] ?? '';
		$email = $_SESSION['email'] ?? '';

		\View\Problems\ProblemAdd::render(
			['title' => "Создать задачу", 'name'=>$name, 'email'=>$email]
		);
	}

	public static function Edit($id)
	{
		$problems = \Model\Problems::query('SELECT * FROM problems WHERE id=:id', ['id'=>(int)($id)]);

		if (count($problems) != 1)
		{
			throw new \Exception("Wrong id", 1);
		}

		$problem = reset($problems);

		\View\Problems\ProblemEdit::render(
			['title' => "Изменить задачу", 'problem'=>$problem]
		);
	}

	public static function Create($name, $email, $descr)
	{
		if (empty($name) || empty($email) || empty($descr))
		{
			throw new \Exception("Some fields are missing", 1);
		}

		$problem = new \Model\Problems();

		$problem->name = htmlspecialchars($name);
		$problem->email = htmlspecialchars($email);
		$problem->descr = htmlspecialchars($descr);

		$problem->save();

		$_SESSION['name'] = $name;
		$_SESSION['email'] = $email;

		header('Location: /');
	}

	public static function Update($id, $name, $email, $descr, $completed)
	{
		if (empty($name) || empty($email) || empty($descr))
		{
			throw new \Exception("Some fields are missing", 1);
		}

		$problems = \Model\Problems::query('SELECT * FROM problems WHERE id=:id', ['id'=>(int)($id)]);

		if (count($problems) != 1)
		{
			throw new \Exception("Wrong id", 1);
		}

		$problem = reset($problems);

		$problem->name = htmlspecialchars($name);
		$problem->email = htmlspecialchars($email);
		$problem->descr = htmlspecialchars($descr);
		$problem->completed = $completed;

		$problem->edited = true;

		$problem->save();

		header('Location: /');
	}
}}

?>