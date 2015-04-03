<?php
	include_once 'Connect.php';

	function OrderInsert($receiptId, $date, $cid, $cardNum, $expiryDate, $expectedDate, $deliveredDate){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("INSERT INTO `Order` VALUES ('$receiptId', '$date', '$cid', '$cardNum', '$expiryDate', '$expectedDate', '$deliveredDate')") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function OrderDelete($receiptId, $cid){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("DELETE FROM `Order` WHERE receiptId = '$receiptId' AND cid = '$cid'") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function OrderDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		$result = $sql->query("SELECT * FROM `Order`");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>