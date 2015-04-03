<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home page</title>
<link rel="stylesheet" type="text/css" href="stylesheets/project.css" />
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css" />
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css" />
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css" />
<script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
</head>

<body>
<h1>&nbsp;</h1>
<div id="Header">
  <h1>AMS DBSystem CMPT 354 G6</h1>
  <h3 align="right">Home &nbsp; &nbsp; Logout </h3>
</div>
<div id="Menu">
  <ul id = "Navi" class = "Menu">
  <li>Manager Title</li>
  <ul>
  <li>Add Item</li>
  <li>Deliver</li>
  <li>Daily Report</li>
  <li><em><strong>Top Selling</strong></em></li>
  </ul></ul>
</div>
<div id="Contents">
  <p>&nbsp;</p>
  <p><strong>Top Selling Items</strong> &nbsp;</p>
  <p>Date: 
    <input type="text" id="Datepicker1" />
  &nbsp;Top Items:  
  <input type="text" name="TopNum" id="TopNum"/>
   &nbsp;
   <input type="submit" name="Next"/>
  </p>
</div>
<script type="text/javascript"> $(function() {
	$( "#Datepicker1" ).datepicker(); });
  </script>
</body>

</html>
