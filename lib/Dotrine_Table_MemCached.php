<?php
class Doctrine_Table_MemCached extends Doctrine_Table {
	private $mem = null;
	
	public function initMem() {
		$this->mem = MemcacheManager::getInstance ();
		$this->mem->initialize ();
	}
	public function getNormalExecute($key, $query, $is_single = false) {
		if (sfConfig::get ( 'app_is_memcached' ) === false) {
			if ($is_single)
				$list = $query->fetchOne ();
			else
				$list = $query->execute ();
			return $list;
		}
		
		if ($this->mem == null){
			$this->initMem();
// 			throw new Exception ( '缓存管理对象未被初始化,请先调用initMem方法。' );
		}
		$ser = $this->mem->get($key);
		$list = unserialize($ser);
		
		if (!$list) {
			if ($is_single) {
				$list = $query->fetchOne ();
			} else {
				$list = $query->execute ();
			}
			
			$ser = serialize($list);
			$this->mem->set ( $key, $ser );
		}
		return $list;
	}
}