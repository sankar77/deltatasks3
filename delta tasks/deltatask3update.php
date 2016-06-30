<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<center>
<form action="deltatask3update.php" method="get">
<p><b>PLEASE ENTER THE FOLLOWING DETAILS</b></p><br/><br/>
USERNAME:<input type="text" name="uname"><br/><br/>
PASSWORD:<input type="password" name="pswrd"><br/><br/>
<input type="submit" name="view" value="VIEW"><br/><br/>
</form>
</center>
<?php
$con=mysql_connect("localhost","sankar3","goodluck");
if(!$con){
die("can not connect:".mysql_error());
}
mysql_select_db("delta",$con);
//$sql = "SELECT * FROM taskdl WHERE Username='$_GET[uname]'";
$sql = "CREATE TABLE taskdl(
Username varchar(20),
Password varchar(70),
Profpic blob,
Email varchar(30),
Mobno int
)";
mysql_query($sql,$con);
if(isset($_GET['view'])){
	mysql_select_db("delta",$con);
	//$sql = "SELECT * FROM taskdl WHERE Username='$_GET[uname]'";
	$sql = "SELECT * FROM taskdl WHERE Username='$_GET[uname]'";
$myData=mysql_query($sql,$con);
echo"<table border=1>
<tr>
<th>USERNAME</th>
<th>PASSWORD</th>
<th>EMAIL</th>
<th>MOBILENO</th>
</tr>";
$record = mysql_fetch_array($myData);
echo"<tr>";
echo "<td>". $record['Username']. "</td>";
echo "<td>". $record['Password']."</td>";
echo "<td>".$record['Email']."</td>";
echo "<td>".$record['Mobno']."</td>";
//echo "<td>".$record['Password']."</td>";
echo "</tr>";
echo "</table>";
}
if(isset($_POST['update'])){
	$Updatequery="UPDATE taskdl SET Username='$_POST[name]',Email='$_POST[email]',Mobno='$_POST[mobno]' WHERE Username='$_POST[hidden]'";
mysql_query($Updatequery,$con);
};
$sql = "SELECT * FROM taskdl WHERE Username='$_GET[uname]'";
$myData=mysql_query($sql,$con);
echo"<table border=1>
<tr>
<th>USERNAME</th>
<th>EMAIL</th>
<th>MOBILENO</th>
</tr>";
while($record = mysql_fetch_array($myData)){

	echo "<form action=deltatask3update.php method=post>";
	echo "<tr>";
	echo "<td>". "<input type=text name=name value=".$record['Username']." </td>";
	echo "<td>". "<input type=text name=email value=".$record['Email']." </td>";
	echo "<td>". "<input type=text name=mobno value=" .$record['Mobno']." </td>";
	//echo "<td>". "<input type=text name=email value= ".$record['Email']." </td>";
	//echo "<td>". "<input type=text name=add value= ".$record['Addr']." </td>";
	//echo "<td>". "<input type=text name=abm value= ".$record['Aboutme']." </td>";
	echo "<td>". "<input type=hidden name=hidden value= ".$record['Username']." </td>";
	echo "<td>". "<input type=submit name=update value=update" ." </td>";
	echo "<tr>";
	echo "</form>";
}

echo "</table>";