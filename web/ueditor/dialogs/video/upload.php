<?php
  if (($_FILES["fileToUpload"]["type"] == "application/octet-stream") && ($_FILES["fileToUpload"]["size"] < 314572800))
  {
    if ($_FILES["fileToUpload"]["error"] > 0)
    {
   		echo "Return Code: " . $_FILES["fileToUpload"]["error"] . "<br />";
    }
    else
    {
    //echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    //echo "Type: " . $_FILES["file"]["type"] . "<br />";
    //echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
	    if (file_exists($_SERVER['DOCUMENT_ROOT']."/ueditor/server/upload/uploadvideo/".iconv('utf-8','gbk',$_FILES["fileToUpload"]["name"])))
	    {
	      echo '文件'.$_FILES["fileToUpload"]["name"]."已经存在，请不要重复上传！";
	    }
	    else
	    {
	     if($_FILES["fileToUpload"]["type"] == 'application/octet-stream')
	     {
	    	$filename = time().'.flv';
	    	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/ueditor/server/upload/uploadvideo/" .$filename);
	     }
	      //move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$_SERVER['DOCUMENT_ROOT']."/ueditor/server/upload/uploadvideo/" .iconv('utf-8','gbk',$_FILES["fileToUpload"]["name"]));
	      echo "/ueditor/server/upload/uploadvideo/" .$filename;
	    }
    }
  }
  else
  {
  	echo "0";
  }

