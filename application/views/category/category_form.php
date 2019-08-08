<form data-action="<?= base_url('submit-category') ?>" action="#" class="ajax-action-form" method="post">
	<div class="form-group">
		<div class="row">
			<div class="col-sm-6">
				<label>Category Name</label>
				<input type="text" placeholder="Name of Category" name="category_name" value="<?= @$record['category_name'] ?>" class="form-control">
				<input type="hidden" name="hdnID" value="<?= @$record['category_id'] ?>">
			</div>
			<div class="col-sm-6">
				<label>Paramlink</label>
				<input type="text" placeholder="Link of Category" name="paramlink" class="form-control" value="<?= @$record['paramlink'] ?>">
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-12">
				<label>Description</label>
				<textarea class="form-control" name="description"><?= @$record['description'] ?></textarea>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-12">
				<label>Meta / Page Title</label>
				<input type="text" placeholder="Meta Title" name="meta_title" class="form-control" value="<?= @$record['meta_title'] ?>">
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-12">
				<label>Meta Description</label>
				<textarea placeholder="Meta Description" name="meta_description" class="form-control"><?= @$record['meta_description'] ?></textarea>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-12">
				<label>Meta Keywords</label>
				<textarea placeholder="Keywords" name="meta_keywords" class="form-control keyword-input"><?= @$record['meta_keywords'] ?></textarea>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 text-right">
			<button type="submit" class="submit-button btn bg-info-800 btn-labeled btn-labeled-left rounded-round" <?= @$record['category_id'] ? '' : 'disabled' ?>><b><i class="icon-checkmark4"></i></b> Save</button>
		</div>
	</div>
</form>