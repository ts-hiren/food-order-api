<div class="page-header page-header-light">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<span class="breadcrumb-item active">Dashboard</span>
			</div>

			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
<div class="content">
	<div class="row">
		<div class="col-sm-6 col-xl-3">
			<div class="card card-body bg-blue-400 has-bg-image">
				<div class="media">
					<div class="media-body">
						<h3 class="mb-0"><?= $user_count ?></h3>
						<span class="text-uppercase font-size-xs">Total Users</span>
					</div>

					<div class="ml-3 align-self-center">
						<i class="icon-users4 icon-3x opacity-75"></i>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-xl-3">
			<div class="card card-body bg-danger-400 has-bg-image">
				<div class="media">
					<div class="media-body">
						<h3 class="mb-0"><?= $book_count ?></h3>
						<span class="text-uppercase font-size-xs">Total Books</span>
					</div>

					<div class="ml-3 align-self-center">
						<i class="icon-books icon-3x opacity-75"></i>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-xl-3">
			<div class="card card-body bg-success-400 has-bg-image">
				<div class="media">
					<div class="mr-3 align-self-center">
						<i class="icon-quill4 icon-3x opacity-75"></i>
					</div>

					<div class="media-body text-right">
						<h3 class="mb-0"><?= $author_count ?></h3>
						<span class="text-uppercase font-size-xs">Total Authors</span>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-6 col-xl-3">
			<div class="card card-body bg-indigo-400 has-bg-image">
				<div class="media">
					<div class="mr-3 align-self-center">
						<i class="icon-bookmark icon-3x opacity-75"></i>
					</div>

					<div class="media-body text-right">
						<h3 class="mb-0"><?= $series_count ?></h3>
						<span class="text-uppercase font-size-xs">Total Series</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>