<?php
	include_once 'Connect.php';

	function PurchaseItemInsert($upc, $quantity){
	$r = 2;
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("INSERT INTO PurchaseItem VALUES (NULL, '$upc', '$quantity')") === FALSE){
			return 2;
		}else{
			$r = $sql->insert_id;;
		}
		Close($sql);
		return $r;
	}
	
	function PurchaseItemDelete($receiptId, $upc){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("DELETE FROM PurchaseItem WHERE receiptId = '$receiptId' AND upc = '$upc'") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
	}
	
	function PurchaseItemDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		$result = $sql->query("SELECT * FROM PurchaseItem");
		$table = array();
		while($row = mysqli_fetch_array($result)){
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
			return 1;
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
		$table = array();
		while($row = mysqli_fetch_array($result)){
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