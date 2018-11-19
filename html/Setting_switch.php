<?php
$divID		=	$_GET['divID'];
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
if ( $divID == "switches"){
	$switchNo	=	$_GET['switchNo'];
	$switchName	=	$_GET['switchName'];
	$switchSchedule1Enable	=	$_GET['switchSchedule1Enable'];
	$switchSchedule2Enable	=	$_GET['switchSchedule2Enable'];
	$isSwitchLocked	=	$_GET['isSwitchLocked'];

	$sql = 'UPDATE `pc_db` SET `isSwitchLocked` = \'' . $isSwitchLocked .  '\', `switchName` = \'' . $switchName .'\', `switchSchedule1Enable` = \'' . $switchSchedule1Enable . '\', `switchSchedule2Enable` = \'' . $switchSchedule2Enable . '\' WHERE `pc_db`.`switchNo` = ' . $switchNo;

	mysqli_query($connection, $sql);
	mysqli_commit($connection);
	mysqli_close($connection);
} 
else if ( $divID == "datetime"){
	$pday = $_GET["pday"];

	$sql = 'UPDATE `General` SET `time` = \'' . $pday . '\' WHERE `General`.`idx` = 0';
	echo $sql;
	
	mysqli_query($connection, $sql);
	mysqli_commit($connection);
	mysqli_close($connection);
}
else if ( $divID == "network"){
	echo "Network";
	$network	=	$_GET['network'];
	$IP		=	$_GET['IP'];
	$Gateway	=	$_GET['Gateway'];
	$Netmask	=	$_GET['Netmask'];
	echo $network . $IP, $Gateway . $Netmask;
	if ($network == "MANUAL"){
		$sql = 'UPDATE `General` SET `NetType` = \'MANUAL\', `MyIP` = \'' . $IP . '\', `Gateway` = \'' . $Gateway . '\', `Netmask` = \'' . $Netmask . '\' WHERE `General`.`idx` = 0';
		echo $sql;
		mysqli_query($connection, $sql);
		mysqli_commit($connection);
		mysqli_close($connection);
	}else{
		$sql = 'UPDATE `General` SET `NetType` = \'DHCP\' WHERE `General`.`idx` = 0';
		echo $sql;
		mysqli_query($connection, $sql);
		mysqli_commit($connection);
		mysqli_close($connection);
	}
}
else if ( $divID == "Bscreening"){
	echo $divID;
	$BLACKLIST = $_GET['BLACKLIST'];
	$IP = $_GET['IP'];
	if ($BLACKLIST == 'ADD'){
		$sql = 'INSERT';
	} else if ($BLACKLIST == 'DELETE'){
	}
}	
else if ( $divID == "Bscreening"){
	echo $divID;
}	
?>
