<?php

/**
 * SynWeb 1.3 : Top Users Module
 *
 * PHP version 7.3.3
 *
 * @category Sharing
 * @package  SynWeb 1.3
 * @author   J.G.Becket <staff@synsub.com>
 * @license  MIT License
 * @version  1.0.3
 * @link     https://synsub.com
 */

include('./config.php');
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
if (isset($_GET['c'])) {
	$csort = "";
	if (is_numeric($_GET['c'])){
		$csort = "LIMIT ".$_GET['c'];
		mysqli_real_escape_string($conn, $csort);
	}
}
else {
	$csort = "";
}
$checkTop = mysqli_query($conn, "SELECT * FROM users ORDER BY ((experience / 1000)*(currency / 1000)) $csort") or die(mysqli_error($conn));
$i = 1;
echo "<center><table class='table-results' style='width:99.8%; margin:1px;'>";
echo "<th><font color='#4169E1'>#</font></th><th><font color='#4169E1'>Image</font></th><th width='40%'><font color='#4169E1'>Name</font></th><th width='16.6%'><font color='#4169E1'><i class='far fa-hand-paper'></font></th><th width='16.6%'><font color='#4169E1'><i class='fas fa-flask'></i></font></th><th width='16.6%'><font color='#4169E1'><i class='fas fa-level-up-alt'></i></font></th>";
while($row = mysqli_fetch_array( $checkTop )) {
	$userName = $row['charname'];
	$userImage = $row['charimage'];
	$userExperience = $row['experience'];
	$userCurrency = $row['currency'];
	$userLevel = (($userExperience / 1000)*($userCurrency / 1000));
	echo "<tr>";
	echo "<td width='5%'><font size='3' color='#000' style='float:left;'>".$i."</font></td>";
	echo "<td width='5%'><center><img src='./images/user/".$userImage."' alt='".$userImage."' style='width:60px; height: 60px;'></img></center></td>";
	echo "<td><font size='3' color='#000' style='float:left;'><a href='./?u=".$userName."' target='_self' title='View public profile?'>".$userName."</a></font></td>";
	echo "<td><font size='3' color='#000' style='float:left;'>".$userCurrency."</font></td>";
	echo "<td><font size='3' color='#000' style='float:left;'>".$userExperience."</font></td>";
	echo "<td><font size='3' color='#000' style='float:left;'>".$userLevel."</font></td>";
	echo "</tr>";
	$i = $i+1;
	}
echo "</table></center>";
$conn->close();
?>