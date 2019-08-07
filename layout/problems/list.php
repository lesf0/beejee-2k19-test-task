<? require LAYOUT_DIR . '/parts/head.php' ?>
<div class="container">
	<div class="row mt-4">
		<div class="col-12 text-right">
			<? if(array_key_exists('user', $_SESSION) && $_SESSION['user']->is_admin): ?>
			Добро пожаловать, <?= $_SESSION['user']->name ?>
			<? else: ?>
			<a class="btn btn-link" href="/login" role="button">Login</a>
			<? endif; ?>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-12">
			Сортировать по:
			<a class="btn btn-link" href="/?p=<?= $page ?>&o=name" role="button">Имя</a>
			<a class="btn btn-link" href="/?p=<?= $page ?>&o=email" role="button">Email</a>
			<a class="btn btn-link" href="/?p=<?= $page ?>&o=completed" role="button">Статус</a>
		</div>
	</div>
	<div class="row mb-4">
		<? foreach ($problems as $problem): ?>
		<div class="col-4 col-md-6 col-sm-12 mt-4">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title"><?= $problem->name ?></h5>
					<h6 class="card-subtitle mb-2 text-muted text-truncate "><?= $problem->email ?></h6>
					<p class="card-text"><?= $problem->descr ?></p>
					<? if($problem->edited): ?>
					<p class="card-text text-muted">отредактировано администратором ✔</p>
					<? endif; ?>
					<? if($problem->completed): ?>
					<p class="card-text text-muted">выполнено администратором ✔</p>
					<? endif; ?>
					<? if(array_key_exists('user', $_SESSION) && $_SESSION['user']->is_admin): ?>
					<a href="/edit/<?= $problem->id ?>" class="card-link">Редактировать задачу</a>
					<? endif; ?>
				</div>
			</div>
		</div>
		<? endforeach; ?>
	</div>

	<dib class="row">
		<div class="col-10 col-md-8 col-sm-12">
			<nav>
				<ul class="pagination">
					<li class="page-item<?= !$page ? ' disabled' : '' ?>">
						<a class="page-link" href="/?p=<?= $page-1 ?>" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span>
							<span class="sr-only">Previous</span>
						</a>
					</li>
					<? for ($i=0; $i < $total; $i++): ?>
					<li class="page-item<?= ($i == $page) ? ' active' : '' ?>">
						<a class="page-link" href="/?p=<?= $i ?>"><?= $i+1 ?></a>
					</li>
					<? endfor; ?>
					<li class="page-item<?= ($page >= $total-1) ? ' disabled' : '' ?>">
						<a class="page-link" href="/?p=<?= $page+1 ?>" aria-label="Next">
							<span aria-hidden="true">&raquo;</span>
							<span class="sr-only">Next</span>
						</a>
					</li>
				</ul>
			</nav>
		</div>
		<div class="col-2 col-md-4 col-sm-12 text-right">
			<a class="btn btn-primary" href="/add" role="button">Создать задачу</a>
		</div>
	</dib>
</div>
<? require LAYOUT_DIR . '/parts/tail.php' ?>