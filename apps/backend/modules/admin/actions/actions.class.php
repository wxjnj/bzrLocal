<?php

/**
 * admin actions.
 *
 * @package    nxetd 290  623  238  691
 * @subpackage admin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.16 2012/11/16 06:15:06 zhaoy Exp $
 */
class adminActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)  
  {
  }
  public function executeError404(sfWebRequest $request){
  	
  }
  public function executeSecure(sfWebRequest $request){
  	
  }
  
  public function executeStyle(sfWebRequest $request)
  {
  	$style = $request->getParameter('style');
  	$this->getUser()->setAttribute('style', $style);
  	
  	exit;
  }
}

