<?php

function grab_page($site){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 40);
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_URL, $site);
   // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    ob_start();
    return curl_exec ($ch);
    ob_end_clean();
    curl_close ($ch);
}
 

 
$smspage = grab_page("https://sms-activate.ru/stubs/handler_api.php?api_key=ec0edA3515947e6b12f4d0589873dd32&action=getStatus&id=262366669");
$smsarray=explode(":",$smspage);
$smspage = $smsarray[1];


if(is_numeric($smspage)){

  echo $smspage;

}
?>
 