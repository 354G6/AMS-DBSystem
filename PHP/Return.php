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
	function ProcessReturn($ReturnRecID, $ReturnUPC, $ReturnQ, $CurrDate){
		$sql=Connect();
		if($sql->connect_error){
			return 1;
		}
           // Which comparison sign whould be used: <> , !==
		$validRecID = $sql->query(" SELECT receiptId
					    FROM PurchaseItem
					    WHERE receiptId='$ReturnRecID'")
		if($validRecID<>$ReturnRecID){ return 9999 }  //should pop out "Receipt ID is invalid" in webpage

		$validDate = $sql->query(" SELECT receiptId
					   FROM Order
				           WHERE receiptId='$ReturnRecID' AND $CurrDate<expiryDate")
		if($validRecID<>$ReturnRecID){ return 8888 } //should pop out "Purcahsed iems is beyond retrunable date" in webpage

		$validUPC = $sql->query("SELECT upc
					 FROM PurchaseItem
				         WHERE receiptId='$ReturnRecID' AND upc='$ReturnUPC'")
		if($validUPC<>$ReturnUPC){ return 7777 } //should pop out "Did not purchase the given item" in webpage

		$validReQ = $sql->query("SELECT quantity
					 FROM PurchaseItem
				         WHERE receiptId='$ReturnRecID' AND upc='$ReturnUPC' AND $ReturnQ<=quantity")
		if($validReQC<>$ReturnQ){ return 6666 } //should pop out "The quantity is not valid" in webpage
		
		
		return 5555; //Item return completed.
	}
?>
