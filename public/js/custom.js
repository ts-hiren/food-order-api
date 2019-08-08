var offset = [];
offset[0] = 0;
var cmt_get_flag = 0;
var cmt_post_flag = 0;
function commentAction(c_id,act,p_id=0){
	if (act =='reply') {

	}else{

	}
}
function forceLogin() {
	$('#loginModal').modal('show');
}

function loadComments(book_id,parent_id = 0) {
	if (cmt_get_flag) {
		return;
	}
	cmt_get_flag = 1;
	$('ul.load__comment .last-removable').remove();
	$.ajax({
		url: base_url('comments'),
		type: 'get',
		data: {book:book_id,offset:offset[parent_id],parent:parent_id},
		dataType: 'json',
		success: function(response){
			if (offset[parent_id]==0) {
				$('ul.load__comment li').remove();
			}
			$('ul.load__comment').append(response.content);
			cmt_get_flag = 0;
			offset[parent_id] =  response.offset;
		}
	});
}