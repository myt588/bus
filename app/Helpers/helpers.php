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