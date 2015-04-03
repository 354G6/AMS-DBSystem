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
	
	function AddItems($upc, $quantity){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		$result = $sql->query("SELECT stock FROM Item WHERE upc = '$upc'");
		if($result->num_rows !== 0){
			//only one element should ever be returned to $row
			$row = $result->fetch_row();
			$result->close();
			$sql->query("UPDATE Item SET stock = '$quantity' + '$row[0]' WHERE upc = '$upc'");
		}else{
			//item upc is not in Item table
			return 2;
		}
		Close($sql);
		return 0;
	}
?>