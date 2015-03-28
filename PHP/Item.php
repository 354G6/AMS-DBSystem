<?php
	include 'Connect.php';

	function ItemInsert($upc, $title, $type, $category, $company, $year, $price, $stock){
		$sql = Connect();
		$sql->query("INSERT INTO Item VALUES ('$upc', '$title', '$type', '$category', '$company', '$year', '$price', '$stock')");
		Close($sql);
	}
	
	function ItemDelete($upc){
		$sql = Connect();
		$sql->query("DELETE FROM Item WHERE upc = '$upc'");
		Close($sql);
	}
	
	function ItemDisplay(){
		$sql = Connect();
		$result = $sql->query("SELECT * FROM Item");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>