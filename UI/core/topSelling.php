<?php
	include_once 'Connect.php';
	
	function topSelling($date, $topNum){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		
		$result = $sql->query("SELECT P.upc, I.title, I.company, I.stock, SUM(P.quantity) AS QuantitiesSold 
                           FROM PurchaseItem P
                           INNER JOIN Item I
						   ON I.upc = P.upc
						   INNER JOIN `Order` O 
						   ON O.receiptId = P.receiptId
                           WHERE O.date='$date'
                           GROUP BY P.upc
                           ORDER BY SUM(P.quantity) DESC");
		$table = array();
		if($sql->error){
			$table = $sql->error;
		}else{
			$counter = 0;
			while($row = mysqli_fetch_assoc($result)){
				$table[] = $row;
				if($counter == $topNum){
					break;
				}
				$counter = $counter + 1;
			}
		}
		if(count($table) === 0){
			$table = "No items where sold.";
		}
		
		Close($sql);
		return $table;
	}
?>