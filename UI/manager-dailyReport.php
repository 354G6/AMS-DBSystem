<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home page</title>
<style type="text/css">
<!--
#Layer1 {
	position:absolute;
	width:159px;
	height:433px;
	z-index:1;
	top: 79px;
	left: 11px;
}
#Layer2 {
	position:absolute;
	width:543px;
	height:433px;
	z-index:2;
	left: 171px;
	top: 79px;
}
#Layer3 {
	position:absolute;
	width:704px;
	height:73px;
	z-index:3;
	left: 10px;
	top: 5px;
}

-->
</style>
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css" />
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css" />
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css" />
<script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
</head>

<body>
<h1>&nbsp;</h1>
<div id="Layer3">
  <h1>AMS DBSystem CMPT 354 G6</h1>
  <h3 align="right">Home &nbsp; &nbsp; Logout </h3>
</div>
<div id="Layer1">
  <h3> &nbsp; Manager Title</h3>
  <p align="left">	&nbsp; &nbsp; <em><strong>- </strong></em>Add Item</p>
  <p align="left">&nbsp; &nbsp; - Deliver</p>
  <p align="left">&nbsp; &nbsp; <em><strong>- Daily Report</strong></em><strong></strong></p>
  <p align="left">&nbsp; &nbsp; - Top Selling</p>
  <h3>&nbsp; </h3>
  <h3>&nbsp; </h3>
</div>
<div id="Layer2">
  <p>&nbsp;</p>
  <p><strong>Daily Report</strong></p>
  <p>Date:&nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;
    <input type="text" id="Datepicker1" />
    &nbsp;
  &nbsp; &nbsp;&nbsp;
  <input type="submit" name="Next"/>
  </p>
</div>
<script type="text/javascript">
$(function() {
	$( "#Datepicker1" ).datepicker(); 
});
</script>
</body>

</html>
