<?php

/*
 * This file is part of the symfony package. (c) 2004-2006 Fabien Potencier
 * <fabien.potencier@symfony-project.com> (c) 2004-2006 Sean Kerr
 * <sean@code-box.org> For the full copyright and license information, please
 * view the LICENSE file that was distributed with this source code.
 */

class gfExecutionFilter extends sfExecutionFilter {
	/**
	 * 判断用户是否拥有访问后台页面的权限
	 *
	 */
	public function execute($filterChain) {
		//IP过滤
		$ip = $_SERVER['REMOTE_ADDR'];
		$website = Doctrine::getTable('Config')->find(1);
		$ipfilter = $website->getIpFilter();
		if(strpos($ipfilter,$ip))
		{
			$this->context->getController()->redirect('http://www.jsnxetd.org.cn');
		}
		
		$actionInstance = $this->context->getController ()->getActionStack ()->getLastEntry ()->getActionInstance ();
		
		$module_name = $actionInstance->getModuleName ();
		$action_name = $actionInstance->getActionName ();
		
		if (($module_name == 'users' && ($action_name == 'edit' || $action_name == 'fsend' || $action_name == 'delete' || $action_name == 'search' || $action_name == 'new' || $action_name == 'audit' || $action_name == 'index' || $action_name == 'blackManager')) || ($module_name == 'config' && ($action_name == 'edit' || $action_name == 'update')) || ($module_name == 'forum' && ($action_name == 'index' || $action_name == 'addModerator' || $action_name == 'cancelModerator')) || ($module_name == 'admin' && ($action_name == 'index' || $action_name == 'headPortraitList' || $action_name == 'pictureList' || $action_name == 'deletePicture')) || ($module_name == 'posted' && $action_name == 'adminManager')) {
			//访问上面指定的后台页面链接时判断是否拥有后台访问权限
			$myuser = sfContext::getInstance()->getUser()->getGuardUser ();
			if($myuser){
				if(!sfContext::getInstance()->getUser()->hasGroup('BBS后台') && $myuser->getIsSuperAdmin() != 1)
				{
					$this->context->getController()->redirect('@error?type=unpermission');
				}
			}else{
				$this->context->getController()->redirect('@error?type=unpermission');
			}
		}
		
		parent::execute ( $filterChain );
	}
}
