<?php

/**
 * SynWeb 1.3 : Account Module
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
 
if (isset($_GET['nid'])) {
	$logId = $_GET['nid'];
	if (isLoggedIn($logId)){
		if (isset($_POST['pass_url'])) {
			$typeUrl = $_POST['pass_url'];
			$typeUrl = htmlspecialchars($typeUrl);
			echo "<meta http-equiv='refresh' content='0;url=./?nid=".$logId."&url=".$typeUrl."' />";
			die();
		}
		include('./config.php');
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			}
		mysqli_real_escape_string($conn, $logId);
		$reChar = mysqli_query($conn, "SELECT * FROM users WHERE charid = '$logId'") or die(mysqli_error($conn));
		while($row = mysqli_fetch_array( $reChar )) {
			$myCharId = $row['charid'];
			$myCharName = $row['charname'];
			$myCharMoney = $row['currency'];
			$myCharEXP = $row['experience'];
			$myCharIm = $row['charimage'];
			$myCharBaseId = $row['id'];
			$myCharFollowing = $row['following'];
			$myCharLvl = (($myCharEXP / 1000)*($myCharMoney / 1000));			
			$myCharBio1 = $row['bio'];
			$myCharBio1 = htmlspecialchars($myCharBio1);			
			$myCharYT1 = $row['yturl'];
			$myCharYT1 = htmlspecialchars($myCharYT1);
			$myCharTwit1 = $row['twiturl'];
			$myCharTwit1 = htmlspecialchars($myCharTwit1);			
			$myCharTwitch1 = $row['twitchurl'];
			$myCharTwitch1 = htmlspecialchars($myCharTwitch1);			
			$myCharGab1 = $row['gaburl'];
			$myCharGab1 = htmlspecialchars($myCharGab1);			
			$myCharMinds1 = $row['mindsurl'];
			$myCharMinds1 = htmlspecialchars($myCharMinds1);			
			$myCharFacebook1 = $row['facebookurl'];
			$myCharFacebook1 = htmlspecialchars($myCharFacebook1);			
			$myCharDiscord1 = $row['discordurl'];
			$myCharDiscord1 = htmlspecialchars($myCharDiscord1);			
			$myCharReddit1 = $row['redditurl'];
			$myCharReddit1 = htmlspecialchars($myCharReddit1);			
			$myCharPeriscope1 = $row['periscopeurl'];
			$myCharPeriscope1 = htmlspecialchars($myCharPeriscope1);			
			$myCharInstagram1 = $row['instagramurl'];
			$myCharInstagram1 = htmlspecialchars($myCharInstagram1);			
			$myCharPatreon1 = $row['patreonurl'];
			$myCharPatreon1 = htmlspecialchars($myCharPatreon1);			
			$myCharPaypal1 = $row['paypalurl'];
			$myCharPaypal1 = htmlspecialchars($myCharPaypal1);			
			$myCharPersonal1 = $row['personalurl'];
			$myCharPersonal1 = htmlspecialchars($myCharPersonal1);		
			}		
		$result = mysqli_query($conn, "select count(1) FROM users WHERE following LIKE '%id = $myCharBaseId%'");
		$row = mysqli_fetch_array($result);
		$followCount = $row[0];	
		$conn->close();
		echo "<center><table class='table-results' style='width:99.8%; overflow-wrap: break-word; word-break: break-word; border: 1px solid #e5eeff; -webkit-border-radius: 6px 6px 6px 6px; -moz-border-radius: 6px 6px 6px 6px; border-radius: 6px 6px 6px 6px; box-shadow: 1px 1px 6px #fff, -1px -1px 6px #fff, 1px 1px 6px #000000;'>";
		if (!empty($mobTrue)){
			echo "<th width='5%' style='border:none; box-shadow:none;'><font size='5' style='float:left; color:#4169E1;'><a href='./?nid=".$logId."' target='_self' title='Home'><i class='fas fa-home'></i></a></font></th><th width='9%' style='border:none; box-shadow:none;'><font size='1' color='#000' style='float:right; text-align:right;'><i class='fas fa-link'></i><br /><font size='2' color='#4169E1'>".number_format($followCount)."</font></font></th><th width='13%' style='border:none; box-shadow:none;'><font size='1' color='#000' style='float:right; text-align:right;'><i class='far fa-hand-paper'></i><br /><font size='2' color='#4169E1'>".number_format($myCharMoney)."</font></font></th><th width='13%' style='border:none; box-shadow:none;'><font size='1' color='#000' style='float:right; text-align:right;'><i class='fas fa-flask'></i><br /><font size='2' color='#4169E1'>".number_format($myCharEXP)."</font></font></th><th width='13%' style='border:none; box-shadow:none;'><font size='1' color='#000' style='float:right; text-align:right;'><i class='fas fa-level-up-alt'></i><br /><font size='2' color='#4169E1'>".$myCharLvl."</font></font></th><th width='36%' style='border:none; box-shadow:none;'><font size='5' color='#4169E1' style='float:right;'><button onclick='myOptions3()' style='border:none; background-color: transparent; outline: none; margin-left:5px; margin-right:5px;'><i style='font-size:1.6em; color:#4169E1; padding: 0;' class='fas fa-bars' title='Links'></i></button><button onclick='myOptions4()' style='border:none; background-color: transparent; outline: none; margin-left:5px; margin-right:5px;'><i style='font-size:1.6em; color:#4169E1; padding: 0;' class='fas fa-users-cog' title='URLs'></i></button><button onclick='myOptions2()' style='border:none; background-color: transparent; outline: none; margin-left:5px; margin-right:5px;'><i style='font-size:1.6em; color:#4169E1; padding: 0;' class='fas fa-users' title='Users'></i></button><button onclick='myOptions()' style='border:none; background-color: transparent; outline: none; margin-left:5px; margin-right:5px;'><i style='font-size:1.6em; color:#4169E1; padding: 0;' class='fas fa-user' title='Profile'></i></button></font></th>";
			}
		else {
			echo "<th width='29%' style='border:none; box-shadow:none;'><font size='5' style='float:left; color:#4169E1;'><a href='./?nid=".$logId."' target='_self' title='Home'><i class='fas fa-home'></i></a> | <a href='./?u=".$myCharName."' target='_self' title='Public User Profile'>".$myCharName."</a></font></th><th width='11%' style='border:none; box-shadow:none;'><font size='3' color='#000' style='float:left;'><i class='fas fa-link' title='Followers'></i> <font size='3' color='#4169E1'>".number_format($followCount)."</font></font></th><th width='11%' style='border:none; box-shadow:none;'><font size='3' color='#000' style='float:left;'><i class='far fa-hand-paper' title='Karma'> <font size='3' color='#4169E1'>".number_format($myCharMoney)."</font></font></th><th width='11%' style='border:none; box-shadow:none;'><font size='3' color='#000' style='float:left;'><i class='fas fa-flask' title='Experience'></i> <font size='3' color='#4169E1'>".number_format($myCharEXP)."</font></font></th><th width='11%' style='border:none; box-shadow:none;'><font size='3' color='#000' style='float:left;'><i class='fas fa-level-up-alt' title='Level'></i> <font size='3' color='#4169E1'>".$myCharLvl."</font></font></th><th width='32%' style='border:none; box-shadow:none;'><font size='5' color='#4169E1' style='float:right;'><button onclick='myOptions3()' style='border:none; background-color: transparent; outline: none; margin-left:5px; margin-right:5px;'><i style='font-size:2em; color:#4169E1; padding: 0;' class='fas fa-bars' title='Links'></i></button><button onclick='myOptions4()' style='border:none; background-color: transparent; outline: none; margin-left:5px; margin-right:5px;'><i style='font-size:2em; color:#4169E1; padding: 0;' class='fas fa-users-cog' title='URLs'></i></button><button onclick='myOptions2()' style='border:none; background-color: transparent; outline: none; margin-left:5px; margin-right:5px;'><i style='font-size:2em; color:#4169E1; padding: 0;' class='fas fa-users' title='Users'></i></button><button onclick='myOptions()' style='border:none; background-color: transparent; outline: none; margin-left:5px; margin-right:5px;'><i style='font-size:2em; color:#4169E1; padding: 0;' class='fas fa-user' title='Profile'></i></button></font></th>";			
			}
		echo "</table></center>";
		echo "<div style='display:none; position:absolute; right: 5%; left: 5%; top:65px; z-index:99; background-color:#fff; border: 1px solid #e5eeff; -webkit-border-radius: 6px 6px 6px 6px; -moz-border-radius: 6px 6px 6px 6px; border-radius: 6px 6px 6px 6px; box-shadow: 1px 1px 6px #fff, -1px -1px 6px #fff, 1px 1px 6px #000000;' id='options-box2'>";
		include('./modules/who.php');
		echo "</div>";
		echo "<div style='display:none; position:absolute; right: 5%; left: 5%; top:65px; z-index:99; background-color:#fff; border: 1px solid #e5eeff; -webkit-border-radius: 6px 6px 6px 6px; -moz-border-radius: 6px 6px 6px 6px; border-radius: 6px 6px 6px 6px; box-shadow: 1px 1px 6px #fff, -1px -1px 6px #fff, 1px 1px 6px #000000;' id='options-box3'>";
		include('./modules/links.php');
		echo "</div>";		
		echo "<div style='display:none; position:absolute; right: 5%; left: 5%; top:65px; z-index:99; background-color:#fff; border: 1px solid #e5eeff; -webkit-border-radius: 6px 6px 6px 6px; -moz-border-radius: 6px 6px 6px 6px; border-radius: 6px 6px 6px 6px; box-shadow: 1px 1px 6px #fff, -1px -1px 6px #fff, 1px 1px 6px #000000;' id='options-box4'>";
		echo "<center><table class='table-results' style='width:99.8%;'>";
		echo "<th><font size='3' color='#000'>Archive URL / Comment on URL</font></th>";		
		echo "</table></center>";
		echo "<center><table class='table-results' style='width:99.8%;'>";
		echo "<th><font size='3' color='#000'><center><form action='' method='post'><i class='fas fa-cogs' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i><input type='url' value='' name='pass_url' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Enter any URL to load comments' required/><input type='submit' value='Load' style='width:20.6vw; height:40px;'/></form></center></font></th>";		
		echo "</table></center>";
		echo "</div>";
		echo "<div style='display:none; position:absolute; right: 5%; left: 5%; top:65px; z-index:99; background-color:#fff; border: 1px solid #e5eeff; -webkit-border-radius: 6px 6px 6px 6px; -moz-border-radius: 6px 6px 6px 6px; border-radius: 6px 6px 6px 6px; box-shadow: 1px 1px 6px #fff, -1px -1px 6px #fff, 1px 1px 6px #000000;' id='options-box'>";
		echo "<center><table class='table-results' style='width:100%; margin:1px;'>";
		echo "<th>Profile</th>";
		echo "</table></center>";
		echo "<center><table class='table-results' style='width:99.8%;'>";
		if (!empty($mobTrue)){
			echo "<th><button onclick='delete_cookie(\"".$cookiePass."\")' style='border:none; background-color: transparent; outline: none;' title='Log out?'><i style='padding: 0; float:left; font-size:2.0em; color:#000;' class='fas fa-times-circle'></i></button><i style='padding: 0; float:right;'><form action='upload.php' method='post' enctype='multipart/form-data'><input type='image' src='./images/user/".$myCharIm."' alt='Upload' style='width: 40px; height: 40px; float:right;'><input type='hidden' name='upload_user_id' value='".$myCharName."' id='imagePost'><input type='hidden' name='name_user_id' value='".$myCharId."' id='namePost'><br /><input type='file' name='fileToUpload' id='fileToUpload' accept='image/*' required style='float:right;'></form></i></th>";
			}
		else {
			echo "<th><button onclick='delete_cookie(\"".$cookiePass."\")' style='border:none; background-color: transparent; outline: none;' title='Log out?'><i style='padding: 0; float:left; font-size:2.0em; color:#000;' class='fas fa-times-circle'></i></button><i style='padding: 0; float:right;'><form action='upload.php' method='post' enctype='multipart/form-data'><input type='image' src='./images/user/".$myCharIm."' alt='Upload' style='width: 30px; height: 30px; float:right;'><input type='file' name='fileToUpload' id='fileToUpload' accept='image/*' required style='float:right;'><input type='hidden' name='upload_user_id' value='".$myCharName."' id='imagePost'><input type='hidden' name='name_user_id' value='".$myCharId."' id='namePost'></form></i></th>";			
			}
		echo "</table></center>";
		echo "<center><table class='table-results' style='width:99.8%;'>";
		echo "<th><font size='3' color='#000'>Profile Biography</font></th>";		
		echo "</table></center>";
		echo "<center><table class='table-results' style='width:99.8%;'>";
		echo "<th><font size='3' color='#000'><center><form action='update.php' method='post' style='display: inline-block;'>";		
		if (!empty($myCharBio1)){
			echo "<i class='fas fa-address-card' style='padding-right: 5px; font-size: 100%; color:limegreen; width:30px;' title='".$myCharBio1."'></i>";
			}
		else {
			echo "<i class='fas fa-address-card' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i>";
			}
		echo "<input type='text' value='' name='bio_text' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Update profile biography' minlength='0' maxlength='135' required/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='Update' style='width:15.4vw; height:40px;'/></form><form action='update.php' method='post' style='display: inline-block;'><input type='hidden' value='a' name='bio_text'/><input type='hidden' value='delete' name='name_user_delete'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='X' style='width:5vw; height:40px;' title='Remove from profile?'/></form></center></font></th>";		
		echo "</table></center>";
		echo "<center><table class='table-results' style='width:99.8%;'>";
		echo "<th><font size='3' color='#000'>Integrate content to User Profile</font></th>";		
		echo "</table></center>";		
		echo "<center><table class='table-results' style='width:99.8%;'>";
		echo "<th><font size='3' color='#000'><center><form action='update.php' method='post' style='display: inline-block;'>";		
		if (!empty($myCharYT1)){
			echo "<i class='fab fa-youtube' style='padding-right: 5px; font-size: 100%; color:limegreen; width:30px;' title='".$myCharYT1."'></i>";
			}
		else {
			echo "<i class='fab fa-youtube' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i>";
			}
		echo "<input type='text' value='' name='youtube_url' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Enter YouTube Channel ID' minlength='24' maxlength='24' required/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='Update' style='width:15.4vw; height:40px;'/></form><form action='update.php' method='post' style='display: inline-block;'><input type='hidden' value='a' name='youtube_url'/><input type='hidden' value='delete' name='name_user_delete'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='X' style='width:5vw; height:40px;' title='Remove from profile?'/></form></center><center><form action='update.php' method='post' style='display: inline-block;'>";		
		if (!empty($myCharTwit1)){
			echo "<i class='fab fa-twitter' style='padding-right: 5px; font-size: 100%; color:limegreen; width:30px;' title='".$myCharTwit1."'></i>";
			}
		else {
			echo "<i class='fab fa-twitter' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i>";
			}
		echo "<input type='text' value='' name='twitter_url' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Enter Twitter Handle' minlength='3' required/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='Update' style='width:15.4vw; height:40px;'/></form><form action='update.php' method='post' style='display: inline-block;'><input type='hidden' value='a' name='twitter_url'/><input type='hidden' value='delete' name='name_user_delete'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='X' style='width:5vw; height:40px;' title='Remove from profile?'/></form></center></font></th>";		
		echo "</table></center>";
		echo "<center><table class='table-results' style='width:99.8%;'>";
		echo "<th><font size='3' color='#000'>Add social links to User Profile</font></th>";		
		echo "</table></center>";
		echo "<center><table class='table-results' style='width:99.8%;'>";
		echo "<th><font size='3' color='#000'><center><form action='update.php' method='post' style='display: inline-block;'>";		
		if (!empty($myCharTwitch1)){
			echo "<i class='fab fa-twitch' style='padding-right: 5px; font-size: 100%; color:limegreen; width:30px;' title='".$myCharTwitch1."'></i>";
			}
		else {
			echo "<i class='fab fa-twitch' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i>";
			}
		echo "<input type='url' value='' name='twitch_url' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Enter your Twitch URL' minlength='8' required/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='Update' style='width:15.4vw; height:40px;'/></form><form action='update.php' method='post' style='display: inline-block;'><input type='hidden' value='a' name='twitch_url'/><input type='hidden' value='delete' name='name_user_delete'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='X' style='width:5vw; height:40px;' title='Remove from profile?'/></form></center><center><form action='update.php' method='post' style='display: inline-block;'>";		
		if (!empty($myCharGab1)){
			echo "<i class='fas fa-frog' style='padding-right: 5px; font-size: 100%; color:limegreen; width:30px;' title='".$myCharGab1."'></i>";
			}
		else {
			echo "<i class='fas fa-frog' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i>";
			}
		echo "<input type='url' value='' name='gab_url' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Enter your Gab URL' minlength='8' required/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='Update' style='width:15.4vw; height:40px;'/></form><form action='update.php' method='post' style='display: inline-block;'><input type='hidden' value='a' name='gab_url'/><input type='hidden' value='delete' name='name_user_delete'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='X' style='width:5vw; height:40px;' title='Remove from profile?'/></form></center><center><form action='update.php' method='post' style='display: inline-block;'>";		
		if (!empty($myCharMinds1)){
			echo "<i class='fas fa-lightbulb' style='padding-right: 5px; font-size: 100%; color:limegreen; width:30px;' title='".$myCharMinds1."'></i>";
			}
		else {
			echo "<i class='fas fa-lightbulb' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i>";
			}
		echo "<input type='url' value='' name='minds_url' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Enter your Minds URL' minlength='8' required/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='Update' style='width:15.4vw; height:40px;'/></form><form action='update.php' method='post' style='display: inline-block;'><input type='hidden' value='a' name='minds_url'/><input type='hidden' value='delete' name='name_user_delete'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='X' style='width:5vw; height:40px;' title='Remove from profile?'/></form></center>				<center><form action='update.php' method='post' style='display: inline-block;'>";		
		if (!empty($myCharFacebook1)){
			echo "<i class='fab fa-facebook' style='padding-right: 5px; font-size: 100%; color:limegreen; width:30px;' title='".$myCharFacebook1."'></i>";
			}
		else {
			echo "<i class='fab fa-facebook' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i>";
			}
		echo "<input type='url' value='' name='facebook_url' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Enter your Facebook URL' minlength='8' required/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='Update' style='width:15.4vw; height:40px;'/></form><form action='update.php' method='post' style='display: inline-block;'><input type='hidden' value='a' name='facebook_url'/><input type='hidden' value='delete' name='name_user_delete'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='X' style='width:5vw; height:40px;' title='Remove from profile?'/></form></center><center><form action='update.php' method='post' style='display: inline-block;'>";		
		if (!empty($myCharDiscord1)){
			echo "<i class='fab fa-discord' style='padding-right: 5px; font-size: 100%; color:limegreen; width:30px;' title='".$myCharDiscord1."'></i>";
			}
		else {
			echo "<i class='fab fa-discord' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i>";
			}
		echo "<input type='url' value='' name='discord_url' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Enter your Discord URL' minlength='8' required/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='Update' style='width:15.4vw; height:40px;'/></form><form action='update.php' method='post' style='display: inline-block;'><input type='hidden' value='a' name='discord_url'/><input type='hidden' value='delete' name='name_user_delete'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='X' style='width:5vw; height:40px;' title='Remove from profile?'/></form></center><center><form action='update.php' method='post' style='display: inline-block;'>";		
		if (!empty($myCharReddit1)){
			echo "<i class='fab fa-reddit' style='padding-right: 5px; font-size: 100%; color:limegreen; width:30px;' title='".$myCharReddit1."'></i>";
			}
		else {
			echo "<i class='fab fa-reddit' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i>";
			}
		echo "<input type='url' value='' name='reddit_url' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Enter your Reddit URL' minlength='8' required/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='Update' style='width:15.4vw; height:40px;'/></form><form action='update.php' method='post' style='display: inline-block;'><input type='hidden' value='a' name='reddit_url'/><input type='hidden' value='delete' name='name_user_delete'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='X' style='width:5vw; height:40px;' title='Remove from profile?'/></form></center><center><form action='update.php' method='post' style='display: inline-block;'>";		
		if (!empty($myCharPeriscope1)){
			echo "<i class='fab fa-periscope' style='padding-right: 5px; font-size: 100%; color:limegreen; width:30px;' title='".$myCharPeriscope1."'></i>";
			}
		else {
			echo "<i class='fab fa-periscope' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i>";
			}
		echo "<input type='url' value='' name='periscope_url' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Enter your Periscope URL' minlength='8' required/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='Update' style='width:15.4vw; height:40px;'/></form><form action='update.php' method='post' style='display: inline-block;'><input type='hidden' value='a' name='periscope_url'/><input type='hidden' value='delete' name='name_user_delete'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='X' style='width:5vw; height:40px;' title='Remove from profile?'/></form></center><center><form action='update.php' method='post' style='display: inline-block;'>";		
		if (!empty($myCharInstagram1)){
			echo "<i class='fab fa-instagram' style='padding-right: 5px; font-size: 100%; color:limegreen; width:30px;' title='".$myCharInstagram1."'></i>";
			}
		else {
			echo "<i class='fab fa-instagram' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i>";
			}
		echo "<input type='url' value='' name='instagram_url' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Enter your Instagram URL' minlength='8' required/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='Update' style='width:15.4vw; height:40px;'/></form><form action='update.php' method='post' style='display: inline-block;'><input type='hidden' value='a' name='instagram_url'/><input type='hidden' value='delete' name='name_user_delete'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='X' style='width:5vw; height:40px;' title='Remove from profile?'/></form></center><center><form action='update.php' method='post' style='display: inline-block;'>";		
		if (!empty($myCharPatreon1)){
			echo "<i class='fab fa-patreon' style='padding-right: 5px; font-size: 100%; color:limegreen; width:30px;' title='".$myCharPatreon1."'></i>";
			}
		else {
			echo "<i class='fab fa-patreon' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i>";
			}
		echo "<input type='url' value='' name='patreon_url' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Enter your Patreon URL' minlength='8' required/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='Update' style='width:15.4vw; height:40px;'/></form><form action='update.php' method='post' style='display: inline-block;'><input type='hidden' value='a' name='patreon_url'/><input type='hidden' value='delete' name='name_user_delete'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='X' style='width:5vw; height:40px;' title='Remove from profile?'/></form></center><center><form action='update.php' method='post' style='display: inline-block;'>";		
		if (!empty($myCharPaypal1)){
			echo "<i class='fab fa-paypal' style='padding-right: 5px; font-size: 100%; color:limegreen; width:30px;' title='".$myCharPaypal1."'></i>";
			}
		else {
			echo "<i class='fab fa-paypal' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i>";
			}
		echo "<input type='url' value='' name='paypal_url' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Enter your PayPal URL' minlength='8' required/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='Update' style='width:15.4vw; height:40px;'/></form><form action='update.php' method='post' style='display: inline-block;'><input type='hidden' value='a' name='paypal_url'/><input type='hidden' value='delete' name='name_user_delete'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='X' style='width:5vw; height:40px;' title='Remove from profile?'/></form></center><center><form action='update.php' method='post' style='display: inline-block;'>";		
		if (!empty($myCharPersonal1)){
			echo "<i class='fas fa-external-link-square-alt' style='padding-right: 5px; font-size: 100%; color:limegreen; width:30px;' title='".$myCharPersonal1."'></i>";
			}
		else {
			echo "<i class='fas fa-external-link-square-alt' style='padding-right: 5px; font-size: 100%; color:RoyalBlue; width:30px;'></i>";
			}
		echo "<input type='url' value='' name='personal_url' style='width:50vw; height:40px; margin:1px; padding: 5px;' placeholder='Enter your Website URL' minlength='8' required/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='Update' style='width:15.4vw; height:40px;'/></form><form action='update.php' method='post' style='display: inline-block;'><input type='hidden' value='a' name='personal_url'/><input type='hidden' value='delete' name='name_user_delete'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='submit' value='X' style='width:5vw; height:40px;' title='Remove from profile?'/></form></center></font></th>";		
		echo "</table></center>";
		echo "</div>";
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
<script>
function myOptions() {
var x = document.getElementById("options-box");
var x2 = document.getElementById("options-box2");
var x3 = document.getElementById("options-box3");
var x4 = document.getElementById("options-box4");
if (x.style.display === "none") {
x.style.display = "inline";
x2.style.display = "none";
x3.style.display = "none";
x4.style.display = "none";
} else {
x.style.display = "none";
}
}
</script>
<script>
function myOptions2() {
var x = document.getElementById("options-box2");
var x1 = document.getElementById("options-box");
var x3 = document.getElementById("options-box3");
var x4 = document.getElementById("options-box4");
if (x.style.display === "none") {
x.style.display = "inline";
x1.style.display = "none";
x3.style.display = "none";
x4.style.display = "none";
} else {
x.style.display = "none";
}
}
</script>
<script>
function myOptions3() {
var x = document.getElementById("options-box3");
var x1 = document.getElementById("options-box");
var x2 = document.getElementById("options-box2");
var x3 = document.getElementById("options-box4");
if (x.style.display === "none") {
x.style.display = "inline";
x1.style.display = "none";
x2.style.display = "none";
x3.style.display = "none";
} else {
x.style.display = "none";
}
}
</script>
<script>
function myOptions4() {
var x = document.getElementById("options-box4");
var x1 = document.getElementById("options-box");
var x2 = document.getElementById("options-box2");
var x3 = document.getElementById("options-box3");
if (x.style.display === "none") {
x.style.display = "inline";
x1.style.display = "none";
x2.style.display = "none";
x3.style.display = "none";
} else {
x.style.display = "none";
}
}
</script>
<script>
var cookie_name = '<?php echo $cookiePass; ?>';
function delete_cookie(name) {
  document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/";
  window.location = './';
}
</script>