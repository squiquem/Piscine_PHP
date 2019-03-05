<?php
if ($_POST['submit'] === 'OK')
{
	if ($_POST['newpw'] == '' || $_POST['oldpw'] == '' || $_POST['login'] == '')
		echo "ERROR\n";
	else
	{
		$modify = FALSE;
		$pwd = hash('whirlpool', $_POST['newpw']);
		$oldpwd = hash('whirlpool', $_POST['oldpw']);
		$array = file_get_contents('../private/passwd');
		$unseri = unserialize($array);
		$i = 0;
		foreach ($unseri as $elem) 
		{
			if ($elem['login'] === $_POST['login'] && $oldpwd === $elem['passwd'])
			{
				$unseri[$i]['passwd'] = $pwd;
				$modify = TRUE;
			}
			$i++;	
		}
		if ($modify)
		{
			$seri = serialize($unseri);
			file_put_contents('../private/passwd', $seri);
			echo "OK\n";
		}
		else
			echo "ERROR\n";
	}
}
?>
