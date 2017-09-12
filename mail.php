<?
session_start();
if ($_SESSION['authorization'] != "true") {
  header("Location:index.php");
exit();
}
?>
<?

header("Content-Type: text/html; charset=UTF-8");

$internalMessages = array(
        'errorCommon'               => 'Возникла неизестная ошибка, письмо не удалось отправить.',
        'errorBigFile'              => 'Слишком большой прикрепленный файл. Письмо не отправлено.',
        'errorFrom'                 => 'Письмо не отправлено. Проверьте поле Кому.',
        'successfulSend'            => 'Письмо к :::to отправлено',
        'successfulSendWithFile'    => 'Письмо с файлом <b>:::file</b> к :::to отправлено'
);

// сначала разберемся с волшебными кавычками
if (get_magic_quotes_gpc()) {
    function stripslashes_deep($value){
        $value = is_array($value) ?
                    array_map('stripslashes_deep', $value) :
                    stripslashes($value);
        return $value;
    }

    $_POST      = array_map('stripslashes_deep', $_POST);
    $_GET       = array_map('stripslashes_deep', $_GET);
    $_COOKIE    = array_map('stripslashes_deep', $_COOKIE);
    $_REQUEST   = array_map('stripslashes_deep', $_REQUEST);
}


function sendmsg($to, $subject, $text, $from, $tip, $filePath = false, $fileType = false, $fileName = ''){ 
    // $to - кому
    // $subject - тема
    // $text - текст сообщения
    // $from - от кого
    // $filePath - путь к прикрепленному файлу, если он есть
    // $fileType - ХЗ
    // $fileExists - надо ли прикреплять файл
    // $tip - ХЗ
    // $fileName - имя файла

    if (!$filePath){
        // нет прикрепленного файла

        $header  = "Content-type: $tip; charset=windows-1251\n";
        $header .= "From: $from\n";
        $header .= "Subject: $subject\n";
        return mail($to, $subject, $text, $header);

    } else {
        // есть прикрепленный файл

        // генерим уникальный ID
        $uid = strtoupper(md5(uniqid(time())));

        $header .= "Content-Type: multipart/mixed; boundary=$uid\n";
        $header .= "From: $from\n";
        $header .= "Subject: $subject\n";
        $header .= "--$uid\n";
        $header .= "Content-Type: $tip; charset= windows-1251\n";
        $header .= "Content-Transfer-Encoding: 8bit\n\n";
        $header .= "$text\n";
        $header .= "--$uid\n";
        $content = fread(fopen($filePath,"r"),filesize($filePath));
        $content = chunk_split(base64_encode($content));
        $header .= "Content-Type: $fileType; name=\"$fileName\"\n";
        $header .= "Content-Transfer-Encoding: base64\n";
        $header .= "Content-Disposition: attachment;
                   filename=\"$fileName\"\n\n";
        $header .= "$content\n";
        $header .= "--$uid--";
        return mail($to, $subject, '', $header);
    }
}


// определяем тип сообщения - HTML or Plain text
$messageType = ($_POST['tip'] == 2) ? 'text/html' : 'text/plain';

$messageTo          = substr(iconv('UTF-8', 'windows-1251', trim($_POST['to'])), 0, 32);
$messageFromName    = substr(iconv('UTF-8', 'windows-1251', trim($_POST['fromname'])), 0, 100);
$messageText        = substr(iconv('UTF-8', 'windows-1251', $_POST['mes']), 0, 100000);
$messageFrom        = substr(iconv('UTF-8', 'windows-1251',trim($_POST['frommail'])), 0, 100);
$messageSubject     = substr(iconv('UTF-8', 'windows-1251',$_POST['tema']), 0, 100);
if (trim($messageSubject) == '') $messageSubject = "Без темы";

if (!preg_match("/^[\.\-_A-Za-z0-9]+?@[\.\-A-Za-z0-9]+?\.[A-Za-z0-9]{2,6}$/", $messageTo)) die($internalMessages['errorFrom']);

if (!$_FILES) {
    // нет прикрепленного файла

	if (sendmsg($messageTo, $messageSubject, $messageText, "$messageFromName <$messageFrom>", $messageType)) {
        die(str_replace(':::to', $messageTo, $internalMessages['successfulSend']));
	} else {
        die($internalMessages['commonError']);
    }

} else {
    // есть прикрепленный файл

	if ($_FILES['att']['size'] > 15000000) die($internalMessages['errorBigFile']);
	if (sendmsg($messageTo,
                $messageSubject,
                $messageText,
                "$messageFromName <$messageFrom>",
                $messageType,
                $_FILES['att']['tmp_name'],
                $_FILES['att']['type'],
                $_FILES['att']['name'])){
        $internalMessages['successfulSendWithFile'] = str_replace(':::file',
                                htmlspecialchars($_FILES['att']['name']), $internalMessages['successfulSendWithFile']);
        die(str_replace(':::to', $messageTo, $internalMessages['successfulSendWithFile']));
	} else {
        die($internalMessages['errorCommon']);
    }
}

?>
