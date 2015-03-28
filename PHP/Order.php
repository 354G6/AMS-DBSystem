<?php
	include 'Connect.php';

	function OrderInsert($receiptId, $date, $cid, $cardNum, $expiryDate, $expectedDate, $deliveredDate){
		$sql = Connect();
		$sql->query("INSERT INTO [Order] VALUES ('$receiptId', '$date', '$cid', '$cardNum', '$expiryDate', '$expectedDate', '$deliveredDate')");
		Close($sql);
	}
	
	function OrderDelete($receiptId, $cid){
		$sql = Connect();
		$sql->query("DELETE FROM [Order] WHERE receiptId = '$receiptId' AND cid = '$cid'");
		Close($sql);
	}
	
	function OrderDisplay(){
		$sql = Connect();
		$result = $sql->query("SELECT * FROM [Order]");
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
?>