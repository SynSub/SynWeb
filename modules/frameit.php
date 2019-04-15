<?php

/**
 * SynWeb 1.3 : Scrape Module
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
 
if (isset($_GET['url'])){
	$newUrl = $_GET['url'];
}
else {
	die();
}
$newGet = file_get_contents($newUrl);
print_r($newGet);
die();
?>