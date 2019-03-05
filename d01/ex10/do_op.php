#!/usr/bin/php
<?php
	if ($argc == 4)
	{
		$op1 = trim($argv[1]);
		$op2 = trim($argv[3]);
		$operator = trim($argv[2]);
		if ($operator == "/")
			$result = $op1 / $op2;
		else if ($operator == "*")
				$result = $op1 * $op2;
		else if ($operator == "+")
			$result = $op1 + $op2;
		else if ($operator == "-")
			$result = $op1 - $op2;
		else if ($operator == "%")
			$result = $op1 % $op2;
		echo "$result\n";
	}
	else
		echo "Incorrect Parameters\n";
?>
