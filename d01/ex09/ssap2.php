#!/usr/bin/php
<?php
	function	concatenate_arg($argv, $argc)
	{
		for ($i = 1; $i < $argc; ++$i)
			$str .= " ".$argv[$i]." ";
		return ($str);
	}

	function	clean_str($str)
	{
		$trimmed = trim($str);
		while (strpos($trimmed, "  "))
			$trimmed = str_replace("  ", " ", $trimmed);
		return ($trimmed);
	}

	function	my_sort($a, $b)
	{
		$la = strtolower($a);
		$lb = strtolower($b);
		$i = 0;
		$comp = "abcdefghijklmnopqrstuvwxyz0123456789!\"#$%&'()*+,-./:;<=>?@[\]^_`{|}~";
		while ($i < strlen($a) || $i < strlen($b))
		{
			$posa = strpos($comp, $la[$i]);
			$posb = strpos($comp, $lb[$i]);
			if ($posa < $posb)
				return (-1);
			else if ($posa > $posb)
				return (1);
			else
				++$i;
		}
	}

	if ($argc > 1)
	{
		$str = concatenate_arg($argv, $argc);
		$str = clean_str($str);
		$tab = explode(" ", $str);
		usort($tab, "my_sort");
		foreach ($tab as $v)
			echo ("$v\n");
	}
?>
