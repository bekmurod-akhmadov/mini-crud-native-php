<?php
session_start();
if (empty($_SESSION['user_id'])){
    header('refresh:5;url=../login.php' , true , 303); echo "<h4 style='color: #fff; background-color: red;padding: 20px 40px;'>Bu yerga qatdan kep qoldiz brat? UYGA BOR!&#128514;&#128514;</h4>";die;
}
require_once '../connection.php';
require_once '../function.php';
require_once '../widgets/header.php';

if (!empty($_POST)){
//    debug($_POST);die;
    $name = $_POST['name'];
    $category_id= $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $attributes = json_encode($_POST);


    if (!empty($name) && !empty($category_id) && !empty($brand_id) && !empty($attributes)){
        if (createProduct($name , $category_id , $brand_id , $attributes)){

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
            <h3 class="mb-3 text-center">Qo'shish</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background: #ccc;border-radius: 10px;padding: 15px">
                    <li class="breadcrumb-item"><a href="/">Asosiy</a></li>
                    <li class="breadcrumb-item"><a href="product.php">Productlar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Qo'shish</li>
                </ol>
            </nav>
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <input type="text" name="name" value="<?=!empty($model['name']) ? $model['name'] : ''?>" class="form-control" required placeholder="Xona raqami">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <input type="number" name="category_id"   class="form-control" required placeholder="Cagegoryid">
                    </div>
                    <div class="col-lg-12 mb-3">
                        <input type="number" name="brand_id"   class="form-control" required placeholder="Brand_id">
                    </div>

                    <h4>Ko'rsatkichlari</h4>

                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">
                                ROM
                                <input type="text" name="ROM" class="form-control">
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label for="">
                                RAM
                                <input type="text" name="Ram" class="form-control">
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label for="">
                               Versiya OS
                                <input type="text" name="OS" class="form-control">
                            </label>
                        </div>

                        <div class="col-lg-4">
                            <label for="">
                                Rangi
                                <input type="text" name="Rangi" class="form-control">
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label for="">
                                Otpechatka
                                <input type="text" class="form-control" name="Otpechatka">
                            </label>
                        </div>
                        <div class="col-lg-4">
                            <label for="">
                                Kamera
                                <input type="text" name="Kamre" class="form-control">
                            </label>
                        </div>
                    </div>


                </div>
                <div class="col-lg-12">
                    <button class="btn btn-primary">Qo'shish</button>
                </div>
            </form>
        </div>
    </div>
</div>
