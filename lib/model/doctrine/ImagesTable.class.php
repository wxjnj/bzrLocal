<?php

/**
 * ImagesTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class ImagesTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object ImagesTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Images');
    }
    public function getPager($page){
    
    	$q =  $this->createQuery('i')
    	->select('i.id,i.title,i.weight')
    	->orderBy('i.weight desc');
    
    	$pager = new sfDoctrinePager ( 'Images',  sfConfig::get('app_max_list_page',30));
    	$pager->setQuery ( $q );
    	$pager->setPage ( $page );
    	$pager->init ();
    
    	return $pager;
    }
    public function getList($limit,$type){
    
    	$q =  $this->createQuery('i')
    	->select('i.id,i.title,i.picture,i.url,i.weight')
    	->where('i.type = ?',$type)
    	->orderBy('i.weight desc')
    	->limit($limit);
    
    	return $q->execute();
    }
}