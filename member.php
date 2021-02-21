<?php
 $Connectingdb = new PDO('mysql:host = localhost;dbname=remarg8r_virtual','remarg8r_admin','HAcKZ882@$');


function wh_log($log_msg)
{
  
    $log_filename = "log";
    if (!file_exists($log_filename)) 
    {
        // create directory/folder uploads.
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/log_' . date('d-M-Y') . '.log';
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
}



 
function post_data($site,$data,$proxy){
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



function proxy($url,$proxy){

//$proxyauth = 'user:password';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_PROXY, $proxy);
//curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);

echo $curl_scraped_page;

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

$flimt='0';
$endlimit='14';

 $fisier = file_get_contents('proxy.txt'); 
                $array = explode("\n", $fisier);
                $total= count($array);

              



   if(isset($_POST['channel']))
   {

    global $Connectingdb;

    $channel= $_POST['channel'];

    wh_log("The channel"." $channel"."has been set with max limit of member join"." $endlimit"." $log_time");

    $sql="select vnumber from bot where verify = 'yes' limit $flimt,$endlimit";
        
        $stmt=$Connectingdb->query($sql);
        


     // wh_log("The stmt value is"." var_dump($stmt)". " $log_time");

      if($stmt){


             while( $data = $stmt->fetch()){

                $vnumber=$data["vnumber"];
                wh_log("The vnumber has been set to"." $vnumber"." $log_time");

                  $randIndex = array_rand($array);
                  $proxy = $array[$randIndex];
                  wh_log("Proxy random index is set to"." $randIndex"." Uncheked proxy set to:--"." $proxy"." $log_time");

                  $proxy = test($proxy);

                  wh_log("On function test Proxy random index is set to"." $randIndex"." Uncheked proxy set to:--"." $proxy"." $log_time");

                      
                  $psql="UPDATE bot SET proxy='$proxy' where vnumber='$vnumber'";
                  $pstmt=$Connectingdb->query($psql);

                  wh_log("Proxy random index is set to"." $randIndex"." Uncheked proxy set to:--"." $proxy. $log_time");

              post_data("https://remarkabletip.com/new/$vnumber/app.php","channel=$channel&submit=Submit",$proxy);
         

}


 

}

else{
    
   wh_log("The stmt not runnning"." $stmt"." $log_time");
}


wh_log("************** END Log For Day : '" . $log_time . "'**********");
wh_log("");
wh_log("");
}





?>