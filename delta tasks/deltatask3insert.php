<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<center>
<form action="deltatask3insert.php" enctype="multipart/form-data" method="post">
USERNAME:<input type="text" name="uname"><br/><br/>
PASSWORD:<input type="password" name="pswrd"><br/><br/>
PROFILE PIC:<input type="file" name="Photo" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26" required><br/><br/>
EMAIL:<input type="email" name="email"><br/><br/>
MOBNO:<input type="text" name="mno" required><br/><br/>
<input type="submit" name="submit" value="submit"><br/><br/>
</form>
<hr>
<form action="deltatask3insert.php" method="get">
<p><b>PLEASE ENTER THE FOLLOWING DETAILS</b></p><br/><br/>
USERNAME:<input type="text" name="uname"><br/><br/>
PASSWORD:<input type="password" name="pswrd"><br/><br/>
<input type="submit" name="view" value="VIEW"><br/><br/>
</form>
<!--form name="Image" enctype="multipart/form-data" action="deltatask3insert.php" method="POST">
<input type="file" name="Photo" size="2000000" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"><br/><br/>
<INPUT type="submit" class="button" name="submitted" value="  Submit  "> <br/><br/>
&nbsp;&nbsp;<INPUT type="reset" class="button" value="Cancel"><br/><br/>
</form-->
</center>
<?php
$con=mysql_connect("localhost","sankar3","goodluck");
if(!$con){
die("can not connect:".mysql_error());
}
/*if(isset($_POST['update'])){
	$Updatequery="UPDATE taskdl SET Username='$_POST[uname]',Email='$_POST[email]',Mobno='$_POST[mobno]' WHERE Username=$_POST[hidden]";
mysql_query($Updatequery,$con);
};*/
if(isset($_POST['submit'])){
	//$usname = $_POST['uname'];
	if(empty($_POST['uname'])||empty($_POST['pswrd'])||empty($_POST['email'])){
		echo"please fill proper details";
	}
else{	
mysql_select_db("delta",$con);
$uploadDir = 'images/'; //Image Upload Folder
$sql = "CREATE TABLE taskdl(
Username varchar(20),
Password varchar(70),
Profpic blob,
Email varchar(30),
Mobno int
)";
mysql_query($sql,$con);
$fileName = $_FILES['Photo']['name'];
$tmpName  = $_FILES['Photo']['tmp_name'];
$fileSize = $_FILES['Photo']['size'];
$fileType = $_FILES['Photo']['type'];
$filePath = $uploadDir . $fileName;
$result = move_uploaded_file($tmpName, $filePath);
if (!$result) {
echo "Error uploading file";
exit;
}
if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
	$filePath = addslashes($filePath);
}
//$phash=password_hash('$_POST[pswrd]', PASSWORD_DEFAULT);
//$query = "INSERT INTO taskdl ( Profpic ) VALUES ('$filePath')";
$phash=password_hash('$_POST[pswrd]', PASSWORD_DEFAULT);
echo $phash;
$query = "INSERT INTO taskdl ( Username,Password,Profpic,Email,Mobno ) VALUES ('$_POST[uname]','$phash','$filePath','$_POST[email]','$_POST[mno]')";
mysql_query($query,$con);
}
}
/*if(isset($_POST['update'])){
	$Updatequery="UPDATE taskdl SET Username='$_POST[uname]',Email='$_POST[email]',Mobno='$_POST[mobno]' WHERE Username='$_POST[hidden]'";
mysql_query($Updatequery,$con);
};*/
//$sql = "SELECT * FROM taskdl WHERE Username='$_GET[uname]'";
if(isset($_GET['view'])){
	mysql_select_db("delta",$con);
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
	$Updatequery="UPDATE taskdl SET Username='$_POST[uname]',Email='$_POST[email]',Mobno='$_POST[mobno]' WHERE Username='sanky'";
mysql_query($Updatequery,$con);
};
$sql = "SELECT * FROM taskdl WHERE Username=";
$myData=mysql_query($sql,$con);
echo"<table border=1>
<tr>
<th>USERNAME</th>
<th>EMAIL</th>
<th>MOBILENO</th>
</tr>";
$record = mysql_fetch_array($myData);

	echo "<form action=deltatask3insert.php method=post>";
	echo "<tr>";
	echo "<td>". "<input type=text name=uname value=".$record['Username']." </td>";
	echo "<td>". "<input type=text name=email value=".$record['Email']." </td>";
	echo "<td>". "<input type=text name=mobno value=" .$record['Mobno']." </td>";
	//echo "<td>". "<input type=text name=email value= ".$record['Email']." </td>";
	//echo "<td>". "<input type=text name=add value= ".$record['Addr']." </td>";
	//echo "<td>". "<input type=text name=abm value= ".$record['Aboutme']." </td>";
	echo "<td>". "<input type=hidden name=hidden value= ".$record['Username']." </td>";
	echo "<td>". "<input type=submit name=update value=update" ." </td>";
	echo "<tr>";
	echo "</form>";


echo "</table>";


/*if(isset($_POST['update'])){
	$Updatequery="UPDATE taskdl SET Username='$_POST[uname]',Email='$_POST[email]',Mobno='$_POST[mobno]' WHERE Username=$_POST[hidden]";
mysql_query($Updatequery,$con);
};*/
/*$sql = "SELECT * FROM taskdl";
$myData=mysql_query($sql,$con);
echo"<table border=1>
<tr>
<th>USERNAME</th>
<th>EMAIL</th>
<th>MOBILENO</th>
</tr>";
$record = mysql_fetch_array($myData);

	echo "<form action=deltatask3insert.php method=post>";
	echo "<tr>";
	echo "<td>". "<input type=text name=uname value=".$record['Username']." </td>";
	echo "<td>". "<input type=text name=email value=".$record['Email']." </td>";
	echo "<td>". "<input type=text name=mobno value=" .$record['Mobno']." </td>";
	//echo "<td>". "<input type=text name=email value= ".$record['Email']." </td>";
	//echo "<td>". "<input type=text name=add value= ".$record['Addr']." </td>";
	//echo "<td>". "<input type=text name=abm value= ".$record['Aboutme']." </td>";
	echo "<td>". "<input type=hidden name=hidden value= ".$record['Username']." </td>";
	echo "<td>". "<input type=submit name=update value=update" ." </td>";
	echo "<tr>";
	echo "</form>";


echo "</table>";*/

/*$sql = "SELECT * FROM taskdl WHERE Username='$_GET[uname]'";
$myData=mysql_query($sql,$con);
echo"<table border=1>
<tr>
<th>USERNAME</th>
<th>EMAIL</th>
<th>MOBILENO</th>
</tr>";
$record = mysql_fetch_array($myData);

	echo "<form action=deltatask3insert.php method=post>";
	echo "<tr>";
	echo "<td>". "<input type=text name=name value=".$record['Username']." </td>";
	echo "<td>". "<input type=text name=rno value=".$record['Email']." </td>";
	echo "<td>". "<input type=text name=dept value=" .$record['Mobno']." </td>";
	//echo "<td>". "<input type=text name=email value= ".$record['Email']." </td>";
	//echo "<td>". "<input type=text name=add value= ".$record['Addr']." </td>";
	//echo "<td>". "<input type=text name=abm value= ".$record['Aboutme']." </td>";
	echo "<td>". "<input type=hidden name=hidden value= ".$record['Username']." </td>";
	echo "<td>". "<input type=submit name=update value=update" ." </td>";
	echo "<tr>";
	echo "</form>";


echo "</table>";*/
/*if(isset($_POST['update'])){
	$Updatequery="UPDATE taskdl SET Username='$_POST[uname]',Email='$_POST[email]',Mobno='$_POST[mobno]' WHERE Username=$_POST[hidden]";
mysql_query($Updatequery,$con);
};*/
/*if(isset($_POST['submit'])){
mysql_select_db("delta",$con);
$uploadDir = 'images/'; //Image Upload Folder
$sql = "CREATE TABLE taskdl(
Username varchar(20),
Password varchar(70),
Profpic blob,
Email varchar(30),
Mobno int
)";
mysql_query($sql,$con);
$phash=password_hash('$_POST[pswrd]', PASSWORD_DEFAULT);
echo $phash;
$query = "INSERT INTO taskdl ( Username,Password,Email,Mobno ) VALUES ('$_POST[uname]','$phash','$_POST[email]','$_POST[mno]')";
mysql_query($query,$con);
}*/
mysql_close($con);
?>
</body>
</html>