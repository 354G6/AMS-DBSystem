<?php
	include_once 'Connect.php';

	function LeadSingerInsert($upc, $name){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("INSERT INTO LeadSinger VALUES ('$upc', '$name')") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	function LeadSingerDelete($upc, $name){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("DELETE FROM LeadSinger WHERE upc = '$upc' AND name = '$name'") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	// returns a 2d array containing data from the LeadSinger table
	function LeadSingerDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		$result = $sql->query("SELECT * FROM LeadSinger");
		if($result === FALSE){
			echo $sql->error;
		}
		$table = array();
		while($row = mysqli_fetch_assoc($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>