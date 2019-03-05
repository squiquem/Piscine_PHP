#!/usr/bin/php
<?php
	$stdin=fopen("php://stdin","r");
	while ($stdin && !feof($stdin))
	{
		echo "Entrez un nombre: ";
		$n = fgets($stdin);
		if ($n)
		{
			$n = str_replace("\n", "", "$n");
			if (is_numeric($n))
			{
				if ($n % 2 == 0)
					echo "Le chiffre " . $n . " est Pair\n";
				else
					echo "Le chiffre " . $n . " est Impair\n";
			}
			else
				echo "'" . $n . "' n'est pas un chiffre\n";
		}
	}
	fclose($stdin);
	echo "\n";
?>
