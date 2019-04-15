<?php

/**
 * SynWeb 1.3 : User Authenticator
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
date_default_timezone_set('UTC');
session_start();
if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"]) {
}
else {
	echo "Captcha failed! <font style='color:#ff0000;'><i class='fas fa-times'></i></font><br />";
	die();
	}
if (!empty($_POST)) {
	$checkUser = $_POST['nodeid'];
	$checkPass = $_POST['nodecode'];
	$checkIP = $_POST['new_ip'];
	$combined = $checkUser.$checkPass.$salt;
	$encUser = hash('sha256', ($combined));
	}
else {
	echo "Post data failed! <font style='color:#ff0000;'><i class='fas fa-times'></i></font><br />";
	die();
	}
include('config.php');
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
mysqli_real_escape_string($conn, $checkUser);
mysqli_real_escape_string($conn, $encUser);
mysqli_real_escape_string($conn, $checkIP);
$resultsUser = mysqli_query($conn, "SELECT * FROM node WHERE nodeid = '$checkUser' AND nodecode = '$encUser'") or die(mysqli_error($conn));
if(!empty(mysqli_fetch_array( $resultsUser ))){
	foreach($resultsUser as $res){
		if($encUser === $res['nodecode']){
			$encIt = $encUser;
			$cookie_name = $encIt;
			$cookie_value = "on";
			setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
			}
		}
	}
else {
	echo "Node ID / Node Code mismatch! <font style='color:#ff0000;'><i class='fas fa-times'></i></font><br />";
	die();
	}
$conn->close();
echo '<meta http-equiv="refresh" content="0;url=./?nid='.$checkUser.'">';
?>