<?php
	include 'Connect.php';

	function ReturnInsert($retid, $date, $receiptId){
		$sql = Connect();
		$sql->query("INSERT INTO [Return] VALUES ('$retid', '$date', '$receiptId')");
		Close($sql);
	}
	
	function ReturnDelete($retid){
		$sql = Connect();
		$sql->query("DELETE FROM [Return] WHERE retid = '$retid'");
		Close($sql);
	}
	
	function ReturnDisplay(){
		$sql = Connect();
		$result = $sql->query("SELECT * FROM [Return]");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>