<?php

namespace Core\Database\Repo;

use App\Service\DBHandler;

class AdminRepo
{
	public static function getAllTables(): array
	{
		$DBOperator = DBHandler::getInstance();
		$result = $DBOperator->query("SHOW TABLES");
		$tables = [];

		while ($row = mysqli_fetch_array($result))
		{
			$tables[] = $row[0];
		}

		return $tables;
	}

	public static function getTableData(string $tableName): array
	{
		$DBOperator = DBHandler::getInstance();
		$result = $DBOperator->query("SELECT * FROM " .  $tableName);

		$data = [];

		while ($row = mysqli_fetch_assoc($result))
		{
			$data[] = $row;
		}

		return $data;
	}

	public static function getCurrentObjectForEdit(string $tableName, int $objectId): array
	{
		$config = require __DIR__ . '/../../../config/config.php';
		$primaryKeys = $config['primaryKeys'];

		$DBOperator = DBHandler::getInstance();

		if ($tableName === 'suppliers')
		{
			$data = SupplierRepo::getSupplierById($objectId);
		}
		else
		{
			$result = $DBOperator->query("SELECT * FROM $tableName
			WHERE $primaryKeys[$tableName] = $objectId;");

			$data = [];

			while ($row = mysqli_fetch_assoc($result))
			{
				$data[] = $row;
			}
		}

		return $data;
	}

	public static function getCurrentObjectForAdd(string $tableName): array
	{
		$DBOperator = DBHandler::getInstance();

		if ($tableName === 'suppliers')
		{
			$data = SupplierRepo::getSupplierById(1);
		}
		else
		{
			$result = $DBOperator->query("SELECT COLUMN_NAME 
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_NAME = '$tableName'
AND TABLE_SCHEMA = 'supplier';");

			$data = [];

			while ($row = mysqli_fetch_assoc($result))
			{
				$data[] = $row['COLUMN_NAME'];
			}
		}
		return $data;
	}
}