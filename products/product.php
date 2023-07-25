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

$models = getSortList("product" , $page , false , $sort);

if (empty($_SESSION['user_id'])){
    header('location:../login.php');
}
?>
<div class="container" style="margin-top: 140px">
    <?php if (!empty($models)): ?>
        <?php if (!empty($_SESSION['info'])): ?>
            <div class="alert alert-success close-alert-success"><?=$_SESSION['info']?></div>
        <?php endif; ?>

        <div class="button text-right mb-4 d-flex justify-content-end" >
            <a class="btn btn-success" href="create-product.php">Product qo'shish</a>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>
                    <form action="">
                        <input value="<?=!empty($finder) ? $finder : ''?>" type="text" name="att" class="form-control">
                    </form>
                </th>
                <th></th>
            </tr>
            <tr>
                <th>Product nomi
                    <span>
                        <a href="product.php?page=<?=$page?>&column=name&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="product.php?page=<?=$page?>&column=name&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>Brand
                    <span>
                        <a href="product.php?page=<?=$page?>&column=brand_id&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="product.php?page=<?=$page?>&column=brand_id&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>Categoriy
                    <span>
                        <a href="product.php?page=<?=$page?>&column=category_id&sort=asc"><i class="fas fa-arrow-up"></i></a>
                        <a href="product.php?page=<?=$page?>&column=category_id&sort=desc"><i class="fas fa-arrow-down"></i></a>
                    </span>
                </th>
                <th>
                    Attributlari

                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($models as $model):?>
                <tr>
                    <td><?=$model['name']?> </td>
                    <td><?=$model['category_id']?></td>
                    <td><?=$model['brand_id']?></td>
                    <td style="display: flex;flex-wrap: wrap;max-width:600px">
                    <?php if (!empty($model['attributes'])): ?>
                        <?php $attributes = json_decode($model['attributes'] , true);
                            $keys = array_keys($attributes);
                        ?>
                        <?php foreach ($keys as $key): ?>
                            <strong style="font-size: 11px;margin-left: 20px"><?=$key?></strong><span style="font-size: 11px"> - <?=$attributes[$key]?> | </span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </td>


                    <td>
                        <a class="btn btn-primary" href="edit-product.php?id=<?=$model['id']?>"><i class="fas fa-user-pen"></i></a>
                        <a class="btn btn-danger del" href="delete-product.php?id=<?=$model['id']?>"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for ($page = 1;$page <= getPagination("product"); $page++): ?>
                    <li class="page-item"><a class="page-link" href="product.php?page=<?=$page?>&column=<?=$column_name?>&sort=<?=$sort?>"><?=$page?></a></li>
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