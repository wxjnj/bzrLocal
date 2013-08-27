<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfPropelRouteCollection represents a collection of routes bound to Propel objects.
 *
 * @package    symfony
 * @subpackage routing
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfPropelRouteCollection.class.php,v 1.1 2012/05/04 06:47:44 zhaoy Exp $
 */
class sfPropelRouteCollection extends sfObjectRouteCollection
{
  protected
    $routeClass = 'sfPropelRoute';
}
