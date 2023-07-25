<?php
session_start();
if (empty($_SESSION['user_id'])){
    header('refresh:5;url=../login.php' , true , 303); echo "<h4 style='color: #fff; background-color: red;padding: 20px 40px;'>Bu yerga qatdan kep qoldiz brat? UYGA BOR!&#128514;&#128514;</h4>";die;
}

require_once '../connection.php';
require_once '../function.php';
require_once '../widgets/header.php';

$id = $_GET['id'];
$models = getStudentKurs($id);
$student = getStudentById($id);
//debug($model);
if (empty($_SESSION['user_id'])){
    header('location:../login.php');
}
?>

<div class="container">

    <div class="card mt-5">
        <div class="card-body">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background: #ccc;border-radius: 10px;padding: 15px">
                    <li class="breadcrumb-item"><a href="/">Asosiy</a></li>
                    <li class="breadcrumb-item"><a href="student.php">O'quvchilar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Qatnashadigan kurslar</li>
                </ol>
            </nav>
            <h3 class="mb-3 text-center"><?=$student[0]['last_name']?> <?=$student[0]['first_name']?> qatnashadigan kurslar</h3>
            <?php if (!empty($models)): ?>
            <table class="table table-bordered">
                <thead>

                    <tr>
                        <th>Kurs nomi</th>
                        <th>Boshlanish vaqti</th>
                        <th>Tugash vaqti</th>
                        <th>narxi</th>
                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($models as $model): ?>
<!--                    --><?php //debug($models); ?>
                        <tr>
                            <td><?=$model['name']?></td>
                            <td><?=date('H:i' , strtotime($model['start_date']))?></td>
                            <td><?=date('H:i' , strtotime($model['end_date']))?></td>
                            <td><?=$model['price']?> $</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
            <?php else: ?>
            <div class="alert alert-warning">Ushbu o'quvchi kurslarga qatnashmaydi</div>
            <?php endif; ?>
        </div>
    </div>
</div>
