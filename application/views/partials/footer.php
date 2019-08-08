<!-- Footer -->
<div class="navbar navbar-expand-lg navbar-light">
	<div class="text-center d-lg-none w-100">
		<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
			<i class="icon-unfold mr-2"></i>
			Footer
		</button>
	</div>

	<div class="navbar-collapse collapse" id="navbar-footer">
		<span class="navbar-text">
			&copy; <?= date('Y',strtotime('-1 Year')).' - '.date('Y') ?> <a href="#"><?= WEBSITE_TITLE ?></a>
		</span>

		<ul class="navbar-nav ml-lg-auto">

			<li class="nav-item">
				<a href="#" class="navbar-nav-link">
					<i class="icon-lifebuoy"></i>
				</a>
			</li>
		</ul>
	</div>
</div>
			<!-- /footer -->
<script type="text/javascript">
$(document).ready(function(){
	<?php 
	if ($this->session->flashdata('success_msg')) { 
	?>
		alertNotification('<?= $this->session->userdata('success_msg') ?>','success');
	<?php
	}elseif ($this->session->flashdata('error_msg')) { 
	?>
		alertNotification('<?= $this->session->userdata('error_msg') ?>','error');
	<?php
	} ?>
	<?php 
	if (@$success_msg) { 
	?>
		alertNotification('<?= @$success_msg ?>','success');
	<?php
	}elseif (@$error_msg) { 
	?>
		alertNotification('<?= @$error_msg ?>','error');
	<?php
	} ?>
});
</script>