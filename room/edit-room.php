<?php
session_start();
if (empty($_SESSION['user_id'])){
    header('refresh:5;url=../login.php' , true , 303); echo "<h4 style='color: #fff; background-color: red;padding: 20px 40px;'>Bu yerga qatdan kep qoldiz brat? UYGA BOR!&#128514;&#128514;</h4>";die;
}

require_once '../connection.php';
require_once '../function.php';
require_once '../widgets/header.php';
$id = $_GET['id'];
$model = getRoomById($id);

if (!empty($_POST)){

    $number = $_POST['number'];
    $floor = $_POST['floor'];


    if (!empty($number) && !empty($floor)){
        if (updateRoom($number , $floor , $id)){

            $_SESSION['info'] = "Muvaffaqiyatli qo'shildi";
            header("Location:room.php");
        }else{
            $_SESSION['error'] = "Tahrirlashda xatolik yuz berdi";
        }
    }

}
if (empty($_SESSION['user_id'])){
    header('location:../login.php');
}
?>

<div class="container">

    <div class="card mt-5">
        <div class="card-body">
            <h3 class="mb-3 text-center">Tahrirlash</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background: #ccc;border-radius: 10px;padding: 15px">
                    <li class="breadcrumb-item"><a href="/">Asosiy</a></li>
                    <li class="breadcrumb-item"><a href="room.php">Xonalar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tahrirlash</li>
                </ol>
            </nav>
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <input type="number" name="number" value="<?=(!empty($model[0]['number']) ? $model[0]['number'] : '')?>"  class="form-control" required placeholder="Xona raqami">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <input type="number" name="floor"  value="<?=(!empty($model[0]['floor']) ? $model[0]['floor'] : '')?>"  class="form-control" required placeholder="Qavat">
                    </div>

                </div>
                <div class="col-lg-12">
                    <button class="btn btn-primary">Tahrirlash</button>
                </div>
            </form>
        </div>
    </div>
</div>
