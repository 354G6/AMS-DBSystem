<?php
	include_once 'Connect.php';

	function ItemInsert($upc, $title, $type, $category, $company, $year, $price, $stock){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("INSERT INTO Item VALUES ('$upc', '$title', '$type', '$category', '$company', '$year', '$price', '$stock')") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function ItemDelete($upc){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("DELETE FROM Item WHERE upc = '$upc'") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function ItemDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		$result = $sql->query("SELECT * FROM Item");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>