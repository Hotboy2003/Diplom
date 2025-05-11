<?php

namespace App\Controller;

use Core\Database\Repo\AddRepo;
use Core\Database\Repo\UpdateRepo;

class UpdateController extends BaseController
{
	public function updateEditObject($objectName): void
	{
		if ($_SESSION['ISUSERAUTH'] !== 1)
		{
			header('Location: /admin/login/');
		}

		$fields = $_POST;

		$id = array_shift($fields);

		if ($objectName[0] === 'suppliers')
		{
			UpdateRepo::updateTableSuppliers();
		}
		else
		{
			UpdateRepo::updateTable($objectName[0], $fields, $id);
		}

		header('Location: /admin/');
	}

	public function updateAddObject($objectName): void
	{
		if ($_SESSION['ISUSERAUTH'] !== 1)
		{
			header('Location: /admin/login/');
		}

		$fields = $_POST;

		$id = array_shift($fields);

		if ($objectName[0] === 'suppliers')
		{
			AddRepo::addTableSuppliers();
		}
		else
		{
			AddRepo::addTable($objectName[0], $fields);
		}

		header('Location: /admin/');
	}
}