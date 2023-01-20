$(document).ready(function() {
		//alert('working');
		var appUrl = 'http://localhost/agregator/';
		var id = $('input[name=user_id]').val();
		var CSRF_TOKEN = $('input[name=_token]').val();
    	var ajax = 1
		$('.edit').click(function(){
			//alert('edit');
			var field = $(this).data('id');
			var mode = $(this).data('mode');
			if(mode=='view') {
				$(this).html('SAVE');
				$('#'+field+' span').css('display', 'none');
				$('#'+field+' div').css('display', 'inline-block');
				$(this).data('mode', 'edit');
			}
			if(mode=='edit')
			{
				$(this).html('EDIT');
				var value = $('#'+field+' div input').val();
				$('#'+field+' span').html(value);
				$('#'+field+' span').css('display', 'inline-block');
				$('#'+field+' div').css('display', 'none');
				$(this).data('mode', 'view');

				var ajaxUrl = appUrl+"edit_profile_field";

				$.ajax({
					url:ajaxUrl, 
					data:{id: id, field: field, value: value,  _token: CSRF_TOKEN, ajax: ajax}, 
					type: "post", 
					async: false, 
					error: function(xhr, textStatus, errorThrown) {
			  			console.log(xhr.responseText);
						//alert(xhr.responseText);
					},
					success: function(data) { 
						//alert(data);
						if(data != 1) {
							$('#'+field+' span').prepend('<i class="alert-danger">Sorry! editing failed</i>');
						}
					}
				})//ajax ends here
			}
			//alert('Field: '+field+' Mode: '+mode);
		})
	})