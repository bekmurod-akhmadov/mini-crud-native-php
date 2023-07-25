<?php
//student jadvalidan barcha malumotlarni olish
function getAllStudents(){
    global $db;
    $sql = "select * from student where status = 1";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
    }catch (PDOException $info){
        echo "<pre>";
        print_r($info->getMessage());
    }
    $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
}

//id boyicha studentni select qilish
function getStudentById($id){
    global $db;
    $sql = "select * from student where id = $id";
    $prepere = $db->prepare($sql);
    try {
        $prepere->execute();
    }catch (PDOException $info){
        print_r($info->getMessage());
    }

    $result = $prepere->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
}

function updateStudent($last_name , $first_name , $date_birth , $gender , $adress , $email , $status ,$phone , $id , $kurs_id){
    global $db;
    $query = "UPDATE `student` set `last_name` = '$last_name' , `first_name` = '$first_name' , `date_birth` = '$date_birth' , `gender` = '$gender' , `adress` = '$adress' , email = '$email' , phone = '$phone' ,`status` = '$status' where `id` = '$id'";
    $prepare = $db->prepare($query);
    if ($prepare->execute()){
        $sql2 = "insert into student_kurs(student_id , course_id) values ($id , $kurs_id)";
        $prepare2 = $db->prepare($sql2);
        try {
            $prepare2->execute();
            return true;
        }catch (PDOException $i){
            debug($i->getMessage());
        }
    }
}
//function getByEmail($email){
//    global $db;
//    $sql = "select id from student where email = $email";
//    $prepare = $db->prepare($sql);
//    try {
//        $prepare->execute();
//        return $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);
//    }catch (PDOException $info){
//        debug($info->getMessage());
//    }
//}

function createStudent($last_name , $first_name , $date_birth , $gender , $adress , $email , $status , $phone , $kurs_id , $image){
    global $db;
    $sql = "insert into `student`(`first_name` , `last_name` , `date_birth` , `gender` , `adress` , `email` , `phone` , `status` , `image`) 
            values ('$first_name' , '$last_name' , '$date_birth' , '$gender' , '$adress' , '$email' , '$phone' , '$status' , '$image')";
    $prepare = $db->prepare($sql);

    try {
        $prepare->execute();
    }catch (PDOException $info){
        debug($info->getMessage());
    }
    $db->exec($sql);
    $last_id = $db->lastInsertId();
    if ($prepare->execute()){
        $sql2 = "insert into student_kurs(student_id , course_id) values ('$last_id' , '$kurs_id')";
        $prepare2 = $db->prepare($sql2);
        $prepare2->execute();
        return true;
    }

}


function studentDelete($id){
    global $db;
    $sql = "delete from student where id = '$id'";
    try {
        $db->exec($sql);
        return true;
    }catch (PDOException $info){
        debug($info->getMessage());
    }
}

function allCurs(){
    global $db;
    $sql = "select * from kurs";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }catch (PDOException $info){
        echo "<pre>";
        print_r($info->getMessage());
    }
}






// CRUD function Rooms
function getAllRoom(){
    global  $db;
    $sql = "select * from rooms";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        return $result;

    }catch (PDOException $info){
        debug($info->getMessage());
    }

}

function createRoom($number , $floor){
    global $db;
    $sql = "insert into rooms(number , floor) values ('$number' , '$floor')";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        return true;
    }catch (PDOException $info){
        debug($info->getMessage());
    }
}

function getRoomById($id){
    global $db;
    $sql = "select * from rooms where id = $id";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }catch (PDOException $info){
        debug($info->getMessage());
    }
}

function updateRoom($number , $floor , $id){
    global $db;
    $sql = "update rooms set number = '$number' , floor = $floor where  id = $id";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        return true;
    }catch (PDOException $info){
        debug($info->getMessage());
    }
}

function deleteRoom($id){
    global $db;
    $sql = "delete from rooms where id = '$id'";
    try {
        $db->exec($sql);
        return true;
    }catch (PDOException $info){
        debug($info->getMessage());
    }
}

function getStudentKurs($id){
    global  $db;
    $sql = "select k.name , k.start_date , k.end_date , k.price , k.even_or_odd from
student
inner join student_kurs sk on student.id = sk.student_id
left join kurs k on sk.course_id = k.id where student.id = '$id';";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        return $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);

    }catch (PDOException $i){
        debug($i->getMessage());
    }
}

//CRUD functions teacher
function getAllTechres(){
    global $db;
    $sql = "select * from teacher where status = 1";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
    }catch (PDOException $info){
        echo "<pre>";
        print_r($info->getMessage());
    }
    $result = $prepare->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
}

function createTeacher($last_name , $first_name , $gender , $experience , $specialty , $phone , $email , $status){
    global $db;
    $sql = "insert into teacher(last_name,first_name,gender,email,experience,specialty,phone,status) 
    values ('$last_name' , '$first_name' , '$gender', '$email' , '$experience' , '$specialty' , '$phone' , '$status')";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        return true;
    }catch (PDOException $i){
        debug($i->getMessage());
    }

}

function teacherDelete($id){
    global $db;
    $sql = "delete from teacher where id = '$id'";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        return true;
    }catch (PDOException $i){
        debug($i->getMessage());
    }
}

function getTeacherById($id){
    global $db;
    $sql = "select * from teacher where id = $id";
    $prepere = $db->prepare($sql);
    try {
        $prepere->execute();
        $result = $prepere->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }catch (PDOException $info){
        print_r($info->getMessage());
    }
}

function updateTeacher($last_name , $first_name , $gender , $experience , $specialty , $phone , $email , $status , $id){
    global $db;
    $sql = "update teacher set last_name = '$last_name' , first_name = '$first_name' , gender = '$gender' , experience = '$experience',
    specialty = '$specialty' , phone = '$phone' , email = '$email' , status = '$status' where id = '$id';
     ";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        return true;
    }catch (PDOException $i){
        debug($i->getMessage());
    }
}

//CRUD functions Kurs

function getAllKurs(){
    global $db;
    $sql = "select * from kurs";
    $p = $db->prepare($sql);
    try {
        $p->execute();
        return $p->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $i){
        debug($i->getMessage());
    }
}

function studentCount($id){
    global $db;
    $sql = "select count(*) as soni from student_kurs where course_id='$id';";
    $p = $db->prepare($sql);
    try {
        $p->execute();
        return $p->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $i){
        debug($i->getMessage());
    }
}

function createKurs($name , $tacher_id , $in_week , $even_or_odd , $price , $room_id , $start_date , $end_date){
    global $db;
    $sql = "insert into kurs( name, in_week , even_or_odd , start_date , end_date , price , room_id , teacher_id)
    values ('$name' , '$in_week' , '$even_or_odd' , '$start_date' , '$end_date' , '$price' , '$room_id' , '$tacher_id')";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        return true;
    }catch (PDOException $i){
        debug($i->getMessage());
    }
}

function getKursById($id){
    global $db;
    $sql = "select * from kurs where id = $id";
    $prepere = $db->prepare($sql);
    try {
        $prepere->execute();
        $result = $prepere->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }catch (PDOException $info){
        print_r($info->getMessage());
    }
}

function updateKurs($name , $tacher_id , $in_week , $even_or_odd , $price , $room_id , $start_date , $end_date , $id){
    global $db;
    $query = "update kurs set name = '$name' , in_week = '$in_week' , even_or_odd = '$even_or_odd' , start_date = '$start_date' , end_date = '$end_date' , price = '$price' , room_id = '$room_id' , teacher_id = '$tacher_id' where id = '$id'";
    $prepare = $db->prepare($query);
    try {
        $prepare->execute();
        return true;
    }catch (PDOException $i){
        debug($i->getMessage());
    }

}

function kursDelete($id){
    global  $db;
    $sql = "delete from kurs where id = '$id'";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        return true;
    }catch (PDOException $i){
        debug($i->getMessage());
    }
}

const LIMIT = 3;
function getSortList($tablename , $page, $withoutLimit = false , $sort = 'asc' ,$column_name = 'id'){

    global $db;

    if ($sort == 'asc'){

        $offset = ($page - 1) * LIMIT;
        if ($withoutLimit) {

            $sql = "select * from $tablename order by $column_name asc";
            $state = $db->prepare($sql);

        } else {

            $sql = "select * from $tablename order by $column_name asc limit :offset, :limit ";
            $state = $db->prepare($sql);
            $state->bindValue(":limit", LIMIT, PDO::PARAM_INT);
            $state->bindValue(":offset", $offset, PDO::PARAM_INT);
        }
        try {

            $state->execute();
            return $state->fetchAll(PDO::FETCH_ASSOC);

        }catch (PDOException $i){
            debug($i->getMessage());
            debug($i->getLine());
            debug($i->getFile());
        }

    }else if($sort == 'desc'){

        $offset = ($page - 1) * LIMIT;
        if ($withoutLimit) {

            $sql = "select * from $tablename order by $column_name desc";
            $state = $db->prepare($sql);

        } else {

            $sql = "select * from $tablename order by $column_name desc limit :offset, :limit ";
            $state = $db->prepare($sql);
            $state->bindValue(":limit", LIMIT, PDO::PARAM_INT);
            $state->bindValue(":offset", $offset, PDO::PARAM_INT);
        }
        try {
            $state->execute();
            return $state->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $i){
            debug($i->getMessage());
        }

    }
}

function getPagination($tableName)
{
    global $db;
    $sql = "select * from " . $tableName;
    $state = $db->prepare($sql);
    $state->execute();
    $total_rows = $state->rowCount();
    return ceil($total_rows / LIMIT);
}

function debug($arr){
    echo "<pre>";
    print_r($arr);
}

function registration($username , $password , $confirm , $phone){

    if (!empty($username) && !empty($password) && !empty($confirm) && !empty($phone)){

        global $db;
        try {
            $state = $db->prepare("select *  from users where username = :username");
        }catch (PDOException $i){
            debug($i->getMessage());
        }
        $state->bindValue(":username" , $username);
        $state->execute();
        $count = $state->rowCount();
        if ($count > 0){
            $_SESSION['error'] = "$username nomi foydalanuvchi mavjud.Iltimos boshqa username kiriting";
        }else{
            if (strlen($password) >= 4){
                if (strlen($password) >= 8){
                    if ($password === $confirm){
                        return true;

                    }else{
                        $_SESSION['error'] = "passwordlar mos emas!";
                    }
                }else{
                    $_SESSION['error'] = "password kamida 8 ta belgidan iborat bo'lishi kerak";
                }
            }else{
                $_SESSION['error'] = "username kamida 4 ta harfdan iborat bo'lishi kerak";
            }

        }

    }else{

        $_SESSION['error'] = "Login yoki password kiritilmadi";
    }
}

function getUserById($id){
    global  $db;
    $sql = "select * from users where id = :id";
    $prepare = $db->prepare($sql);
    $prepare->bindValue(":id" , $id);
    $prepare->execute();
    return $prepare->fetch(PDO::FETCH_ASSOC);
}

function findByName($finder){
    global $db;
    $sql = "select * from student where last_name like '%$finder%'";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
    }catch (PDOException $i){
        debug($i->getMessage());
        debug($i->getLine());
        debug($i->errorInfo);
    }

    return $prepare->fetchAll(PDO::FETCH_ASSOC);
}

function findByFirstName($finder){
    global $db;
    $sql = "select * from student where first_name like '%$finder%'";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
    }catch (PDOException $i){
        debug($i->getMessage());
        debug($i->getLine());
        debug($i->errorInfo);
    }

    return $prepare->fetchAll(PDO::FETCH_ASSOC);
}

function getTeacherByName($finder){
    global $db;
    $sql = "select * from teacher where last_name like '%$finder%'";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
    }catch (PDOException $i){
        debug($i->getMessage());
        debug($i->getLine());
        debug($i->errorInfo);
    }

    return $prepare->fetchAll(PDO::FETCH_ASSOC);
}

function createProduct($name , $category_id , $brand_id , $attributes){
    global $db;
    $sql = "insert into product( name , brand_id , category_id , attributes) VALUES ('$name' , '$brand_id' , '$category_id' , '$attributes')";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        return true;
    }catch (PDOException $i){
        debug($i->getMessage());
        debug($i->getLine());
    }

}

function getProductById($id){
    global $db;
    $sql = "select * from product where id = $id";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        return $prepare->fetchAll(\PDO::FETCH_ASSOC);
    }catch (PDOException $info){
        debug($info->getMessage());
    }
}

function updateProduct($name , $category_id , $brand_id , $attributes , $id){
    global $db;
    $sql = "update product set name = '$name' , brand_id = '$brand_id' , category_id = '$category_id' , attributes = '$attributes' where  id = $id";
    $prepare = $db->prepare($sql);
    try {
        $prepare->execute();
        return true;
    }catch (PDOException $info){
        debug($info->getMessage());
    }
}

function deleteProduct($id){
    global $db;
    $sql = "delete from product where id = '$id'";
    try {
        $db->exec($sql);
        return true;
    }catch (PDOException $info){
        debug($info->getMessage());
    }
}

function findByAttribute($finder){
    global $db;
    $sql = "select * from product where JSON_EXTRACT(`attributes` , '$.ram') like '%$finder%' ";
    $prepare = $db->prepare($sql);
    $prepare->execute();
    return $prepare->fetchAll(PDO::FETCH_ASSOC);
}


function saveImage($image){
    $dir = "../files";

    if (!is_dir($dir)){
        mkdir($dir , true , 0777);
    }

    $name = $image['name'];
    $tmp_name = $image['tmp_name'];
    $arr = explode('.' , $name);
    $extension = mb_strtolower(end($arr));
    $extension_array = ['mp4' , 'gif' , 'pdf'];
    $date = date('d_m_Y');
    if (!in_array($extension , $extension_array)){
        $filename = "image_" . $date . "_" . md5($name . rand(1 , 10000)). '.' . $extension;
        $fileTo = $dir . "/" . $filename;
        move_uploaded_file($tmp_name , $fileTo);
        return $filename;
    }else{
        $_SESSION['error'] = "Rasm formatidagi fayl yuklang";
    }

}

function deleteImage($image){
    $dir = "../files/$image";
    if (is_file($image)){
        unlink($dir);
        return true;
    }else{
        return false;
    }
}

function updateImage($image){
    $fileTo ="../files/$image";
    if (is_file($fileTo)){
        unlink($fileTo);
        return true;
    }else{
        return false;
    }
}
