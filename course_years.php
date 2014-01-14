<?php
	$course = $_GET['courses'];
	$years = 0;

	if (in_array($course, array('abb','bsis','bsat'))) {
		$years = 4;
	} elseif (in_array($course, array('mct','cp','na','act'))) {
		$years = 2;
	} elseif ($course == 'bsa') {
		$years = 5;
	} elseif ($course == 'ic') {
		$years = 1;
	} else {
		$years = false;
	}


	if ($years !== false) {
		echo json_encode(
				array(
					'course' => $course,
					'result' => 'success',
					'years' => $years
					)
				);
	} else {
		echo json_encode(
				array(
					'course' => $course,
					'result' => 'failed'
					)
			);
	}
?>