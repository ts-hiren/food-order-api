<div class="page-header page-header-light">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<span class="breadcrumb-item active">DMCA</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
<div class="content">
	<div class="card">
		<div class="card-header header-elements-inline">
			<h5 class="card-title">DMCA</h5>
		</div>
		<div class="card-body">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<div class="row">
						<div class="col-sm-12">
							<textarea class="form-control editor-text" placeholder="Description" name="content"><?= $this->load->view('content/dmca',[],true); ?></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 text-right">
						<button type="submit" class="submit-button btn bg-info-800 btn-labeled btn-labeled-left rounded-round" name="page_type" value="dmca"><b><i class="icon-checkmark4"></i></b> Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="<?=ADMIN_ASSET_URL?>js/summernote.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('.editor-text').summernote({
			  toolbar: [
			    ['style', ['bold', 'italic', 'underline', 'clear']],
			    ['color', ['color']],
			    ['para', ['ul', 'ol', 'paragraph']]
			  ]
			});
	});
</script>
