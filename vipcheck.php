<?php

/**
 * SynWeb 1.3 : VIP Authenticator
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

function isLoggedIn($nodeProbe) {
	$cookieMake = "";
	$tempIP = $_SERVER ['REMOTE_ADDR'];
	if (isset($nodeProbe)) {
		$tempId = $nodeProbe;
		include('config.php');
		if ($connTemp->connect_error) {
			die("Connection failed: " . $connTemp->connect_error);
			}
		mysqli_real_escape_string($connTemp, $tempId);
		$resultsTemp = mysqli_query($connTemp, "SELECT nodeid,nodecode,vip FROM node WHERE nodeid = '$tempId' LIMIT 1") or die(mysqli_error($connTemp));
		if(!empty(mysqli_fetch_array( $resultsTemp ))){
			foreach($resultsTemp as $resTemp){
				$userTemp = $resTemp['nodeid'];
				$passTemp = $resTemp['nodecode'];
				$vipTemp = $resTemp['vip'];
				$IPTemp = $tempIP;
				$cookieMakeTemp = $passTemp;
				$GLOBALS['cookiePass'] = $cookieMakeTemp;
				$GLOBALS['vipPass'] = $vipTemp;
				}
			}
		if (isset($cookieMakeTemp)){
			if(!isset($_COOKIE[$cookieMakeTemp])) {
				return false;
				die();
				}
			else {
				return true;
				}		
			}
		}
	else {
		return false;
		die();
		}
	}
?>