<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'academy';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname" , $username , $password);
}catch (PDOException $e){
    echo "Bazaga ulanishda xatolik yuz berdi" . $e->getMessage();
}

