<?php
class StaticPageManager
{
	private function __construct()
	{
	}
	
	public static function generateHtml($html,$filename)
	{
		/*  留言之后用
		ob_start();
		$temp = ob_get_contents();
		ob_end_flush();
		//ob_end_clean();
		$fp = fopen('index.html','w');
		fwrite($fp,$temp) or die('写文件错误');
		*/
	
		$fp = fopen($filename,'w');
		fwrite($fp,$html) or die('写文件错误');
		fclose($fp);
	}
	/**
	 * 一次可以提交多条刷新请求，每个url 或dir 之间以%0D%0A（回车换行）分隔，例如：
	 * http://ccms.chinacache.com/index.jsp?user=yourusername&pswd=yourpassword&ok=ok
	 * &urls=http://www.chinacache.com/a.htm%0D%0A
	 * http://www.chinacache.com/b.htm&dirs=http://www.chinacache.com/a/%0D%0A
	 * http://www.chinacache.com/b/
	 * @param unknown_type $urls 
	 * @param unknown_type $dirs
	 */
	public static function remoteRefresh($urls,$dirs=null){
		
		$user = sfConfig::get('app_cdn_user');
		$pwd = sfConfig::get('app_cdn_pwd');
		
		$filename  = "http://ccms.chinacache.com/index.jsp?user=".$user;
		$filename .= "&pswd=".$pwd."&ok=ok";
		$filename .= "&urls=".$urls;
		if($dirs != null)
			$filename .= "&dirs=".$dirs;
		
		$handle = fopen ( $filename, "r" );
		
		$result = '';
		while ( ! feof ( $handle ) ) {
			$result .= fgets ( $handle );
		}
		fclose ( $handle );
		
		$xml = simplexml_load_string($result);
		$result = $xml->xpath("/result");
		if($result[0] == "failed")
		{
			//echo '刷新失败。';
			file_put_contents(sfConfig::get('sf_web_dir').'/cdnresult.txt','刷新失败');
			return false;
		}
		else
		{
			$url = $xml->xpath("/result/url");
			$dir = $xml->xpath("/result/dir");
		
			file_put_contents(sfConfig::get('sf_web_dir').'/cdnresult.txt','传入地址：'.$urls.'成功刷新文件：'.$url[0].'个，目录：'.$dir[0].'个。');
			//echo '成功刷新文件：'.$url[0].'个，目录：'.$dir[0].'个。';
			return $result;
		}
	}
}