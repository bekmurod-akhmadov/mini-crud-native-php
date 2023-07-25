<?php

use db\Student;

session_start();
if (empty($_SESSION['user_id'])){
    header('refresh:5;url=../login.php' , true , 303); echo "<h4 style='color: #fff; background-color: red;padding: 20px 40px;'>Bu yerga qatdan kep qoldiz brat? UYGA BOR!&#128514;&#128514;</h4>";die;
}

require_once '../connection.php';
require_once '../function.php';
require_once '../widgets/header.php';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
if (!empty($_GET['sort'])){
    $sort = $_GET['sort'];
}else{
    $sort = 'asc';
}
if (!empty($_GET['column'])){
    $column_name = $_GET['column'];
}else{
    $column_name = 'first_name';
}
if (!empty($_GET['last_name'])){

    $finder = $_GET['last_name'];
    $models =  findByName($finder);

} if (!empty($_GET['first_name'])){

    $finder = $_GET['first_name'];
    $models = findByFirstName($finder);
}else{
    $models = getSortList( "student" , $page,false , $sort , $column_name);
}

if (empty($_SESSION['user_id'])){
    header('location:../login.php');
}

?>

<div class="container-fluid" style="margin-top: 140px">

        <?php if (!empty($_SESSION['info'])): ?>
            <div class="alert alert-success close-alert-success"><?=$_SESSION['info']?></div>
        <?php endif; ?>

        <div class="button text-right mb-4 d-flex justify-content-end" >
            <a class="btn btn-success" href="create-student.php">Student qo'shish</a>
        </div>
    <style>
        tr{
            vertical-align: middle;
        }
    </style>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>
                        <form action="" name="last_name">
                            <input type="text" value="<?=!empty($_GET['last_name']) ? $_GET['last_name'] : ''?>" class="form-control" name="last_name">
                        </form>
                    </th>
                    <th>
                        <form action="" name="first_name">
                            <input type="text" value="<?=!empty($_GET['first_name']) ? $_GET['first_name'] : ''?>" class="form-control" name="first_name">
                        </form>
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>

                    <th>Ismi
                        <span>
                            <a href="student.php?page=<?=$page?>&column=last_name&sort=asc"><i class="fas fa-arrow-up"></i></a>
                            <a href="student.php?page=<?=$page?>&column=last_name&sort=desc"><i class="fas fa-arrow-down"></i></a>
                        </span>

                    </th>
                    <th>Familiyasi 
                        <span>
                            <a href="student.php?page=<?=$page?>&column=first_name&sort=asc"><i class="fas fa-arrow-up"></i></a>
                            <a href="student.php?page=<?=$page?>&column=first_name&sort=desc"><i class="fas fa-arrow-down"></i></a>
                        </span>
                    </th>
                    <th>
                        Tug'ilgan sanasi
                        <span>
                            <a href="student.php?page=<?=$page?>&column=date_birth&sort=asc"><i class="fas fa-arrow-up"></i></a>
                            <a href="student.php?page=<?=$page?>&column=date_birth&sort=desc"><i class="fas fa-arrow-down"></i></a>
                        </span>
                    </th>
                    <th>Jinsi
                        <span>
                            <a href="student.php?page=<?=$page?>&column=gender&sort=asc"><i class="fas fa-arrow-up"></i></a>
                            <a href="student.php?page=<?=$page?>&column=gender&sort=desc"><i class="fas fa-arrow-down"></i></a>
                        </span>
                    </th>
                    <th>Mansili
                        <span>
                            <a href="student.php?page=<?=$page?>&column=adress&sort=asc"><i class="fas fa-arrow-up"></i></a>
                            <a href="student.php?page=<?=$page?>&column=adress&sort=desc"><i class="fas fa-arrow-down"></i></a>
                        </span>
                    </th>
                    <th>Emaili
                        <span>
                            <a href="student.php?page=<?=$page?>&column=email&sort=asc"><i class="fas fa-arrow-up"></i></a>
                            <a href="student.php?page=<?=$page?>&column=email&sort=desc"><i class="fas fa-arrow-down"></i></a>
                        </span>
                    </th>
                    <th>Telefon raqami
                        <span>
                            <a href="student.php?page=<?=$page?>&column=phone&sort=asc"><i class="fas fa-arrow-up"></i></a>
                            <a href="student.php?page=<?=$page?>&column=phone&sort=desc"><i class="fas fa-arrow-down"></i></a>
                        </span>
                    </th>
                    <th>Rasmi</th>
                    <th>Amal</th>
                </tr>
            </thead>
            <?php if (!empty($models)): ?>
            <tbody>
                <?php foreach ($models as $model):?>
                <tr>
                    <td><?=$model['last_name']?></td>
                    <td><?=$model['first_name']?></td>
                    <td><?=date('Y.m.d' , strtotime($model['date_birth']))?></td>
                    <td><?=($model['gender'] == 1 ? 'Erkak' : 'Ayol')?></td>
                    <td><?=$model['adress']?></td>
                    <td><?=$model['email']?></td>
                    <td><?=$model['phone']?></td>
                    <td><img style="width: 100px;height: 80px;object-fit: cover;" src="../files/<?=$model['image']?>" alt="<?=$model['last_name'] . ' ' . $model['first_name']?>"></td>
                    <td>
                        <a class="btn btn-primary" href="edit-student.php?id=<?=$model['id']?>"><i class="fas fa-user-pen"></i></a>
                        <a class="btn btn-danger del" href="delete-student.php?id=<?=$model['id']?>"><i class="fas fa-trash"></i></a>
                        <a class="btn btn-success" href="kursview.php?id=<?=$model['id']?>"><i class="fas fa-book" title="qatnashayotgan kurslari"></i></a>
                    </td>
                </tr>
                <?php endforeach?>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php for ($page = 1; $page <= getPagination("student"); $page++) { ?>
                            <li class="page-item"><a class="page-link" href="student.php?page=<?=$page?>&column=<?=$column_name?>&sort=<?=$sort?>"><?=$page?></a></li>
                        <?php } ?>
                    </ul>
                </nav>

            </tbody>
                <?php unset($_SESSION['info']) ?>
            <?php endif; ?>
        </table>

</div>
<script>
    var buttons = document.querySelectorAll('.del');
    for(let i=0;i<buttons.length;i++){
        buttons[i].addEventListener('click',function(e){
            let del = confirm("Rostdan ham o'chirilsinmi?");
            if(!del){
                e.preventDefault();
                return false;
            }
        })
    }

    setTimeout(function () {
        document.querySelector('.close-alert-success').style.display = 'none';
    } , 2000);
</script>

