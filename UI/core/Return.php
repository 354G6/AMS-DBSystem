<?php
	include_once 'Connect.php';
	include_once 'ReturnItem.php';

	// returns an auto_increment id from insert
	function ReturnInsert($date, $receiptId){
		$sql = Connect();
		if ($sql->connect_error) {
			$r = $sql->connect_error;
		}
		if($sql->query("INSERT INTO `Return` VALUES (NULL, '$date', '$receiptId')") === FALSE){
			$r = $sql->error;
		}else{
			$r = $sql->insert_id;
		}
		Close($sql);
		return $r;
	}
	
	function ReturnDelete($retid){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("DELETE FROM `Return` WHERE retid = '$retid'") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	// returns a 2d array containing data from the Return table
	function ReturnDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		$result = $sql->query("SELECT * FROM `Return`");
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
	function ProcessReturn($ReturnRecID, $ReturnUPC, $ReturnQ){
		$sql=Connect();
		if($sql->connect_error){
			return $sql->connect_error;
		}
        
		//get expirydate, quantity and warehouse stock for user specified item
		$result = $sql->query("SELECT `Order`.expiryDate, PurchaseItem.quantity, Item.stock 
							   FROM PurchaseItem
							   INNER JOIN `Order`
							   ON `Order`.receiptId = PurchaseItem.receiptId
							   INNER JOIN Item
							   ON Item.upc = PurchaseItem.upc
							   WHERE PurchaseItem.receiptId = '$ReturnRecID'
							   AND PurchaseItem.upc = '$ReturnUPC'");
		if($sql->error){
			return $sql->error;
		}
		
		//if such an item was purchased compare dates and quantity that was bought
		if($result->num_rows > 0){
			$row = mysqli_fetch_assoc($result);
			$expiryDate = strtotime($row["expiryDate"]);
			$today = strtotime(date("Y-m-d H:i:s"));
			
			if($today < $expiryDate){//check date
				if($ReturnQ < $row["quantity"]){//check quantity
					$oldStock = $row["stock"];
					//increase stock for warehouse
					if($sql->query("UPDATE Item SET stock = '$ReturnQ' + '$oldStock' WHERE Item.upc = '$ReturnUPC'") === FALSE){
						$result = $sql->error;
					}else{
						//should return last auto_incremented id and pass to ReturnItemInsert as associated retid
						$today = date("Y-m-d H:i:s");
						$lastId = ReturnInsert($today, $ReturnRecID);
						$result = ReturnItemInsert($lastId, $ReturnUPC, $ReturnQ);
					}
				}else{
					$result = "Invalid quantity.";
				}
			}else{
				$result = "Deadline to return item has passed.";
			}
		}else{
			$result = "No item with that UPC and receiptId was purchased.";
		}

		Close($sql);
		return $result;
	}
?>
