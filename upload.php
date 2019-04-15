<?php

/**
 * SynWeb 1.3 : Profile Image Uploader
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

if (!empty($_POST['name_user_id'])) {
	$logId = $_POST['name_user_id'];
	include('logcheck.php');
	if (isLoggedIn($logId)){
		$target_dir = "images/user/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$target_name = basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		if(isset($_POST["submit"])) {
			if(exif_imagetype($_FILES["fileToUpload"]["tmp_name"])) {
				$uploadOk = 1;
				}
			else {
				echo "Error: It appears the file is not an image.";
				echo "<meta http-equiv='refresh' content='3; url=".$_SERVER['HTTP_REFERER']."'>";
				$uploadOk = 0;
				die();
				}
			}
		if (file_exists($target_file)) {
			$newRand = rand(1,99999);
			$target_file = $target_dir . $newRand . basename($_FILES["fileToUpload"]["name"]);
			$target_name = $newRand . basename($_FILES["fileToUpload"]["name"]);
			}
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Error: It appears the file is too large (max 0.5 MB).";
			echo "<meta http-equiv='refresh' content='3; url=".$_SERVER['HTTP_REFERER']."'>";
			$uploadOk = 0;
			die();
			}
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" ) {
			echo "Error: It appears the file type is not supported (JPG, JPEG, PNG & GIF).";
			echo "<meta http-equiv='refresh' content='3; url=".$_SERVER['HTTP_REFERER']."'>";
			$uploadOk = 0;
			die();
			}
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
			echo "<meta http-equiv='refresh' content='3; url=".$_SERVER['HTTP_REFERER']."'>";
			die();
			}
		else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				$newUpload = $_POST['upload_user_id'];
				include('config.php');
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
					}
				mysqli_real_escape_string($conn, $newUpload);
				$resultsImage = "INSERT INTO users (charname,charimage) VALUES ('$newUpload','$target_name') ON DUPLICATE KEY UPDATE charimage = '$target_name';";
				if ($conn->query($resultsImage) === TRUE) {
				}
				echo "<meta http-equiv='refresh' content='0; url=".$_SERVER['HTTP_REFERER']."'>";
				die();
				}
			else {
				echo "Sorry, there was an error uploading your file.";
				echo "<meta http-equiv='refresh' content='3; url=".$_SERVER['HTTP_REFERER']."'>";
				die();
				}
			}
		}
	else {
		echo "Error: It appears you are not logged in!";
		echo "<meta http-equiv='refresh' content='3; url=./'>";
		die();
		}
	}
?>