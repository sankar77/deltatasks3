<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$con=mysql_connect("localhost","sankar3","goodluck");
if(!$con){
die("can not connect:".mysql_error());
}

mysql_select_db("delta",$con);
$sql = "CREATE TABLE taskdl(
Username varchar(20),
Password varchar(70),
Profpic blob,
Email varchar(30),
Mobno int
)";
mysql_query($sql,$con);
mysql_close($con);
?>
</body>
</html>