<?php
	include_once 'Connect.php';
	include_once 'Order.php';
	include_once 'PurchaseItem.php';
	
	function itemSearch($category, $title, $leadingSinger) {
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		
		$criteria="category='"+$category+"' AND title='"+$title+"' AND leadingSinger='"+$leadingSinger+"'";
		$emptyCriteria=array("category='' AND ","title='' AND ","AND leadingSinger=''","leadingSinger=''");
		str_replace($emptyCriteria,"",$criteria);
		if (strpos($criteria,'category') !== false 
			or strpos($criteria,'title') !== false 
			or strpos($criteria,'leadingSinger') !== false) {
			$criteria="WHERE "+$criteria;
		} else {
			$criteria="";
		}
		
		$result = $sql->query("SELECT upc FROM Item "+$criteria);
		$table = array();
		while($row = mysqli_fetch_array($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
	
	function itemPurchase($cid, $category, $title, $leadingSinger, $quantity, $cardNum, $expiryDate ) {
		define("MAX_DAILY_DELIVERY", 10);
		$upc = itemSearch($category, $title, $leadingSinger);
		$expiryDate = date('YYYY-MM-DD', strtotime($expiryDate));//mysql date
		$todayDate = date('Y-m-d H:i:s'); //mysql datetime
		$numUpc=count($upc);
		
		if ($numUpc==1){
			$sql = Connect();
			if ($sql->connect_error) {
				return 1;
			}
			
			//insert tuple in PurchaseItem table
			if($sql->query("INSERT INTO PurchaseItem (upc, quantity) VALUES ('$upc', '$quantity')") === FALSE){
				return 2;
			}
			
			//update inventory
			if($sql->query("UPDATE Item SET stock=stock-1 WHERE upc='$upc'") === FALSE){
				return 2;
			}
			
			//estimate Delivery Date
			if($countOrder = $sql->query("SELECT COUNT(receiptId) FROM Order WHERE deliveredDate=NULL") === FALSE){
				return 2;
			}
			$ourstandingOrders = mysql_fetch_row($countOrder);
			$days = (int) ($ourstandingOrders/MAX_DAILY_DELIVERY)+1;
			$expectedDate = date('YYYY-MM-DD', strtotime("+".$days." days", strtotime($todayDate)));
			
			//insert tuple in Order table
			if($sql->query("INSERT INTO Order (date, cid, cardNum, expiryDate, expectedDate) VALUES ('$todayDate', '$cid', '$cardNum', '$expiryDate', '$expectedDate')") === FALSE){
				return 2;
			}
			Close($sql);
		} elseif ($numUpc<1) return 3; //meaning no item matches the criteria
		return 4; //meaning more than one item matches the criteria
	}
	
