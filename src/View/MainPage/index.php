<?php
/**
 * @var $data;
 * @var $types;
 * @var $filterType;
 * @var $dopTitle;
 */
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>
	.supplier-table {
		table-layout: fixed;
		width: 100%;
		min-width: 1200px;
	}

	.details-content {
		background: #f8f9fa;
		border-bottom: 3px solid #dee2e6;
	}

	.info-card {
		border-left: 4px solid;
		height: 100%;
		transition: transform 0.2s;
	}

	.info-card:hover {
		transform: translateY(-2px);
	}

	.basic-card {
		border-color: #0d6efd;
	}

	.contacts-card {
		border-color: #fd7e14;
	}

	.notes-card {
		border-color: #198754;
	}

	.card-title {
		font-size: 1.1rem;
		font-weight: 500;
	}

	.toggle-icon {
		transition: transform 0.3s ease;
	}

	.collapsed .toggle-icon {
		transform: rotate(180deg);
	}

	/* Новые стили для dopTitle */
	.dop-title {
		color: #0d6efd; /* Основной синий цвет как в заголовке */
		font-size: 1.25rem;
		font-weight: 500;
		border-bottom: 2px solid #dee2e6;
		padding-bottom: 0.5rem;
		margin: 1.5rem 0 2rem;
		display: flex;
		align-items: center;
		gap: 0.75rem;
	}

	.dop-title i {
		font-size: 1.4em;
		color: #0d6efd;
		vertical-align: middle;
	}
</style>

<?php if (!empty($dopTitle)): ?>
	<div class="dop-title">
		<i class="bi bi-info-square"></i>
		<?= htmlspecialchars($dopTitle) ?>
	</div>
<?php endif; ?>

<div class="container-fluid mt-4">
	<div class="card shadow">
		<div class="card-header bg-primary text-white d-flex flex-wrap justify-content-between align-items-center">
			<h3 class="mb-3 mb-md-0">Список поставщиков</h3>

			<div class="d-flex flex-wrap gap-2 filter-buttons">
				<button class="btn btn-outline-light btn-sm <?= $filterType === NULL ? 'active' : '' ?>"
						data-filter="all"
						onclick="window.location.href = '/';">
					Все
				</button>
				<?php foreach ($types as $type): ?>
				<button class="btn btn-outline-light btn-sm <?= (int)$filterType === $type->getId() ? 'active' : '' ?>"
						data-filter="<?= $type->getName() ?>"
						onclick="window.location.href = '/type/<?= $type->getId() ?>/';">
					<i class="bi me-1"></i><?= $type->getName() ?>
				</button>
				<?php endforeach; ?>
			</div>
		</div>

		<div class="card-body p-0">
			<div class="table-responsive">
				<table class="table supplier-table m-0">
					<thead class="table-light">
					<tr>
						<th style="width: 25%">Название</th>
						<th style="width: 15%">Статус</th>
						<th style="width: 20%">Сайт</th>
						<th style="width: 25%">Типы поставок</th>
						<th style="width: 15%">Действия</th>
					</tr>
					</thead>
					<tbody>

					<tbody>
					<?php foreach ($data as $supplier): ?>
						<tr data-bs-toggle="collapse"
							data-bs-target="#details-<?= $supplier['supplier']->getId() ?>"
							class="align-middle">
							<td><?= htmlspecialchars($supplier['supplier']->getName()) ?></td>
							<td>
            <span class="badge bg-<?= match($supplier['supplier']->getStatusName()) {
				'Активен' => 'success',
				'На проверке' => 'warning',
				'Архивный' => 'secondary',
				default => 'primary'
			} ?>">
                <?= htmlspecialchars($supplier['supplier']->getStatusName()) ?>
            </span>
							</td>
							<td>
								<?php if ($supplier['supplier']->getWebsite()): ?>
									<span target="_blank"
									   class="text-decoration-none">
										<?= htmlspecialchars($supplier['supplier']->getWebsite()) ?>
									</span>
								<?php else: ?>
									<span class="text-muted">Нет сайта</span>
								<?php endif; ?>
							</td>
							<td>
								<?php if ($supplier['supplier']->getSupplyTypes()): ?>
									<?= htmlspecialchars($supplier['supplier']->getSupplyTypes()) ?>
								<?php else: ?>
									<span class="text-muted">Не указаны</span>
								<?php endif; ?>
							</td>
							<td>
								<button class="btn btn-sm btn-outline-primary">
									<i class="bi bi-chevron-down toggle-icon"></i>
									Подробнее
								</button>
							</td>
						</tr>

						<tr class="collapse details-content" id="details-<?= $supplier['supplier']->getId() ?>">
							<td colspan="5" class="p-3">
								<div class="row g-3">
									<div class="col-12 col-lg-4">
										<div class="info-card basic-card p-3 bg-white shadow-sm">
											<div class="d-flex align-items-center mb-3">
												<i class="bi bi-building fs-5 me-2 text-primary"></i>
												<h6 class="card-title mb-0 text-primary">Основные данные</h6>
											</div>
											<dl class="row mb-0">
												<dt class="col-4 fw-bold text-muted">ИНН:</dt>
												<dd class="col-8"><?= htmlspecialchars($supplier['supplier']->getINN() ?? '—') ?></dd>

												<dt class="col-4 fw-bold text-muted mt-2">Адрес:</dt>
												<dd class="col-8 mt-2"><?= htmlspecialchars($supplier['supplier']->getAddress() ?? '—') ?></dd>
											</dl>
										</div>
									</div>

									<div class="col-12 col-lg-4">
										<div class="info-card contacts-card p-3 bg-white shadow-sm">
											<div class="d-flex align-items-center mb-3">
												<i class="bi bi-person-lines-fill fs-5 me-2 text-warning"></i>
												<h6 class="card-title mb-0 text-warning">Контакты</h6>
											</div>
											<?php if (!empty($supplier['contacts'])): ?>
												<?php foreach ($supplier['contacts'] as $contact): ?>
													<div class="mb-3">
														<div class="fw-bold">
															<?= htmlspecialchars($contact->getName()) ?>
														</div>
														<div class="text-secondary">
															<?php if ($contact->getPhone()): ?>
																<i class="bi bi-telephone me-1"></i>
																<?= htmlspecialchars($contact->getPhone()) ?><br>
															<?php endif; ?>
															<?php if ($contact->getEmail()): ?>
																<i class="bi bi-envelope me-1"></i>
																<?= htmlspecialchars($contact->getEmail()) ?>
															<?php endif; ?>
														</div>
													</div>
												<?php endforeach; ?>
											<?php else: ?>
												<div class="text-muted fst-italic">Нет контактов</div>
											<?php endif; ?>
										</div>
									</div>

									<div class="col-12 col-lg-4">
										<div class="info-card notes-card p-3 bg-white shadow-sm">
											<div class="d-flex align-items-center mb-3">
												<i class="bi bi-journal-text fs-5 me-2 text-success"></i>
												<h6 class="card-title mb-0 text-success">Заметки</h6>
											</div>
											<?php if ($supplier['supplier']->getNotes()): ?>
												<div class="bg-light p-2 rounded pre-scrollable">
													<?= nl2br(htmlspecialchars($supplier['supplier']->getNotes())) ?>
												</div>
											<?php else: ?>
												<div class="text-muted fst-italic">Нет заметок</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(button => {
			button.addEventListener('click', function() {
				this.classList.toggle('collapsed');

				// Обновляем фиксированные ширины колонок
				const table = this.closest('table');
				if (table) {
					const cols = table.querySelectorAll('th, td');
					cols.forEach(col => {
						col.style.minWidth = col.offsetWidth + 'px';
					});
				}
			});
		});
	});
</script>