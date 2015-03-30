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
		$upc = itemSearch($category, $title, $leadingSinger);
		$expiryDate = date('YYYY-MM-DD', strtotime($expiryDate));
		$numUpc=count($upc);
		if ($numUpc==1){
			$sql = Connect();
			if ($sql->connect_error) {
				return 1;
			}
			if($sql->query("INSERT INTO PurchaseItem (upc, quantity) VALUES ('$upc', '$quantity')") === FALSE){
				return 2;
			}
			if($sql->query("INSERT INTO Order (cid, cardNum, expiryDate) VALUES ('$cid', '$cardNum', '$expiryDate')") === FALSE){
				return 2;
			}
			Close($sql);
		} elseif ($numUpc<1) return 3; //meaning no upc returned
		return 4; //meaning more than one upc
	}