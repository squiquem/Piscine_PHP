<?php
if ($_POST['login'] != "" && $_POST['passwd'] != "")
{
	if ($_POST['submit'] == "OK")
	{
		$pwd = hash('whirlpool', $_POST['passwd']);
		if (!file_exists("../private"))
			mkdir("../private", 0777, true);
		if (!file_exists("../private/passwd"))
		{
			$array = array(array('login'=>$_POST['login'], 'passwd'=>$pwd));
			$seri = serialize($array);
			file_put_contents("../private/passwd", $seri);
			echo "OK\n";
		}
		else
		{
			$exist = FALSE;
			$array = file_get_contents("../private/passwd");
			$unseri = unserialize($array);
			foreach ($unseri as $elem) 
			{
				if ($elem['login'] == $_POST['login'])
					$exist = TRUE;
			}
			if ($exist == FALSE)
			{
				$unseri[] = array('login'=>$_POST['login'], 'passwd'=>$pwd);
				$seri = serialize($unseri);
				file_put_contents("../private/passwd", $seri);
				echo "OK\n";
			}
			else
				echo "ERROR\n";
		}
	}
	else
		echo "ERROR\n";
}
else
	echo "ERROR\n";
?>
