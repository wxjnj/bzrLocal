<?php

/**
 * Job
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    bzr
 * @subpackage model
 * @author     gefei
 * @version    SVN: $Id: Builder.php,v 1.1 2012/05/04 06:47:28 zhaoy Exp $
 */
class Job extends BaseJob
{
	public function save(Doctrine_Connection $conn = null) {
		if (! $this->getToken ()) {
			$this->setToken ( md5(uniqid(rand(), true)));//sha1 ( time () . rand ( 11111, 99999 ) ) );
		}
		parent::save ( $conn );
	}
}