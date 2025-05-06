<?php

namespace Core\Database\Repo;

use App\Service\DBHandler;

class AdminRepo
{
	public static function getAllTables(): array {
		$DBOperator = DBHandler::getInstance();
		$result = $DBOperator->query("SHOW TABLES");
		$tables = [];

		while ($row = mysqli_fetch_array($result)) {
			$tables[] = $row[0];
		}
		return $tables;
	}

	public static function getTableData(string $tableName): array {
		$DBOperator = DBHandler::getInstance();
		$result = $DBOperator->query("SELECT * FROM " .  $tableName);

		$data = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$data[] = $row;
		}
		return $data;
	}
}