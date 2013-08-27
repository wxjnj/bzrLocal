<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfWebDebugPanelSymfonyVersion adds a panel to the web debug toolbar with the symfony version.
 *
 * @package    symfony
 * @subpackage debug
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWebDebugPanelSymfonyVersion.class.php,v 1.1 2012/05/04 06:47:42 zhaoy Exp $
 */
class sfWebDebugPanelSymfonyVersion extends sfWebDebugPanel
{
  public function getTitle()
  {
    return '<span id="sfWebDebugSymfonyVersion">'.SYMFONY_VERSION.'</span>';
  }

  public function getPanelTitle()
  {
  }

  public function getPanelContent()
  {
  }
}
