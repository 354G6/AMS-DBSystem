<?php
	include_once 'Connect.php';
	
	function Delivery($receiptid, $DeliveryDate){
	  $sql = Connect();
	  if($sql->connect_error){
	    return 1;
	  }
	  $result = $sql->query("SELECT deliveredDate FROM Order WHERE receiptid = '$receiptid'");
	  
	  if($result->num_rows !== 0){
			$row = $result->fetch_row();
			$result->close();
			$sql->query("UPDATE Order SET deliveredDate = '$DeliveryDate' + '$row[6]' WHERE receiptid = '$receiptid'");
		    return 0;
      }else{
			//receiptid is not in Order table
			return 2;
		}
	  
	}
?>
