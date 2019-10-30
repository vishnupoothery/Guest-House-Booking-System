<?php

session_start();
##### DB Configuration #####
$servername = "localhost";
$username = "root";
$password = "";
$db = "guesthouse";

##### Google App Configuration #####
$googleappid = ""; 
$googleappsecret = ""; 
$redirectURL = "http://localhost/Guest-House-Booking-System/authenticate.php"; 
//$redirectURL = "YourRedirectURL"; 

##### Create connection #####
$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
##### Required Library #####
include_once 'src/Google/Google_Client.php';
include_once 'src/Google/contrib/Google_Oauth2Service.php';

$googleClient = new Google_Client();
$googleClient->setApplicationName('Login to NITC Guest House Management System');
$googleClient->setClientId($googleappid);
$googleClient->setClientSecret($googleappsecret);
$googleClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($googleClient);

?>