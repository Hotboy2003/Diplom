<?php

namespace Core\Database\Repo;

use App\Service\DBHandler;

class DeleteRepo
{
	public static function updateTable(string $tableName, int $objectId): void
	{
		$config = require __DIR__ . '/../../../config/config.php';
		$primaryKeys = $config['primaryKeys'];

		$DBOperator = DBHandler::getInstance();

		$result = $DBOperator->query("DELETE FROM $tableName 
            WHERE $primaryKeys[$tableName] = $objectId");
	}

	public static function updateTableSuppliers($supplierId): void
	{
		$DBOperator = DBHandler::getInstance();

		$DBOperator->query("DELETE FROM suppliers 
WHERE supplier_id = $supplierId;");

		$DBOperator->query("DELETE FROM supplier_supply_types
WHERE supplier_id = $supplierId;");


		$DBOperator->query("DELETE FROM supplier_supply_types 
WHERE supplier_id = $supplierId");

		$DBOperator->query("DELETE FROM supplier_contacts
WHERE supplier_id = $supplierId;");
	}
}