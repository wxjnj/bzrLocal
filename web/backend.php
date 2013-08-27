<?php

if (in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1')))
{
	//die('你的IP不能访问');
	require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');
}
else{
	require_once(dirname(__FILE__).'/../nxetd_lib/config/ProjectConfiguration.class.php');
}

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
