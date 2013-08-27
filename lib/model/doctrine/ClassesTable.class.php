<?php

/**
 * ClassesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ClassesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ClassesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Classes');
    }
    public function getPager($page){
    
    	$user = sfContext::getInstance()->getUser()->getGuardUser()->getId();
    	$q =  $this->createQuery('c')
    	->select('c.id,c.token,c.name,c.description')
    	->where('c.user_id = ?', $user)
    	->orderBy('c.created_at desc');
    
    	$pager = new sfDoctrinePager ( 'Expert',  sfConfig::get('app_max_list_page',30));
    	$pager->setQuery ( $q );
    	$pager->setPage ( $page );
    	$pager->init ();
    
    	return $pager;
    }
}