<?php

/**
 * SynWeb 1.3 : SynWeb Configuration
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

/* Database Configuration */

/* Database IP:Port */
$servername = "127.0.0.1:3306";

/* Database Username */
$username = "root";

/* Database Password */
$password = "root";

/* Database Name */
$dbname = "synweb";

$conn = new mysqli($servername, $username, $password, $dbname);
$connTemp = $conn;


/* Website Configuration */

/* Website Name */
$siteNamed = "SynWeb 1.3"; 

/* Website Description */
$siteDescription = "A sharing platform without biased algorithms.";

/* Website Domain */
$siteHost = "example.com";


/* APIs Configuration */

/* YouTube Data API Key - Leave empty to disable auto-integration */
$api_key = "";

/* Twitter Developer Key - Leave empty to disable auto-integration*/
$twitKey = "";

/* Twitter Developer Secret - Leave empty to disable auto-integration */
$twitSecret = "";
?>