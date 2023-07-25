<?php
session_start();
if (empty($_SESSION['user_id'])){
    header('refresh:5;url=../login.php' , true , 303); echo "<h4 style='color: #fff; background-color: red;padding: 20px 40px;'>Bu yerga qatdan kep qoldiz brat? UYGA BOR!&#128514;&#128514;</h4>";die;
}
require_once '../connection.php';
require_once '../function.php';
require_once '../widgets/header.php';

$kurslar = allCurs();
$teachers = getAllTechres();
$rooms = getAllRoom();

if (!empty($_POST)){

    $name = $_POST['name'];
    $tacher_id = $_POST['tacher_id'];
    $in_week = $_POST['in_week'];
    $even_or_odd = $_POST['even_or_odd'];
    $price = $_POST['price'];
    $room_id = $_POST['room_id'];
    $start_date = date('H:i:s' , strtotime($_POST['start_date']));
    $end_date = date('H:i:s' , strtotime($_POST['end_date']));


    if (!empty($name) && !empty($tacher_id) && !empty($in_week) && !empty($even_or_odd) && !empty($price) && !empty($room_id) && !empty($start_date) && !empty($end_date)){

        if (createKurs($name , $tacher_id , $in_week , $even_or_odd , $price , $room_id , $start_date , $end_date)){

            $_SESSION['info'] = "Muvaffaqiyatli qo'shildi";
            header("Location:kurs.php");
        }else{
            $_SESSION['error_info'] = "Tahrirlashda xatolik yuz berdi";
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
            <h3 class="mb-3 text-center">Qo'shish</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background: #ccc;border-radius: 10px;padding: 15px;">
                    <li class="breadcrumb-item"><a href="/">Asosiy</a></li>
                    <li class="breadcrumb-item"><a href="kurs.php">Kurslar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Qo'shish</li>
                </ol>
            </nav>
            <form action="" method="post">
                <div class="row">

                    <div class="col-lg-12 mb-3">
                        <input type="text" name="name"   class="form-control" required placeholder="Kurs nomi">
                    </div>

                    <div class="col-lg-12 mb-3">
                        <select name="tacher_id" id="" class="form-select">
                            <?php if (!empty($teachers)): ?>
                            <?php foreach ($teachers as $teacher): ?>
                            <option value="<?=$teacher['id']?>"><?=$teacher['last_name']?> <?=$teacher['first_name']?></option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <input type="number" name="in_week"  class="form-control" required placeholder="Haftada nechi kun">
                    </div>

                    <div class="col-lg-12 mb-3">
                        <select name="even_or_odd" id="" class="form-select">
                            <option value="1">Toq kunlar</option>
                            <option value="2">Juft kunlar</option>
                        </select>
                    </div>
                    <div class="col-lg-12 mb-3">
                        <label for="">Boshlanish vaqti</label>
                        <input type="time" class="form-control" required name="start_date">
                    </div>

                    <div class="col-lg-12 mb-3">
                        <label for="">Tugash vaqti</label>
                        <input type="time" class="form-control" required name="end_date">
                    </div>

                    <div class="col-lg-12 mb-3">
                        <input type="number" name="price"  class="form-control" required placeholder="Narxi">
                    </div>

                    <div class="col-lg-12 mb-3">
                        <select name="room_id" id="" class="form-select">
                            <?php if (!empty($rooms)): ?>
                                <?php foreach ($rooms as $room): ?>
                                    <option value="<?=$room['id']?>"><?=$room['floor']?>-etaj <?=$room['number']?>-xona</option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                </div>
                <div class="col-lg-12">
                    <button class="btn btn-primary">Qo'shish</button>
                </div>
            </form>
        </div>
    </div>
</div>
