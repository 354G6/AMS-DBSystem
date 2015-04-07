<?php
	include_once 'Connect.php';
	
	function topSelling($date, $topNum){
		$sql = Connect();
		if ($sql->connect_error) {
			return 1;
		}
		
		$result = $sql->query("SELECT TOP $TopNum P.upc, I.title, I.company, I.stock, sum(P.quantity) AS 'Quantities Sold', 
                           FROM PurchaseItem P, Order O
                           INNER JOINT Item I
                           WHERE P.receiptid=O.receiptid, O.date='$date'
                           GROUP BY P.upc
                           ORDER BY sum(P.quantity) DESC");
		
		$table = array();
		
		while($row = mysqli_fetch_assoc($result)){
			$table[] = $row;
		}
		
		Close($sql);
		return $table;
	
?>







