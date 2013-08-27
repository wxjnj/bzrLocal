<?php

/**
 * User group reference model.
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage model
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: PluginsfGuardUserGroup.class.php,v 1.1 2012/05/04 06:47:26 zhaoy Exp $
 */
abstract class PluginsfGuardUserGroup extends BasesfGuardUserGroup
{
  public function postSave($event)
  {
    parent::postSave($event);
    $this->getUser()->reloadGroupsAndPermissions();
  }
}
