<?php
class Tools {
	public static function delhtml($str){   //清除HTML标签
		$st=-1; //开始
		$et=-1; //结束
		$stmp=array();
		$stmp[]="&nbsp;";
		$len=strlen($str);
		for($i=0;$i<$len;$i++){
			$ss=substr($str,$i,1);
			if(ord($ss)==60){ //ord("<")==60
				$st=$i;
			}
			if(ord($ss)==62){ //ord(">")==62
				$et=$i;
				if($st!=-1){
					$stmp[]=substr($str,$st,$et-$st+1);
				}
			}
		}
		$str=str_replace($stmp,"",$str);
		return $str;
	}
	/**
	 * 从lexicon表中提取关键词集合与字符串对比，提取出字符串中包含的关键词
	 * @param string $str
	 * @return array
	 */
	public static function AutomaticInterceptKeywords($str){
		
		//$mem = MemcacheManager::getInstance ();
		//$mem->initialize ();
		//$ser = $mem->get('lexicons_mem');
		//$lexicons = unserialize($ser);
		//if( !$lexicons ){
			$lexicons = Doctrine::getTable('Lexicon')->findAll();
		//	$ser = serialize($lexicons);
		//	$mem->set('lexicons_mem',$ser);
		//}
		$keywords = array();
		
		foreach($lexicons as $lexicon){
			$name = $lexicon->getName();
			$rs = strpos($str, $name);
			if($rs !== false){
				$keywords[] = $name;
			}
		}
		return $keywords;
	}
	
	/**
	 * 验证用户输入的合法性
	 * 
	 * @param unknown_type $str        	
	 */
	public static function validInput($str) {
		if (strpos ( $str, 'script' ))
			return false;
		if (strpos ( $str, 'sql' ))
			return false;
		return true;
	}
	public static function getWeek() {
		$weekarray = array (
				"日",
				"一",
				"二",
				"三",
				"四",
				"五",
				"六" 
		);
		return "星期" . $weekarray [date ( "w" )];
	}
	
	public static function highlight($text,$keyword){
		$tmp = explode(" ", $keyword);
		foreach($tmp as $kw){
			$text = str_replace($kw, '<span style="background:#FFFF00;float:none">'.$kw.'</span>', $text);
		}
		return $text;//str_replace($keyword, '<span style="background:#FFFF00;float:none">'.$keyword.'</span>', $text);
	}
	/**
	 * 截取UTF8字符串
	 * 
	 * @param string $string        	
	 * @param int $sublen        	
	 * @param int $start        	
	 */
	public static function cur_str_utf8($string, $sublen, $start = 0,$is_shenglue = 1) {
		return self::cut_str ( $string, $sublen, $start, 'UTF-8',$is_shenglue );
	}
	
	public static function cut_str($string, $sublen, $start = 0, $code = 'UTF-8',$is_shenglue) {
		$string = str_replace ( '&nbsp;', '', $string );
		$string = str_replace ( '&ldquo;', '', $string );
		$string = str_replace ( '&rdquo;', '', $string );
		$string = str_replace ( '&amp;nbsp;', '', $string );
		$string = str_replace ( '&amp;ldquo;', '', $string );
		$string = str_replace ( '&amp;rdquo;', '', $string );
		$string = str_replace ( '&amp;mdash;', '-', $string );
		
		
		$string = trim ( $string );
		if ($code == 'UTF-8') {
			$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
			preg_match_all ( $pa, $string, $t_string );
			
			if (count ( $t_string [0] ) - $start > $sublen)
			{
				$tmp = array_slice ( $t_string [0], $start, $sublen );
				$k = 0;
				foreach($tmp as $var){
					if( is_numeric($var) ||  preg_match('/^[a-zA-Z\w\W]$/', $var) || $var == '-'){
						$k++;
					}
				}
				if($k>0){
					$sublen += $k/2;
					if($is_shenglue == 1)
						return join ( '', array_slice ( $t_string [0], $start, $sublen ) ) . "...";
					else
						return join ( '', array_slice ( $t_string [0], $start, $sublen ) ) ;
				}else{
					if($is_shenglue == 1)
						return join ( '', array_slice ( $t_string [0], $start, $sublen ) ) . "...";
					else
						return join ( '', array_slice ( $t_string [0], $start, $sublen ) ) ;
				}
			}
			return join ( '', array_slice ( $t_string [0], $start, $sublen ) );
		} else {
			$start = $start * 2;
			$sublen = $sublen * 2;
			$strlen = strlen ( $string );
			$tmpstr = '';
			
			for($i = 0; $i < $strlen; $i ++) {
				if ($i >= $start && $i < ($start + $sublen)) {
					if (ord ( substr ( $string, $i, 1 ) ) > 129) {
						$tmpstr .= substr ( $string, $i, 2 );
					} else {
						$tmpstr .= substr ( $string, $i, 1 );
					}
				}
				if (ord ( substr ( $string, $i, 1 ) ) > 129)
					$i ++;
			}
			if (strlen ( $tmpstr ) < $strlen && $is_shenglue == 1)
				$tmpstr .= "...";
			return $tmpstr;
		}
	}
	
	/**
	 * 用于autocomplete的数组转json的方法
	 * 
	 * @param unknown_type $array        	
	 * @return boolean string
	 */
	public static function array_to_json($array) {
		
		if (! is_array ( $array )) {
			return false;
		}
		
		$associative = count ( array_diff ( array_keys ( $array ), array_keys ( array_keys ( $array ) ) ) );
		if ($associative) {
			
			$construct = array ();
			foreach ( $array as $key => $value ) {
				
				// We first copy each key/value pair into a staging array,
				// formatting each key and value properly as we go.
				
				// Format the key:
				if (is_numeric ( $key )) {
					$key = "key_$key";
				}
				$key = "\"" . addslashes ( $key ) . "\"";
				
				// Format the value:
				if (is_array ( $value )) {
					$value = self::array_to_json ( $value );
				} else if (! is_numeric ( $value ) || is_string ( $value )) {
					$value = "\"" . addslashes ( $value ) . "\"";
				}
				
				// Add to staging array:
				$construct [] = "$key: $value";
			}
			
			// Then we collapse the staging array into the JSON form:
			$result = "{ " . implode ( ", ", $construct ) . " }";
		
		} else { // If the array is a vector (not associative):
			
			$construct = array ();
			foreach ( $array as $value ) {
				
				// Format the value:
				if (is_array ( $value )) {
					$value = self::array_to_json ( $value );
				} else if (! is_numeric ( $value ) || is_string ( $value )) {
					$value = "'" . addslashes ( $value ) . "'";
				}
				
				// Add to staging array:
				$construct [] = $value;
			}
			
			// Then we collapse the staging array into the JSON form:
			$result = "[ " . implode ( ", ", $construct ) . " ]";
		}
		
		return $result;
	}
	
	public static function safeEncoding($string, $outEncoding = 'UTF-8') {
		$encoding = "UTF-8";
		for($i = 0; $i < strlen ( $string ); $i ++) {
			if (ord ( $string {$i} ) < 128)
				continue;
			
			if ((ord ( $string {$i} ) & 224) == 224) {
				// 第一个字节判断通过
				$char = $string {++ $i};
				if ((ord ( $char ) & 128) == 128) {
					// 第二个字节判断通过
					$char = $string {++ $i};
					if ((ord ( $char ) & 128) == 128) {
						$encoding = "UTF-8";
						break;
					}
				}
			}
			
			if ((ord ( $string {$i} ) & 192) == 192) {
				// 第一个字节判断通过
				$char = $string {++ $i};
				if ((ord ( $char ) & 128) == 128) {
					// 第二个字节判断通过
					$encoding = "GB2312";
					break;
				}
			}
		}
		
		if (strtoupper ( $encoding ) == strtoupper ( $outEncoding ))
			return $string;
		else
			return iconv ( $encoding, $outEncoding, $string );
	}
}