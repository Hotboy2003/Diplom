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

		$excludedTables = [
			'migration',
			'supplier_contacts',
			'supplier_supply_types'
		];

		// Фильтрация основного массива
		$filteredData = array_diff_key($data, array_flip($excludedTables));

		echo self::render('layout.php', ['content' => self::render('MainPage/admin.php', ['data' => $filteredData]),]);
	}

	public function editObject($objectName): void
	{
		if ($_SESSION['ISUSERAUTH'] !== 1)
		{
			header('Location: /admin/login/');
		}

		$data = AdminRepo::getCurrentObject($objectName[0], $_GET['id']);

		echo self::render('layout.php', ['content' => self::render('MainPage/admin_edit.php', ['data' => $data[0],
			'tableName' => $objectName[0]])
			,]);
	}
}