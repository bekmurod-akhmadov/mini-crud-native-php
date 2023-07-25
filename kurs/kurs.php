<?php
session_start();
if (empty($_SESSION['user_id'])){
    header('refresh:5;url=../login.php' , true , 303); echo "<h4 style='color: #fff; background-color: red;padding: 20px 40px;'>Bu yerga qatdan kep qoldiz brat? UYGA BOR!&#128514;&#128514;</h4>";die;
}

require_once '../connection.php';
require_once '../function.php';
require_once '../widgets/header.php';
if (!empty($_GET['page'])){
    $page = $_GET['page'];
}else{
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
    $column_name = 'name';
}


$models = getSortList("kurs" , $page , false , $sort);
if (empty($_SESSION['user_id'])){
    header('location:../login.php');
}
?>

<div class="container-fluid" style="margin-top: 140px">
    <?php if (!empty($models)): ?>
        <?php if (!empty($_SESSION['info'])): ?>
            <div class="alert alert-success close-alert-success"><?=$_SESSION['success']?></div>
        <?php endif; ?>

        <div class="button text-right mb-4 d-flex justify-content-end" >
            <a class="btn btn-success" href="create-kurs.php">Kurs qo'shish</a>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Kurs nomi
                    <span>
                        <a href="kurs.php?page=<?=$page?>&column=name&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="kurs.php?page=<?=$page?>&column=name&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>O'qituvchining ismi
                    <span>
                        <a href="kurs.php?page=<?=$page?>&column=teacher_id&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="kurs.php?page=<?=$page?>&column=teacher_id&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>Xona raqami
                    <span>
                        <a href="kurs.php?page=<?=$page?>&column=room_id&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="kurs.php?page=<?=$page?>&column=room_id&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>Boshlanish vaqti
                    <span>
                        <a href="kurs.php?page=<?=$page?>&column=start_date&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="kurs.php?page=<?=$page?>&column=start_date&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>Tugash vaqti
                    <span>
                        <a href="kurs.php?page=<?=$page?>&column=end_date&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="kurs.php?page=<?=$page?>&column=end_date&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>1 Haftada
                    <span>
                        <a href="kurs.php?page=<?=$page?>&column=in_week&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="kurs.php?page=<?=$page?>&column=in_week&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>Kunlari
                    <span>
                        <a href="kurs.php?page=<?=$page?>&column=even_or_odd&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="kurs.php?page=<?=$page?>&column=even_or_odd&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>Narxi
                    <span>
                        <a href="kurs.php?page=<?=$page?>&column=price&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="kurs.php?page=<?=$page?>&column=price&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>Joylar Soni

                </th>
                <th>Status</th>
                <th>Amal</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($models as $model):?>
                <?php
                    $teacher = getTeacherById($model['teacher_id']);
                    $room = getRoomById($model['room_id']);
                    $countStudent = studentCount($model['id']);
                ?>
                <tr>
                    <td><?=$model['name']?></td>
                    <td><?=$teacher[0]['last_name']?> <?=$teacher[0]['first_name']?></td>
                    <td><?=$room[0]['floor']?>-etaj <?=$room[0]['number']?>-xona</td>
                    <td><?=date('H:i' , strtotime($model['start_date']))?></td>
                    <td><?=date('H:i' , strtotime($model['end_date']))?></td>
                    <td><?=$model['in_week']?></td>
                    <td><?=($model['even_or_odd'] == 1) ? 'Toq kunlari' : 'Juft kunlari'?></td>
                    <td><?=$model['price']?> $</td>
                    <td><?=$countStudent[0]['soni']?> / 7</td>
                    <?php if ($countStudent[0]['soni']  >= 7): ?>
                        <td > <span style="display: block;text-align: center;padding: 7px 15px;border-radius: 10px;" class="bg bg-success text-light">Guruh to'lgan</span></td>
                    <?php else: ?>
                        <td><?=($countStudent[0]['soni'] >=  1 && $countStudent[0]['soni'] < 7 ? "<span style='display: block;text-align: center;padding: 7px 15px;border-radius: 10px;' class='bg bg-warning text-light'>Guruh to'lishi kutilmoqda</span>" : "<span style='display: block;text-align: center;padding: 7px 15px;border-radius: 10px;' class='text-light bg bg-danger'>Guruh to'lishi kutilmoqda</span>")?></td>
                    <?php endif; ?>
                    <td>
                        <a class="btn btn-primary" href="edit-kurs.php?id=<?=$model['id']?>"><i class="fas fa-user-pen"></i></a>
                        <a class="btn btn-danger del" href="delete-kurs.php?id=<?=$model['id']?>"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for ($page = 1;$page <= getPagination("kurs"); $page++): ?>
                    <li class="page-item"><a class="page-link" href="kurs.php?page=<?=$page?>&column=<?=$column_name?>&sort=<?=$sort?>"><?=$page?></a></li>
                <?php endfor; ?>
            </ul>
        </nav>
        <?php unset($_SESSION['info']) ?>
    <?php endif; ?>
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

