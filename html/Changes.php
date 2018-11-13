<?php
$page = $_SERVER['PHP_SELF'];
$sec = "600";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Power Cycler</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
	* {
	    box-sizing: border-box;
	}

	body {
	    font-family: Arial, Helvetica, sans-serif;
	}

	/* Style the header */
	header {
	    background-color: #666;
	    padding: 5px;
	    text-align: center;
	    font-size: 20px;
	    color: white;
	}

	/* Container for flexboxes */
	section {
	    display: -webkit-flex;
	    display: flex;
	}

	/* Style the navigation menu */
	nav {
	    -webkit-flex: 1;
	    -ms-flex: 1;
	    flex: 1;
	    background: #ccc;
	    padding: 20px;
	}

	/* Style the list inside the menu */
	nav ul {
	    list-style-type: none;
	    padding: 0;
	}

	/* Style the content */
	article {
	    -webkit-flex: 3;
	    -ms-flex: 3;
	    flex: 3;
	    background-color: #f1f1f1;
	    padding: 10px;
	}

	/* Style the footer */
	footer {
	    background-color: #777;
	    padding: 10px;
	    text-align: center;
	    color: white;
	}
	/* Table css */
	table, th, td {
	    border: 1px solid black;
	}
	th, td {
	    padding: 5px;
	}
	th {
	    text-align: left;
	}

	/* Responsive layout - makes the menu and the content (inside the section) sit on top of each other instead of next to each other */
	@media (max-width: 600px) {
	    section {
	      -webkit-flex-direction: column;
	      flex-direction: column;
	    }
	}
	</style>
	<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="https://vignette.wikia.nocookie.net/p__/images/1/10/225px-Dexter2.png/revision/latest?cb=20120711215235&path-prefix=protagonist">
</head>
<body>

<h2>Power Cycler</h2>
<p><strong>Note:</strong> Not supported in Firefox and Internet Explorer 10 and earlier versions.</p>

<header>
	<?php
		date_default_timezone_set('Asia/Calcutta');
		$Hour = date('G');
		$mark = "PM";
		if ( $Hour <= 11 ) {
		    //echo "Good Morning";
		    echo '<h4>' . "Good Morning" . '</h4>';
		    $mark = "AM";
		} else if ( $Hour <= 18 ) {
		    echo '<h4>' . "Good Afternoon" . '</h4>';
		    $mark = "PM";
		    //echo "Good Afternoon";
		} else if ( $Hour > 18 ) {
		    echo '<h4>' . "Good Evening" . '</h4>';
		    $mark = "PM";
		    //echo "Good Evening";
		}
		echo '<h5>' . "Power Cycler time is: " . date("h:i") . $mark . '</h5>';
	?>
</header>

<section>
  <nav>
    <ul>
      <li><a href="index.php">Overview</a></li>
      <li><a href="Changes.php">Changes</a></li>
      <li><a href="Settings.php">Settings</a></li>
    </ul>
  </nav>
  
  <article>
    <h1>Settings</h1>
	<h2>Switch Configuration</h2>
	<?php
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

	//get results from database
	$result = mysqli_query($connection,"SELECT switchNo,switchName,switchState,isSwitchLocked,switchSchedule1Enable,switchSchedule2Enable FROM pc_db");

	//showing property
	echo '<table class="data-table">
		<tr class="data-heading">';  
		//initialize table tag
		echo '<td>' . "Number" . '</td>';  //get field name for header
		echo '<td>' . "Name" . '</td>';  //get field name for header
		echo '<td>' . "State" . '</td>';  //get field name for header
		echo '<td>' . "Locked" . '</td>';  //get field name for header
		echo '<td>' . "Schedule1" . '</td>';  //get field name for header
		echo '<td>' . "Schedule2" . '</td>';  //get field name for header
		echo '<td>' . "Submit?" . '</td>';  //get field name for header
	echo '</tr>'; //end tr tag
	//showing all data
	while ($row = mysqli_fetch_array($result)) {
	?>
	<form action="/action_page.php" method="get">
	<tr>
		<td><?php echo $row["switchNo"]; ?></td>
		<td><input type="text" name="Name" value="<?php echo $row["switchName"]; ?>" </td>
		<td>
			<select name="State">
			<option>"<?php echo $row["switchState"]; ?>"</option>
			<option value="ON">"ON"</option>
			<option value="OFF">"OFF"</option>
			</select>
		</td>

		<td>
			<select name="Locked">
			<option>"<?php echo $row["isSwitchLocked"]; ?>"</option>
			<option value="NO">"NO"</option>
			<option value="YES">"YES"</option>
			</select>
		</td>
		<td>
			<select name="Schedule1">
			<option>"<?php echo $row["switchSchedule1Enable"]; ?>" </option>
			<option value="NO">"NO"</option>
			<option value="YES">"YES"</option>
			</select>
		</td>
		<td>
			<select name="Schedule1">
			<option>"<?php echo $row["switchSchedule2Enable"]; ?>" </option>
			<option value="NO">"NO"</option>
			<option value="YES">"YES"</option>
			</select>
		</td>

		<td>
			<input type="submit">
		</td>
	</form>
	</tr>

	<?php
	}
	?>
	</table>

    </body>
  </article>
</section>

<footer>
  <p>A simple LAMP server implementationon</p>
  <?php
  echo "<tr> Accessing from: " . $_SERVER['REMOTE_ADDR'] . "      This will be recorded";
  echo "</tr>";
  ?>
</footer>


</html>