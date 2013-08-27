<?php
class ArticlePaging{
	
	private $_content;//文章内容
	private $_length = 30;//一页的字符数
	private $_limits = 20;//容差范围
	private $_separator = '</p>';//截取的分隔符
	public $_contentArray = array();//分页存储的内容
	
	/**
	 * 构造函数。
	 * 第二个参数可选，用来修改默认配置
	 * @param string $content 文章内容
	 * @param array $configParams array('length'=>'每页显示字符数','limits'=>'容差范围','separator'=>'分隔符')
	 */
	public function __construct($content,$configParams=null){
		$this->_content = str_replace('</P>', $this->_separator, $content);
		
		if(is_array($configParams)){
			$this->config($configParams);
		}
		
		$this->subContent();
	}
	
	public function getPageCount(){
		return count($this->_contentArray);
	}
	
	public function getContentByPage($page){
		return isset($this->_contentArray[$page-1])?$this->_contentArray[$page-1]:null;
	}
	
	private function config($params){
		if(isset($params['length'])){
			$length = $params['length'];
			if(is_int($length) && $length>1)
				$this->_length = $length;
		}
		if(isset($params['limits'])){
			$limits = $params['limits'];
			if(is_int($limits) && $limits>1)
				$this->_limits = $limits;
		}
		if(isset($params['separator'])){
			$this->_separator = $params['separator'];
		}
	}
	
	private function subContent(){
		$contentLength = strlen($this->_content);
		$start = 0;
		while($start < $contentLength){
			$start = $this->doSubContent($this->_content,$start);
			if(!$start)
				break;
		}
	}
	
	private function doSubContent($content,$start){
		$pos = $this->getPos($content, $start);
		if(!$pos){
			return false;
		}
		$end = $pos + $this->getSeparatorLength();
		$length = $pos - $start + $this->getSeparatorLength();
		
		$this->_contentArray[] = substr($content, $start,$length);
		return $end;
	}
	
	private function getPos($content,$start){
		
		$pos = strpos($content, $this->_separator, $start);
		$length = $start+$this->_length;
		if(!$pos){
			return false;
		}
		if($pos < $length && $length-$pos <= $this->_limits ){
			return $pos;
		}else if($pos >= $length){
			return $pos;
		}else if($pos == false){
			return $pos;
		}else{
			return $this->getPos($content, $pos+$this->getSeparatorLength());
		}
		
	}
	
	private function getSeparatorLength(){
		return strlen($this->_separator);
	}

}