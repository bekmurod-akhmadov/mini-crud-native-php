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
    $column_name = 'first_name';
}

$models = getSortList("rooms" , $page , false , $sort);
if (empty($_SESSION['user_id'])){
    header('location:../login.php');
}
?>
<div class="container" style="margin-top: 140px">
    <?php if (!empty($models)): ?>
        <?php if (!empty($_SESSION['info'])): ?>
            <div class="alert alert-success close-alert-success"><?=$_SESSION['success']?></div>
        <?php endif; ?>

        <div class="button text-right mb-4 d-flex justify-content-end" >
            <a class="btn btn-success" href="create-room.php">Xona qo'shish</a>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Xona raqami
                    <span>
                        <a href="room.php?page=<?=$page?>&column=number&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="room.php?page=<?=$page?>&column=number&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>Qavati
                    <span>
                        <a href="room.php?page=<?=$page?>&column=floor&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="room.php?page=<?=$page?>&column=floor&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($models as $model):?>
                <tr>
                    <td><?=$model['number']?> - xona</td>
                    <td><?=$model['floor']?> - etaj </td>

                    <td>
                        <a class="btn btn-primary" href="edit-room.php?id=<?=$model['id']?>"><i class="fas fa-user-pen"></i></a>
                        <a class="btn btn-danger del" href="delete-room.php?id=<?=$model['id']?>"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for ($page = 1;$page <= getPagination("rooms"); $page++): ?>
                    <li class="page-item"><a class="page-link" href="room.php?page=<?=$page?>&column=<?=$column_name?>&sort=<?=$sort?>"><?=$page?></a></li>
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