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
			$criteria="WHERE ".$criteria;
		} else {
			$criteria="";
		}
		
        $result = $sql->query("SELECT I.upc, I.title, I.price, I.stock 
                                FROM Item I
                                LEFT JOIN LeadSinger L 
                                ON I.upc = L.upc "
                                .$criteria);
		$table = array();
		while($row = mysqli_fetch_assoc($result)) {
			$table[] = $row;
		}
		Close($sql);
		return $table;
	}
	
    function shoppingCartFetch($upcList) {
        if (!empty($upcList)) {
		    $sql = Connect();
		    if ($sql->connect_error) {
			    return $sql->connect_error;
		    }
            $criteria="";
		    foreach($upcList as $upc) {
                $criteria .= "OR upc='".$upc."' ";
            }
		    if ($criteria!=="") {
                $criteria = substr($criteria, 3);
                $criteria = "WHERE ".$criteria;
                $result = $sql->query("SELECT upc, title, price, stock FROM Item ".$criteria);
		        $table = array();
		        while($row = mysqli_fetch_assoc($result)) {
			        $table[] = $row;
		        }
		        Close($sql);
                return $table;
            }
        }
        return 0;
	}
    
	function itemPurchase($upcList, $quantityList, $cardNum, $expiryDate ) {
		define("MAX_DAILY_DELIVERY", 10);
		
		$expiryDate = date('Y-m-d', strtotime($expiryDate));//mysql date
		$todayDate = date('Y-m-d'); //mysql datetime
		$sql = Connect();
		if ($sql->connect_error) {
			return $sql->connect_error;
		}
        //estimate Delivery Date
		if(($countOrder = $sql->query("SELECT COUNT(*) FROM `Order` WHERE deliveredDate IS NULL")) === FALSE){
			return 2;
		}
        
		$outstandingOrders = (int) mysqli_fetch_row($countOrder)[0];
		$days = (int) ($outstandingOrders/MAX_DAILY_DELIVERY)+1;
        
		$expectedDate = date('Y-m-d', strtotime("+".$days." days", strtotime($todayDate)));
		//echo $expectedDate;
        $cid = $_SESSION['cid'];
		//insert tuple in Order table
		if($sql->query("INSERT INTO `Order` (date, cid, cardNum, expiryDate, expectedDate) VALUES ('$todayDate', '$cid', '$cardNum', '$expiryDate', '$expectedDate')") === FALSE){
			return $sql->error;
		}
        $receiptId=$sql->insert_id;
            
		//insert tuple in PurchaseItem table
        $i=0;
        foreach ($upcList as $upc) {
			if($sql->query("INSERT INTO PurchaseItem (receiptId, upc, quantity) VALUES ('$receiptId', '$upc', '$quantityList[$i]')") === FALSE){
				return 4;
			}
			
			//update inventory
			if($sql->query("UPDATE Item SET stock=stock-1 WHERE upc='$upc'") === FALSE){
				return 5;
			}
            $i++;
		}
			
		Close($sql);
		
        return 0;
	}
	
