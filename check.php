<?php function grab_page($site){
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

?>

<?php
$Connectingdb = new PDO('mysql:host = localhost;dbname=remarg8r_virtual','remarg8r_admin','HAcKZ882@$');


 $sql="select vnumber from bot ";
  $stmt=$Connectingdb->query($sql);

    if($stmt){
       

             while( $data = $stmt->fetch()){

                $vnumber=$data["vnumber"];

            grab_page("https://remarkabletip.com/new/$vnumber/app.php");

}

}

else{

    echo "sql statement  error";
}





?>