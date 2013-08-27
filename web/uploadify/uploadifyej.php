<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '/uploads'; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	$targetFileName = sha1($_FILES['Filedata']['name'].rand(11111, 99999)).'.'.$fileParts['extension'];
	$targetFile = rtrim($targetPath,'/') . '/' .$targetFileName;
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		$houzui = explode('.', $targetFileName);
		$houzui= $houzui[count($houzui)-1];
		echo $targetFileName;
	} else {
		echo '无效的上传类型';
	}
}
?>