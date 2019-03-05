#!/usr/bin/php
<?php
	$result = null;
	foreach ($argv as $v)
	{
		if ($v != $argv[0] && $v != $argv[1])
		{
			$tab = explode(":", $v);
			if ($tab[0] == $argv[1])
				$result = $tab[1];
		}
	}
	if (!is_null($result))
		echo "$result\n";
?>
