<?php

namespace App\Controller;

class AuthController extends BaseController
{
	public function authUser(): void
	{
		echo self::render('layout_auth.php', ['content' => self::render('MainPage/auth.php', []),]);
	}

	public function checkUser(): void
	{
		if (session_status() === PHP_SESSION_NONE)
		{
			session_start();
		}

		$login = $_POST['login'] ?? '';
		$password = $_POST['password'] ?? '';

		if ($login === 'root' && $password === 'toor')
		{
			$_SESSION['ISUSERAUTH'] = 1;
			header('Location: /admin/');
		}

		header('Location: /admin/login/');
	}
}