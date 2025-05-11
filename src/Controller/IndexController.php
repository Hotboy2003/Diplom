<?php

namespace App\Controller;

use Core\Database\Repo\SupplierRepo;
use Core\Database\Repo\ContactRepo;
use Core\Database\Repo\TypeRepo;

class IndexController extends BaseController
{
	public function showIndexPage($type): void
	{
		$typesList = TypeRepo::getTypesList();
		$type = $type[0];

		if (isset($_GET['search']))
		{
			$searchQuery = htmlspecialchars($_GET['search']);
			$suppliersList = SupplierRepo::getSupplierForSearch($searchQuery);
			$dopTitle = 'Результат по поиску: "' . $searchQuery . '"';
		}
		else
		{
			if ($type === NULL)
			{
				$suppliersList = SupplierRepo::getSuppliersList();
			}
			else
			{
				$suppliersList = SupplierRepo::getSuppliersListWithCurrentType($type);
			}
		}

		$result = [];

		foreach ($suppliersList as $supplier)
		{
			$contacts = ContactRepo::getContactsBySupplierId($supplier->getId());

			$result[] = ['supplier' => $supplier, 'contacts' => $contacts];
		}

		echo self::render('layout.php', ['content' => self::render('MainPage/index.php', ['data' => $result, 'types'
		=> $typesList, 'filterType' => $type, 'dopTitle' => $dopTitle])
			,]);
	}
}