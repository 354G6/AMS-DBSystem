<?php
	include_once 'Connect.php';
	include_once 'Order.php';
	include_once 'PurchaseItem.php';
	

	
	//search for item by category, title and/or leadingSinger.
	//return array of upcs and their stock (quantity left in store)
	function itemSearch($category, $title, $leadingSinger) {
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		
		$criteria="I.category='".$category."' AND I.title='".$title."' AND L.name='".$leadingSinger."'";
        $emptyCriteria=array("I.category='' AND ","I.title='' AND ","AND L.name=''","L.name=''");
		$criteria = str_replace($emptyCriteria,"",$criteria);
		if (strpos($criteria,'category') !== false 
			or strpos($criteria,'title') !== false 
			or strpos($criteria,'leadingSinger') !== false) {
			$criteria="AND ".$criteria;
		} else {
			$criteria="";
		}
		
        $result = $sql->query("SELECT I.upc, I.title, I.price, I.stock FROM Item I, LeadSinger L WHERE I.upc = L.upc ".$criteria);
		$table = array();
		while($row = mysqli_fetch_assoc($result)) {
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
	
    //shoppingCart is an array of upc?
	function itemPurchase($shoppingCart, $leadingSinger, $quantity, $cardNum, $expiryDate ) {
		define("MAX_DAILY_DELIVERY", 10);
		$itemRecords = itemSearch($category, $title, $leadingSinger);
		if ($itemRecords===1) {
			return 1;
		}
		$expiryDate = date('YYYY-MM-DD', strtotime($expiryDate));//mysql date
		$todayDate = date('Y-m-d H:i:s'); //mysql datetime
		$numMatch=count($itemRecords);
		if ($numMatch==1 && $itemRecords[0][2]>0){
			$sql = Connect();
			if ($sql->connect_error) {
				return 1;
			}
			
			//insert tuple in PurchaseItem table
			if($sql->query("INSERT INTO PurchaseItem (upc, quantity) VALUES ('$itemRecords[0][0]', '$quantity')") === FALSE){
				return 2;
			}
			
			//update inventory
			if($sql->query("UPDATE Item SET stock=stock-1 WHERE upc='$itemRecords[0][0]'") === FALSE){
				return 2;
			}
			
			//estimate Delivery Date
			if($countOrder = $sql->query("SELECT COUNT(receiptId) FROM Order WHERE deliveredDate=NULL") === FALSE){
				return 2;
			}
			$outstandingOrders = (int) mysql_fetch_row($countOrder);
			$days = (int) ($outstandingOrders/MAX_DAILY_DELIVERY)+1;
			$expectedDate = date('YYYY-MM-DD', strtotime("+".$days." days", strtotime($todayDate)));
			
			//insert tuple in Order table
			if($sql->query("INSERT INTO Order (date, cid, cardNum, expiryDate, expectedDate) VALUES ('$todayDate', '$cid', '$cardNum', '$expiryDate', '$expectedDate')") === FALSE){
				return 2;
			}
			Close($sql);
		}
		elseif ($numMatch<1) return 3; //meaning no item matches the criteria
		elseif ($numMatch>1) return $itemRecords; //meaning more than one item matches the criteria
		elseif ($numMatch==1 && $itemRecords[0][2]<=0) return 4; //item out of stock
		else return null;
	}
	
