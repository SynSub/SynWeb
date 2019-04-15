<?php

/**
 * SynWeb 1.3 : Top Posts Module
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

function getYoutubeEmbedUrl($url) {
	$shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
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
include('./config.php');
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
$checkComs = mysqli_query($conn, "SELECT * FROM coms ORDER BY comcredit DESC") or die(mysqli_error($conn));
while($row = mysqli_fetch_array( $checkComs )) {
	$comsId = $row['nodeid'];
	$comsUser = $row['comuser'];
	$comsPost = $row['compost'];
	$comsIPNew = $row['comip'];
	$comsTimeNew = $row['comtime'];
	$comsCodeNew = $row['comcode'];
	$comsCreditNew = $row['comcredit'];
	$encMake = hash('sha256', ($comsId.$comsIPNew));
	$encMake = substr($encMake, 0, 6);
	$comsPost = htmlspecialchars($comsPost);
	$makeLinks = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
	$comsPost = preg_replace($makeLinks, '<a href="http$2://$4" target="_blank" title="$0" style="color:#4169E1;">$0</a>', $comsPost);
	$comsPost = nl2br($comsPost, ENT_QUOTES);
	$againChar = mysqli_query($conn, "SELECT charid,charname,currency,experience,charimage FROM users WHERE charid = '$comsId'") or die(mysqli_error($conn));
	while($row = mysqli_fetch_array( $againChar )) {
		$myCharId1 = $row['charid'];
		$myCharName1 = $row['charname'];
		$myCharMoney1 = $row['currency'];
		$myCharEXP1 = $row['experience'];
		$myCharImage1 = $row['charimage'];
		$myCharLevel1 = (($myCharEXP1 / 1000)*($myCharMoney1 / 1000));
		}
	$content = $comsPost;
	$matches = NULL;
	$pattern = '/(?:http|https|ftp):\/\/\S+\.(?:jpg|jpeg|png|gif)/';
	preg_match ($pattern, $content, $matches);
	$preImage = implode($matches);
	$preVideo = getYoutubeEmbedUrl($comsPost);
	echo "<center><table class='table-results' style='width:99.8%; margin:1px;'><th style='font-size:1.2em; width:15%;color:#3A5ECA; max-width: 15%; overflow-wrap: break-word; word-break: break-word; vertical-align:top;'>
			
	<i style='float:left; padding-right:8px;'><img src='./images/user/".$myCharImage1."' alt='".$myCharImage1."' width='65px' height='65px' style='border: 1px solid #3A5ECA;'></img></i>
			
	<a href='./?u=".htmlspecialchars($myCharName1)."' title='User profile' target='_self'><font size='3'>".htmlspecialchars($myCharName1)."</font></a>
			
	<i style='float:right;'><font size='3' color='#000'>".$myCharLevel1."</font> <i class='fas fa-level-up-alt'></i></i><br />
			
	<i style='float:right;'><font size='3' color='#000'> ".$myCharMoney1."</font> <i class='far fa-hand-paper'></i></i><br />
			
	<i style='float:right;'><font size='3' color='#000'> ".$myCharEXP1."</font> <i class='fas fa-flask'></i></i>
	
	</th></table></center>";
	echo "<center><table class='table-results' style='width:99.8%; margin:1px;'><th style='width:15%; color:#000; font-size:1.5em; max-width: 15%; overflow-wrap: break-word; word-break: break-word;'>";
	if (!empty($preVideo)){
		$preVideoMake = substr($preVideo, strrpos($preVideo, '/') + 1);
		echo '<center><table class="table-results" style="width:99.8%; margin:1px;"><th><center><div class="stubsize" style="border: 2px solid #3A5ECA; border-radius: 6px; margin-top:10px; margin-bottom:10px;"><div class="youtube" data-embed="'.$preVideoMake.'"><div class="play-button" style="border: 2px solid #3A5ECA; border-radius: 6px; margin-top:10px; margin-bottom:10px;"></div></div></div></center></th></table></center><br />';
		}
	if (!empty($preImage)){
		echo "<center><table class='table-results' style='width:99.8%; margin:1px;'><th><center><img src='".$preImage."' alt='".$preImage."' style='border: 2px solid #3A5ECA; height: auto; width:66vw; border-radius: 6px; margin-top:10px; margin-bottom:10px;'></img></center></th></table></center><br />";
		}
	echo "<i style='float:right; font-size:0.5em; color:#3A5ECA;'>".$comsTimeNew."</i><p style='margin-left: 10px;'>".$comsPost."</p></th></table></center>";
	echo "<script>function myReply_".$comsCodeNew."() {var x = document.getElementById('reply-box".$comsCodeNew."');if (x.style.display === 'none') {x.style.display = 'inline';}else {x.style.display = 'none';}}</script>";
	echo '<script>function makeRate'.$comsCodeNew.'() {var $scores = $("#scores");var new_rate_node = document.getElementById("new_rate_node'.$comsCodeNew.'").value;var new_rate_code = document.getElementById("new_rate_code'.$comsCodeNew.'").value;var new_rate_id = document.getElementById("new_rate_id'.$comsCodeNew.'").value;var new_rate_user = document.getElementById("new_rate_user'.$comsCodeNew.'").value;if(new_rate_node && new_rate_code && new_rate_id && new_rate_user) {$.ajax({type: "post",url: "rate.php",data:{new_rate_node:new_rate_node,new_rate_code:new_rate_code,new_rate_id:new_rate_id,new_rate_user:new_rate_user},success: function (response){location.reload(true);}});}return false;}</script>';
	$logId = $comsId;
	echo "<center><table class='table-results' style='width:99.8%; margin:1px;'><th style='color:#000; font-size:1.5em; max-width: 98%; overflow-wrap: break-word; word-break: break-word;'>";
	echo "<button onclick='myReply_".$comsCodeNew."()' style='border:none; background-color: transparent; outline: none; padding-left:5px; padding-right:5px; float:left;' title='Load comments for this post?'><i style='font-size:3.2em; color:#3A5ECA; padding: 0;' class='fas fa-comments'></i></button>";
	echo "<i style='border:none; background-color: transparent; outline: none; padding-left:5px; padding-right:5px; float:right;'>".$comsCreditNew."</i>";
	echo "<i style='border:none; background-color: transparent; outline: none; padding-left:5px; padding-right:5px; float:right;'><a href='./?post=".$comsCodeNew."' target='_blank' title='Copy this link to share this post'><i class='fas fa-share-square'></i></a></i>";
	echo "<div style='display:none;' id='rate-box".$comsCodeNew."'>Rate!</div>";
	echo "</th></table></center>";
	echo "<a name='posted".$comsCodeNew."'></a><div style='display:none;' id='reply-box".$comsCodeNew."'>";
	echo "<center><table class='table-results' style='width:99.8%; margin:1px;'><th style='color:#000; font-size:1.5em; max-width: 60%; overflow-wrap: break-word; word-break: break-word; border: 2px solid #fff;'>";
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
		$makeLinks1 = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
		$comsPost1 = preg_replace($makeLinks1, '<a href="http$2://$4" target="_blank" title="$0" style="color:#4169E1;">$0</a>', $comsPost1);
		$comsPost1 = nl2br($comsPost1, ENT_QUOTES);
		$againCharTwo = mysqli_query($conn, "SELECT charid,charname,currency,experience,charimage FROM users WHERE charid = '$comsId1'") or die(mysqli_error($conn));
		while($row = mysqli_fetch_array( $againCharTwo )) {
			$myCharId2 = $row['charid'];
			$myCharName2 = $row['charname'];
			$myCharMoney2 = $row['currency'];
			$myCharEXP2 = $row['experience'];
			$myCharImage2 = $row['charimage'];
			$myCharLevel2 = (($myCharEXP2 / 1000)*($myCharMoney2 / 1000));
			}
		$content1 = $comsPost1;
		$matches1 = NULL;
		$pattern1 = '/(?:http|https|ftp):\/\/\S+\.(?:jpg|jpeg|png|gif)/';
		preg_match ($pattern1, $content1, $matches1);
		$preImage1 = implode($matches1);
		$preVideo1 = getYoutubeEmbedUrl($comsPost1);
		echo "<center><table class='table-results' style='width:98%; margin:1px;'><th style='font-size:1.2em; width:15%;color:#3A5ECA; max-width: 15%; overflow-wrap: break-word; word-break: break-word; vertical-align:top;'>
				
		<i style='float:left; padding-right:8px;'><img src='./images/user/".$myCharImage2."' alt='".$myCharImage2."' width='65px' height='65px' style='border: 1px solid #3A5ECA;'></img></i>
			
		<a href='./?u=".htmlspecialchars($myCharName2)."' title='User profile' target='_self'><font size='3'>".htmlspecialchars($myCharName2)."</font></a>
			
		<i style='float:right;'><font size='3' color='#000'>".$myCharLevel2."</font> <i class='fas fa-level-up-alt'></i></i><br />
			
		<i style='float:right;'><font size='3' color='#000'> ".$myCharMoney2."</font> <i class='far fa-hand-paper'></i></i><br />
			
		<i style='float:right;'><font size='3' color='#000'> ".$myCharEXP2."</font> <i class='fas fa-flask'></i></i>
		
		</th></table></center>";
		echo "<center><table class='table-results' style='width:98%; margin:1px;'><th style='width:15%; color:#000; font-size:1.5em; max-width: 15%; overflow-wrap: break-word; word-break: break-word;'>";
		if (!empty($preVideo1)){
			$preVideoMake1 = substr($preVideo1, strrpos($preVideo1, '/') + 1);
			echo '<center><div class="stubsize" style="border: 2px solid #3A5ECA; border-radius: 6px; margin-top:10px; margin-bottom:10px;"><div class="youtube" data-embed="'.$preVideoMake1.'"><div class="play-button" style="border: 2px solid #3A5ECA; border-radius: 6px; margin-top:10px; margin-bottom:10px;"></div></div></div></center><br />';
			}
		if (!empty($preImage1)){
			echo "<center><img src='".$preImage1."' alt='".$preImage1."' width='98%;' style='border: 2px solid #3A5ECA; height: 30vh; border-radius: 6px; margin-top:10px; margin-bottom:10px;'></img></center>";
			}
		echo "<i style='float:right; font-size:0.5em; color:#3A5ECA;'>".$comsTimeNew1."</i><p style='margin-left: 10px;'>".$comsPost1."</p></th></table></center>";
		echo "<table style='opacity:0;'><th></th></table>";
		}
	echo "<center><table class='table-results' style='width:99.8%;'>";
	echo "</table></center>";
	echo "</th></table></center>";
	echo "</div>";
	echo "<table style='opacity:0;'><th></th></table>";
	}
$conn->close();
echo '<script>( function() {var youtube = document.querySelectorAll( ".youtube" );for (var i = 0; i < youtube.length; i++) {var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed +"/0.jpg";var image = new Image();image.src = source;image.addEventListener( "load", function() {youtube[ i ].appendChild( image );}( i ) );youtube[i].addEventListener( "click", function() {var iframe = document.createElement( "iframe" );iframe.setAttribute( "frameborder", "0" );iframe.setAttribute( "allowfullscreen", "" );iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ this.dataset.embed +"?rel=0&showinfo=0&autoplay=1" );this.innerHTML = "";this.appendChild( iframe );} );};} )();</script>';
?>