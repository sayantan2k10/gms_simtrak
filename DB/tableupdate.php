
<?php

    include("dbconn.php");

    $sql = "ALTER TABLE `Pinnacle 1` CHANGE `Reamrk` `Remark` varchar(500) NOT NULL;";

    if($conn->query($sql)){
        echo "done ok";
    }else{
        echo "not done" . $conn->error;
    }
   

// Close the connection
    $conn->close();

?>



