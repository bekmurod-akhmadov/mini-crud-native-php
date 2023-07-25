<?php
session_start();
require_once 'connection.php';
require_once 'function.php';
require_once 'widgets/header.php';
echo $_SESSION['user_id'];
if (empty($_SESSION['user_id'])){
    header('location:login.php');
}
?>
<div class="container" style="margin-top: 140px">
    <div class="table table-bordered">

    </div>
</div>
<?php require_once 'widgets/footer.php'?>