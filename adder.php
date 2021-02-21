<?php

//$Connectingdb= new PDO('mysql:host = localhost;dbname=test1','root','');

$Connectingdb = new PDO('mysql:host = localhost;dbname=remarg8r_virtual','remarg8r_admin','HAcKZ882@$');



$sql="select count(*) from bot where verify='yes'";
                $stmt=$Connectingdb->query($sql);
                $total=$stmt->fetch();
                $totalbot=array_shift($total);


?>






<html>
<body>

	<p> Member Adder script by Ashish</p><br>

	<p>Total number of active fake members:--</p><?php echo $totalbot; ?><br>

	<br>
	<br>
<p>Entre the channel name with @ example @mychannel</p>

<form method="post" action="member.php">
  Channel Name:-- <input type="text" name="channel">
  <input type="submit" name="submit">
</form>

<?php


if (isset($_POST['submit'])) {
   
    $channel = $_POST['channel'];

  
}

?>

</body>
</html>