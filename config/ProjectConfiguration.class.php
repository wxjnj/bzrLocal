<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
  	//$this->setWebDir($this->getRootDir());
  	
    $this->enablePlugins('sfDoctrinePlugin');
	$this->enablePlugins('sfDoctrineGuardPlugin');
    $this->enablePlugins('sfThumbnailPlugin');
    $this->enablePlugins('sfCryptoCaptchaPlugin');
    $this->enablePlugins('sfDatePickerTimePlugin');
    date_default_timezone_set ('Asia/Shanghai');
  }
}
