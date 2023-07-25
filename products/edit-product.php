<?php
session_start();
if (empty($_SESSION['user_id'])){
    header('refresh:5;url=../login.php' , true , 303); echo "<h4 style='color: #fff; background-color: red;padding: 20px 40px;'>Bu yerga qatdan kep qoldiz brat? UYGA BOR!&#128514;&#128514;</h4>";die;
}
require_once '../connection.php';
require_once '../function.php';
require_once '../widgets/header.php';
$id = $_GET['id'];
$model = getProductById($id);
$attributes = json_decode($model[0]['attributes'] , true);
$keys = array_keys($attributes);


if (!empty($_POST)){
    $name = $_POST['name'];
    $category_id= $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $attributes = json_encode($_POST);



    if (!empty($name) && !empty($category_id) && !empty($brand_id) && !empty($attributes)){
        if (updateProduct($name , $category_id , $brand_id , $attributes , $id)){

            $_SESSION['info'] = "Muvaffaqiyatli qo'shildi";
            header("Location:product.php");
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
                    <li class="breadcrumb-item"><a href="product.php">Productlar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tahrirlash</li>
                </ol>
            </nav>
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <input type="text" name="name" value="<?=!empty($model[0]['name']) ? $model[0]['name'] : ''?>" class="form-control" required placeholder="Xona raqami">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <input type="number" name="category_id" value="<?=!empty($model[0]['category_id']) ? $model[0]['category_id'] : ''?>" class="form-control" required placeholder="Cagegoryid">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <input type="number" name="brand_id" value="<?=!empty($model[0]['brand_id']) ? $model[0]['brand_id'] : ''?>" class="form-control" required placeholder="Brand_id">
                    </div>

                    <h4>Ko'rsatkichlari</h4>

                    <div class="row">
                        <?php foreach ($keys  as $key): ?>
                        <div class="col-lg-4">
                            <label for="">
                                <?=$key?>
                                <input type="text"  value="<?=!empty($attributes[$key]) ? $attributes[$key] : ''?>" name="<?=$key?>" class="form-control">
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>


                </div>
                <div class="col-lg-12">
                    <button class="btn btn-primary">Qo'shish</button>
                </div>
            </form>
        </div>
    </div>
</div>
