<?php
	include_once 'Connect.php';

	function LeadSingerInsert($upc, $name){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("INSERT INTO LeadSinger VALUES ('$upc', '$name')") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function LeadSingerDelete($upc, $name){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("DELETE FROM LeadSinger WHERE upc = '$upc' AND name = '$name'") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function LeadSingerDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		$result = $sql->query("SELECT * FROM LeadSinger");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>