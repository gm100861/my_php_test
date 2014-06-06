<?php
$source = 'g:/back/';
$dest = 'g:/dest/';
date_default_timezone_set('Asia/Shanghai');
function getfile($path) {
$arr = array();
$dir = opendir($path);
	while(($file = readdir($dir)) !== false ) {
		if($file == "." || $file == "..") {
			continue;
		}
		$file = $path.'/'.$file;
		if(is_dir($file)){
			$arr = array_merge($arr,getfile($file) );
			getfile($file);
		}else {
			//echo $file.'<br />';
			array_push($arr,$file);
		}
	}
	closedir($dir);
	return $arr;
}
function movefile($source,$dest) {
	$list = getfile($source);
	foreach($list as $key=>$value) {
		$p = $dest.'/'.date('Y-m-d',filectime($value)).'/';
		if(!file_exists($p)){
			mkdir($p,'0777',true);
		} else {
			copy($value,$p.basename($value));
		}
	}
}
movefile($source,$dest);
