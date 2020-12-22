<?php

$url = 'http://spys.one/proxies/';

$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);//site opening link (ссылка открытия сайта)
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//a site record(запись сайта)
curl_setopt($ch, CURLOPT_USERAGENT,'Chrome/87.0.4280.66 (Windows; U; Windows NT 10; ru;)');//brauzer
$content = curl_exec($ch);
curl_close($ch);

//obrez

$pos_1_script=strpos($content, 'eval');
$pos_2_script=strpos($content,'{}))');

$pos_2_script = $pos_2_script-$pos_1_script;
$content_script = substr($content,$pos_1_script,$pos_2_script);
$content_script= $content_script."{}))";

//вытаскиваем proxy

$pos_1_proxy=strpos($content, 'Дата проверки');
$pos_2_proxy=strpos($content, '</td></tr></table></td></tr>');
$content_proxy=substr($content,$pos_1_proxy,$pos_2_proxy);

$end_proxy=preg_quote('))');
$start_proxy=preg_quote('onmouseout="this.style.background');

$content_proxy=preg_replace("/$end_proxy(.*?)$start_proxy/",';',$content_proxy);

$pos_1_proxy=strpos()($content_proxy,'<font class=spy14>');
$pos_1_proxy=$content_proxy+18;
$pos_2_proxy=strpos($content_proxy,'</sript>');
$pos_2_proxy=$pos_2_proxy-$pos_1_proxy;
$content_proxy=substr($content_proxy,$pos_1_proxy,$pos_2_proxy);

$end_proxy_1 = preg_quote(';');
$start_proxy_1=preg_quote('class=spy14>');
$content_proxy=preg_replace("/$end_proxy_1(.*?)$start_proxy_1/", ']);', $content_proxy);



$end_proxy_2 = preg_quote('<');
$start_proxy_2 = preg_quote('>');

$content_proxy = preg_replace("/)$end_proxy_2(.*?)$start_proxy_2/", '', $content_proxy);


$content_proxy = str_replace('document','<script type ="text/javascript">document',$content_proxy);



// декодирование спарсенного скрипта , помещая его в DIV

echo'<script type="text/javascript">';
echo $content_script;
echo '</script>';

$result = explode(",",$content_proxy);
	echo '<div id="stats_container">';

	for ($i=0;$i<count($result);$i++){
        $proxy[$i] = $result [$i]. '</script>';
	echo $proxy[$i];
	echo ';';
	}

	echo '</div>';

	//скрипт лдя отправки рез-тата из див при помощи пост запроса на сервер

	echo '<script type = "text/javascript">';
	echo 'var login = document.getElementById ("stats_container").textContent';
	echo 'var xhr = new XMLHttpRequest();';
	echo 'var body = "login" + encodeURIComponent(login);';
 	echo 'xhr.open ("POST", "http://parsing/test4(3).php", true);';
	echo 'xhr.setRequestHeader("Content-Type", "application/x-www-form-unlencoded");)';
	echo 'xhr.send(body);';
	echo '</script>';

	//приводим текст в читаймый вид

    $url= 'http://parsing/test4(3).txt';
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $content = curl_exec($ch);
    curl_close($ch);

    $end_proxy_1 = preg_quote('document');
    $start_proxy = preg_quote('));');
    $content = preg_replace("/$end_proxy_1(.*?)$start_proxy_1/", ':', $content);

    