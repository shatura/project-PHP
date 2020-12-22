<?php
//подключение для парсинга
$url = 'https://www.incom.ru/newbuild/?action=realty_search&MS_ID=&rc%5B%5D=1&pf=7000000&pt=18000000&mpf=&mpt=&ed_izm=rubly&name=&metro=&metro_selected=&streets=&streets_selected=&cities=&cities_selected=&dstr_selected=&dstr=&nos=y&hw=&showonmap=';

$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);//ссылка перехода
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//запись ответа впеременную
$content = curl_exec($ch);//записываем резтат в переменную
curl_close($ch);

//выделение нужно области
$start_1= 'Таблицей';
$end_1= 'Показать еще';

$pos_start_1=strpos($content,$start_1);
$pos_end_1=strpos($content,$end_1);

$pos_q=$pos_end_1-$pos_start_1;//колическтво символов между началом и концом
$content=substr($content,$pos_start_1,$pos_q); // обрез фрагмента

//ОСТАВИМ ТОЛЬКО НУЖНЫЕ СИМВОЛЫ
$content=preg_replace('/[^a-zA-Zа-яА-Я0-9-.\/,<>]/ui','',$content);

//интересующие нас данные
$start_1='<divclassname>';//начало фрагмента
$start_1 = str_replace("/","\/",$start_1);//экранирование прямого слэша

$end_1='<span></span></a></div></td>';
$end_1 = str_replace("/","\/",$end_1);

$content=preg_replace("/$end_1(.*?)$start_1/", ';',$content);

//корректировочное обрезание информации
$start_1= '<divclassname>';
$end_1= '<span></span></a></div></td>';

$pos_start_1=strpos($content,$start_1);
$pos_end_1=strpos($content,$end_1);

$pos=$pos_end_1-$pos_start_1;//колическтво символов между началом и концом
$content=substr($content,$pos_start_1,$pos); // обрез фрагмента
$content = str_replace('<divclassname>', '',$content);
$content = str_replace('<span></span></a></div></td>', '',$content);


//конвертация в норм вид
$result = explode(";",$content);
for ($i=0;$i<count($result);$i++){
    echo $result[$i];
    echo '<br>';
}
echo $content;