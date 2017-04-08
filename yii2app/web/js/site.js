$(document).on('ready pjax:success', function () {
	$('.ajaxWrite').on('click', function (e) {
		e.preventDefault();
		var writeUrl = $(this).attr('write-url');
		var pjaxContainer = $(this).attr('pjax-container');
		$.ajax({
			url: writeUrl,
			type: 'post',
			error: function (xhr, status, error) {
				alert('There was an error with your request.' + xhr.responseText);
			}
		}).done(
			function (data) {
				$.pjax.reload({
					container: '#' + $.trim(pjaxContainer), 
					type: 'post',
					data: JSON.parse(postData)
				});
		});
	});
});


/*$(document).ready(function() {

	$(document).on('click', '.new-reception', function(event){
		event.preventDefault();

		return false;

        newTask = true;
        $('#task-type').text('Новое задание');
        var modalContainer = $('#task-edit');
        var modalBody = modalContainer.find('.modal-body');
        modalContainer.modal({show:true});		
	});

});*/