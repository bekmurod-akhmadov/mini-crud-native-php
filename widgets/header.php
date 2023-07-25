<?php session_start();
if (!empty($_SESSION['user_id'])){
    $user = getUserById($_SESSION['user_id']);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>EDUACTION</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Asosiy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../products/product.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../student/student.php">O'quvchilar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../room/room.php">Xonalar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../teacher/teacher.php">O'qituvchilar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../kurs/kurs.php">Kurslar</a>
                    </li>

                    <?php if (empty($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../login.php"><i class="fas fa-user"></i> Kirish</a>
                        </li>
                    <?php endif ?>

                    <?php if (!empty($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../logout.php"><i class="fas fa-door-open"></i> Chiqish</a>
                        </li>
                    <?php endif ?>

                    <li class="nav-item" style="margin-left: 30px;">
                        <a class="nav-link active" aria-current="page" ><i class="fas fa-user"></i> <?=(!empty($user) ? $user['username'] : '')?></a>
                    </li>


                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

</body>
</html>
