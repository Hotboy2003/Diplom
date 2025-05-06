<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<style>
	/* Жёсткий сброс стилей */
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	/* Принудительное центрирование */
	body {
		min-height: 100vh;
		display: flex;
		justify-content: center;
		align-items: center;
		background: white !important; /* Белый фон всей страницы */
	}

	.main-card {
		width: 600px;
		max-width: 95vw; /* Адаптивность для мобильных */
		border: none;
		box-shadow: 0 0 40px rgba(0, 0, 0, 0.1);
		transform: translate(0) !important; /* Блокировка любых смещений */
	}

	.input-group-text {
		background: #f8f9fa;
		border-right: none;
	}

	.form-control {
		border-left: none;
		padding: 1.2rem;
	}
</style>

<body>
<div class="main-card card">
	<div class="card-header bg-primary text-white py-4">
		<h1 class="h2 mb-0">
			<i class="bi bi-shield-lock me-3"></i>
			Авторизация администратора
		</h1>
	</div>

	<div class="card-body p-4 p-lg-5">
		<form method="post" action="/admin/login/check/">
			<!-- Логин -->
			<div class="mb-4">
				<div class="input-group">
                  <span class="input-group-text">
                      <i class="bi bi-person fs-5"></i>
                  </span>
					<input type="text"
						   name="login"
						   class="form-control form-control-lg"
						   placeholder="Введите логин"
						   required>
				</div>
			</div>

			<!-- Пароль -->
			<div class="mb-4">
				<div class="input-group">
                  <span class="input-group-text">
                      <i class="bi bi-key fs-5"></i>
                  </span>
					<input type="password"
						   name="password"
						   class="form-control form-control-lg"
						   placeholder="Введите пароль"
						   required>
				</div>
			</div>

			<!-- Кнопка входа -->
			<button type="submit"
					class="btn btn-primary btn-lg w-100 py-3">
				<i class="bi bi-box-arrow-in-right me-2"></i>
				Войти в систему
			</button>
		</form>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>