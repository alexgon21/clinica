<?php
session_start();
    if(isset($_SESSION["logged"])){
        if(!$_SESSION["logged"]) header("Location: index.php");
    }else{
        header("Location: index.php");
    }
?>