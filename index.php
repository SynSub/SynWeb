<?php

/**
 * SynWeb 1.3 : SynWeb Index
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
 
echo "<html><head>";
echo "<meta name='viewport' content='width=device-width, initial-scale=0.86, user-scalable=1'>";
echo "<link rel='shortcut icon' href='images/SynSub.ico' type='image/x-icon'/>";
echo "<link rel='icon' href='images/SynSub.ico' type='image/gif'/>";
echo "<link rel='stylesheet' type='text/css' href='css/style.css'/>";
echo "<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.1.0/css/all.css'>";
echo "<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.1.0/css/v4-shims.css'>";
echo "<script src='https://code.jquery.com/jquery-latest.js'></script>";
echo "</head><body><center><div class='sidebarhead' style='width:98%; margin-top:0px; background-color:transparent;'>";
include('config.php');
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
	$mobTrue = 1;
	}
if (!empty($mobTrue)){
	$newIP = $_SERVER ['REMOTE_ADDR'];
	include('logcheck.php');
	if (isset($_GET['nid'])) {
		echo '<meta property="og:image" content="https://'.$siteHost.'/images/SynSub.jpg"/>';
		$logId = $_GET['nid'];
		if (isLoggedIn($logId)){
			echo '<title>NODE: '.$logId.'</title>';
			echo '<meta name="description" content="'.$siteDescription.'"/>';
			echo '<meta property="og:title" content="NODE: '.$logId.'"/>';
			echo '<meta property="og:description" content="'.$siteDescription.'"/>';
			echo '<meta property="og:url" content="https://'.$siteHost.'/?nid='.$logId.'">';
			include('./modules/account.php');
			$comsUser = $myCharName;
			$comsUserNew = $myCharName;
			if (isset($_GET['url'])) {
				$fetchComUrl = $_GET['url'];
				$fetchComUrl = htmlspecialchars($fetchComUrl);
				echo "<center><table class='table-results' style='width:99.8%;'><tr><td>";
				echo "<center><iframe src='./modules/frameit.php/?url=".$fetchComUrl."' style='width:99.8%; height:75vh;' frameborder='0'></iframe></center>";
				echo "</td></tr></table></center>";
				}
			echo "<div id='scroller' style='height:83vh; overflow:scroll; width:100%;'>";
			echo "<div style='width:100%;'>";
			include('./modules/wall-mobile.php');
			echo "</div>";
			echo "</div>";
			echo "<div style='display:inline; position:absolute; right: 30px; bottom:10px;' id='comment-button'>";
			echo "<button onclick='myFunction()' style='border:none; background-color: transparent; outline: none;'><i style='font-size:4.2em; color:LimeGreen; padding: 0;' class='fas fa-plus-circle'></i></button>";
			echo "</div>";
			echo "<div style='display:none; position:absolute; right: 5px; left: 5px; top:80px; z-index:100;' id='comment-box'>";
			echo "<center><table class='table-results' style='width:99.8%;'>";
			if (isset($_GET['url'])) {
				echo '<form action="" method="post" onsubmit="return post1();">';
				}
			else {
				echo '<form action="" method="post" onsubmit="return post();">';
				}
			echo '<input type="hidden" value="'.$newIP.'" name="new_com_ip" id="new_com_ip">';
			echo '<input type="hidden" value="'.$myCharBaseId.'" name="new_com_base" id="new_com_base">';
			echo '<input type="hidden" value="'.$logId.'" name="new_node_id" id="new_node_id">';
			if (isset($_GET['url'])) {
				echo '<input type="hidden" value="'.$fetchComUrl.'" name="new_node_url" id="new_node_url">';
				}
			echo "<tr>";
			echo '<td style="width:100%;"><center><textarea style="width:100%; box-sizing: border-box; resize: vertical; padding:0.5%;" rows="15" cols="50" placeholder="Comment Post: (required)" name="new_com_post" id="new_com_post" minlength="10" maxlength="5000" required></textarea></center></td>';
			echo "</tr></table></center>";
			echo "<center><table class='table-results' style='width:99.8%;'>";
			echo "<tr>";
			echo '<td style="width:40%;">';
			if (isset($comsUserNew)){
				echo '<input type="hidden" value="'.$comsUserNew.'" name="new_com_user" id="new_com_user">';
				echo "<h2><font size='1'>".htmlspecialchars($comsUserNew)."</font></h2>";
				}
			else {
				echo '<input style="width:100%;" class="fa" id="submit" type="text" value="" placeholder="Name" name="new_com_user" minlength="3" maxlength="20" required>';
				}
			echo '</td>';
			echo '<td><input style="width:100%;"class="fa" id="submit" type="submit" value="&#xf075;"></form></td>';
			echo "</tr></table></center>";
			echo "</div>";
			}
		else {
			echo "<h2>Not logged in!</h2>";
			die();
			}
		}
	else if (isset($_GET['u'])) {
		$charId = $_GET['u'];
		include('./modules/user.php');
		echo '<title>'.$myCharName.'</title>';
		echo '<meta property="og:title" content="'.$siteNamed.'"/>';
		echo '<meta property="og:url" content="https://'.$siteHost.'/?u='.$charId.'">';
		die();
		}
	else if (isset($_GET['post'])) {
		$postId = $_GET['post'];
		include('./modules/post-mobile.php');
		echo '<title>'.$comsUser.'</title>';
		echo '<meta property="og:image" content="https://'.$siteHost.'/images/SynSub.jpg"/>';
		echo '<meta name="description" content="'.$comsMeta.'"/>';
		echo '<meta property="og:title" content="'.$siteNamed.'"/>';
		echo '<meta property="og:description" content="'.$comsMeta.'"/>';
		echo '<meta property="og:url" content="https://'.$siteHost.'/?post='.$postId.'">';
		die();
		}
	else if (isset($_GET['topuser'])) {
		include('./modules/topuser.php');
		echo '<title>Top Users List</title>';
		echo '<meta property="og:image" content="https://'.$siteHost.'/images/SynSub.jpg"/>';
		echo '<meta name="description" content="View the top users by level."/>';
		echo '<meta property="og:title" content="Top Users List"/>';
		echo '<meta property="og:description" content="View the top users by level."/>';
		echo '<meta property="og:url" content="https://'.$siteHost.'/?topuser">';
		die();
		}
	else if (isset($_GET['toppost'])) {
		include('./modules/toppost.php');
		echo '<title>Top Posts List</title>';
		echo '<meta property="og:image" content="https://'.$siteHost.'/images/SynSub.jpg"/>';
		echo '<meta name="description" content="View the top posts by rating."/>';
		echo '<meta property="og:title" content="Top Posts List"/>';
		echo '<meta property="og:description" content="View the top posts by rating."/>';
		echo '<meta property="og:url" content="https://'.$siteHost.'/?toppost">';
		die();
		}
	else if (isset($_GET['urls'])) {
		include('./modules/urllist.php');
		echo '<title>Latest URL Comments</title>';
		echo '<meta property="og:image" content="https://'.$siteHost.'/images/SynSub.jpg"/>';
		echo '<meta name="description" content="View the latest URL Walls."/>';
		echo '<meta property="og:title" content="Latest URL Comments"/>';
		echo '<meta property="og:description" content="View the latest URL Walls."/>';
		echo '<meta property="og:url" content="https://'.$siteHost.'/?urls">';
		die();
		}
	else {
		echo '<title>'.$siteNamed.'</title>';
		echo '<meta property="og:image" content="https://'.$siteHost.'/images/SynSub.jpg"/>';
		echo '<meta name="description" content="'.$siteDescription.'"/>';
		echo '<meta property="og:title" content="'.$siteNamed.'"/>';
		echo '<meta property="og:description" content="'.$siteDescription.'"/>';
		echo '<meta property="og:url" content="https://'.$siteHost.'/">';
		echo "<center><table class='table-results' style='width:99.8%; margin:1px;'>";
		echo "<tr style='font-family: proxima-nova,sans-serif;'>";
		echo "<td><font style='font-size:500%; font-weight:bold;' color='#000'>Syn</font><font style='font-size:500%; font-weight:bold;' color='#3A5ECA'>Web</font><i style='float:right;'></i></td>";
		echo "</tr>";
		echo "</table></center>";
		echo "<center><table class='table-results' style='width:99.8%;'><th><font size='4' color='#000' style='float:left;'>Login Account</font></th><tr><td>";
		echo '<form style="padding: 5px 5px 5px 5px; box-sizing: border-box; vertical-align:top" action="./auth.php" method="post" target="_self">';
		echo '<input type="hidden" value="'.$newIP.'" name="new_ip">';
		echo '<div style="width:100%;"><input name="nodeid" type="username" placeholder="Login Name:" style="width:60%; height:5%; padding: 10px 10px 10px 10px; box-sizing: border-box;" minlength="4" maxlength="20" required><a title="Use this name to log in"> - Login Name</a></div><br />';
		echo '<div style="width:100%;"><input name="nodecode" type="password" placeholder="Login Password:" style="width:60%; height:5%; padding: 10px 10px 10px 10px; box-sizing: border-box;" minlength="6" maxlength="20" required><a title="Use this password to log in"> - Login Password</a></div><br />';
		echo '<div style="width:100%;"><img src="captcha.php" style="width:15%; height:50px; padding: 10px 0px 10px 0px; box-sizing: border-box;"/></div>';
		echo '<div style="width:100%;"><input name="captcha" type="text" style="width:60%; height:5%; padding: 10px 10px 10px 10px; box-sizing: border-box;" placeholder="Enter the 4 digits above:" minlength="4" maxlength="4" required><a title="Show that you are a Human"> - Captcha Code</a></div><br />';
		echo '<div style="width:100%;"><input "class="fa" id="btn-submit-search1" type="submit" value="Login" style="width:60%; height:5%; padding: 10px 10px 10px 10px; box-sizing: border-box;"><a title="Log in to this account"> - Login Account</a></div>';
		echo '</form>';
		echo '</td></tr></table></center>';
		echo "<center><table class='table-results' style='width:99.8%;'><th><font size='4' color='#000' style='float:left;'>Create Account</font></th><tr><td>";
		echo '<form style="padding: 5px 5px 5px 5px; box-sizing: border-box; vertical-align:top" action="./create.php" method="post" target="_self">';
		echo '<input type="hidden" value="'.$newIP.'" name="new_ip">';
		echo '<div style="width:100%;"><input name="nodeid" type="username" placeholder="Login Name" value="" style="width:60%; height:5%; padding: 10px 10px 10px 10px; box-sizing: border-box;" minlength="4" maxlength="12" required><a title="Log in with this name"> - Login Name</a></div><br />';
		echo '<div style="width:100%;"><input name="nodecode" type="password" placeholder="Login Password" value="" style="width:60%; height:5%; padding: 10px 10px 10px 10px; box-sizing: border-box;" minlength="6" maxlength="20" required><a title="Log in with this password"> - Login Password</a></div><br />';
		echo '<div style="width:100%;"><input name="nodename" type="text" placeholder="Choose a display name." value="" style="width:60%; height:5%; padding: 10px 10px 10px 10px; box-sizing: border-box;" minlength="3" maxlength="20" required><a title="Choose a display name."> - Display Name</a></div><br />';
		echo '<div style="width:100%;"><input name="nodeemail" type="email" placeholder="Enter a valid email address." value="" style="width:60%; height:5%; padding: 10px 10px 10px 10px; box-sizing: border-box;" minlength="5" maxlength="40" required><a title="Enter a valid email address."> - Email Address</a></div><br />';
		echo '<div style="width:100%;"><img src="captcha.php" style="width:15%; height:50px; padding: 10px 0px 10px 0px; box-sizing: border-box;"/></div>';
		echo '<div style="width:100%;"><input name="captcha" type="text" style="width:60%; height:5%; padding: 10px 10px 10px 10px; box-sizing: border-box;" placeholder="Enter the 4 digits above:" minlength="4" maxlength="4" required><a title="Show that you are a Human"> - Captcha Code</a></div><br />';
		echo '<div style="width:100%;"><input "class="fa" id="btn-submit-search1" type="submit" value="Create" style="width:60%; height:5%; padding: 10px 10px 10px 10px; box-sizing: border-box;"><a title="Create this account"> - Create Account</a></div>';
		echo '</form>';
		echo '</td></tr></table></center>';
		echo "<center><table class='table-results' style='width:99.8%;'><th style='font-size:1.2em; width:15%;color:#3A5ECA; max-width: 15%; overflow-wrap: break-word; word-break: break-word; vertical-align:top;'>Top Users</th></table></center>";
		include('./modules/topuser.php');
		echo "<center><table class='table-results' style='width:99.8%;'><th style='font-size:1.2em; width:15%;color:#3A5ECA; max-width: 15%; overflow-wrap: break-word; word-break: break-word; vertical-align:top;'>More Links</th></table></center>";
		include('./modules/about.php');
		}
	}
else {
	$newIP = $_SERVER ['REMOTE_ADDR'];
	include('logcheck.php');
	if (isset($_GET['nid'])) {
		echo '<meta property="og:image" content="https://'.$siteHost.'/images/SynSub.jpg"/>';
		$logId = $_GET['nid'];
		if (isLoggedIn($logId)){
			echo '<title>NODE: '.$logId.'</title>';
			echo '<meta name="description" content="'.$siteDescription.'"/>';
			echo '<meta property="og:title" content="NODE: '.$logId.'"/>';
			echo '<meta property="og:description" content="'.$siteDescription.'"/>';
			echo '<meta property="og:url" content="https://'.$siteHost.'/?nid='.$logId.'">';
			include('./modules/account.php');
			$comsUser = $myCharName;
			$comsUserNew = $myCharName;
			if (isset($_GET['url'])) {
				$fetchComUrl = $_GET['url'];
				echo "<div class='sidebarhead' style='width:30%; height: 90.5vh; margin:0px; background-color:#FFFFFF; float:left;'>";
				echo "<center><iframe src='./modules/frameit.php/?url=".$fetchComUrl."' style='width:99.8%; height:100%;' frameborder='0'></iframe></center>";
				echo "</div>";
				}
			if (isset($_GET['url'])) {
				echo "<div class='sidebarhead' id='scroller' style='overflow:scroll; width:67%; height: 90.5vh; margin:0px; float:right; background-color:#FFFFFF;'>";
				echo "<div style='width:99.8%;'>";
				}
			else {
				echo "<div id='scroller' style='height:91.6vh; overflow:scroll; width:100%;'>";
				echo "<div style='width:90%;'>";
				}
			include('./modules/wall.php');
			echo "</div>";
			echo "</div>";
			echo "<div style='display:inline; position:absolute; right: 60px; bottom:30px;' id='comment-button'>";
			echo "<button onclick='myFunction()' style='border:none; background-color: transparent; outline: none;'><i style='font-size:3.2em; color:LimeGreen; padding: 0;' class='fas fa-plus-circle'></i></button>";
			echo "</div>";
			echo "<div style='display:none; position:absolute; right: 100px; left: 100px; top:80px; z-index:100;' id='comment-box'>";
			echo "<center><table class='table-results' style='width:99.8%;'>";
			if (isset($_GET['url'])) {
				echo '<form action="" method="post" onsubmit="return post1();">';
				}
			else {
				echo '<form action="" method="post" onsubmit="return post();">';
				}
			echo '<input type="hidden" value="'.$newIP.'" name="new_com_ip" id="new_com_ip">';
			echo '<input type="hidden" value="'.$myCharBaseId.'" name="new_com_base" id="new_com_base">';
			echo '<input type="hidden" value="'.$logId.'" name="new_node_id" id="new_node_id">';
			if (isset($_GET['url'])) {
				echo '<input type="hidden" value="'.$fetchComUrl.'" name="new_node_url" id="new_node_url">';
				}
			echo "<tr>";
			echo '<td style="width:100%;"><center><textarea style="width:100%; box-sizing: border-box; resize: vertical; padding:0.5%;" rows="40" cols="50" placeholder="Comment Post: (required)" name="new_com_post" id="new_com_post" minlength="10" maxlength="5000" required></textarea></center></td>';
			echo "</tr></table></center>";
			echo "<center><table class='table-results' style='width:99.8%;'>";
			echo "<tr>";
			echo '<td style="width:10%;">';
			if (isset($comsUserNew)){
				echo '<input type="hidden" value="'.$comsUserNew.'" name="new_com_user" id="new_com_user">';
				echo "<h2><font size='1'>".htmlspecialchars($comsUserNew)."</font></h2>";
				}
			else {
				echo '<input style="width:100%;" class="fa" id="submit" type="text" value="" placeholder="Name" name="new_com_user" minlength="3" maxlength="20" required>';
				}
			echo '</td>';
			echo '<td><input style="width:100%;"class="fa" id="submit" type="submit" value="&#xf075;"></form></td>';
			echo "</tr></table></center>";
			echo "</div>";
			}
		else {
			echo "<h2>Not logged in!</h2>";
			die();
			}
		}
	else if (isset($_GET['u'])) {
		$charId = $_GET['u'];
		include('./modules/user.php');
		echo '<title>'.$myCharName.'</title>';
		echo '<meta property="og:title" content="'.$myCharName.'"/>';
		echo '<meta property="og:url" content="https://'.$siteHost.'/?nid='.$charId.'">';
		die();
		}
	else if (isset($_GET['post'])) {
		$postId = $_GET['post'];
		include('./modules/post.php');
		if (isset($comsUser)){
			echo '<title>'.$comsUser.'</title>';
			}
		echo '<meta property="og:image" content="https://'.$siteHost.'/images/SynSub.jpg"/>';
		if (isset($comsMeta)){
			echo '<meta name="description" content="'.$comsMeta.'"/>';
			echo '<meta property="og:title" content="'.$siteNamed.'"/>';
			echo '<meta property="og:description" content="'.$comsMeta.'"/>';
			}
		echo '<meta property="og:url" content="https://'.$siteHost.'/?post='.$postId.'">';
		die();
		}
	else if (isset($_GET['topuser'])) {
		include('./modules/topuser.php');
		echo '<title>Top Users List</title>';
		echo '<meta property="og:image" content="https://'.$siteHost.'/images/SynSub.jpg"/>';
		echo '<meta name="description" content="View the top users by level."/>';
		echo '<meta property="og:title" content="Top Users List"/>';
		echo '<meta property="og:description" content="View the top users by level."/>';
		echo '<meta property="og:url" content="https://'.$siteHost.'/?topuser">';
		die();
		}
	else if (isset($_GET['toppost'])) {
		include('./modules/toppost.php');
		echo '<title>Top Posts List</title>';
		echo '<meta property="og:image" content="https://'.$siteHost.'/images/SynSub.jpg"/>';
		echo '<meta name="description" content="View the top posts by rating."/>';
		echo '<meta property="og:title" content="Top Posts List"/>';
		echo '<meta property="og:description" content="View the top posts by rating."/>';
		echo '<meta property="og:url" content="https://'.$siteHost.'/?toppost">';
		die();
		}
	else if (isset($_GET['urls'])) {
		include('./modules/urllist.php');
		echo '<title>Latest URL Comments</title>';
		echo '<meta property="og:image" content="https://'.$siteHost.'/images/SynSub.jpg"/>';
		echo '<meta name="description" content="View the latest URL Walls."/>';
		echo '<meta property="og:title" content="Latest URL Comments"/>';
		echo '<meta property="og:description" content="View the latest URL Walls."/>';
		echo '<meta property="og:url" content="https://'.$siteHost.'/?urls">';
		die();
		}
	else {
		echo '<meta property="og:image" content="https://'.$siteHost.'/images/SynSub.jpg"/>';
		echo '<title>'.$siteNamed.'</title>';
		echo '<meta name="description" content="'.$siteDescription.'"/>';
		echo '<meta property="og:title" content="'.$siteNamed.'"/>';
		echo '<meta property="og:description" content="'.$siteDescription.'"/>';
		echo '<meta property="og:url" content="https://'.$siteHost.'/">';
		echo "<center><table class='table-results' style='width:99.8%; margin:1px;'>";
		echo "<tr style='font-family: proxima-nova,sans-serif;'>";
		echo "<td><font style='font-size:600%; font-weight:bold; padding-left: 10px;' color='#000'>Syn</font><font style='font-size:600%; font-weight:bold;' color='#3A5ECA'>Web</font><i style='float:right;'></i></td>";
		echo "</tr>";
		echo "</table></center>";
		echo "<center><table class='table-results' style='width:99.8%;'><th><font size='4' color='#000' style='float:left;'>Create Account</font></th><th><font size='4' color='#000' style='float:left;'>Login Account</font></th><tr><td width='50%'>";
		echo '<form style="padding: 5px 5px 5px 5px; box-sizing: border-box; vertical-align:top" action="./create.php" method="post" target="_self">';
		echo '<input type="hidden" value="'.$newIP.'" name="new_ip">';
		echo '<div style="width:100%;"><input name="nodeid" type="username" placeholder="Login Name" value="" style="width:60%; height:5vh; padding: 10px 10px 10px 10px; box-sizing: border-box;" minlength="4" maxlength="12" required><a title="Log in with this name"> - Login Name</a></div><br />';
		echo '<div style="width:100%;"><input name="nodecode" type="password" placeholder="Login Password" value="" style="width:60%; height:5vh; padding: 10px 10px 10px 10px; box-sizing: border-box;" minlength="6" maxlength="20" required><a title="Log in with this password"> - Login Password</a></div><br />';
		echo '<div style="width:100%;"><input name="nodename" type="text" placeholder="Choose a display name." value="" style="width:60%; height:5vh; padding: 10px 10px 10px 10px; box-sizing: border-box;" minlength="3" maxlength="20" required><a title="Choose a display name."> - Display Name</a></div><br />';
		echo '<div style="width:100%;"><input name="nodeemail" type="email" placeholder="Enter a valid email address." value="" style="width:60%; height:5vh; padding: 10px 10px 10px 10px; box-sizing: border-box;" minlength="5" maxlength="40" required><a title="Enter a valid email address."> - Email Address</a></div><br />';
		echo '<div style="width:100%;"><img src="captcha.php" style="width:15%; height:7.2vh; padding: 10px 0px 10px 0px; box-sizing: border-box;"/></div>';
		echo '<div style="width:100%;"><input name="captcha" type="text" style="width:60%; height:5vh; padding: 10px 10px 10px 10px; box-sizing: border-box;" placeholder="Enter the 4 digits above:" minlength="4" maxlength="4" required><a title="Show that you are a Human"> - Captcha Code</a></div><br />';
		echo '<div style="width:100%;"><input "class="fa" id="btn-submit-search1" type="submit" value="Create" style="width:60%; height:5vh; padding: 10px 10px 10px 10px; box-sizing: border-box;"><a title="Create this account"> - Create Account</a></div>';
		echo '</form>';
		echo '</td>';
		echo '<td width="50%">';
		echo '<form style="padding: 5px 5px 5px 5px; box-sizing: border-box; vertical-align:top" action="./auth.php" method="post" target="_self">';
		echo '<input type="hidden" value="'.$newIP.'" name="new_ip">';
		echo '<div style="width:100%;"><input name="nodeid" type="username" placeholder="Login Name:" style="width:60%; height:5vh; padding: 10px 10px 10px 10px; box-sizing: border-box;" minlength="4" maxlength="20" required><a title="Log in with this name"> - Login Name</a></div><br />';
		echo '<div style="width:100%;"><input name="nodecode" type="password" placeholder="Login Password:" style="width:60%; height:5vh; padding: 10px 10px 10px 10px; box-sizing: border-box;" minlength="6" maxlength="20" required><a title="Log in with this password"> - Login Password</a></div><br /><br /><br /><br /><br /><br /><br /><br />';
		echo '<div style="width:100%;"><img src="captcha.php" style="width:15%; height:7.2vh; padding: 10px 0px 10px 0px; box-sizing: border-box;"/></div>';
		echo '<div style="width:100%;"><input name="captcha" type="text" style="width:60%; height:5vh; padding: 10px 10px 10px 10px; box-sizing: border-box;" placeholder="Enter the 4 digits above:" minlength="4" maxlength="4" required><a title="Show that you are a Human"> - Captcha Code</a></div><br />';
		echo '<div style="width:100%;"><input "class="fa" id="btn-submit-search1" type="submit" value="Login" style="width:60%; height:5vh; padding: 10px 10px 10px 10px; box-sizing: border-box;"><a title="Log in to this account"> - Login Account</a></div>';
		echo '</form>';
		echo '</td></tr></table></center>';
		echo "<center><table class='table-results' style='width:99.8%;'><th style='font-size:1.2em; width:15%;color:#3A5ECA; max-width: 15%; overflow-wrap: break-word; word-break: break-word; vertical-align:top;'>Top Users</th></table></center>";
		include('./modules/topuser.php');
		echo "<center><table class='table-results' style='width:99.8%;'><th style='font-size:1.2em; width:15%;color:#3A5ECA; max-width: 15%; overflow-wrap: break-word; word-break: break-word; vertical-align:top;'>More Links</th></table></center>";
		include('./modules/about.php');
		}
	}

echo "</div></center></body>";
echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";
echo '<script>function post(){var $scores = $("#scores");var new_com_user = document.getElementById("new_com_user").value;var new_com_ip = document.getElementById("new_com_ip").value;var new_com_post = document.getElementById("new_com_post").value;var new_node_id = document.getElementById("new_node_id").value;var new_com_base = document.getElementById("new_com_base").value;if(new_com_user && new_com_ip && new_com_post && new_node_id && new_com_base){$.ajax({type: "post",url: "post.php",data:{new_com_user:new_com_user,new_com_ip:new_com_ip,new_com_post:new_com_post,new_node_id:new_node_id,new_com_base:new_com_base},success: function (response){location.reload(true);}});}return false;}function post1(){var $scores = $("#scores");var new_com_user = document.getElementById("new_com_user").value;var new_com_ip = document.getElementById("new_com_ip").value;var new_com_post = document.getElementById("new_com_post").value;var new_node_id = document.getElementById("new_node_id").value;var new_node_url = document.getElementById("new_node_url").value;if(new_com_user && new_com_ip && new_com_post && new_node_id && new_node_url){$.ajax({type: "post",url: "post.php",data:{new_com_user:new_com_user,new_com_ip:new_com_ip,new_com_post:new_com_post,new_node_id:new_node_id,new_node_url:new_node_url},success: function (response){location.reload(true);}});}return false;}</script><script>function myFunction() {var x = document.getElementById("comment-box");if (x.style.display === "none") {x.style.display = "inline";} else {x.style.display = "none";}}</script>';
echo "</html>";
?>