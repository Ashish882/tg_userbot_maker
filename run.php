<?php 


$Connectingdb = new PDO('mysql:host = localhost;dbname=remarg8r_virtual','remarg8r_admin','HAcKZ882@$');

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
     $proxyfisier = file_get_contents('proxy.txt'); 
                $proxyarray = explode("\n", $proxyfisier);
  global $fisier;
  $splited = explode(':',$proxy); // Separate IP and port
  if($con = @fsockopen($splited[0], $splited[1], $eroare, $eroare_str, 3)) 
  {
   return (string)$proxy;
  }

  else{

    $randIndex = array_rand($proxyarray);
                

                  $proxy= $proxyarray[$randIndex];
                  test($proxy);


  }
}
?>




<?php

$log_time = date('Y-m-d h:i:sa');

wh_log("************** Start Log For Day : '" . $log_time . "'**********");

$fisier = file_get_contents('number.txt'); 
$array = explode("\n", $fisier); 

$newfisier = file_get_contents('name.txt'); 
$newarray = explode("\n", $newfisier); 

$proxyfisier = file_get_contents('proxy.txt'); 
$proxyarray = explode("\n", $proxyfisier);



$totalarray= count($array);

wh_log("The array limit is set to:--"." $totalarray"." $log_time");
for($i=0 ; $i < $totalarray; $i++){

    if(!is_dir ($array[$i]))
{

 mkdir($array[$i], 0777);

 $source='app.php';
 $dest= $array[$i].'/app.php';
copy ( $source, $dest );
 $newsource='index.php';
 $newdest= $array[$i].'/index.php';
copy ( $newsource, $newdest );

 $number = $array[$i];
 $name = $newarray[$i];

 wh_log("The array number is set to :--"." $number"." and the name is set to"." $name". "$log_time");

$url='https://remarkabletip.com/new/'.$array[$i].'/app.php';


 $randIndex = array_rand($proxyarray);
 $proxy= $proxyarray[$randIndex];
  wh_log("Proxy random index is set to"." $randIndex"." Uncheked proxy set to:--"." $proxy"." $log_time");

   $proxy = test($proxy);

wh_log("On function test Proxy random index is set to"." $randIndex"." Uncheked proxy set to:--"." $proxy"." $log_time");


ppost_data($url,"phone_number=$number",$proxy);


sleep(10);


$sql="select vte from virtual where vto='$number' order by id desc";

$stmt=$Connectingdb->query($sql);

$str=$stmt->fetch();

if($str){

$str=array_shift($str);


if ( preg_match ( '/([0-9]+)/', $str, $matches ) )
{
    $getotp = $matches[0];
    wh_log("The otp recevied is"." $getotp"." of vnumber is"." $number"." $log_time");

}


        $value = vnumber_exist($number);

        if($value){

     $sql ="INSERT INTO bot(vnumber,verify)";
     $sql .="VALUES('$number','no')";
     $stmt= $Connectingdb->query($sql);
        
        if($stmt){


                    }
                 }

  post_data($url,"phone_code=$getotp");
 post_data($url,"first_name=$name&last_name=");
           }
     

}

}

wh_log("************** END Log For Day : '" . $log_time . "'**********");
wh_log("");
wh_log("");






?>