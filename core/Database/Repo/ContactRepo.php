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
}