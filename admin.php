<?
session_start();
$_SESSION['auth'] = 'tes'; // �����)) 
if (isset($_GET['logout'])){ 
  unset($_SESSION['authorization']); // ������� ��� ������
   header("Location:index.php"); // ������ �� �����������
}
if ($_SESSION['authorization'] != "true") { // ���� �� �� ������������ -> �� �����������.
  header("Location:index.php");
   exit();
}
?>
<?

header("Content-Type: text/html; charset=windows-1251");

// ������������� ���
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");

function getmicrotime(){        //���������� ������� ��������� ����� UNIX
    list($usec,$sec)=explode(' ',microtime());
    return ((float)$usec + (float)$sec);
}
$start=getmicrotime();
$http = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>
<span style='position: absolute; background:white; right:15px; top: 0.25em; padding:2px;  text-decoration: none;'> �����: <a href="/admin.php?logout"> �����</a></span>
<html>
<head><title>�� �� ������</title>
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
                        <a>����������</a>
                        <div>
                            <p>
                                 ������ �������� email ��������� � �������������/������ ������ � ��������� ��� html �������. 
                                 ������  - version 1.2<br /><br />
                                 ������ ����� ����� � ������ ������������� ��� ������ ��������, �������� xss ����������  � ��� ���������� �������� ���������
                                 ��� ������ �������� �������� ������ � ����� president@kremlin.ru.<br><br />
                                 � ������ ����� ����������� ����� (�� 15 Mb, �������� ����������� ����� � ����� mail.php).<br/> 
                                 ����������� ������ - ��������� �� ����� �����.<br /><br />
                                 ��������! ������ ������������ ������������� ��� ������������.
                                 ��������������� �� �������� ���������� ������������� ������ ������ ��.								 
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
            <a title="�������" href="#" onclick="$('#vn').hide(300)"><img src="img/close_16.png"></a>
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
                ���� ��������� ������<br>
                <font color="#8C3800" size="-1"><b>������:</b> pupkin_vasya@mail.ru</font>
            </td>
            <td>
                <input value="masha_pupkina@mail.ru" size=25 name="to" id="to"  style='font-size: 30px; color: #532100;	font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Verdana, sans-serif;'>
            </td>
        </tr>
        <tr>
            <td>
                �� ����, ���<br>
                <font color="#8C3800" size="-1"><b>������:</b> �������� �����</font>
            </td>
            <td>
                <input value="����� ���" size=25 name="fromname" id="fromname" style='font-size: 30px; color: #532100;	font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Verdana, sans-serif;'>
            </td>
        </tr>
        <tr>
            <td>
                �� ����, ����� email<br>
                <font color="#8C3800" size="-1"><b>������:</b> president@kremlin.ru</font>
            </td>
            <td>
                <input value="WinniePooh@microsoft.com" size=25 name="frommail" id="frommail" style='font-size: 30px; color: #532100;	font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Verdana, sans-serif;'>
            </td>
        </tr>
        <tr>
            <td>
                ����<br>
                <font color="#8C3800" size="-1"><b>������:</b> ����������� ������� ��� ��������</font>
            </td>
            <td>
                <input value="������ �� microsoft" size=25 name="tema" id="tema" style='font-size: 30px; color: #532100;	font-family: "Lucida Grande", "Lucida Sans Unicode", Tahoma, Verdana, sans-serif;'>
            </td>
        </tr>
        <tr>
            <td>
                ��� ������<br>
                <font color="#8C3800" size="-1"><b>text</b> - ������� �����<br><b>html</b> - � ���������������</font>
            </td>
            <td>
                <select name="tip" id="tip" size=2>
                <option value=1>text</option>
                <option value=2 selected>html</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>����� ������<br>
                <font color="#8C3800" size="-1">��� �������� ������ � html ������� ����� ������������<br> ���������� �������, �� �����������, ����������� �� ��������</font>
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
            <td>���������� ����<br>
                <font color="#8C3800" size="-1">����������� �� ������: 15Mb</font>
            </td>
            <td>
                <input name="att" id="att" type="file">
            </td>
        </tr>

        <tr align="right">
            <td></td>
            <td>
                <br><input type="submit" id="zzz" style="display:" value="���������.. " onclick="$('#pic').show();">
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
