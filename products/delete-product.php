<?php
session_status();
require_once '../connection.php';
require_once '../function.php';

$id = $_GET['id'];
if (deleteProduct($id)) {

    header('Location:product.php');
}
