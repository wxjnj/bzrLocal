<?php
$fullname = $_GET['fullname'];
$filename = $_GET['filename'];
header('Content-Disposition: attachment; filename="'.$fullname.'"');
readfile('uploads/'.$filename);
?>