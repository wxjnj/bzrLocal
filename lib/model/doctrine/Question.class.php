<?php

/**
 * Question
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    nxetd
 * @subpackage model
 * @author     zhaoyun
 * @version    SVN: $Id: Question.class.php,v 1.1 2012/08/15 11:44:50 zhaoy Exp $
 */
class Question extends BaseQuestion
{
	public function save(Doctrine_Connection $conn = null) {
		if (! $this->getToken ()) {
			$this->setToken ( md5(uniqid(rand(), true)));//sha1 ( time () . rand ( 11111, 99999 ) ) );
		}
		parent::save ( $conn );
	}
}