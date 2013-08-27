<?php
class MemcacheManager
{
	private $memcached = null;
	private static $_instance;
	
	private function __construct()
	{
	}
	
	public static function getInstance()
	{
		if(!isset(self::$_instance))
		{
			$c=__CLASS__;
			self::$_instance=new $c;
		}
		return self::$_instance;
	}
	
	public function initialize()
	{
		if($this->memcached == null)
		{
			try{
				$this->memcached = new Memcache();
				$this->memcached->connect(sfConfig::get('app_memcached_localhost'),sfConfig::get('app_memcached_port'));
			}
			catch (Exception $e){
				return null;
			}
		}
	}
	
	public function getKeys()
	{
		$keys = $this->memcached->get('keys');
		return $keys;
	}
	
	public function set($key,$value,$exp = 0)
	{
		if($this->memcached->set($key,$value,$exp))
		{
			$keys = $this->memcached->get('keys');
			if(is_array($keys))
			{
				if( !isset($keys[$key]) )
				{
					$keys[$key] = $key;
					$this->memcached->set('keys',$keys);
				}
			}
			else
			{
				$keys = array();
				$keys[$key] = $key;
				$this->memcached->set('keys',$keys);
			}
			
			return true;
		}
		return false;
	}
	
	public function get($key)
	{
		try{
			return $this->memcached->get($key);
		}
		catch (Exception $e){
			return null;
		}
	}
	
	public function getMy($key)
	{
		try{
			$aa = $this->memcached->get($key);
			echo $aa;
			return $aa;
		}
		catch (Exception $e){
			echo '*';
			return -1;
		}
	}
	
	public function delete($key)
	{
		if($this->memcached->delete($key))
		{
			$keys = $this->memcached->get('keys');
			unset($keys[$key]);
			$this->memcached->set('keys',$keys);
		}
	}
	
	/**
	 * 删除$query开头的内存
	 * @param unknown_type $query
	 */
	public function deleteBy($query)
	{
		$keys = $this->getKeys();
		if($keys){
			foreach($keys as $key)
			{
				if(strpos($key,$query)!==false)
					$this->delete($key);
			}
		}
	}
	
	public function flush()
	{
		$this->memcached->flush();
	}
}