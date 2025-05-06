<?php
/**
 * @var array $data
 * @var string $tableName
 */
?>
<!DOCTYPE html>
<html lang="ru" style="height: 100%">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

	<style>
		/* Жёсткий reset (оставлен) */
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
		}

		.field-group {
			background: rgba(245, 245, 245, 0.9);
			padding: 1rem;
			border-radius: 10px;
			border: 1px solid #e0e0e0;
			margin-bottom: 1rem;
		}

		/* Новые улучшения */
		.editable-highlight {
			box-shadow: 0 0 8px rgba(13, 110, 253, 0.25);
			transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
		}
	</style>
</head>

<body class="bg-light">
<div class="centered-nuke">
	<div class="bg-white rounded-3 shadow p-4">
		<h4 class="text-primary text-center mb-4">
			<i class="bi bi-database me-2"></i>Редактирование объекта
		</h4>

		<form method="POST" action="/edit/update/<?= $tableName ?>/" id="editForm">
			<?php $index = 0; ?>
			<?php foreach ($data as $key => $value): ?>
				<div class="field-group">
					<div class="d-flex align-items-center gap-3">
						<label class="fw-bold text-nowrap" style="width: 120px">
							<?= htmlspecialchars($key) ?>
						</label>
						<input type="text"
							   name="<?= htmlspecialchars($key) ?>"
							   class="form-control border-primary"
							   value="<?= htmlspecialchars($value) ?>"
							<?= ($index === 0) ? 'readonly' : '' ?>>
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