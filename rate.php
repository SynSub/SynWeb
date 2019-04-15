<?php

/**
 * SynWeb 1.3 : Comment Rater
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

if (!empty($_POST['new_rate_id'])) {
	$logId = $_POST['new_rate_id'];
	include('logcheck.php');
	if (isLoggedIn($logId)){
		if (!empty($_POST)) {
			$nodeToRate = $_POST['new_rate_node'];
			$nodeIsRating = $_POST['new_rate_id'];
			$comToRate = $_POST['new_rate_code'];
			$userToRate = $_POST['new_rate_user'];
			include('config.php');
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}
			mysqli_real_escape_string($conn, $nodeToRate);
			mysqli_real_escape_string($conn, $nodeIsRating);
			mysqli_real_escape_string($conn, $comToRate);
			mysqli_real_escape_string($conn, $userToRate);
			$resultsTestIP = mysqli_query($conn, "SELECT nodeid,nodeip FROM node WHERE nodeid = '$nodeIsRating'") or die(mysqli_error($conn));
			foreach($resultsTestIP as $resTestIP){
				$checkIP1 = $resTestIP['nodeip'];
			}
			$resultsTestIP1 = mysqli_query($conn, "SELECT nodeid,nodeip FROM node WHERE nodeid = '$nodeToRate'") or die(mysqli_error($conn));
			foreach($resultsTestIP1 as $resTestIP1){
				$checkIP2 = $resTestIP1['nodeip'];
			}
			if ($checkIP1 === $checkIP2){
				die();
			}
			$resultsTestBuy = mysqli_query($conn, "SELECT charid,currency,charname FROM users WHERE charid = '$nodeIsRating'") or die(mysqli_error($conn));
			foreach($resultsTestBuy as $resTestBuy){
				$checkCash = $resTestBuy['currency'];
				$newBuyCharName = $resTestBuy['charname'];
				if ($checkCash >= 1){
					$resultsCharge = "INSERT INTO users (charid,charname) VALUES ('$nodeIsRating','$newBuyCharName') ON DUPLICATE KEY UPDATE currency = currency - 1;";
					if ($conn->query($resultsCharge) === TRUE) {
						$resultsEXP = "INSERT INTO users (charid,charname) VALUES ('$nodeToRate','$userToRate') ON DUPLICATE KEY UPDATE currency = currency + 1;";
						if ($conn->query($resultsEXP) === TRUE) {
							}
						}
					if ($nodeToRate === $nodeIsRating){
						}
					else {
						$resultsCom = "INSERT INTO coms (comcode) VALUES ('$comToRate') ON DUPLICATE KEY UPDATE comcredit = comcredit + 1;";
						if ($conn->query($resultsCom) === TRUE) {
							}						
						}
					}
				}
			}
		else {
			echo "Post data failed! <font style='color:#ff0000;'><i class='fas fa-times'></i></font><br />";
			die();
			}
		}
	else {
		echo "<h2>Not logged in!</h2>";
		die();
		}
	}
else {
	echo "Failed Auth Module!";
	die();
	}
?>