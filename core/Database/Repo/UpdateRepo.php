<?php

namespace Core\Database\Repo;

use App\Service\DBHandler;

class UpdateRepo
{
	public static function updateTable(string $tableName, array $fields, int $objectId): void
	{
		$primaryKeys = [
			'suppliers' => 'supplier_id',
			'contacts' => 'contact_id',
			'status_types' => 'status_id',
			'migration' => 'id',
			'supply_types' => 'type_id'
		];

		$DBOperator = DBHandler::getInstance();

		$set = [];
		foreach ($fields as $k => $v)
		{
			$set[] = "`$k` = '$v'"; // ⚠️ Опасная подстановка
		}

		$result = $DBOperator->query("UPDATE $tableName 
            SET ".implode(', ', $set)." 
            WHERE $primaryKeys[$tableName] = $objectId");
	}
}