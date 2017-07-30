 // For Autosuggestion
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: 'http://127.0.0.1:8000/',
		data:{keyword:$(this).val(),
				 categoey: $('#category').val()
				},
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(/clientviews/images/loader64.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function selectProperty(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}
