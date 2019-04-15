<?php

/**
 * SynWeb 1.3 : User Follower
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

include('config.php');
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
if (!empty($_POST['name_user_id'])) {
	$logId = $_POST['name_user_id'];
	mysqli_real_escape_string($conn, $logId);
	include('logcheck.php');
	if (isLoggedIn($logId)){
		$myChar = mysqli_query($conn, "SELECT * FROM users WHERE charid = '$logId'") or die(mysqli_error($conn));
		while($row = mysqli_fetch_array( $myChar )) {
			$myCharFollow = $row['following'];
			}
		if (!empty($_POST['name_user_name'])) {
			$newName = $_POST['name_user_name'];
			mysqli_real_escape_string($conn, $newName);
			if (!empty($_POST['name_user_mode'])) {
				$newMode = $_POST['name_user_mode'];
				if (!empty($_POST['id_user_follow'])) {
					$newFollow = $_POST['id_user_follow'];
					mysqli_real_escape_string($conn, $newFollow);
					if ($newMode === 'follow'){
						$myCharFollow = preg_replace('/\s\s+/', ' ', $myCharFollow);
						$followMake = $myCharFollow." OR id = ".$newFollow;
						$updateNewFollow = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE following = '$followMake'";
						if ($conn->query($updateNewFollow) === TRUE) {
							echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
							}
						else {
							echo "Problem, boss!";
							die();
							}
						}
					if ($newMode === 'unfollow'){
						$myCharFollow = preg_replace('/\s\s+/', ' ', $myCharFollow);
						$bake = "OR id = ".$newFollow;
						$trimmed = str_replace($bake, '', $myCharFollow);
						$updateNewUnfollow = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE following = '$trimmed'";
						if ($conn->query($updateNewUnfollow) === TRUE) {
							echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
							}
						else {
							echo "Problem, boss!";
							die();
							}
						}
					}
				}
			}
		}
	else {
		echo "Error: It appears you are not logged in!";
		echo "<meta http-equiv='refresh' content='3; url=./'>";
		die();
		}
	}
?>