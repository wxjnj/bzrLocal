<?php

/**
 * inheritance actions.
 *
 * @package    project
 * @subpackage inheritance
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class inheritanceActions extends autoinheritanceActions
{
  protected function addFiltersCriteria($c)
  {
    if ($this->getRequestParameter('filter'))
    {
      $c->add(ArticlePeer::ONLINE, true);
    }
  }

  protected function addSortCriteria($c)
  {
    if ($this->getRequestParameter('sort'))
    {
      $c->addAscendingOrderByColumn(ArticlePeer::TITLE);
    }
  }
}
