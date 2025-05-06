<?php

namespace Core\Database\Repo;

use App\Model\Supplier;
use App\Model\Contact;
use App\Service\DBHandler;

class ContactRepo
{
	public static function getContactsBySupplierId(int $supplierId): array
	{
		$DBOperator = DBHandler::getInstance();
		$result = $DBOperator->query(
			"SELECT c.* 
FROM contacts c
INNER JOIN supplier_contacts sc 
    ON c.contact_id = sc.contact_id
WHERE sc.supplier_id = $supplierId;");

		$contacts = [];

		if (!$result)
		{
			throw new \Exception($DBOperator->connect_error);
		}

		while ($row = mysqli_fetch_assoc($result))
		{
			$contacts[] = new Contact(
					$row['contact_id'],
					$row['full_name'],
					$row['phone'],
					$row['email']
				);
		}

		return $contacts;
	}


//	public static function getBuildingListForSearch($queryForSearch): array
//	{
//		$DBOperator = DBHandler::getInstance();
//		$result = $DBOperator->query(
//			"SELECT b.ID, b.NAME, YEAROFBEGINNINGBUILD, YEAROFENDINGBUILD, STYLEOFBUILDING, architect.NAME AS ARCHITECT
//FROM building b
//JOIN architect_building ON b.ID = architect_building.ID_BUILDING
//JOIN architect ON architect_building.ID_ARCHITECT = architect.ID
//WHERE b.NAME LIKE '%$queryForSearch%';");
//
//		$buildings = [];
//
//		if (!$result)
//		{
//			throw new \Exception($DBOperator->connect_error);
//		}
//
//		while ($row = mysqli_fetch_assoc($result))
//		{
//			$buildings[] = new Contact
//			(
//				$row['ID'],
//				$row['NAME'],
//				$row['YEAROFBEGINNINGBUILD'],
//				$row['YEAROFENDINGBUILD'],
//				$row['STYLEOFBUILDING'],
//				$row['ARCHITECT']
//			);
//		}
//
//		return $buildings;
//	}
}