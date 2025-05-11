<?php

namespace App\Controller;

use Core\Database\Repo\AdminRepo;
use Core\Database\Repo\DeleteRepo;

class AdminController extends BaseController
{
	public function showAdminPage(): void
	{
		$config = require __DIR__ . '/../../config/config.php';

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

		$filteredData = array_diff_key($data, array_flip($config['excludedTables']));

		echo self::render('layout.php', ['content' => self::render('MainPage/admin.php', ['data' => $filteredData, 'primaryKeys' => $config['primaryKeys']])
			,]);
	}

	public function editObject($objectName): void
	{
		if ($_SESSION['ISUSERAUTH'] !== 1)
		{
			header('Location: /admin/login/');
		}

		$data = AdminRepo::getCurrentObjectForEdit($objectName[0], $_GET['id']);

		if ($objectName[0] === 'suppliers')
		{
			$statuses = AdminRepo::getTableData('status_types');
			$types = AdminRepo::getTableData('supply_types');
			$contacts = AdminRepo::getTableData('contacts');

			echo self::render('layout.php', ['content' => self::render('MainPage/admin_edit_suppliers.php', ['data' =>
				$data[0],
				'tableName' => $objectName[0], 'statuses' => $statuses, 'types' => $types, 'contacts' => $contacts,
				'addOrEdit' => 'edit'])
				,]);
		}
		else
		{
			echo self::render('layout.php', ['content' => self::render('MainPage/admin_edit.php', ['data' => $data[0],
				'tableName' => $objectName[0], 'addOrEdit' => 'edit'])
				,]);
		}
	}

	public function addObject($objectName): void
	{
		if ($_SESSION['ISUSERAUTH'] !== 1)
		{
			header('Location: /admin/login/');
		}

		if ($objectName[0] === 'suppliers')
		{
			$data = AdminRepo::getCurrentObjectForAdd($objectName[0]);
			$statuses = AdminRepo::getTableData('status_types');
			$types = AdminRepo::getTableData('supply_types');
			$contacts = AdminRepo::getTableData('contacts');

			echo self::render('layout.php', ['content' => self::render('MainPage/admin_edit_suppliers.php', ['data' =>
				$data[0],
				'tableName' => $objectName[0], 'statuses' => $statuses, 'types' => $types, 'contacts' => $contacts, 'addOrEdit' => 'add'])
				,]);
		}
		else
		{
			$data = AdminRepo::getCurrentObjectForAdd($objectName[0]);

			$result = [];

			foreach ($data as $datum)
			{
				$result[$datum] = '';
			}

			echo self::render('layout.php', ['content' => self::render('MainPage/admin_edit.php', ['data' => $result,
				'tableName' => $objectName[0], 'addOrEdit' => 'add'])
				,]);
		}
	}

	public function deleteObject($objectName): void
	{
		if ($_SESSION['ISUSERAUTH'] !== 1)
		{
			header('Location: /admin/login/');
		}

		if ($objectName[0] === 'suppliers')
		{
			DeleteRepo::updateTableSuppliers($_GET['id']);
		}
		else
		{
			DeleteRepo::updateTable($objectName[0], $_GET['id']);
		}

		header('Location: /admin/');
	}
}