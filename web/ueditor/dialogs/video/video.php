<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>视频</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="/css/video.css" />
    <script type="text/javascript" src="/js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/js/ajaxfileupload.js"></script>
	
	<link rel="stylesheet" type="text/css" href="/uploadify/uploadify.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="/uploadify/jquery.uploadify-3.1.min.js"></script>
</head>
<body>



<div class="wrapper">
    <div id="videoTab">
        <div id="tabHeads">
            <span tabSrc="video" class="focus">插入视频</span>
            <!--  <span tabSrc="videoSearch">视频搜索</span>
            <!--  <span tabSrc="videoUpload">上传</span> -->
            <span tabSrc="videoLocalSearch">视频搜索</span>
            
        </div>
        <div id="tabBodys">
            <div id="video" class="panel">
               <table><tr><td><label for="videoUrl" class="url">视频地址</label></td><td><input id="videoUrl" type="text"></td></tr></table>
               <div id="preview"></div>
               <div id="videoInfo">
                   <fieldset>
                       <legend>视频尺寸</legend>
                       <table>
                           <tr><td><label for="videoWidth">宽度</label></td><td><input class="txt" id="videoWidth" type="text"/></td></tr>
                           <tr><td><label for="videoHeight">高度</label></td><td><input class="txt" id="videoHeight" type="text"/></td></tr>
                       </table>
                   </fieldset>
                   <fieldset>
                      <legend>对齐方式</legend>
                      <div id="videoFloat"></div>
                  </fieldset>
               </div>
            </div>
            <div id="videoSearch" class="panel" style="display: none">
                <table style="margin-top: 5px;">
                    <tr>
                        <td><input id="videoSearchTxt" value="请输入搜索关键词" type="text" /></td>
                        <td>
                            <select id="videoType">
                                <option value="0">全部</option>
                                <option value="29">热点</option>
                                <option value="1">娱乐</option>
                                <option value="5">搞笑</option>
                                <option value="15">体育</option>
                                <option value="21">科技</option>
                                <option value="31">综艺</option>
                            </select>
                        </td>
                        <td><input id="videoSearchBtn" type="button" value="百度一下" /></td>
                        <td><input id="videoSearchReset" type="button" value="清空搜索" /></td>
                    </tr>
                </table>
                <div id="searchList"></div>
            </div>
            <div id="videoUpload" class="panel" style="display: none;">
            	<table style="width:550px;" >
            	<!--  
            	<tr>
            		<td><label class="url">本地视频</label>&nbsp;</td>
            		<td><input id="fileToUpload" type="file" size="20" name="fileToUpload" class="input" ></td>
            		<td><button class="button" id="buttonUpload" onclick="return ajaxFileUpload();">上传</button></td>
            		<td><img id="loading" src="/images/loading.gif" style="width:20px;display:none;"></td>
            	</tr>
            	-->
            	<tr>
	            	<td>
				    <script type="text/javascript">
				    $(function() {
				        $('#file_upload').uploadify({
				        	'auto'     : false,//是否自动上传
				        	'buttonClass' : 'some-class',//按钮样式
				        	//'checkExisting' : '/uploadify/check-exists.php',//检查文件是否存在
				        	'buttonText' : '选择文件',//按钮文本
				        	'fileSizeLimit' : '30MB',//单个文件上传大小限制
				        	'fileTypeExts' : '*.flv',//'*.wmv;*.vob;*.mp4;*.avi',//限制上传格式
				        	'height'   : 30,//按钮高度
				            'swf'      : '/uploadify/uploadify.swf',
				            'uploader' : '/uploadify/uploadify.php',
				            'multi': false, //多文件上传，
				            'cancelImg': '/uploadify/uploadify-cancel.png',//取消按钮
				            'removeCompleted': true,
				            'onUploadSuccess' : function(file, data, response) {
				            	$('#videoUrl_upload').val(data);
				            } 
				            // Your options here
				        });
				    });
				    </script>
				    <input type="file" name="file_upload" id="file_upload" />
				    <a href="javascript:$('#file_upload').uploadify('upload')">上传</a>
				    </td>
			    </tr>
				</table>
			    
				<script type="text/javascript">
				function ajaxFileUpload(){
					loading();//动态加载小图标
				    $.ajaxFileUpload({
					url :'upload.php',
					secureuri :false,
					fileElementId :'fileToUpload',
					dataType : 'text',
					success : function (data, status){
						if(data == 0)
						{
							$('#videoUrl_upload').val('无效的文件，必须上传小于10M的flv文件！');
						}
						else
						{
							$('#videoUrl_upload').val(data);
						}
						
						if(typeof(data.error) != 'undefined'){
							if(data.error != ''){
								alert(data.error);
							}else{
								alert(data.msg);
							}
						}
					},
					error: function (data, status, e){
						alert(e);
				    }
				})
				return false;
				}
				
				function loading(){	
					$("#loading").ajaxStart(function(){
						$(this).show();
					}).ajaxComplete(function(){
						$(this).hide();
					});
				}
				</script>
               
               
               <table><tr><td><label for="videoUrl" class="url">视频地址</label></td><td><input id="videoUrl_upload" value="" type="text"></td></tr></table>
			   <div id="preview_upload"></div>
               <div id="videoInfo_upload">
                   <fieldset>
                       <legend>视频尺寸</legend>
                       <table>
                           <tr><td><label for="videoWidth">宽度</label></td><td><input class="txt" id="videoWidth_upload" type="text" value="590"/></td></tr>
                           <tr><td><label for="videoHeight">高度</label></td><td><input class="txt" id="videoHeight_upload" type="text" value="453"/></td></tr>
                       </table>
                   </fieldset>
                   <fieldset style="display:none;">
                      <legend>对齐方式</legend>
                      <div id="videoFloat_upload"></div>
                  </fieldset>
               </div>
               
            </div>
            <div id="videoLocalSearch" class="panel" style="display: none;">
            	<table style="margin:5px;" >
            		<tr>
            			<td width="160"><input type="text" id="localSearchText"/></td>
            			<td><input type="button" value="搜索上传视频" id="localSearchButton"/></td>
            		</tr>
            	</table>
            	<div class="loading" style="display:none"><img src="/images/loading2.gif"/></div>
            	<div id="videoLocalSearchList">
            		
            	</div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="../internal.js"></script>
<script type="text/javascript" src="video.js"></script>
<script type="text/javascript" src="localSearch.js"></script>
<script type="text/javascript">
    window.onload = function(){
        video.init();
        $focus($G("videoUrl"));
        videoUpload.init();
        $focus($G("videoUrl_upload"));
    };
</script>

</body>
</html>