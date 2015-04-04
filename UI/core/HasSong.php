<?php
	include_once 'Connect.php';

	function HasSongInsert($upc, $title){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("INSERT INTO HasSong VALUES ('$upc', '$title')") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	function HasSongDelete($upc, $title){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("DELETE FROM HasSong WHERE upc = '$upc' AND title = '$title'") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	// returns a 2d array containing data from the HasSong table
	function HasSongDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		$result = $sql->query("SELECT * FROM HasSong");
		if($result === FALSE){
			echo $sql->error;
		}
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>