<?php
    $conn = new mysqli('localhost','root','','se');
        if($conn->connect_errno){
            die("connect faild" . $conn->connect_error);
        }

    
?>
