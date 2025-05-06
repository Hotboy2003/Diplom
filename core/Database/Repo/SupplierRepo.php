<?php

namespace Core\Database\Repo;

use App\Model\Supplier;
use App\Service\DBHandler;

class SupplierRepo
{
	public static function getSuppliersList(): array
	{
		$DBOperator = DBHandler::getInstance();
		$result = $DBOperator->query("SELECT 
    s.supplier_id,
    s.name,
    s.inn,
    st.status_name,
    s.website,
    s.address,
    s.notes,
    GROUP_CONCAT(spt.supply_type SEPARATOR ', ') AS supply_types
FROM suppliers s
LEFT JOIN status_types st ON s.status_id = st.status_id
LEFT JOIN supplier_supply_types sst ON s.supplier_id = sst.supplier_id
LEFT JOIN supply_types spt ON sst.type_id = spt.type_id
GROUP BY s.supplier_id, s.name, s.inn, st.status_name, s.website, s.address, s.notes;");

		$suppliers = [];

		if (!$result)
		{
			throw new \Exception($DBOperator->connect_error);
		}

		while ($row = mysqli_fetch_assoc($result))
		{
			$suppliers[] = new Supplier
			($row['supplier_id'], $row['name'], $row['inn'], $row['status_name'], $row['website'], $row['address'],
				$row['notes'], $row['supply_types']);
		}


		return $suppliers;
	}

	public static function getSuppliersListWithCurrentType(int $type): array
	{
		$DBOperator = DBHandler::getInstance();
		$result = $DBOperator->query("SELECT 
    s.supplier_id,
    s.name,
    s.inn,
    st.status_name,
    s.website,
    s.address,
    s.notes,
    GROUP_CONCAT(DISTINCT spt.supply_type ORDER BY spt.supply_type SEPARATOR ', ') AS supply_types
FROM suppliers s
LEFT JOIN status_types st ON s.status_id = st.status_id
LEFT JOIN supplier_supply_types sst ON s.supplier_id = sst.supplier_id
LEFT JOIN supply_types spt ON sst.type_id = spt.type_id
WHERE EXISTS (
    SELECT 1
    FROM supplier_supply_types sst_filter
    WHERE sst_filter.supplier_id = s.supplier_id
    AND sst_filter.type_id = $type  
)
GROUP BY s.supplier_id, s.name, s.inn, st.status_name, s.website, s.address, s.notes;");

		$suppliers = [];

		if (!$result)
		{
			throw new \Exception($DBOperator->connect_error);
		}

		while ($row = mysqli_fetch_assoc($result))
		{
			$suppliers[] = new Supplier
			($row['supplier_id'], $row['name'], $row['inn'], $row['status_name'], $row['website'], $row['address'],
				$row['notes'], $row['supply_types']);
		}

		return $suppliers;
	}

	public static function getSupplierForSearch($queryForSearch)
	{
		$DBOperator = DBHandler::getInstance();
		$result = $DBOperator->query("SELECT 
                s.supplier_id,
                s.name,
                s.inn,
                st.status_name,
                s.website,
                s.address,
                s.notes,
                GROUP_CONCAT(spt.supply_type SEPARATOR ', ') AS supply_types
            FROM suppliers s
            LEFT JOIN status_types st ON s.status_id = st.status_id
            LEFT JOIN supplier_supply_types sst ON s.supplier_id = sst.supplier_id
            LEFT JOIN supply_types spt ON sst.type_id = spt.type_id
            WHERE s.name LIKE '%$queryForSearch%'
            GROUP BY s.supplier_id");

		$suppliers = [];

		if (!$result)
		{
			throw new \Exception($DBOperator->connect_error);
		}

		while ($row = mysqli_fetch_assoc($result))
		{
			$suppliers[] = new Supplier
			($row['supplier_id'], $row['name'], $row['inn'], $row['status_name'], $row['website'], $row['address'],
				$row['notes'], $row['supply_types']);
		}

		return $suppliers;
	}
}