<? require LAYOUT_DIR . '/parts/head.php' ?>
<div class="container">
	<div class="row mt-4">
		<div class="col-12">
			<form method="POST" action="/login">
				<div class="form-group">
					<label for="login_name">Имя</label>
					<input type="text" class="form-control" id="login_name" name="name" placeholder="Введите имя" required>
				</div>
				<div class="form-group">
					<label for="login_password">Email</label>
					<input type="password" class="form-control" id="login_password" name="password" placeholder="Введите пароль" required>
				</div>
				<input type="hidden" name="method" value="put">
				<button type="submit" class="btn btn-primary">Отправить</button>
			</form>
		</div>
	</div>
</div>
<? require LAYOUT_DIR . '/parts/tail.php' ?>