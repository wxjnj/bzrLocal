<?php

/**
 * doctrine_route_test actions.
 *
 * @package    symfony12
 * @subpackage doctrine_route_test
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
class doctrine_route_testActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    try {
      $this->object = $this->getRoute()->getObjects();
    } catch (Exception $e) {
      try {
        $this->object = $this->getRoute()->getObject();
      } catch (Exception $e) {
        return sfView::NONE;
      }
    }
  }
}
