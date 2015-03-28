<?php
	include 'Connect.php';

	function LeadSingerInsert($upc, $name){
		$sql = Connect();
		$sql->query("INSERT INTO LeadSinger VALUES ('$upc', '$name')");
		Close($sql);
	}
	
	function LeadSingerDelete($upc, $name){
		$sql = Connect();
		$sql->query("DELETE FROM LeadSinger WHERE upc = '$upc' AND name = '$name'");
		Close($sql);
	}
	
	function LeadSingerDisplay(){
		$sql = Connect();
		$result = $sql->query("SELECT * FROM LeadSinger");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>