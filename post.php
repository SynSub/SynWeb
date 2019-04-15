<?php

/**
 * SynWeb 1.3 : Comment Poster
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

if (!empty($_POST['new_node_id'])) {
	$logId = $_POST['new_node_id'];
	include('logcheck.php');
	if (isLoggedIn($logId)){
		if (!empty($_POST)) {
			$postUserIP = $_POST['new_com_ip'];
			$postUserId = $_POST['new_com_user'];
			$postUserCom = $_POST['new_com_post'];
			$postUserBase = $_POST['new_com_base'];
			$postNodeId = $_POST['new_node_id'];
			if (isset($_POST['new_node_url'])) {
				$postNodeUrl = $_POST['new_node_url'];
				}
			$postUserCom = addslashes($postUserCom);
			include('config.php');
			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}
			mysqli_real_escape_string($conn, $postNodeId);
			mysqli_real_escape_string($conn, $postUserIP);
			mysqli_real_escape_string($conn, $postUserId);
			mysqli_real_escape_string($conn, $postUserCom);
			mysqli_real_escape_string($conn, $postUserBase);
			if (isset($_POST['new_node_url'])) {
				mysqli_real_escape_string($conn, $postNodeUrl);
				}
			if (isset($_POST['new_node_url'])) {
				$resultsPost = "INSERT INTO coms (nodeid,comuser,compost,comip,comurl,id) VALUES ('$postNodeId','$postUserId','$postUserCom','$postUserIP','$postNodeUrl','$postUserBase');";
				}
			else {
				$resultsPost = "INSERT INTO coms (nodeid,comuser,compost,comip,id) VALUES ('$postNodeId','$postUserId','$postUserCom','$postUserIP','$postUserBase');";
				}
			if ($conn->query($resultsPost) === TRUE) {
				}
			$resultsEXP = "INSERT INTO users (charname,charid) VALUES ('$postUserId','$postNodeId') ON DUPLICATE KEY UPDATE experience = experience + 10;";
			if ($conn->query($resultsEXP) === TRUE) {
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