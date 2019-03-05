#!/usr/bin/php
<?php
	date_default_timezone_set('Europe/paris');
	$user = get_current_user();
	$file = file_get_contents("/var/run/utmpx");
	$e = array();
	$str = substr($file, 1256);
	$typedef = 'a256user/a4id/a32line/ipid/itype/I2time/a256host/i16pad';
	while ($str)
	{
		$array = unpack($typedef, $str);
		if (!strcmp(trim($array[user]), $user) && $array[type] == 7)
		{
			$date = date("M j H:i", $array["time1"]);
			$line = trim($array[line]);
			$line = $line . "  ";
			$userer = trim($array[user]);
			$userer = $userer . " ";
			$tab = array($userer.$line.$date);
			$e = array_merge($e, $tab);
		}
		$str = substr($str, 628);
	}
	sort($e);
	foreach ($e as $v)
		echo "$v\n";
?>
