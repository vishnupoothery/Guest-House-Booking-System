<?php

session_start();

if( !isset($_SESSION['userData']) ){
    header("Location: index.php");
}

?>