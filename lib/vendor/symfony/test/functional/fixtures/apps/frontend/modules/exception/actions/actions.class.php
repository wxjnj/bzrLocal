<?php

/**
 * exception actions.
 *
 * @package    project
 * @subpackage exception
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class exceptionActions extends sfActions
{
  public function executeNoException()
  {
    return $this->renderText('foo');
  }

  public function executeThrowsException()
  {
    throw new Exception('Exception message');
  }

  public function executeThrowsSfException()
  {
    throw new sfException('sfException message');
  }
}
