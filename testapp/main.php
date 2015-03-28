<?php
	//Test all table functions
	include '../PHP/Include.php';
	
	//test customer functions
	$r = CustomerInsert(123456789, "password", "customer name", "1234 Apple St BC", 7787771234);
	echo $r;
	$r = CustomerDelete(123456789);
	echo $r;
	
	//test item functions
	$r = ItemInsert(123456789123, "item title", "item type", "category", "company", 1999, 19.99, 5);
	echo $r;
	$r = ItemDelete(123456789123);
	echo $r;
	
	//test leadsinger functions
?>
