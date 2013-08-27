<?php

/**
 * article actions.
 *
 * @package    project
 * @subpackage article
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:43 zhaoy Exp $
 */
class articleActions extends autoarticleActions
{
  public function executeMyAction()
  {
    return $this->renderText('Selected '.implode(', ', $this->getRequestParameter('sf_admin_batch_selection', array())));
  }
}
