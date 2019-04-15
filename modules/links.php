<?php

/**
 * SynWeb 1.3 : Links Module
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

if (function_exists('isLoggedIn')){
	if (isLoggedIn($logId)){	
		echo "<center><table class='table-results' style='width:100%; margin:1px;'>";
		echo "<th>Links</th>";
		echo "</table></center>";
		echo "<center><table class='table-results' style='width:100%;'>";
		echo "<tr>";
		echo "<td width='50%'><font size='3' color='#000' style='float:left;'><a href='./?nid=".$logId."&global' target='_self' title='View, rate and reply to posts from everyone on the Global Wall'>Global Wall</a></font></td>";
		echo "<td width='50%'><font size='3' color='#000' style='float:left;'><a href='./?nid=".$logId."&top' target='_self' title='View, rate and reply to the top rated posts on the Top Wall'>Top Wall</a></font></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='50%'><font size='3' color='#000' style='float:left;'><a href='./?topuser' target='_self' title='View or share the Public Users List (no account needed / interactions disabled)'>Public Users List</a></font></td>";
		echo "<td width='50%'><font size='3' color='#000' style='float:left;'><a href='./?toppost' target='_self' title='View or share the Public Posts List (no account needed / interactions disabled)'>Public Posts List</a></font></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='50%'><font size='3' color='#000' style='float:left;'><a href='./?user=".$logId."&urls' target='_self' title='View, rate and reply to the latest URL comments?'>URL Comments</a></font></td>";
		echo "</tr>";
		echo "</table></center>";
		}
	else {
		echo "Not logged in!";
		}
	}
?>