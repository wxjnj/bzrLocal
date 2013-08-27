<?php

/**
 * sfI18NPlugin actions.
 *
 * @package    project
 * @subpackage i18n
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class sfI18NPluginActions extends sfActions
{
  public function executeIndex()
  {
    $i18n = $this->getContext()->getI18N();

    $this->test = $i18n->__('an english sentence from plugin');
    $this->localTest = $i18n->__('a local english sentence from plugin');
    $this->otherTest = $i18n->__('another english sentence from plugin');
    $this->yetAnotherTest = $i18n->__('yet another english sentence from plugin');

    $this->testForPluginI18N = $i18n->__('an english sentence from plugin - global');
  }
}
