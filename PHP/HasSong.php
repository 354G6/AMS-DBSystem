<?php
	include 'Connect.php';

	function HasSongInsert($upc, $title){
		$sql = Connect();
		$sql->query("INSERT INTO HasSong VALUES ('$upc', '$title')");
		Close($sql);
	}
	
	function HasSongDelete($upc, $title){
		$sql = Connect();
		$sql->query("DELETE FROM HasSong WHERE upc = '$upc' AND title = '$title'");
		Close($sql);
	}
	
	function HasSongDisplay(){
		$sql = Connect();
		$result = $sql->query("SELECT * FROM HasSong");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>