 $(document).ready(function(){
 	function_Ako("Booksearch");
	var typingTimer;
	var doneTypingInterval = 1000;
		$("#name").keyup(function(){
			clearTimeout(typingTimer);
			typingTimer = setTimeout(
			function(){
				function_Ako("Booksearch");},
				doneTypingInterval
				);
		});
		
	function function_Ako(variable_Ako){
		var query = $("#name").val();
		var params = "search="+query;
		var url_ako = variable_Ako+".php";
		$.ajax({
			type: 'POST',
			url: url_ako,
			dataType: 'html',
			data: params,
			beforeSend: function(){
				$("#output").html("Searching");
			},
			
			success: function(dt){
				$("#output").html(dt);
			}
		});
	}

 });