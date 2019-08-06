<? require LAYOUT_DIR . '/parts/head.php' ?>
<div class="container">
	<div class="row mt-4">
		<div class="col-12">
			<form method="POST" action="/create">
				<div class="form-group">
					<label for="problem_name">Имя</label>
					<input type="text" class="form-control" id="problem_name" name="name" value="<?= $name ?>" placeholder="Введите имя" required>
				</div>
				<div class="form-group">
					<label for="problem_email">Email</label>
					<input type="email" class="form-control" id="problem_email" name="email" value="<?= $email ?>" placeholder="Введите email" required>
				</div>
				<div class="form-group">
					<label for="problem_descr">Текст задачи</label>
					<textarea class="form-control" id="problem_descr" name="descr" rows="3" required></textarea>
				</div>
				<input type="hidden" name="method" value="create">
				<button type="submit" class="btn btn-primary">Отправить</button>
			</form>
		</div>
	</div>
</div>
<? require LAYOUT_DIR . '/parts/tail.php' ?>