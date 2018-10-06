<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('Location: ../login.php');
    }
    else{
        
    $message = $_GET['message'];
    echo "$message";
    }
    
?>