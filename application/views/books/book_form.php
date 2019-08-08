<div class="page-header page-header-light">
	<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="<?= base_url('admin') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<a href="<?= base_url('books') ?>" class="breadcrumb-item">Books</a>
				<span class="breadcrumb-item active">Add Book</span>
			</div>
			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>
	</div>
</div>
<div class="content">
	<div class="card">
		<div class="card-header header-elements-inline">
			<h5 class="card-title">Add / Edit Book</h5>
		</div>
		<div class="card-body">
			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group row">
					<label class="col-sm-2 col-form-label">Book Name</label>
					<div class="col-sm-8">
						<input type="text" placeholder="Name of Book" name="book_name" class="form-control" value="<?= @$record['book_name'] ?>">
						<input type="hidden" name="hdnID" value="<?= @$record['book_id'] ?>">
					</div>
					<div class="form-check">
						<label class="form-check-label">
							<input type="checkbox" name="best_seller" class="uniform-check-primary" <?= @$record['best_seller'] ? 'checked' : '' ?> data-fouc>
							Best Seller
						</label>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 col-form-label-sm">Param Link</label>
						<div class="col-sm-8">
							<input type="text" placeholder="Link of Book" name="paramlink" class="form-control form-control-sm" value="<?= @$record['paramlink'] ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 col-form-label">Category</label>
						<div class="col-sm-8">
							<select data-placeholder="Select Categories..." multiple class="form-control select" name="categories[]" data-fouc>
								<?php
									foreach ($category_option as $cotp) {
										$sel = in_array($cotp['category_id'], $category_applied) ? 'selected' : '';
										echo "<option value='".$cotp['category_id']."' $sel>".$cotp['category_name']."</option>";
									}
								?>
							</select>
						</div>
						<div class="col-sm-2">
							<button type="button" onclick="openModal('Add Category','<?= base_url('/category-modal/0') ?>','lg','select[name*=categories]')" class="btn bg-teal-400 btn-labeled btn-labeled-left rounded-round"><b><i class="icon-plus3"></i></b> Add Category</button>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 col-form-label">Author</label>
						<div class="col-sm-8">
							<select data-placeholder="Select Author..." multiple class="form-control select" name="authors[]" data-fouc>
								<?php
									foreach ($author_option as $aotp) {
										$sel = in_array($aotp['author_id'], $author_applied) ? 'selected' : '';
										echo "<option value='".$aotp['author_id']."' $sel>".$aotp['author_name']."</option>";
									}
								?>
							</select>
						</div>
						<div class="col-sm-2">
							<button type="button" onclick="openModal('Add Author','<?= base_url('/author-modal/0') ?>','lg','select[name*=authors]')" class="btn bg-teal-400 btn-labeled btn-labeled-left rounded-round"><b><i class="icon-plus3"></i></b> Add Author</button>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 col-form-label">Series</label>
						<div class="col-sm-6">
							<select data-placeholder="Select Series..." name="series_id" class="form-control select" data-fouc>
								<option value="0">None</option>
								<?php
									foreach ($series_option as $sotp) {
										$sel = $sotp['series_id'] == @$record['series_id'] ? 'selected' : '';
										echo "<option value='".$sotp['series_id']."' $sel>".$sotp['series_name']."</option>";
									}
								?>
							</select>
						</div>
						<div class="col-sm-2">
							<input type="text" class="form-control" placeholder="Part No#" name="series_rank" value="<?= @$record['series_rank'] ?>">
						</div>
						<div class="col-sm-2">
							<button type="button" onclick="openModal('Add Series','<?= base_url('/series-modal/0') ?>','lg','select[name*=series_id]')" class="btn bg-teal-400 btn-labeled btn-labeled-left rounded-round"><b><i class="icon-plus3"></i></b> Add Series</button>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 col-form-label">Featured Image</label>
						<div class="col-sm-8">
							<input type="file" class="custom-file-upload" name="image" data-fouc>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 col-form-label">Meta / Page Title</label>
						<div class="col-sm-8">
							<input type="text" placeholder="Meta Title" name="meta_title" class="form-control" value="<?= @$record['meta_title'] ?>">
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 col-form-label">Meta Description</label>
						<div class="col-sm-8">
							<textarea placeholder="Meta Description" name="meta_description" class="form-control"><?= @$record['meta_description'] ?></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 col-form-label">Meta Keywords</label>
						<div class="col-sm-8">
							<textarea placeholder="Keywords" name="meta_keywords" class="keyword-input form-control"><?= @$record['meta_keywords'] ?></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<label class="col-sm-2 col-form-label">Search Keywords</label>
						<div class="col-sm-8">
							<textarea placeholder="Keywords" name="search_keywords" class="keyword-input search-keyword form-control"><?= @$record['search_keywords'] ?></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-10">
							<textarea class="form-control editor-text" placeholder="Description" name="description"><?= @$record['description'] ?></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-10">
							<table class="table table-bordered drawLinkTable">
								<thead>
									<tr>
										<th>Download Links</th>
										<th class="text-center" width="7%">Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-10 text-right">
						<button type="submit" class="submit-button btn bg-info-800 btn-labeled btn-labeled-left rounded-round" <?= @$record['book_id'] ? '' : 'disabled' ?>><b><i class="icon-checkmark4"></i></b> Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="<?=ADMIN_ASSET_URL?>js/form/select2.min.js"></script>
<script src="<?=ADMIN_ASSET_URL?>js/summernote.min.js"></script>
<script type="text/javascript">
	var links = [''];
	<?php 
	if (isset($links_applied) && count($links_applied) >= 1) { ?>
		var	links_text = '<?= json_encode($links_applied) ?>';
		links = JSON.parse(links_text);
	<?php }
	?>
	var drawLinkTable = {};
	drawLinkTable.link_row = function(key,value){
		return `<tr data-key="`+key+`">
					<td>
						<input type="text" placeholder="Download Link" class="form-control form-control-sm" value="`+value+`" name="download_link[]">
					</td>
					<td class="text-center">
						<div>
							<a href='javascript:void(0)' onclick="addRow()" title='Add'><i class='text-success icon-plus-circle2'></i></a>
							<a href='javascript:void(0)' onclick="removeRow(`+key+`)" title='Delete'><i class='text-danger icon-cancel-circle2'></i></a>
						</div>
					</td>
				</tr>`;
	};
	$(function(){
		$('.uniform-check-primary').uniform({
            wrapperClass: 'border-primary-600 text-primary-800'
        });
		$('body').on('change','.ajax-action-form input[name=series_name],.ajax-action-form input[name=author_name],.ajax-action-form input[name=category_name],.ajax-action-form input[name=paramlink]',function(){
			var dataObj = {};
			var url = '';
			if ($('.ajax-action-form input[name=series_name]').length != 0) {
				url = '<?= base_url('/check_series') ?>';
			}else if ($('.ajax-action-form input[name=author_name]').length != 0) {
				url = '<?= base_url('/check_author') ?>';
			}else if ($('.ajax-action-form input[name=category_name]').length != 0) {
				url = '<?= base_url('/check_category') ?>';
			}
			$('.ajax-action-form input[name=paramlink]').attr('readonly',true);
			dataObj[$(this).attr('name')] = $(this).val();
			dataObj['hdnID'] = $('.ajax-action-form input[name=hdnID]').val();
			$.ajax({
				url: url,
				type: 'post',
				data: dataObj,
				dataType: 'json',
				success:function(a){
					if (a.status == 'success') {
						invalid_form = false;
						$('.ajax-action-form input[name=paramlink]').val(a.link);
						$('.ajax-action-form input[name=paramlink]').attr('readonly',false);
						$('.ajax-action-form .submit-button').attr('disabled',false);
					}else{
						invalid_form = true;
						alertNotification(a.msg,'error');
						$('.ajax-action-form .submit-button').attr('disabled','disabled');
					}
				}
			});
		});
		drawLinkTable.draw();
		$('.custom-file-upload').uniform({fileButtonClass: 'action btn bg-teal-400'});
		$('.keyword-input').tokenfield();
		$('.select').select2();
		$('.editor-text').summernote({
			  toolbar: [
			    // [groupName, [list of button]]
			    ['style', ['bold', 'italic', 'underline', 'clear']],
			    ['color', ['color']],
			    ['para', ['ul', 'ol', 'paragraph']]
			  ]
			});
      	// $('.editor-text').summernote('fontName','Poppins');

		$('body').on('change','input[name=book_name],input[name=paramlink]',function(){
			var dataObj = {};
			$('input[name=paramlink]').attr('readonly',true);
			dataObj[$(this).attr('name')] = $(this).val();
			dataObj['hdnID'] = $('input[name=hdnID]').val();
			$.ajax({
				url: '<?= base_url('/check_books') ?>',
				type: 'post',
				data: dataObj,
				dataType: 'json',
				success:function(a){
					if (a.status == 'success') {
						invalid_form = false;
						$('input[name=paramlink]').val(a.link);
						$('input[name=paramlink]').attr('readonly',false);
						$('.submit-button').attr('disabled',false);
					}else{
						invalid_form = true;
						alertNotification(a.msg,'error');
						$('.submit-button').attr('disabled','disabled');
					}
				}
			});
		});
		$('body').on('change','.select',function(){
			var currentKeywords = $('.search-keyword').val();
			currentKeywords = currentKeywords.split(', ');
			$('select[name*=categories] option:selected,select[name*=authors] option:selected').each(function(index){
				var tempText = $(this).text();
				if (currentKeywords.indexOf(tempText) < 0) {
					currentKeywords.push(tempText);
				}
			});
			$('.search-keyword').val(currentKeywords.join(', ')).change();
		});
	});
	drawLinkTable.draw = function()
	{
		for (var i = 0,j=links.length; i < j; i++) {
			$('.drawLinkTable tbody').append(drawLinkTable.link_row(i,links[i]));
		}
	}
	function addRow()
	{
		var key = links.length;
		links[key] = '';
		$('.drawLinkTable tbody').append(drawLinkTable.link_row(key,''));
	}
	function removeRow(key)
	{
		links.splice(key, 1);
		$('.drawLinkTable tbody tr[data-key='+key+']').remove();
	}
</script>
