<?php
	include_once 'Connect.php';

	function HasSongInsert($upc, $title){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("INSERT INTO HasSong VALUES ('$upc', '$title')") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function HasSongDelete($upc, $title){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("DELETE FROM HasSong WHERE upc = '$upc' AND title = '$title'") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function HasSongDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		$result = $sql->query("SELECT * FROM HasSong");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>