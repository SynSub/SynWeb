<?php

/**
 * SynWeb 1.3 : User Profile Updater
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
		if (!empty($_POST['name_user_name'])) {
			$newName = $_POST['name_user_name'];
			mysqli_real_escape_string($conn, $newName);
			if (!empty($_POST['bio_text'])) {
				$newBioText = $_POST['bio_text'];
				mysqli_real_escape_string($conn, $newBioText);
				if (!empty($_POST['name_user_delete'])) {
					$updateBio = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE bio = '';";
					}
				else {
					$updateBio = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE bio = '$newBioText';";
					}
				if ($conn->query($updateBio) === TRUE) {
					echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
					}
				else {
					echo "Failed to update!";
					echo '<meta http-equiv="refresh" content="3;url=./?nid='.$logId.'" />';
					}
				}
			if (!empty($_POST['youtube_url'])) {
				$newYouTubeURL = $_POST['youtube_url'];
				mysqli_real_escape_string($conn, $newYouTubeURL);
				if (!empty($_POST['name_user_delete'])) {
					$updateYouTube = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE yturl = '';";
					}
				else {
					$updateYouTube = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE yturl = '$newYouTubeURL';";
					}
				if ($conn->query($updateYouTube) === TRUE) {
					echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
					}
				else {
					echo "Failed to update!";
					echo '<meta http-equiv="refresh" content="3;url=./?nid='.$logId.'" />';
					}
				}
			if (!empty($_POST['twitter_url'])) {
				$newTwitterURL = $_POST['twitter_url'];
				mysqli_real_escape_string($conn, $newTwitterURL);
				if (!empty($_POST['name_user_delete'])) {
					$updateTwitter = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE twiturl = '';";
					}
				else {
					$updateTwitter = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE twiturl = '$newTwitterURL';";
					}
				if ($conn->query($updateTwitter) === TRUE) {
					echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
					}
				else {
					echo "Failed to update!";
					echo '<meta http-equiv="refresh" content="3;url=./?nid='.$logId.'" />';
					}
				}
			if (!empty($_POST['twitch_url'])) {
				$newTwitchURL = $_POST['twitch_url'];
				mysqli_real_escape_string($conn, $newTwitchURL);
				if (!empty($_POST['name_user_delete'])) {
					$updateTwitch = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE twitchurl = '';";
					}
				else {
					$updateTwitch = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE twitchurl = '$newTwitchURL';";
					}
				if ($conn->query($updateTwitch) === TRUE) {
					echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
					}
				else {
					echo "Failed to update!";
					echo '<meta http-equiv="refresh" content="3;url=./?nid='.$logId.'" />';
					}
				}
			if (!empty($_POST['gab_url'])) {
				$newGabURL = $_POST['gab_url'];
				mysqli_real_escape_string($conn, $newGabURL);
				if (!empty($_POST['name_user_delete'])) {
					$updateGab = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE gaburl = '';";
					}
				else {
					$updateGab = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE gaburl = '$newGabURL';";
					}
				if ($conn->query($updateGab) === TRUE) {
					echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
					}
				else {
					echo "Failed to update!";
					echo '<meta http-equiv="refresh" content="3;url=./?nid='.$logId.'" />';
					}
				}
			if (!empty($_POST['minds_url'])) {
				$newMindsURL = $_POST['minds_url'];
				mysqli_real_escape_string($conn, $newMindsURL);
				if (!empty($_POST['name_user_delete'])) {
					$updateMinds = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE mindsurl = '';";
					}
				else {
					$updateMinds = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE mindsurl = '$newMindsURL';";
					}
				if ($conn->query($updateMinds) === TRUE) {
					echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
					}
				else {
					echo "Failed to update!";
					echo '<meta http-equiv="refresh" content="3;url=./?nid='.$logId.'" />';
					}
				}
			if (!empty($_POST['facebook_url'])) {
				$newFacebookURL = $_POST['facebook_url'];
				mysqli_real_escape_string($conn, $newFacebookURL);
				if (!empty($_POST['name_user_delete'])) {
					$updateFacebook = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE facebookurl = '';";
					}
				else {
					$updateFacebook = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE facebookurl = '$newFacebookURL';";
					}
				if ($conn->query($updateFacebook) === TRUE) {
					echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
					}
				else {
					echo "Failed to update!";
					echo '<meta http-equiv="refresh" content="3;url=./?nid='.$logId.'" />';
					}
				}
			if (!empty($_POST['discord_url'])) {
				$newDiscordURL = $_POST['discord_url'];
				mysqli_real_escape_string($conn, $newDiscordURL);
				if (!empty($_POST['name_user_delete'])) {
					$updateDiscord = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE discordurl = '';";
					}
				else {
					$updateDiscord = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE discordurl = '$newDiscordURL';";
					}
				if ($conn->query($updateDiscord) === TRUE) {
					echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
					}
				else {
					echo "Failed to update!";
					echo '<meta http-equiv="refresh" content="3;url=./?nid='.$logId.'" />';
					}
				}
			if (!empty($_POST['reddit_url'])) {
				$newRedditURL = $_POST['reddit_url'];
				mysqli_real_escape_string($conn, $newRedditURL);
				if (!empty($_POST['name_user_delete'])) {
					$updateReddit = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE redditurl = '';";
					}
				else {
					$updateReddit = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE redditurl = '$newRedditURL';";
					}
				if ($conn->query($updateReddit) === TRUE) {
					echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
					}
				else {
					echo "Failed to update!";
					echo '<meta http-equiv="refresh" content="3;url=./?nid='.$logId.'" />';
					}
				}
			if (!empty($_POST['periscope_url'])) {
				$newPeriscopeURL = $_POST['periscope_url'];
				mysqli_real_escape_string($conn, $newPeriscopeURL);
				if (!empty($_POST['name_user_delete'])) {
					$updatePeriscope = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE periscopeurl = '';";
					}
				else {
					$updatePeriscope = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE periscopeurl = '$newPeriscopeURL';";
					}
				if ($conn->query($updatePeriscope) === TRUE) {
					echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
					}
				else {
					echo "Failed to update!";
					echo '<meta http-equiv="refresh" content="3;url=./?nid='.$logId.'" />';
					}
				}
			if (!empty($_POST['instagram_url'])) {
				$newInstagramURL = $_POST['instagram_url'];
				mysqli_real_escape_string($conn, $newInstagramURL);
				if (!empty($_POST['name_user_delete'])) {
					$updateInstagram = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE instagramurl = '';";
					}
				else {
					$updateInstagram = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE instagramurl = '$newInstagramURL';";
					}
				if ($conn->query($updateInstagram) === TRUE) {
					echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
					}
				else {
					echo "Failed to update!";
					echo '<meta http-equiv="refresh" content="3;url=./?nid='.$logId.'" />';
					}
				}
			if (!empty($_POST['patreon_url'])) {
				$newPatreonURL = $_POST['patreon_url'];
				mysqli_real_escape_string($conn, $newPatreonURL);
				if (!empty($_POST['name_user_delete'])) {
					$updatePatreon = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE patreonurl = '';";
					}
				else {
					$updatePatreon = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE patreonurl = '$newPatreonURL';";
					}
				if ($conn->query($updatePatreon) === TRUE) {
					echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
					}
				else {
					echo "Failed to update!";
					echo '<meta http-equiv="refresh" content="3;url=./?nid='.$logId.'" />';
					}
				}
			if (!empty($_POST['paypal_url'])) {
				$newPaypalURL = $_POST['paypal_url'];
				mysqli_real_escape_string($conn, $newPaypalURL);
				if (!empty($_POST['name_user_delete'])) {
					$updatePaypal = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE paypalurl = '';";
					}
				else {
					$updatePaypal = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE paypalurl = '$newPaypalURL';";
					}
				if ($conn->query($updatePaypal) === TRUE) {
					echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
					}
				else {
					echo "Failed to update!";
					echo '<meta http-equiv="refresh" content="3;url=./?nid='.$logId.'" />';
					}
				}
			if (!empty($_POST['personal_url'])) {
				$newPersonalURL = $_POST['personal_url'];
				mysqli_real_escape_string($conn, $newPersonalURL);
			if (!empty($_POST['name_user_delete'])) {
				$updatePersonal = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE personalurl = '';";
				}
			else {
				$updatePersonal = "INSERT INTO users (charid,charname) VALUES ('$logId','$newName') ON DUPLICATE KEY UPDATE personalurl = '$newPersonalURL';";
				}
			if ($conn->query($updatePersonal) === TRUE) {
				echo '<meta http-equiv="refresh" content="0;url=./?nid='.$logId.'" />';
				}
			else {
				echo "Failed to update!";
				echo '<meta http-equiv="refresh" content="3;url=./?nid='.$logId.'" />';
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
?>