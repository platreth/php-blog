
function getPostAjax(startpost) {

	$.ajax({
			url : "blog/ajax",
			type: "POST",
			data : {start : startpost},
				success: function(data, textStatus, jqXHR)
				{
					console.log(data);


				}
	});
}