<?php

return
	['APP_LANG' => 'ru',
		'primaryKeys' => [
	'suppliers' => 'supplier_id',
	'contacts' => 'contact_id',
	'status_types' => 'status_id',
	'migration' => 'id',
	'supply_types' => 'type_id',
			],
		'excludedTables' => [
			'migration',
			'supplier_contacts',
			'supplier_supply_types']
];