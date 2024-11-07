<?php

require './assets/config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ./pages/login.php');
    exit;
}

$obj = new db();
$studentData = $obj->viewStudentData($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <?php 
        foreach ($studentData as $data){
    ?>
    <div class="container">
        <h1 class="d-flex flex-column align-items-center text-center mt-5">Welcome, <span style="color: red;padding: 10px;"><?php echo $data['firstname'] ?>&nbsp;!</span></h1>
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="./uploads/<?= $data['profile'] ?>" alt="image" class="rounded-circle" width="150px">
                                <br>
                                <div class="mt-3">
                                    <input type="submit" class="btn btn-primary" value="Change Password" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                <?php echo $data['email']; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone Number</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <?php echo $data['mobile']; ?> 
                                </div>
                            </div>
                            <?php 
                                }
                            ?>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <a class="btn btn-info " href="./pages/updateProfile.php">Edit</a>
                                    <a class="btn btn-primary" href="./assets/logout.php">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>