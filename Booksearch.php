<?php 
	include_once('BibleDAO.php');
	include_once('config.php');

	$search = $_POST['search'];
	
	BibleDAO::getSearch($search);
	
 ?>