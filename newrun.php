<?php 


$Connectingdb = new PDO('mysql:host = localhost;dbname=remarg8r_virtual','remarg8','test');

function wh_log($log_msg)
{
  
    $log_filename = "run_log";
    if (!file_exists($log_filename)) 
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
}


function vnumber_exist($number){
  global  $Connectingdb;
$sql="SELECT * FROM bot WHERE vnumber = $number";
$stmt=$Connectingdb->query($sql);
    $Result= $stmt->rowcount();
   
    if($Result==0)
    {

      $value = 'true';
    return $value;
    }
    
    else
    {

        return false;
    }
}

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



 
function ppost_data($site,$data,$proxy){
    $datapost = curl_init();
        $headers = array("Expect:");
    curl_setopt($datapost, CURLOPT_URL, $site);
        curl_setopt($datapost, CURLOPT_TIMEOUT, 40000);
    curl_setopt($datapost, CURLOPT_HEADER, TRUE);
curl_setopt($datapost, CURLOPT_PROXY, $proxy);
        curl_setopt($datapost, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($datapost, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($datapost, CURLOPT_POST, TRUE);
    curl_setopt($datapost, CURLOPT_POSTFIELDS, $data);
        curl_setopt($datapost, CURLOPT_COOKIEFILE, "cookie.txt");
    ob_start();
    return curl_exec ($datapost);
    ob_end_clean();
    curl_close ($datapost);
    unset($datapost);    
}

function post_data($site,$data){
    $datapost = curl_init();
        $headers = array("Expect:");
    curl_setopt($datapost, CURLOPT_URL, $site);
        curl_setopt($datapost, CURLOPT_TIMEOUT, 40000);
    curl_setopt($datapost, CURLOPT_HEADER, TRUE);

    //curl_setopt($datapost, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        curl_setopt($datapost, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($datapost, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($datapost, CURLOPT_POST, TRUE);
    curl_setopt($datapost, CURLOPT_POSTFIELDS, $data);
        curl_setopt($datapost, CURLOPT_COOKIEFILE, "cookie.txt");

       // curl_setopt($datapost, CURLOPT_SSL_VERIFYPEER, false); 
    ob_start();
    return curl_exec ($datapost);
    ob_end_clean();
    curl_close ($datapost);
    unset($datapost);    
}



function test($proxy)
{
     $fisier = file_get_contents('proxy.txt'); 
    $array = explode("\n", $fisier);
  global $fisier;

  $splited = explode(':',$proxy); // Separate IP and port

  if($con = @fsockopen($splited[0], $splited[1], $eroare, $eroare_str, 3)) 
  {


return (string)$proxy;



  }

  else{

    $randIndex = array_rand($array);

                  $proxy= $array[$randIndex];
                  $proxy = test($proxy);
                  return (string)$proxy;
                  


  }
}



?>


<?php

$log_time = date('Y-m-d h:i:sa');
wh_log("************** Start Log For Day : '" . $log_time . "'**********");



$newfisier = file_get_contents('name.txt'); 
$newarray = explode("\n", $newfisier); 
$key = array_rand($newarray); 
$name = $newarray[$key];

$proxyfisier = file_get_contents('proxy.txt'); 
$proxyarray = explode("\n", $proxyfisier);





$page = grab_page("https://sms-activate.ru/stubs/handler_api.php?api_key=ec0edA3515947e6b12f4d0589873dd32&action=getNumber&service=tg&forward=0&operator=any&ref=0&country=0");
$result_array=explode(":",$page);

$number = $result_array[2];
$id = $result_array[1];


 wh_log("The  number is set to :--"." $number"." and the id is set to"." $nid". "$log_time");

    if(!is_dir ($number) && is_numeric($number))
{

 mkdir($number, 0777);

 $source='app.php';
 $dest= $number.'/app.php';
copy ( $source, $dest );
 $newsource='index.php';
 $newdest= $number.'/index.php';
copy ( $newsource, $newdest );


 wh_log("The array number is set to :--"." $number"." and the name is set to"." $name". "$log_time");

$url='https://remarkabletip.com/new/'.$number.'/app.php';


 $randIndex = array_rand($proxyarray);
 $proxy = $proxyarray[$randIndex];

wh_log("Proxy random index is set to"." $randIndex"." Uncheked proxy set to:--"." $proxy"." $log_time");

//$proxy = test($proxy);

wh_log("On function test Proxy random index is set to"." $randIndex"." Uncheked proxy set to:--"." $proxy"." $log_time");


post_data($url,"phone_number=$number");


sleep(30);


$value = vnumber_exist($number);

if($value){

    $sql ="INSERT INTO bot(vnumber,verify)";
     $sql .="VALUES('$number','no')";
     $stmt= $Connectingdb->query($sql);
}




$smspage = grab_page("https://sms-activate.ru/stubs/handler_api.php?api_key=ec0edA3515947e6b12f4d0589873dd32&action=getStatus&id=$id");

wh_log("The smspage page  is"." $smspage"." $log_time");

$smsarray=explode(":",$smspage);
$smspage = $smsarray[1];
wh_log("Exploted smspage page  is"." $smspage"." $log_time");


if(is_numeric($smspage)){

   $getotp = $smspage;

   wh_log("The otp recevied is"." $getotp"." of vnumber is"." $number"." $log_time");
   post_data($url,"phone_code=$getotp");
   post_data($url,"first_name=$name&last_name=");

}

else{
  wh_log("This is else block"." $log_time");

  sleep(30);

  if(is_numeric($smspage)){

     $getotp = $smspage;
   wh_log("The otp recevied after sleep of 30 is"." $getotp"." of vnumber is"." $number"." $log_time");

   post_data($url,"phone_code=$getotp");
   post_data($url,"first_name=$name&last_name=");

  }
  else{

    $sql ="INSERT INTO bot(vnumber,verify)";
     $sql .="VALUES('$number','nootp')";
     $stmt= $Connectingdb->query($sql);

     
      wh_log("The otp not recevied of vnumber is"." $number"." $log_time");

   }

}

           }



wh_log("************** END Log For Day : '" . $log_time . "'**********");
wh_log("");
wh_log("");






?>
