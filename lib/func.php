<?php 


/**
*获取用户ip
*
*@return $ip 获取到的用户ip
*/

function getIp(){
	if(getenv('REMOTE_ADDR')){
		return $ip = getenv('REMOTE_ADDR');
	}else if (getenv('HTTP_CLIENT_IP')){
		return $ip = getenv('HTTP_CLIENT_IP');
	}else if (getenv('HTTP_X_FORWARDED_FOR')){
		return $ip = getenv('HTTP_X_FORWARDED_FOR');
	}else{
		return false;
	}
}

/**
*获取页码数,固定显示5个页码数
*
*@param $num 总文章数
*@param $cnt 每页显示几篇文章
*@param $curr  当前页面的页码数
*@return array $pages  获取到的页码数
*/

function getPage($num,$curr,$cnt=5){
	//总页码数
	$pagenum = ceil($num/$cnt);
	//最左边的页码数
	$left = max($curr-2,1);
	//最右边的页码数
	$right = min($left+4,$pagenum);
	//最左边的页码数
	$left = max($right-4,1);

	$page = array();
	for ($i=$left; $i<=$right ; $i++) { 
		$page[] = $i;
	}
	return $page;
}



/**
*获取文件后缀(带点的)
*
*@param $filename 待截取的文件名
*@return $ext 获取到的文件后缀
*/

function getExt($filename){
	return $ext = strrchr($filename,'.');
}

/**
*按日期创建存储目录
*
*@return $path 创建好的存储目录
*/

function createDir(){
	$path = '/upload/'.date('Y/md');
	$abspath = PATH.$path;
	if(is_dir($abspath)||mkdir($abspath,0777,true)){
		return $path;
	}else{
		return false;
	}
}

/**
 * 上传文件操作
 *
 * @return $file 返回移动后的文件路径
 */
function upFile(){
	$dir = PATH."/upload/images/".date('Y_m_d');
	$dir_bak = "./upload/images/".date('Y_m_d');
	is_dir($dir) || mkdir($dir,0777,true);
	$fileName = date('Y_m_d_H_i_s', time())."_".(rand(100000,900000));
	$fileType = strrchr($_FILES["user_pic"]["name"], ".");
	$fileName = "Upload_".$fileName.$fileType;
	$destination =  $dir."/".$fileName;
	move_uploaded_file($_FILES["user_pic"]["tmp_name"],$destination);
	$filePath  = $dir_bak."/".$fileName;
	return $filePath;
}

?>