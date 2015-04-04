<?php
	include_once 'Connect.php';
	include_once 'ReturnItem.php';

	// returns an auto_increment id from insert
	function ReturnInsert($date, $receiptId){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("INSERT INTO `Return` VALUES (NULL, '$date', '$receiptId')") === FALSE){
			echo $sql->error;
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
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
	function ProcessReturn($ReturnRecID, $ReturnUPC, $ReturnQ, $CurrDate){
		$sql=Connect();
		if($sql->connect_error){
			echo $sql->connect_error;
		}
           // Which comparison sign should be used: <> , !==
		$validRecID = $sql->query(" SELECT receiptId
					    FROM PurchaseItem
					    WHERE receiptId='$ReturnRecID'");
		if($validRecID<>$ReturnRecID){ return 9999; }  //should pop out "Receipt ID is invalid" in webpage

		$validDate = $sql->query(" SELECT receiptId
					   FROM Order
				           WHERE receiptId='$ReturnRecID' AND $CurrDate<expiryDate");
		if($validRecID<>$ReturnRecID){ return 8888; } //should pop out "Purcahsed iems is beyond retrunable date" in webpage

		$validUPC = $sql->query("SELECT upc
					 FROM PurchaseItem
				         WHERE receiptId='$ReturnRecID' AND upc='$ReturnUPC'");
		if($validUPC<>$ReturnUPC){ return 7777; } //should pop out "Did not purchase the given item" in webpage

		$validReQ = $sql->query("SELECT quantity
					 FROM PurchaseItem
				         WHERE receiptId='$ReturnRecID' AND upc='$ReturnUPC' AND $ReturnQ<=quantity");
		if($validReQC<>$ReturnQ){ return 6666; } //should pop out "The quantity is not valid" in webpage
		
		//should return last auto_incremented id and pass to ReturnItemInsert as associated retid
		$lastId = ReturnInsert($CurrDate, $ReturnRecID); //
		ReturnItemInsert($lastId, $ReturnUPC, $ReturnQ);

		Close($sql);
	}
?>
