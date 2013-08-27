<?php
class ExternalData {
	//10.32.74.48:9080
	//const WX_SHIPINJIANGZUO = 'http://www.jiangsuedu.net/cms/manage/article/dwinterface/getInfo.nut?artid=2777542&pageSize=4&pageNumber=1';
	//const WX_FUMUXUETANG = 'http://www.jiangsuedu.net/cms/manage/article/dwinterface/getInfo.nut?artid=88888888&pageSize=4&pageNumber=1';
	//const WX_JIAJIAOYUSI = 'http://www.jiangsuedu.net/cms/manage/article/dwinterface/getInfo.nut?artid=2410362&pageSize=6&pageNumber=1';
	//const WX_CHENGZHANGBUFANNAO = 'http://www.jiangsuedu.net/cms/manage/article/dwinterface/getInfo.nut?artid=2494551&pageSize=6&pageNumber=1';
	
	const WX_SHIPINJIANGZUO = 'http://www.jiangsuedu.net/jswx/manage/article/dwinterface/getInfo.nut?artid=2644177&pageSize=4&pageNumber=1';
	const WX_FUMUXUETANG = 'http://www.jiangsuedu.net/jswx/manage/article/dwinterface/getInfo.nut?artid=88888888&pageSize=4&pageNumber=1';
	const WX_JIAJIAOYUSI = 'http://www.jiangsuedu.net/jswx/manage/article/dwinterface/getInfo.nut?artid=2602456&pageSize=6&pageNumber=1';
	const WX_CHENGZHANGBUFANNAO = 'http://www.jiangsuedu.net/jswx/manage/article/dwinterface/getInfo.nut?artid=2420842&pageSize=6&pageNumber=1';
	const WX_JINGCAIHUODONG = 'http://www.jiangsuedu.net/jswx/manage/article/dwinterface/getInfo.nut?artid=2269195&pageSize=6&pageNumber=1';
	
	const ZY_WOYUANYIBANGZHU = 'http://www.jsvolunteer.org/jsvolunteer/app/common/love_ajaxc.jsp?cid=25961159&areaId=37&type=1&amount=4';
	const ZY_WOYUANYIBANGZHUGENGDUO = 'http://www.jsvolunteer.org/jsvolunteer/app/country/love/willing_help.jsp?cid=25961159&orgarea=37&areaid=37';
	const ZY_WOYAOCANJIA = 'http://www.jsvolunteer.org/jsvolunteer/app/active/activelist_json.jsp';
	const ZY_LOGIN = 'http://www.jsvolunteer.org/jsvolunteer/app/zyzLogin.nut';
	const ZY_LOGIN2 = 'http://www.jsvolunteer.org/jsvolunteer/app/login.nut';
	const ZY_RESULT = 'http://www.jsvolunteer.org/jsvolunteer/app/country/index.jsp?areaid=37';
	const ZY_FINDPWD = 'http://www.jsvolunteer.org/jsvolunteer/app/findpwd/index.jsp?areaid=37';
	const ZY_REGSISTER ='http://www.jsvolunteer.org/jsvolunteer/app/pre_register.jsp?areaid=37';
	                              //localhost:8080/zjpt/fl/app/projectdonate/getlatestprojectlist.fk
	const GYAX_CISHANJUANZHU = 'http://gongyi.jiangsuedu.net/flzjpt/fl/app/projectdonate/getlatestprojectlist.fk';
	const GYAX_AIXINJUANZHU = 'http://gongyi.jiangsuedu.net/flzjpt/fl/app/projectdonate/getdonateuserlist.fk';
	const GYAX_ZONGJINE = 'http://gongyi.jiangsuedu.net/flzjpt/fl/app/projectdonate/getMaxMoney.fk';
	CONST GYAX_AIXINJUANZHU_SHIJIAN='http://gongyi.jiangsuedu.net/flzjpt/fl/app/projectdonate/getDonateByDateUserList.fk';
	private $mem = null;
	
	public function __construct() {
		$this->initMem ();
	}
	
	private function initMem() {
		$this->mem = MemcacheManager::getInstance ();
		$this->mem->initialize ();
	}
	
	/**
	 * 通过外部地址得到json数据
	 * @param unknown_type $url
	 * @return string
	 */
	public function getJsonData($url,$isSaveFile=true) {
		
		if ($this->mem == null)
			$this->initMem ();
		
		$key = 'homepage_' . $url;
		//先从缓存取，如果没有才重新通过外部链接取
		$result = null;//$this->mem->get ( $key );
		
		$filename = $this->getFileName ( $url );
		if ((! $result) || ($result == - 1)) {
			$result = '';
			
				$handle = fopen ( $url, "r" );
				if($handle){
					while ( ! feof ( $handle ) ) {
						$result .= fgets ( $handle );
					}
					fclose ( $handle );
				
					//从外部取完，放入缓存
					//$this->mem->set ( $key, $result );
					/*if($isSaveFile){
						try {
							//保存一份数据在本地文件
							if (! file_exists ( $filename ) && $result != - 1) {
								$f = fopen ( $filename, 'w' );
								fwrite ( $f, $result );
								fclose ( $f );
							}
						} catch ( Exception $e ) {
						}
					}*/
					
				}
			
		}
		
// 		if ($result == '' || $result == '-1') {
// 			$result = $this->readLocalFile ( $filename );
// 		}
		
		return $result;
	}
	
	public function postCurl($url,$post_data){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 我们在POST数据哦！
		curl_setopt($ch, CURLOPT_POST, 1);
		// 把post的变量加上
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
		$output = curl_exec($ch);
		//调试使用
		if ($output === FALSE) {
			return "cURL Error: " . curl_error($ch);
		}
		curl_close($ch);
		
		return $output;
		
	}
	
	public function readLocalFile($filename) {
		try {
			$result = '';
			$handle = fopen ( $filename, "r" );
			if($handle){
				while ( ! feof ( $handle ) ) {
					$result .= fgets ( $handle );
				}
				fclose ( $handle );
			}
			return $result;
		} catch ( Exception $e ) {
			return '暂无数据。';
		}
	}
	
	public function getFileName($key) {
		$filename = '';
		$ex = '.txt';
		$path = sfConfig::get ( 'sf_web_dir' ) . '/externaldata/';
		switch ($key) {
			case self::WX_SHIPINJIANGZUO :
				$filename = $path . 'WX_SHIPINJIANGZUO' . $ex;
				break;
			case self::WX_FUMUXUETANG :
				$filename = $path . 'WX_FUMUXUETANG' . $ex;
				break;
			case self::WX_JIAJIAOYUSI :
				$filename = $path . 'WX_JIAJIAOYUSI' . $ex;
				break;
			case self::WX_CHENGZHANGBUFANNAO :
				$filename = $path . 'WX_CHENGZHANGBUFANNAO' . $ex;
				break;
		}
		return $filename;
	}
}