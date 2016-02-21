<?php

error_reporting(0);
//error_reporting(E_ALL);
//ini_set('display_errors','On');

//set your timezone
date_default_timezone_set("Asia/Taipei");

$HW_NAME = "<!CODESENSOR_HW_NAME!>";

$MYSQL_DB_NAME = "code_sensor_2015";
$MYSQL_USER_ID = "codesensor";
$MYSQL_USER_PWD =  "nctucodesensor";
$LOGON_SESSION_TTL = 86400; //seconds
$code_sensor_homepage = "http://".$_SERVER['HTTP_HOST']."/".$HW_NAME."/";
$MAX_VIEW_PROGRESS_VALUE = 5;
$MASTER_USER_ID = "baseline";

$root_dir = "/var/homeworks/".$HW_NAME ."/";

$homework_inspector_executable = "/usr/bin/HomeworkInspector/".$HW_NAME."/HomeworkInspector";

$queue_dir = $root_dir."queue";
$config_file = $root_dir."config/homework_inspector_config";
//$ACCOUNT_FILE = $root_dir."config/student_roster.txt";

$log_filename = "log";
$filename_on_server = "code";
$SHOW_DEBUG_MSG = FALSE;
$setting_filename = "setting";


function CreateFullPath($dir, $file)
{
	$n = strlen($dir);



	if ( $n == 0 || $dir[$n-1]=='/') {
		return $dir . $file;

	}
	else {
		return $dir . "/"  . $file;
	}


}



function show_text_file($filename, $show_line_number = false)
{
	
	echo "<pre>";

	$file  = FALSE;
	$cnt = 0;
	
	while( $cnt < 1) {
		if ( $file = fopen($filename, "r") )
			break;
//		sleep(2);
		++$cnt;
	}	
	
	if ( $file )
	{
		$line_cnt = 0;

		while (!feof($file))
		{
			$line_cnt++;
			$display = fgets($file);
			if ($show_line_number)
				printf("%6d:\t", $line_cnt);
			echo htmlspecialchars($display) ;
		}
		fclose($file);
	}
	else
	{
		echo "result not ready<br/>";

	}
	echo "</pre>";
}

function mylog($userid, $msg)
{
	global $root_dir;
	global $log_filename;



	$filename = $root_dir . $userid . "/" . $log_filename;
	$rhost = gethostbyaddr($_SERVER['REMOTE_ADDR']);

	//echo $filename;

	$file = fopen($filename, "a+t");

	if ( $file != false) {
		fprintf($file, "[%s]\t\"%s\"\tfrom %s\n",  date ("F/d/Y H:i:s"), $msg, $rhost);
		fclose($file);
	}
}

function GetConfigValueList($property)
{
	global $CONFIG_SET;

	//	var_dump($CONFIG_SET);

	if ( array_key_exists($property, $CONFIG_SET))
	return $CONFIG_SET[$property];

	return false;

}

////// Load config ////////////////

function LoadConfigFromFile($config_file)
{
	$CONFIG_SET = array();

	$file = fopen($config_file, "rt");
	if ( $file != false) {

		while (!feof($file))
		{
			$buf = fgets($file, 1024);

			if( strstr($buf,"=")) {
				$property = trim( strtok($buf,"=") );
				$value_collection = strtok("=");
				$value = explode(",", $value_collection);

				 
				 
				for ( $k = 0; $k < count($value); $k++) {
					$value[$k] = trim($value[$k]);
					$value[$k] = substr($value[$k],1, strlen($value[$k])-2);

				}

				$CONFIG_SET[ $property ] = $value;
				 
			}

		}

		fclose($file);
	}

	return $CONFIG_SET;
}

$CONFIG_SET = LoadConfigFromFile($config_file);

//var_dump($CONFIG_SET);
//var_dump(GetConfigValueList("deadline"));
//var_dump(GetConfigValueList("illegal_header"));
////////////////////////////

?>
