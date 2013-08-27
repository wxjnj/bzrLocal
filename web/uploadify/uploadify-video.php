<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '/uploads/video'; // Relative to the root
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	
	// Validate the file type
	$fileTypes = array('flv'); // File extensions
// 	$fileTypes = array('flv','wmv','vob','avi','mp4'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	$file_true_name = $_FILES['Filedata']['name'];
	
	$name = md5(rand()+time());
	$extension =strtolower($fileParts['extension']);
	$filename = $name.'.'.$extension;
	//$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	$targetFile = rtrim($targetPath,'/') . '/' . $filename;
	$targetFile2 = '';
	if (in_array($extension,$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		$size = $_FILES['Filedata']['size'];
		//echo $targetFolder.'/'.$filename;
		echo '{"name":"'.$filename.'","true_name":"'.$file_true_name.'"}';
		//echo $targetFile2==''?$targetFile:$targetFile2;
// 		if($size <= 314572800 && $extension != 'flv'){
// 			$targetFile2 = rtrim($targetPath,'/') . '/' . $name.'.flv';
// 			exec('ffmpeg -i '.$targetFile.'  -r 25 -b 200 -ab 128 -ac 2 -ar 44100 '.$targetFile2);
// 		}
	} else {
		echo '{"name":"'.''.'","true_name":"'.'无效的文件，请检查文件的合法性'.'"}';
	}
}
?>