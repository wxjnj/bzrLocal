<?php

/**
 * configSettingsMaxForwards actions.
 *
 * @package    project
 * @subpackage configSettingsMaxForwards
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:42 zhaoy Exp $
 */
class configSettingsMaxForwardsActions extends sfActions
{
  public function executeSelfForward()
  {
    $this->forward('configSettingsMaxForwards', 'selfForward');
  }
}
