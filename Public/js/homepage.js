new WOW().init();

  function validateForm() {
	formData = {
		'name'     : $('input[name=name]').val(),
		'email'    : $('input[name=email]').val(),
		'subject'  : $('input[name=subject]').val(),
		'message'  : $('textarea[name=message]').val()
	};


	$.ajax({
		url : "mail",
		type: "POST",
		data : formData,
			success: function(data, textStatus, jqXHR)
			{
				if (data.code == 'success') {
					//If mail was sent successfully, reset the form.
					$('#contact-form').closest('form').find("input[type=text], textarea").val("");
				}

				 new Noty({
				        theme: 'sunset', 
				        type: data.code,
				        layout: 'topRight',
				        text: data.message,
				            animation: {
				            open: 'animated bounceInRight', // Animate.css class names
				            close: 'animated bounceOutRight' // Animate.css class names
				        }
				    }).show();

			},

			error: function (jqXHR, textStatus, errorThrown)
			{
				$('#status').text(jqXHR);
			}
	});

  }
