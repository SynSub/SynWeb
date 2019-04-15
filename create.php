
<?php

/**
 * SynWeb 1.3 : User Creator
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
 
$salt = "%^~az10by29";
echo "<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.1.0/css/all.css'>";
echo "<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.1.0/css/v4-shims.css'>";
date_default_timezone_set('UTC');
if (!empty($_POST)) {
	$comNodeName = $_POST['nodename'];
	$comNodeId = $_POST['nodeid'];
	$comNodeCode = $_POST['nodecode'];
	$comNodeEmail = $_POST['nodeemail'];
	$comNodeIP = $_SERVER ['REMOTE_ADDR'];
	$passId=$comNodeId;
	}
else {
	die();
	}
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $comNodeName)){
	echo "Error: No special characters in Display Name! <font style='color:#ff0000;'><i class='fas fa-times'></i></font><br />";
	echo "<meta http-equiv='refresh' content='3;url=./'>";
	die();
	}
if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $comNodeId)){
	echo "Error: No special characters in Login Name! <font style='color:#ff0000;'><i class='fas fa-times'></i></font><br />";
	echo "<meta http-equiv='refresh' content='3;url=./'>";
	die();
	}
session_start();
$_SESSION["passId"]=$passId;
if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"]) {
	include('config.php');
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
	$encItFirst = hash('sha256', ($comNodeId.$comNodeCode.$salt));
	$comNodeName = mysqli_real_escape_string($conn, $comNodeName);
	$comNodeId = mysqli_real_escape_string($conn, $comNodeId);
	$comNodeCode = mysqli_real_escape_string($conn, $encItFirst);
	$comNodeEmail = mysqli_real_escape_string($conn, $comNodeEmail);
	$comNodeIP = mysqli_real_escape_string($conn, $comNodeIP);
	if (isset($_POST["nodeid"])) {
		$sql = "INSERT INTO node (nodeid,nodecode,nodename,nodeip) VALUES ('$comNodeId','$comNodeCode','$comNodeName','$comNodeIP')";
		$sqlChar = "INSERT INTO users (charname,charid,charemail) VALUES ('$comNodeName','$comNodeId','$comNodeEmail')";
		}
	else {
		die();
		}
	if ($conn->query($sql) === TRUE) {
	}
	else {
		echo "Error: Duplicate Node ID! <font style='color:#ff0000;'><i class='fas fa-times'></i></font><br />";
		echo "<meta http-equiv='refresh' content='3;url=./'>";
		die();
		}
	if ($conn->query($sqlChar) === TRUE) {
		$getId = mysqli_query($conn, "SELECT * FROM users WHERE charid = '$comNodeId'") or die(mysqli_error($conn));
		while($row = mysqli_fetch_array( $getId )) {
			$gotId = $row['id'];
			$alreadyFollowing = $row['following'];
			$gotString = $alreadyFollowing." OR id = ".$gotId;
			}
		$updateFollow = "INSERT INTO users (charid,charname) VALUES ('$comNodeId','$comNodeName') ON DUPLICATE KEY UPDATE following = '$gotString';";
		if ($conn->query($updateFollow) === TRUE) {
		}
		else {
			echo "problem, boss!";
			die();
			}
		}
	else {
		echo "Error: Display Name already in use! Sorry! <font style='color:#ff0000;'><i class='fas fa-times'></i></font><br />";
		echo "<meta http-equiv='refresh' content='3;url=./'>";
		die();
		}
	$conn->close();
	}
else {
	echo "<meta http-equiv='refresh' content='0;url=./'>";
	die();
	}
$cookie_name = $encItFirst;
$cookie_value = "on";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
echo "<meta http-equiv='refresh' content='0;url=./?nid=".$comNodeId."'>";
?>