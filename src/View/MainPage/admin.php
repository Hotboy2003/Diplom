<?php
/**
 * @var array $data // Ассоциативный массив таблиц
 */
$primaryKeys = [
	'suppliers' => 'supplier_id',
	'contacts' => 'contact_id',
	'status_types' => 'status_id',
	'migration' => 'id',
	'supply_types' => 'type_id'
];
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>
	/* Жёсткий сброс всех ограничений по ширине */
	body, html, .force-full-width {
		min-width: 100vw !important;
		max-width: 100vw !important;
		width: 100vw !important;
		margin: 0 !important;
		padding: 0 !important;
	}

	.database-table {
		min-width: 100vw;
		table-layout: fixed;
	}

	.card {
		border-radius: 0 !important;
		border-left: none !important;
		border-right: none !important;
	}
</style>

<body class="bg-light min-vw-100" style="margin: 0; overflow-x: hidden">
<div class="container-fluid p-0">
	<div class="card shadow-sm w-100 rounded-0">
		<div class="card-header bg-primary text-white py-3 rounded-0">
			<div class="d-flex justify-content-between align-items-center">
				<h2 class="h4 mb-0">
					<i class="bi bi-database me-2"></i>
					Управление базой данных
				</h2>
				<a href="/" class="btn btn-light btn-sm">
					<i class="bi bi-arrow-left me-2"></i>
					К поставщикам
				</a>
			</div>
		</div>

		<div class="card-body p-3">
			<ul class="nav nav-tabs mb-4" id="databaseTabs">
				<?php foreach ($data as $tableName => $tableData): ?>
					<li class="nav-item">
						<button class="nav-link <?= $tableName === 'suppliers' ? 'active' : '' ?>"
								data-bs-toggle="tab"
								data-bs-target="#<?= $tableName ?>">
							<?= match($tableName) {
								'contacts' => '📞 Контакты',
								'suppliers' => '🏢 Поставщики',
								'migration' => '📁 Миграции',
								'status_types' => '🏷️ Статусы',
								'supplier_contacts' => '🤝 Связи',
								'supply_types' => '📦 Типы поставок',
								default => $tableName
							} ?>
						</button>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="tab-content">
				<?php foreach ($data as $tableName => $tableData): ?>
					<div class="tab-pane fade <?= $tableName === 'suppliers' ? 'show active' : '' ?>"
						 id="<?= $tableName ?>">
						<div class="table-responsive">
							<?php if(empty($tableData)): ?>
								<div class="text-center py-5 bg-white">
									<i class="bi bi-database-x fs-1 text-muted"></i>
									<p class="mt-3 text-muted">Данные отсутствуют</p>
								</div>
							<?php else: ?>
								<table class="database-table table table-hover">
									<thead class="table-light">
									<tr>
										<?php foreach(array_keys($tableData[0]) as $column): ?>
											<th class="text-nowrap"><?= $column ?></th>
										<?php endforeach; ?>
										<th class="text-end">Действия</th>
									</tr>
									</thead>
									<tbody>
									<?php foreach($tableData as $row): ?>
										<tr>
											<?php foreach($row as $value): ?>
												<td class="align-middle">
													<?php if(is_array($value)): ?>
														<span class="badge bg-secondary">ARRAY</span>
													<?php elseif($value === null): ?>
														<span class="text-muted">—</span>
													<?php else: ?>
														<?= htmlspecialchars($value) ?>
													<?php endif; ?>
												</td>
											<?php endforeach; ?>
											<td class="text-end action-buttons">
												<form action="/edit/<?= $tableName ?>/" method="get">
													<input type="hidden" name="id" value="<?=$row[$primaryKeys[$tableName]]?>">
													<button type="submit" class="btn btn-sm btn-outline-primary">
														<i class="bi bi-pencil"></i>
													</button>
												</form>
												<button class="btn btn-sm btn-outline-danger ms-2 delete-btn">
													<i class="bi bi-trash"></i>
												</button>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const tables = document.querySelectorAll('.database-table');

		tables.forEach(table => {
			table.style.minWidth = '100%';
			table.parentElement.style.overflowX = 'auto';
		});
	});
</script>