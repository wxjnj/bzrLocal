<?php

/**
 * PluginsfGuardGroup form.
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: PluginsfGuardGroupForm.class.php,v 1.1 2012/05/04 06:47:43 zhaoy Exp $
 */
abstract class PluginsfGuardGroupForm extends BasesfGuardGroupForm
{
  /**
   * @see sfForm
   */
  public function setupInheritance()
  {
    parent::setupInheritance();

    unset(
      $this['created_at'],
      $this['updated_at']
    );

    $this->widgetSchema['users_list']->setLabel('Users');
    $this->widgetSchema['permissions_list']->setLabel('Permissions');
  }
}