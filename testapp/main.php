<?php
	//Test all table functions
	//tests are currently in wrong order, foreign keys won't work
	include '../PHP/Include.php';
	
	//Purchase(123456789, 1111222233334444, 123456789123, 2);
	
	//$r = AddItems(123456789123, 2);
	//echo $r;
	
	/*$r = DailyReport('1000-01-01');
	for($x = 0; $x < count($r); $x++){
		for($y = 0; $y < count($r[$x]); $y++){
			echo $r[$x][$y];echo " ";
		}
	}
	$t = DailyTotal($r);
	echo $t;*/
	
	//CustomerRegister(123456788, "password", "name", "1234 Apple St Vancouver", 7787771234);
	$r = CustomerLogin(123456788, "password");
	if($r == 0){
		echo "Successful Login!";
	}else{
		echo"Failed Login";
	}
	
	//test customer functions
	/*$r = CustomerInsert(123456789, "password", "customer name", "1234 Apple St BC", 7787771234);
	echo $r;
	$r = CustomerDisplay();
	for($x = 0; $x < 1; $x++){
		for($y = 0; $y < 5; $y++){
			echo $r[$x][$y];echo " ";
		}
	}
	$r = CustomerDelete(123456789);
	echo $r;
	
	//test item functions
	$r = ItemInsert(123456789123, "item title", "item type", "category", "company", 1999, 19.99, 5);
	echo $r;
	$r = ItemDisplay();
	for($x = 0; $x < 1; $x++){
		for($y = 0; $y < 8; $y++){
			echo $r[$x][$y];echo " ";
		}
	}
	$r = ItemDelete(123456789123);
	echo $r;
	
	//test leadsinger functions
	$r = LeadSingerInsert(123456789123, "lead singer name");
	echo $r;
	$r = LeadSingerDisplay();
	for($x = 0; $x < 1; $x++){
		for($y = 0; $y < 2; $y++){
			echo $r[$x][$y];echo " ";
		}
	}
	$r = LeadSingerDelete(123456789123, "lead singer name");
	echo $r;
	
	//test hassong functions
	$r = HasSongInsert(123456789123, "song title");
	echo $r;
	$r = HasSongDisplay();
	for($x = 0; $x < 1; $x++){
		for($y = 0; $y < 2; $y++){
			echo $r[$x][$y];echo " ";
		}
	}
	$r = HasSongDelete(123456789123, "song title");
	echo $r;
	
	//test purchaseitem functions
	$r = PurchaseItemInsert(987654321, 123456789123, 2);
	echo $r;
	$r = PurchaseItemDisplay();
	for($x = 0; $x < 1; $x++){
		for($y = 0; $y < 3; $y++){
			echo $r[$x][$y];echo " ";
		}
	}
	$r = PurchaseItemDelete(987654321, 123456789123);
	echo $r;
	
	//test order functions
	$r = OrderInsert(987654321, '1000-01-01 00:00:00', 123456789, 1234567891234567, '1000-01-01 00:00:00', '1000-01-01', '1000-01-01');
	echo $r;
	$r = OrderDisplay();
	for($x = 0; $x < 1; $x++){
		for($y = 0; $y < 7; $y++){
			echo $r[$x][$y];echo " ";
		}
	}
	$r = OrderDelete(987654321, 123456789);
	echo $r;
	
	//test return functions
	$r = ReturnInsert(1234, '1000-01-01 00:00:00', 987654321);
	echo $r;
	$r = ReturnDisplay();
	for($x = 0; $x < 1; $x++){
		for($y = 0; $y < 3; $y++){
			echo $r[$x][$y];echo " ";
		}
	}
	$r = ReturnDelete(1234);
	echo $r;
	
	//test returnitem functions
	$r = ReturnItemInsert(1234, 123456789123);
	echo $r;
	$r = ReturnItemDisplay();
	for($x = 0; $x < 1; $x++){
		for($y = 0; $y < 3; $y++){
			echo $r[$x][$y];echo " ";
		}
	}
	$r = ReturnItemDelete(1234, 123456789123);
	echo $r;*/
?>
