<?php
	include_once 'Connect.php';

	function ItemInsert($upc, $title, $type, $category, $company, $year, $price, $stock){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("INSERT INTO Item VALUES ('$upc', '$title', '$type', '$category', '$company', '$year', '$price', '$stock')") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	function ItemDelete($upc){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("DELETE FROM Item WHERE upc = '$upc'") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	// returns a 2d array containing data from the Item table
	function ItemDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		$result = $sql->query("SELECT * FROM Item");
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
	
	function AddItems($upc, $quantity){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		$result = $sql->query("SELECT stock FROM Item WHERE upc = '$upc'");
		if($result === FALSE){
			echo $sql->error;
		}
		if($result->num_rows !== 0){
			//only one element should ever be returned to $row
			$row = $result->fetch_row();
			$result->close();
			$sql->query("UPDATE Item SET stock = '$quantity' + '$row[0]' WHERE upc = '$upc'");
			if($result === FALSE){
				echo $sql->error;
			}
		}else{
			//item upc is not in Item table
			//check before function is called?
		}
		Close($sql);
	}
?>