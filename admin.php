<?
session_start();
$_SESSION['auth'] = 'tes'; // прост)) 
if (isset($_GET['logout'])){ 
  unset($_SESSION['authorization']); // Убиваем как маньяк
   header("Location:index.php"); // Шлёпаем на авторизацию
}
if ($_SESSION['authorization'] != "true") { // Если мы не авторизованы -> на авторизацию.
  header("Location:index.php");
   exit();
}
?>
<?

header("Content-Type: text/html; charset=windows-1251");

// предотвращаем кеш
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");

function getmicrotime(){        //возвращает текущее системное время UNIX
    list($usec,$sec)=explode(' ',microtime());
    return ((float)$usec + (float)$sec);
}
$start=getmicrotime();
$http = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>
<span style='position: absolute; background:white; right:15px; top: 0.25em; padding:2px;  text-decoration: none;'> Выйти: <a href="/admin.php?logout"> Выход</a></span>
<html>
<head><title>ТЫ на Арбузе</title>
<link rel="stylesheet" href="CSS/main.css" />
<script type="text/javascript" src="JS/main.js"></script>
<script type="text/javascript" src="JS/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="JS/jquery.form.js"></script>
<script type="text/javascript" src="JS/jquery.easing.js"></script>
<script type="text/javascript" src="JS/jquery.dimensions.js"></script>
<script type="text/javascript" src="JS/jquery.accordion.js"></script>
<script type="text/javascript">
    // wait for the DOM to be loaded
    var im= new Image();
    im.src="<?=$http?>img/1ajax-loader.gif";
    var im2= new Image();
    im2.src="<?=$http?>img/close_16.png";

    $(document).ready(function() {
        // prepare Options Object
        var options = {
            url:        'mail.php',
            target:     '#divToUpdate',
            success:    function() {
                $('#pic').hide();
                $("#vn").show(300);
            }
    };

   // pass options to ajaxForm
    $('#myForm').ajaxForm(options);
            // simple accordion
            jQuery('#list1a').accordion({animated: "bounceslide"});

    });
</script>
</head>
<body  background="img/body0000.gif">

<table width="100%"><tr><td width="20%">
    <table>
            <tr align='center'>
                    <td>
                    <div class="basic" style="float:middle;" id="list1a" align="left" >
                        <a>Информация</a>
                        <div>
                            <p>
                                 Сервис отправки email сообщений с произвольного/чужого адреса в текстовом или html формате. 
                                 Теперь  - version 1.2<br /><br />
                                 Отсюда можно легко и просто прикольнуться над вашими друзьями, поискать xss уязвимости  в веб интерфейсе любимого почтовика
                                 или просто накотать письмецо соседу с ящика president@kremlin.ru.<br><br />
                                 К письму можно прикреплять файлы (до 15 Mb, изменить ограничение можно в файле mail.php).<br/> 
                                 Элементарно просто - проверьте на своем ящике.<br /><br />
                                 Внимание! Сервис предоставлен исключительно для ознакомления.
                                 Ответственность за возможно незаконное использование несете только Вы.								 
                            </p>
                    </div>

            </td>
        </tr>
    </table>
</td>
    <td width=70%>


    <form id="myForm" name="forma" method="post" action="mail.php" enctype="multipart/form-data">

    <center><br/>
    <div style="border: 1px dotted #8C3800; padding:20; background: #EEE9E9;">

    <div id="vn" style="display:none;">
        <div align="right" style="position: relative; top:25px; left: -10px;">
            <a title="Закрыть" href="#" onclick="$('#vn').hide(300)"><img src="img/close_16.png"></a>
        </div>
    
        <div id="divToUpdate" align="center" style="border: 1px solid #8C3800; padding:20; background: #FFFFB7; height:10px;">456</div>
    </div>

    <div id="pic" align="right"style="display:none"><img src="img/1ajax-loader.gif"></div>

    <table>
        <tr>
            <td></td>
            <td>
                <br><div id="err" style="display: none;"></div>
            </td>
        </tr>
        <tr>
            <td width="40%">
                Кому отправить письмо<br>
                <font color="#8C3800" size="-1"><b>Пример:</b> pupkin_vasya@mail.ru</font>
            </td>
            <td>
                <input value="masha_pupkina@mail.ru" size=25 name="to" id="to"  style='font-size: 30px; color: #532100;	font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Verdana, sans-serif;'>
            </td>
        </tr>
        <tr>
            <td>
                От кого, имя<br>
                <font color="#8C3800" size="-1"><b>Пример:</b> Владимир Путин</font>
            </td>
            <td>
                <input value="Винни Пух" size=25 name="fromname" id="fromname" style='font-size: 30px; color: #532100;	font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Verdana, sans-serif;'>
            </td>
        </tr>
        <tr>
            <td>
                От кого, адрес email<br>
                <font color="#8C3800" size="-1"><b>Пример:</b> president@kremlin.ru</font>
            </td>
            <td>
                <input value="WinniePooh@microsoft.com" size=25 name="frommail" id="frommail" style='font-size: 30px; color: #532100;	font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Verdana, sans-serif;'>
            </td>
        </tr>
        <tr>
            <td>
                Тема<br>
                <font color="#8C3800" size="-1"><b>Пример:</b> выращивание конопли под кроватью</font>
            </td>
            <td>
                <input value="привет от microsoft" size=25 name="tema" id="tema" style='font-size: 30px; color: #532100;	font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Verdana, sans-serif;'>
            </td>
        </tr>
        <tr>
            <td>
                Тип письма<br>
                <font color="#8C3800" size="-1"><b>text</b> - обычный текст<br><b>html</b> - с форматированием</font>
            </td>
            <td>
                <select name="tip" id="tip" size=2>
                <option value=1>text</option>
                <option value=2 selected>html</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Текст письма<br>
                <font color="#8C3800" size="-1">При отправке письма в html формате можно использовать<br> браузерные скрипты, не фильтруется, используйте на здоровье</font>
            </td>
            <td>
                <textarea name="mes" id="mes" rows="5" cols="55" style='font-size: 14px; color: #532100; font-family: "Lucida Sans Unicode", Tahoma, Verdana, sans-serif;'>

                </textarea>
                <a href="#" onclick="
                $('#pic2').show();
                $.post(
                  'rand.php',
                  {
                    type: 'test-request'
                  },
                  onAjaxSuccess
                );
                function onAjaxSuccess(data){
                  $('#pic2').hide();
                  $('#mes').attr('value',data);
                }
                "><img src="img/message_reply.png"></a>
                <div id="pic2" align="right"style="display:none"><img src="img/3ajax-loader.gif"></div>
            </td>
        </tr>

        <tr>
            <td>Прикрепить файл<br>
                <font color="#8C3800" size="-1">Ограничение на размер: 15Mb</font>
            </td>
            <td>
                <input name="att" id="att" type="file">
            </td>
        </tr>

        <tr align="right">
            <td></td>
            <td>
                <br><input type="submit" id="zzz" style="display:" value="Отправить.. " onclick="$('#pic').show();">
            </td>
        </tr>

        </table>
        </div>
        </center>

        </form>

    </td>
</tr>
</table>

</body>
</html>
