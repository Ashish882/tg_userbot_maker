<?php
function emptyDir($dir) {
    if (is_dir($dir)) {
        $scn = scandir($dir);
        foreach ($scn as $files) {
            if ($files !== '.') {
                if ($files !== '..') {
                    if (!is_dir($dir . '/' . $files)) {
                        unlink($dir . '/' . $files);
                    } else {
                        emptyDir($dir . '/' . $files);
                        rmdir($dir . '/' . $files);
                    }
                }
            }
        }
    }
}

function deleteDir($dir) {

    foreach(glob($dir . '/' . '*') as $file) {
        if(is_dir($file)){


            deleteDir($file);
        } else {

          unlink($file);
        }
    }
    emptyDir($dir);
    rmdir($dir);
}
 $Connectingdb = new PDO('mysql:host = localhost;dbname=remarg8r_virtual','remarg8r_admin','HAcKZ882@$');



 $sql="select vnumber from bot where verify = 'banned'";
 $stmt=$Connectingdb->query($sql);
 while($data = $stmt->fetch()){

 	$vnumber = $data["vnumber"];


 	deleteDir($vnumber);
 }
 


?>