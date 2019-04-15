<?php

/**
 * SynWeb 1.3 : User Profile Module
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

require_once('./modules/TwitterAPIExchange.php');
require_once('./modules/TwitterTextFormatter.php');
error_reporting(E_ERROR | E_PARSE);
use Netgloo\TwitterTextFormatter;
function getYTList_scan($api_url_scan) {
	$arr_result_scan = json_decode(file_get_contents($api_url_scan));
	if (isset($arr_result_scan->items) && !empty($arr_result_scan->items)) {
		$_SESSION['userScan'][] = $arr_result_scan->items;
		}
	return $_SESSION['userScan'];
	}
function channelsList($api_url) {
	$arr_result = json_decode(file_get_contents($api_url));
	if (isset($arr_result->items) && !empty($arr_result->items)) {
		$_SESSION['newChannel'][] = $arr_result->items;
		}
	return $_SESSION['newChannel'];
	}
function getYTList2($api_url2) {
	$arr_result2 = json_decode(file_get_contents($api_url2));
	if (isset($arr_result2->items) && !empty($arr_result2->items)) {
		$_SESSION['mylistchat'][] = $arr_result2->items;
		}
	return $_SESSION['mylistchat'];
	}
function getYTList1($api_url1) {
	$arr_result1 = json_decode(file_get_contents($api_url1));
	if (isset($arr_result1->items) && !empty($arr_result1->items)) {
		$_SESSION['mylist1'][] = $arr_result1->items;
		}
	return $_SESSION['mylist1'];
	}
function getYTList($api_url) {
	$arr_result = json_decode(file_get_contents($api_url));
	if (isset($arr_result->items) && !empty($arr_result->items)) {
		$_SESSION['mylist'][] = $arr_result->items;
		}
	return $_SESSION['mylist'];
	}
function newChannelScan($api_url) {
	$arr_result = json_decode(file_get_contents($api_url));
	if (isset($arr_result->items) && !empty($arr_result->items)) {
		$_SESSION['newChannelScan'][] = $arr_result->items;
		}
	return $_SESSION['newChannelScan'];
	}
function time_elapsed_string($datetime, $full = false) {
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);
	$diff->w = floor($diff->d / 7);
	$diff->d = $diff->w * 7;
	$string = array(
		'y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',
		);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			}
		else {
			unset($string[$k]);
			}
		}
	if (!$full) $string = array_slice($string, 0, 1);
	return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
if (isset($charId)) {
	include('./config.php');
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
	mysqli_real_escape_string($conn, $charId);
	$reChar = mysqli_query($conn, "SELECT * FROM users WHERE charname = '$charId'") or die(mysqli_error($conn));
	while($row = mysqli_fetch_array( $reChar )) {
		$myCharId = $row['charid'];
		$myCharName = $row['charname'];
		$myCharMoney = $row['currency'];
		$myCharEXP = $row['experience'];
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
	$conn->close();
	}
else {
	echo "No user selected!!";
	die();
	}
if (isset($myCharId)){
	echo "<center><table class='table-results' style='width:99.8%;'>";
	echo "<th><i style='float:right;'><font size='2' color='#000'><a href='./?u=".$myCharName."' target='_blank' title='Share this link!'>".$myCharName."</a></font></i><i style='float:left;'><font size='2' color='#000' style='float:left;'><font size='4' color='#4169E1'>".$myCharName."</font></i></th>";
	echo "</table></center>";
	}
else {
	echo "No data returned!";
	}
if (!empty($myCharBio)){
	echo "<center><table class='table-results' style='width:99.8%;'>";
	echo "<tr style='overflow-wrap: break-word; word-break: break-word; vertical-align:top; max-height:100px;'><td>";
	echo "<i style='float:left;' title='Bio'><font size='4' color='#14171a'>".$myCharBio."</font></i>";
	echo "</td></tr>";
	echo "</table></center>";
	}
echo "<center><table class='table-results' style='width:99.8%;'>";
if (!empty($mobTrue)){
	if (!empty($myCharTwitch)){
		echo "<th width='9%'><center><a href='".$myCharTwitch."' title='Twitch' target='_blank' style='color:#6441a5; text-shadow: 1px 1px 1px #000;'><i class='fab fa-twitch' style='padding-left: 0px; padding-right: 0px; font-size: 100%;'></i></a></center></th>";
		}
	if (!empty($myCharGab)){
		echo "<th width='9%'><center><a href='".$myCharGab."' title='Gab' target='_blank' style='color:#00d178; text-shadow: 1px 1px 1px #000;'><i class='fas fa-frog' style='padding-left: 0px; padding-right: 0px; font-size: 100%;'></i></a></center></th>";
		}
	if (!empty($myCharMinds)){
		echo "<th width='9%'><center><a href='".$myCharMinds."' title='Minds' target='_blank' style='color:#fed12f; text-shadow: 1px 1px 1px #000;'><i class='fas fa-lightbulb' style='padding-left: 0px; padding-right: 0px; font-size: 100%;'></i></a></center></th>";
		}
	if (!empty($myCharFacebook)){
		echo "<th width='9%'><center><a href='".$myCharFacebook."' title='Facebook' target='_blank' style='color:#4267b2; text-shadow: 1px 1px 1px #000;'><i class='fab fa-facebook-square' style='padding-left: 0px; padding-right: 0px; font-size: 100%;'></i></a></center></th>";
		}
	if (!empty($myCharDiscord)){
		echo "<th width='9%'><center><a href='".$myCharDiscord."' title='Discord' target='_blank' style='color:#738ADB; text-shadow: 1px 1px 1px #000;'><i class='fab fa-discord' style='padding-left: 0px; padding-right: 0px; font-size: 100%;'></i></a></center></th>";
		}
	if (!empty($myCharReddit)){
		echo "<th width='9%'><center><a href='".$myCharReddit."' title='Reddit' target='_blank' style='color:#ff4500; text-shadow: 1px 1px 1px #000;'><i class='fab fa-reddit-square' style='padding-left: 0px; padding-right: 0px; font-size: 100%;'></i></a></center></th>";
		}
	if (!empty($myCharPeriscope)){
		echo "<th width='9%'><center><a href='".$myCharPeriscope."' title='Periscope' target='_blank' style='color:#40A4C4; text-shadow: 1px 1px 1px #000;'><i class='fab fa-periscope' style='padding-left: 0px; padding-right: 0px; font-size: 100%;'></i></a></center></th>";
		}
	if (!empty($myCharInstagram)){
		echo "<th width='9%'><center><a href='".$myCharInstagram."' title='Instagram' target='_blank' style='color:#8a3ab9; text-shadow: 1px 1px 1px #000;'><i class='fab fa-instagram' style='padding-left: 0px; padding-right: 0px; font-size: 100%;'></i></a></center></th>";
		}
	if (!empty($myCharPatreon)){
		echo "<th width='9%'><center><a href='".$myCharPatreon."' title='Patreon' target='_blank' style='color:#E64413; text-shadow: 1px 1px 1px #000;'><i class='fab fa-patreon' style='padding-left: 0px; padding-right: 0px; font-size: 100%;'></i></a></center></th>";
		}
	if (!empty($myCharPaypal)){
		echo "<th width='9%'><center><a href='".$myCharPaypal."' title='PayPal' target='_blank' style='color:#253B80; text-shadow: 1px 1px 1px #000;'><i class='fab fa-paypal' style='padding-left: 0px; padding-right: 0px; font-size: 100%;'></i></a></center></th>";
		}
	if (!empty($myCharPersonal)){
		echo "<th width='9%'><center><a href='".$myCharPersonal."' title='Website' target='_blank' style='color:#14171a; text-shadow: 1px 1px 1px #000;'><i class='fas fa-external-link-square-alt' style='padding-left: 0px; padding-right: 0px; font-size: 100%;'></i></a></center></th>";
		}
	}
else {
	if (!empty($myCharTwitch)){
		echo "<th width='9%'><center><a href='".$myCharTwitch."' title='Twitch' target='_blank' style='color:#6441a5; text-shadow: 1px 1px 1px #000;'><i class='fab fa-twitch' style='padding-left: 5px; padding-right: 5px; font-size: 150%;'></i></a></center></th>";
		}
	if (!empty($myCharGab)){
		echo "<th width='9%'><center><a href='".$myCharGab."' title='Gab' target='_blank' style='color:#00d178; text-shadow: 1px 1px 1px #000;'><i class='fas fa-frog' style='padding-left: 5px; padding-right: 5px; font-size: 150%;'></i></a></center></th>";
		}
	if (!empty($myCharMinds)){
		echo "<th width='9%'><center><a href='".$myCharMinds."' title='Minds' target='_blank' style='color:#fed12f; text-shadow: 1px 1px 1px #000;'><i class='fas fa-lightbulb' style='padding-left: 5px; padding-right: 5px; font-size: 150%;'></i></a></center></th>";
		}
	if (!empty($myCharFacebook)){
		echo "<th width='9%'><center><a href='".$myCharFacebook."' title='Facebook' target='_blank' style='color:#4267b2; text-shadow: 1px 1px 1px #000;'><i class='fab fa-facebook-square' style='padding-left: 5px; padding-right: 5px; font-size: 150%;'></i></a></center></th>";
		}
	if (!empty($myCharDiscord)){
		echo "<th width='9%'><center><a href='".$myCharDiscord."' title='Discord' target='_blank' style='color:#738ADB; text-shadow: 1px 1px 1px #000;'><i class='fab fa-discord' style='padding-left: 5px; padding-right: 5px; font-size: 150%;'></i></a></center></th>";
		}
	if (!empty($myCharReddit)){
		echo "<th width='9%'><center><a href='".$myCharReddit."' title='Reddit' target='_blank' style='color:#ff4500; text-shadow: 1px 1px 1px #000;'><i class='fab fa-reddit-square' style='padding-left: 5px; padding-right: 5px; font-size: 150%;'></i></a></center></th>";
		}
	if (!empty($myCharPeriscope)){
		echo "<th width='9%'><center><a href='".$myCharPeriscope."' title='Periscope' target='_blank' style='color:#40A4C4; text-shadow: 1px 1px 1px #000;'><i class='fab fa-periscope' style='padding-left: 5px; padding-right: 5px; font-size: 150%;'></i></a></center></th>";
		}
	if (!empty($myCharInstagram)){
		echo "<th width='9%'><center><a href='".$myCharInstagram."' title='Instagram' target='_blank' style='color:#8a3ab9; text-shadow: 1px 1px 1px #000;'><i class='fab fa-instagram' style='padding-left: 5px; padding-right: 5px; font-size: 150%;'></i></a></center></th>";
		}
	if (!empty($myCharPatreon)){
		echo "<th width='9%'><center><a href='".$myCharPatreon."' title='Patreon' target='_blank' style='color:#E64413; text-shadow: 1px 1px 1px #000;'><i class='fab fa-patreon' style='padding-left: 5px; padding-right: 5px; font-size: 150%;'></i></a></center></th>";
		}
	if (!empty($myCharPaypal)){
		echo "<th width='9%'><center><a href='".$myCharPaypal."' title='PayPal' target='_blank' style='color:#253B80; text-shadow: 1px 1px 1px #000;'><i class='fab fa-paypal' style='padding-left: 5px; padding-right: 5px; font-size: 150%;'></i></a></center></th>";
		}
	if (!empty($myCharPersonal)){
		echo "<th width='9%'><center><a href='".$myCharPersonal."' title='Website' target='_blank' style='color:#14171a; text-shadow: 1px 1px 1px #000;'><i class='fas fa-external-link-square-alt' style='padding-left: 5px; padding-right: 5px; font-size: 150%;'></i></a></center></th>";
		}
	}
echo "</table></center>";
if (!empty($myCharYT)) {
	$isId = $myCharYT;
	if (strlen($isId) == 24) {
		$userChannel = $isId;
		}
	else {
		die();
		}
	$liveEnabled = true;
	if (!empty($api_key)){
		$selectedKey = $api_key;
		$_SESSION['userScan'] = array();
		$url_scan = "https://www.googleapis.com/youtube/v3/search?channelId=$userChannel&part=id,snippet&type=channel&maxResults=1&key=$selectedKey";
		$arr_list_scan = getYTList_scan($url_scan);
		foreach ($arr_list_scan as $alist_scan) {
			foreach ($alist_scan as $list_scan) {
				$dumpId_scan = ($list_scan->id->channelId);
				$dumpTitle_scan = ($list_scan->snippet->title);
				$dumpTitle_scan = str_replace  ("'", "", $dumpTitle_scan);
				$dumpDescription_scan = ($list_scan->snippet->description);
				$dumpDescription_scan = str_replace  ("'", "", $dumpDescription_scan);
				$dumpImage_scan = ($list_scan->snippet->thumbnails->medium->url);
				$dumpImageHD_scan = ($list_scan->snippet->thumbnails->high->url);
				$dumpImageLD_scan = ($list_scan->snippet->thumbnails->medium->url);
				}
			}
		if (!empty($dumpImageHD_scan)){
			echo '<meta property="og:image" content="'.$dumpImageHD_scan.'"/>';
			echo '<html style="background: url(\''.$dumpImageHD_scan.'\') no-repeat; background-size: 100vw 100vh; background: linear-gradient(to bottom, rgba(255,255,255,0.8) 0%,rgba(255,255,255,0.8) 100%), url(\''.$dumpImageHD_scan.'\') no-repeat; background-size: 100vw 100vh; background-attachment: fixed;">';
			}
		if (!empty($dumpDescription_scan)){
			echo '<meta name="description" content="'.$dumpDescription_scan.' | SynSub"/>';
			echo '<meta property="og:description" content="'.$dumpDescription_scan.' | SynSub"/>';
			}
		if (isset($dumpId_scan)){
			}
		else {
			echo "Standbye Mode - Invalid YouTube Channel ID!";
			echo "<title>Standbye Mode - Invalid YouTube Channel ID!</title>";
			die();
			}
		error_reporting(E_ERROR | E_PARSE);
		if (!empty($userChannel)) {
			echo "<table class='table-results' style='width:99.8%;'><th><h1 class='fa' style='float:right;'><font size='6' style='color:#000;'><font style='font:bold 100% arial, sans-serif;' color='#000'><a href='https://www.youtube.com/channel/".$dumpId_scan."' title='".$dumpTitle_scan." on YouTube' target='_blank' style='color:#ff0000; text-shadow: 1px 1px 1px #000;'>$dumpTitle_scan</a></font></font></h1>";
			echo "</th></table>";
			}
		else {
			echo "<title>Standbye Mode - $siteHost</title>";
			die('Standbye Mode');
			}
		echo "<center><table class='table-results' style='width:99.8%;'><th>";
		echo "<center><img src='";
		echo $dumpImageHD_scan;
		echo "' alt='Preview Image' style='width: 100%; height: 70vh; border:1px solid #2f3136; -webkit-border-radius: 12px 12px 12px 12px; -moz-border-radius: 12px 12px 12px 12px; border-radius: 12px 12px 12px 12px;'></img>";
		echo "</center>";
		echo "</th></table></center>";
		echo "<center><table class='table-results' style='width:99.8%; height: auto;'>";
		echo "<th>";
		echo "<p align='left'><font style='color:#000; font: italic 1.2em arial, sans-serif;'>";
		echo $dumpDescription_scan;
		echo "</font></p>";
		echo "</th></table></center>";
		$_SESSION['newChannel'] = array();
		$url = "https://www.googleapis.com/youtube/v3/channels?part=snippet%2CcontentDetails%2Cstatistics&id=$dumpId_scan&key=$selectedKey";
		$arr_list = channelsList($url);
		foreach ($arr_list as $alist) {
			foreach ($alist as $list) {
				$newId = ($list->id);
				$newListUploads = ($list->contentDetails->relatedPlaylists->uploads);
				$newStatViews = ($list->statistics->viewCount);
				$newStatSubscribers = ($list->statistics->subscriberCount);
				$newStatVideos = ($list->statistics->videoCount);
				$tallyViews = ($newStatViews) / 10000;
				$tallySubs = ($newStatSubscribers) / 1000;
				$tallyVideos = ($newStatVideos) / 100;
				$tallyLevel = ($tallyViews + $tallySubs + $tallyVideos);
				date_default_timezone_set('UTC');
				echo "<center><table class='table-results' style='width:99.8%; height: auto;'><th>";
				echo "<p align='left'>";
				echo "<font style='color:#000; font: italic 1.2em arial, sans-serif;'><a style='float:left;' href='https://www.youtube.com/channel/";
				echo $newId;
				echo "' target='_blank' title='View channel on YouTube?'>";
				echo "<font style='color:#000; font: italic 1.2em arial, sans-serif;'><a style='float:left;' href='https://www.youtube.com/playlist?list=";
				echo $newListUploads;
				echo "' target='_blank' title='View uploaded videos on YouTube?'>";
				echo "Uploads</a></font>";
				echo "<br />";
				echo "<br /></p>";
				echo "<p align='left'>";
				echo "<font style='color:#000; font: italic 0.8em arial, sans-serif;'>Creator Level: </font><font style='color:#006621; font: italic 0.8em arial, sans-serif;'>";
				echo $english_format_number = number_format($tallyLevel);
				echo "</font><br />";
				echo "<font style='color:#000; font: italic 0.8em arial, sans-serif; '>Channel Views: </font><font style='color:#006621; font: italic 0.8em arial, sans-serif;'>";
				echo $english_format_number = number_format($newStatViews);
				echo "</font><br />";
				echo "<font style='color:#000; font: italic 0.8em arial, sans-serif;'>Channel Subscribers: </font><font style='color:#006621; font: italic 0.8em arial, sans-serif;'>";
				echo $english_format_number = number_format($newStatSubscribers);
				echo "</font><br />";
				echo "<font style='color:#000; font: italic 0.8em arial, sans-serif;'>Channel Videos: </font><font style='color:#006621; font: italic 0.8em arial, sans-serif;'>";
				echo $english_format_number = number_format($newStatVideos);
				echo "</font>";
				echo "<font style='color:#000; font: italic 1.3em arial, sans-serif;'><a style='float:right; background: #d9d9d9; border: 2px solid #e8e8e8; -webkit-border-radius: 12px 12px 12px 12px; -moz-border-radius: 12px 12px 12px 12px; border-radius: 12px 12px 12px 12px; padding: 2px 8px 2px 8px;' href='https://youtube.com/channel/";
				echo $newId;
				echo "?sub_confirmation=1' target='_blank' title='Subscribe to the channel?'>";
				echo "Subscribe</a></font>";
				echo "<br /></p>";
				echo "</th></table></center>";
				}
			}
		echo "<center><table class='table-results' style='width:99.8%;'><th>";
		echo "Live Streams";
		echo "</th></table></center>";
		if ($liveEnabled === true) {
			$_SESSION['mylist1'] = array();
			$url1 = "https://www.googleapis.com/youtube/v3/search?channelId=$dumpId_scan&order=viewCount&part=id,snippet&type=video&eventType=live&maxResults=20&key=$selectedKey&safeSearch=none&videoEmbeddable=true&videoSyndicated=true";
			echo "<table border='1' bgcolor='transparent' font color='#fff' size='6' class='table-results' style='width:99.8%; table-layout:fixed;'><th><font size='4' style='color: #fff;'>";
			$arr_list1 = getYTList1($url1);
			foreach ($arr_list1 as $alist1) {
				foreach ($alist1 as $list1) {
					$aVLink = ($list1->id->videoId);
					$aVTitle = ($list1->snippet->title);
					$aVTitle = htmlspecialchars($aVTitle);
					$aImage = ($list1->snippet->thumbnails->medium->url);
					$viewers = file_get_contents("https://www.youtube.com/live_stats?v=$aVLink");
					echo "<a href='https://youtu.be/".$aVLink."' title='".$aVTitle."\n\n".$viewers." watching' target='_blank'><i style='position:absolute; z-index:90; color:RoyalBlue; padding:10px; background: rgb(255,255,255); background: rgba(255,255,255,0.9); border:1px solid RoyalBlue; -webkit-border-radius: 6px 6px 6px 6px; -moz-border-radius: 6px 6px 6px 6px; border-radius: 6px 6px 6px 6px; box-shadow: 1px 1px 12px #000000, -1px -1px 12px #000000, 1px 1px 12px #000000;";
					if (!empty($mobTrue)){
						echo "margin-left:3px; margin-top:4px;";
						}
					else {
						echo "margin-left:3px; margin-top:4px;";
						}
					echo " -webkit-border-radius: 6px 6px 6px 6px; -moz-border-radius: 6px 6px 6px 6px; border-radius: 6px 6px 6px 6px; max-width:300px; font-size: 0.7em;'><strong>".$aVTitle."</strong></i><img src='$aImage' alt='Preview Image' style='";
					if (!empty($mobTrue)){
						echo "width:auto; height:30vh;";
						}
					else {
						echo "width:auto; height:34.5vh;";
						}
					echo " border:2px solid RoyalBlue; padding:0px; -webkit-border-radius: 6px 6px 6px 6px; -moz-border-radius: 6px 6px 6px 6px; border-radius: 6px 6px 6px 6px; box-shadow: 1px 1px 12px #000000, -1px -1px 12px #000000, 1px 1px 12px #000000;' id='btn-submit-search'></img></a> &nbsp; ";
					}
				}
			echo "</font></th></table>";
			}
		if ($liveEnabled === false) {
			echo "<br />";
			}
		echo "<center><table class='table-results' style='width:99.8%;'><th>";
		echo "Latest Uploads";
		echo "</th></table></center>";
		$_SESSION['mylist'] = array();
		$url = "https://www.googleapis.com/youtube/v3/search?channelId=$userChannel&order=date&part=id,snippet&type=video&maxResults=48&key=$selectedKey&safeSearch=none&videoEmbeddable=true&videoSyndicated=true";
		echo "<table border='1' bgcolor='transparent' font color='#fff' size='6' class='table-results' style='width:99.8%; table-layout:fixed;'><th><font size='4' style='color: #fff;'>";
		$arr_list = getYTList($url);
		foreach ($arr_list as $alist) {
			foreach ($alist as $list) {
				$dumpId = ($list->id->videoId);
				$dumpTitle = ($list->snippet->title);
				$dumpTitle = str_replace  ("'", "", $dumpTitle);
				$dumpDesc = ($list->snippet->description);
				$dumpDesc = str_replace  ("'", "", $dumpDesc);
				$dumpChannel = ($list->snippet->channelTitle);
				$dumpChannel = str_replace  ("'", "", $dumpChannel);
				$dumpImage = ($list->snippet->thumbnails->medium->url);
				$dumpPublished = ($list->snippet->publishedAt);
				echo "<a href='https://youtu.be/".$dumpId."' title='".$dumpTitle."\n\n".$dumpPublished."\n\n".$dumpDesc."' target='_blank'><i style='position:absolute; z-index:90; color:RoyalBlue; padding:10px; background: rgb(255,255,255); background: rgba(255,255,255,0.9); border:1px solid #fff; -webkit-border-radius: 1px 1px 1px 1px; -moz-border-radius: 1px 1px 1px 1px; border-radius: 1px 1px 1px 1px; box-shadow: 1px 1px 2px #fff, -1px -1px 12px #fff, 1px 1px 2px #fff;";
				if (!empty($mobTrue)){
					echo "margin-left:3px; margin-top:4px;";
					}
				else {
					echo "margin-left:3px; margin-top:4px;";
					}
				echo " max-width:300px; font-size: 1.0em;'><strong>".$dumpTitle."</strong></i><img src='$dumpImage' alt='Preview Image' style='";
				if (!empty($mobTrue)){
					echo "width:auto; height:30vh;";
					}
				else {
					echo "width:auto; height:34.5vh;";
					}
				echo " border:2px solid #fff; padding:0px; -webkit-border-radius: 6px 6px 6px 6px; -moz-border-radius: 6px 6px 6px 6px; border-radius: 6px 6px 6px 6px; box-shadow: 1px 1px 12px #fff, -1px -1px 12px #fff, 1px 1px 12px #fff;' id='btn-submit-search'></img></a> &nbsp; ";
				}
			}
		echo "</font></th></table>";
		}
	}
if (!empty($twitKey)){
	if (!empty($twitSecret)){
		if (!empty($myCharTwit)) {
			echo "<table border='1' bgcolor='transparent' font color='#fff' size='6' class='table-results' style='width:99.8%; table-layout:fixed;'><th><i style='float:right; width:98%;'><h1 style='float:right;'><font size='6' style='font:bold 100% arial, sans-serif;' color='#213875'><a href='https://twitter.com/".$myCharTwit."' title='".$myCharTwit." on Twitter' target='_blank' style='color:#38A1F3; text-shadow: 1px 1px 1px #000;'>@".$myCharTwit."</a></font></h1></i></th>";
			$settings = array(
				'consumer_key' => $twitKey,
				'consumer_secret' => $twitSecret,
				'oauth_access_token' => '',
				'oauth_access_token_secret' => '',
				);
			$screen_name = $myCharTwit;
			$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
			$getfield = "?screen_name={$screen_name}&count=50&tweet_mode=extended";
			$requestMethod = 'GET';
			$twitter = new TwitterAPIExchange($settings);
			$user_timeline = $twitter
			->setGetfield($getfield)
			->buildOauth($url, $requestMethod)
			->performRequest();
			$user_timeline = json_decode($user_timeline);
			foreach ($user_timeline as $user_tweet) {
				$timeTweet = $user_tweet->created_at;
				echo "<tr><td>";
				echo "<font style='color:#213875;'>".time_elapsed_string($timeTweet)."</font> - <font style='color:#000;font-size: 80%;'>".$timeTweet."</font>";
				echo "</td></tr>";
				echo "<tr><td><br /><font size='5' color='#000'>";
				echo TwitterTextFormatter::format_text($user_tweet) . "<br/>";
				echo "</font><br /></td></tr>";
				if (isset($user_tweet->entities->media)) {
					echo "<tr><td><center>";
					$media_url = $user_tweet->entities->media[0]->media_url_https;
					echo "<img src='{$media_url}' style='height:88vh; width:80vw;' />";
					echo "</center></td></tr>";
					}
				echo "<center><tr style='height:30px; border:none;'></tr></center>";
				}
			echo "</table></center>";
			}
		}
	}
if (isset($charId)) {
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
	include('./config.php');
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
	mysqli_real_escape_string($conn, $charId);
	$checkComs = mysqli_query($conn, "SELECT * FROM coms WHERE comuser = '$charId' ORDER BY comtime DESC") or die(mysqli_error($conn));
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
		$makeLinks = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
		$comsPost = preg_replace($makeLinks, '<a href="$0" target="_blank" title="$0" style="color:#4169E1;">$0</a>', $comsPost);
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
		echo "<center><table class='table-results' style='width:98.8%; margin:1px;'><th style='width:15%;font-size:1.2em; width:15%;color:#3A5ECA; max-width: 15%; overflow-wrap: break-word; word-break: break-word; vertical-align:top;'>
			
		<i style='float:left; padding-right:8px;'><img src='./images/user/".$myCharImage1."' alt='".$myCharImage1."' width='65px' height='65px' style='border: 1px solid #3A5ECA;'></img></i>
			
		<a href='./?u=".htmlspecialchars($myCharName1)."' title='User profile' target='_self'><font size='3'>".htmlspecialchars($myCharName1)."</font></a>
			
		<i style='float:right;'><font size='3' color='#000'>".$myCharLevel1."</font> <i class='fas fa-level-up-alt'></i></i><br />
			
		<i style='float:right;'><font size='3' color='#000'> ".$myCharMoney1."</font> <i class='far fa-hand-paper'></i></i><br />
			
		<i style='float:right;'><font size='3' color='#000'> ".$myCharEXP1."</font> <i class='fas fa-flask'></i></i>
			
		</th></table></center>";
		echo "<center><table class='table-results' style='width:98.8%; margin:1px;'><th style='width:15%; color:#000; font-size:1.5em; max-width: 15%; overflow-wrap: break-word; word-break: break-word;'>";
		if (!empty($preVideo)){
			$preVideoMake = substr($preVideo, strrpos($preVideo, '/') + 1);
			echo '<center><div class="stubsize" style="border: 2px solid #3A5ECA; border-radius: 6px; margin-top:10px; margin-bottom:10px;"><div class="youtube" data-embed="'.$preVideoMake.'"><div class="play-button" style="border: 2px solid #3A5ECA; border-radius: 6px; margin-top:10px; margin-bottom:10px;"></div></div></div></center>';
			}
		if (!empty($preImage)){
			echo "<center><img src='".$preImage."' alt='".$preImage."' width='98%;' style='border: 2px solid #3A5ECA; height: 30vh; border-radius: 6px; margin-top:10px; margin-bottom:10px;'></img></center>";
			}
		echo "<i style='float:right; font-size:0.5em; color:#3A5ECA;'>".$comsTimeNew."</i><p style='margin-left: 10px;'>".$comsPost."</p></th></table></center>";
		echo "<script>function myReply_".$comsCodeNew."() {var x = document.getElementById('reply-box".$comsCodeNew."');if (x.style.display === 'none') {x.style.display = 'inline';}else {x.style.display = 'none';}}</script>";
		echo '<script>function makeRate'.$comsCodeNew.'() {var $scores = $("#scores");var new_rate_node = document.getElementById("new_rate_node'.$comsCodeNew.'").value;var new_rate_code = document.getElementById("new_rate_code'.$comsCodeNew.'").value;var new_rate_id = document.getElementById("new_rate_id'.$comsCodeNew.'").value;var new_rate_user = document.getElementById("new_rate_user'.$comsCodeNew.'").value;if(new_rate_node && new_rate_code && new_rate_id && new_rate_user) {$.ajax({type: "post",url: "rate.php",data:{new_rate_node:new_rate_node,new_rate_code:new_rate_code,new_rate_id:new_rate_id,new_rate_user:new_rate_user},success: function (response){location.reload(true);}});}return false;}</script>';
		$logId = $comsId;
		echo "<center><table class='table-results' style='width:98%; margin:1px;'><th style='color:#000; font-size:1.5em; max-width: 98%; overflow-wrap: break-word; word-break: break-word;'>";
		echo "<button onclick='myReply_".$comsCodeNew."()' style='border:none; background-color: transparent; outline: none; padding-left:5px; padding-right:5px; float:left;' title='Load comments for this post?'><i style='font-size:3.2em; color:#3A5ECA; padding: 0;' class='fas fa-comments'></i></button>";
		echo "<i style='border:none; background-color: transparent; outline: none; padding-left:5px; padding-right:5px; float:right;'>".$comsCreditNew."</i>";
		echo "<i style='border:none; background-color: transparent; outline: none; padding-left:5px; padding-right:5px; float:right;'><a href='./?post=".$comsCodeNew."' target='_blank' title='Copy this link to share this post'><i class='fas fa-share-square'></i></a></i>";
		echo "<div style='display:none;' id='rate-box".$comsCodeNew."'>Rate!</div>";
		echo "</th></table></center>";
		echo "<a name='posted".$comsCodeNew."'></a><div style='display:none;' id='reply-box".$comsCodeNew."'>";
		echo "<center><table class='table-results' style='width:98%; margin:1px;'><th style='color:#000; font-size:1.5em; max-width: 60%; overflow-wrap: break-word; word-break: break-word; border: 2px solid #e5eeff;'>";
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
			echo "<center><table class='table-results' style='width:98%; margin:1px;'><th style='width:15%; font-size:1.2em; width:15%;color:#3A5ECA; max-width: 15%; overflow-wrap: break-word; word-break: break-word; vertical-align:top;'>
				
			<i style='float:left; padding-right:8px;'><img src='./images/user/".$myCharImage2."' alt='".$myCharImage2."' width='65px' height='65px' style='border: 1px solid #3A5ECA;'></img></i>
			
			<a href='./?u=".htmlspecialchars($myCharName2)."' title='User profile' target='_self'><font size='3'>".htmlspecialchars($myCharName2)."</font></a>
			
			<i style='float:right;'><font size='3' color='#000'>".$myCharLevel2."</font> <i class='fas fa-level-up-alt'></i></i><br />
			
			<i style='float:right;'><font size='3' color='#000'> ".$myCharMoney2."</font> <i class='far fa-hand-paper'></i></i><br />
			
			<i style='float:right;'><font size='3' color='#000'> ".$myCharEXP2."</font> <i class='fas fa-flask'></i></i>
			
			</th></table></center>";
			echo "<center><table class='table-results' style='width:98%; margin:1px;'><th style='width:15%; color:#000; font-size:1.5em; max-width: 15%; overflow-wrap: break-word; word-break: break-word;'>";
			if (!empty($preVideo1)){
				$preVideoMake1 = substr($preVideo1, strrpos($preVideo1, '/') + 1);
				echo '<center><div class="stubsize" style="border: 2px solid #3A5ECA; border-radius: 6px; margin-top:10px; margin-bottom:10px;"><div class="youtube" data-embed="'.$preVideoMake1.'"><div class="play-button" style="border: 2px solid #3A5ECA; border-radius: 6px; margin-top:10px; margin-bottom:10px;"></div></div></div></center>';
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
	}
else {
	echo "No user selected!!";
	die();
	}
echo '<script>( function() {var youtube = document.querySelectorAll( ".youtube" );for (var i = 0; i < youtube.length; i++) {var source = "https://img.youtube.com/vi/"+ youtube[i].dataset.embed +"/0.jpg";var image = new Image();image.src = source;image.addEventListener( "load", function() {youtube[ i ].appendChild( image );}( i ) );youtube[i].addEventListener( "click", function() {var iframe = document.createElement( "iframe" );iframe.setAttribute( "frameborder", "0" );iframe.setAttribute( "allowfullscreen", "" );iframe.setAttribute( "src", "https://www.youtube.com/embed/"+ this.dataset.embed +"?rel=0&showinfo=0&autoplay=1" );this.innerHTML = "";this.appendChild( iframe );} );};} )();</script>';
?>
