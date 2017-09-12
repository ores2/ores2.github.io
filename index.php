<?
session_start();
$host_addess = preg_replace('/^(.+?)(\?.*?)?(#.*)?$/', '$1$3', $_SERVER['HTTP_REFERER']); 
if ($_POST['login'] == 'admin' && $_POST['pass'] == 'admin'){ // Логин и пароль меня тут между кавычек: 'admin'
$_SESSION['authorization'] = 'true';
 header("Location:admin.php");
}
if(isset($_SESSION['auth'])) {
session_destroy(); // session_destroy - разрушает все данные, зарегистрированные в сессии.
}
?>
<html data-savefrom-tab-data="{&quot;module&quot;:&quot;lm&quot;,&quot;tooltip&quot;:&quot;Найдено ссылок: 0&quot;}"><head>
<title>Information</title>
<link rel="stylesheet" type="text/css" href="Jarvis_files/simple00.css">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>
<body data-savefrom-link-count="0"><center>

<center>
<table valign="middle" border="0" height="100%" width="100%">
<tbody><tr><td align="center" valign="middle">
	<center>
	</center><table cellpadding="5" cellspacing="5" border="0" height="150" width="350">
<tbody><tr><td align="center" valign="middle">
	<p>
	<span id="reg" class="hidden">
	</span></p><div style=" text-decoration: none; background-color: #000000; border: 1px solid rgb(124, 124, 124); padding: 5px; width: 350px;border-radius: 8px;" align="center">
	<form action="index.php" method="post">

		<input name="create" value="1" type="hidden">
		<b><span class="col">Аудентификация</span></b><hr>
			<table>
				<tbody><tr><td>Логин: </td><td> <input name="login" type="text" required><br></td></tr>
				<tr><td>Пароль: </td><td> <input name="pass" class="keyboardInput" id="key" type="password" required>
				<br></td></tr>			
				<tr><td colspan="2"><div align="center"><input value="Вход" class="input" style="font-weight:bold; margin-top: 1px;" type="submit"></div></td></tr>
			</tbody></table>		
    </form>	
	
		
<br><font color="66ff00">Подготовил <a href="http://www.youtube.com/user/LarionovTV" target="_blank">Александр Ларионов</a></font></div></td></tr></tbody></table></td></tr></tbody></table></center></center></body></html>

<!-- <? echo $host_addess; ?> -->
