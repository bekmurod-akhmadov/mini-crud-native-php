<?php
session_start();
if (empty($_SESSION['user_id'])){
    header('refresh:5;url=../login.php' , true , 303); echo "<h4 style='color: #fff; background-color: red;padding: 20px 40px;'>Bu yerga qatdan kep qoldiz brat? UYGA BOR!&#128514;&#128514;</h4>";die;
}

require_once '../connection.php';
require_once '../function.php';
require_once '../widgets/header.php';

if (!empty($_POST)){
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $gender = $_POST['gender'];
    $experience = $_POST['experience'];
    $specialty = $_POST['specialty'];
    $phone = $_POST['phone'];
    $email= $_POST['email'];
    $phone = $_POST['phone'];
    $status = $_POST['status'];
    if (!empty($last_name) && !empty($first_name) && !empty($gender) && !empty($experience) && !empty($specialty) && !empty($phone) && !empty($email) && !empty($status)){
        if (createTeacher($last_name , $first_name , $gender , $experience , $specialty , $phone , $email , $status)){

            $_SESSION['info'] = "Muvaffaqiyatli qo'shildi";
            header("Location:teacher.php");
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
                    <li class="breadcrumb-item"><a href="teacher.php">O'qituvchilar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Qo'shish</li>
                </ol>
            </nav>
            <form action="" method="post">
                <div class="row">

                    <div class="col-lg-12 mb-3">
                        <input type="text" name="last_name"   class="form-control" required placeholder="Ismi ">
                    </div>
                    
                    <div class="col-lg-12 mb-3">
                        <input type="text" name="first_name"   class="form-control" required placeholder="Familiyasi">
                    </div>

                    <div class="col-lg-12 mb-3">
                        <select name="gender" id="" class="form-select">
                            <option value="1" >Erkak</option>
                            <option value="0" >Ayol</option>
                        </select>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <input type="text" name=" experience"  class="form-control" required placeholder="Ish tajribasi">
                    </div>

                    <div class="col-lg-12 mb-3">
                        <input type="text" name=" specialty"  class="form-control" required placeholder="Mutaxasisligi">
                    </div>

                    <div class="col-lg-12 mb-3">
                        <input type="email" name="email"  class="form-control" required placeholder="Email">
                    </div>

                    <div class="col-lg-12 mb-3">
                        <input type="text" name="phone"  class="form-control" required placeholder="Telefon nomer">
                    </div>

                    <div class="col-lg-12 mb-3">
                        <select name="status" id="" class="form-select">
                            <option value="1">Oliy toifali o'qituvchi</option>
                            <option value="0">Asistent</option>
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
