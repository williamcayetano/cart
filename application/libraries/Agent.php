<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Agent {

	public function user_agent()
	{
		// ------- DETECT USER DEVICE ----------
  		$user_device = "";
  		$agent = $_SERVER['HTTP_USER_AGENT'];
  		if (preg_match("/iPhone/", $agent)) {
    		$user_device = "iPhone Mobile";
  		} else if (preg_match("/Android/", $agent)) {
    		$user_device = "Android Mobile";
  		} else if (preg_match("/IEMobile/", $agent)) {
    		$user_device = "Windows Mobile";
  		} else if (preg_match("/Chrome/", $agent)) {
    		$user_device = "Google Chrome";
  		} else if (preg_match("/MSIE/", $agent)) {
    		$user_device = "Internet Explorer";
  		} else if (preg_match("/Firefox/", $agent)) {
    		$user_device = "Firefox";
  		} else if (preg_match("/Safari/", $agent)) {
    		$user_device = "Safari";
  		} else if (preg_match("/Opera/", $agent)) {
    		$user_device = "Opera";
  		} else {
    		$user_device = "Unknown Agent";
  		}

  		$OSList = array
  		(
        	// Match user agent string with operating systems
        	'Windows 3.11' => 'Win16',
        	'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)',
        	'Windows 98' => '(Windows 98)|(Win98)',
        	'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
        	'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
        	'Windows Server 2003' => '(Windows NT 5.2)',
        	'Windows Vista' => '(Windows NT 6.0)',
        	'Windows 7' => '(Windows NT 6.1)|(Windows NT 7.0)',
        	'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
        	'Windows ME' => 'Windows ME',
        	'Open BSD' => 'OpenBSD',
        	'Sun OS' => 'SunOS',
        	'Linux' => '(Linux)|(X11)',
        	'Mac OS' => '(Mac_PowerPC)|(Macintosh)',
        	'QNX' => 'QNX',
        	'BeOS' => 'BeOS',
        	'OS/2' => 'OS/2',
			'Mac OS' => 'Mac OS',
        	'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'
  		);
 
  		// Loop through the array of user agents and matching operating systems
  		foreach($OSList as $CurrOS=>$Match) {
    		// Find a match
    		if (preg_match("/$Match/i", $agent)) {
      			break;
    		} else {
	  			$CurrOS = "Unknown OS";
			}
  		}
  		$device = "$user_device : $CurrOS";
  		return $device;
	}
	
	public function __construct(){
	}
}