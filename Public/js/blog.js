
function getPostAjax(startpost) {

	$.ajax({
			url : "blog/ajax",
			type: "POST",
			data : {start : startpost},
				success: function(data, textStatus, jqXHR)
				{
					var data = JSON.parse(data);
					for(let i=0; i<data.length; i++) {
						var article = data[i];
						var html = "<div class=\"col-lg-4 col-md-12 mb-4 0to9\">";
						html += '<a href="/post/show/' + article.id + ' ">' +
							"<div class=\"card\">";
						html += "<div class=\"view overlay\">" +
							"<div class=\"embed-responsive embed-responsive-16by9 rounded-top\">" +
							'<img class="embed-responsive-item" src="' + article.image  + '" ></img>' +
							"</div>" +
							"</div>";
						html += "<div class=\"card-body\">" +
							"<h4 class=\"card-title\"> " + article.title + " </h4>" +
							"<p class=\"card-text\">" +
							" "+ article.subtitle +" " +
							"</p>\n" +
							"<p class=\"card-text\">" +
							"<strong> " + article.name + " " +  article.firstname + "</strong>" +
							"</p>" +
							"<p class=\"card-text\"> " + article.created_date + "</p>" +
							"</div>" +
							"</div>" +
							"</a>" +
							"</div>";

						$('.post-ajax').append(html);

					}
					$('.loadMore').remove();
					if (data.length == 9) {
						var nbArticle = $(".0to9").length;
						$('.post-ajax').append("<div class='loadMore text-center w-100' ><button class='btn btn-md btn-elegant' onclick='getPostAjax("+ nbArticle +")'>Voir + </button></div>")

					}
				}

	});
}


function getComment(startComment) {

	$.ajax({
		url : window.location.protocol + "//" + window.location.hostname + "/comment/ajax",
		type: "POST",
		data : {start : startComment, id : postid},
		success: function(data, textStatus, jqXHR)
		{
			var data = JSON.parse(data);
			console.log(data);
			for(let i=0; i<data.length; i++) {
				var comment = data[i];
				var html = " <div class=\"card-body 0to5\">" +
					" <div class=\"media d-block d-md-flex mt-3\">" +
					'<img class="d-flex mb-3 mx-auto" src="../../' + comment.image + '" alt="'+ comment.name +'">' +
					"<div class=\"media-body text-center text-md-left ml-md-3 ml-0\">" +
					"<h5 class=\"mt-0 font-weight-bold\"> " + comment.name + " " + comment.firstname + "" +
					"</h5>" +
					comment.content +
					"</div>" +
					"<p> " + comment.created_date  + "</p>" +
					"</div>" +
					"</div>";

				$('.comment-ajax').append(html);

			}
			$('.loadMore').remove();
			var nbComment = $(".0to5").length;
			if (nbComment < compteur) {
				console.log(nbComment);
				$('.comment-ajax').append("<div class='loadMore text-center w-100' ><button class='btn btn-md btn-elegant' onclick='getComment("+ nbComment +")'>Voir + </button></div>")

			}
		}

	});
}