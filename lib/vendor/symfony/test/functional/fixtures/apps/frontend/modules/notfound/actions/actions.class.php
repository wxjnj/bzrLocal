<?php

/**
 * notfound actions.
 *
 * @package    project
 * @subpackage notfound
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:43 zhaoy Exp $
 */
class notfoundActions extends sfActions
{
  public function executeIndex()
  {
    $this->getResponse()->setStatusCode(404);

    return $this->renderText('404');
  }
}
