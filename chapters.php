<?php
include_once('config.php');
include_once('BibleDAO.php');

$book_id = (isset($_GET['book_id'])) ? $_GET['book_id']: false;

$chapters = BibleDAO::getChapterNumbers($book_id);
$bookname = BibleDAO::getBibleName($book_id);
$verses = BibleDAO::getVerseNumbers($book_id, $chapters);

if ($chapters == false) {
	echo json_encode(
			array(
				'status' => 'failed',
				'message' => 'Unable to get chapters'
			)
		);
} else {
	echo json_encode(
			array(
				'status' => 'success',
				'chapters' => $chapters,
				'bookname' => $bookname,
				'verses' => $verses
			)
		);
}