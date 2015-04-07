<?php
	include_once 'Connect.php';
	
	function ProcessDelivery($receiptid, $DeliveryDate){
		$result = 0;
		$sql = Connect();
		if($sql->connect_error){
			$result = $sql->connect_error;
		}
		$result = $sql->query("SELECT deliveredDate FROM `Order` WHERE receiptid = '$receiptid'");
		if($sql->error){
			$result = $sql->error;
		}
		if($result->num_rows !== 0){
			$row = $result->fetch_row();
			$result->close();
			$sql->query("UPDATE `Order` SET deliveredDate = '$DeliveryDate' WHERE receiptid = '$receiptid'");
			if($sql->error){
			$result = $sql->error;
			}else{
				$result = 0;
			}
		}else{
			//receiptid is not in Order table
			$result = "Receipt ID not found in table.";
		}
		return $result;
	}
?>
