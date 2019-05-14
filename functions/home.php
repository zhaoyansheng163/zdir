<?php
	@$admin = $_GET['admin'];
	//获取当前目录
	$thedir = __DIR__;
	$thedir = str_replace("\\",'/',$thedir);
	$thedir = str_replace("functions",'',$thedir);
	
	$i = 0;

	//----------------------------------------------
	$auth_users = array(
    'admin' => password_hash($config['password'], PASSWORD_DEFAULT) //admin@123
);
	$http_host = $_SERVER['HTTP_HOST'];
// abs path for site
defined('FM_ROOT_URL') || define('FM_ROOT_URL', ($is_https ? 'https' : 'http') . '://' . $http_host . (!empty($root_url) ? '/' . $root_url : ''));
defined('FM_SELF_URL') || define('FM_SELF_URL', ($is_https ? 'https' : 'http') . '://' . $http_host . $_SERVER['PHP_SELF']);

// Auth with login/password (set true/false to enable/disable it)
$use_auth = true;
	// Auth
if ($use_auth) {
	if (isset($_SESSION[FM_SESSION_ID]['logged'], $auth_users[$_SESSION[FM_SESSION_ID]['logged']])) {
			// Logged
	} elseif (isset($_POST['fm_usr'], $_POST['fm_pwd'])) {
			// Logging In
			//$use_auth = false;
			//$_SESSION[FM_SESSION_ID]['logged'] = $_POST['fm_usr'];
			//fm_set_msg('You are logged in');
			$username = $_POST['fm_usr'];
			$mima = $_POST['fm_pwd'];
			sleep(1);
			if(function_exists('password_verify')) {
				//echo "<script language=javascript>alert($mima);</script>";
				//if (isset($auth_users[$_POST['fm_usr']]) && isset($_POST['fm_pwd']) && password_verify($_POST['fm_pwd'], $auth_users[$_POST['fm_usr']])) {
					if (isset($auth_users[$_POST['fm_usr']]) && isset($_POST['fm_pwd']) && password_verify($_POST['fm_pwd'], $auth_users[$_POST['fm_usr']])) {
						echo "<script language=javascript>alert('对不起! -if mima ok');</script>";
							$_SESSION[FM_SESSION_ID]['logged'] = $_POST['fm_usr'];
							fm_set_msg('You are logged in');
							$use_auth = false;
							//fm_redirect(FM_SELF_URL . '?p=');
					} else {
						echo "<script language=javascript>alert('对不起! -if mima error');</script>";
							unset($_SESSION[FM_SESSION_ID]['logged']);
							fm_set_msg('Login failed. Invalid username or password', 'error');
					}
			} else {
				echo "<script language=javascript>alert('对不起! -if else');</script>";
					fm_set_msg('password_hash not supported, Upgrade PHP version', 'error');;
					
			}
			
	} else {
			// Form
			unset($_SESSION[FM_SESSION_ID]['logged']);
			fm_show_header_login();
			fm_show_message();
			?>
			<section class="h-100">
					<div class="container h-100">
							<div class="row justify-content-md-center h-100">
									<div class="card-wrapper">
											<div class="brand">
													<svg version="1.0" xmlns="http://www.w3.org/2000/svg" M1008 width="100%" height="121px" viewBox="0 0 238.000000 140.000000" aria-label="H3K Tiny File Manager">
															<g transform="translate(0.000000,140.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
																	<path d="M160 700 l0 -600 110 0 110 0 0 260 0 260 70 0 70 0 0 -260 0 -260 110 0 110 0 0 600 0 600 -110 0 -110 0 0 -260 0 -260 -70 0 -70 0 0 260 0 260 -110 0 -110 0 0 -600z"/>
																	<path fill="#003500" d="M1008 1227 l-108 -72 0 -117 0 -118 110 0 110 0 0 110 0 110 70 0 70 0 0 -180 0 -180 -125 0 c-69 0 -125 -3 -125 -6 0 -3 23 -39 52 -80 l52 -74 73 0 73 0 0 -185 0 -185 -70 0 -70 0 0 115 0 115 -110 0 -110 0 0 -190 0 -190 181 0 181 0 109 73 108 72 1 181 0 181 -69 48 -68 49 68 50 69 49 0 249 0 248 -182 -1 -183 0 -107 -72z"/>
																	<path d="M1640 700 l0 -600 110 0 110 0 0 208 0 208 35 34 35 34 35 -34 35 -34 0 -208 0 -208 110 0 110 0 0 212 0 213 -87 87 -88 88 88 88 87 87 0 213 0 212 -110 0 -110 0 0 -208 0 -208 -70 -69 -70 -69 0 277 0 277 -110 0 -110 0 0 -600z"/></g>
													</svg>
											</div>
											<div class="text-center">
													<h1 class="card-title"><?php echo lng('AppName'); ?></h1>
											</div>
											<div class="card fat">
													<div class="card-body">
															<form class="form-signin" action="" method="post" autocomplete="off">
																	<div class="form-group">
																			<label for="fm_usr"><?php echo lng('Username'); ?></label>
																			<input type="text" class="form-control" id="fm_usr" name="fm_usr" required autofocus>
																	</div>

																	<div class="form-group">
																			<label for="fm_pwd"><?php echo lng('Password'); ?></label>
																			<input type="password" class="form-control" id="fm_pwd" name="fm_pwd" required>
																	</div>

																	<div class="form-group">
																			<div class="custom-checkbox custom-control">
																					<input type="checkbox" name="remember" id="remember" class="custom-control-input">
																					<label for="remember" class="custom-control-label"><?php echo lng('RememberMe'); ?></label>
																			</div>
																	</div>

																	<div class="form-group">
																			<button type="submit" class="btn btn-success btn-block" role="button">
																					<?php echo lng('Login'); ?>
																			</button>
																	</div>
															</form>
													</div>
											</div>
											<div class="footer text-center">
													&mdash;&mdash; &copy;
													<?php  if(!isset($_COOKIE['fm_cache'])) { ?> <img src="https://logs-01.loggly.com/inputs/d8bad570-def7-44d4-922c-a8680d936ae6.gif?s=1" /> <?php } ?>
													<a href="https://tinyfilemanager.github.io/" target="_blank" class="text-muted" data-version="<?php echo VERSION; ?>">CCP Programmers</a> &mdash;&mdash;
											</div>
									</div>
							</div>
					</div>
			</section>

			<?php
			fm_show_footer_login();
			exit;
	}
}
	
/**
 * Show page header in Login Form
 */
function fm_show_header_login()
{
$sprites_ver = '20160315';
header("Content-Type: text/html; charset=utf-8");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

global $lang, $root_url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Web based File Manager in PHP, Manage your files efficiently and easily with Tiny File Manager">
    <meta name="author" content="CCP Programmers">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex">
    <link rel="icon" href="<?php echo $root_url ?>?img=favicon" type="image/png">
    <title>H3K | Tiny File Manager</title>
    <link rel="stylesheet" href="https://lib.sinaapp.com/js/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body.fm-login-page{background-color:#f7f9fb;font-size:14px}
        .fm-login-page .brand{width:121px;overflow:hidden;margin:0 auto;margin:40px auto;margin-bottom:0;position:relative;z-index:1}
        .fm-login-page .brand img{width:100%}
        .fm-login-page .card-wrapper{width:360px}
        .fm-login-page .card{border-color:transparent;box-shadow:0 4px 8px rgba(0,0,0,.05)}
        .fm-login-page .card-title{margin-bottom:1.5rem;font-size:24px;font-weight:300;letter-spacing:-.5px}
        .fm-login-page .form-control{border-width:2.3px}
        .fm-login-page .form-group label{width:100%}
        .fm-login-page .btn.btn-block{padding:12px 10px}
        .fm-login-page .footer{margin:40px 0;color:#888;text-align:center}
        @media screen and (max-width: 425px) {
            .fm-login-page .card-wrapper{width:90%;margin:0 auto}
        }
        @media screen and (max-width: 320px) {
            .fm-login-page .card.fat{padding:0}
            .fm-login-page .card.fat .card-body{padding:15px}
        }
        .message{padding:4px 7px;border:1px solid #ddd;background-color:#fff}
        .message.ok{border-color:green;color:green}
        .message.error{border-color:red;color:red}
        .message.alert{border-color:orange;color:orange}
    </style>
</head>
<body class="fm-login-page">
<div id="wrapper" class="container-fluid">

    <?php
    }

    /**
     * Show page footer in Login Form
     */
    function fm_show_footer_login()
    {
    ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js"></script>
<script src="https://lib.sinaapp.com/js/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
<?php
}

/**
 * Show message from session
 */
function fm_show_message()
{
    if (isset($_SESSION[FM_SESSION_ID]['message'])) {
        $class = isset($_SESSION[FM_SESSION_ID]['status']) ? $_SESSION[FM_SESSION_ID]['status'] : 'ok';
        echo '<p class="message ' . $class . '">' . $_SESSION[FM_SESSION_ID]['message'] . '</p>';
        unset($_SESSION[FM_SESSION_ID]['message']);
        unset($_SESSION[FM_SESSION_ID]['status']);
    }
}

/**
 * Language Translation System
 * @param string $txt
 * @return string
 */
function lng($txt) {
	global $lang;

	// Chinese (Simplified)
	$tr['ch']['AppName']        = 'Zdir';                $tr['ch']['AppTitle']           = 'Zdir';
	$tr['ch']['Login']          = '登录';                 $tr['ch']['Username']           = '账号';
	$tr['ch']['Password']       = '密码';                 $tr['ch']['Logout']             = '注销';
	$tr['ch']['Move']           = '移动';                 $tr['ch']['Copy']               = '复制';
	$tr['ch']['Save']           = '保存';                 $tr['ch']['SelectAll']          = '全选';
	$tr['ch']['UnSelectAll']    = '取消全选';             $tr['ch']['File']               = '文件';
	$tr['ch']['Back']           = '返回';                 $tr['ch']['Size']               = '大小';
	$tr['ch']['Perms']          = '权限';                 $tr['ch']['Modified']           = '修改时间';
	$tr['ch']['Owner']          = '所有人';               $tr['ch']['Search']             = '搜索';
	$tr['ch']['NewItem']        = '新文件';               $tr['ch']['Folder']             = '文件夹';
	$tr['ch']['Delete']         = '删除';                 $tr['ch']['Rename']             = '重命名';
	$tr['ch']['CopyTo']         = '复制到';               $tr['ch']['DirectLink']         = '直链';
	$tr['ch']['UploadingFiles'] = '上传文件';             $tr['ch']['ChangePermissions']  = '修改权限';
	$tr['ch']['Copying']        = '复制';                 $tr['ch']['CreateNewItem']      = '创建新文件';
	$tr['ch']['Name']           = '文件名';               $tr['ch']['AdvancedEditor']     = '高级编辑';
	$tr['ch']['RememberMe']     = '记住我';               $tr['ch']['Actions']            = '动作';
	$tr['ch']['Upload']         = '上传';                 $tr['ch']['Cancel']             = '取消';
	$tr['ch']['InvertSelection']= '反选';                 $tr['ch']['DestinationFolder']  = '目标文件夹';
	$tr['ch']['ItemType']       = '文件类型';             $tr['ch']['ItemName']           = '文件名称';
	$tr['ch']['CreateNow']      = '创建';                 $tr['ch']['Download']           = '下载';
	$tr['ch']['Open']           = '打开';                 $tr['ch']['UnZip']              = '解压';
	$tr['ch']['UnZipToFolder']  = '解压至文件夹';          $tr['ch']['Edit']               = '编辑';
	$tr['ch']['NormalEditor']   = '普通编辑';              $tr['ch']['BackUp']            = '备份';
	$tr['ch']['SourceFolder']   = '源文件夹';              $tr['ch']['Files']              = '文件';
	$tr['ch']['Move']           = '移动';                  $tr['ch']['Change']            = '修改';
	$tr['ch']['Settings']       = '设置';                  $tr['ch']['Language']          = '语言';
	$tr['ch']['MemoryUsed']     = '使用的内存';            $tr['ch']['PartitionSize']     = '分区大小';
	$tr['ch']['ErrorReporting'] = '错误报告';              $tr['ch']['ShowHiddenFiles']   = '显示隐藏文件';
	$tr['ch']['FreeOf']         = '免费的';                $tr['ch']['FullSize']             = '全尺寸';
	$tr['ch']['Zip']            = 'Zip';                  $tr['ch']['Tar']                 = 'Tar';

	$i18n = fm_get_translations($tr);
	$tr = $i18n ? $i18n : $tr;

	if (!strlen($lang)) $lang = 'en';
	if (isset($tr[$lang][$txt])) return fm_enc($tr[$lang][$txt]);
	else if (isset($tr['en'][$txt])) return fm_enc($tr['en'][$txt]);
	else return "$txt";
}
/*
 * get language translations from json file
 * @param int $tr
 * @return array
 */
function fm_get_translations($tr) {
	try {
			$content = @file_get_contents('translation.json');
			if($content !== FALSE) {
					$lng = json_decode($content, TRUE);
					global $lang_list;
					foreach ($lng["language"] as $key => $value)
					{
							$code = $value["code"];
							$lang_list[$code] = $value["name"];
							if ($tr)
									$tr[$code] = $value["translation"];
					}
					return $tr;
			}

	}
	catch (Exception $e) {
			echo $e;
	}
}

/**
 * Save message in session
 * @param string $msg
 * @param string $status
 */
function fm_set_msg($msg, $status = 'ok')
{
    $_SESSION[FM_SESSION_ID]['message'] = $msg;
    $_SESSION[FM_SESSION_ID]['status'] = $status;
}

/**
 * HTTP Redirect
 * @param string $url
 * @param int $code
 */
function fm_redirect($url, $code = 302)
{
    header('Location: ' . $url, true, $code);
    exit;
}

// Set Cookie
setcookie('fm_cache', true, 2147483647, "/");

// if fm included
if (defined('FM_EMBED')) {
    $use_auth = false;
    $sticky_navbar = false;
} else {
    @set_time_limit(600);

    date_default_timezone_set($default_timezone);

    ini_set('default_charset', 'UTF-8');
    if (version_compare(PHP_VERSION, '5.6.0', '<') && function_exists('mb_internal_encoding')) {
        mb_internal_encoding('UTF-8');
    }
    if (function_exists('mb_regex_encoding')) {
        mb_regex_encoding('UTF-8');
    }

    session_cache_limiter('');
    session_name(FM_SESSION_ID );
    @session_start();
}

if (empty($auth_users)) {
    $use_auth = false;
}

//----------------------------------------------

	//获取目录
	$dir = $_GET['dir'];
	$dir = strip_tags($dir);
	$dir = str_replace("\\","/",$dir);
	$rel_path = $thedir."/".$dir;
	//获取markdown文件地址
	
	//echo $readme;
	//对目录进行过滤
	if((stripos($dir,'./') === 0) || (stripos($dir,'../')) || (stripos($dir,'../') === 0) || (stripos($dir,'..') === 0) || (stripos($dir,'..'))){
		echo '非法请求！';
		exit;
	}
	//分割字符串
	$navigation = explode("/",$dir);

	if(($dir == '') || (!isset($dir))) {
		$listdir = scandir($thedir);
		$readme = $thedir.'/readme.md';
	}
	//如果目录不存在
	else if(!is_dir($rel_path)){
		echo '目录不存在，3s后返回首页！';
		header("Refresh:3;url=index.php");
		exit;
	}
	else{
		$listdir = scandir($thedir."/".$dir);
		$readme = $thedir."/".$dir.'/readme.md';
	}
	//遍历目录和文件，并进行排序，文件夹排前面
	$newdir = array();
	$newfile = array();
	foreach( $listdir as $value )
	{
		//如果参数为空
		if(!isset($dir)){
			$tmp_path = $thedir;
		}
		if(isset($dir)){
			$tmp_path = $thedir.'/'.$dir.'/'.$value;
		}
		$tmp_path = str_replace("///","/",$tmp_path);
		//echo $tmp_path."<br />";
		//如果是文件夹
		if(is_dir($tmp_path)){
			array_push($newdir,$value);
		}
		else{
			array_push($newfile,$value);
		}
	}
	//两个数组顺序合并
	$listdir = array_merge($newdir,$newfile);
	
	$readme = str_replace('\\','/',$readme);
	//计算上级目录
	function updir($dir){
		//分割目录
		$dirarr = explode("/",$dir);
		$dirnum = count($dirarr);
		
		#var_dump($dirarr);
		if($dirnum == 2) {
			$updir = 'index.php';
		}
		else{
			$updir = '';
			for ( $i=1; $i < ($dirnum - 1); $i++ )
			{ 
				$next = $i + 1;
				$updir = $updir.'/'.$dirarr[$i];
				
			}
			$updir = 'index.php?dir='.$updir;
		}
		return $updir;
	}
	#echo updir($dir);
	$updir = updir($dir);

?>
<?php
	//载入页头
	include_once("./template/header.php")
?>
    <!--面包屑导航-->
	<div id="navigation" class = "layui-hide-xs">
		<div class="layui-container">
			<div class="layui-row">
				<div class="layui-col-lg12">
					<p>
						当前位置：<a href="./">首页</a> 
						<!--遍历导航-->
						<?php foreach( $navigation as $menu )
						{
							$remenu = $remenu.'/'.$menu;
							
							if($remenu == '/'){
								$remenu = $menu;
							}
						?>
						<a href="./index.php?dir=<?php echo $remenu; ?>"><?php echo $menu; ?></a> / 
						<?php } ?>
					</p>
				</div>
				<!--使用说明-->
				<!--<div class="layui-col-lg12" style = "margin-top:1em;">
					<div class="layui-collapse">
					  <div class="layui-colla-item">
					    <h2 class="layui-colla-title">使用说明（必看）</h2>
					    <div class="layui-colla-content">
						    <iframe src="<?php echo './functions/viewmd.php?file='.$readme; ?>" width="100%" height="600px" name="" frameborder = "0" align="middle"></iframe>
					    </div>
					  </div>
					</div>
				</div>-->
				<!--使用说明END-->
			</div>
		</div>
	</div>
    <!--面包屑导航END-->
	<!--遍历目录-->
	<div id="list">
		<div class="layui-container">
		  	<div class="layui-row">
		    	<div class="layui-col-lg12">
			    	<table class="layui-table" lay-skin="line">
					  	<colgroup>
					    <col width="400">
					    <col width="200">
					    <col width="200">
					    <col width="180">
					    <col>
					  </colgroup>
					  <thead>
					    <tr>
					      <th>文件名</th>
					      <th class = "layui-hide-xs"></th>
					      <th class = "layui-hide-xs">修改时间</th>
					      <th>文件大小</th>
					      <th class = "layui-hide-xs">操作</th>
					    </tr> 
					  </thead>
					  <tbody>
					    <?php foreach( $listdir as $showdir ) {
						    //防止中文乱码
						    //$showdir = iconv('gb2312' , 'utf-8' , $showdir );
						    $fullpath = $thedir.'/'.$dir.'/'.$showdir;
						    $fullpath = str_replace("\\","\/",$fullpath);
						    $fullpath = str_replace("//","/",$fullpath);
						    
						    //获取文件修改时间
						    $ctime = filemtime($fullpath);
						    $ctime = date("Y-m-d H:i",$ctime);

						    
						    //搜索忽略的目录，如果包含.php 一并排除
						    if(array_search($showdir,$ignore) || strripos($showdir,".php")) {
							    continue;
						    }
						    
						    //判读文件是否是目录,当前路径 + 获取到的路径 + 遍历后的目录
						    if(is_dir($thedir.'/'.$dir.'/'.$showdir)){
							    $suffix = '';
							    //设置上级目录
							    if($showdir == '..'){
								    $url = $updir;
							    }
							    else{
								    $url = "./index.php?dir=".$dir.'/'.$showdir;
							    }
							    
							    $ico = "fa fa-folder-open";
							    $fsize = '-';
							    //返回类型
							    $type = 'dir';
						    }
						    //如果是文件
						    if(is_file($fullpath)){
							    //获取文件后缀
						    	$suffix = explode(".",$showdir);
						    	$suffix = end($suffix);
						    	
							    $url = '.'.$dir.'/'.$showdir;

							    //根据不同后缀显示不同图标
							    $ico = $zdir->ico($suffix);
							    

							    //获取文件大小
							    $fsize = filesize($fullpath);
							    $fsize = ceil ($fsize / 1024);
							    if($fsize >= 1024) {
								    $fsize = $fsize / 1024;
								    $fsize = round($fsize,2).'MB';
							    }
							    else{
								    $fsize = $fsize.'KB';
							    }
							    $type = 'file';
							    #$info = "<a href = ''><i class='fa fa-info-circle' aria-hidden='true'></i></a>";
						    }
						    //其它情况，可能是中文目录
						    else{
							    $suffix = '';
							    //设置上级目录
							    if($showdir == '..'){
								    $url = $updir;
							    }
							    else{
								    $url = "./index.php?dir=".$dir.'/'.$showdir;
							    }
							    
							    $ico = "fa fa-folder-open";
							    $fsize = '-';
							    $type = 'dir';
						    }
						    $i++;
						?>
					    <tr id = "id<?php echo $i; ?>">
						    <td>
							    <!--判断文件是否是图片-->
							    <?php if(($suffix == 'jpg') || ($suffix == 'jpeg') || ($suffix == 'png') || ($suffix == 'gif') || ($suffix == 'bmp')){

							   	?>
							   	<a href="<?php echo $url ?>" id = "url<?php echo $i; ?>" onmouseover = "showimg(<?php echo $i; ?>,'<?php echo $url; ?>')" onmouseout = "hideimg(<?php echo $i; ?>)"><i class="<?php echo $ico; ?>"></i> <?php echo $showdir; ?></a>
							   	<div class = "showimg" id = "show<?php echo $i; ?>"><img src="" id = "imgid<?php echo $i; ?>"></div>
							   	<?php }else{ ?>
							    <a href="<?php echo $url ?>" id = "url<?php echo $i; ?>"><i class="<?php echo $ico; ?>"></i> <?php echo $showdir; ?></a>
							    <?php } ?>
						    </td>
						    <td id = "info" class = "layui-hide-xs">
							    <!--如果是readme.md-->
							    <?php if(($showdir == 'README.md') || ($showdir == 'readme.md')){ ?>
								<a class = "layui-btn layui-btn-xs" href="javascript:;" onclick = "newmd('<?php echo $fullpath; ?>')" title = "点此查看使用说明">使用说明</a>
								<!--视频播放器-->
							    <?php }elseif($zdir->video($url)){

							    ?>
								<a class = "layui-btn layui-btn-xs" href="javascript:;" onclick = "video('<?php echo $url ?>')">播放</a>
								<!-- office在线预览 -->
								<?php }elseif($zdir->office($url)){

								?>
								<a class = "layui-btn layui-btn-xs" href="javascript:;" onclick = "office('<?php echo $url ?>')">预览</a>
								<!--文档查看器-->
							    <?php }elseif($zdir->is_text($url)){
							    ?>
								<a class = "layui-btn layui-btn-xs" href="javascript:;" onclick = "viewtext('<?php echo $fullpath; ?>')">查看</a>
							    <?php } ?>
							    <!--如果是文件-->
							    <?php if($type == 'file'){ ?>
									<a href="javascript:;" title = "查看文件hash" onclick = "filehash('<?php echo $showdir; ?>','<?php echo $fullpath; ?>')"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
									<a href="javascript:;" onclick = "qrcode('<?php echo $showdir; ?>','<?php echo $url; ?>')" title = "显示二维码"><i class="fa fa-qrcode" aria-hidden="true"></i></a>
							    <?php } ?>
						    </td>
						    <td class = "layui-hide-xs"><?php echo $ctime; ?></td>
						    <td><?php echo $fsize; ?></td>
						    <td class = "layui-hide-xs">
							    <?php if($fsize != '-'){ ?>
								<a href="javascript:;" class = "layui-btn layui-btn-xs" onclick = "copy('<?php echo $url ?>')">复制</a>
							    <?php } ?>
							    <!--如果是管理模式-->
							    <?php if((isset($admin)) && ($fsize != '-')) { ?>
									<a href="javascript:;" class = "layui-btn layui-btn-xs layui-btn-danger" onclick = "delfile(<?php echo $i; ?>,'<?php echo $showdir; ?>','<?php echo $fullpath; ?>')">删除</a>
							    <?php } ?>
							    <!--如果是markdown文件-->
							    <?php if(($suffix == 'md') && ($suffix != null)){ ?>
								&nbsp;&nbsp;<a href="javascript:;" onclick = "newmd('<?php echo $fullpath; ?>')" title = "点击查看"><i class="fa fa-eye fa-lg"></i></a> 
							    <?php } ?>
						    </td>
					    </tr>
					    <?php } ?>
					  </tbody>
					</table>
		    	</div>
		  	</div>
		</div> 
	</div>
<?php
	//载入页脚
	include_once("./template/footer.php");
?>