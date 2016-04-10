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