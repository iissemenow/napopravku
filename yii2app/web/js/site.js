$(document).on('ready pjax:success', function () {

	var pjaxOn = false;

	if (typeof postData !== "undefined") $('.ajaxWrite').on('click', function (e) {
		e.preventDefault();
		var writeUrl = $(this).attr('write-url');
		var pjaxContainer = $(this).attr('pjax-container');
		$.ajax({
			url: writeUrl,
			type: 'post',
			dataType: 'text',
			error: function (xhr, status, error) {
				alert('Ошибка запроса.' + xhr.responseText);
			}
		}).done(
			function (data) {
				$.pjax.reload({
					container: '#' + $.trim(pjaxContainer), 
					type: 'post',
					data: JSON.parse(postData)
				});
				if (!data) alert('Извините, это время уже занято!');
		});
	});

	if (typeof firstScript === "undefined") {
		window.firstScript = 1;
		
		function checkAjax() {
			$.ajax({
				url: location.origin + '/admin/check?date=' + receptionDate,
				type: 'get',
				async: true,
				dataType: 'json',
				//date: {date: receptionDate},
				success: function(data) {
					if (data.res) {
						pjaxOn = true;
					}
				}
			});
		}

		if (typeof postData !== "undefined") setInterval(checkAjax, 1000);

		if (typeof postData !== "undefined") setInterval(function() {
			if (pjaxOn) {
				pjaxOn = false;
				$.pjax.reload({
					container: '#' + $.trim('pjax-act'), 
					type: 'post',
					data: JSON.parse(postData)
				});
			}
		}, 3000);
	}


});