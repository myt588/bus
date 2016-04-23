<?php


define("WEEKDAY_SUNDAY",1); // 2^0
define("WEEKDAY_MONDAY",2); // 2^1
define("WEEKDAY_TUESDAY",4); // 2^2
define("WEEKDAY_WEDNESDAY",8); // 2^3
define("WEEKDAY_THURSDAY",16); // 2^4
define("WEEKDAY_FRIDAY",32); // 2^5
define("WEEKDAY_SATURDAY",64); // 2^6
define("EVERYDAY", 127);

function stringToWeekday($str) {
	return pow(2, date("w", strtotime($str)));
}

function stringToDate($str) {
	return date("Y-m-d", strtotime($str));
}

function getDateList($str) {
	$dowMap = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
	for ($i = -3 ; $i < 4 ; $i ++) {
		$date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($str)) . " " . $i . " day"));
		$weekday = date("w", strtotime($date));
		$dateReadable = $dowMap[$weekday] . ", " . substr($date, 5);
		$date_list[$i] = $dateReadable;
	}
	return $date_list;
}

function dateMath($str, $i) {
	$date = date("m/d/Y", strtotime(date("Y-m-d", strtotime($str)) . " " . $i . " day"));
	return $date;
}

/**
 * Generates a random string of a given type and length.
 *
 * @param   string   a type of pool, or a string of characters to use as the pool
 * @param   integer  length of string to return
 * @return  string
 *
 * @tutorial  alnum    - alpha-numeric characters
 * @tutorial  alpha    - alphabetical characters
 * @tutorial  numeric  - digit characters, 0-9
 * @tutorial  nozero   - digit characters, 1-9
 * @tutorial  distinct - clearly distinct alpha-numeric characters
 */
function random($type = 'alnum', $length = 8)
{
	$utf8 = FALSE;

	switch ($type)
	{
		case 'alnum':
			$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		break;
		case 'alpha':
			$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		break;
		case 'numeric':
			$pool = '0123456789';
		break;
		case 'nozero':
			$pool = '123456789';
		break;
		case 'distinct':
			$pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
		break;
		default:
			$pool = (string) $type;
			$utf8 = ! utf8::is_ascii($pool);
		break;
	}

	$str = '';

	$pool_size = ($utf8 === TRUE) ? utf8::strlen($pool) : strlen($pool);

	for ($i = 0; $i < $length; $i++)
	{
		$str .= ($utf8 === TRUE)
			? utf8::substr($pool, mt_rand(0, $pool_size - 1), 1)
			:       substr($pool, mt_rand(0, $pool_size - 1), 1);
	}

	return $str;
}

/**
 * Set Active State on Navbar
 *
 * @param   array/string
 * @param   class  length of string to return
 * @return  string
 *
 */
function set_active($paths, $classes = null)
{
    if (!is_array($paths)) {
        $paths = explode(' ', $paths);
    }
    foreach ($paths as $path) {
        if (request()->is($path)) {
            return 'class="' . ($classes ? $classes . ' ' : '') . 'active"';
        }
    }
    return $classes ? 'class="' . $classes . '"' : '';
}


function getWeekday($date) {
	$a = date("w", strtotime($date));
	$weekday = [
		'0' => 'Sunday', 
		'1' => 'Monday', 
		'2' => 'Tuesday', 
		'3' => 'Wednesday', 
		'4' => 'Thursday', 
		'5' => 'Friday', 
		'6' => 'Saturday'
		];
	return $weekday[$a];
}

function getMonth($date) {
	$a = date("m", strtotime($date));
	$ml = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	$ms = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
	return $ml[$a-1];
}

function getDay($date) {
	return date("d", strtotime($date));
}