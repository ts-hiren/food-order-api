<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?= $pageTitle ? $pageTitle : WEBSITE_TITLE ?></title>
	<?php $this->load->view('partials/headlinks'); ?>
	<?php $this->load->view('partials/scripts'); ?>
</head>
<body class="navbar-top">
	<?php $this->load->view('partials/navigation'); ?>
	<!-- Page content -->
	<div class="page-content">
		<?php $this->load->view('partials/sidebar'); ?>
		<!-- Main content -->
		<div class="content-wrapper">
			<?php $this->load->view(''.$page,$pageData); ?>
			
			<?php $this->load->view('partials/footer'); ?>
		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->
	<div id="naruto_modal" class="modal fade" data-backdrop="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-slate-800">
					<h6 class="modal-title">Untitled</h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body" style="min-height: 200px">
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>