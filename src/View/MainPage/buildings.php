<?php
/**
 * @var Contact[] $contactList;
 */
use App\Model\Contact;
?>

<?php if (!empty($contactList)): ?>
	<div class="container mt-4">
		<h4 class="mb-3">Контакты поставщика</h4>

		<div class="row g-4">
			<?php foreach ($contactList as $contact): ?>
				<div class="col-md-6 col-lg-4">
					<div class="card h-100 shadow-sm">
						<div class="card-header bg-primary text-white">
							<div class="d-flex align-items-center">
								<i class="bi bi-person-badge me-2"></i>
								<h5 class="card-title mb-0"><?= htmlspecialchars($contact->getName()) ?></h5>
							</div>
						</div>

						<div class="card-body">
							<?php if (!empty($contact->getPhone())): ?>
								<div class="d-flex align-items-center mb-3">
									<i class="bi bi-telephone text-primary me-2"></i>
									<a href="tel:<?= htmlspecialchars($contact->getPhone()) ?>" class="text-decoration-none">
										<?= htmlspecialchars($contact->getPhone()) ?>
									</a>
								</div>
							<?php endif; ?>

							<?php if (!empty($contact->getEmail())): ?>
								<div class="d-flex align-items-center">
									<i class="bi bi-envelope text-primary me-2"></i>
									<a href="mailto:<?= htmlspecialchars($contact->getEmail()) ?>" class="text-decoration-none">
										<?= htmlspecialchars($contact->getEmail()) ?>
									</a>
								</div>
							<?php endif; ?>
						</div>

						<div class="card-footer bg-light">
							<small class="text-muted">ID контакта: <?= $contact->getId() ?></small>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php else: ?>
	<div class="alert alert-info mt-4" role="alert">
		Нет контактов для отображения
	</div>
<?php endif; ?>