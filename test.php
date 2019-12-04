<?php

include('dbConfig.php');
        $sql = "INSERT INTO registrar (username,password,email) VALUES ('registrar', '".password_hash('1234', PASSWORD_BCRYPT)."', 'jyothsna_b160901cs@nitc.ac.in')
        ";


        if (mysqli_query($db, $sql) == TRUE) {

          echo "inserted";
        }
        else
        echo $db->error;
        ?>