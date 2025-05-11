<?php
/**
 * @var array $data
 * @var string $tableName
 * @var array $statuses
 * @var array $types
 * @var array $contacts
 * @var array $addOrEdit
 */
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<html lang="ru" style="height: 100%">

<style>
	html, body {
		margin: 0 !important;
		padding: 0 !important;
		width: 100% !important;
		height: 100% !important;
	}

	.centered-nuke {
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
		width: 100%;
		max-width: 800px;
		padding: 20px;
		margin-top: 150px;
	}

	.field-group {
		background: rgba(245, 245, 245, 0.9);
		padding: 1rem;
		border-radius: 10px;
		border: 1px solid #e0e0e0;
		margin-bottom: 1rem;
	}

	.editable-highlight {
		box-shadow: 0 0 8px rgba(13, 110, 253, 0.25);
		transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	}
</style>

<body class="bg-light">
<div class="centered-nuke">
	<div class="bg-white rounded-3 shadow p-4">
		<h4 class="text-primary text-center mb-4">
			<i class="bi bi-database me-2"></i>Редактирование объекта
		</h4>

		<form method="POST" action="/<?= $addOrEdit ?>/update/<?= $tableName ?>/" id="editForm">
			<?php $index = 0; ?>
			<?php foreach ($data as $key => $value): ?>
				<div class="field-group">
					<div class="d-flex align-items-center gap-3">
						<label class="fw-bold text-nowrap" style="width: 120px">
							<?= htmlspecialchars($key) ?>
						</label>

						<?php if ($key === 'status_name'): ?>
							<select name="<?= htmlspecialchars($key) ?>"
									class="form-select border-primary"
								<?= ($index === 0) ? 'disabled' : '' ?>>
								<?php foreach ($statuses as $status): ?>
									<option value="<?= htmlspecialchars($status['status_id']) ?>"
										<?= $status['status_id'] == $value ? 'selected' : '' ?>>
										<?= htmlspecialchars($status['status_name']) ?>
									</option>
								<?php endforeach; ?>
							</select>
							<?php if ($index === 0): ?>
								<input type="hidden" name="<?= htmlspecialchars($key) ?>"
									   value="<?= htmlspecialchars($value) ?>">
							<?php endif; ?>

						<?php elseif ($key === 'supply_types'): ?>
							<select name="supply_types[]"
									multiple
									size="4"
									class="form-select border-primary"
									title="Удерживайте Ctrl для выбора нескольких вариантов">
								<?php
								$selectedTypes = explode(', ', $value);
								foreach ($types as $type):
									?>
									<option value="<?= htmlspecialchars($type['type_id']) ?>"
										<?= in_array($type['supply_type'], $selectedTypes) ? 'selected' : '' ?>>
										<?= htmlspecialchars($type['supply_type']) ?>
									</option>
								<?php endforeach; ?>
							</select>
							<?php if ($index === 0): ?>
								<input type="hidden" name="<?= htmlspecialchars($key) ?>"
									   value="<?= htmlspecialchars($value) ?>">
							<?php endif; ?>

						<?php elseif ($key === 'contacts'): ?>
							<select name="contacts[]"
									multiple
									size="4"
									class="form-select border-primary"
									title="Удерживайте Ctrl для выбора нескольких вариантов">
								<?php
								$selectedContacts = explode(', ', $value);
								foreach ($contacts as $contact):
									?>
									<option value="<?= htmlspecialchars($contact['contact_id']) ?>"
										<?= in_array($contact['contact_id'], $selectedContacts) ? 'selected' : '' ?>>
										<?= htmlspecialchars($contact['full_name']) ?>
									</option>
								<?php endforeach; ?>
							</select>

						<?php else: ?>
							<input type="text"
								   name="<?= htmlspecialchars($key) ?>"
								   class="form-control border-primary"
								   value="<?= htmlspecialchars($value) ?>"
								<?= ($index === 0) ? 'readonly' : '' ?>>
						<?php endif; ?>
					</div>
				</div>
				<?php $index++ ?>
			<?php endforeach; ?>


			<div class="text-center mt-4">
				<button type="submit" class="btn btn-primary px-5">
					<i class="bi bi-save me-2"></i>Сохранить изменения
				</button>
			</div>
		</form>
	</div>
</div>
</body>
</html>