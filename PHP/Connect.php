<?php
	function Connect(){
		$sql = new mysqli('[2001:4860:4864:1:3208:ce09:5af3:c0cd]:3306',
		'nicholas',
		'amspassword',
		'AMS_CMPT354'
		);
		
		return $sql;
	}
	
	function Close($sql){
		$sql->close();
	}
?>