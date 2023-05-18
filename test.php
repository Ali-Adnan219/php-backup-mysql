<?php
ob_start();

include 'php-backup-mysql.php';


$API_KEY = 'bot token'; 
define('API_KEY',$API_KEY);

function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}
else
{
return json_decode($res);}}

backup_mysql_database('my_database', 'my_username', 'my_password', 'localhost', 'utf8mb4', 'my_backup.sql');

$id_channnel_backup=-100343553535;


bot('sendDocument',[ 
 'chat_id'=>$id_channnel_backup, 
 'document'=>new CURLFile("my_backup.sql"),
 'caption'=>"
===========
😻file backup sql😻
===========

'parse_mode'=>'markdown',
'disable_web_page_preview'=>'True'
]);