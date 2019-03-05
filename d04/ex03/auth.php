<?php
function auth($login, $passwd)
{
	$modify = FALSE;
	$pw = hash('whirlpool', $passwd);
	$array = file_get_contents('../private/passwd');
	$unseri = unserialize($array);
	foreach ($unseri as $elem) 
	{
		if ($elem['login'] === $login && $pw === $elem['passwd'])
			$modify = TRUE;
	}
	if (!$modify)
		return (FALSE);
	else
		return (TRUE);
}
?>
