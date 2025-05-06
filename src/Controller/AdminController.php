<?php

namespace App\Controller;

use Core\Database\Repo\AdminRepo;

class AdminController extends BaseController
{
	public function showAdminPage(): void
	{
		if ($_SESSION['ISUSERAUTH'] !== 1)
		{
			header('Location: /admin/login/');
		}

		$tableNames = AdminRepo::getAllTables();

		$data = [];

		foreach ($tableNames as $tableName)
		{
			$data[$tableName] = AdminRepo::getTableData($tableName);
		}

		echo self::render('layout.php', ['content' => self::render('MainPage/admin.php', ['data' => $data]),]);
	}

	public function editObject($objectName): void
	{
		if ($_SESSION['ISUSERAUTH'] !== 1)
		{
			header('Location: /admin/login/');
		}

		var_dump($objectName);
		var_dump($_GET['id']);

		//echo self::render('layout.php', ['content' => self::render('MainPage/admin.php', ['data' => $data]),]);
	}
}