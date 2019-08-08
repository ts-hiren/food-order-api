<!-- Main sidebar -->
<?php
$auth_admin_data = $this->session->userdata('auth_admin_data');
?>
<div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md">
	<div class="sidebar-mobile-toggler text-center">
		<a href="#" class="sidebar-mobile-main-toggle">
			<i class="icon-arrow-left8"></i>
		</a>
		Navigation
		<a href="#" class="sidebar-mobile-expand">
			<i class="icon-screen-full"></i>
			<i class="icon-screen-normal"></i>
		</a>
	</div>
	<div class="sidebar-content">
		<div class="sidebar-user">
			<div class="card-body">
				<div class="media">
					<div class="mr-3">
						<a href="#"><img src="<?= ADMIN_ASSET_URL ?>/images/placeholder.png" width="38" height="38" class="rounded-circle" alt=""></a>
					</div>

					<div class="media-body">
						<div class="media-title font-weight-semibold"><?= $auth_admin_data['first_name'].' '.$auth_admin_data['last_name'] ?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="card card-sidebar-mobile">
			<ul class="nav nav-sidebar" data-nav-type="accordion">
				<!-- Main -->
				<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
				<li class="nav-item">
					<a href="<?= base_url('') ?>" class="nav-link">
						<i class="icon-home4"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= base_url('/category') ?>" class="nav-link">
						<i class="icon-tree6"></i>
						<span>Category</span>
					</a>
				</li>
				<li class="nav-item nav-item-submenu">
					<a href="javascript:void(0)" class="nav-link">
						<i class="fa fa-book"></i>
						<span>Books</span>
					</a>
					<ul class="nav nav-group-sub">
						<li class="nav-item">
							<a href="<?= base_url('/book') ?>" class="nav-link">
								<i class="icon-book2"></i>
								<span>Add / Edit Book</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?= base_url('/books') ?>" class="nav-link">
								<i class="icon-archive"></i>
								<span>Book List</span>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item nav-item-submenu">
					<a href="javascript:void(0)" class="nav-link">
						<i class="icon-meter2"></i>
						<span>Content Pages</span>
					</a>
					<ul class="nav nav-group-sub">
						<li class="nav-item">
							<a href="<?= base_url('/content/dmca') ?>" class="nav-link">
								<span>DMCA</span>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>