#!/usr/bin/php
<?php
	function	replace($match)
	{
		$new = $match[1].strtoupper($match[2]).$match[3];
		return ($new);
	}

	if ($argc > 1)
	{
		$fd = fopen($argv[1], "r");
		$title = "#(<.*title=\")(.*)(\">)#i";
		$link = "#(<a.*>)(.*)(</a)#i";
		$linkimg = "#(<a.*>)(.*)(<img)#i";
		while (!feof($fd))
			$line .= fgets($fd);
		fclose($fd);
		$line = preg_replace_callback("$title", "replace", $line);
		$line = preg_replace_callback("$link", "replace", $line);
		$line = preg_replace_callback("$linkimg", "replace", $line);
		echo "$line";
	}
?>
