y<?php
class BibleDAO {
	public static function getChapterNumbers($book_id) {
		global $db;
		$sql = "SELECT MAX(chapter_number) AS chapter_numbers
				FROM kjv_english
				WHERE book_id = {$book_id};";
		$result = $db->query($sql);
		if ($result) {
			$row = $result->fetch_assoc();
			return $row['chapter_numbers'];
		} else {
			return false;
		}
	}

	public static function getBibleName($book_id) {
		global $db;
		$sql = "SELECT book_name
				FROM books
				WHERE id = {book_id}";
		$result = $db->query($sql);
		if ($result) {
			$row = $result->fetch_assoc();
			return $row['book_name'];
		} else {
			return false;
		}
	}

	public static function getVerseNumbers($book_id, $chapter_id) {
		global $db;
		$sql = "SELECT MAX(verse_number) AS verse_numbers
				FROM kjv_english
				WHERE book_id = {$book_id}
					AND chapter_number = {$chapter_id};";
		$result = $db->query($sql);
		if ($result) {
			$row = $result->fetch_assoc();
			return $row['verse_numbers'];
		} else {
			return false;
		}
	}

	public static function getVerseText($book_id, $chapter_id, $verse_id) {
		global $db;
		$sql = "SELECT verse_text
				FROM kjv_english
				WHERE book_id = {$book_id}
					AND chapter_number = {$chapter_id}
					AND verse_number = {$verse_id};";
		$result = $db->query($sql);
		if ($result) {
			$row = $result->fetch_assoc();
			return $row['verse_text'];
		} else {
			return false;
		}
	}

	public static function getChapterText($book_id, $chapter_id) {
		global $db;
	}

	public static function search($keyword) {
		global $db;
	}

	public static function getBooks() {
		global $db;
		$sql = "SELECT id, book_name FROM books ORDER BY id";
		$result = $db->query($sql);
		if ($result->num_rows > 0) {
			$books = array();
			for ($i = 0; $i < $result->num_rows; $i++) {
				$row = $result->fetch_assoc();
				$books[$row['id']] = $row['book_name'];
			}
			$result->free();
			return $books;
		} else {
			return false;
		}
	}

	public static function getSearch($search){
        if(!empty($_POST["search"])){
            $sql = "SELECT * FROM kjv_english k Join books b 
                ON (k.book_id = b.id) 
                where verse_text LIKE '%".$_POST["search"]."%'";
            $query = mysql_query($sql);
            if(mysql_num_rows($query) > 0){
                while($row = mysql_fetch_assoc($query)){
                    ?>

                    <?=$row["book_name"];?>  <?php

                    echo $row["chapter_number"].":".$row["verse_number"]."<br>";?>
                    
                    <?=$row["verse_text"];?> 


                    <?php echo "<br><br>"?>
                    <?php
                }
            }else{
                echo "No Word or Phrase FOUND!";
            }
        }else{
           
        }
    }
}

    
