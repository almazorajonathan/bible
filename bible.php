<link rel="stylesheet" href="assets/css/global.css" type="text/css">
<link rel='stylesheet' href='assets/css/own.css' type='text/css'>


<?php
include_once('config.php');
include_once('BibleDAO.php');

$books = BibleDAO::getBooks();
$defaultChapters = BibleDAO::getChapterNumbers(1);
$defaultVerses = BibleDAO::getVerseNumbers(1, 1);
$defaultVerseText = BibleDAO::getVerseText(1, 1, 1);
?>

<body background='bible/forest1.png'>
<!-- Navigation -->
		<div class='navbar navbar-fixed-top'>
			<div class='navbar-inner'>
				<div class='container'><font face = 'tahoma'>
				  <a href='StudentRoom.html' class='brand'><strong>Bible App</strong></a>
				    <ul class='nav pull-right'>
					  <form action class='navbar-search pull-left'>
					  	<a href='#myModal' data-toggle='modal'	class='btn' style='margin-top:1px'><span class='icon-search'></span></a>
					  </form>
					</ul>
				</div>
			</div>
		</div>


<!--content-->
<div class='container'style='margin-top:70px'>
  <div class='row'>
  		<font size='5' color='white'><b>Books</b></font>
		<font size='5' color='white' style='margin-left:148px'><b>Chapters</b></font>
		<font size='5' color='white' style='margin-left:113px'><b>Verses</b></font>
  </div>

  <div class='row'>
  		<select name="books" id="books">
		<?php foreach($books as $id => $book): ?>
		<option value="<?= $id ?>"><?= $book ?></option>
		<?php endforeach ?>
		</select>

		<select name="chapters" id="chapters">
		<?php for($i = 1; $i <= $defaultChapters; $i++): ?>
		<option value="<?= $i ?>"><?= $i ?></option>
		<?php endfor ?>
		</select>

		<select name="verses" id="verses">
		<?php for($i = 1; $i <= $defaultVerses; $i++): ?>
		<option value="<?= $i ?>"><?= $i ?></option>
		<?php endfor ?>
		</select>

  </div>
</div>

<div class='well' id='content1'style='width:860px;height:430px;margin-left:230px;margin-top:50px;opacity:0.6;filter:alpha(opacity=60);color:#000000;font-size:20px'>
	<div id='bibleverse'>

	</div>

	<div id="verse_text" style='margin-top:170px;line-height:30px;font-size:30px'>
		<?= $defaultVerseText ?>
	</div>
</div>

	<!--modal-->
			  <div class='modal hide fade' id='myModal' aria-hidden='true'>
			    <div class='modal-header'>
				  <div class='row' >
				    <div>
				      <h1>Searching for </h1>
				    </div>
				  </div>
				</div>
				
				<div class='modal-body'>
				  <div class='well' style='background:#E5E4E2'>
					  <div>
					    <input type='text' id='name' name='search'placeholder='Search' class='search-query span2' style='height:27px;margin-top:-4px;width:200px'>
					  </div>

					  <div id='output'>
					  	
					  </div>
				  </div>
				</div>
				
				<div class='modal-footer'>
				  <button class='btn btn-default' data-dismiss='modal' aria-hidden='true'>Close</button>
				</div>
			  </div>
	<!--modal-->

</body>


<script src="assets/js/jquery-1.7.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/admin.min.js"></script>
<script src='search.js'></script>


<script type="text/javascript">
$(document).ready(function() {
	function getVerseText(bid, cid, vid) {
		var book = bid;
		var chapter = cid;
		var verse = vid;
		$.ajax({
			url: 'versetext.php',
			data: {book_id: bid, chapter_id: cid, verse_id: vid},
			dataType: 'JSON',
			method: 'GET',
			success: function(response) {
				$('#verse_text').html(response.verse_text);
			}
		});
	}

	$('#books').on('change', function() {
		var bid = $(this).val();
		$.ajax({
			url: 'chapters.php',
			data: {book_id: bid},
			dataType: 'JSON',
			method: 'GET',
			success: function(response) {
				var str = '';
				var str1 = '';
				for(i = 1; i <= response.chapters; i++) {
					str += '<option value=' + i + '>' + i + '</option>';
				}

				for(i = 1; i <= response.verses; i++) {
					str1 += '<option value=' + i + '>' + i + '</option>';
				}
				$('#chapters').html(str);
				$('#verses').html(str1);
				$('#bibleverse').html(response.bookname);
				getVerseText(bid, 1, 1);
			},
			error: function(err) {
				alert('NONO');
			}
		});
	});

	$('#chapters').on('change', function() {
		var bid = $('#books').val();
		var cid = $(this).val();
		$.ajax({
			url: 'verses.php',
			data: {book_id: bid, chapter_id: cid},
			dataType: 'JSON',
			method: 'GET',
			success: function(response) {
				var str = '';
				for(i = 1; i <= response.verses; i++) {
					str += '<option value=' + i + '>' + i + '</option>';
				}
				$('#verses').html(str);
				getVerseText(bid, cid, 1);
			},
			error: function(err) {
				alert('NONO');
			}
		});
	});

	$('#verses').on('change', function() {
		var bid = $('#books').val();
		var cid = $('#chapters').val();
		var vid = $(this).val();
		getVerseText(bid, cid, vid);
	});
});
</script>