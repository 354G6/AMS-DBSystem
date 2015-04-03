<?php
	include_once 'Connect.php';

	function PurchaseItemInsert($receiptId, $upc, $quantity){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		if($sql->query("INSERT INTO PurchaseItem VALUES ('$receiptId', '$upc', '$quantity')") === FALSE){
			return 2;
		}
		Close($sql);
		return 0;
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
	
	function DailyTotal($table){
		reset($table);
		$totalPrice = 0;
		for($x = 0; $x < count($table); $x++){
			$totalPrice = $totalPrice + $table[$x][2];
		}
		return $totalPrice;
	}
?>