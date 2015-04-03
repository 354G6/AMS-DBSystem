<?php
	include_once 'Connect.php';

	function ReturnInsert($retid, $date, $receiptId){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("INSERT INTO `Return` VALUES ('$retid', '$date', '$receiptId')") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function ReturnDelete($retid){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("DELETE FROM `Return` WHERE retid = '$retid'") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function ReturnDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		$result = $sql->query("SELECT * FROM `Return`");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>