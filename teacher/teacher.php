<?php
session_start();
//echo session_id();die;
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
}else {
    $column_name = 'first_name';
}
if (!empty($_GET['by_name'])){
    $finder = $_GET['by_name'];
    $models = getTeacherByName($finder);
}else{
    $models = getSortList("teacher" , $page , false , $sort , $column_name);

}
//debug($models);die;

?>

<div class="container" style="margin-top: 140px">

        <?php if (!empty($_SESSION['info'])): ?>
            <div class="alert alert-success close-alert-success"><?=$_SESSION['success']?></div>
        <?php endif; ?>

        <div class="button text-right mb-4 d-flex justify-content-end" >
            <a class="btn btn-success" href="create-teacher.php">O'qituvchi qo'shish</a>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>
                    <form action="">
                        <input type="text" value="<?=!empty($finder) ? $finder : ''?>" name="by_name" class="form-control">
                    </form>
                </th>
            </tr>
            <tr>
                <th>Ismi
                    <span>
                            <a href="teacher.php?page=<?=$page?>&column=last_name&sort=asc"><i class="fas fa-arrow-up"></i></a>
                            <a href="teacher.php?page=<?=$page?>&column=last_name&sort=desc"><i class="fas fa-arrow-down"></i></a>
                        </span>
                </th>
                <th>Familiyasi
                        <span>
                            <a href="teacher.php?page=<?=$page?>&column=first_name&sort=asc"><i class="fas fa-arrow-up"></i></a>
                            <a href="teacher.php?page=<?=$page?>&column=first_name&sort=desc"><i class="fas fa-arrow-down"></i></a>
                        </span>
                </th>
                <th>Jinsi
                    <span>
                            <a href="teacher.php?page=<?=$page?>&column=gender&sort=asc"><i class="fas fa-arrow-up"></i></a>
                            <a href="teacher.php?page=<?=$page?>&column=gender&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>Ish tajribasi
                    <span>
                        <a href="teacher.php?page=<?=$page?>&column=experience&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="teacher.php?page=<?=$page?>&column=experience&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>Mutaxasisligi
                    <span>
                        <a href="teacher.php?page=<?=$page?>&column=specialty&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="teacher.php?page=<?=$page?>&column=specialty&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>Email
                    <span>
                        <a href="teacher.php?page=<?=$page?>&column=email&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="teacher.php?page=<?=$page?>&column=email&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>Telefon raqami
                    <span>
                        <a href="teacher.php?page=<?=$page?>&column=phone&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="teacher.php?page=<?=$page?>&column=phone&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>Amal</th>
            </tr>
            </thead>
            <?php if (!empty($models)): ?>
            <tbody>
            <?php foreach ($models as $model):?>
                <tr>
                    <td><?=$model['last_name']?></td>
                    <td><?=$model['first_name']?></td>
                    <td><?=($model['gender'] == 1 ? 'Erkak' : 'Ayol')?></td>
                    <td><?=$model['experience']?> yil</td>
                    <td><?=$model['specialty']?></td>
                    <td><?=$model['email']?></td>
                    <td><?=$model['phone']?></td>
                    <td>
                        <a class="btn btn-primary" href="edit-teacher.php?id=<?=$model['id']?>"><i class="fas fa-user-pen"></i></a>
                        <a class="btn btn-danger del" href="delete-teacher.php?id=<?=$model['id']?>"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach?>
            </tbody>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php for ($page = 1;$page <= getPagination("teacher") ; $page++): ?>
                            <li class="page-item"><a class="page-link" href="teacher.php?page=<?=$page?>&column=<?=$column_name?>&sort=<?=$sort?>"><?=$page?></a></li>
                        <?php endfor; ?>
                    </ul>
                </nav>
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

