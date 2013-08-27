<?php

/**
 * cookie actions.
 *
 * @package    project
 * @subpackage cookie
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class cookieActions extends sfActions
{
  public function executeIndex($request)
  {
    return $this->renderText('<p>'.$request->getCookie('foo').'.'.$request->getCookie('bar').'-'.$request->getCookie('foobar').'</p>');
  }

  public function executeSetCookie($request)
  {
    $this->getResponse()->setCookie('foobar', 'barfoo');

    return sfView::NONE;
  }

  public function executeRemoveCookie($request)
  {
    $this->getResponse()->setCookie('foobar', 'foofoobar', time() - 10);

    return sfView::NONE;
  }
}
