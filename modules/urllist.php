<?php

/**
 * SynWeb 1.3 : URL Wall List Module
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

$newIP = $_SERVER ['REMOTE_ADDR'];
if (isset($_GET['user'])) {
	$logId = $_GET['user'];
	if (isLoggedIn($logId)){
		function time_elapsed_string1($datetime, $full = false) {
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
		include('./config.php');
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			}
		$checkComs = mysqli_query($conn, "SELECT * FROM coms WHERE comurl IS NOT NULL ORDER BY comtime DESC LIMIT 100") or die(mysqli_error($conn));
		$countComs = mysqli_query($conn, "SELECT COUNT(*) as total FROM coms WHERE comurl IS NOT NULL") or die(mysqli_error($conn));
		while($row = mysqli_fetch_array( $countComs )) {
			$counted = $row['total'];
		}
		echo "<center><table class='table-results' style='width:99.8%; overflow-wrap: break-word; word-break: break-word;'>";
		echo "<th width='45%'><font size='4' color='#4169E1'>Latest URLs</font><br /><font color='#000'>(total archived: <font color='#4169E1'>".$counted."</font>)</font></th><th><font size='4' color='#4169E1' style='float:left;'>Comment Rating</font></th><th><font size='4' color='#4169E1' style='float:left;'>Comment Added</font></th>";
		echo "<tr style='opacity:0.0;'><td>";
		echo "</td></tr>";
		while($row = mysqli_fetch_array( $checkComs )) {
			$comsId = $row['nodeid'];
			$comsUser = $row['comuser'];
			$comsPost = $row['compost'];
			$comsPost = substr($comsPost, 0, 200);
			$comsIPNew = $row['comip'];
			$comsTimeNew = $row['comtime'];
			$comsCodeNew = $row['comcode'];
			$comsCreditNew = $row['comcredit'];
			$comsUrlNew = $row['comurl'];
			echo "<tr>";
			echo "<td>";
			echo "<i style='float:left;'><a href='./?nid=".$logId."&url=".$comsUrlNew."' target='_self' title='Load this comments page?'><font size='4' color='#4169E1' style='float:left;'>".$comsUrlNew."</font></a></i>";
			echo "</td>";
			echo "<td>";
			echo "<i style='float:left;'><font size='3' color='#000' style='float:left;'>".$comsCreditNew."</font></i>";
			echo "</td>";
			echo "<td>";
			echo "<i style='float:left;'><font size='3' color='#000' style='float:left;'>".time_elapsed_string1($comsTimeNew)."</font></i>";
			echo "</td>";
			echo "</tr>";
			echo "<tr><td colspan='3'>";
			echo "<font size='3' color='#000'>".$comsPost."</font>";
			echo "</td></tr>";
			echo "<tr style='opacity:0.0;'><td>";
			echo "</td></tr>";
		}
		echo "</table></center>";
		$conn->close();
		}
	}
else {
	echo "No node ID or not logged in!";
	die();
	}
?>