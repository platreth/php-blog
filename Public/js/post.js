$('#send_comment').click(function() {

	let comment = $('#replyFormComment').val();

	$.post('/post/comment/add/' + postid, {
		message : comment,
		id : postid
	}).done(function(data){
		var data = JSON.parse(data);
		if (data.code == 200) {

			$('#replyFormComment').val('');

		}

		   new Noty({
		    theme: 'sunset', 
		    type: data.type,
		    layout: 'topRight',
		    text: data.message,
		        animation: {
		        open: 'animated bounceInRight', 
		        close: 'animated bounceOutRight' 
		    }
		}).show();

	});

})