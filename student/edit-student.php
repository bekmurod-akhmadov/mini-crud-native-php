<?php
session_start();
if (empty($_SESSION['user_id'])){
    header('refresh:5;url=../login.php' , true , 303); echo "<h4 style='color: #fff; background-color: red;padding: 20px 40px;'>Bu yerga qatdan kep qoldiz brat? UYGA BOR!&#128514;&#128514;</h4>";die;
}

require_once '../connection.php';
require_once '../function.php';
require_once '../widgets/header.php';
$id = $_GET['id'];
if (!empty($id)){
    $model = getStudentById($id);

}
$kurslar = allCurs();

if (!empty($_POST)){

    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $date_birth = date('Y-m-d H:i:s' , strtotime($_POST['date_birth']));
    $gender = $_POST['gender'];
    $adress = $_POST['adress'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];
    $kurs_id = $_POST['kurslar'];

    if (!empty($last_name) && !empty($first_name) && !empty($date_birth) && !empty($gender) && !empty($adress) && !empty($email) && !empty($status) && !empty($phone) && !empty($kurs_id)){

        if (updateStudent($last_name , $first_name , $date_birth , $gender , $adress , $email , $status , $phone, $id , $kurs_id)){

            $_SESSION['info'] = "Muvaffaqiyatli tahrirlandi";
            header("Location:student.php");
        }else{
            $_SESSION['error'] = "Tahrirlashda xatolik yuz berdi";
        }
    }

}
if (empty($_SESSION['user_id'])){
    header('location:../login.php');
}
?>

<?php if (!empty($model)): ?>

<div class="container">

    <div class="card mt-5">
        <div class="card-body">
            <h3 class="mb-3 text-center">Tahrirlash</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background: #ccc;border-radius: 10px;padding: 15px">
                    <li class="breadcrumb-item"><a href="/">Asosiy</a></li>
                    <li class="breadcrumb-item"><a href="student.php">O'quvchilar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tahrirlash</li>
                </ol>
            </nav>
            <form action="" method="post">
                <div class="row">

                    <div class="col-lg-12 mb-3">
                        <label for="">Kurslar</label>
                        <?php if (!empty($kurslar)): ?>
                            <select name="kurslar" class="form-select" id="">
                                <?php foreach ($kurslar as $kurs): ?>
                                    <option value="<?=$kurs['id']?>"><?=$kurs['name']?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <input type="text" name="last_name" value="<?=(!empty($model[0]['first_name']) ? $model[0]['first_name'] : '')?>"  class="form-control" required>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <input type="text" name="first_name" value="<?=(!empty($model[0]['last_name']) ? $model[0]['last_name'] : '')?>"  class="form-control" required>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <?php $date = date('Y-m-d' , strtotime($model[0]['date_birth'])) ?>
                        <input type="date" name="date_birth" value="<?=(!empty($date) ?  $date : '')?>"  class="form-control" required>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <select name="gender" id="" class="form-select">
                            <option value="1" <?=$model[0]['gender'] == 1 ? 'selected' : ''?>>Erkak</option>
                            <option value="0" <?=$model[0]['gender'] == 0 ? 'selected' : ''?>>Ayol</option>
                        </select>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <input type="text" name="adress" value="<?=(!empty($model[0]['adress']) ? $model[0]['adress'] : '')?>"  class="form-control" required>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <input type="email" name="email" value="<?=(!empty($model[0]['email']) ? $model[0]['email'] : '')?>"  class="form-control" required>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <input type="text" name="phone" value="<?=(!empty($model[0]['phone']) ? $model[0]['phone'] : '')?>"  class="form-control" required>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <select name="status" id="" class="form-select">
                            <option value="1" <?=$model[0]['status'] == 1 ? 'selected' : '' ?> >To'lov qilgan</option>
                            <option value="2" <?=$model[0]['status'] == 2 ? 'selected' : '' ?> >To'lov qilmagan</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-12">
                    <button class="btn btn-primary">Tahrirlash</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php endif; ?>
