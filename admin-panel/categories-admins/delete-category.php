<?php require "../layouts/header.php" ?>
<?php require "../../config/config.php"; ?>
<?php 

if(!isset($_SESSION['adminname'])) {
    header("location: ".ADMINURL."/admins/login-admins.php");
    }  

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM categories WHERE id = '$id'";

    $smt = $dba->prepare($sql);
    $smt->execute();

    if($smt) {
       header("location: show-categories.php");
    }
}    