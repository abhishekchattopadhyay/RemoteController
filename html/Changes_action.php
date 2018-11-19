<?php
$switchNo	=	$_GET['switchNo'];
$switchName	=	$_GET['switchName'];
$switchState	=	$_GET['State'];
$switchSchedule1On	=	$_GET['switchSchedule1-ON'];
$switchSchedule1Off	=	$_GET['switchSchedule1-OFF'];
$switchSchedule2On	=	$_GET['switchSchedule2-ON'];
$switchSchedule2Off	=	$_GET['switchSchedule2-OFF'];
$changedByIP	=	$_GET['changedByIP'];
$arrayLength = count($_GET);

//db items
$host    = "localhost";
$user    = "root";
$pass    = "raspberry";
$db_name = "powercycler";

//create connection
$connection = mysqli_connect($host, $user, $pass, $db_name);

//test if connection failed
if(mysqli_connect_errno()){
    die("connection failed: "
	. mysqli_connect_error()
	. " (" . mysqli_connect_errno()
	. ")");
}
else{
	echo "connection successful";
}

$sql = 'UPDATE `pc_db` SET `switchState` = \'' . $switchState . '\', `switchSchedule1On` = \'' . $switchSchedule1On . '\', `switchSchedule1Off` = \'' . $switchSchedule1Off . '\', `switchSchedule2On` = \'' . $switchSchedule2On . '\', `switchSchedule2Off` = \'' . $switchSchedule2Off . '\', `changedByIP` = \'' . $changedByIP . '\' WHERE `pc_db`.`switchNo` = ' . $switchNo;

mysqli_query($connection, $sql);

mysqli_commit($connection);
mysqli_close($connection);
/*
echo "arLen: " . $arrayLength;
echo "<br>";
echo "switchNo: " . $switchNo;
echo "<br>";
echo "switchName: " . $switchName;
echo "<br>";
echo "switchState: " . $switchState;
echo "<br>";
echo $switchSchedule1On;
echo "<br>";
echo $switchSchedule1Off;
echo "<br>";
echo $switchSchedule2On;
echo "<br>";
echo $switchSchedule2Off;
echo "<br>";
echo $changedByIP;
echo "done";
 */
header("Location: Changes.php"); /* Redirect browser */
exit();
?>
