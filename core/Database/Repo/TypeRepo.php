<?php
namespace Core\Database\Repo;

use App\Model\Supplier;
use App\Model\Type;
use App\Service\DBHandler;

class TypeRepo
{
	public static function getTypesList(): array
	{
		$DBOperator = DBHandler::getInstance();
		$result = $DBOperator->query(
			"SELECT type_id, supply_type
FROM supply_types ;");

		$types = [];

		if (!$result)
		{
			throw new \Exception($DBOperator->connect_error);
		}

		while ($row = mysqli_fetch_assoc($result))
		{
			$types[] = new Type($row['type_id'], $row['supply_type']);
		}

		return $types;
	}
}