<?php

namespace Core\Database\Repo;

use App\Service\DBHandler;

class AddRepo
{
	public static function addTable(string $tableName, array $fields): void
	{
		$DBOperator = DBHandler::getInstance();

		// Получаем типы полей из метаданных
		$columnTypes = [];
		$result = $DBOperator->query("
        SELECT COLUMN_NAME, DATA_TYPE 
        FROM INFORMATION_SCHEMA.COLUMNS 
        WHERE TABLE_NAME = '$tableName'
    ");

		while ($row = mysqli_fetch_assoc($result))
		{
			$columnTypes[$row['COLUMN_NAME']] = strtolower($row['DATA_TYPE']);
		}

		$columns = [];
		$values = [];

		foreach ($fields as $column => $value)
		{
			$columns[] = "`$column`";
			$type = $columnTypes[$column] ?? 'varchar';

			if (in_array($type, ['int', 'bigint', 'tinyint', 'decimal', 'float']))
			{
				$values[] = is_numeric($value) ? $value : 0;
			} elseif ($type === 'bit')
			{
				$values[] = $value ? 1 : 0;
			} elseif (in_array($type, ['date', 'datetime', 'timestamp']))
			{
				$values[] = "'" . date('Y-m-d H:i:s', strtotime($value)) . "'";
			} else
			{
				$values[] = "'$value'";
			}
		}

		$sql = "INSERT INTO $tableName 
            (" . implode(', ', $columns) . ") 
            VALUES (" . implode(', ', $values) . ")";

		$result = $DBOperator->query("$sql");
	}


	public static function addTableSuppliers(): void
	{
		$name = $_POST['name'];
		$inn = $_POST['inn'];
		$statusId = $_POST['status_name'];
		$website = $_POST['website'];
		$address = $_POST['address'];
		$notes = $_POST['notes'];

		$typeIds = $_POST['supply_types'];
		$contactIds = $_POST['contacts'];

		$DBOperator = DBHandler::getInstance();

		$DBOperator->query("
        INSERT INTO suppliers (name, inn, status_id, website, address, notes)
        VALUES (
            '$name',
            '$inn',
            $statusId,
            '$website',
            '$address',
            '$notes'
        )
    ");

		$newSupplierId = $DBOperator->insert_id;

		if (!empty($typeIds)) {
			$supplyValues = array_map(
				fn($id) => "($newSupplierId, " . (int)$id . ")",
				$typeIds
			);

			$DBOperator->query("
            INSERT INTO supplier_supply_types (supplier_id, type_id)
            VALUES " . implode(', ', $supplyValues)
			);
		}

		if (!empty($contactIds))
		{
			$contactValues = array_map(fn($id) => "($newSupplierId, " . (int)$id . ")", $contactIds);

			$DBOperator->query("
            INSERT INTO supplier_contacts (supplier_id, contact_id)
            VALUES " . implode(', ', $contactValues));
		}
	}
}