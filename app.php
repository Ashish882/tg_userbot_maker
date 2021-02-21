<?php
$Connectingdb = new PDO('mysql:host = localhost;dbname=remarg8r_virtual','remarg8r_admin','HAcKZ882@$');

if(http_response_code(400)){
	global $Connectingdb;
	$number = basename(__DIR__);

	$sql = "UPDATE bot SET verify='banned' WHERE vnumber=$number";
$stmt=$Connectingdb->query($sql);



}


$number = basename(__DIR__);

require '../vendor/autoload.php';
if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
include 'madeline.php';


$settings = [
'app_info' => [
'api_id' => 1378660,
'api_hash' => '67ca759977e97094e963030c6ba99908'
]];


$MadelineProto = new \danog\MadelineProto\API('index.madeline',$settings);
$me = $MadelineProto->start();

$me = $MadelineProto->getSelf();

if($me){
	global $Connectingdb;

$sql = "UPDATE bot SET verify='yes' WHERE vnumber=$number";
$stmt=$Connectingdb->query($sql);



}

else{
	global $Connectingdb;

	$sql = "UPDATE bot SET verify='died' WHERE vnumber=$number";
	$stmt=$Connectingdb->query($sql);


}

\danog\MadelineProto\Logger::log($me);

if (!$me['bot']) {

    $channel=$_POST['channel'];
   // $MadelineProto->messages->sendMessage(['peer' => '@eh_ashish', 'message' => "Hi! $channel Script working <3 ,Script by @eh_ashish "]);
    $result=$MadelineProto->channels->joinChannel(['channel' => $channel]);
    if($result){

        echo "You succesfully joined this channel". $channel;
     //$me =  $MadelineProto->logout();
    }

}

echo 'OK, done!'.PHP_EOL;

$HttpStatus = $_SERVER["REDIRECT_STATUS"] ;


