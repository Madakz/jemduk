 // For Autosuggestion
$(document).ready(function(){
	$("#search-box").keyup(function(){
		$.ajax({
		type: "POST",
		url: '/autosuggest',
		data:{keyword:$(this).val(),
				 category: $('#category').val()
				},
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(/clientviews/images/loader64.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			// $("#suggesstion-box").css("background","#000");
			$("#search-box").css("background","#FFF");
		}
		});
	});
});

function selectProperty(val) {
	$("#search-box").val(val);
	$("#suggesstion-box").hide();
}
