<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * HelperHelper.
 *
 * @package    symfony
 * @subpackage helper
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: HelperHelper.php,v 1.1 2012/05/04 06:47:28 zhaoy Exp $
 */

function use_helper()
{
  $context = sfContext::getInstance();

  $context->getConfiguration()->loadHelpers(func_get_args(), $context->getModuleName());
}
