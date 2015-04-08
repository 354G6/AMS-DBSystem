<?php
	//Returns an object which represents the connection to a MySQL Server.
	function Connect(){
		$sql = null;
		if (isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'],'Google App Engine') !== false) {
			// Connect from App Engine.
			$sql = new mysqli(null, 'root', '', 'AMS_CMPT354', null, '/cloudsql/ams-cmpt354g6-2015spring:test');
		} else {
			// Connect from a development environment.
            //$sql = new mysqli('173.194.230.229:3306', 'nicholas', 'amspassword', 'AMS_CMPT354');
            $sql = new mysqli('[2001:4860:4864:1:3208:ce09:5af3:c0cd]:3306', 'nicholas', 'amspassword', 'AMS_CMPT354');
		}
		return $sql;
	}
	
	//closes an object which represents the connection to a MySQL Server.
	function Close($sql){
		$sql->close();
	}
?>