<?php
session_status();
require_once '../connection.php';
require_once '../function.php';

$id = $_GET['id'];
if(studentDelete($id)){

    header('Location:student.php');
}
