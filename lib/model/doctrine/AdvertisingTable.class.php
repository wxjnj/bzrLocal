<?php

/**
 * AdvertisingTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AdvertisingTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object AdvertisingTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Advertising');
    }
    public function getPager($page){
    
    	$q =  $this->createQuery('a')
    	->select('a.id,a.title,a.url,a.type')
    	->orderBy('a.id desc');
    
    	$pager = new sfDoctrinePager ( 'Advertising',  sfConfig::get('app_max_list_page',30));
    	$pager->setQuery ( $q );
    	$pager->setPage ( $page );
    	$pager->init ();
    
    	return $pager;
    }
    //取广告图片
    public function getList($limit,$category_id){
    
    	$q =  $this->createQuery('a')
    	->select('a.id,a.picture,a.url,a.content')
    	->Where('a.type = ?',$category_id)
    	->orderBy('a.id desc')
    	->limit($limit);
    
    	return $q->execute();
    }
}