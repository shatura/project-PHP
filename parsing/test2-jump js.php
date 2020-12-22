<?php

$url = 'https://www.domofond.ru/prodazha-trehkomnatnuh-kvartir-irkutskaya_oblast-r17?ApartmentSaleType=New';
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,$url);//ссылка перехода
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);//запись ответа впеременную
$content = curl_exec($ch);//записываем резтат в переменную
curl_close($ch);

//удаление екста для поломки скрипта

$content = str_replace("script", "", $content);


//обработка нужного куска
$start_1 = 'INITIAL_DATA__ = ';
$end_1='<>window.__IMAGESURL__';
$pos_start_1=strpos($content,$start_1);
$pos_end_1=strpos($content,$end_1);
$pos_q= $pos_end_1 - $pos_start_1;
$content=substr($content, $pos_start_1, $pos_q);

$content=str_replace('INITIAL_DATA__ = ', '', $content);
$content=str_replace('</>', '', $content);

//delete JSON massiv

$content = json_decode($content,true);

//perebor v massive
for ($i=0;$i<count($content['itemsState']['items']); $i++){
    echo $content ['itemsState']['items']["$i"]['address'];
    echo '<br>';
}

echo $content;