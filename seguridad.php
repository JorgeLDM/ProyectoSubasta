<?php
session_start();
error_reporting(E_PARSE);
if (!$_SESSION['id_administrador'] !=1) {
    
} else {
    header("Location: login.php");
    exit();
}