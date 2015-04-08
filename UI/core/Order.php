<?php
	include_once 'Connect.php';
    include_once 'sqlDataStr.php';
    
	function OrderInsert($date, $cid, $cardNum, $expiryDate, $expectedDate, $deliveredDate){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("INSERT INTO `Order` VALUES (NULL, ".sqlDataStr($date).", ".sqlDataStr($cid).", ".sqlDataStr($cardNum).", ".sqlDataStr($expiryDate).", ".sqlDataStr($expectedDate).", ".sqlDataStr($deliveredDate).")") === FALSE){
			echo $sql->error;
		} else {
            $r = $sql->insert_id;
        }
		Close($sql);
        return $r;
	}
	
	function OrderDelete($receiptId){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		if($sql->query("DELETE FROM `Order` WHERE receiptId = '$receiptId'") === FALSE){
			echo $sql->error;
		}
		Close($sql);
	}
	
	// returns a 2d array containing data from the Order table
	function OrderDisplay(){
		$sql = Connect();
		if ($sql->connect_error) {
			echo $sql->connect_error;
		}
		$result = $sql->query("SELECT * FROM `Order`");
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
?>