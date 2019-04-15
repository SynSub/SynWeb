<?php

/**
 * SynWeb 1.3 : Who / User Follow Module
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
		include('./config.php');
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
			}
		$checkTop = mysqli_query($conn, "SELECT * FROM users ORDER BY ((experience / 1000)*(currency / 1000)) DESC") or die(mysqli_error($conn));
		$i = 1;
		echo "<center><table class='table-results' style='width:100%; margin:1px;'>";
		echo "<th>Users</th>";
		echo "</table></center>";
		echo "<center><table class='table-results' style='width:100%; margin:1px;'>";
		echo "<th><font color='#4169E1'>#</font></th><th><font color='#4169E1'>Image</font></th><th><font color='#4169E1'><i class='far fa-hand-paper'></font></th><th><font color='#4169E1'><i class='fas fa-flask'></i></font></th><th><font color='#4169E1'><i class='fas fa-level-up-alt'></i></font></th>";
		while($row = mysqli_fetch_array( $checkTop )) {
			$userName = $row['charname'];
			$userNameId = $row['charid'];
			$userImage = $row['charimage'];
			$userExperience = $row['experience'];
			$userCurrency = $row['currency'];
			$thisUserId = $row['id'];
			$userLevel = (($userExperience / 1000)*($userCurrency / 1000));
			echo "<tr>";
			echo "<td width='5%'><font size='3' color='#000' style='float:left;'>".$i."</font></td>";
			echo "<td width='5%'><center><img src='./images/user/".$userImage."' alt='".$userImage."' style='width:60px; height: 60px;'></img></center></td>";
			echo "<td><font size='3' color='#000' style='float:left;'>".$userCurrency."</font></td>";
			echo "<td><font size='3' color='#000' style='float:left;'>".$userExperience."</font></td>";
			echo "<td><font size='3' color='#000' style='float:left;'>".$userLevel."</font></td>";
			echo "</tr>";
			echo "<tr>";
			if (!empty($mobTrue)){
				echo "<td colspan='4'><font size='3' color='#000' style='float:left;'><a href='./?u=".$userName."' target='_self' title='View user posts?'>".$userName."</a></font></td>";
				if (strpos($myCharFollowing, 'id = '.$thisUserId) !== false) {
					echo "<td colspan='1'><font size='2' color='LimeGreen' style='float:right;'><i class='fas fa-address-card'></i> &nbsp; <form action='follow.php' method='post' style='display: inline-block;'><input type='hidden' value='unfollow' name='name_user_mode'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='hidden' value='".$thisUserId."' name='id_user_follow'/><input type='submit' value='Unfollow' style='padding:10px; width: 80px;' title='Unfollow user?'/></form>		</font></td>";
					}
				else {
					echo "<td colspan='1'><font size='2' color='RoyalBlue' style='float:right;'><i class='far fa-address-card'></i> &nbsp; <form action='follow.php' method='post' style='display: inline-block;'><input type='hidden' value='follow' name='name_user_mode'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='hidden' value='".$thisUserId."' name='id_user_follow'/><input type='submit' value='Follow' style='padding:10px; width: 80px;' title='Follow user?'/></form>		</font></td>";
					}
				}
			else {
				echo "<td colspan='4'><font size='3' color='#000' style='float:left;'><a href='./?u=".$userName."' target='_self' title='View user posts?'>".$userName."</a></font></td>";
				if (strpos($myCharFollowing, 'id = '.$thisUserId) !== false) {
					echo "<td colspan='1'><font size='5' color='LimeGreen' style='float:right;'><i class='fas fa-address-card'></i> &nbsp; <form action='follow.php' method='post' style='display: inline-block;'><input type='hidden' value='unfollow' name='name_user_mode'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='hidden' value='".$thisUserId."' name='id_user_follow'/><input type='submit' value='Unfollow' style='padding:10px; width: 100px;' title='Unfollow user?'/></form>		</font></td>";
					}
				else {
					echo "<td colspan='1'><font size='5' color='RoyalBlue' style='float:right;'><i class='far fa-address-card'></i> &nbsp; <form action='follow.php' method='post' style='display: inline-block;'><input type='hidden' value='follow' name='name_user_mode'/><input type='hidden' value='".$myCharName."' name='name_user_name'/><input type='hidden' value='".$logId."' name='name_user_id'/><input type='hidden' value='".$thisUserId."' name='id_user_follow'/><input type='submit' value='Follow' style='padding:10px; width: 100px;' title='Follow user?'/></form>		</font></td>";
					}
				}
			echo "</tr>";
			echo "<tr style='opacity:0;'><td>";
			echo "</tr></td>";
			$i = $i+1;
			}
		echo "</table></center>";
		$conn->close();
		}
	}
else {
	echo "Not logged in!";
	}
?>