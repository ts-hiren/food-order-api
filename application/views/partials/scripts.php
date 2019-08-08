<!-- Core JS files -->
<script src="<?= ADMIN_ASSET_URL ?>js/jquery.min.js"></script>
<script src="<?= ADMIN_ASSET_URL ?>js/bootstrap.bundle.min.js"></script>
<script src="<?= ADMIN_ASSET_URL ?>js/loaders/blockui.min.js"></script>
<script src="<?= ADMIN_ASSET_URL ?>js/uniform.min.js"></script>
<script src="<?= ADMIN_ASSET_URL ?>js/form/tokenfield.min.js"></script>
<!-- /core JS files -->
<script src="<?= ADMIN_ASSET_URL ?>js/notifications/noty.min.js"></script>
<script src="<?= ADMIN_ASSET_URL ?>js\form\switchery.min.js"></script>
<script src="<?= ADMIN_ASSET_URL ?>js/notifications/sweet_alert.min.js"></script>
<!-- Theme JS files -->
<script src="<?= ADMIN_ASSET_URL ?>/js/datatables/datatables.min.js"></script>
<script src="<?= ADMIN_ASSET_URL ?>js/app.js"></script>
<!-- /theme JS files -->	
<script type="text/javascript">
	var invalid_form = true;
	var option_push = '';
	function alertNotification(msg,type) {
		if (typeof Noty == 'undefined') {
		    console.warn('Warning - noty.min.js is not loaded.');
		    return;
		}
		// Override Noty defaults
		Noty.overrideDefaults({
		    theme: 'limitless',
		    layout: 'topRight',
		    type: 'alert',
		    timeout: 2500
		});
		new Noty({
		    text: msg,
		    type: type
		}).show();
	}
	var openModal = function(title,url,size,selectElem = '')
	{
		$('#naruto_modal .modal-title').html(title);
		$('#naruto_modal .modal-dialog').removeClass().addClass('modal-dialog modal-'+size);
		var modalBody = $('#naruto_modal .modal-body');
		$('#naruto_modal').modal('show');
		$(modalBody).block({ 
            message: '<i class="icon-spinner9 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
            	width: 16,
                border: 0,
                padding: 0,
                backgroundColor: 'transparent'
            }
        });
		$.ajax({
			url:url,
			type:'get',
			success:function(d){
				$('.blockOverlay').on('click', function() {
		        	$(modalBody).unblock();
		        });
				$(modalBody).html(d);
				option_push = selectElem;
				$('.custom-file-upload').uniform({fileButtonClass: 'action btn bg-teal-400'});
				$('.keyword-input').tokenfield();
			}
		});
	}
	$(document).ready(function(){
		var url = window.location.href.replace(/\/\d+$/, "");
		$('a[href$="'+url+'"]').addClass('active');
		$('a.nav-link.active').parents('.nav-item').addClass('nav-item-open');
		$('a.nav-link.active').parents('.nav-group-sub').show();
		$('body').on('submit','.ajax-action-form',function(e){
			e.preventDefault();
			if (invalid_form) {
				alertNotification('Invalid Data to Proceed!','warning');
				return false;
			}
			var action_url = $(this).data('action');
			var form = new FormData(this);
			$.ajax({
				url: action_url,
				method: 'post',
				contentType: false,
				processData: false,
				data: form,
				dataType: 'json',
				success: function(a){
					if (a.status == 'success') {
						alertNotification(a.msg,'success');
						if (option_push != '') {
							$(option_push).append(new Option(a.data.value,a.data.id));
						}else{
							tbl.ajax.reload( null, false );
						}
						option_push = '';
						$('#naruto_modal .modal-body').html('');
						$('#naruto_modal').modal('hide');
					}else{
						alertNotification(a.msg,'error');
					}
				}
			});
		});
	});
</script>