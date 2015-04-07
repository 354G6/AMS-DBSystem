<?php
	include_once 'Connect.php';

	// returns an auto_increment id from insert
	function PurchaseItemInsert($upc, $quantity){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("INSERT INTO PurchaseItem VALUES (NULL, '$upc', '$quantity')") === FALSE){
			echo $sql->error;
		}else{
			$r = $sql->insert_id;;
		}
		Close($sql);
		return $r;
	}
	
	function PurchaseItemDelete($receiptId, $upc){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("DELETE FROM PurchaseItem WHERE receiptId = '$receiptId' AND upc = '$upc'") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	// returns a 2d array containing data from the PurchaseItem table
	function PurchaseItemDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		$result = $sql->query("SELECT * FROM PurchaseItem");
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
	
	function Purchase($cid, $cardNum, $upc, $quantity){
		$lastId = PurchaseItemInsert($upc, $quantity);
		$today = date("Y-m-d H:i:s");
		//expected in the next week
		$expectedDate = date('Y-m-d H:i:s', strtotime('+7 days'));
		//delivery and expire date should be set when order is delivered
		OrderInsert($lastId, $today, $cid, $cardNum, $expiryDate, NULL, NULL);
	}
	
	//returns table rows with report info and the total price in last element of array
	function DailyReport($date){
		$sql = Connect();
		if ($sql->connect_error) {
			return $sql->connect_error;
		}
		//$date format must be yyyy-mm-dd
		$result = $sql->query("SELECT Item.upc, category, ROUND((price*SUM(quantity)), 2) AS price, SUM(quantity)
							   FROM Item 
							   INNER JOIN PurchaseItem 
							   ON Item.upc=PurchaseItem.upc
							   INNER JOIN `Order` 
							   ON PurchaseItem.receiptId=Order.receiptId
							   WHERE '$date' = date(`Order`.`date`)
							   GROUP BY Item.upc");
		if($result === FALSE){
			return $sql->error;
		}
		$table = array();
		while($row = mysqli_fetch_assoc($result)){
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
	
	//supply table from DailyReport as parameter, function returns daily total from date of daily report
	function DailyTotal($table){
		reset($table);
		$totalPrice = 0;
		for($x = 0; $x < count($table); $x++){
			$totalPrice = $totalPrice + $table[$x][2];
		}
		return $totalPrice;
	}
?>