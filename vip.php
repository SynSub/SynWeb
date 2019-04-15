<?php

/**
 * SynWeb 1.3 : VIP Only Page
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
include('vipcheck.php');
if (isset($_GET['nid'])) {
	$logId = $_GET['nid'];
	if (isLoggedIn($logId)){
	/* START - Logged In */
		if($vipPass == 1){
		/* START - VIP */
		
		/* Add content for VIP only members here! for just HTML content, wrap it with echo "<html>Goes Here</html>"; */
		
		/* Example: */
		echo "VIP PASS!";
		
		
		
		/* Don't add anything below here unless you know what you're doing! */
		
		/* END - VIP */
		}
		else {
			echo "Not VIP!";
			die();
			}
		/* END - Logged In */
		}
	else {
		echo "Not logged in!";
		die();
		}
	}
else {
	echo "No Node ID";
	die();
	}
?>