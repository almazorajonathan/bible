<html>
<link rel="stylesheet" href="assets/css/global.css" type="text/css">
<link rel='stylesheet' href='assets/css/own.css' type='text/css'>

	<body>
		Courses:
		<select id='courses'>
			<option id='abb'>Ab Broadcasting</option>
			<option id='mct'>Mass Communication</option>
			<option id='na'>Nursing Assistant</option>
			<option id='ic'>Internation Cookery</option>
			<option id='cp'>Computer Programming</option>
			<option id='om'>Office Management</option>
			<option id='bsa'>BS Accountancy</option>
			<option id='bsat'>BS Accounting Technology</option>
			<option id='bsis'>BS Information System</option>
			<option id='act'>Associate in Computer Technology</option>
		</select>

		Year:
		<select id='years'>
			<option id='1'>1</option>
			<option id='2'>2</option>
			<option id='3'>3</option>
			<option id='4'>4</option>
		</select>


<script src="assets/js/jquery-1.7.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/admin.min.js"></script>
<script  type='text/javascript'>
	$(document).ready(function(){
		var course = $('#courses').val();
		$('#courses').on('change' , function(){
			course = $('#courses').val();
			$.ajax({
				url: 'course_years.php',
				data: {course: course},
				dataType: 'JSON',
				method: 'GET',
				success: function(response) {
					var years = response.years;
					var str = '';
					for (i = 1; i <= years; i++) {
						str += '<option value="' . + i + '">';
						str += i;
						str += '</option';
					}

					$('#years').html(str);
				}
			});
		});
	});
</script>

	</body>

</html>