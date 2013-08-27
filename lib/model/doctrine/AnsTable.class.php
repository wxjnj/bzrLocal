<?php

/**
 * AnsTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AnsTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object AnsTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Ans');
    }
    public function getPager($page,$need_id){
    
    	$q =  $this->createQuery('a')
    	->select('a.id,a.content,a.attachment,a.attachment_name,a.is_true,a.created_at,u.nick_name uname')
    	->leftJoin('a.User u')
    	->leftJoin('a.Need n')
    	->where('n.id = ?',$need_id)
    	->orderBy('a.created_at desc');
    
    	$pager = new sfDoctrinePager ( 'Ans',  sfConfig::get('app_max_list_page',30));
    	$pager->setQuery ( $q );
    	$pager->setPage ( $page );
    	$pager->init ();
    
    	return $pager;
    
    }
}