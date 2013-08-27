<?php

/**
 * cache components.
 *
 * @package    project
 * @subpackage cache
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: components.class.php,v 1.1 2012/05/04 06:47:43 zhaoy Exp $
 */
class cacheComponents extends sfComponents
{
  public function executeComponent()
  {
    $this->componentParam = 'componentParam';
    $this->requestParam = $this->getRequestParameter('param');
  }

  public function executeCacheableComponent()
  {
    $this->componentParam = 'componentParam';
    $this->requestParam = $this->getRequestParameter('param');
  }

  public function executeContextualComponent()
  {
    $this->componentParam = 'componentParam';
    $this->requestParam = $this->getRequestParameter('param');
  }

  public function executeContextualCacheableComponent()
  {
    $this->componentParam = 'componentParam';
    $this->requestParam = $this->getRequestParameter('param');
  }
}
