#!/usr/bin/php
<?php
	date_default_timezone_set('Europe/Paris');
	function check_format($arg)
	{
		if (preg_match("#(^[L|l]undi|[M|m]ardi|^[M|m]ercredi|^[J|j]eudi|^[V|v]endredi|^[S|s]amedi|
			^[D|d]imanche) {1}([0-9]{1,2}) {1}([J|j]anvier|[F|f][e|é]vrier|[M|m]ars|[A|a]vril|[M|m]ai|
			[J|j]uin|[J|j]uillet|[A|a]o[u|û]t|[S|s]eptembre|[O|o]ctobre|[N|n]ovembre|
			[D|d][e|é]cembre) {1}[0-9]{4} {1}[0-9]{2}:[0-9]{2}:[0-9]{2}$#", $arg))
			return (true);
		return (false);
	}

	function get_month($arg)
	{
		if (preg_match("#anvier$#",$arg))
			return (1);
		if (preg_match("#vrier$#",$arg))
			return (2);
		if (preg_match("#ars$#",$arg))
			return (3);
		if (preg_match("#vril$#",$arg))
			return (4);
		if (preg_match("#ai$#",$arg))
			return (5);
		if (preg_match("#uin$#",$arg))
			return (6);
		if (preg_match("#uillet$#",$arg))
			return (7);
		if (preg_match("#o[u|û]t$#",$arg))
			return (8);
		if (preg_match("#eptembre$#",$arg))
			return (9);
		if (preg_match("#ctobre$#",$arg))
			return (10);
		if (preg_match("#vembre$#",$arg))
			return (11);
		if (preg_match("#cembre$#",$arg))
			return (12);
	}

	if ($argc > 1)
	{
		if (!check_format($argv[1]))
		{
			echo "Wrong Format\n";
			exit;
		}
		else
		{
			$array = explode(' ', $argv[1]);
			$time = explode(':', $array[4]);
			$num = $array[1];
			$month = get_month($array[2]);
			$year = $array[3];
			$hour = $time[0];
			$min = $time[1];
			$sec = $time[2];
			echo mktime($hour, $min, $sec, $month, $num, $year);
		}
		echo "\n";
	}
?>
