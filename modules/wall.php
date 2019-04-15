<?php

/**
 * SynWeb 1.3 : Wall Module
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

echo "<div id='scores'>";
$newIP = $_SERVER ['REMOTE_ADDR'];
if (isset($_GET['nid'])) {
	$logId = $_GET['nid'];
	if (isLoggedIn($logId)){
		$tempIP = $newIP;
		include('./config.php');
		if ($connTemp->connect_error) {
			die("Connection failed: " . $connTemp->connect_error);
			}
		mysqli_real_escape_string($connTemp, $logId);
		function getYoutubeEmbedUrl($url) {
			$shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
			$longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';
			if (preg_match($longUrlRegex, $url, $matches)) {
				$youtube_id = $matches[count($matches) - 1];
				}
			if (preg_match($shortUrlRegex, $url, $matches)) {
				$youtube_id = $matches[count($matches) - 1];
				}
			if (!empty($youtube_id)){
				return 'https://www.youtube.com/embed/' . $youtube_id ;
				}
			}
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
			$mobMe = 1;
			}
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			}
		$logId = mysqli_real_escape_string($conn, $logId);
		if (isset($_GET['url'])) {
			$newComUrl = $_GET['url'];
		$checkComs = mysqli_query($conn, "SELECT * FROM coms WHERE comurl = '$newComUrl' ORDER BY comtime DESC") or die(mysqli_error($conn));
		}
		else if (isset($_GET['global'])) {
			$checkComs = mysqli_query($conn, "SELECT * FROM coms ORDER BY comtime DESC") or die(mysqli_error($conn));	
		}
		else if (isset($_GET['top'])) {
			$checkComs = mysqli_query($conn, "SELECT * FROM coms ORDER BY comcredit DESC") or die(mysqli_error($conn));	
		}
		else {
			$checkFollow = mysqli_query($conn, "SELECT * FROM users WHERE charid = '$logId'") or die(mysqli_error($conn));
			while($row = mysqli_fetch_array( $checkFollow )) {
				$followList = $row['following'];
		}
		$checkComs = mysqli_query($conn, "SELECT * FROM coms WHERE $followList ORDER BY comtime DESC") or die(mysqli_error($conn));	
		}
		while($row = mysqli_fetch_array( $checkComs )) {
			$comsId = $row['nodeid'];
			$comsUser = $row['comuser'];
			$comsPost = $row['compost'];
			$comsIPNew = $row['comip'];
			$comsTimeNew = $row['comtime'];
			$comsCodeNew = $row['comcode'];
			$comsCodeUrl = $row['comurl'];
			$comsCreditNew = $row['comcredit'];
			$encMake = hash('sha256', ($comsId.$comsIPNew));
			$encMake = substr($encMake, 0, 6);
			$comsPost = htmlspecialchars($comsPost);
			$makeLinks = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
			$comsPost = preg_replace($makeLinks, '<a href="$0" target="_blank" title="$0" style="color:#4169E1;">$0</a>', $comsPost);
			$comsPost = nl2br($comsPost, ENT_QUOTES);
			$againChar = mysqli_query($connTemp, "SELECT * FROM users WHERE charid = '$comsId'") or die(mysqli_error($conn));
			while($row = mysqli_fetch_array( $againChar )) {
				$myCharId1 = $row['charid'];
				$myCharName1 = $row['charname'];
				$myCharMoney1 = $row['currency'];
				$myCharEXP1 = $row['experience'];
				$myCharImage1 = $row['charimage'];
				$thisCharId = $row['id'];
				$myCharLevel1 = (($myCharEXP1 / 1000)*($myCharMoney1 / 1000));
				$myCharBio = $row['bio'];
				$myCharBio = htmlspecialchars($myCharBio);			
				$myCharYT = $row['yturl'];
				$myCharYT = htmlspecialchars($myCharYT);
				$myCharTwit = $row['twiturl'];
				$myCharTwit = htmlspecialchars($myCharTwit);
				$myCharTwitch = $row['twitchurl'];
				$myCharTwitch = htmlspecialchars($myCharTwitch);
				$myCharGab = $row['gaburl'];
				$myCharGab = htmlspecialchars($myCharGab);
				$myCharMinds = $row['mindsurl'];
				$myCharMinds = htmlspecialchars($myCharMinds);
				$myCharFacebook = $row['facebookurl'];
				$myCharFacebook = htmlspecialchars($myCharFacebook);
				$myCharDiscord = $row['discordurl'];
				$myCharDiscord = htmlspecialchars($myCharDiscord);
				$myCharReddit = $row['redditurl'];
				$myCharReddit = htmlspecialchars($myCharReddit);
				$myCharPeriscope = $row['periscopeurl'];
				$myCharPeriscope = htmlspecialchars($myCharPeriscope);
				$myCharInstagram = $row['instagramurl'];
				$myCharInstagram = htmlspecialchars($myCharInstagram);
				$myCharPatreon = $row['patreonurl'];
				$myCharPatreon = htmlspecialchars($myCharPatreon);
				$myCharPaypal = $row['paypalurl'];
				$myCharPaypal = htmlspecialchars($myCharPaypal);
				$myCharPersonal = $row['personalurl'];
				$myCharPersonal = htmlspecialchars($myCharPersonal);		
				}
			$thisResult = mysqli_query($conn, "select count(1) FROM users WHERE following LIKE '%id = $thisCharId%'");
			$thisRow = mysqli_fetch_array($thisResult);
			$thisFollowCount = $thisRow[0];
			$content = $comsPost;
			$matches = NULL;
			$pattern = '/(?:http|https|ftp):\/\/\S+\.(?:jpg|jpeg|png|gif)/';
			preg_match ($pattern, $content, $matches);
			$preImage = implode($matches);
			$preVideo = getYoutubeEmbedUrl($comsPost);
			echo "<center><table class='table-results' style='width:26%; margin:1px; float:left;'><th style='font-size:1.2em; width:15%;color:#3A5ECA; max-width: 15%; overflow-wrap: break-word; word-break: break-word; vertical-align:top;' colspan='13'>
			
			<i style='float:left; padding-right:8px;' title='Image'><img src='./images/user/".$myCharImage1."' alt='".$myCharImage1."' width='65px' height='65px' style='border: 1px solid #3A5ECA;'></img></i>
			
			<a href='./?u=".htmlspecialchars($myCharName1)."' title='User profile' target='_self'><font size='3'>".htmlspecialchars($myCharName1)."</font></a>
			
			<i style='float:right;' title='Level'><font size='3' color='#000'>".$myCharLevel1."</font> <i class='fas fa-level-up-alt'></i></i><br />
			
			<i style='float:right;' title='Karma'><font size='3' color='#000'> ".$myCharMoney1."</font> <i class='far fa-hand-paper'></i></i><br />
			
			<i style='float:left;' title='Followers'><i class='fas fa-link'></i><font size='3' color='#000'>".number_format($thisFollowCount)."</font></i><i style='float:right;' title='Experience'><font size='3' color='#000'> ".$myCharEXP1."</font> <i class='fas fa-flask'></i></i>
			
			</th>";
			if (!empty($myCharBio)){
				echo "<tr style='overflow-wrap: break-word; word-break: break-word; vertical-align:top; max-height:100px;'><td colspan='13'>";
				echo "<i style='float:left;' title='Bio'><font size='4' color='#14171a'>".$myCharBio."</font></i>";
				echo "</td></tr>";
				}
			echo "<tr height='40px;'>";
			if (!empty($myCharYT)){
				echo "<td style='padding:0px; margin:0px; border:none;box-shadow:none; background-color:transparent;'><center><a href='https://www.youtube.com/channel/".$myCharYT."' title='YouTube' target='_blank' style='color:#ff0000; text-shadow: 1px 1px 1px #000;'><i class='fab fa-youtube' style='padding-left: 0px; padding-right: 0px; font-size: 120%;'></i></a></center></td>";
				}
			if (!empty($myCharTwit)){
				echo "<td style='padding:0px; margin:0px; border:none;box-shadow:none; background-color:transparent;'><center><a href='https://twitter.com/".$myCharTwit."' title='Twitter' target='_blank' style='color:#38A1F3; text-shadow: 1px 1px 1px #000;'><i class='fab fa-twitter' style='padding-left: 0px; padding-right: 0px; font-size: 120%;'></i></a></center></td>";
				}
			if (!empty($myCharTwitch)){
				echo "<td style='padding:0px; margin:0px; border:none;box-shadow:none; background-color:transparent;'><center><a href='".$myCharTwitch."' title='Twitch' target='_blank' style='color:#6441a5; text-shadow: 1px 1px 1px #000;'><i class='fab fa-twitch' style='padding-left: 0px; padding-right: 0px; font-size: 120%;'></i></a></center></td>";
				}
			if (!empty($myCharGab)){
				echo "<td style='padding:0px; margin:0px; border:none;box-shadow:none; background-color:transparent;'><center><a href='".$myCharGab."' title='Gab' target='_blank' style='color:#00d178; text-shadow: 1px 1px 1px #000;'><i class='fas fa-frog' style='padding-left: 0px; padding-right: 0px; font-size: 120%;'></i></a></center></td>";
				}
			if (!empty($myCharMinds)){
				echo "<td style='padding:0px; margin:0px; border:none;box-shadow:none; background-color:transparent;'><center><a href='".$myCharMinds."' title='Minds' target='_blank' style='color:#fed12f; text-shadow: 1px 1px 1px #000;'><i class='fas fa-lightbulb' style='padding-left: 0px; padding-right: 0px; font-size: 120%;'></i></a></center></td>";
				}
			if (!empty($myCharFacebook)){
				echo "<td style='padding:0px; margin:0px; border:none;box-shadow:none; background-color:transparent;'><center><a href='".$myCharFacebook."' title='Facebook' target='_blank' style='color:#4267b2; text-shadow: 1px 1px 1px #000;'><i class='fab fa-facebook-square' style='padding-left: 0px; padding-right: 0px; font-size: 120%;'></i></a></center></td>";
				}
			if (!empty($myCharDiscord)){
				echo "<td style='padding:0px; margin:0px; border:none;box-shadow:none; background-color:transparent;'><center><a href='".$myCharDiscord."' title='Discord' target='_blank' style='color:#738ADB; text-shadow: 1px 1px 1px #000;'><i class='fab fa-discord' style='padding-left: 0px; padding-right: 0px; font-size: 120%;'></i></a></center></td>";
				}
			if (!empty($myCharReddit)){
				echo "<td style='padding:0px; margin:0px; border:none;box-shadow:none; background-color:transparent;'><center><a href='".$myCharReddit."' title='Reddit' target='_blank' style='color:#ff4500; text-shadow: 1px 1px 1px #000;'><i class='fab fa-reddit-square' style='padding-left: 0px; padding-right: 0px; font-size: 120%;'></i></a></center></td>";
				}
			if (!empty($myCharPeriscope)){
				echo "<td style='padding:0px; margin:0px; border:none;box-shadow:none; background-color:transparent;'><center><a href='".$myCharPeriscope."' title='Periscope' target='_blank' style='color:#40A4C4; text-shadow: 1px 1px 1px #000;'><i class='fab fa-periscope' style='padding-left: 0px; padding-right: 0px; font-size: 120%;'></i></a></center></td>";
				}
			if (!empty($myCharInstagram)){
				echo "<td style='padding:0px; margin:0px; border:none;box-shadow:none; background-color:transparent;'><center><a href='".$myCharInstagram."' title='Instagram' target='_blank' style='color:#8a3ab9; text-shadow: 1px 1px 1px #000;'><i class='fab fa-instagram' style='padding-left: 0px; padding-right: 0px; font-size: 120%;'></i></a></center></td>";
				}
			if (!empty($myCharPatreon)){
				echo "<td style='padding:0px; margin:0px; border:none;box-shadow:none; background-color:transparent;'><center><a href='".$myCharPatreon."' title='Patreon' target='_blank' style='color:#E64413; text-shadow: 1px 1px 1px #000;'><i class='fab fa-patreon' style='padding-left: 0px; padding-right: 0px; font-size: 120%;'></i></a></center></td>";
				}
			if (!empty($myCharPaypal)){
				echo "<td style='padding:0px; margin:0px; border:none;box-shadow:none; background-color:transparent;'><center><a href='".$myCharPaypal."' title='PayPal' target='_blank' style='color:#253B80; text-shadow: 1px 1px 1px #000;'><i class='fab fa-paypal' style='padding-left: 0px; padding-right: 0px; font-size: 120%;'></i></a></center></td>";
				}
			if (!empty($myCharPersonal)){
				echo "<td style='padding:0px; margin:0px; border:none;box-shadow:none; background-color:transparent;'><center><a href='".$myCharPersonal."' title='Website' target='_blank' style='color:#14171a; text-shadow: 1px 1px 1px #000;'><i class='fas fa-external-link-square-alt' style='padding-left: 0px; padding-right: 0px; font-size: 120%;'></i></a></center></td>";
				}
			echo "</tr>";
			echo "</table>";
			echo "<table class='table-results' style='width:73%; margin:1px; float:right;'><th style='color:#000; font-size:1.5em; max-width: 60%; overflow-wrap: break-word; word-break: break-word;'>";
			if (!empty($comsCodeUrl)){
				echo "<i style='float:right; font-size:0.6em; color:#3A5ECA;'><a href='./?nid=".$logId."&url=".$comsCodeUrl."' title='Load URL comments?' target='_blank'>Archive Link</a> | ".$comsTimeNew."</i>";
				}
			else {
				echo "<i style='float:right; font-size:0.6em; color:#3A5ECA;'>".$comsTimeNew."</i>";		
				}
			if (!empty($preVideo)){
				$preVideoMake = substr($preVideo, strrpos($preVideo, '/') + 1);
				echo '<center><div class="stubsize" style="border: 2px solid #3A5ECA; border-radius: 6px; margin-top:10px; margin-bottom:10px;"><div class="youtube" data-embed="'.$preVideoMake.'"><div class="play-button" style="border: 2px solid #3A5ECA; border-radius: 6px; margin-top:10px; margin-bottom:10px;"></div></div></div></center>';
				}
			if (!empty($preImage)){
				echo "<center><img src='".$preImage."' alt='".$preImage."' width='98%;' style='border: 2px solid #3A5ECA; height: 60vh; border-radius: 6px; margin-top:10px; margin-bottom:10px;'></img></center>";
				}
			echo "<p style='margin-left: 5px;'>".$comsPost."</p></th></table></center>";
			echo "<script>function myReply_".$comsCodeNew."() {var x = document.getElementById('reply-box".$comsCodeNew."');if (x.style.display === 'none') {x.style.display = 'inline';}else {x.style.display = 'none';}}</script>";
			echo '<script>function makeRate'.$comsCodeNew.'() {var $scores = $("#scores");var new_rate_node = document.getElementById("new_rate_node'.$comsCodeNew.'").value;var new_rate_code = document.getElementById("new_rate_code'.$comsCodeNew.'").value;var new_rate_id = document.getElementById("new_rate_id'.$comsCodeNew.'").value;var new_rate_user = document.getElementById("new_rate_user'.$comsCodeNew.'").value;if(new_rate_node && new_rate_code && new_rate_id && new_rate_user) {$.ajax({type: "post",url: "rate.php",data:{new_rate_node:new_rate_node,new_rate_code:new_rate_code,new_rate_id:new_rate_id,new_rate_user:new_rate_user},success: function (response){location.reload(true);}});}return false;}</script>';
			echo "<center><table class='table-results' style='width:73%; margin:1px; float:right;'><th style='color:#000; font-size:1.5em; max-width: 60%; overflow-wrap: break-word; word-break: break-word;'>";
			echo "<button onclick='myReply_".$comsCodeNew."()' style='border:none; background-color: transparent; outline: none; padding-left:5px; padding-right:5px; float:left;' title='Load comments for this post?'><i style='font-size:3.2em; color:#3A5ECA; padding: 0;' class='fas fa-comments'></i></button>";
			echo '<form action="" method="post" onsubmit="return makeRate'.$comsCodeNew.'();" id="form'.$comsCodeNew.'>';
			echo '<input type="" value="" name="" id="">';
			echo '<input type="hidden" value="'.$comsId.'" name="new_rate_node" id="new_rate_node'.$comsCodeNew.'">';
			echo '<input type="hidden" value="'.$comsCodeNew.'" name="new_rate_code" id="new_rate_code'.$comsCodeNew.'">';
			echo '<input type="hidden" value="'.$logId.'" name="new_rate_id" id="new_rate_id'.$comsCodeNew.'">';
			echo '<input type="hidden" value="'.$comsUser.'" name="new_rate_user" id="new_rate_user'.$comsCodeNew.'">';
			echo '<input style="border:none; background-color: transparent; outline: none; padding-left:5px; padding-right:5px; float:right; color:#3A5ECA; font-size:1.5em;"class="fa" id="submit1'.$comsCodeNew.'" type="submit" value="&#xf256;" title="Give 1 Karma?">';
			echo "</form>";
			echo "<i style='border:none; background-color: transparent; outline: none; padding-left:5px; padding-right:5px; float:right;'>".$comsCreditNew."</i>";
			echo "<i style='border:none; background-color: transparent; outline: none; padding-left:5px; padding-right:5px; float:right;'><a href='./?post=".$comsCodeNew."' target='_blank' title='Copy this link to share this post'><i class='fas fa-share-square'></i></a></i>";
			echo "<div style='display:none;' id='rate-box".$comsCodeNew."'>Rate!</div>";
			echo "</th></table></center>";
			echo "<a name='posted".$comsCodeNew."'></a><div style='display:none;' id='reply-box".$comsCodeNew."'>";
			echo "<center><table class='table-results' style='width:73%; margin:1px; float:right;'><th style='color:#000; font-size:1.5em; max-width: 60%; overflow-wrap: break-word; word-break: break-word; border: 2px solid #e5eeff;'>";
			echo "<center><table class='table-results' style='width:99.8%;'>";
			echo '<form action="" method="post" onsubmit="return makeReply'.$comsCodeNew.'();" id="form'.$comsCodeNew.'">';
			echo '<input type="hidden" value="'.$newIP.'" name="new_rep_ip" id="new_rep_ip'.$comsCodeNew.'">';
			echo '<input type="hidden" value="'.$logId.'" name="new_rep_id" id="new_rep_id'.$comsCodeNew.'">';
			echo '<input type="hidden" value="'.$comsCodeNew.'" name="new_com_num" id="new_com_num'.$comsCodeNew.'">';
			echo "<tr>";
			echo '<td style="width:100%;"><center><textarea style="width:100%; box-sizing: border-box; resize: vertical; padding:0.5%;" rows="8" cols="50" placeholder="Reply Post: (required)" name="new_rep_post" id="new_rep_post'.$comsCodeNew.'" minlength="3" maxlength="1000" required></textarea></center></td>';
			echo "</tr></table></center>";
			echo "<center><table class='table-results' style='width:99.8%;'>";
			echo "<tr>";
			echo '<td style="width:10%;">';
			if (isset($comsUser)){
				echo '<input type="hidden" value="'.$comsUserNew.'" name="new_rep_user" id="new_rep_user'.$comsCodeNew.'">';
				echo "<h2><font size='1'>".htmlspecialchars($comsUserNew)."</font></h2>";
				}
			else {
				echo '<input style="width:100%;" class="fa" id="submit'.$comsCodeNew.'" type="text" value="" placeholder="Name" name="new_rep_user" minlength="3" maxlength="20" required>';
				}
			echo '</td>';
			echo '<td><input style="width:100%;"class="fa" id="submit'.$comsCodeNew.'" type="submit" value="&#xf075;"></form></td>';
			echo "</tr></table></center>";
			echo '<script>function makeReply'.$comsCodeNew.'() {var $scores = $("#scores");var new_rep_user = document.getElementById("new_rep_user'.$comsCodeNew.'").value;var new_rep_ip = document.getElementById("new_rep_ip'.$comsCodeNew.'").value;var new_rep_post = document.getElementById("new_rep_post'.$comsCodeNew.'").value;var new_rep_id = document.getElementById("new_rep_id'.$comsCodeNew.'").value;var new_com_num = document.getElementById("new_com_num'.$comsCodeNew.'").value;if(new_rep_user && new_rep_ip && new_rep_post && new_rep_id && new_com_num){$.ajax({type: "post",url: "reply.php",data:{new_rep_user:new_rep_user,new_rep_ip:new_rep_ip,new_rep_post:new_rep_post,new_rep_id:new_rep_id,new_com_num:new_com_num},success: function (response){location.reload(true);}});}return false;}</script>';
			$checkReps = mysqli_query($conn, "SELECT * FROM replies WHERE comnum = '$comsCodeNew' ORDER BY comtime DESC") or die(mysqli_error($conn));
			while($row = mysqli_fetch_array( $checkReps )) {
				$comsId1 = $row['nodeid'];
				$comsUser1 = $row['comuser'];
				$comsPost1 = $row['compost'];
				$comsIPNew1 = $row['comip'];
				$comsTimeNew1 = $row['comtime'];
				$comsCodeNew1 = $row['comcode'];
				$encMake1 = hash('sha256', ($comsId1.$comsIPNew1));
				$encMake1 = substr($encMake1, 0, 6);
				$comsPost1 = htmlspecialchars($comsPost1);
				$makeLinks1 = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
				$comsPost1 = preg_replace($makeLinks1, '<a href="$0" target="_blank" title="$0" style="color:#4169E1;">$0</a>', $comsPost1);
				$comsPost1 = nl2br($comsPost1, ENT_QUOTES);
				$againCharTwo = mysqli_query($connTemp, "SELECT charid,charname,currency,experience,charimage,id FROM users WHERE charid = '$comsId1'") or die(mysqli_error($conn));
				while($row = mysqli_fetch_array( $againCharTwo )) {
					$myCharId2 = $row['charid'];
					$myCharName2 = $row['charname'];
					$myCharMoney2 = $row['currency'];
					$myCharEXP2 = $row['experience'];
					$myCharImage2 = $row['charimage'];
					$thisCharId2 = $row['id'];
					$myCharLevel2 = (($myCharEXP2 / 1000)*($myCharMoney2 / 1000));
					}
				$thisResult1 = mysqli_query($conn, "select count(1) FROM users WHERE following LIKE '%id = $thisCharId2%'");
				$thisRow1 = mysqli_fetch_array($thisResult1);
				$thisFollowCount1 = $thisRow1[0];
				$content1 = $comsPost1;
				$matches1 = NULL;
				$pattern1 = '/(?:http|https|ftp):\/\/\S+\.(?:jpg|jpeg|png|gif)/';
				preg_match ($pattern1, $content1, $matches1);
				$preImage1 = implode($matches1);
				$preVideo1 = getYoutubeEmbedUrl($comsPost1);
				echo "<center><table class='table-results' style='width:26%; margin:1px; float:left;'><th style='font-size:1.2em; width:15%;color:#3A5ECA; max-width: 15%; overflow-wrap: break-word; word-break: break-word; vertical-align:top;'>
				
				<i style='float:left; padding-right:8px; title='Image''><img src='./images/user/".$myCharImage2."' alt='".$myCharImage2."' width='65px' height='65px' style='border: 1px solid #3A5ECA;'></img></i>
			
				<a href='./?u=".htmlspecialchars($myCharName2)."' title='User profile' target='_self'><font size='3'>".htmlspecialchars($myCharName2)."</font></a>
			
				<i style='float:right;' title='Level'><font size='3' color='#000'>".$myCharLevel2."</font> <i class='fas fa-level-up-alt'></i></i><br />
			
				<i style='float:right;' title='Karma'><font size='3' color='#000'> ".$myCharMoney2."</font> <i class='far fa-hand-paper'></i></i><br />
			
				<i style='float:left;' title='Followers'><i class='fas fa-link'></i><font size='3' color='#000'>".number_format($thisFollowCount1)."</font></i><i style='float:right;' title='Experience'><font size='3' color='#000'> ".$myCharEXP2."</font> <i class='fas fa-flask'></i></i>
				
				</th></table>";
				echo "<table class='table-results' style='width:73%; margin:1px; float:right;'><th style='color:#000; font-size:1.5em; max-width: 60%; overflow-wrap: break-word; word-break: break-word;'>";
				if (!empty($comsCodeUrl)){
					echo "<i style='float:right; font-size:0.6em; color:#3A5ECA;'><a href='./?nid=".$logId."&url=".$comsCodeUrl."' title='Load URL comments?' target='_blank'>Archive Link</a> | ".$comsTimeNew1."</i>";
					}
				else {
					echo "<i style='float:right; font-size:0.6em; color:#3A5ECA;'>".$comsTimeNew1."</i>";		
					}
				if (!empty($preVideo1)){
					$preVideoMake1 = substr($preVideo1, strrpos($preVideo1, '/') + 1);
					echo '<center><div class="stubsize" style="border: 2px solid #3A5ECA; border-radius: 6px; margin-top:10px; margin-bottom:10px;"><div class="youtube" data-embed="'.$preVideoMake1.'"><div class="play-button" style="border: 2px solid #3A5ECA; border-radius: 6px; margin-top:10px; margin-bottom:10px;"></div></div></div></center>';
					}
				if (!empty($preImage1)){
					echo "<center><img src='".$preImage1."' alt='".$preImage1."' width='98%;' style='border: 2px solid #3A5ECA; height: 60vh; border-radius: 6px; margin-top:10px; margin-bottom:10px;'></img></center>";
					}
				echo "<p style='margin-left: 5px;'>".$comsPost1."</p></th></table></center>";
				echo "<table style='opacity:0;'><th></th></table>";
				}
			echo "<center><table class='table-results' style='width:99.8%;'>";
			echo "</table></center>";
			echo "</th></table></center>";
			echo "</div>";
			echo "<table style='opacity:0;'><th></th></table>";
			}
		$conn->close();
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
echo '<script>( function() {var youtube = document.querySelectorAll( ".youtube" );for (var i = 0; i < youtube.length; i++) {var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed +"/0.jpg";var image = new Image();image.src = source;image.addEventListener( "load", function() {youtube[ i ].appendChild( image );}( i ) );youtube[i].addEventListener( "click", function() {var iframe = document.createElement( "iframe" );iframe.setAttribute( "frameborder", "0" );iframe.setAttribute( "allowfullscreen", "" );iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ this.dataset.embed +"?rel=0&showinfo=0&autoplay=1" );this.innerHTML = "";this.appendChild( iframe );} ); };} )();</script>';
echo "</div>";
?>