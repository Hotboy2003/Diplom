<?php
/**
 * @var string $content
 */
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" href="/resources/img/house-svgrepo-com.svg" type="image/x-icon">
	<link rel="stylesheet" href="/resources/css/reset.css">
	<link rel="stylesheet" href="/resources/css/style.css">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<title><?= 'Поставщики' ?></title>
</head>
<body>

<header class="container-fluid border-bottom">
	<div class="row align-items-center py-3 px-md-5 g-4">
		<div class="col-md-auto">
			<a href="/" class="d-flex align-items-center text-decoration-none">
				<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#0d6efd" class="bi bi-truck" viewBox="0 0 16 16">
					<path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A2 2 0 0 1 4.732 11h8.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
				</svg>
				<span class="ms-3 fs-3 fw-bold text-primary d-none d-md-block">Поставщики</span>
			</a>
		</div>

		<div class="col-md-6 col-lg-5">
			<form action="/" method="GET">
				<div class="input-group shadow-sm">
					<input type="search"
						   class="form-control border-primary py-2"
						   placeholder="Поиск поставщиков..."
						   aria-label="Поиск"
						   name="search"
						   required>
					<button class="btn btn-primary px-3" type="submit">
						<svg width="1.2em" height="1.2em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor">
							<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
						</svg>
					</button>
				</div>
			</form>
		</div>

		<div class="col-md-auto ms-auto">
			<div class="d-flex align-items-center gap-3">
				<span class="badge bg-success">v2.1</span>
				<div class="vr d-none d-sm-block"></div>
				<span class="text-muted small d-none d-sm-block"><?= date('Y') ?> © Поставщики</span>
			</div>
		</div>
	</div>
</header>

<div class="content">
	<div class="main_section">
		<p></p>
		<?= $content ?>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>