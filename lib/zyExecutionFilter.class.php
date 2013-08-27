<?php

/*
 * This file is part of the symfony package. (c) 2004-2006 Fabien Potencier
 * <fabien.potencier@symfony-project.com> (c) 2004-2006 Sean Kerr
 * <sean@code-box.org> For the full copyright and license information, please
 * view the LICENSE file that was distributed with this source code.
 */

/**
 *
 * @package symfony
 * @subpackage filter
 * @author Fabien Potencier <fabien.potencier@symfony-project.com>
 * @author Sean Kerr <sean@code-box.org>
 * @version SVN: $Id: zyExecutionFilter.class.php,v 1.3 2012/06/05 03:42:55
 *          zhaoy Exp $
 */
class zyExecutionFilter extends sfExecutionFilter {
	/**
	 * 增加一个生成静态页面的功能，根据app.yml的配置来决定是否生成
	 *
	 * @param sfFilterChain $filterChain
	 *        	The filter chain
	 *        	
	 * @throws <b>sfInitializeException</b> If an error occurs during view
	 *         initialization.
	 * @throws <b>sfViewException</b> If an error occurs while executing the
	 *         view.
	 */
	public function execute($filterChain) {
		parent::execute ( $filterChain );
		if (sfConfig::get ( 'app_static_page' )) {
			
			$actionInstance = $this->context->getController ()->getActionStack ()->getLastEntry ()->getActionInstance ();
			$module_name = $actionInstance->getModuleName ();
			$action_name = $actionInstance->getActionName ();
			
			$file_name = '';
			if ($module_name == 'home' && $action_name == 'index') { // 为首页专门创建的静态页面
				$file_name = 'index.html';
			} else if ($module_name == 'ghzc' && $action_name == 'index') {
				$file_name = 'ghzc_index.html';
			}else if ($module_name == 'luntan' && $action_name == 'index') {
				$file_name = 'forum_index.html';
			}else if ($module_name == 'nxjt' && $action_name == 'index') {
				$file_name = 'nxjt_index.html';
			}else if ($module_name == 'wqdt' && $action_name == 'index') {
				$file_name = 'wqdt_index.html';
			}else if ($module_name == 'fngz' && $action_name == 'index') {
				$file_name = 'fngz_index.html';
			}
			else if ($module_name == 'shetuan' && $action_name == 'index') {
				$file_name = 'stzygy_index.html';
			}
			
			if ($file_name != '') {
				
				$html = $this->context->getResponse ()->getContent ();
				StaticPageManager::generateHtml ( $html, $file_name );
				$urls = sfConfig::get ( 'web_host' ) . '/' . $file_name;
				$result = StaticPageManager::remoteRefresh ( $urls );
			}
		
		}
	}

}
