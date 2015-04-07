<?php
	include_once 'Connect.php';

	function OrderInsert($receiptId, $date, $cid, $cardNum, $expiryDate, $expectedDate, $deliveredDate){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("INSERT INTO `Order` VALUES ('$receiptId', '$date', '$cid', '$cardNum', '$expiryDate', '$expectedDate', '$deliveredDate')") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	function OrderDelete($receiptId, $cid){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("DELETE FROM `Order` WHERE receiptId = '$receiptId' AND cid = '$cid'") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	// returns a 2d array containing data from the Order table
	function OrderDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		$result = $sql->query("SELECT * FROM `Order`");
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