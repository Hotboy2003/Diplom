<?php

namespace App\Controller;

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

		UpdateRepo::updateTable($objectName[0], $fields, $id);

		header('Location: /admin/');
	}
}