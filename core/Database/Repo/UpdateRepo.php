<?php

namespace Core\Database\Repo;

use App\Service\DBHandler;

class UpdateRepo
{
	public static function updateTable(string $tableName, array $fields, int $objectId): void
	{
		$config = require __DIR__ . '/../../../config/config.php';

		$DBOperator = DBHandler::getInstance();

		$set = [];

		foreach ($fields as $k => $v)
		{
			$set[] = "`$k` = '$v'"; // ⚠️ Опасная подстановка
		}

		$DBOperator->query("UPDATE $tableName 
            SET ".implode(', ', $set)." 
            WHERE $config[$tableName] = $objectId");
	}

	public static function updateTableSuppliers(): void
	{
		$supplierId = $_POST['supplier_id'];
		$name = $_POST['name'];
		$inn = $_POST['inn'];
		$statusId = $_POST['status_name'];
		$website = $_POST['website'];
		$address = $_POST['address'];
		$notes = $_POST['notes'];

		$typeIds = $_POST['supply_types'];
		$contactIds = $_POST['contacts'];

		$DBOperator = DBHandler::getInstance();

		$DBOperator->query("UPDATE suppliers 
SET 
    name = '$name',
    inn = '$inn',
    status_id = (SELECT status_id FROM status_types WHERE status_id = $statusId),
    website = '$website',
    address = '$address',
    notes = '$notes'
WHERE supplier_id = $supplierId;");

		$DBOperator->query("DELETE FROM supplier_supply_types
WHERE supplier_id = $supplierId;");


		$values = [];
		foreach ($typeIds as $typeId)
		{
			$values[] = "($supplierId, " . (int)$typeId . ")"; // (int) защищает от SQL-инъекций
		}

		$sql = implode(",\n", $values) . ";";

		$DBOperator->query("INSERT INTO supplier_supply_types (supplier_id, type_id)\nVALUES\n $sql");

		$DBOperator->query("DELETE FROM supplier_contacts
WHERE supplier_id = $supplierId;");

		$values = [];

		foreach ($contactIds as $contactId)
		{
			$values[] = "($supplierId, " . (int)$contactId . ")";
		}

		$sql = implode(",\n", $values) . ";";

		$DBOperator->query("INSERT INTO supplier_contacts (supplier_id, contact_id)\nVALUES\n $sql");
	}
}