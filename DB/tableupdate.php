
<?php

    include("dbconn.php");

    $sql = "INSERT INTO `Glowball`(`goalset`) VALUES ('1')";

    if($conn->query($sql)){
        echo "done ok";
    }else{
        echo "not done" . $conn->error;
    }
   

// Close the connection
    $conn->close();

?>



