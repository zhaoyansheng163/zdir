<?php
	error_reporting(E_ALL^E_NOTICE^E_WARNING^E_DEPRECATED);
	//获取控制器
	$c = @$_GET['c'];
	//进行过滤
	$c = strip_tags($c);
	//读取版本号
	$version = @file_get_contents("./functions/version.txt");
	//载入配置文件
	include_once("./config.php");
	//载入zdir类
	include_once("./functions/zdir.class.php");

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
				sleep(1);
				if(function_exists('password_verify')) {
					//echo "<script language=javascript>alert($mima);</script>";
					//if (isset($auth_users[$_POST['fm_usr']]) && isset($_POST['fm_pwd']) && password_verify($_POST['fm_pwd'], $auth_users[$_POST['fm_usr']])) {
						if (isset($auth_users[$_POST['fm_usr']]) && isset($_POST['fm_pwd']) && password_verify($_POST['fm_pwd'], $auth_users[$_POST['fm_usr']])) {
							//echo "<script language=javascript>alert('对不起! -if mima ok');</script>";
								$_SESSION[FM_SESSION_ID]['logged'] = $_POST['fm_usr'];
								fm_set_msg('You are logged in');
								//$use_auth = false;
								//fm_redirect(FM_SELF_URL . '?p=');
						} else {
							//echo "<script language=javascript>alert('对不起! -if mima error');</script>";
								unset($_SESSION[FM_SESSION_ID]['logged']);
								fm_set_msg('Login failed. Invalid username or password', 'error');
								//fm_redirect(FM_SELF_URL);
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
																								<button type="submit" class="btn btn-success btn-block" role="button" >
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
				} else {
					//echo "<script language=javascript>alert('对不起! -if else');</script>";
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
																				<button type="submit" class="btn btn-success btn-block" role="button" >
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

	// logout
if (isset($_GET['logout'])) {
    unset($_SESSION[FM_SESSION_ID]['logged']);
    fm_redirect(FM_SELF_URL);
}

	unset($p, $use_auth, $iconv_input_encoding, $use_highlightjs, $highlightjs_style);
	
	//----------------------------------------------

	//根据不同的请求载入不同的方法
	//如果没有请求控制器
	if((!isset($c)) || ($c == '')){
		//载入主页
		include_once("./functions/home.php");
	}
	//不允许放的控制器
	else if($c == 'indexes'){
		echo '非法请求！';
		exit;
	}
	else{
		include_once("./functions/".$c.'.php');
	}
	
?>